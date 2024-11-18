@extends ('frontend.master')

@section('content')
<!-- BREADCRUMB AREA START -->
<div class="ltn__breadcrumb-area text-left bg-overlay-white-30 ">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="ltn__breadcrumb-inner">
                    <h1 class="page-title">Room Booking</h1>
                    <div class="ltn__breadcrumb-list">
                        <ul>
                            <li><a href="{{route('home')}}"><span class="ltn__secondary-color"><i class="fas fa-home"></i></span> Home</a></li>
                            <li>Booking</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- BREADCRUMB AREA END -->

<div class="row">
    <div class="col-md-8 offset-md-2">
        @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
    </div>
</div>

<div class="ltn__checkout-area mb-105 mt--65">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="ltn__checkout-inner">
                    <div class="ltn__checkout-single-content ">
                        <h4 class="title-2">Booking Details</h4>
                        <div class="ltn__checkout-single-content-info">

                            <div class="row">
                                <!-- Check-in Date -->
                                <div class="col-md-4">
                                    <h6>Check-in Date</h6>
                                    <div class="input-item input-item-name ">
                                        <input type="text" value="{{$checkin}}" name="checkin" id="checkin" placeholder="Check-in Date" readonly>
                                    </div>
                                </div>

                                <!-- Check-out Date -->
                                <div class="col-md-4">
                                    <h6>Check-out Date</h6>
                                    <div class="input-item input-item-name ">
                                        <input type="text" value="{{$checkout}}" name="checkout" id="checkout" placeholder="Check-out Date" readonly>
                                    </div>
                                </div>

                                <!-- day terms -->
                                <div class="col-md-4">
                                    <h6>Total Days</h6>
                                    <div class="input-item input-item-name ">
                                        <input type="text" value="{{$totalDays}} ({{$term}})" name="totalDays" placeholder="Total Days" readonly>
                                    </div>
                                </div>

                                <!-- Apartment -->
                                <div class="col-md-6">
                                    <h6>Apartment</h6>
                                    <div class="input-item input-item-name ">
                                        <input type="text" value="{{$apartment->apartment_name}} - {{$apartment->location_name}}" name="apartment" placeholder="Selected Apartment" readonly>
                                    </div>
                                </div>

                                <!-- Room Type -->
                                <div class="col-md-6">
                                    <h6>Room Type</h6>
                                    <div class="input-item input-item-name ">
                                        <input type="text" value="{{$roomType->type_name}}" name="roomType" placeholder="Selected Room Type" readonly>
                                    </div>
                                </div>

                                <!-- Room -->
                                <div class="col-md-12">
                                    <h6>Room</h6>
                                    <div class="input-item ">
                                        <select name="room" class="nice-select" id="room-select">
                                            <option value="">Select Room</option>
                                            @foreach ($availableRooms as $room)
                                            <option value="{{$room->id}}" data-price="{{ $room->rental_price }}">Room {{$room->room_number}} (Floor no. {{$room->floor->floor_number}}) - LKR {{ $room->rental_price }} ({{ $room->facilities }})</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <!-- Amount -->
                                <div class="col-md-6">
                                    <h6>Amount</h6>
                                    <div class="input-item input-item-name ">
                                        <input type="text" name="amount" id="amount" placeholder="Amount" step="0.01" readonly>
                                    </div>
                                </div>

                                <!-- Service Charge -->
                                <div class="col-md-6">
                                    <h6>Service Charge (10% of Amount)</h6>
                                    <div class="input-item input-item-name ">
                                        <input type="text" name="service_charge" id="service_charge" placeholder="Service Charge" step="0.01" readonly>
                                    </div>
                                </div>

                                <!-- refundable charge -->
                                <div class="col-md-6">
                                    <h6>Refundable Charge (If Long Term - 50% of Amount)</h6>
                                    <div class="input-item input-item-name ">
                                        <input type="text" name="refundable" id="refundable" placeholder="Refundable Charge" step="0.01" readonly>
                                    </div>
                                </div>

                                <!-- Total Amount -->
                                <div class="col-md-6">
                                    <h6>Total Amount</h6>
                                    <div class="input-item input-item-name ">
                                        <input type="text" name="total_amount" id="total_amount" placeholder="Total Amount" step="0.01" readonly>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="row mt-5">

            <div class="col-lg-6 ">
                <div class="ltn__checkout-inner">
                    <div class="ltn__checkout-single-content ">
                        <h4 class="title-2">Bank Details</h4>
                        <div class="ltn__checkout-single-content-info">
                            <div class="row">

                                <div class="col-md-12" id="info-div">
                                    <span class="">
                                        For Bank Transfer payments, please use the following bank details:
                                        <br><br>
                                        <strong>Bank Name:</strong> {{ $bankDetails->bank_name ?? '' }} <br>
                                        <strong>Account Number:</strong> {{ $bankDetails->account_number ?? '' }} <br>
                                        <strong>Account Holder:</strong> {{ $bankDetails->account_holder ?? '' }} <br>
                                        <strong>Branch:</strong> {{ $bankDetails->branch ?? '' }} <br><br>
                                        After completing the transfer, send a clear image of your bank slip along with your Booking Number and your details to WhatsApp number: <strong>{{ $bankDetails->whatsapp_number ?? '' }}</strong>.
                                    </span>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 ">
                <div class="ltn__checkout-inner">
                    <div class="ltn__checkout-single-content ">
                        <h4 class="title-2">Payments</h4>
                        <div class="ltn__checkout-single-content-info">
                            <div class="row">

                                <div class="col-md-12">
                                    <h6>Payment Type</h6>
                                    <div class="input-item ">
                                        <select name="payment_type" class="nice-select" id="payment_type">
                                            <option value="Card">Card</option>
                                            <option value="At Hotel">Pay At Hotel</option>
                                            <option value="Bank Transfer">Bank Transfer</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-12" id="paid_amount_box">
                                    <h6>Amount Paid (LKR)</h6>
                                    <div class="input-item input-item-name ">
                                        <input type="text" name="amount_paid" id="amount_paid" placeholder="Amount Paid" step="0.01">
                                    </div>
                                </div>

                                <div class="col-md-12" id="due_amount_box">
                                    <h6>Due Amount (LKR)</h6>
                                    <div class="input-item input-item-name ">
                                        <input type="text" name="due_amount" id="due_amount" placeholder="Due Amount" step="0.01" readonly>
                                    </div>
                                </div>

                                <div class="col-md-12" id="slip-upload-field" style="display: none;">
                                    <h6>Upload Transfer Slip</h6>
                                    <div class="input-item">
                                        <input type="file" name="transfer_slip_image" id="transfer_slip_image" class="btn theme-btn-3 " accept="image/*">
                                    </div>
                                </div>

                                <!-- Submit Button -->
                                <div class="ltn__car-dealer-form-item col-md-12 mt-4">
                                    <div class="btn-wrapper text-center mt-0">
                                        <button type="submit" id="submit-button" class="btn theme-btn-1 btn-effect-1 text-uppercase">Submit</button>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
</div>
<!-- Include jQuery (make sure it's before nice-select JS) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- SweetAlert2 CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<!-- SweetAlert2 JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    $(document).ready(function() {

        let totalRoomCharge;
        let serviceCharge;
        let refundableCharge = 0;
        let totalAmount;

        var totalDays = parseInt('{{ $totalDays }}');
        var term = "{{ $term }}";

        $('#room-select').on('change', function() {
            const selectedRoomId = this.value;

            if (selectedRoomId) {
                const roomPrice = $('#room-select option:selected').data('price');

                totalRoomCharge = roomPrice * totalDays;

                const amountInput = document.querySelector('input[name="amount"]');
                const serviceChargeInput = document.querySelector('input[name="service_charge"]');
                const refundableChargeInput = document.querySelector('input[name="refundable"]');
                const totalAmountInput = document.querySelector('input[name="total_amount"]');

                serviceCharge = totalRoomCharge * 0.1; // 10% service charge

                if (term == 'Long-Term') {
                    refundableCharge = totalRoomCharge * 0.5; // 50% refundable charge
                }

                totalAmount = totalRoomCharge + serviceCharge + refundableCharge;

                amountInput.value = `LKR ${totalRoomCharge.toFixed(2)}`;
                serviceChargeInput.value = `LKR ${serviceCharge.toFixed(2)}`;
                refundableChargeInput.value = `LKR ${refundableCharge.toFixed(2)}`;
                totalAmountInput.value = `LKR ${totalAmount.toFixed(2)}`;

                calculateDueAmounts();
            }
        });

        var dueAmount;

        function calculateDueAmounts() {
            const amountPaidInput = document.getElementById('amount_paid');
            const dueAmountInput = document.getElementById('due_amount');
            dueAmountInput.value = totalAmount.toFixed(2);

            amountPaidInput.addEventListener('input', function() {
                const amountPaid = parseFloat(amountPaidInput.value) || 0;
                dueAmount = totalAmount - amountPaid;
                dueAmountInput.value = dueAmount.toFixed(2);
            });
        }



        $('#payment_type').on('change', function() {
            const slipUploadField = document.getElementById('slip-upload-field');
            const amountPaid = document.getElementById('paid_amount_box');
            const dueValue = document.getElementById('due_amount');

            // if (this.value === 'Bank Transfer') {
            //     slipUploadField.style.display = 'none';
            //     amountPaid.style.display = 'none';
            // } else {
            //     slipUploadField.style.display = 'none';
            // }
            if (this.value === 'At Hotel') {
                amountPaid.style.display = 'none';
                dueValue.value = totalAmount.toFixed(2);
            } else if (this.value === 'Bank Transfer') {
                amountPaid.style.display = 'none';
                dueValue.value = totalAmount.toFixed(2);
            } else {
                amountPaid.style.display = 'block';
                document.querySelector('input[name="amount_paid"]').value = '';
            }
        });



        $('#submit-button').on('click', function(e) {
            e.preventDefault();

            Swal.fire({
                title: 'Are you sure you want to proceed with the booking?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, confirm!',
                cancelButtonText: 'No, cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    const selectedRoomId = $('#room-select').val();
                    const paymentType = $('#payment_type').val();
                    let amountPaid = $('#amount_paid').val();
                    let dueAmount;

                    if (paymentType == 'At Hotel' || paymentType == 'Bank Transfer') {
                        amountPaid = 0;
                        dueAmount = 0;
                    } else {
                        dueAmount = parseFloat(totalAmount) - parseFloat(amountPaid || 0);
                    }

                    const checkin = $('#checkin').val();
                    const checkout = $('#checkout').val();
                    const transferSlipImage = $('#transfer_slip_image').val();

                    $.ajax({
                        url: "{{route('onlinebooking.store')}}",
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            room_id: selectedRoomId,
                            payment_type: paymentType,
                            amount: totalRoomCharge,
                            paid_amount: amountPaid,
                            due_amount: dueAmount,
                            service_charge: serviceCharge,
                            refundable_charge: refundableCharge,
                            total_cost: totalAmount,
                            checkin: checkin,
                            checkout: checkout,
                            total_days: totalDays,
                            term: term,
                            transfer_slip_image: transferSlipImage
                        },
                        success: function(response) {
                            // Success message with booking ID and page reload
                            Swal.fire({
                                title: 'Booking Number - OB' + response.booking_id,
                                text: 'Booking & payment details saved successfully!',
                                icon: 'success',
                                confirmButtonText: 'OK'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    location.reload();
                                }
                            });
                        },
                        error: function(xhr, status, error) {
                            var errorMessage = xhr.responseJSON ? xhr.responseJSON.message : 'An unexpected error occurred. Please try again.';
                            Swal.fire({
                                title: 'Error!',
                                text: errorMessage,
                                icon: 'error',
                                confirmButtonText: 'OK'
                            });
                        }
                    });
                }
            });
        });



    });
</script>



@endsection