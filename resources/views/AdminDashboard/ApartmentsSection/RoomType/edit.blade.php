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
                <h2 class="content-title">Edit Room Type</h2>
                <p>Update room type details</p>
            </div>

            <div class="card">
                <div class="card-body">
                    <form action="{{ route('room-types.update', $roomType->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Room Type Name -->
                        <div class="mb-4">
                            <label for="type_name" class="form-label">Room Type Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="type_name" name="type_name" value="{{ old('type_name', $roomType->type_name) }}" required>
                        </div>

                        <!-- Description -->
                        <div class="mb-4">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" id="description" name="description" placeholder="Enter room type description">{{ old('description', $roomType->description) }}</textarea>
                        </div>

                        <!-- Existing Images Display with Delete Option -->
                        <div class="mb-4">
                            <label class="form-label">Current Images</label>
                            @if ($roomType->images)
                            <div class="row" id="current-images">
                                @foreach (json_decode($roomType->images, true) as $image)
                                    <div class="col-md-3 mb-3 image-container">
                                        <img src="{{ asset('storage/' . $image) }}" alt="Room Type Image" class="img-thumbnail">
                                        <button type="button" class="btn btn-danger btn-sm mt-1 remove-image" data-image="{{ $image }}">Delete</button>
                                    </div>
                                @endforeach
                            </div>
                            @else
                            <p class="form-label"> No Images Yet</p>              
                            @endif
                            
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
                            <button type="submit" class="btn btn-primary">Update Room Type</button>
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
