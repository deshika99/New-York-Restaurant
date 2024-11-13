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
                        <form action="{{ route('companyDetails.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <!-- Company Name -->
                                <div class="mb-4 col-md-6">
                                    <label for="company_name" class="form-label">Company Name <span class="text-danger">*</span></label>
                                    <input type="text" placeholder="Type company name here" class="form-control" id="company_name" name="company_name" value="{{ $companyDetails->company_name ?? '' }}" required />
                                </div>

                                <!-- Company Logo -->
                                <div class="mb-4 col-md-6">
                                    <label for="company_logo" class="form-label">Company Logo</label>
                                    <input type="file" class="form-control" id="company_logo" name="company_logo" />
                                    @if (!empty($companyDetails->company_logo))
                                    <img src="{{ Storage::url($companyDetails->company_logo) }}" alt="Company Logo" width="100" class="mt-2" />
                                    @endif
                                </div>

                                <!-- Contact -->
                                <div class="mb-4 col-md-6">
                                    <label for="contact" class="form-label">Contact Number <span class="text-danger">*</span></label>
                                    <input type="text" placeholder="Type contact number here" class="form-control" id="contact" name="contact" value="{{ $companyDetails->contact ?? '' }}" required />
                                </div>

                                <!-- Email -->
                                <div class="mb-4 col-md-6">
                                    <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                                    <input type="email" placeholder="Type email here" class="form-control" id="email" name="email" value="{{ $companyDetails->email ?? '' }}" required />
                                </div>

                                <!-- Address -->
                                <div class="mb-4 col-md-12">
                                    <label for="address" class="form-label">Address <span class="text-danger">*</span></label>
                                    <input type="text" placeholder="Type address here" class="form-control" id="address" name="address" value="{{ $companyDetails->address ?? '' }}" required />
                                </div>

                                <!-- Facebook -->
                                <div class="mb-4 col-md-6">
                                    <label for="facebook" class="form-label">Facebook</label>
                                    <input type="text" placeholder="Facebook URL" class="form-control" id="facebook" name="facebook" value="{{ $companyDetails->facebook ?? '' }}" />
                                </div>

                                <!-- Instagram -->
                                <div class="mb-4 col-md-6">
                                    <label for="instagram" class="form-label">Instagram</label>
                                    <input type="text" placeholder="Instagram URL" class="form-control" id="instagram" name="instagram" value="{{ $companyDetails->instagram ?? '' }}" />
                                </div>

                                <!-- Website -->
                                <div class="mb-4 col-md-6">
                                    <label for="website" class="form-label">Website</label>
                                    <input type="text" placeholder="Website URL" class="form-control" id="website" name="website" value="{{ $companyDetails->website ?? '' }}" />
                                </div>

                                <!-- Location -->
                                <div class="mb-4 col-md-6">
                                    <label for="location" class="form-label">Location</label>
                                    <textarea placeholder="Type location here" class="form-control" id="location" name="location" rows="3">{{ $companyDetails->location ?? '' }}</textarea>
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