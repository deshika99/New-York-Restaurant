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
                                <li>Register</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- BREADCRUMB AREA END -->

    <!-- LOGIN AREA START (Register) -->

    <div class="ltn__login-area pb-110">
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
                        <h1 class="section-title">Register <br>Your Account</h1>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6 offset-lg-3">             
                    <div class="account-login-inner">
                        <form action="{{route('registerpage.user')}}" method="post" class="ltn__form-box contact-form-box">
                        @csrf
                            <input type="text" name="fname" placeholder="First Name">
                            <input type="text" name="lname" placeholder="Last Name">
                            <input type="text" name="email" placeholder="Email*">
                            <input type="text" name="phone_number" placeholder="Phone Number">
                            <input type="text" name="address" placeholder="Address">
                            <input type="password" name="password" placeholder="Password*">
                           <!-- <input type="password" name="confirmpassword" placeholder="Confirm Password*">-->
                            
                            <label class="checkbox-inline">           
                                <input type="checkbox" value="">       
                                By clicking "create account", I consent to the privacy policy.
                            </label>
                            <div class="btn-wrapper">
                                <button class="theme-btn-1 btn reverse-color btn-block" type="submit">CREATE ACCOUNT</button>
                            </div>
                        </form>
                        <div class="by-agree text-center">
                            <p>By creating an account, you agree to our:</p>
                            <p><a href="#">TERMS OF CONDITIONS  &nbsp; &nbsp; | &nbsp; &nbsp;  PRIVACY POLICY</a></p>
                            <div class="go-to-btn mt-50">
                                <a href="{{route('loginpage')}}" >ALREADY HAVE AN ACCOUNT ?</a>
                            </div>
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

</div>
<!-- Body main wrapper end -->

    <!-- All JS Plugins -->
    <script src="frontend/js/plugins.js"></script>
    <!-- Main JS -->
    <script src="frontend/js/main.js"></script>

</body>
</html>

