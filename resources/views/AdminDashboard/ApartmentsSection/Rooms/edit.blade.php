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
                <h2 class="content-title">Edit Room</h2>
                <p>Update room details</p>
            </div>

            <div class="card">
                <div class="card-body">
                    <form action="{{ route('rooms.update', $room->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <!-- Apartment Selection -->
                        <div class="mb-4">
                            <label for="apartment_id" class="form-label">Apartment <span class="text-danger">*</span></label>
                            <select class="form-select" id="apartment_id" name="apartment_id" required>
                                @foreach($apartments as $apartment)
                                    <option value="{{ $apartment->id }}" {{ $room->apartment_id == $apartment->id ? 'selected' : '' }}>
                                        {{ $apartment->apartment_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Floor Selection -->
                        <div class="mb-4">
                            <label for="floor_id" class="form-label">Floor <span class="text-danger">*</span></label>
                            <select class="form-select" id="floor_id" name="floor_id" required>
                                @foreach($floors as $floor)
                                    <option value="{{ $floor->id }}" {{ $room->floor_id == $floor->id ? 'selected' : '' }}>
                                        Floor {{ $floor->floor_number }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Room Type Selection -->
                        <div class="mb-4">
                            <label for="room_type_id" class="form-label">Room Type <span class="text-danger">*</span></label>
                            <select class="form-select" id="room_type_id" name="room_type_id" required>
                                @foreach($roomTypes as $type)
                                    <option value="{{ $type->id }}" {{ $room->room_type_id == $type->id ? 'selected' : '' }}>
                                        {{ $type->type_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Room Number -->
                        <div class="mb-4">
                            <label for="room_number" class="form-label">Room Number <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="room_number" name="room_number" value="{{ old('room_number', $room->room_number) }}" required>
                        </div>

                        <!-- Rental Price -->
                        <div class="mb-4">
                            <label for="rental_price" class="form-label">Rental Price</label>
                            <input type="number" step="0.01" class="form-control" id="rental_price" name="rental_price" value="{{ old('rental_price', $room->rental_price) }}">
                        </div>

                        <!-- Occupancy Status -->
                        <div class="mb-4">
                            <label for="occupancy_status" class="form-label">Occupancy Status <span class="text-danger">*</span></label>
                            <select class="form-select" id="occupancy_status" name="occupancy_status" required>
                                <option value="available" {{ $room->occupancy_status == 'available' ? 'selected' : '' }}>Available</option>
                                <option value="occupied" {{ $room->occupancy_status == 'occupied' ? 'selected' : '' }}>Occupied</option>
                                <option value="reserved" {{ $room->occupancy_status == 'reserved' ? 'selected' : '' }}>Reserved</option>
                            </select>
                        </div>

                        <!-- Facilities -->
                        <div class="mb-4">
                            <label for="facilities" class="form-label">Facilities</label>
                            <textarea class="form-control" id="facilities" name="facilities" rows="3">{{ old('facilities', $room->facilities) }}</textarea>
                        </div>

                        <!-- Update Button -->
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">Update Room</button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </body>
</html>
@endsection
