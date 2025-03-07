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
            <h2 class="content-title card-title">Promotions</h2>
            <p>Add, edit, or delete a promotions</p>
        </div>

        <!-- Form -->
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3">
                        <h4>Add New Promotion</h4>
                        <form action="{{ route('promotion.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label">Promotion Name <span class="text-danger">*</span></label>
                                <input type="text" placeholder="Enter promotion name" class="form-control" id="name" name="name" required />
                            </div>
                            <div class="mb-3">
                                <label for="start_date" class="form-label">Promotion Start Date <span class="text-danger">*</span></label>
                                <input type="date" placeholder="Enter promotion start date" class="form-control" id="start_date" name="start_date" required />
                            </div>
                            <div class="mb-3">
                                <label for="end_date" class="form-label">Promotion End Date <span class="text-danger">*</span></label>
                                <input type="date" placeholder="Enter promotion end date" class="form-control" id="end_date" name="end_date" required />
                            </div>
                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea placeholder="Enter promotion description" class="form-control" id="description" name="description"></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="discount_percentage" class="form-label">Discount Percentage (%) <span class="text-danger">*</span></label>
                                <input type="number" placeholder="Enter discount percentage" class="form-control" id="discount_percentage" name="discount_percentage" required />
                            </div>
                            <div class="mb-3">
                                <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                                <select class="form-select" id="status" name="status" required>
                                    <option value="1">Active</option>  
                                    <option value="0">Deactive</option>
                                </select>
                            </div>

                            <div>
                                <button type="submit" class="btn btn-primary w-100">Create Promotion</button>
                            </div>
                        </form>
                    </div>

                    <!-- Table -->
                    <div class="col-md-9">
                        <h4>Promotion List</h4>
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>          
                                    <tr>
                                        <th>#</th>
                                        <th>Promotion Name</th>
                                        <th>Promotion Code</th>
                                        <th>Discount</th>
                                        <th>Duration</th>
                                        <th>Description</th>
                                        <th>Status</th>
                                        <th class="text-end">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($promotions as $index=>$promotion)
                                    <tr>
                                        <td>{{ $index+1 }}</td>
                                        <td>{{ $promotion->promotion_name }}</td>
                                        <td>{{ $promotion->promotion_code }}</td>
                                        <td>{{ $promotion->discount_percentage }}%</td>
                                        <td>{{ $promotion->start_date }} <br/>To <br/>{{ $promotion->end_date }}</td>
                                        <td>{{ $promotion->description ?? 'No' }}</td>
                                        <td>
                                            @if ($promotion->status=='1')
                                            Active
                                            @elseif($promotion->status=='0')
                                            Deactive
                                            @endif
                                        </td>
                                        
                                        <td class="text-end">
                                            <a href="{{ route('promotion.edit', $promotion->id) }}" class="btn btn-warning btn-sm" title="Edit">
                                                <i class="icon material-icons md-edit"></i>
                                            </a>
                                            <button class="btn btn-danger btn-sm" onclick="confirmDeletePromotion('{{ $promotion->id }}')" title="Delete">
                                                <i class="icon material-icons md-delete"></i>
                                            </button>
                                            <form id="delete-promotion-form-{{ $promotion->id }}" action="{{ route('promotion.destroy', $promotion->id) }}" method="POST" style="display: none;">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

    <!-- JavaScript to handle delete confirmation -->
    <script>
        function confirmDeletePromotion(id) {
            if (confirm('Are you sure you want to delete this promotion?')) {
                document.getElementById(`delete-promotion-form-${id}`).submit();
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