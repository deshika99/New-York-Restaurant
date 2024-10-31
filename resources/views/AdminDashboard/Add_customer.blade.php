@extends('AdminDashboard.master')

@section('content')
<div class="content-header">
    <h2 class="content-title">Add Customer</h2>
</div>
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="col-lg-12">
    <div class="card mb-4">
        <div class="card-header">
            <h4>Basic</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('customers.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-lg-12 mb-4">
                        <label for="first_name" class="form-label">Full Name</label>
                        <input type="text" name="name" class="form-control" id="name" required />
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6 mb-4">
                        <label for="phone_number" class="form-label">Phone Number</label>
                        <input type="text" name="phone_number" class="form-control" id="phone_number" required />
                    </div>
                    <div class="col-lg-6 mb-4">
                        <label for="whatsapp_number" class="form-label">WhatsApp Number</label>
                        <input type="text" name="whatsapp_number" class="form-control" id="whatsapp_number" />
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6 mb-4">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" id="email" required />
                    </div>
                    <div class="col-lg-6 mb-4">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" id="password" required />
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 mb-4">
                        <label class="form-label">Note</label>
                        <textarea name="note" class="form-control" rows="4"></textarea>
                    </div>
                </div>
                <div>
            <a href="{{ route('customer_section') }}" class="btn btn-primary">Save</a>
        </div>

            </form>
        </div>
    </div>
</div>

@endsection
