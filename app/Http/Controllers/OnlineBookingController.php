<?php

namespace App\Http\Controllers;

use App\Models\Apartments;
use App\Models\BankDetails;
use App\Models\Booking;
use App\Models\CompanyDetails;
use App\Models\Payment;
use App\Models\Room;
use App\Models\RoomTypes;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

use Illuminate\Support\Facades\Session;

class OnlineBookingController extends Controller
{

    public function checkAvailability(Request $request)
    {


        $validatedData = $request->validate([
            'checkin' => 'required|date|after_or_equal:today',
            'checkout' => 'required|date|after:checkin',
            'apartment' => 'required|exists:apartments,id'
        ]);



        $checkin = $validatedData['checkin'];
        $checkout = $validatedData['checkout'];
        $apartmentId = $validatedData['apartment'];


        $apartment = Apartments::findOrFail($apartmentId);

        $roomTypes = RoomTypes::all();

        return view('frontend.find_room', compact(
            'roomTypes',
            'apartment',
            'checkin',
            'checkout',
            'apartmentId'
        ));
    }

    public function create(Request $request)
    {
        $roomTypeId = $request->query('room_type_id');
        $apartmentId = $request->query('apartment_id');
        $checkin = $request->query('checkin');
        $checkout = $request->query('checkout');

        $apartment = Apartments::findOrFail($apartmentId);
        $roomType = RoomTypes::findOrFail($roomTypeId);

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
            ->get();

        $checkinDate = new DateTime($checkin);
        $checkoutDate = new DateTime($checkout);
        $interval = $checkinDate->diff($checkoutDate);
        $totalDays = $interval->days + 1;
        $term = null;
        if ($totalDays > 15) {
            $term = "Long-Term";
        } elseif ($totalDays <= 15) {
            $term = "Short-Term";
        }

        $bankDetails = BankDetails::first();

        return view('frontend.booking', compact(
            'roomType',
            'apartment',
            'checkin',
            'checkout',
            'availableRooms',
            'totalDays',
            'term',
            'bankDetails'
        ));
    }


    public function store(Request $request)
    {
        $loggedCustomerId = session('customer_id');
        if ($loggedCustomerId) {


            //Log::info('Store request data: ', $request->all());

            $request->validate([
                'room_id' => 'required|exists:rooms,id',
                'payment_type' => 'required|string',
                'amount' => 'required|numeric',
                'paid_amount' => 'required|numeric',
                'due_amount' => 'required|numeric',
                'service_charge' => 'required|numeric',
                'refundable_charge' => 'required|numeric',
                'total_cost' => 'required|numeric',
                'checkin' => 'required|date',
                'checkout' => 'required|date',
                'total_days' => 'required|integer',
                'term' => 'required|string',
                'transfer_slip_image' => 'nullable|string'
            ]);

            $dueAmount = $request->due_amount;
            $paidAmount = $request->paid_amount;
            if ($request->payment_type == 'At Hotel') {
                $dueAmount = $request->total_cost;
                $paidAmount = 0;
            }

            if ($request->payment_type == 'Bank Transfer') {
                $dueAmount = $request->total_cost;
                $paidAmount = 0;
            }

            $confirmationStatus = 'Not Relevant';
            if ($request->payment_type == 'Bank Transfer') {
                $confirmationStatus = 'Awaiting Bank Slip';
            }

            $bookingStatus = 'Pending';
            if ($paidAmount == $request->total_cost) {
                $bookingStatus = 'Confirmed';
            }

            DB::beginTransaction();

            try {

                $booking = Booking::create([
                    'customer_id' => $loggedCustomerId,
                    'room_id' => $request->room_id,
                    'booking_date' => now(),
                    'start_date' => $request->checkin,
                    'end_date' => $request->checkout,
                    'term' => $request->term,
                    'booking_type' => 'Online',
                    'payment_type' => $request->payment_type,
                    'service_charge' => $request->service_charge,
                    'total_cost' => $request->total_cost,
                    'discount_applied' => 0,
                    'booking_status' => $bookingStatus,
                    'confirmation_status' => $confirmationStatus
                ]);

                $advancedPayment = 0;
                if ($paidAmount > 0 && $dueAmount > 0) {
                    $advancedPayment = 1;
                }

                $paymentStatus = null;
                if ($paidAmount > 0 && $dueAmount > 0) {
                    $paymentStatus = 'Partial Payment';
                } elseif ($dueAmount == 0) {
                    $paymentStatus = 'Completed';
                } elseif ($dueAmount == $request->total_cost) {
                    $paymentStatus = 'Not Paid';
                }

                $payment = Payment::create([
                    'booking_id' => $booking->id,
                    'total_room_charge' => $request->amount,
                    'total_amount' => $request->total_cost,
                    'paid_amount' => $paidAmount,
                    'due_amount' => $dueAmount,
                    'payment_type' => $request->payment_type,
                    'payment_date' => now(),
                    'service_charge_applied' => $request->service_charge > 0 ? 1 : 0,
                    'advance_payment' => $advancedPayment,
                    'refundable_amount' => $request->refundable_charge ?? 0,
                    'refund_status' => $request->refundable_charge > 0 ? 'Pending' : 'No Charge',
                    'bank_transfer_confirmation' => $request->payment_type === 'Bank Transfer' ? 1 : 0,

                    'discounted_total' => $request->total_cost,
                    'partial_payment' => $advancedPayment,
                    'payment_status' => $paymentStatus
                ]);

                DB::commit();

                return response()->json(['message' => 'Booking and payment details saved successfully!', 'booking_id' => $booking->id], 201);
            } catch (\Exception $e) {
                DB::rollback();
                //Log::error('Error storing booking and payment details: ', ['error' => $e->getMessage()]);
                return response()->json(['message' => 'An error occurred while saving booking details. Please try again.'], 500);
            }
        } else {
            return response()->json(['message' => 'Please login first.'], 500);
        }
    }

    public function index()
    {
        $bookings = Booking::with('payment')
            ->where('booking_type', 'Online')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('AdminDashboard.OnlineBookings.index', compact('bookings'));
    }

    public function onlineBookingDetails($id)
    {
        $booking = Booking::with('payment')->where('id', $id)->firstOrFail();
        return view('AdminDashboard.OnlineBookings.viewDetails', compact('booking'));
    }

    public function updatePayment(Request $request, $id)
    {
        $request->validate([
            'discount' => 'nullable|numeric|min:0',
            'amount_paid' => 'required|numeric|min:0',
            'payment_type' => 'required|string',
        ]);

        $payment = Payment::findOrFail($id);
        $booking = Booking::findOrFail($payment->booking_id);

        $totalAmount = $payment->total_amount;

        $discount = $request->input('discount') ?? 0;
        $updatedDiscount = $booking->discount_applied + $discount;
        $discountedTotal = $payment->discounted_total;
        $newDiscountedTotal = $totalAmount - $updatedDiscount;

        $newPayment = $request->input('amount_paid');
        $updatedPaidAmount = $payment->paid_amount + $newPayment;
        $dueAmount = $newDiscountedTotal - $updatedPaidAmount;

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
            'discounted_total' => $newDiscountedTotal,
        ]);


        $confirmationStatus = 'Not Relevant';
        if ($request->input('payment_type') == 'Bank Transfer' && $booking->payment_type == 'Bank Transfer') {
            $confirmationStatus = 'Confirmed';
        } else if ($booking->confirmation_status == 'Confirmed') {
            $confirmationStatus = 'Confirmed';
        }

        $booking->update([
            'booking_status' => 'Confirmed',
            'confirmation_status' => $confirmationStatus,
            'discount_applied' => $updatedDiscount,
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

    public function printView($id)
    {
        $companyDetails = CompanyDetails::first();
        $currentDateTime = now();
        $booking = Booking::with('payment')->where('id', $id)->firstOrFail();
        return view('AdminDashboard.OnlineBookings.bookingPrint', compact('booking', 'currentDateTime', 'companyDetails'));
    }

    public function destroy($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->delete();

        return redirect()->back()->with('success', 'Booking deleted successfully.');
    }
}
