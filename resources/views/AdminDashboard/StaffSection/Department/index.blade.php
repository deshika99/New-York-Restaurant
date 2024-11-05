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
                <h2 class="content-title card-title">Departments</h2>
                <p>Add, edit, or delete a Department</p>
            </div>

            <!-- Form -->
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <h4>Add New Department</h4>
                            <form action="{{ route('department.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label for="name" class="form-label">Department Name <span class="text-danger">*</span></label>
                                    <input type="text" placeholder="Enter department name" class="form-control" id="name" name="name" required />
                                </div>
                                <div class="mb-3">
                                    <label for="description" class="form-label">Description</label>
                                    <textarea placeholder="Enter department description" class="form-control" id="description" name="description"></textarea>
                                </div>
                                  
                                <div>
                                    <button type="submit" class="btn btn-primary w-100">Create Department</button>
                                </div>
                            </form>
                        </div>

                        <!-- Table -->
                        <div class="col-md-8">
                            <h4>Department List</h4>
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Department ID</th>
                                            <th>Department Name</th>
                                            <th>Description</th>
                                            <th class="text-end">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($departments as $department)
                                        <tr>
                                            <td>{{ $department->id }}</td>
                                            <td>{{ $department->name }}</td>
                                            <td>{{ $department->description }}</td>
                                            <td class="text-end">
                                                <a href="{{ route('department.edit', $department->id) }}" class="btn btn-warning btn-sm" title="Edit">
                                                    <i class="icon material-icons md-edit"></i>
                                                </a>
                                                <button class="btn btn-danger btn-sm" onclick="confirmDeleteDepartment('{{ $department->id }}')" title="Delete">
                                                    <i class="icon material-icons md-delete"></i>
                                                </button>
                                                <form id="delete-department-form-{{ $department->id }}" action="{{ route('department.destroy', $department->id) }}" method="POST" style="display: none;">
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
            function confirmDeleteDepartment(id) {
                if (confirm('Are you sure you want to delete this department?')) {
                    document.getElementById(`delete-department-form-${id}`).submit();
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