@extends('AdminDashboard.master')

@section('content')
<!DOCTYPE html>
<html lang="en">

<body>
    <!-- Success Message -->
    @if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <!-- Error Display -->
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <section class="content-main">
        <div class="content-header">
            <h2 class="content-title">Add Reservation</h2>
            <p>{{$customer->fname}} {{$customer->lname}} - {{$customer->phone_number}}</p>
        </div>

        <div class="card">
            <div class="card-body">
                <form action="{{ route('officebooking.store',$customer->id ) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">

                        <!-- Check-in Date -->
                        <div class="mb-4 col-md-4">
                            <label for="checkin" class="form-label">Check-in Date <span class="text-danger">*</span></label>
                            <input
                                type="date"
                                class="form-control"
                                id="checkin"
                                name="checkin"
                                required
                                onchange="loadAvailableRooms(); calculateTerm();" />
                        </div>

                        <!-- Check-out Date -->
                        <div class="mb-4 col-md-4">
                            <label for="checkout" class="form-label">Check-out Date <span class="text-danger">*</span></label>
                            <input
                                type="date"
                                class="form-control"
                                id="checkout"
                                name="checkout"
                                required
                                onchange="loadAvailableRooms(); calculateTerm();" />
                        </div>

                        <!-- Term Display -->
                        <div class="mb-4 col-md-4">
                            <label for="term" class="form-label">Term</label>
                            <input
                                type="text"
                                class="form-control"
                                id="term"
                                name="term"
                                readonly />
                        </div>

                        <!-- Select Apartment -->
                        <div class="mb-4 col-md-6">
                            <label for="apartment_id" class="form-label">Select Apartment <span class="text-danger">*</span></label>
                            <select class="form-select" id="apartment_id" name="apartment_id" required onchange="loadAvailableRooms()">
                                <option value="">Select apartment</option>
                                @foreach ($apartments as $apartment)
                                <option value="{{$apartment->id}}">{{$apartment->apartment_name}} - {{$apartment->location_name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Select Room Type -->
                        <div class="mb-4 col-md-6">
                            <label for="room_type_id" class="form-label">Select Room Type <span class="text-danger">*</span></label>
                            <select class="form-select" id="room_type_id" name="room_type_id" required onchange="loadAvailableRooms()">
                                <option value="">Select room type</option>
                                @foreach ($roomTypes as $roomType)
                                <option value="{{$roomType->id}}">{{$roomType->type_name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Select Room -->
                        <div class="mb-4 col-md-6">
                            <label for="room_id" class="form-label">Select Room <span class="text-danger">*</span></label>
                            <select class="form-select" id="room_id" name="room_id" required>
                                <option value="">Select room</option>

                            </select>
                        </div>


                        <!-- Total Room Charge -->
                        <div class="mb-4 col-md-6">
                            <label for="total_room_charge" class="form-label">Total Room Charge (LKR)</label>
                            <input
                                type="text"
                                class="form-control"
                                id="total_room_charge"
                                name="total_room_charge"
                                readonly />
                        </div>

                        <!-- Service Charge -->
                        <div class="mb-4 col-md-6">
                            <label for="service_charge" class="form-label">Service Charge (LKR)</label>
                            <input
                                type="text"
                                class="form-control"
                                id="service_charge"
                                name="service_charge"
                                readonly />
                        </div>

                        <!-- Refundable Charge -->
                        <div class="mb-4 col-md-6">
                            <label for="refundable_charge" class="form-label">Refundable Charge (LKR)</label>
                            <input
                                type="text"
                                class="form-control"
                                id="refundable_charge"
                                name="refundable_charge"
                                readonly />
                        </div>

                        <!-- Total Cost -->
                        <div class="mb-4 col-md-6">
                            <label for="total_cost" class="form-label">Total Cost (LKR)</label>
                            <input
                                type="text"
                                class="form-control"
                                id="total_cost"
                                name="total_cost"
                                readonly />
                        </div>

                        <!-- Discount -->
                        <div class="mb-4 col-md-6">
                            <label for="discount" class="form-label">Discount (LKR)</label>
                            <input
                                type="text"
                                class="form-control"
                                id="discount"
                                name="discount"
                                placeholder="Enter discount amount" />
                        </div>

                        <!-- Discounted Total -->
                        <div class="mb-4 col-md-6">
                            <label for="discounted_total" class="form-label">Discounted Total (LKR)</label>
                            <input
                                type="text"
                                class="form-control"
                                id="discounted_total"
                                name="discounted_total"
                                readonly />
                        </div>

                        <!-- Payment Type -->
                        <div class="mb-4 col-md-6">
                            <label for="payment_type" class="form-label">Payment Type <span class="text-danger">*</span></label>
                            <select class="form-select" id="payment_type" name="payment_type" required>
                                <option value="">Select payment type</option>
                                <option value="Cash">Cash</option>
                                <option value="Card">Card</option>
                                <option value="Bank Transfer">Bank Transfer</option>
                            </select>
                        </div>

                        <!-- Paid Amount -->
                        <div class="mb-4 col-md-6">
                            <label for="amount_paid" class="form-label">Amount Paid (LKR) <span class="text-danger">*</span></label>
                            <input
                                type="text"
                                class="form-control"
                                id="amount_paid"
                                name="amount_paid"
                                placeholder="Enter paid amount"
                                required />
                        </div>

                        <!-- Due Amount -->
                        <div class="mb-4 col-md-6">
                            <label for="due_amount" class="form-label">Due Amount (LKR)</label>
                            <input
                                type="text"
                                class="form-control"
                                id="due_amount"
                                name="due_amount"
                                readonly />
                        </div>

                        <!-- Submit Button -->
                        <div class="d-grid col-md-6">
                            <button type="submit" class="btn btn-primary">Submit Booking</button>
                        </div>
                    </div>

                </form>

            </div>
        </div>
    </section>





    <script>
        let totalDays;

        function calculateTerm() {
            const checkinDate = new Date(document.getElementById("checkin").value);
            const checkoutDate = new Date(document.getElementById("checkout").value);
            const termInput = document.getElementById("term");

            if (checkinDate && checkoutDate && checkinDate < checkoutDate) {
                let daysDifference = Math.floor((checkoutDate - checkinDate) / (1000 * 60 * 60 * 24));
                totalDays = daysDifference + 1;
                let term = "Short Term";
                if (totalDays > 15) {
                    term = "Long Term";
                }
                termInput.value = `${term} (${totalDays} days)`;
            } else {
                termInput.value = "";
            }
        }

        function loadAvailableRooms() {
            const apartmentId = document.getElementById("apartment_id").value;
            const roomTypeId = document.getElementById("room_type_id").value;
            const checkinDate = document.getElementById("checkin").value;
            const checkoutDate = document.getElementById("checkout").value;

            if (apartmentId && roomTypeId && checkinDate && checkoutDate) {
                fetch(`/get-available-rooms`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            apartment_id: apartmentId,
                            room_type_id: roomTypeId,
                            checkin: checkinDate,
                            checkout: checkoutDate
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        const roomSelect = document.getElementById("room_id");
                        roomSelect.innerHTML = '<option value="">Select room</option>';
                        data.rooms.forEach(room => {
                            roomSelect.innerHTML += `<option value="${room.id}" data-price="${room.rental_price}">Room ${room.room_number}  (Floor no. ${room.floor.floor_number})  -  LKR ${room.rental_price} </option>`;
                        });
                    })
                    .catch(error => console.error("Error fetching rooms:", error)); 
            }
        }

        function calculateCharges() {
            const roomSelect = document.getElementById("room_id");
            const selectedRoom = roomSelect.options[roomSelect.selectedIndex];
            const roomPrice = parseFloat(selectedRoom.getAttribute("data-price")) || 0;

            if (totalDays && roomPrice) {
                const totalRoomCharge = roomPrice * totalDays;
                const serviceCharge = totalRoomCharge * 0.1; // 10% of total room charge
                const refundableCharge = (document.getElementById("term").value.includes("Long Term")) ? totalRoomCharge * 0.5 : 0;
                const totalCost = totalRoomCharge + serviceCharge + refundableCharge;

                document.getElementById("total_room_charge").value = totalRoomCharge.toFixed(2);
                document.getElementById("service_charge").value = serviceCharge.toFixed(2);
                document.getElementById("refundable_charge").value = refundableCharge.toFixed(2);
                document.getElementById("total_cost").value = totalCost.toFixed(2);

                calculateDiscountedTotal();
            }
        }

        function calculateDiscountedTotal() {
            const totalCost = parseFloat(document.getElementById("total_cost").value) || 0;
            const discount = parseFloat(document.getElementById("discount").value) || 0;
            const discountedTotal = totalCost - discount;
            document.getElementById("discounted_total").value = discountedTotal.toFixed(2);

            calculateDueAmount();
        }

        function calculateDueAmount() {
            const discountedTotal = parseFloat(document.getElementById("discounted_total").value) || 0;
            const amountPaid = parseFloat(document.getElementById("amount_paid").value) || 0;
            const dueAmount = discountedTotal - amountPaid;

            document.getElementById("due_amount").value = dueAmount.toFixed(2);
        }


        // Attach calculateCharges function to room selection
        document.getElementById("room_id").addEventListener("change", calculateCharges);
        document.getElementById("discount").addEventListener("input", calculateDiscountedTotal);
        document.getElementById("amount_paid").addEventListener("input", calculateDueAmount);
    </script>


</body>

</html>
@endsection