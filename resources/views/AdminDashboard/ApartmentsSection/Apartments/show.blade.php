@extends('AdminDashboard.master')

@section('content')
<!DOCTYPE html>
<html lang="en">
    <body>
        <section class="content-main">
            <div class="content-header">
                <h2 class="content-title">{{ $apartment->apartment_name }}</h2>
                <a href="{{ route('apartment_management') }}" class="btn btn-primary float-end">Back to Apartments</a>
            </div>

            <div class="card">
                <div class="card-body">
                    <h4>Location: {{ $apartment->location_name }}</h4>
                    <p><strong>Address:</strong> {{ $apartment->address }}</p>
                    <p><strong>Total Floors:</strong> {{ $apartment->total_floors }}</p>
                    <p><strong>Total Units:</strong> {{ $apartment->total_units }}</p>
                    <p><strong>Amenities:</strong> {{ $apartment->amenities }}</p>
                    <p><strong>Status:</strong> {{ ucfirst($apartment->status) }}</p>

                    <!-- Display Images -->
                    <h5>Apartment Images</h5>
                    <div class="row">
                        @if(!empty($apartment->images))
                            @foreach (json_decode($apartment->images, true) as $image)
                                <div class="col-md-3 mb-3">
                                    <img src="{{ asset('storage/' . $image) }}" alt="Apartment Image" class="img-thumbnail">
                                </div>
                            @endforeach
                        @else
                            <p>No images available for this apartment.</p>
                        @endif
                    </div>

                    <!-- Delete Apartment Button -->
                    <form action="{{ route('apartments.destroy', $apartment->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this apartment?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger mt-3">Delete Apartment</button>
                    </form>
                </div>
            </div>
        </section>
    </body>
</html>
@endsection
