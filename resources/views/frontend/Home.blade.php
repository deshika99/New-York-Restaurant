@extends ('frontend.master')

@section('content')


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



<div class="ltn__utilize-overlay"></div>

<!-- SLIDER AREA START (slider-3) -->
<div class="ltn__slider-area ltn__slider-3 section-bg-1">
    <div class="ltn__slide-one-active slick-slide-arrow-1 slick-slide-dots-1">
        <!-- ltn__slide-item -->
        <div class="ltn__slide-item ltn__slide-item-2 ltn__slide-item-3-normal ltn__slide-item-3">
            <div class="ltn__slide-item-inner">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 align-self-center">
                            <div class="slide-item-info">
                                <div class="slide-item-info-inner ltn__slide-animation">
                                    <h6 class="slide-sub-title white-color--- animated"><span><i class="fas fa-bed"></i></span> New York Guest House & Restaurant</h6>
                                    <h1 class="slide-title animated">Discover Your Perfect <br> Stay With Us</h1>
                                    <div class="slide-brief animated">
                                        <p>Experience luxury, comfort, and convenience at New York Guest House & Restaurant. Book your room or apartment for an unforgettable stay in the heart of the city.</p>
                                    </div>
                                    <div class="btn-wrapper animated">
                                        <a href="{{route('makebooking')}}" class="theme-btn-1 btn btn-effect-1">Make A Reservation ⇩</a>
                                        <a href="{{route('facilities')}}" class="btn btn-transparent btn-effect-3">Facilities</a>
                                    </div>
                                </div>
                            </div>
                            <div class="slide-item-img">
                                <img src="/frontend/img/slider/slider2.jpg" alt="Hotel Room Image">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- ltn__slide-item -->
        <div class="ltn__slide-item ltn__slide-item-2 ltn__slide-item-3-normal ltn__slide-item-3">
            <div class="ltn__slide-item-inner text-right text-end">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 align-self-center">
                            <div class="slide-item-info">
                                <div class="slide-item-info-inner ltn__slide-animation">
                                    <h6 class="slide-sub-title white-color--- animated"><span><i class="fas fa-utensils"></i></span> New York Guest House & Restaurant</h6>
                                    <h1 class="slide-title animated">Luxury & Comfort <br> Awaits You</h1>
                                    <div class="slide-brief animated">
                                        <p>Indulge in elegance and style with premium rooms and fine dining. Our guest services ensure an exceptional stay for every guest.</p>
                                    </div>
                                    <div class="btn-wrapper animated">
                                        <a href="{{route('contact')}}" class="theme-btn-1 btn btn-effect-1">Contact Us</a>
                                        <a href="{{route('about')}}" class="btn btn-transparent btn-effect-3">About Us</a>
                                    </div>
                                </div>
                            </div>
                            <div class="slide-item-img slide-img-left">
                                <img src="/frontend/img/slider/slider1.jpg" alt="Apartment Image">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--  -->
    </div>
</div><br>
<!-- SLIDER AREA END -->


<!-- BOOKING FORM AREA START -->
<div class="ltn__car-dealer-form-area mt--65 mt-120 pb-115---">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="ltn__car-dealer-form-tab">
                    <div class="ltn__tab-menu text-uppercase d-none">
                        <div class="nav">
                            <a class="active show" data-bs-toggle="tab" href="#ltn__form_tab_1_1"><i class="fas fa-bed"></i>Find a Room</a>
                            <a data-bs-toggle="tab" href="#ltn__form_tab_1_2"><i class="far fa-building"></i>Find an Apartment</a>
                        </div>
                    </div>
                    <div class="tab-content bg-white box-shadow-1 ltn__border position-relative pb-30">
                        <!-- Tab for Room Search -->
                        <div class="tab-pane fade active show" id="ltn__form_tab_1_1">
                            <div class="car-dealer-form-inner p-3 border rounded">
                                <form action="{{ route('checkAvailability') }}" method="POST" class="ltn__car-dealer-form-box row gx-2 gy-3">
                                    @csrf
                                    <!-- Check-in Date -->
                                    <div class="col-lg-2 col-md-6">
                                        <label for="checkin" class="form-label">Check-in Date</label>
                                        <input type="date" name="checkin" id="checkin" placeholder="Check-in Date" class="form-control">
                                        @error('checkin')
                                        <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <!-- Check-out Date -->
                                    <div class="col-lg-2 col-md-6">
                                        <label for="checkout" class="form-label">Check-out Date</label>
                                        <input type="date" name="checkout" id="checkout" placeholder="Check-out Date" class="form-control">
                                        @error('checkout')
                                        <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <!-- Apartment Selection -->
                                    <div class="col-lg-5 col-md-6">

                                        <select name="apartment" id="apartment" class="nice-select mt-3" >
                                            <option value="" disabled selected>Select Apartment</option>
                                            @foreach($apartments as $apartment)
                                            <option value="{{ $apartment->id }}">{{ $apartment->apartment_name }} - {{ $apartment->location_name }}</option>
                                            @endforeach
                                        </select>
                                        @error('apartment')
                                        <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <!-- Submit Button -->
                                    <div class="col-lg-3 col-md-6 d-flex align-items-end">
                                        <button type="submit" class="btn theme-btn-1 btn-effect-1 w-100 text-uppercase">Find</button>
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
<!-- BOOKING FORM AREA END -->


<!-- ABOUT US AREA START -->
<div class="ltn__about-us-area pt-120 pb-90">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 align-self-center">
                <div class="about-us-img-wrap about-img-left">
                    <img src="/frontend/img/others/ab1.webp" alt="About Us Image">
                    <div class="about-us-img-info about-us-img-info-2 about-us-img-info-3">
                        <div class="ltn__video-img ltn__animation-pulse1">
                            <img src="/frontend/img/others/ab2.jpg" alt="video popup bg image">
                            
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
                    <div class="btn-wrapper animated">
                        <a href="{{route('about')}}" class="theme-btn-1 btn btn-effect-1">About Us</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ABOUT US AREA END -->


<!-- COUNTER UP AREA START -->
<div class="ltn__counterup-area section-bg-1 pt-120 pb-70">
    <div class="container">
        <div class="row">
            <div class="col-md-3 col-sm-6 align-self-center">
                <div class="ltn__counterup-item text-color-white---">
                    <div class="counter-icon">
                        <i class="flaticon-bed"></i>
                    </div>
                    <h1><span class="counter">{{$roomCount}}</span><span class="counterUp-icon">+</span></h1>
                    <h6>Rooms Available</h6> 
                </div>
            </div>
            <div class="col-md-3 col-sm-6 align-self-center">
                <div class="ltn__counterup-item text-color-white---">
                    <div class="counter-icon">
                        <i class="flaticon-building"></i>
                    </div>
                    <h1><span class="counter">{{$apartmentCount}}</span><span class="counterUp-icon">+</span></h1>
                    <h6>Apartments</h6>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 align-self-center">
                <div class="ltn__counterup-item text-color-white---">
                    <div class="counter-icon">
                        <i class="flaticon-house"></i>
                    </div>
                    <h1><span class="counter">{{$bookingCount}}</span><span class="counterUp-icon">+</span></h1>
                    <h6>Guests Served</h6>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 align-self-center">
                <div class="ltn__counterup-item text-color-white---">
                    <div class="counter-icon">
                        <i class="flaticon-heart"></i>
                    </div>
                    <h1><span class="counter">97</span><span class="counterUp-icon">%</span></h1>
                    <h6>Customer Satisfaction</h6>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- COUNTER UP AREA END -->


<!-- ABOUT US AREA START -->
<!-- <div class="ltn__about-us-area pt-120 pb-90 ">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 align-self-center">
                <div class="about-us-info-wrap">
                    <div class="section-title-area ltn__section-title-2--- mb-30">
                        <h6 class="section-subtitle section-subtitle-2 ltn__secondary-color">About Us</h6>
                        <h1 class="section-title">Today Sells Properties</h1>
                        <p>Houzez allow you to design unlimited panels and real estate custom
                            forms to capture leads and keep record of all information</p>
                    </div>
                    <ul class="ltn__list-item-1 ltn__list-item-1-before clearfix">
                        <li> Live Music Cocerts at Luviana</li>
                        <li>Our SecretIsland Boat Tour is Just for You</li>
                        <li>Live Music Cocerts at Luviana</li>
                        <li>Live Music Cocerts at Luviana</li>
                    </ul>
                    <ul class="ltn__list-item-2 ltn__list-item-2-before ltn__flat-info">
                        <li><span>3 <i class="flaticon-bed"></i></span>
                            Bedrooms
                        </li>
                        <li><span>2 <i class="flaticon-clean"></i></span>
                            Bathrooms
                        </li>
                        <li><span>2 <i class="flaticon-car"></i></span>
                            Car parking
                        </li>
                        <li><span>3450 <i class="flaticon-square-shape-design-interface-tool-symbol"></i></span>
                            square Ft
                        </li>
                    </ul>
                    <ul class="ltn__list-item-2 ltn__list-item-2-before--- ltn__list-item-2-img mb-50">
                        <li>
                            <a href="img/img-slide/11.jpg" data-rel="lightcase:myCollection">
                                <img src="/frontend/img/img-slide/11.jpg" alt="Image">
                            </a>
                        </li>
                        <li>
                            <a href="img/img-slide/12.jpg" data-rel="lightcase:myCollection">
                                <img src="/frontend/img/img-slide/12.jpg" alt="Image">
                            </a>
                        </li>
                        <li>
                            <a href="img/img-slide/13.jpg" data-rel="lightcase:myCollection">
                                <img src="/frontend/img/img-slide/13.jpg" alt="Image">
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-6 align-self-center">
                <div class="about-us-img-wrap about-img-right">
                    <img src="/frontend/img/others/9.png" alt="About Us Image">
                </div>
            </div>
        </div>
    </div>
</div> -->
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
                        <h3><a >Book an Apartment</a></h3>
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



<div class="ltn__product-slider-area ltn__product-gutter pt-115 pb-90 plr--7">
    <!-- PRODUCT SLIDER AREA START -->
    
    <!-- PRODUCT SLIDER AREA END -->


    <!-- APARTMENTS PLAN AREA START -->
    <div class="ltn__apartments-plan-area pt-115--- pb-70">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title-area ltn__section-title-2--- text-center">
                        <h6 class="section-subtitle section-subtitle-2 ltn__secondary-color">Apartment Sketch</h6>
                        <h1 class="section-title">Apartments Plan</h1>
                    </div>
                    <div class="ltn__tab-menu ltn__tab-menu-3 ltn__tab-menu-top-right-- text-uppercase--- text-center">
                        <div class="nav">
                            @foreach($roomTypes as $index => $roomType)
                            <a data-bs-toggle="tab" href="#liton_tab_3_{{ $index }}" class="{{ $index == 0 ? 'active show' : '' }}">
                                {{ $roomType->type_name }}
                            </a>
                            @endforeach
                        </div>
                    </div>
                    <div class="tab-content">
                        @foreach($roomTypes as $index => $roomType)
                        <div class="tab-pane fade {{ $index == 0 ? 'active show' : '' }}" id="liton_tab_3_{{ $index }}">
                            <div class="ltn__apartments-tab-content-inner">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="apartments-plan-info ltn__secondary-bg text-color-white">
                                            <h2>{{ $roomType->type_name }}</h2>
                                            <p>{{ $roomType->description }}</p>
                                            <div class="apartments-info-list apartments-info-list-color mt-40">
                                                <!-- <ul>
                                                    <li><label>Total Area</label> <span>2800 Sq. Ft</span></li>
                                                    <li><label>Bedroom</label> <span>150 Sq. Ft</span></li>
                                                    <li><label>Bathroom</label> <span>45 Sq. Ft</span></li>
                                                    <li><label>Belcony/Pets</label> <span>Allowed</span></li>
                                                    <li><label>Lounge</label> <span>650 Sq. Ft</span></li>
                                                </ul> -->
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="apartments-plan-img">
                                            @php
                                            $lastImage = $roomType->last_image; // Use the accessor to get the last image
                                            @endphp
                                            @if($lastImage)
                                            <img src="{{ asset('storage/' . $lastImage) }}" alt="{{ $roomType->type_name }}">
                                            @else
                                            <img src="/path/to/default/image.png" alt="Default Image"> <!-- Default image if none exists -->
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- APARTMENTS PLAN AREA END -->

    <!-- VIDEO AREA START -->
    <!-- <div class="ltn__video-popup-area ltn__video-popup-margin---">
        <div class="ltn__video-bg-img ltn__video-popup-height-600--- bg-overlay-black-30 bg-image bg-fixed ltn__animation-pulse1" data-bs-bg="img/bg/19.jpg">
            <a class="ltn__video-icon-2 ltn__video-icon-2-border---" href="https://www.youtube.com/embed/X7R-q9rsrtU?autoplay=1&showinfo=0" data-rel="lightcase:myCollection">
                <i class="fa fa-play"></i>
            </a>
        </div>
    </div> -->
    <!-- VIDEO AREA END -->

    <!-- CATEGORY AREA START -->
    <!-- <div class="ltn__category-area section-bg-1-- ltn__primary-bg before-bg-1 bg-image bg-overlay-theme-black-5--0 pt-115 pb-90 d-none" data-bs-bg="img/bg/5.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title-area ltn__section-title-2 text-center">
                        <h1 class="section-title white-color">Top Categories</h1>
                    </div>
                </div>
            </div>
            <div class="row ltn__category-slider-active slick-arrow-1">
                <div class="col-12">
                    <div class="ltn__category-item ltn__category-item-4 text-center">
                        <div class="ltn__category-item-img">
                            <a href="shop.html">
                                <i class="flaticon-car"></i>
                            </a>
                        </div>
                        <div class="ltn__category-item-name">
                            <h4><a href="shop.html">Parking Space</a></h4>
                        </div>
                        <div class="ltn__category-item-btn">
                            <a href="shop.html"><i class="flaticon-right-arrow"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="ltn__category-item ltn__category-item-4 text-center">
                        <div class="ltn__category-item-img">
                            <a href="shop.html">
                                <i class="flaticon-car"></i>
                            </a>
                        </div>
                        <div class="ltn__category-item-name">
                            <h4><a href="shop.html">Parking Space</a></h4>
                        </div>
                        <div class="ltn__category-item-btn">
                            <a href="shop.html"><i class="flaticon-right-arrow"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="ltn__category-item ltn__category-item-4 text-center">
                        <div class="ltn__category-item-img">
                            <a href="shop.html">
                                <i class="flaticon-car"></i>
                            </a>
                        </div>
                        <div class="ltn__category-item-name">
                            <h4><a href="shop.html">Parking Space</a></h4>
                        </div>
                        <div class="ltn__category-item-btn">
                            <a href="shop.html"><i class="flaticon-right-arrow"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="ltn__category-item ltn__category-item-4 text-center">
                        <div class="ltn__category-item-img">
                            <a href="shop.html">
                                <i class="flaticon-car"></i>
                            </a>
                        </div>
                        <div class="ltn__category-item-name">
                            <h4><a href="shop.html">Parking Space</a></h4>
                        </div>
                        <div class="ltn__category-item-btn">
                            <a href="shop.html"><i class="flaticon-right-arrow"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="ltn__category-item ltn__category-item-4 text-center">
                        <div class="ltn__category-item-img">
                            <a href="shop.html">
                                <i class="flaticon-car"></i>
                            </a>
                        </div>
                        <div class="ltn__category-item-name">
                            <h4><a href="shop.html">Parking Space</a></h4>
                        </div>
                        <div class="ltn__category-item-btn">
                            <a href="shop.html"><i class="flaticon-right-arrow"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="ltn__category-item ltn__category-item-4 text-center">
                        <div class="ltn__category-item-img">
                            <a href="shop.html">
                                <i class="flaticon-car"></i>
                            </a>
                        </div>
                        <div class="ltn__category-item-name">
                            <h4><a href="shop.html">Parking Space</a></h4>
                        </div>
                        <div class="ltn__category-item-btn">
                            <a href="shop.html"><i class="flaticon-right-arrow"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> -->
    <!-- CATEGORY AREA END -->

    <!-- AMENITIES AREA START -->
    <div class="ltn__category-area ltn__product-gutter section-bg-1--- pt-115 pb-90">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title-area ltn__section-title-2--- text-center">
                        <h6 class="section-subtitle section-subtitle-2 ltn__secondary-color">Our Amenities</h6>
                        <h1 class="section-title">Hotel Amenities</h1>
                    </div>
                </div>
            </div>
            <div class="row ltn__category-slider-active--- slick-arrow-1 justify-content-center">
                <!-- Parking -->
                <div class="col-lg-3 col-md-4 col-sm-6 col-6">
                    <div class="ltn__category-item ltn__category-item-5 text-center">
                        <a >
                            <span class="category-icon"><i class="flaticon-car"></i></span>
                            <span class="category-title">Free Parking</span>
                            
                        </a>
                    </div>
                </div>
                <!-- Swimming Pool -->
                <div class="col-lg-3 col-md-4 col-sm-6 col-6">
                    <div class="ltn__category-item ltn__category-item-5 text-center">
                        <a >
                            <span class="category-icon"><i class="flaticon-swimming"></i></span>
                            <span class="category-title">Swimming Pool</span>
                            
                        </a>
                    </div>
                </div>
                <!-- 24/7 Security -->
                <div class="col-lg-3 col-md-4 col-sm-6 col-6">
                    <div class="ltn__category-item ltn__category-item-5 text-center">
                        <a >
                            <span class="category-icon"><i class="flaticon-secure-shield"></i></span>
                            <span class="category-title">24/7 Security</span>
                            
                        </a>
                    </div>
                </div>
                <!-- Wellness Spa -->
                <div class="col-lg-3 col-md-4 col-sm-6 col-6">
                    <div class="ltn__category-item ltn__category-item-5 text-center">
                        <a >
                            <span class="category-icon"><i class="flaticon-stethoscope"></i></span>
                            <span class="category-title">Wellness Spa</span>
                            
                        </a>
                    </div>
                </div>
                <!-- In-Room Dining -->
                <div class="col-lg-3 col-md-4 col-sm-6 col-6">
                    <div class="ltn__category-item ltn__category-item-5 text-center">
                        <a >
                            <span class="category-icon"><i class="flaticon-dining-table-with-chairs"></i></span>
                            <span class="category-title">In-Room Dining</span>
                            
                        </a>
                    </div>
                </div>
                <!-- Comfortable Bedding -->
                <div class="col-lg-3 col-md-4 col-sm-6 col-6">
                    <div class="ltn__category-item ltn__category-item-5 text-center">
                        <a >
                            <span class="category-icon"><i class="flaticon-bed-1"></i></span>
                            <span class="category-title">Comfortable Beds</span>
                            
                        </a>
                    </div>
                </div>
                <!-- Smart Room Features -->
                <div class="col-lg-3 col-md-4 col-sm-6 col-6">
                    <div class="ltn__category-item ltn__category-item-5 text-center">
                        <a >
                            <span class="category-icon"><i class="flaticon-apartment"></i></span>
                            <span class="category-title">Smart Room</span>
                            
                        </a>
                    </div>
                </div>
                <!-- Kids’ Play Area -->
                <div class="col-lg-3 col-md-4 col-sm-6 col-6">
                    <div class="ltn__category-item ltn__category-item-5 text-center">
                        <a >
                            <span class="category-icon"><i class="flaticon-slider"></i></span>
                            <span class="category-title">Kids’ Play Area</span>
                           
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- AMENITIES AREA END -->


    <!-- TESTIMONIAL AREA START (testimonial-7) -->
    <div class="ltn__testimonial-area section-bg-1--- bg-image-top pt-115 pb-70" data-bs-bg="img/bg/20.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title-area ltn__section-title-2--- text-center">
                        <h6 class="section-subtitle section-subtitle-2 ltn__secondary-color">Our Testimonial</h6>
                        <h1 class="section-title">Clients Feedback</h1>
                    </div>
                </div>
            </div>
            <div class="row ltn__testimonial-slider-5-active slick-arrow-1">
                <div class="col-lg-4">
                    <div class="ltn__testimonial-item ltn__testimonial-item-7">
                        <div class="ltn__testimoni-info">
                            <p><i class="flaticon-left-quote-1"></i>
                                Precious ipsum dolor sit amet
                                consectetur adipisicing elit, sed dos
                                mod tempor incididunt ut labore et
                                dolore magna aliqua. Ut enim ad min
                                veniam, quis nostrud Precious ips
                                um dolor sit amet, consecte</p>
                            <div class="ltn__testimoni-info-inner">
                                <div class="ltn__testimoni-img">
                                    <img src="/frontend/img/testimonial/1.jpg" alt="#">
                                </div>
                                <div class="ltn__testimoni-name-designation">
                                    <h5>Jacob William</h5>
                                    <label>Selling Agents</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="ltn__testimonial-item ltn__testimonial-item-7">
                        <div class="ltn__testimoni-info">
                            <p><i class="flaticon-left-quote-1"></i>
                                Precious ipsum dolor sit amet
                                consectetur adipisicing elit, sed dos
                                mod tempor incididunt ut labore et
                                dolore magna aliqua. Ut enim ad min
                                veniam, quis nostrud Precious ips
                                um dolor sit amet, consecte</p>
                            <div class="ltn__testimoni-info-inner">
                                <div class="ltn__testimoni-img">
                                    <img src="/frontend/img/testimonial/2.jpg" alt="#">
                                </div>
                                <div class="ltn__testimoni-name-designation">
                                    <h5>Kelian Anderson</h5>
                                    <label>Selling Agents</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="ltn__testimonial-item ltn__testimonial-item-7">
                        <div class="ltn__testimoni-info">
                            <p><i class="flaticon-left-quote-1"></i>
                                Precious ipsum dolor sit amet
                                consectetur adipisicing elit, sed dos
                                mod tempor incididunt ut labore et
                                dolore magna aliqua. Ut enim ad min
                                veniam, quis nostrud Precious ips
                                um dolor sit amet, consecte</p>
                            <div class="ltn__testimoni-info-inner">
                                <div class="ltn__testimoni-img">
                                    <img src="/frontend/img/testimonial/3.jpg" alt="#">
                                </div>
                                <div class="ltn__testimoni-name-designation">
                                    <h5>Adam Joseph</h5>
                                    <label>Selling Agents</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="ltn__testimonial-item ltn__testimonial-item-7">
                        <div class="ltn__testimoni-info">
                            <p><i class="flaticon-left-quote-1"></i>
                                Precious ipsum dolor sit amet
                                consectetur adipisicing elit, sed dos
                                mod tempor incididunt ut labore et
                                dolore magna aliqua. Ut enim ad min
                                veniam, quis nostrud Precious ips
                                um dolor sit amet, consecte</p>
                            <div class="ltn__testimoni-info-inner">
                                <div class="ltn__testimoni-img">
                                    <img src="/frontend/img/testimonial/4.jpg" alt="#">
                                </div>
                                <div class="ltn__testimoni-name-designation">
                                    <h5>James Carter</h5>
                                    <label>Selling Agents</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--  -->
            </div>
        </div>
    </div>
    <!-- TESTIMONIAL AREA END -->

    <!-- BRAND LOGO AREA START -->
    <!-- <div class="ltn__brand-logo-area ltn__brand-logo-1 section-bg-1 pt-290 pb-110 plr--9 d-none">
        <div class="container-fluid">
            <div class="row ltn__brand-logo-active">
                <div class="col-lg-12">
                    <div class="ltn__brand-logo-item">
                        <img src="/frontend/img/brand-logo/1.png" alt="Brand Logo">
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="ltn__brand-logo-item">
                        <img src="/frontend/img/brand-logo/2.png" alt="Brand Logo">
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="ltn__brand-logo-item">
                        <img src="/frontend/img/brand-logo/3.png" alt="Brand Logo">
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="ltn__brand-logo-item">
                        <img src="/frontend/img/brand-logo/4.png" alt="Brand Logo">
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="ltn__brand-logo-item">
                        <img src="/frontend/img/brand-logo/5.png" alt="Brand Logo">
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="ltn__brand-logo-item">
                        <img src="/frontend/img/brand-logo/3.png" alt="Brand Logo">
                    </div>
                </div>
            </div>
        </div>
    </div> -->
    <!-- BRAND LOGO AREA END -->

    <!-- BLOG AREA START (blog-3) -->
    <!-- <div class="ltn__blog-area pt-115--- pb-70">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title-area ltn__section-title-2--- text-center">
                        <h6 class="section-subtitle section-subtitle-2 ltn__secondary-color">News & Blogs</h6>
                        <h1 class="section-title">Leatest News Feeds</h1>
                    </div>
                </div>
            </div>
            <div class="row  ltn__blog-slider-one-active slick-arrow-1 ltn__blog-item-3-normal">
           
                <div class="col-lg-12">
                    <div class="ltn__blog-item ltn__blog-item-3">
                        <div class="ltn__blog-img">
                            <a href="blog-details.html"><img src="/frontend/img/blog/1.jpg" alt="#"></a>
                        </div>
                        <div class="ltn__blog-brief">
                            <div class="ltn__blog-meta">
                                <ul>
                                    <li class="ltn__blog-author">
                                        <a href="#"><i class="far fa-user"></i>by: Admin</a>
                                    </li>
                                    <li class="ltn__blog-tags">
                                        <a href="#"><i class="fas fa-tags"></i>Decorate</a>
                                    </li>
                                </ul>
                            </div>
                            <h3 class="ltn__blog-title"><a href="blog-details.html">10 Brilliant Ways To Decorate Your Home</a></h3>
                            <div class="ltn__blog-meta-btn">
                                <div class="ltn__blog-meta">
                                    <ul>
                                        <li class="ltn__blog-date"><i class="far fa-calendar-alt"></i>June 24, 2021</li>
                                    </ul>
                                </div>
                                <div class="ltn__blog-btn">
                                    <a href="blog-details.html">Read more</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-12">
                    <div class="ltn__blog-item ltn__blog-item-3">
                        <div class="ltn__blog-img">
                            <a href="blog-details.html"><img src="/frontend/img/blog/2.jpg" alt="#"></a>
                        </div>
                        <div class="ltn__blog-brief">
                            <div class="ltn__blog-meta">
                                <ul>
                                    <li class="ltn__blog-author">
                                        <a href="#"><i class="far fa-user"></i>by: Admin</a>
                                    </li>
                                    <li class="ltn__blog-tags">
                                        <a href="#"><i class="fas fa-tags"></i>Interior</a>
                                    </li>
                                </ul>
                            </div>
                            <h3 class="ltn__blog-title"><a href="blog-details.html">The Most Inspiring Interior Design Of 2021</a></h3>
                            <div class="ltn__blog-meta-btn">
                                <div class="ltn__blog-meta">
                                    <ul>
                                        <li class="ltn__blog-date"><i class="far fa-calendar-alt"></i>July 23, 2021</li>
                                    </ul>
                                </div>
                                <div class="ltn__blog-btn">
                                    <a href="blog-details.html">Read more</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-12">
                    <div class="ltn__blog-item ltn__blog-item-3">
                        <div class="ltn__blog-img">
                            <a href="blog-details.html"><img src="/frontend/img/blog/3.jpg" alt="#"></a>
                        </div>
                        <div class="ltn__blog-brief">
                            <div class="ltn__blog-meta">
                                <ul>
                                    <li class="ltn__blog-author">
                                        <a href="#"><i class="far fa-user"></i>by: Admin</a>
                                    </li>
                                    <li class="ltn__blog-tags">
                                        <a href="#"><i class="fas fa-tags"></i>Estate</a>
                                    </li>
                                </ul>
                            </div>
                            <h3 class="ltn__blog-title"><a href="blog-details.html">Recent Commercial Real Estate Transactions</a></h3>
                            <div class="ltn__blog-meta-btn">
                                <div class="ltn__blog-meta">
                                    <ul>
                                        <li class="ltn__blog-date"><i class="far fa-calendar-alt"></i>May 22, 2021</li>
                                    </ul>
                                </div>
                                <div class="ltn__blog-btn">
                                    <a href="blog-details.html">Read more</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-12">
                    <div class="ltn__blog-item ltn__blog-item-3">
                        <div class="ltn__blog-img">
                            <a href="blog-details.html"><img src="/frontend/img/blog/4.jpg" alt="#"></a>
                        </div>
                        <div class="ltn__blog-brief">
                            <div class="ltn__blog-meta">
                                <ul>
                                    <li class="ltn__blog-author">
                                        <a href="#"><i class="far fa-user"></i>by: Admin</a>
                                    </li>
                                    <li class="ltn__blog-tags">
                                        <a href="#"><i class="fas fa-tags"></i>Room</a>
                                    </li>
                                </ul>
                            </div>
                            <h3 class="ltn__blog-title"><a href="blog-details.html">Renovating a Living Room? Experts Share Their Secrets</a></h3>
                            <div class="ltn__blog-meta-btn">
                                <div class="ltn__blog-meta">
                                    <ul>
                                        <li class="ltn__blog-date"><i class="far fa-calendar-alt"></i>June 24, 2021</li>
                                    </ul>
                                </div>
                                <div class="ltn__blog-btn">
                                    <a href="blog-details.html">Read more</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-12">
                    <div class="ltn__blog-item ltn__blog-item-3">
                        <div class="ltn__blog-img">
                            <a href="blog-details.html"><img src="/frontend/img/blog/5.jpg" alt="#"></a>
                        </div>
                        <div class="ltn__blog-brief">
                            <div class="ltn__blog-meta">
                                <ul>
                                    <li class="ltn__blog-author">
                                        <a href="#"><i class="far fa-user"></i>by: Admin</a>
                                    </li>
                                    <li class="ltn__blog-tags">
                                        <a href="#"><i class="fas fa-tags"></i>Trends</a>
                                    </li>
                                </ul>
                            </div>
                            <h3 class="ltn__blog-title"><a href="blog-details.html">7 home trends that will shape your house in 2021</a></h3>
                            <div class="ltn__blog-meta-btn">
                                <div class="ltn__blog-meta">
                                    <ul>
                                        <li class="ltn__blog-date"><i class="far fa-calendar-alt"></i>June 24, 2021</li>
                                    </ul>
                                </div>
                                <div class="ltn__blog-btn">
                                    <a href="blog-details.html">Read more</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
               
            </div>
        </div>
    </div> -->
    <!-- BLOG AREA END -->





    <!-- MODAL AREA START (Quick View Modal) -->
    <div class="ltn__modal-area ltn__quick-view-modal-area">
        <div class="modal fade" id="quick_view_modal" tabindex="-1">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            <!-- <i class="fas fa-times"></i> -->
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="ltn__quick-view-modal-inner">
                            <div class="modal-product-item">
                                <div class="row">
                                    <div class="col-lg-6 col-12">
                                        <div class="modal-product-img">
                                            <img src="img/product/4.png" alt="#">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-12">
                                        <div class="modal-product-info">
                                            <div class="product-ratting">
                                                <ul>
                                                    <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                    <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                    <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                    <li><a href="#"><i class="fas fa-star-half-alt"></i></a></li>
                                                    <li><a href="#"><i class="far fa-star"></i></a></li>
                                                    <li class="review-total"> <a href="#"> ( 95 Reviews )</a></li>
                                                </ul>
                                            </div>
                                            <h3><a href="product-details.html">3 Rooms Manhattan</a></h3>
                                            <div class="product-price">
                                                <span>$34,900</span>
                                                <del>$36,500</del>
                                            </div>
                                            <hr>
                                            <div class="modal-product-brief">
                                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dignissimos repellendus repudiandae incidunt quidem pariatur expedita, quo quis modi tempore non.</p>
                                            </div>
                                            <div class="modal-product-meta ltn__product-details-menu-1 d-none">
                                                <ul>
                                                    <li>
                                                        <strong>Categories:</strong>
                                                        <span>
                                                            <a href="#">Parts</a>
                                                            <a href="#">Car</a>
                                                            <a href="#">Seat</a>
                                                            <a href="#">Cover</a>
                                                        </span>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="ltn__product-details-menu-2 d-none">
                                                <ul>
                                                    <li>
                                                        <div class="cart-plus-minus">
                                                            <input type="text" value="02" name="qtybutton" class="cart-plus-minus-box">
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <a href="#" class="theme-btn-1 btn btn-effect-1" title="Add to Cart" data-bs-toggle="modal" data-bs-target="#add_to_cart_modal">
                                                            <i class="fas fa-shopping-cart"></i>
                                                            <span>ADD TO CART</span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                            <!-- <hr> -->
                                            <div class="ltn__product-details-menu-3">
                                                <ul>
                                                    <li>
                                                        <a href="#" class="" title="Wishlist" data-bs-toggle="modal" data-bs-target="#liton_wishlist_modal">
                                                            <i class="far fa-heart"></i>
                                                            <span>Add to Wishlist</span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="#" class="" title="Compare" data-bs-toggle="modal" data-bs-target="#quick_view_modal">
                                                            <i class="fas fa-exchange-alt"></i>
                                                            <span>Compare</span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                            <hr>
                                            <div class="ltn__social-media">
                                                <ul>
                                                    <li>Share:</li>
                                                    <li><a href="#" title="Facebook"><i class="fab fa-facebook-f"></i></a></li>
                                                    <li><a href="#" title="Twitter"><i class="fab fa-twitter"></i></a></li>
                                                    <li><a href="#" title="Linkedin"><i class="fab fa-linkedin"></i></a></li>
                                                    <li><a href="#" title="Instagram"><i class="fab fa-instagram"></i></a></li>

                                                </ul>
                                            </div>
                                            <label class="float-end mb-0"><a class="text-decoration" href="product-details.html"><small>View Details</small></a></label>
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

    <!-- MODAL AREA START (Add To Cart Modal) -->
    <div class="ltn__modal-area ltn__add-to-cart-modal-area">
        <div class="modal fade" id="add_to_cart_modal" tabindex="-1">
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
                                        <div class="modal-product-img">
                                            <img src="img/product/1.png" alt="#">
                                        </div>
                                        <div class="modal-product-info">
                                            <h5><a href="product-details.html">3 Rooms Manhattan</a></h5>
                                            <p class="added-cart"><i class="fa fa-check-circle"></i> Successfully added to your Cart</p>
                                            <div class="btn-wrapper">
                                                <a href="cart.html" class="theme-btn-1 btn btn-effect-1">View Cart</a>
                                                <a href="checkout.html" class="theme-btn-2 btn btn-effect-2">Checkout</a>
                                            </div>
                                        </div>
                                        <!-- additional-info -->
                                        <div class="additional-info d-none">
                                            <p>We want to give you <b>10% discount</b> for your first order, <br> Use discount code at checkout</p>
                                            <div class="payment-method">
                                                <img src="img/icons/payment.png" alt="#">
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

    <!-- MODAL AREA START (Wishlist Modal) -->
    <div class="ltn__modal-area ltn__add-to-cart-modal-area">
        <div class="modal fade" id="liton_wishlist_modal" tabindex="-1">
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
                                        <div class="modal-product-img">
                                            <img src="img/product/7.png" alt="#">
                                        </div>
                                        <div class="modal-product-info">
                                            <h5><a href="product-details.html">3 Rooms Manhattan</a></h5>
                                            <p class="added-cart"><i class="fa fa-check-circle"></i> Successfully added to your Wishlist</p>
                                            <div class="btn-wrapper">
                                                <a href="wishlist.html" class="theme-btn-1 btn btn-effect-1">View Wishlist</a>
                                            </div>
                                        </div>
                                        <!-- additional-info -->
                                        <div class="additional-info d-none">
                                            <p>We want to give you <b>10% discount</b> for your first order, <br> Use discount code at checkout</p>
                                            <div class="payment-method">
                                                <img src="img/icons/payment.png" alt="#">
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





@endsection