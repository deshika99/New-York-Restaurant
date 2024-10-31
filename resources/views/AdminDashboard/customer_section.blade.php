@extends ('AdminDashboard.master')

@section('content')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<link href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">

<style>
   .input-group {
       position: relative; 
    }

    .form-select {
       padding-right: 30px; 
       appearance: none; 
       background: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" viewBox="0 0 10 10"><polygon points="0,0 5,5 10,0" fill="none" stroke="black" stroke-width="1"/></svg>') no-repeat right 10px center; /* Optional: add a custom arrow */
       background-size: 10px; 
    }

   .filter-icon {
       position: absolute;
       right: 10px; 
       top: 50%; 
       transform: translateY(-50%); 
       pointer-events: none; 
       color: #6c757d; 
    }

</style>

   <div class="content-header">
        <div>
            <h2 class="content-title card-title">Customer Section</h2>
            <p>Whole data about your customer here</p>
        </div>
        <div>
            <a href="{{ route('Add_customer') }}" class="btn btn-primary"><i class="text-muted material-icons md-post_add"></i>Add Customer</a>
        </div>
    </div>

    @if(session('success'))
       <div class="alert alert-success">
           {{ session('success') }}
        </div>
    @endif
                
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
                <div class="col-lg-2 col-6 col-md-3">
                    <div class="input-group">
                        <select class="form-select" aria-label="Filter options">
                           <option value="online">Online</option>
                           <option value="in-office">In-Office</option>
                        </select>
                            <span class="filter-icon">
                                <i class="fas fa-filter"></i>
                            </span>
                    </div>
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
<script>
    function editFunction() {
    // Add your edit logic here
    alert('Edit action triggered');
}

function deleteFunction() {
    // Add your delete logic here
    alert('Delete action triggered');
}

</script>  

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.min.js"></script>
@endsection