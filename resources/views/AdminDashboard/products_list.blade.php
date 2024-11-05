@extends ('AdminDashboard.master')

@section('content')

<div class="content-header">
    <div>
        <h2 class="content-title card-title">Products List</h2>
    </div>
    <div>
        <a href="#" class="btn btn-light rounded font-md">Export</a>
        <a href="#" class="btn btn-light rounded font-md">Import</a>
        <a href="{{ route('add_products') }}" class="btn btn-primary btn-sm rounded">Create new</a>
    </div>
</div>

<div class="card mb-4">
    <header class="card-header">
        <div class="row align-items-center">
            <div class="col col-check flex-grow-0">
                <div class="form-check ms-2">
                    <input class="form-check-input" type="checkbox" value="" />
                </div>
            </div>
            <div class="col-md-3 col-12 me-auto mb-md-0 mb-3">
                <select class="form-select">
                    <option selected>All category</option>
                </select>
            </div>
            <div class="col-md-2 col-6">
                <input type="date" value="02.05.2021" class="form-control" />
            </div>
        </div>
    </header>
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table table-hover">
                    <thead>
                        <tr>
                            <th class="text-center">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" />
                                </div>
                            </th>
                            <th>#</th>
                            <th>Product ID</th>
                            <th>Product</th>
                            <th>Category</th>
                            <th>Quantity</th>
                            <th>Total Price</th>
                            <th class="text-end">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($products as $product)
                                <tr>
                                    <td class="text-center">
                                        <div class="form-check">
                                         <input class="form-check-input" type="checkbox" value="" />
                                        </div>
                                    </td>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $product->product_id }}</td>
                                    <td>
                                            <div class="col-lg-2 col-sm-4 col-8 flex-grow-1 col-name">
                                                <a class="itemside" href="#">
                                                    <div class="left">
                                                        <img src="{{ asset('storage/' . $product->images->first()->image_path) }}" class="img-sm img-thumbnail" alt="Item" />
                                                    </div>
                                                    <div class="info">
                                                        <h6 class="mb-0">{{ $product->product_name }}</h6>
                                                    </div>
                                                </a>
                                            </div>
                                    </td>
                                    <td>{{ $product->category->name ?? 'N/A' }}</td>
                                    <td>{{ $product->quantity }}</td>
                                    <td>Rs. {{ $product->total_price }}</td>
                                    <td class="text-end">
                                        <div>
                                            <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning btn-sm me-2">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this product?');">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- .col// -->
        </div>
        <!-- .row // -->
    </div>

    <!-- card-body end// -->
</div>
<!-- card end// -->
<div class="pagination-area mt-30 mb-50">
    <nav aria-label="Page navigation example">
        <ul class="pagination justify-content-start">
            <li class="page-item active"><a class="page-link" href="#">01</a></li>
            <li class="page-item"><a class="page-link" href="#">02</a></li>
            <li class="page-item"><a class="page-link" href="#">03</a></li>
            <li class="page-item"><a class="page-link dot" href="#">...</a></li>
            <li class="page-item"><a class="page-link" href="#">16</a></li>
            <li class="page-item">
                <a class="page-link" href="#"><i class="material-icons md-chevron_right"></i></a>
            </li>
        </ul>
    </nav>
</div>

@endsection
