@extends('AdminDashboard.master')

@section('content')
<!DOCTYPE html>
<html lang="en">
    <body>
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

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
                <h2 class="content-title">Rooms</h2>
                <p>Add, edit, or delete rooms</p>
            </div>

            <!-- Room Form -->
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <h4>Add New Room</h4>
                            <form action="{{ route('rooms.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label for="apartment_id" class="form-label">Apartment</label>
                                    <select class="form-select" id="apartment_id" name="apartment_id" required>
                                        @foreach($apartments as $apartment)
                                            <option value="{{ $apartment->id }}">{{ $apartment->apartment_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="floor_id" class="form-label">Floor</label>
                                    <select class="form-select" id="floor_id" name="floor_id" required>
                                        @foreach($floors as $floor)
                                            <option value="{{ $floor->id }}">Floor {{ $floor->floor_number }} - {{ $floor->apartment->apartment_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="room_type_id" class="form-label">Room Type</label>
                                    <select class="form-select" id="room_type_id" name="room_type_id" required>
                                        @foreach($roomTypes as $roomType)
                                            <option value="{{ $roomType->id }}">{{ $roomType->type_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="room_number" class="form-label">Room Number</label>
                                    <input type="text" class="form-control" id="room_number" name="room_number" required />
                                </div>
                                <div class="mb-3">
                                    <label for="rental_price" class="form-label">Rental Price</label>
                                    <input type="number" class="form-control" id="rental_price" name="rental_price" />
                                </div>
                                <div class="mb-3">
                                    <label for="occupancy_status" class="form-label">Occupancy Status</label>
                                    <select class="form-select" id="occupancy_status" name="occupancy_status" required>
                                        <option value="available">Available</option>
                                        <option value="occupied">Occupied</option>
                                        <option value="reserved">Reserved</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="facilities" class="form-label">Facilities</label>
                                    <textarea class="form-control" id="facilities" name="facilities" rows="3"></textarea>
                                </div>
                                
                                <div>
                                    <button type="submit" class="btn btn-primary w-100">Create Room</button>
                                </div>
                            </form>
                        </div>

                        <!-- Room Table -->
                        <div class="col-md-8">
                            <h4>Room List</h4>
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Apartment</th>
                                            <th>Floor</th>
                                            <th>Room Type</th>
                                            <th>Room Number</th>
                                            <th>Rental Price (LKR)</th>
                                            <th>Status</th>
                                            <th class="text-end">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($rooms as $room)
                                        <tr>
                                            <td>{{ $room->id }}</td>
                                            <td>{{ $room->apartment->apartment_name }}</td>
                                            <td>{{ $room->floor->floor_number }}</td>
                                            <td>{{ $room->roomType->type_name }}</td>
                                            <td>{{ $room->room_number }}</td>
                                            <td>{{ $room->rental_price }}</td>
                                            <td>{{ ucfirst($room->occupancy_status) }}</td>
                                            <td class="text-end">
                                                <a href="{{ route('rooms.edit', $room->id) }}" class="btn btn-warning btn-sm" title="Edit">
                                                    <i class="icon material-icons md-edit"></i>
                                                </a>
                                                <button class="btn btn-danger btn-sm" onclick="confirmDeleteRoom({{ $room->id }})" title="Delete">
                                                    <i class="icon material-icons md-delete"></i>
                                                </button>
                                                <form id="delete-room-form-{{ $room->id }}" action="{{ route('rooms.destroy', $room->id) }}" method="POST" style="display: none;">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </section>

        <!-- JavaScript to handle delete confirmation -->
        <script>
            function confirmDeleteRoom(id) {
                if (confirm('Are you sure you want to delete this room?')) {
                    document.getElementById(`delete-room-form-${id}`).submit();
                }
            }
        </script>
        
        <script src="backend/assets/js/vendors/jquery-3.6.0.min.js"></script>
        <script src="backend/assets/js/vendors/bootstrap.bundle.min.js"></script>
        <script src="backend/assets/js/vendors/select2.min.js"></script>
        <script src="backend/assets/js/vendors/perfect-scrollbar.js"></script>
        <script src="backend/assets/js/vendors/jquery.fullscreen.min.js"></script>
        <script src="backend/assets/js/main.js?v=6.0" type="text/javascript"></script>
    </body>
</html>
@endsection
