@extends ('frontend.master')

@section('content')

<div class="ltn__utilize-overlay"></div>

<!-- BREADCRUMB AREA START -->
<div class="ltn__breadcrumb-area text-left bg-overlay-white-30  ">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="ltn__breadcrumb-inner">
                    <h1 class="page-title">Promotions</h1>
                    <div class="ltn__breadcrumb-list">
                        <ul>
                            <li><a href="{{route('home')}}"><span class="ltn__secondary-color"><i class="fas fa-home"></i></span> Home</a></li>
                            <li>Promotions</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- BREADCRUMB AREA END -->


<style>
    /* Promotions Section Background */
    .promotions-section {
        background: linear-gradient(135deg, #ff7e5f 0%, #feb47b 100%);
        background-size: cover;
        background-attachment: fixed;
        position: relative;
        padding: 50px 0;
        overflow: hidden;
    }

    /* Decorative Overlay */
    .promotions-section:before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('https://www.transparenttextures.com/patterns/cubes.png');
        opacity: 0.2;
        z-index: 1;
    }

    .promotions-section h2 {
        position: relative;
        z-index: 2;
        font-size: 2.5rem;
        font-weight: bold;
        letter-spacing: 1px;
        color: #ffffff;
        text-shadow: 0 3px 5px rgba(0, 0, 0, 0.3);
    }

    .promotions-section .row {
        position: relative;
        z-index: 2;
    }

    /* Card Styling */
    .promotion-card {
        background: linear-gradient(135deg, #e3f2fd 0%, #bbdefb 100%);
        border: 1px solid #dcdfe3;
        border-radius: 15px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        transition: transform 0.4s ease-in-out, box-shadow 0.4s ease-in-out;
        position: relative;
        overflow: hidden;
    }

    .promotion-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
    }

    .promotion-card .promotion-content {
        padding: 30px;
        position: relative;
    }

    .promotion-title {
        font-size: 1.8rem;
        font-weight: 700;
        color: #4a90e2;
        margin-bottom: 10px;
    }

    .promotion-description {
        font-size: 1rem;
        color: #636e72;
        margin-bottom: 15px;
    }

    .promotion-discount {
        font-size: 1.2rem;
        color: #27ae60;
        font-weight: bold;
    }

    .promotion-validity {
        font-size: 0.9rem;
        color: #636e72;
        margin-bottom: 10px;
    }

    .promotion-code {
        font-size: 1.1rem;
        color: #e74c3c;
        font-weight: bold;
        background: rgba(231, 76, 60, 0.1);
        padding: 5px 10px;
        border-radius: 5px;
        display: inline-block;
    }

    .promotion-deco {
        font-size: 4rem;
        color: #f39c12;
        opacity: 0.2;
        position: absolute;
        right: 20px;
        bottom: 20px;
        z-index: 0;
    }

    .promotion-deco i {
        font-size: 6rem;
    }

    /* Hover Glow Effect */
    .promotion-card:hover .promotion-deco {
        color: #f39c12;
        opacity: 0.3;
    }
</style>


<!-- PROMOTIONS SECTION START -->
<div class="promotions-section py-5 mt--65">
    <div class="container">
        <h2 class="text-center text-white mb-4">✨ Limited-Time Promotions Just for You! ✨</h2>
        <div class="row justify-content-center">
            @forelse ($promotions as $promotion)
            <div class="col-lg-6 col-md-12 mb-4 mt-2">
                <div class="promotion-card shadow-lg">
                    <div class="promotion-content p-4">
                        <h3 class="promotion-title">{{ $promotion->promotion_name }}</h3>
                        <p class="promotion-description">{{ $promotion->description }}</p>
                        <h4 class="promotion-discount">
                            {{ intval($promotion->discount_percentage) == $promotion->discount_percentage ? intval($promotion->discount_percentage) : $promotion->discount_percentage }}% Off
                        </h4>      

                        <p class="promotion-validity">
                            <i class="fas fa-calendar-alt"></i>
                            Valid: {{ $promotion->start_date }} to {{ $promotion->end_date }}
                        </p>     
                        <p class="promotion-code">
                            <span>Promo Code:</span>
                            <strong>{{ $promotion->promotion_code }}</strong>
                        </p>
                    </div>
                    <div class="promotion-deco">
                        <i class="fas fa-gift"></i>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12">
                <p class="text-center text-white">No promotions available at the moment. Stay tuned for amazing offers!</p>
            </div>
            @endforelse
        </div>
    </div>
</div>
<!-- PROMOTIONS SECTION END -->





@endsection