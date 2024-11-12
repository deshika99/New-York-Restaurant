@extends ('AdminDashboard.master')

@section('content')

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
<div class="content-header">
        <div>
            <h2 class="content-title card-title">Create Booking</h2>    
        </div>
    </div>

    <div class="col-lg-12">
    <div class="card mb-4">
        <div class="card-header">
            <h4>Basic</h4>
        </div>
        <div class="card-body">
        <form action="{{ route('orders.store') }}" method="POST">
    @csrf

    <input type="hidden" name="customer_id" value="{{ $customer->id ?? '' }}">
    
    <div class="row">
        <div class="col-lg-12 mb-4">
            <label for="name" class="form-label">Customer Name</label>
            <input type="text" name="name" class="form-control" id="name" required />
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6 mb-4">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" class="form-control" id="email" required />
        </div>
        <div class="col-lg-6 mb-4">
            <label for="phone_number" class="form-label">Phone Number</label>
            <input type="text" name="phone_number" class="form-control" id="phone_number" required />
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6 mb-4">
            <label for="bookingType" class="form-label">Booking Type</label>
            <select name="bookingType" id="bookingType" class="form-control" required>
                <option value="online">Online</option>
                <option value="in-office">In-Office</option>
            </select>
        </div>
        <div class="col-lg-6 mb-4">
            <label for="roomSelection" class="form-label">Room Section</label>
            <select name="roomSelection" id="roomSelection" class="form-control" required>
                <option value="room1">Room 1</option>
                <option value="room2">Room 2</option>
                <option value="room3">Room 3</option>
            </select>
        </div>
    </div>
    <!-- Start and End Date -->
    <div class="row">
        <div class="col-lg-6 mb-4">
            <label for="startDate" class="form-label">Booking Start Date</label>
            <input type="date" name="startDate" class="form-control" id="startDate" required />
        </div>
        <div class="col-lg-6 mb-4">
            <label for="endDate" class="form-label">Booking End Date</label>
            <input type="date" name="endDate" class="form-control" id="endDate" required />
        </div>
    </div>
    <!-- Payment Details -->
    <div class="row">
        <div class="col-lg-6 mb-4">
            <label for="paymentTerms" class="form-label">Payment Terms</label>
            <select name="paymentTerms" id="paymentTerms" class="form-control" required>
                <option value="short">Short-Term</option>
                <option value="long">Long-Term</option>
            </select>
        </div>
        <div class="col-lg-6 mb-4">
            <label for="paymentMethod" class="form-label">Payment Method</label>
            <select name="paymentMethod" id="paymentMethod" class="form-control" required>
                <option value="cash">Cash</option>
                <option value="card">Card</option>
                <option value="bank">Bank Transfer</option>
            </select>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6 mb-4">
            <label for="discount" class="form-label">Discount (%)</label>
            <input type="number" name="discount" class="form-control" id="discount" min="0" max="100" />
        </div>
        <div class="col-lg-6 mb-4">
            <label for="serviceCharge" class="form-label">Service Charge</label>
            <input type="text" name="serviceCharge" class="form-control" id="serviceCharge" readonly />
        </div>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>

        </div>
    </div>
</div>

<script>
    const BASE_COST = 100; // Example base cost per order
    const SERVICE_CHARGE_PERCENTAGE = 10;

    function calculateServiceCharge() {
        const serviceCharge = (BASE_COST * SERVICE_CHARGE_PERCENTAGE) / 100;
        document.getElementById("serviceCharge").textContent = serviceCharge.toFixed(2);
    }

    function calculateTotal() {
        const discount = parseFloat(document.getElementById("discount").value) || 0;
        const paymentTerms = document.getElementById("paymentTerms").value;
        const paymentMessage = document.getElementById("paymentMessage");

        let total = BASE_COST;
        let finalPaymentMessage = '';

        if (paymentTerms === "short") {
            // 50% Payment for Short-Term Booking
            total = (total * 0.5) + (BASE_COST * SERVICE_CHARGE_PERCENTAGE / 100);
            finalPaymentMessage = `Total Payment (50%): <span>$${total.toFixed(2)}</span>`;
        } else if (paymentTerms === "long") {
            // Display Refundable Advance Message for Long-Term Booking
            finalPaymentMessage = "Refundable Advance: Please contact for details.";
            total = 0; // No payment calculation needed
        }

        // Apply discount if applicable
        if (discount > 0 && paymentTerms === "short") {
            total -= (total * discount) / 100;
        }

        paymentMessage.innerHTML = finalPaymentMessage;
        document.getElementById("totalPayment").textContent = total.toFixed(2);
    }

    function calculateBookingDuration() {
        const startDate = document.getElementById("startDate").value;
        const endDate = document.getElementById("endDate").value;
        const paymentTerms = document.getElementById("paymentTerms");

        if (startDate && endDate) {
            const start = new Date(startDate);
            const end = new Date(endDate);
            const differenceInDays = (end - start) / (1000 * 60 * 60 * 24);

            // Update Payment Terms based on duration
            if (differenceInDays > 15) {
                paymentTerms.value = "long";
            } else {
                paymentTerms.value = "short";
            }
        }
    }

    window.onload = function() {
        calculateServiceCharge();
    };
</script>

<script>
    function populateCustomerDetails() {
        const customerSelect = document.getElementById('customerSelect');
        const selectedOption = customerSelect.options[customerSelect.selectedIndex];

        // Get the data attributes
        const customerName = selectedOption.getAttribute('data-name');
        const customerPhone = selectedOption.getAttribute('data-phone');
        const customerEmail = selectedOption.getAttribute('data-email');

        // Populate the fields
        document.getElementById('name').value = customerName || '';
        document.getElementById('phone_number').value = customerPhone || '';
        document.getElementById('email').value = customerEmail || '';
    }
</script>


@endsection