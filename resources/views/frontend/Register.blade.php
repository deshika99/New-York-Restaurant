<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>New York Guest House & Restaurant</title>
    <meta name="robots" content="noindex, follow" />
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Place favicon.png in the root directory -->
    <link rel="shortcut icon" href="{{ asset('/frontend/img/ny logo.jpg') }}" />
    <!-- Font Icons css -->
    <link rel="stylesheet" href="{{asset('frontend/css/font-icons.css')}}">
    <!-- plugins css -->
    <link rel="stylesheet" href="{{asset('frontend/css/plugins.css')}}">
    <!-- Main Stylesheet -->
    <link rel="stylesheet" href="{{asset('frontend/css/style.css')}}">
    <!-- Responsive css -->
    <link rel="stylesheet" href="{{asset('frontend/css/responsive.css')}}">

    <style>
        .logo-container {
            display: flex;
            justify-content: center;

            /* Full viewport height for vertical centering */
        }
    </style>
</head>

<body>
    <!--[if lte IE 9]>
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
    <![endif]-->

    <!-- Add your site or application content here -->

    <!-- Body main wrapper start -->
    <div class="body-wrapper">

        <!-- HEADER AREA START (header-5) -->

        <!-- Utilize Mobile Menu End -->

        <div class="ltn__utilize-overlay"></div>
        @php
        $companyDetails = app(\App\Http\Controllers\SettingsController::class)->getCompanyDetails();
        @endphp

        <div class="logo-container">
            <img style="width:100px; height:100px;" src="{{ Storage::url(optional($companyDetails)->company_logo) }}" alt="Logo">
        </div>

        <!-- BREADCRUMB AREA END -->

        <!-- LOGIN AREA START (Register) -->

        <div class="ltn__login-area pb-110">
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
                                <input type="text" name="email" placeholder="Email">
                                <input type="text" name="phone_number" placeholder="Phone Number">
                                <input type="text" name="address" placeholder="Address">
                                <input type="password" name="password" placeholder="Password">
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
                                <!-- <p>By creating an account, you agree to our:</p>
                                <p><a href="#">TERMS OF CONDITIONS &nbsp; &nbsp; | &nbsp; &nbsp; PRIVACY POLICY</a></p> -->
                                <div class="go-to-btn mt-50">
                                    <a href="{{route('loginpage')}}">ALREADY HAVE AN ACCOUNT ?</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- LOGIN AREA END -->





    </div>
    <!-- Body main wrapper end -->

    <!-- All JS Plugins -->
    <script src="frontend/js/plugins.js"></script>
    <!-- Main JS -->
    <script src="frontend/js/main.js"></script>

</body>

</html>