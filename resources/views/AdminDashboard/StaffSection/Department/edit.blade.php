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
                <h2 class="content-title">Edit Department</h2>
                <p>Update department details</p>
            </div>

            <div class="card">
                <div class="card-body">
                    <form action="{{ route('department.update', $department->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Name -->
                        <div class="mb-4">
                            <label for="name" class="form-label">Department Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter department name" value="{{ old('name', $department->name) }}" required>
                        </div>

                        <!-- Description -->
                        <div class="mb-4">          
                            <label for="description" class="form-label">Description</label>              
                            <textarea class="form-control" id="description" name="description" placeholder="Enter department description">{{ old('description', $department->description) }}</textarea>
                        </div>

                        <!-- Update Button -->
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">Update Department</button>
                        </div>
                    </form>
                </div>
            </div>
        </section>

        <script>
           

        </script>
    </body>
</html>
@endsection