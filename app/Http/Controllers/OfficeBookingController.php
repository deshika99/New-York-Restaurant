<?php

namespace App\Http\Controllers;

use App\Models\Apartments;
use App\Models\Booking;
use App\Models\Customer;
use App\Models\Payment;
use App\Models\Room;
use App\Models\RoomTypes;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class OfficeBookingController extends Controller
{
    public function create($id)
    {

        $customer = Customer::findOrFail($id); //change customer id
        $apartments = Apartments::all();
        $roomTypes = RoomTypes::all();

        return view('AdminDashboard.OfficeBookings.create_booking', compact(
            'customer',
            'apartments',
            'roomTypes',

        ));
    }

    public function getAvailableRooms(Request $request)
    {
        $apartmentId = $request->input('apartment_id');
        $roomTypeId = $request->input('room_type_id');
        $checkin = $request->input('checkin');
        $checkout = $request->input('checkout');

        $availableRooms = Room::where('apartment_id', $apartmentId)
            ->where('room_type_id', $roomTypeId)
            ->where('occupancy_status', 'Available')
            ->whereDoesntHave('bookings', function ($query) use ($checkin, $checkout) {
                $query->where(function ($q) use ($checkin, $checkout) {
                    $q->whereBetween('start_date', [$checkin, $checkout])
                        ->orWhereBetween('end_date', [$checkin, $checkout])
                        ->orWhere(function ($q) use ($checkin, $checkout) {
                            $q->where('start_date', '<=', $checkin)
                                ->where('end_date', '>=', $checkout);
                        });
                });
            })
            ->with('floor')
            ->get(['id', 'room_number', 'rental_price', 'floor_id']);

        return response()->json(['rooms' => $availableRooms]);
    }


    public function store(Request $request,$id){
        
        //Log::info('Store request data: ', $request->all());
        
        $request->validate([
            'checkin' => 'required|date',
            'checkout' => 'required|date|after:checkin',
            'term' => 'required|string',
            'apartment_id' => 'required|exists:apartments,id',
            'room_type_id' => 'required|exists:room_types,id',
            'room_id' => 'required|exists:rooms,id',
            'total_room_charge' => 'required|numeric',
            'service_charge' => 'required|numeric',
            'refundable_charge' => 'required|numeric',
            'total_cost' => 'required|numeric',
            'discount' => 'nullable|numeric',
            'discounted_total' => 'required|numeric',
            'payment_type' => 'required|string',
            'amount_paid' => 'required|numeric',
            'due_amount' => 'required|numeric',
        ]);

        $checkinDate = new DateTime($request->checkin);
        $checkoutDate = new DateTime($request->checkout);
        $interval = $checkinDate->diff($checkoutDate);
        $totalDays = $interval->days + 1;
        $term = "Short-Term";
        if ($totalDays > 15) {
            $term = "Long-Term";
        } 


        $confirmationStatus = 'Not Relevant';
        if ($request->payment_type == 'Bank Transfer') {
            $confirmationStatus = 'Confirmed';
        }

        DB::beginTransaction();

        try {

            $booking = Booking::create([
                'customer_id' => $id, 
                'room_id' => $request->room_id,
                'booking_date' => now(),
                'start_date' => $request->checkin,
                'end_date' => $request->checkout,
                'term' => $term,
                'booking_type' => 'Office',
                'payment_type' => $request->payment_type,
                'service_charge' => $request->service_charge,
                'total_cost' => $request->total_cost,
                'discount_applied' => $request->discount ?? '0',
                'booking_status' => 'Confirmed',
                'confirmation_status' => $confirmationStatus
            ]);    

            $advancedPayment = 0;
            if ($request->amount_paid > 0 && $request->due_amount > 0) {
                $advancedPayment = 1;
            }
            
            $paymentStatus = null;
            if ($request->amount_paid > 0 && $request->due_amount > 0) {
                $paymentStatus = 'Partial Payment';
            } elseif ($request->due_amount == 0) {
                $paymentStatus = 'Completed';
            } elseif ($request->due_amount == $request->total_cost) {
                $paymentStatus = 'Not Paid';
            }


            $payment = Payment::create([
                'booking_id' => $booking->id,
                'total_room_charge' => $request->total_room_charge,
                'total_amount' => $request->total_cost,
                'paid_amount' => $request->amount_paid,
                'due_amount' => $request->due_amount,
                'payment_type' => $request->payment_type,
                'payment_date' => now(),
                'service_charge_applied' => $request->service_charge > 0 ? 1 : 0,
                'advance_payment' => $advancedPayment,
                'refundable_amount' => $request->refundable_charge ?? 0,
                'refund_status' => $request->refundable_charge > 0 ? 'Pending' : 'No Charge',
                'bank_transfer_confirmation' => $request->payment_type === 'Bank Transfer' ? 1 : 0,

                'discounted_total' => $request->discounted_total,
                'partial_payment' =>$advancedPayment,
                'payment_status' => $paymentStatus
            ]);

            DB::commit();

            return redirect()->route('viewOfficeBookings')->with('success', 'Booking created successfully.');
        } catch (\Exception $e) {
            DB::rollback();
            //Log::error('Error storing booking and payment details: ', ['error' => $e->getMessage()]);
            return back()->withErrors(['error' => 'Failed to create booking: ' . $e->getMessage()]);
        }

    }

    public function index()
    {
        $bookings = Booking::with('payment')
            ->where('booking_type', 'Office')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('AdminDashboard.OfficeBookings.index', compact('bookings'));
    }

    public function officeBookingDetails($id) 
    {
        $booking = Booking::with('payment')->where('id', $id)->firstOrFail();
        return view('AdminDashboard.OfficeBookings.viewDetails', compact('booking'));
    }

    public function updatePayment(Request $request, $id)
    {
        $request->validate([
            'amount_paid' => 'required|numeric|min:0',
            'payment_type' => 'required|string',
        ]);

        $payment = Payment::findOrFail($id);

        $newPayment = $request->input('amount_paid');
        $updatedPaidAmount = $payment->paid_amount + $newPayment;
        $totalAmount = $payment->discounted_total;
        $dueAmount = $totalAmount - $updatedPaidAmount;

        $dueAmount = max(0, $dueAmount);

        $paymentStatus = null;
        if ($dueAmount == 0) {
            $paymentStatus = 'Completed';
        } else if ($dueAmount > 0) {
            $paymentStatus = 'Partial Payment';
        }

        $payment->update([
            'paid_amount' => $updatedPaidAmount,
            'due_amount' => $dueAmount,
            'payment_type' => $request->input('payment_type'),
            'payment_status' => $paymentStatus,
        ]);

        $booking = Booking::findOrFail($payment->booking_id);

        $confirmationStatus = 'Not Relevant';
        if ($request->input('payment_type') == 'Bank Transfer' && $booking->payment_type == 'Bank Transfer') {
            $confirmationStatus = 'Confirmed';
        }else if($booking->confirmation_status == 'Confirmed'){
            $confirmationStatus = 'Confirmed';
        }

        $booking->update([
            'booking_status' => 'Confirmed',
            'confirmation_status' => $confirmationStatus,
        ]);

        return redirect()->back()->with('success', 'Payment updated successfully.');
    }


    public function updateStatus(Request $request, $id)
    {
        // Validate the form data
        $request->validate([
            'refund_status' => 'required|string',
            'bank_transfer_status' => 'required|string',
            'booking_status' => 'required|string',
        ]);

        $booking = Booking::findOrFail($id);
        $payment = $booking->payment;

        $payment->refund_status = $request->input('refund_status');
        $booking->confirmation_status = $request->input('bank_transfer_status');
        $booking->booking_status = $request->input('booking_status');

        $payment->save();
        $booking->save();

        return redirect()->back()->with('success', 'Status updated successfully.');
    }

    public function printView($id){
        $currentDateTime = now();
        $booking = Booking::with('payment')->where('id', $id)->firstOrFail();
        return view('AdminDashboard.OfficeBookings.officeBookingPrint',compact('booking','currentDateTime'));
    }

    public function destroy($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->delete();

        return redirect()->back()->with('success', 'Booking deleted successfully.');
    }

}
