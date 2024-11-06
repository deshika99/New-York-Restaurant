<?php

namespace App\Http\Controllers;

use App\Models\Apartments;
use App\Models\Booking;
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

        return view('frontend.booking', compact(
            'roomType',
            'apartment',
            'checkin',
            'checkout',
            'availableRooms',
            'totalDays',
            'term'
        ));
    }


    public function store(Request $request)
    {
        Log::info('Store request data: ', $request->all());

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

        DB::beginTransaction();

        try {

            $booking = Booking::create([
                'customer_id' => 1, // change logged-in customer
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
                'booking_status' => 'Pending',
                'confirmation_status' => 'Pending'
            ]);

            $advancedPayment=0;
            if($paidAmount>0 && $dueAmount>0){
                $advancedPayment=1;
            }

            $paymentStatus=null;
            if($paidAmount>0 && $dueAmount>0){
                $paymentStatus='Partial Payment';
            }elseif($dueAmount==0){
                $paymentStatus='Completed';
            }elseif($dueAmount==$request->total_cost){
                $paymentStatus='Not Paid';
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
                'bank_transfer_confirmation' => $request->payment_type === 'Bank Transfer' ? 0 : 1,

                'discounted_total' => $request->total_cost,
                'partial_payment' => $advancedPayment,
                'payment_status' => $paymentStatus
            ]);

            DB::commit();

            return response()->json(['message' => 'Booking and payment details saved successfully!', 'booking_id' => $booking->id], 201);
        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Error storing booking and payment details: ', ['error' => $e->getMessage()]);
            return response()->json(['message' => 'An error occurred while saving booking details. Please try again.'], 500);
        }
    }
}
