@extends ('frontend.master')

@section('content')


<div class="ltn__utilize-overlay"></div>



<!-- BREADCRUMB AREA START -->
<div class="ltn__breadcrumb-area text-left bg-overlay-white-30 ">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="ltn__breadcrumb-inner">
                    <h1 class="page-title">My Account</h1>
                    <div class="ltn__breadcrumb-list">
                        <ul>
                            <li><a href="{{route('home')}}"><span class="ltn__secondary-color"><i class="fas fa-home"></i></span> Home</a></li>
                            <li>Account</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">

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

            </div>
        </div>
    </div>
</div>
<!-- BREADCRUMB AREA END -->



<!-- WISHLIST AREA START -->
<div class="liton__wishlist-area pb-70 mt--65">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <!-- PRODUCT TAB AREA START -->
                <div class="ltn__product-tab-area">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="ltn__tab-menu-list mb-50">
                                    <div class="nav">

                                        <a class="active show" data-bs-toggle="tab" href="#ltn_tab_1_2">Profiles <i class="fas fa-user"></i></a>
                                        <a data-bs-toggle="tab" href="#ltn_tab_1_5">My Bookings <i class="fa-solid fa-calendar"></i></a>
                                        <a data-bs-toggle="tab" href="#ltn_tab_1_4">Update Details <i class="fas fa-edit"></i></a>
                                        <a data-bs-toggle="tab" href="#ltn_tab_1_9">Change Password <i class="fa-solid fa-lock"></i></a>
                                        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                            Logout <i class="fas fa-sign-out-alt"></i>                    
                                        </a>      

                                        <form id="logout-form" action="{{ route('logout') }}" method="GET" style="display: none;">
                                            @csrf
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-8">
                                <div class="tab-content">

                                    <div class="tab-pane fade active show" id="ltn_tab_1_2">
                                        <div class="ltn__myaccount-tab-content-inner">
                                            <!-- comment-area -->
                                            <div class="ltn__comment-area mb-50">
                                                <div class="ltn-author-introducing clearfix">
                                                    <!-- <div class="author-img">
                                                            <img src="img/blog/author.jpg" alt="Author Image">
                                                        </div> -->
                                                    <div class="author-info">
                                                        <h2>{{$customer->fname}} {{$customer->lname}}</h2>
                                                        <div class="footer-address">
                                                            <ul>
                                                                <li>
                                                                    <div class="footer-address-icon">
                                                                        <i class="icon-placeholder"></i>
                                                                    </div>
                                                                    <div class="footer-address-info">
                                                                        <p>{{$customer->address}}</p>
                                                                    </div>
                                                                </li>
                                                                <li>
                                                                    <div class="footer-address-icon">
                                                                        <i class="icon-call"></i>
                                                                    </div>
                                                                    <div class="footer-address-info">
                                                                        <p>{{$customer->phone_number}}</p>
                                                                    </div>
                                                                </li>
                                                                <li>
                                                                    <div class="footer-address-icon">
                                                                        <i class="icon-mail"></i>
                                                                    </div>
                                                                    <div class="footer-address-info">
                                                                        <p>{{$customer->email}}</p>
                                                                    </div>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="tab-pane fade" id="ltn_tab_1_5">
                                        <div class="ltn__myaccount-tab-content-inner">
                                            <div class="ltn__my-properties-table table-responsive">
                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">Booking Number</th>
                                                            <th scope="col">Booking Date</th>
                                                            <th scope="col">Payment Status</th>
                                                            <th scope="col">Booking Status</th>
                                                            <th scope="col">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($bookings as $booking)
                                                        <tr>
                                                            <td>OB{{$booking->id}}</td>
                                                            <td>{{$booking->booking_date}}</td>
                                                            <td>{{$booking->payment->payment_status}}</td>
                                                            <td>{{$booking->booking_status}}</td>
                                                            <td>
                                                                <button class="btn btn-link toggle-details" data-id="{{$booking->id}}">
                                                                    <i class="fas fa-chevron-down"></i>
                                                                </button>
                                                            </td>
                                                        </tr>

                                                        <tr id="details-{{$booking->id}}" class="details-row" style="display: none;">
                                                            <td colspan="5">
                                                                <div class="p-3 bg-light">
                                                                    <h6>Date Schedule:</h6>
                                                                    Booking Date: {{$booking->booking_date}} <br>
                                                                    Check-in Date: {{$booking->start_date}}<br>
                                                                    Check-out Date: {{$booking->end_date}}<br>
                                                                    Booking Term: {{$booking->term}}<br>

                                                                    <h6 class="mt-3">Room Details</h6>
                                                                    Room Number: {{$booking->room->room_number}}<br>
                                                                    Room Type: {{$booking->room->roomType->type_name}}<br>
                                                                    Apartment: {{$booking->room->apartment->apartment_name}}<br>
                                                                    Rental Price: LKR {{$booking->room->rental_price}}<br>

                                                                    <h6 class="mt-3">Charges</h6>
                                                                    Total Room Charge: LKR {{$booking->payment->total_room_charge}}<br>
                                                                    Service Charge: LKR {{$booking->service_charge ?? '0'}}<br>
                                                                    Refundable Charge: LKR {{$booking->payment->refundable_amount ?? '0'}}<br>
                                                                    Total Cost: LKR {{$booking->payment->total_amount}}<br>

                                                                    <h6 class="mt-3">Payment</h6>
                                                                    Payment Type: {{$booking->payment->payment_type}}<br>
                                                                    Payment Date: {{$booking->payment->payment_date}}<br>
                                                                    Paid Amount: LKR {{$booking->payment->paid_amount ?? '0'}}<br>
                                                                    Due Amount: LKR {{$booking->payment->due_amount ?? '0'}}<br>

                                                                    <h6 class="mt-3">Status</h6>
                                                                    Payment Status: {{$booking->payment->payment_status}} <br />
                                                                    Refund Status: {{$booking->payment->refund_status}} <br />
                                                                    Bank Transfer Status: {{$booking->confirmation_status}} <br />
                                                                    Booking Status: {{$booking->booking_status}}
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="tab-pane fade" id="ltn_tab_1_4">
                                        <div class="ltn__myaccount-tab-content-inner">
                                            <div class="ltn__form-box">
                                                <form action="{{route('updateCusProfile',$customer->id)}}" method="POST">
                                                    @csrf
                                                    <div class="row mb-50">
                                                        <div class="col-md-6">
                                                            <label>First name:</label>
                                                            <input type="text" name="fname" placeholder="Enter first name" value="{{$customer->fname}}" required>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label>Last name:</label>
                                                            <input type="text" name="lname" placeholder="Enter last name" value="{{$customer->lname}}" required>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label>Contact Number:</label>
                                                            <input type="text" name="contact" placeholder="Enter contact number" value="{{$customer->phone_number ?? ''}}" required>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label>Email:</label>
                                                            <input type="email" name="email" placeholder="Enter email address" value="{{$customer->email ?? ''}}" required>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <label>Address:</label>
                                                            <input type="text" name="address" placeholder="Enter address" value="{{$customer->address ?? ''}}">
                                                        </div>
                                                    </div>
                                                    <div class="btn-wrapper">
                                                        <button type="submit" class="btn theme-btn-1 btn-effect-1 text-uppercase">Save Changes</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="tab-pane fade" id="ltn_tab_1_9">
                                        <div class="ltn__myaccount-tab-content-inner">
                                            <div class="account-login-inner">
                                                <form action="#" class="ltn__form-box contact-form-box">
                                                    <h5 class="mb-30">Change Password</h5>
                                                    <input type="password" name="password" placeholder="Current Password*">
                                                    <input type="password" name="password" placeholder="New Password*">
                                                    <input type="password" name="password" placeholder="Confirm New Password*">
                                                    <div class="btn-wrapper mt-0">
                                                        <button class="theme-btn-1 btn btn-block" type="submit">Save Changes</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- PRODUCT TAB AREA END -->
            </div>
        </div>
    </div>
</div>
<!-- WISHLIST AREA START -->



<!-- Include jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('.toggle-details').on('click', function() {
            const bookingId = $(this).data('id');
            const detailsRow = $('#details-' + bookingId);
            const icon = $(this).find('i');

            detailsRow.toggle();
            icon.toggleClass('fa-chevron-down fa-chevron-up');
        });
    });
</script>





@endsection