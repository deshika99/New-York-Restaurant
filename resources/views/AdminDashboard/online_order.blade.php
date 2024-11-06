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
                        <h2 class="content-title card-title">Online Order</h2>
                        <p>Update or delete a Order</p>
                    </div>
                    <div>
                        <input type="text" placeholder="Search Orders" class="form-control bg-white" />
                    </div>
                </div>

                <div class="col-md-12">
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                
                                            <th>Booking ID</th>
                                            <th>Customer Name</th>
                                            <th>Contact Info</th>
                                            <th>Room & Dates</th>
                                            <th>Booking Type</th>
                                            <th>Payment Details</th>
                                            <th>Bank Transfer Confirmation</th>
                                            <th class="text-end">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                

@endsection
