@extends('AdminDashboard.master')

@section('content')
<!DOCTYPE html>
<html lang="en">

<head>
    <style>
        /* Add any additional styling you may need */
    </style>
</head>

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
        <h2 class="content-title">Add New Customer</h2>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('store.customers') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="fname" class="form-label">First Name <span class="text-danger">*</span></label>
                    <input type="text" name="fname" id="fname" class="form-control" required>
                </div>

                <div class="mb-4">
                    <label for="lname" class="form-label">Last Name <span class="text-danger">*</span></label>
                    <input type="text" name="lname" id="lname" class="form-control" required>
                </div>

                <div class="mb-4">
                    <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                    <input type="email" name="email" id="email" class="form-control" required>
                </div>

                <div class="mb-4">
                    <label for="phone_number" class="form-label">Phone Number <span class="text-danger">*</span></label>
                    <input type="text" name="phone_number" id="phone_number" class="form-control" required>
                </div>

                <div class="mb-4">
                    <label for="whatsapp_number" class="form-label">WhatsApp Number (Optional)</label>
                    <input type="text" name="whatsapp_number" id="whatsapp_number" class="form-control">
                </div>

                <div class="mb-4">
                    <label for="address" class="form-label">Address (Optional)</label>
                    <textarea name="address" id="address" class="form-control"></textarea>
                </div>

                <div class="mb-4">
                    <label for="note" class="form-label">Notes (Optional)</label>
                    <textarea name="note" id="note" class="form-control"></textarea>
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-primary">Save Customer</button>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection
</body>
</html>
