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
                <h2 class="content-title card-title">Company Details</h2>
            </div>

        </div>
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <form action="{{ route('bankDetails.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <!-- Bank Name -->
                                <div class="mb-4 col-md-6">
                                    <label for="bank_name" class="form-label">Bank Name <span class="text-danger">*</span></label>
                                    <input type="text" placeholder="Type bank name here" class="form-control" id="bank_name" name="bank_name" value="{{ $bankDetails->bank_name ?? '' }}" required />
                                </div>

                                <!-- Account Number -->
                                <div class="mb-4 col-md-6">
                                    <label for="account_number" class="form-label">Account Number <span class="text-danger">*</span></label>
                                    <input type="text" placeholder="Type account number here" class="form-control" id="account_number" name="account_number" value="{{ $bankDetails->account_number ?? '' }}" required />
                                </div>

                                <!-- Account Holder -->
                                <div class="mb-4 col-md-6">
                                    <label for="account_holder" class="form-label">Account Holder <span class="text-danger">*</span></label>
                                    <input type="text" placeholder="Type account holder name here" class="form-control" id="account_holder" name="account_holder" value="{{ $bankDetails->account_holder ?? '' }}" required />
                                </div>

                                <!-- Branch -->
                                <div class="mb-4 col-md-6">
                                    <label for="branch" class="form-label">Branch <span class="text-danger">*</span></label>
                                    <input type="text" placeholder="Type branch here" class="form-control" id="branch" name="branch" value="{{ $bankDetails->branch ?? '' }}" required />
                                </div>

                                <!-- WhatsApp Number -->
                                <div class="mb-4 col-md-6">
                                    <label for="whatsapp_number" class="form-label">WhatsApp Number <span class="text-danger">*</span></label>
                                    <input type="text" placeholder="Type WhatsApp number here" class="form-control" id="whatsapp_number" name="whatsapp_number" value="{{ $bankDetails->whatsapp_number ?? '' }}" required />
                                </div>
                            </div>

                            <!-- Submit Button -->
                            <div class="d-grid col-md-6">
                                <button type="submit" class="btn btn-primary">Save</button>
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