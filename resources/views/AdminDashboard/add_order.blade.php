@extends ('AdminDashboard.master')

@section('content')

<div class="content-header">
    <div>
        <h2 class="content-title card-title">Add Order</h2>   
    </div>
    <div>
        <a href="{{ route('create_order') }}" class="btn btn-primary"><i class="text-muted material-icons md-post_add"></i>Create Order</a>
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

<div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>#ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Phone Number</th>
                        <th scope="col">Booking Type</th>
                        <th scope="col">Room Section</th>
                        <th scope="col">Booking Start Date</th>
                        <th scope="col">Booking End Date</th>
                        <th scope="col">Payment Method</th>
                        <th scope="col">Discount (%)</th>
                        <th scope="col">Service Charge</th>
                        <th scope="col">Status</th>
                        <th scope="col" class="text-end">Action</th>
                    </tr>
               </thead>
               <tbody>
               @foreach($customers as $customer)
                    <tr>
                        <td>{{ $customer->id }}</td>
                        <td>{{ $customer->name }} </td>
                        <td>{{ $customer->email }}</td>
                        <td>{{ $customer->phone_number }}</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td class="text-end">
                           <div class="dropdown">
                                <button class="btn btn-primary" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                 Action
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <li>
                                    <a class="dropdown-item" href="#" onclick="viewFunction()">View</a>
                                    </li>
                                    <li>
                                    <a class="dropdown-item" href="#" onclick="editFunction()">Edit</a>
                                    </li>
                                    <li>
                                    <a class="dropdown-item text-danger" href="#" onclick="deleteFunction()">Delete</a>
                                    </li>
                                </ul>
                           </div>
                       </td>

                    </tr>
                    @endforeach
                </tbody>
                        
            </table>
    </div>                
</div>
@endsection