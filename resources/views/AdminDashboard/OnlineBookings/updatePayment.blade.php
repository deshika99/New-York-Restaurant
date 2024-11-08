@extends('AdminDashboard.master')

@section('content')
<!DOCTYPE html>

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
                <h2 class="content-title card-title">Update Payments</h2>

            </div>
            <div>
                <input type="text" placeholder="" class="form-control bg-white" />
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <form action="{{ route('staff.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                            <div class="mb-4 col-md-6">
                                <label for="first_name" class="form-label">Total Charge <span class="text-danger">*</span></label>
                                <input type="text" placeholder="Type first name here" class="form-control" id="first_name" name="first_name" required />
                            </div>

                            <div class="mb-4 col-md-6">
                                <label for="last_name" class="form-label">Last Name <span class="text-danger">*</span></label>
                                <input type="text" placeholder="Type last name here" class="form-control" id="last_name" name="last_name" required />
                            </div>

                            <div class="mb-4 col-md-6">
                                <label for="contact" class="form-label">Phone Number <span class="text-danger">*</span></label>
                                <input type="number" placeholder="Enter phone number" class="form-control" id="contact" name="contact" required />
                            </div>

                            <div class="mb-4 col-md-6">
                                <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                                <input type="text" placeholder="Type email address" class="form-control" id="email" name="email" required />
                            </div>

                            <div class="mb-4 col-md-6">
                                <label for="address" class="form-label">Address</label>
                                <textarea placeholder="Type address here" class="form-control" id="address" name="address"></textarea>
                            </div>

                            <div class="mb-4 col-md-6">
                                <label for="date_hired" class="form-label">Date Hired <span class="text-danger">*</span></label>
                                <input type="date" placeholder="Enter date" class="form-control" id="date_hired" name="date_hired" required />
                            </div>

                            <div class="mb-4 col-md-6">
                                <label for="shift_details" class="form-label">Shift Details <span class="text-danger">*</span></label>
                                <textarea placeholder="Type details here" class="form-control" id="shift_details" name="shift_details" required></textarea>
                            </div>

                            <div class="mb-4 col-md-6">
                                <label for="notes" class="form-label">Notes</label>
                                <textarea placeholder="Type notes here" class="form-control" id="notes" name="notes"></textarea>
                            </div>

                            <div class="mb-4 col-md-6">
                                <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                                <select class="form-select" id="status" name="status" required>
                                    <option value="1">Active</option>
                                    <option value="0">Deactive</option>
                                </select>
                            </div>
                            </div>

                            <div class="d-grid col-md-6">
                                <button type="submit" class="btn btn-primary">Create Staff Member</button>
                            </div>
                        </form>
                    </div>

                </div>
                <!-- .row // -->
            </div>
            <!-- card body .// -->
        </div>

      
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