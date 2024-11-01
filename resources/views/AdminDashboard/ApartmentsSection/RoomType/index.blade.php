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
                <h2 class="content-title card-title">Room Types</h2>
                <p>Add, edit, or delete a Room Type</p>
            </div>

            <!-- Room Type Form -->
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <h4>Add New Room Type</h4>
                            <form action="{{ route('room-types.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label for="type_name" class="form-label">Type Name <span class="text-danger">*</span></label>
                                    <input type="text" placeholder="Enter room type name" class="form-control" id="type_name" name="type_name" required />
                                </div>
                                <div class="mb-3">
                                    <label for="description" class="form-label">Description</label>
                                    <textarea placeholder="Enter room type description" class="form-control" id="description" name="description"></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="images" class="form-label">Images</label>
                                    <input type="file" class="form-control" id="images" name="images[]" multiple />
                                    <small class="text-muted">You can select multiple images.</small>
                                </div>
                                <div>
                                    <button type="submit" class="btn btn-primary w-100">Create Room Type</button>
                                </div>
                            </form>
                        </div>

                        <!-- Room Type Table -->
                        <div class="col-md-8">
                            <h4>Room Type List</h4>
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Type ID</th>
                                            <th>Type Name</th>
                                            <th>Description</th>
                                            <th>Images</th>
                                            <th class="text-end">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($roomTypes as $roomType)
                                        <tr>
                                            <td>{{ $roomType->id }}</td>
                                            <td>{{ $roomType->type_name }}</td>
                                            <td>{{ $roomType->description }}</td>
                                            <td>
                                                @if($roomType->images)
                                                    @foreach(json_decode($roomType->images) as $image)
                                                        <img src="{{ asset('storage/' . $image) }}" alt="Room Type Image" class="img-thumbnail" width="50">
                                                    @endforeach
                                                @endif
                                            </td>
                                            <td class="text-end">
                                                <a href="{{ route('room-types.edit', $roomType->id) }}" class="btn btn-warning btn-sm" title="Edit">
                                                    <i class="icon material-icons md-edit"></i>
                                                </a>
                                                <button class="btn btn-danger btn-sm" onclick="confirmDeleteRoomType({{ $roomType->id }})" title="Delete">
                                                    <i class="icon material-icons md-delete"></i>
                                                </button>
                                                <form id="delete-room-type-form-{{ $roomType->id }}" action="{{ route('room-types.destroy', $roomType->id) }}" method="POST" style="display: none;">
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
            function confirmDeleteRoomType(id) {
                if (confirm('Are you sure you want to delete this room type?')) {
                    document.getElementById(`delete-room-type-form-${id}`).submit();
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
