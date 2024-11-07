@extends ('frontend.master')

@section('content')
<!-- BREADCRUMB AREA START -->

<div class="ltn__breadcrumb-area text-left bg-overlay-white-30 ">

    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="ltn__breadcrumb-inner">
                    <h1 class="page-title">{{$apartment->apartment_name}} - {{$apartment->location_name}}</h1>
                    <div class="ltn__breadcrumb-list">
                        <ul>
                            <li><a href="/home"><span class="ltn__secondary-color"><i class="fas fa-home"></i></span> Home</a></li>

                            <li>Room Types</li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<!-- BREADCRUMB AREA END -->


<div class="container">
    <div class="row">
        @foreach($roomTypes as $roomType)
        <div class="col-lg-6 col-md-6 mb-4">
            <div class="card shadow-sm">
                <!-- Image Carousel for each Room Type -->
                <div id="carouselRoomType{{ $roomType->id }}" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        @foreach(json_decode($roomType->images) as $index => $image)
                        <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                            <img src="{{ asset('storage/' . $image) }}" class="d-block w-100" alt="{{ $roomType->type_name }}">
                        </div>

                        @endforeach

                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselRoomType{{ $roomType->id }}" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselRoomType{{ $roomType->id }}" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>

                <!-- Room Type Information -->
                <div class="card-body">
                    <h5 class="card-title">{{ $roomType->type_name }}</h5>
                    <p class="card-text">{{ $roomType->description }}</p>

                    <a href="{{ route('onlinebooking.create', 
                    ['room_type_id' => $roomType->id, 
                    'checkin' => $checkin,
                    'checkout' => $checkout,
                    'apartment_id' => $apartmentId ]) }}" 
                    class="btn btn-primary">Book Now</a>

                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
<!-- ROOM TYPE CARDS END -->


@endsection