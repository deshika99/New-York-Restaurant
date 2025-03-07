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
            <h2 class="content-title">Edit Promotion</h2>
            <p>Update promotion details</p>
        </div>

        <div class="card">
            <div class="card-body col-md-6">
                <form action="{{ route('promotion.update', $promotion->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="name" class="form-label">Promotion Name <span class="text-danger">*</span></label>
                        <input type="text" value="{{ old('name', $promotion->promotion_name) }}" placeholder="Enter promotion name" class="form-control" id="name" name="name" required />
                    </div>
                    <div class="mb-3">
                        <label for="promotion_code" class="form-label">Promotion Code</label>
                        <input type="text" value="{{ $promotion->promotion_code }}" class="form-control" id="promotion_code" name="promotion_code" readonly />
                    </div>
                    <div class="mb-3">
                        <label for="start_date" class="form-label">Promotion Start Date <span class="text-danger">*</span></label>
                        <input type="date" value="{{ old('start_date', $promotion->start_date) }}" class="form-control" id="start_date" name="start_date" required />
                    </div>
                    <div class="mb-3">
                        <label for="end_date" class="form-label">Promotion End Date <span class="text-danger">*</span></label>
                        <input type="date" value="{{ old('end_date', $promotion->end_date) }}" class="form-control" id="end_date" name="end_date" required />
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea placeholder="Enter promotion description" class="form-control" id="description" name="description">{{ old('description', $promotion->description) }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label for="discount_percentage" class="form-label">Discount Percentage (%) <span class="text-danger">*</span></label>
                        <input type="number" value="{{ old('discount_percentage', $promotion->discount_percentage) }}" class="form-control" id="discount_percentage" name="discount_percentage" required />
                    </div>
                    <div class="mb-3">
                        <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                        <select class="form-select" id="status" name="status" required>
                            <option value="1" {{ $promotion->status == 1 ? 'selected' : '' }}>Active</option>
                            <option value="0" {{ $promotion->status == 0 ? 'selected' : '' }}>Deactive</option>
                        </select>
                    </div>
                    <div>
                        <button type="submit" class="btn btn-primary w-100">Update Promotion</button>
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