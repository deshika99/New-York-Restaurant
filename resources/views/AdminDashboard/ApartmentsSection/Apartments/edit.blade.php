@extends('AdminDashboard.master')

@section('content')
<!DOCTYPE html>
<html lang="en">
    <body>
        <!-- Success Message -->
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- Error Display -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <section class="content-main">
            <div class="content-header">
                <h2 class="content-title">Edit Apartment</h2>
                <p>Update apartment details</p>
            </div>

            <div class="card">
                <div class="card-body">
                    <form action="{{ route('apartments.update', $apartment->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Existing form fields -->
                        <div class="mb-4">
                            <label for="location_name" class="form-label">Location Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="location_name" name="location_name" value="{{ old('location_name', $apartment->location_name) }}" required>
                        </div>
                        <div class="mb-4">
                            <label for="apartment_name" class="form-label">Apartment Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="apartment_name" name="apartment_name" value="{{ old('apartment_name', $apartment->apartment_name) }}" required>
                        </div>
                        <div class="mb-4">
                            <label for="total_floors" class="form-label">Total Floors <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" id="total_floors" name="total_floors" value="{{ old('total_floors', $apartment->total_floors) }}" required>
                        </div>
                        <div class="mb-4">
                            <label for="total_units" class="form-label">Total Units <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" id="total_units" name="total_units" value="{{ old('total_units', $apartment->total_units) }}" required>
                        </div>
                        <div class="mb-4">
                            <label for="address" class="form-label">Address <span class="text-danger">*</span></label>
                            <textarea class="form-control" id="address" name="address" required>{{ old('address', $apartment->address) }}</textarea>
                        </div>
                        <div class="mb-4">
                            <label for="amenities" class="form-label">Amenities <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="amenities" name="amenities" value="{{ old('amenities', $apartment->amenities) }}" placeholder="Enter amenities separated by commas" required>
                        </div>
                        <div class="mb-4">
                            <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                            <select class="form-select" id="status" name="status" required>
                                <option value="Available" {{ $apartment->status == 'Available' ? 'selected' : '' }}>Available</option>
                                <option value="Occupied" {{ $apartment->status == 'Occupied' ? 'selected' : '' }}>Occupied</option>
                                <option value="Under Maintenance" {{ $apartment->status == 'Under Maintenance' ? 'selected' : '' }}>Under Maintenance</option>
                            </select>
                        </div>

                        <!-- Existing Images Display with Delete Option -->
                        <div class="mb-4">
                            <label class="form-label">Current Images</label>
                            <div class="row" id="current-images">
                                @foreach (json_decode($apartment->images, true) as $image)
                                    <div class="col-md-3 mb-3 image-container">
                                        <img src="{{ asset('storage/' . $image) }}" alt="Apartment Image" class="img-thumbnail">
                                        <button type="button" class="btn btn-danger btn-sm mt-1 remove-image" data-image="{{ $image }}">Delete</button>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <!-- New Images Upload Section -->
                        <div class="mb-4">
                            <label for="images" class="form-label">Add New Images (optional)</label>
                            <input type="file" class="form-control" id="images" name="images[]" multiple>
                            <small class="text-muted">You can select multiple images.</small>
                        </div>

                        <!-- Hidden Input to Track Remaining Images -->
                        <input type="hidden" name="remaining_images" id="remaining-images">

                        <!-- Update Button -->
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">Update Apartment</button>
                        </div>
                    </form>
                </div>
            </div>
        </section>

        <script>
            // Handle Front-end Image Deletion
            document.querySelectorAll('.remove-image').forEach(button => {
                button.addEventListener('click', function() {
                    const image = this.getAttribute('data-image');
                    // Remove image container from the DOM
                    this.closest('.image-container').remove();

                    // Update the hidden input with remaining images
                    updateRemainingImages();
                });
            });

            // Function to update the remaining images in the hidden input
            function updateRemainingImages() {
                const remainingImages = Array.from(document.querySelectorAll('.remove-image'))
                    .map(button => button.getAttribute('data-image'));
                
                document.getElementById('remaining-images').value = JSON.stringify(remainingImages);
            }

            // Initialize remaining images on page load
            updateRemainingImages();
        </script>
    </body>
</html>
@endsection
