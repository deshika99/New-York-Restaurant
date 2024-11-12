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
        <div>
            <h2 class="content-title card-title">Report - Online Bookings</h2>
        </div>
       
    </div>

    <div class="card mb-4">
        <header class="card-header">
            <div class="row gx-3">
                
                <div class="col-lg-2 col-6 col-md-3">
                    <select class="form-select">
                        <option>Status</option>
                        <option>Active</option>
                        <option>Disabled</option>
                        <option>Show all</option>
                    </select>
                </div>
                <div class="col-lg-2 col-6 col-md-3">
                    <select class="form-select">
                        <option>Show 20</option>
                        <option>Show 30</option>
                        <option>Show 40</option>
                    </select>
                </div>
            </div>
        </header>
        <!-- card-header end// -->

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">Booking ID</th>
                            <th scope="col">Name</th>
                            <th scope="col">Contact</th>
                            <th scope="col">Booking Date</th>
                            <th scope="col">Room</th>
                            <th scope="col">Apartment</th>
                            <th scope="col">Checkin-Date</th>
                            <th scope="col">Checkout-Date</th>
                            <th scope="col">Booking Status</th>
                            <th scope="col">Payment Type</th>
                            <th scope="col">Payment Status</th>
                            <th scope="col" class="text-end">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($bookings as $booking)
                            <tr>
                                <td>OB{{ $booking->id }}</td>
                                <td>{{ $booking->customer->fname }} {{ $booking->customer->lname }}</td>
                                <td>{{ $booking->customer->phone_number }}</td>
                                <td>{{ $booking->booking_date }}</td>
                                <td>{{ $booking->room->room_number }}</td>
                                <td>{{ $booking->room->apartment->apartment_name }}</td>
                                <td>{{ $booking->start_date }}</td>
                                <td>{{ $booking->end_date }}</td>
                                <td>{{ $booking->booking_status }}</td>
                                <td>{{ $booking->payment->payment_type }}</td>
                                <td>{{ $booking->payment->payment_status }}</td>
                                <td class="text-end">
                                <a href="{{ route('onlinebooking.details', $booking->id) }}" class="btn btn-success font-sm"><i class="material-icons md-visibility"></i></a>
                                </td> 
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- table-responsive //end -->
        </div>
        <!-- card-body end// -->
    </div>
    <!-- card end// -->

    <!-- Pagination Section -->
    <div class="pagination-area mt-15 mb-50">
        <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-start">
                {{ $bookings->links() }}
            </ul>
        </nav>
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