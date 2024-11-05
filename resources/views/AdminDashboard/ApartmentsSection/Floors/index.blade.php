@extends('AdminDashboard.master')

@section('content')
<!DOCTYPE html>
<html lang="en">
    <body>
        <!-- Flash messages -->
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
                <h2 class="content-title card-title">Floors</h2>
                <p>Add, edit, or delete a Floor</p>
            </div>

            <!-- Floor Form -->
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <h4>Add New Floor</h4>
                            <form action="{{ route('floors.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label for="apartment_id" class="form-label">Apartment <span class="text-danger">*</span></label>
                                    <select class="form-select" id="apartment_id" name="apartment_id" required>
                                        @foreach($apartments as $apartment)
                                            <option value="{{ $apartment->id }}">{{ $apartment->apartment_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="floor_number" class="form-label">Floor Number <span class="text-danger">*</span></label>
                                    <input type="number" placeholder="Enter floor number" class="form-control" id="floor_number" name="floor_number" required />
                                </div>
                                <div class="mb-3">
                                    <label for="total_rooms" class="form-label">Total Rooms</label>
                                    <input type="number" placeholder="Enter total rooms" class="form-control" id="total_rooms" name="total_rooms" />
                                </div>
                                <div class="mb-3">
                                    <label for="occupied_rooms" class="form-label">Occupied Rooms</label>
                                    <input type="number" placeholder="Enter occupied rooms" class="form-control" id="occupied_rooms" name="occupied_rooms" />
                                </div>
                                <div class="mb-3">
                                    <label for="floor_status" class="form-label">Floor Status <span class="text-danger">*</span></label>
                                    <select class="form-select" id="floor_status" name="floor_status" required>
                                        <option value="Available">Available</option>
                                        <option value="Partially Occupied">Partially Occupied</option>
                                        <option value="Fully Occupied">Fully Occupied</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="images" class="form-label">Images</label>
                                    <input type="file" class="form-control" id="images" name="images[]" multiple />
                                    <small class="text-muted">You can select multiple images.</small>
                                </div>
                                <div>
                                    <button type="submit" class="btn btn-primary w-100">Create Floor</button>
                                </div>
                            </form>
                        </div>

                        <!-- Floor Table -->
                        <div class="col-md-8">
                            <h4>Floor List</h4>
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Floor ID</th>
                                            <th>Apartment Name</th>
                                            <th>Floor Number</th>
                                            <th>Total Rooms</th>
                                            <th>Occupied Rooms</th>
                                            <th>Status</th>
                                            <th class="text-end">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($floors as $floor)
                                        <tr>
                                            <td>{{ $floor->id }}</td>
                                            <td>{{ $floor->apartment->apartment_name }}</td> <!-- Access apartment name from the floor's relationship -->
                                            <td>{{ $floor->floor_number }}</td>
                                            <td>{{ $floor->total_rooms }}</td>
                                            <td>{{ $floor->occupied_rooms }}</td>
                                            <td>{{ $floor->floor_status }}</td>
                                            <td class="text-end">
                                                <a href="{{ route('floors.edit', $floor->id) }}" class="btn btn-warning btn-sm" title="Edit">
                                                    <i class="icon material-icons md-edit"></i>
                                                </a>
                                                <button class="btn btn-danger btn-sm" onclick="confirmDeleteFloor({{ $floor->id }})" title="Delete">
                                                    <i class="icon material-icons md-delete"></i>
                                                </button>
                                                <form id="delete-floor-form-{{ $floor->id }}" action="{{ route('floors.destroy', $floor->id) }}" method="POST" style="display: none;">
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
            function confirmDeleteFloor(id) {
                if (confirm('Are you sure you want to delete this floor?')) {
                    document.getElementById(`delete-floor-form-${id}`).submit();
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
