@extends ('AdminDashboard.master')

@section('content')

   <div class="content-header">
        <div>
            <h2 class="content-title card-title">Customer Section</h2>
            <p>Whole data about your customer here</p>
        </div>
        <div>
            <a href="{{ route('Add_customer') }}" class="btn btn-primary"><i class="text-muted material-icons md-post_add"></i>Add Customer</a>
        </div>
    </div>
                
    <div class="card mb-4">
        <header class="card-header">
            <div class="row gx-3">
                <div class="col-lg-4 col-md-6 me-auto">
                    <input type="text" placeholder="Search..." class="form-control" />
                </div>

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
                            <th>#ID</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Phone No:</th>
                            <th scope="col">Total Booking</th>
                            <th scope="col">Date</th>
                            <th scope="col">Payment Method</th>
                            <th scope="col" class="text-end">Action</th>
                         </tr>
                    </thead>
                        <tr>
                           <td>1</td>
                            <td><b>Darlene Robertson</b></td>
                            <td>deriene@example.com</td>
                            <td>011547 4456</td>
                            <td>05</td>
                            <td>03.07.2020</td>
                            <td>Cash</td>
                            <td class="text-end">         
                                <div class="dropdown">
                                    <a href="#" data-bs-toggle="dropdown" class="btn btn-light rounded btn-sm font-sm"> <i class="material-icons md-more_horiz"></i> </a>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="#">View</a>
                                            <a class="dropdown-item" href="#">Edit</a>
                                            <a class="dropdown-item text-danger" href="#">Delete</a>
                                        </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td><b>Jane Cooper</b></td>
                            <td>jane@example.com</td>
                            <td>0112 111 111</td>
                            <td>10</td>
                            <td>03.09.2020</td>
                            <td>Cash</td>
                            <td class="text-end">         
                                <div class="dropdown">
                                    <a href="#" data-bs-toggle="dropdown" class="btn btn-light rounded btn-sm font-sm"> <i class="material-icons md-more_horiz"></i> </a>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="#">View</a>
                                            <a class="dropdown-item" href="#">Edit</a>
                                            <a class="dropdown-item text-danger" href="#">Delete</a>
                                        </div>
                                </div>
                            </td>

                        </tr>

                    <tbody>
                     
                    </tbody>
                </table>
            </div>
         </div>  
         
@endsection