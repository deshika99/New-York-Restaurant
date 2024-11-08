@extends ('frontend.master')

@section('content')


<div class="ltn__utilize-overlay"></div>

    <!-- BREADCRUMB AREA START -->
    <div class="ltn__breadcrumb-area text-left bg-overlay-white-30 bg-image "  data-bs-bg="img/bg/14.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ltn__breadcrumb-inner">
                        <h1 class="page-title">Our Facilities</h1>
                        <div class="ltn__breadcrumb-list">
                            <ul>
                                <li><a href="index.html"><span class="ltn__secondary-color"><i class="fas fa-home"></i></span> Home</a></li>
                                <li>Facilities</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- BREADCRUMB AREA END -->

    <!-- Gallery area start -->
<div class="ltn__gallery-area mb-120 mt--65">
    <div class="container">
        <!-- Tabs for Apartment and Room Type selection -->
        <div class="row">
            <div class="col-lg-12">
                <div class="ltn__gallery-menu">
                    <div class="ltn__gallery-filter-menu portfolio-filter text-uppercase mb-50">
                        <button data-filter="*" class="active">all</button>
                        <button data-filter=".filter_apartment">Apartments</button>
                        <button data-filter=".filter_room_type">Room Types</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Portfolio Wrapper Start -->
        <div class="ltn__gallery-active row ltn__gallery-style-1">
            <div class="ltn__gallery-sizer col-1"></div>

            <!-- Apartments Section -->
            @foreach($apartments as $apartment)
                <div class="ltn__gallery-item filter_apartment col-md-4 col-sm-6 col-12">
                    <div class="ltn__gallery-item-inner">
                        <!-- Apartment Image Carousel -->
                        <div id="apartmentCarousel{{ $apartment->id }}" class="carousel slide" data-bs-ride="carousel">
                            @php
                                $images = json_decode($apartment->images);
                            @endphp
                            <div class="carousel-inner">
                                @if(is_array($images))
                                    @foreach($images as $index => $image)
                                        <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                            <img src="{{ asset('storage/' .$image) }}" class="d-block w-100" alt="Apartment Image">
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#apartmentCarousel{{ $apartment->id }}" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#apartmentCarousel{{ $apartment->id }}" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>
                        <!-- Apartment Info -->
                        <div class="ltn__gallery-item-info">
                            <h4>{{ $apartment->apartment_name }}</h4>
                            <p>Address: {{ $apartment->address }}</p>
                            <p>Amenities: {{ $apartment->amenities }}</p>
                        </div>
                    </div>
                </div>
            @endforeach

            <!-- Room Types Section -->
            @foreach($roomTypes as $roomType)
                <div class="ltn__gallery-item filter_room_type col-md-4 col-sm-6 col-12">
                    <div class="ltn__gallery-item-inner">
                        <!-- Room Type Image Carousel -->
                        <div id="roomTypeCarousel{{ $roomType->id }}" class="carousel slide" data-bs-ride="carousel">
                            @php
                                $images = json_decode($roomType->images);
                            @endphp
                            <div class="carousel-inner">
                                @if(is_array($images))
                                    @foreach($images as $index => $image)
                                        <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                            <img src="{{ asset('storage/' .$image) }}" class="d-block w-100" alt="Room Type Image">
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#roomTypeCarousel{{ $roomType->id }}" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#roomTypeCarousel{{ $roomType->id }}" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>
                        <!-- Room Type Info -->
                        <div class="ltn__gallery-item-info">
                            <h4>{{ $roomType->type_name}}</h4>
                            <p>Description: {{ $roomType->description }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <!-- Portfolio Wrapper End -->
    </div>
</div>
<!-- Gallery area end -->






@endsection