@extends('AdminDashboard.master')

@section('content')
<!DOCTYPE html>
<html lang="en">

<body>
    <!-- Flash messages -->
    @if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
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

    <section class="content-main">
        <div class="content-header">
            <h2 class="content-title card-title">Booking Details</h2>
            <a href="{{route('viewOnlineBookings')}}" class="btn btn-dark font-sm"><i class="material-icons md-arrow_back"></i></a>
        </div>
        <div class="content-header">
            <h4 class="">Booking ID: OB{{$booking->id}}</h4>
            <a href="{{route('bookingPrint',$booking->id)}}" class="btn btn-success font-sm"><i class="material-icons md-print"></i></a>
        </div>
        <!-- Room Type Form -->
        <div class="card">
            <div class="card-body">
                <div class="row mb-50 mt-20 order-info-wrap">

                    <div class="col-md-4">
                        <article class="icontext align-items-start">
                            <span class="icon icon-sm rounded-circle bg-primary-light">
                                <i class="text-primary material-icons md-person"></i>
                            </span>
                            <div class="text">
                                <h6 class="mb-1">Customer</h6>
                                <p class="mb-1">
                                    Name: {{$booking->customer->fname}} {{$booking->customer->lname}} <br />
                                    Contact: {{$booking->customer->phone_number}} <br />
                                    Email: {{$booking->customer->email}} <br />
                                    Address: {{$booking->customer->address}}
                                </p>
                            </div>
                        </article>
                    </div>

                    <div class="col-md-4">
                        <article class="icontext align-items-start">
                            <span class="icon icon-sm rounded-circle bg-primary-light">
                                <i class="text-primary material-icons md-schedule"></i>
                            </span>
                            <div class="text">
                                <h6 class="mb-1">Dates</h6>
                                <p class="mb-1">
                                    Booking Date: {{$booking->booking_date}} <br />
                                    Checkin-Date: {{$booking->start_date}} <br />
                                    Checkout-Date: {{$booking->end_date}} <br />
                                    Booking Term: {{$booking->term}}
                                </p>
                            </div>
                        </article>
                    </div>

                    <div class="col-md-4">
                        <article class="icontext align-items-start">
                            <span class="icon icon-sm rounded-circle bg-primary-light">
                                <i class="text-primary material-icons md-domain"></i>
                            </span>
                            <div class="text">
                                <h6 class="mb-1">Room</h6>
                                <p class="mb-1">
                                    Room Number: {{$booking->room->room_number}} <br />
                                    Room Type: {{$booking->room->roomType->type_name}} <br />
                                    Apartment: {{$booking->room->apartment->apartment_name}} <br />
                                    Rental Price: LKR {{$booking->room->rental_price}}
                                </p>
                            </div>
                        </article>
                    </div>

                    <div class="col-md-4 mt-3">
                        <article class="icontext align-items-start">
                            <span class="icon icon-sm rounded-circle bg-primary-light">
                                <i class="text-primary material-icons md-monetization_on"></i>
                            </span>
                            <div class="text">
                                <h6 class="mb-1">Charges</h6>
                                <p class="mb-1">
                                    Total Room Charge: LKR {{$booking->payment->total_room_charge}} <br />
                                    Service Charge: LKR {{$booking->service_charge ?? '0'}} <br />
                                    Refundable Charge: LKR {{$booking->payment->refundable_amount ?? '0'}} <br />
                                    Total Cost: LKR {{$booking->payment->total_amount}}
                                </p>
                            </div>
                        </article>
                    </div>

                    <div class="col-md-4 mt-3">
                        <article class="icontext align-items-start">
                            <span class="icon icon-sm rounded-circle bg-primary-light">
                                <i class="text-primary material-icons md-payment"></i>
                            </span>
                            <div class="text">
                                <h6 class="mb-1">Payment</h6>
                                <p class="mb-1">
                                    Payment Type: {{$booking->payment->payment_type}} <br />
                                    Payment Date: {{$booking->payment->payment_date}} <br />
                                    Paid Amount: LKR {{$booking->payment->paid_amount ?? '0'}} <br />
                                    Due Amount: LKR {{$booking->payment->due_amount ?? '0'}}
                                </p>

                            </div>
                        </article>
                    </div>

                    <div class="col-md-4 mt-3">
                        <article class="icontext align-items-start">
                            <span class="icon icon-sm rounded-circle bg-primary-light">
                                <i class="text-primary material-icons md-playlist_add_check"></i>
                            </span>
                            <div class="text">
                                <h6 class="mb-1">Status</h6>
                                <p class="mb-1">
                                    Payment Status: {{$booking->payment->payment_status}} <br />
                                    Refund Status: {{$booking->payment->refund_status}} <br />
                                    Bank Transfer Status: {{$booking->confirmation_status}} <br />
                                    Booking Status: {{$booking->booking_status}}
                                </p>

                            </div>
                        </article>
                    </div>



                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4 offset-md-4">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <form action="{{ route('updatePayment',$booking->payment->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="mb-4 col-md-12">
                                            <label for="amount_paid" class="form-label">Amount Paid (LKR)<span class="text-danger">*</span></label>
                                            <input type="text" placeholder="Type Amount" class="form-control" id="amount_paid" name="amount_paid" required />
                                        </div>
                                        <div class="mb-4 col-md-12">
                                            <label for="due_amount" class="form-label">Due Amount (LKR)<span class="text-danger">*</span></label>
                                            <input type="text" placeholder="Type Amount" class="form-control" value="{{$booking->payment->due_amount}}" id="due_amount" name="due_amount" required readonly />
                                        </div>
                                        <div class="mb-4 col-md-12">
                                            <label for="payment_type" class="form-label">Payment Type<span class="text-danger">*</span></label>
                                            <select class="form-select" id="payment_type" name="payment_type" required>
                                                <option value="Cash">Cash</option>
                                                <option value="Card">Card</option>
                                                <option value="Bank Transfer">Bank Transfer</option>
                                            </select>
                                        </div>

                                    </div>
                                    <div class="d-grid col-md-12">
                                        <button type="submit" class="btn btn-primary">Update Payments</button>
                                    </div>
                                </form>
                            </div>

                        </div>
                        <!-- .row // -->
                    </div>
                    <!-- card body .// -->
                </div>
            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <form action="{{ route('updateStatus',$booking->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="mb-4 col-md-12">
                                            <label for="refund_status" class="form-label">Refund Status<span class="text-danger">*</span></label>
                                            <select class="form-select" id="refund_status" name="refund_status" required>
                                                <option value="Pending" {{ $booking->payment->refund_status == 'Pending' ? 'selected' : '' }}>Pending</option>
                                                <option value="Refunded" {{ $booking->payment->refund_status == 'Refunded' ? 'selected' : '' }}>Refunded</option>
                                                <option value="No Charge" {{ $booking->payment->refund_status == 'No Charge' ? 'selected' : '' }}>No Charge</option>
                                            </select>
                                        </div>
                                        <div class="mb-4 col-md-12">
                                            <label for="bank_transfer_status" class="form-label">Bank Transfer Status<span class="text-danger">*</span></label>
                                            <select class="form-select" id="bank_transfer_status" name="bank_transfer_status" required>
                                                <option value="Confirmed" {{ $booking->confirmation_status == 'Confirmed' ? 'selected' : '' }}>Confirmed</option>
                                                <option value="Awaiting Bank Slip" {{ $booking->confirmation_status == 'Awaiting Bank Slip' ? 'selected' : '' }}>Awaiting Bank Slip</option>
                                                <option value="Not Relevant" {{ $booking->confirmation_status == 'Not Relevant' ? 'selected' : '' }}>Not Relavant</option>
                                            </select>
                                        </div>
                                        <div class="mb-4 col-md-12">
                                            <label for="booking_status" class="form-label">Booking Status<span class="text-danger">*</span></label>
                                            <select class="form-select" id="booking_status" name="booking_status" required>
                                                <option value="Pending" {{ $booking->booking_status == 'Pending' ? 'selected' : '' }}>Pending</option>
                                                <option value="Confirmed" {{ $booking->booking_status == 'Confirmed' ? 'selected' : '' }}>Confirmed</option>
                                                <option value="Canceled" {{ $booking->booking_status == 'Canceled' ? 'selected' : '' }}>Canceled</option>
                                            </select>
                                        </div>

                                    </div>
                                    <div class="d-grid col-md-12 ">
                                        <button type="submit" class="btn btn-primary">Update Status</button>
                                    </div>
                                </form>
                            </div>

                        </div>
                        <!-- .row // -->
                    </div>
                    <!-- card body .// -->
                </div>
            </div>
        </div>


    </section>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const totalAmount = ('{{ $booking->payment->due_amount ?? 0 }}');
            const amountPaidInput = document.getElementById('amount_paid');
            const dueAmountInput = document.getElementById('due_amount');

            // Update due amount on typing
            amountPaidInput.addEventListener('input', function() {
                const amountPaid = parseFloat(amountPaidInput.value) || 0;
                const dueAmount = totalAmount - amountPaid;

                dueAmountInput.value = dueAmount >= 0 ? dueAmount.toFixed(2) : '0.00';
            });
        });
    </script>



    <script src="backend/assets/js/vendors/jquery-3.6.0.min.js"></script>
    <script src="backend/assets/js/vendors/bootstrap.bundle.min.js"></script>
    <script src="backend/assets/js/vendors/select2.min.js"></script>
    <script src="backend/assets/js/vendors/perfect-scrollbar.js"></script>
    <script src="backend/assets/js/vendors/jquery.fullscreen.min.js"></script>
    <script src="backend/assets/js/main.js?v=6.0" type="text/javascript"></script>
</body>

</html>
@endsection