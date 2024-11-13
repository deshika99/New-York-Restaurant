@extends ('frontend.master')

@section('content')

<div class="ltn__utilize-overlay"></div>

<!-- BREADCRUMB AREA START -->
<div class="ltn__breadcrumb-area text-left bg-overlay-white-30 bg-image " data-bs-bg="">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="ltn__breadcrumb-inner">
                    <h1 class="page-title">Contact Us</h1>
                    <div class="ltn__breadcrumb-list">
                        <ul>
                            <li><a href="index.html"><span class="ltn__secondary-color"><i class="fas fa-home"></i></span> Home</a></li>
                            <li>Contact</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- BREADCRUMB AREA END -->

<!-- CONTACT ADDRESS AREA START -->
<div class="ltn__contact-address-area mb-90">
    <div class="container">
        <div class="row">
            <div class="col-lg-4">
                <div class="ltn__contact-address-item ltn__contact-address-item-3 box-shadow">
                    <div class="ltn__contact-address-icon">
                        <img src="frontend/img/icons/10.png" alt="Icon Image">
                    </div>
                    <h3>Email Address</h3>
                    <p>{{ $companyDetails->email ?? '' }}</p>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="ltn__contact-address-item ltn__contact-address-item-3 box-shadow">
                    <div class="ltn__contact-address-icon">
                        <img src="frontend/img/icons/11.png" alt="Icon Image">
                    </div>
                    <h3>Phone Number</h3>
                    <p>{{ $companyDetails->contact ?? '' }}</p>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="ltn__contact-address-item ltn__contact-address-item-3 box-shadow">
                    <div class="ltn__contact-address-icon">
                        <img src="frontend/img/icons/12.png" alt="Icon Image">
                    </div>
                    <h3>Office Address</h3>
                    <p>{{ $companyDetails->address ?? '' }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- CONTACT ADDRESS AREA END -->

<!-- CONTACT MESSAGE AREA START -->
<div class="ltn__contact-message-area mb-120 mb--100">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="ltn__form-box contact-form-box box-shadow white-bg">

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
    </div>
</div>
<!-- CONTACT MESSAGE AREA END -->

<!-- GOOGLE MAP AREA START -->
<div class="google-map mb-120">

    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d9334.271551495209!2d-73.97198251485975!3d40.668170674982946!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c25b0456b5a2e7%3A0x68bdf865dda0b669!2sBrooklyn%20Botanic%20Garden%20Shop!5e0!3m2!1sen!2sbd!4v1590597267201!5m2!1sen!2sbd" width="100%" height="100%" frameborder="0" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>

</div>
<!-- GOOGLE MAP AREA END -->




@endsection