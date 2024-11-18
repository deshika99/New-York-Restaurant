@extends ('frontend.master')

@section('content')


<div class="ltn__utilize-overlay"></div>



<!-- BREADCRUMB AREA START -->
<div class="ltn__breadcrumb-area text-left bg-overlay-white-30 ">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="ltn__breadcrumb-inner">
                    <h1 class="page-title">About Us</h1>
                    <div class="ltn__breadcrumb-list">
                        <ul>
                            <li><a href="{{route('home')}}"><span class="ltn__secondary-color"><i class="fas fa-home"></i></span> Home</a></li>
                            <li>About Us</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- BREADCRUMB AREA END -->



<!-- ABOUT US AREA START -->
<div class="ltn__about-us-area pt-120--- pb-90 mt--30">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 align-self-center">
                <div class="about-us-img-wrap about-img-left">
                    <img src="/frontend/img/others/ab1.webp" alt="About Us Image">
                    <div class="about-us-img-info about-us-img-info-2 about-us-img-info-3">
                        <div class="ltn__video-img ltn__animation-pulse1">
                            <img src="/frontend/img/others/ab2.jpg" alt="video popup bg image">
                            <a class="ltn__video-icon-2 ltn__video-icon-2-border---" href="" data-rel="lightcase:myCollection">
                                <i class="fa fa-play"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 align-self-center">
                <div class="about-us-info-wrap">
                    <div class="section-title-area ltn__section-title-2--- mb-20">
                        <h6 class="section-subtitle section-subtitle-2 ltn__secondary-color">About Us</h6>
                        <h1 class="section-title">New York Guest House & Restaurant<span>.</span></h1>
                        <p>Welcome to New York Guest House & Restaurant, a luxurious sanctuary in the heart of the city. Offering elegant rooms, spacious apartments, and world-class amenities, we provide a memorable stay for every guest.</p>
                    </div>
                    <ul class="ltn__list-item-half clearfix">
                        <li>
                            <i class="flaticon-home-2"></i>
                            Elegant Room Design
                        </li>
                        <li>
                            <i class="flaticon-mountain"></i>
                            Scenic City Views
                        </li>
                        <li>
                            <i class="flaticon-heart"></i>
                            Exclusive Amenities
                        </li>
                        <li>
                            <i class="flaticon-secure"></i>
                            24/7 Guest Security
                        </li>
                    </ul>
                    <div class="ltn__callout bg-overlay-theme-05 mt-30">
                        <p>"Experience unmatched hospitality and comfort in our premium accommodations."</p>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ABOUT US AREA END -->








<!-- FEATURE AREA START (Feature - 6) -->
<div class="ltn__feature-area section-bg-1 pt-120 pb-90 mb-120---">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title-area ltn__section-title-2--- text-center">
                    <h6 class="section-subtitle section-subtitle-2 ltn__secondary-color">Our Services</h6>
                    <h1 class="section-title">Our Main Offerings</h1>
                </div>
            </div>
        </div>
        <div class="row ltn__custom-gutter--- justify-content-center">
            <div class="col-lg-4 col-sm-6 col-12">
                <div class="ltn__feature-item ltn__feature-item-6 text-center bg-white box-shadow-1">
                    <div class="ltn__feature-icon">
                        <img src="/frontend/img/icons/icon-img/21.png" alt="Apartment Booking">
                    </div>
                    <div class="ltn__feature-info">
                        <h3><a>Book an Apartment</a></h3>
                        <p>Choose from a variety of fully furnished apartments, providing comfort and convenience for your stay.</p>
                        <!-- <a class="ltn__service-btn" href="service-details.html">View Apartments <i class="flaticon-right-arrow"></i></a> -->
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-sm-6 col-12">
                <div class="ltn__feature-item ltn__feature-item-6 text-center bg-white box-shadow-1 active">
                    <div class="ltn__feature-icon">
                        <img src="/frontend/img/icons/icon-img/22.png" alt="Room Booking">
                    </div>
                    <div class="ltn__feature-info">
                        <h3><a >Book a Room</a></h3>
                        <p>Find a great room that suits your needs, with options ranging from budget to luxury accommodations.</p>
                        <!-- <a class="ltn__service-btn" href="service-details.html">Explore Rooms <i class="flaticon-right-arrow"></i></a> -->
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-sm-6 col-12">
                <div class="ltn__feature-item ltn__feature-item-6 text-center bg-white box-shadow-1">
                    <div class="ltn__feature-icon">
                        <img src="/frontend/img/icons/icon-img/23.png" alt="Event Hosting">
                    </div>
                    <div class="ltn__feature-info">
                        <h3><a >Host an Event</a></h3>
                        <p>Our facilities are equipped to host your events of all kinds, from business conferences to weddings.</p>
                        <!-- <a class="ltn__service-btn" href="service-details.html">Discover Venues <i class="flaticon-right-arrow"></i></a> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- FEATURE AREA END -->








@endsection