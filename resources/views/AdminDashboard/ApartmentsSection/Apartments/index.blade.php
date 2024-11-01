@extends('AdminDashboard.master')

@section('content')
<!DOCTYPE html>
</style>
<html lang="en">

    <body>
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
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
                    <div>
                        <h2 class="content-title card-title">Apartments</h2>
                        <p>Add, edit or delete a Apartment</p>
                    </div>
                    <div>
                        <input type="text" placeholder="Search Apartments" class="form-control bg-white" />
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3">
                                <form action="{{ route('apartments.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="mb-4">
                                        <label for="location_name" class="form-label">Location Name <span class="text-danger">*</span></label>
                                        <input type="text" placeholder="Type location name here" class="form-control" id="location_name" name="location_name" required />
                                    </div>
                                    
                                    <div class="mb-4">
                                        <label for="apartment_name" class="form-label">Apartment Name <span class="text-danger">*</span></label>
                                        <input type="text" placeholder="Type apartment name here" class="form-control" id="apartment_name" name="apartment_name" required />
                                    </div>
                                    
                                    <div class="mb-4">
                                        <label for="total_floors" class="form-label">Total Floors</label>
                                        <input type="number" placeholder="Enter number of floors" class="form-control" id="total_floors" name="total_floors"  />
                                    </div>
                                    
                                    <div class="mb-4">
                                        <label for="total_units" class="form-label">Total Units </label>
                                        <input type="number" placeholder="Enter number of units" class="form-control" id="total_units" name="total_units"  />
                                    </div>
                                    
                                    <div class="mb-4">
                                        <label for="address" class="form-label">Address <span class="text-danger">*</span></label>
                                        <textarea placeholder="Type address here" class="form-control" id="address" name="address" required></textarea>
                                    </div>
                                    
                                    <div class="mb-4">
                                        <label for="amenities" class="form-label">Amenities </label>
                                        <input type="text" placeholder="Enter amenities separated by commas" class="form-control" id="amenities" name="amenities"  />
                                    </div>
                                    
                                    <div class="mb-4">
                                        <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                                        <select class="form-select" id="status" name="status" required>
                                            <option value="Available">Available</option>
                                            <option value="Occupied">Occupied</option>
                                            <option value="Under Maintenance">Under Maintenance</option>
                                        </select>
                                    </div>
                                    
                                    <div class="mb-4">
                                        <label for="images" class="form-label">Images </label>
                                        <input type="file" class="form-control" id="images" name="images[]" multiple  />
                                        <small class="text-muted">You can select multiple images.</small>
                                    </div>
                                    
                                    <div class="d-grid">
                                        <button type="submit" class="btn btn-primary">Create Apartment</button>
                                    </div>
                                </form>
                            </div>


                            <div class="col-md-9">
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                
                                                <th>ID</th>
                                                <th>Location Name</th>
                                                <th>Apartment Name</th>
                                                <th>Total Floors</th>
                                                <th>Total Units</th>
                                                <th>Status</th>
                                                <th class="text-end">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($apartments as $apartment)
                                            <tr>
                                                
                                                <td>{{ $apartment->id }}</td>
                                                <td>{{ $apartment->location_name }}</td>
                                                <td>{{ $apartment->apartment_name }}</td>
                                                <td>{{ $apartment->total_floors }}</td>
                                                <td>{{ $apartment->total_units }}</td>
                                                <td>{{ $apartment->status }}</td>
                                                <td class="text-end">
                                                    <a href="{{ route('apartments.show', $apartment->id) }}" class="btn btn-info btn-sm" title="View">
                                                        <i class="icon material-icons md-visibility"></i>
                                                    </a>
                                                    <a href="{{ route('apartments.edit', $apartment->id) }}" class="btn btn-warning btn-sm" title="Edit">
                                                        <i class="icon material-icons md-edit"></i>
                                                    </a>
                                                    <button class="btn btn-danger btn-sm" onclick="confirmDelete({{ $apartment->id }})" title="Delete">
                                                        <i class="icon material-icons md-delete"></i>
                                                    </button>
                                                    <form id="delete-form-{{ $apartment->id }}" action="{{ route('apartments.destroy', $apartment->id) }}" method="POST" style="display: none;">
                                                        @csrf
                                                        @method('DELETE')
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                            <!-- Repeat similar rows as needed -->
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <!-- .col// -->
                        </div>
                        <!-- .row // -->
                    </div>
                    <!-- card body .// -->
                </div>
                <!-- card .// -->
            </section>
            <!-- content-main end// -->
            <footer class="main-footer font-xs">
                <div class="row pb-30 pt-15">
                    <div class="col-sm-6">
                        <script>
                            document.write(new Date().getFullYear());
                        </script>
                        &copy; e-support Technologies .
                    </div>
                    <div class="col-sm-6">
                        <div class="text-sm-end">All rights reserved</div>
                    </div>
                </div>
            </footer>

            <!-- JavaScript to handle delete confirmation -->
        <script>
            function confirmDelete(id) {
                if (confirm('Are you sure you want to delete this apartment?')) {
                    document.getElementById(`delete-form-${id}`).submit();
                }
            }
        </script>
        
        <script src="backend/assets/js/vendors/jquery-3.6.0.min.js"></script>
        <script src="backend/assets/js/vendors/bootstrap.bundle.min.js"></script>
        <script src="backend/assets/js/vendors/select2.min.js"></script>
        <script src="backend/assets/js/vendors/perfect-scrollbar.js"></script>
        <script src="backend/assets/js/vendors/jquery.fullscreen.min.js"></script>
        <!-- Main Script -->
        <script src="backend/assets/js/main.js?v=6.0" type="text/javascript"></script>
    </body>
</html>

@endsection
