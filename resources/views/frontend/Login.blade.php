<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Quarter - Real Estate HTML Template</title>
    <meta name="robots" content="noindex, follow" />
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Place favicon.png in the root directory -->
    <link rel="shortcut icon" href="{{ asset('/frontend/img/ny logo.jpg') }}" />
    <!-- Font Icons css -->
    <link rel="stylesheet" href="frontend/css/font-icons.css">
    <!-- plugins css -->
    <link rel="stylesheet" href="frontend/css/plugins.css">
    <!-- Main Stylesheet -->
    <link rel="stylesheet" href="frontend/css/style.css">
    <!-- Responsive css -->
    <link rel="stylesheet" href="frontend/css/responsive.css">
</head>


@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
    </div>
@endif

@if (session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('error') }}
    </div>
@endif

<body>
    <!--[if lte IE 9]>
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
    <![endif]-->

    <!-- Add your site or application content here -->

<!-- Body main wrapper start -->
<div class="body-wrapper">

    <!-- HEADER AREA START (header-5) -->
    @include('frontend.header')
    <!-- Utilize Mobile Menu End -->

    <div class="ltn__utilize-overlay"></div>

    <!-- BREADCRUMB AREA START -->
    <div class="ltn__breadcrumb-area text-left bg-overlay-white-30 bg-image "  data-bs-bg="frontend/img/bg/14.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ltn__breadcrumb-inner">
                        <h1 class="page-title">Account</h1>
                        <div class="ltn__breadcrumb-list">
                            <ul>
                                <li><a href="index.html"><span class="ltn__secondary-color"><i class="fas fa-home"></i></span> Home</a></li>
                                <li>Login</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- BREADCRUMB AREA END -->

    <!-- LOGIN AREA START -->

    <div class="ltn__login-area pb-65">
        @if (session()->has("success"))
    <div class="alert alert-warning alert-dismissible fade show" role="alert" width="300px">
        {{ session()->get("success") }}
    </div>
@endif
@if (session()->has("error"))
    <div class="alert alert-warning alert-dismissible fade show" role="alert" width="300px">
        {{ session()->get("error") }}
    </div>
@endif

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title-area text-center">
                        <h1 class="section-title">Sign In <br>To  Your Account</h1>
                        <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. <br>
                             Sit aliquid,  Non distinctio vel iste.</p>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6">
                    <div class="account-login-inner">
                    <form action="{{ route('loginvalidate') }}" method="POST" class="ltn__form-box contact-form-box">
                        @csrf
                        <input type="text" name="email" placeholder="Email*" required>
                        <input type="password" name="password" placeholder="Password*" required>
                        <div class="btn-wrapper mt-0">
                            <button class="theme-btn-1 btn btn-block" type="submit">SIGN IN</button>
                        </div>
                        <div class="go-to-btn mt-20">
                            <a href="#" title="Forgot Password?" data-bs-toggle="modal" data-bs-target="#ltn_forget_password_modal">
                                <small>FORGOTTEN YOUR PASSWORD?</small>
                            </a>
                        </div>
                    </form>

                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="account-create text-center pt-50">
                        <h4>DON'T HAVE AN ACCOUNT?</h4>
                        <p>Add items to your wishlistget personalised recommendations <br>
                            check out more quickly track your orders register</p>
                        <div class="btn-wrapper">
                            <a href="{{ 'registerpage' }}"  class="theme-btn-1 btn black-btn">CREATE ACCOUNT</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- LOGIN AREA END -->

    <!-- FOOTER AREA START -->
    @include('frontend.footer')
    <!-- FOOTER AREA END -->

    <!-- MODAL AREA START (Reset Password Modal) -->
    <div class="ltn__modal-area ltn__add-to-cart-modal-area----">
        <div class="modal fade" id="ltn_forget_password_modal" tabindex="-1">
            <div class="modal-dialog modal-md" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="ltn__quick-view-modal-inner">
                            <div class="modal-product-item">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="modal-product-info text-center">
                                            <h4>FORGET PASSWORD?</h4>
                                            <p class="added-cart"> Enter you register email.</p>
                                            <form action="#" class="ltn__form-box">
                                                <input type="text" name="email" placeholder="Type your register email*">
                                                <div class="btn-wrapper mt-0">
                                                    <button class="theme-btn-1 btn btn-full-width-2" type="submit">Submit</button>
                                                </div>
                                            </form>
                                        </div>
                                        <!-- additional-info -->
                                        <div class="additional-info d-none">
                                            <p>We want to give you <b>10% discount</b> for your first order, <br>  Use discount code at checkout</p>
                                            <div class="payment-method">
                                                <img src="frontend/img/icons/payment.png" alt="#">
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
    </div>
    <!-- MODAL AREA END -->

</div>
<!-- Body main wrapper end -->

    <!-- All JS Plugins -->
    <script src="frontend/js/plugins.js"></script>
    <!-- Main JS -->
    <script src="frontend/js/main.js"></script>

</body>
</html>

