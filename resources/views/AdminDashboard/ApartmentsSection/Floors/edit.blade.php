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
                <h2 class="content-title">Edit Floor</h2>
                <p>Update floor details</p>
            </div>

            <div class="card">
                <div class="card-body">
                    <form action="{{ route('floors.update', $floor->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Apartment Selection -->
                        <div class="mb-4">
                            <label for="apartment_id" class="form-label">Apartment <span class="text-danger">*</span></label>
                            <select class="form-select" id="apartment_id" name="apartment_id" required>
                                @foreach ($apartments as $apartment)
                                    <option value="{{ $apartment->id }}" {{ $apartment->id == $floor->apartment_id ? 'selected' : '' }}>
                                        {{ $apartment->apartment_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Existing form fields -->
                        <div class="mb-4">
                            <label for="floor_number" class="form-label">Floor Number <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" id="floor_number" name="floor_number" value="{{ old('floor_number', $floor->floor_number) }}" required>
                        </div>
                        <div class="mb-4">
                            <label for="total_rooms" class="form-label">Total Rooms <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" id="total_rooms" name="total_rooms" value="{{ old('total_rooms', $floor->total_rooms) }}" required>
                        </div>
                        <div class="mb-4">
                            <label for="occupied_rooms" class="form-label">Occupied Rooms</label>
                            <input type="number" class="form-control" id="occupied_rooms" name="occupied_rooms" value="{{ old('occupied_rooms', $floor->occupied_rooms) }}">
                        </div>
                        <div class="mb-4">
                            <label for="floor_status" class="form-label">Status <span class="text-danger">*</span></label>
                            <select class="form-select" id="floor_status" name="floor_status" required>
                                <option value="Available" {{ $floor->floor_status == 'Available' ? 'selected' : '' }}>Available</option>
                                <option value="Partially Occupied" {{ $floor->floor_status == 'Partially Occupied' ? 'selected' : '' }}>Partially Occupied</option>
                                <option value="Fully Occupied" {{ $floor->floor_status == 'Fully Occupied' ? 'selected' : '' }}>Fully Occupied</option>
                            </select>
                        </div>

                        <!-- Existing Images Display with Delete Option -->
                        <div class="mb-4">
                            <label class="form-label">Current Images</label>
                            <div class="row" id="current-images">
                                @foreach (json_decode($floor->images, true) as $image)
                                    <div class="col-md-3 mb-3 image-container">
                                        <img src="{{ asset('storage/' . $image) }}" alt="Floor Image" class="img-thumbnail">
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
                            <button type="submit" class="btn btn-primary">Update Floor</button>
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
