@extends ('frontend.master')

@section('content')

    <div class="ltn__utilize-overlay"></div>

    <!-- BREADCRUMB AREA START -->
    <div class="ltn__breadcrumb-area text-left bg-overlay-white-30 bg-image "  data-bs-bg="frontend/img/bg/14.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ltn__breadcrumb-inner">
                        <h1 class="page-title">Find Room</h1>
                        <div class="ltn__breadcrumb-list">
                            <ul>
                                <li><a href="{{route('home')}}"><span class="ltn__secondary-color"><i class="fas fa-home"></i></span> Home</a></li>
                                <li>Find Room</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- BREADCRUMB AREA END -->

    
<!-- BOOKING FORM AREA START -->
<div class="ltn__car-dealer-form-area mt--65 pb-115--- mb-5 ">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6 ">
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
                                    <div class="col-md-12">
                                        <label for="checkin" class="form-label">Check-in Date</label>
                                        <input type="date" name="checkin" id="checkin" placeholder="Check-in Date" class="form-control">
                                        @error('checkin')
                                        <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <!-- Check-out Date -->
                                    <div class="col-md-12">
                                        <label for="checkout" class="form-label">Check-out Date</label>
                                        <input type="date" name="checkout" id="checkout" placeholder="Check-out Date" class="form-control">
                                        @error('checkout')
                                        <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <!-- Apartment Selection -->
                                    <div class="col-md-12">

                                        <select name="apartment" id="apartment" class="nice-select mt-3">
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
                                    <div class="col-md-12 d-flex align-items-end mt-5">
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
    

    



    @endsection


