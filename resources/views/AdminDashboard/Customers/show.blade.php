@extends('AdminDashboard.master')

@section('content')
<section class="content-main">
    <div class="content-header">
        <h2 class="content-title">Customer Details</h2>
    </div>
    <div class="card">
        <div class="card-body">
            <h5>Name: {{ $customer->fname }} {{ $customer->lname }}</h5>
            <p>Email: {{ $customer->email }}</p>
            <p>Phone Number: {{ $customer->phone_number }}</p>
            <p>WhatsApp Number: {{ $customer->whatsapp_number ?? 'N/A' }}</p>
            <p>Address: {{ $customer->address ?? 'N/A' }}</p>
            <p>Notes: {{ $customer->notes ?? 'N/A' }}</p>
            <p>Total Bookings: {{ $customer->total_bookings }}</p>
            <p>Date Joined: {{ $customer->created_at->format('Y-m-d') }}</p>
            <p>Preferred Payment Method: {{ $customer->preferred_payment_method ?? 'N/A' }}</p>
            <a href="{{ route('customers.showlist') }}" class="btn btn-secondary">Back to Customers List</a>
        </div>
    </div>
</section>
@endsection
