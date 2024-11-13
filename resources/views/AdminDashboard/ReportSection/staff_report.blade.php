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
                <h2 class="content-title card-title">Report - Staff Members</h2>
            </div>
            
        </div>


        <div class="card">
            <div class="card-body">
                <div class="row">

                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table id="tableData" class="table table-hover">
                                <thead>
                                    <tr>

                                        <th>ID</th>
                                        <th>Full Name</th>
                                        <th>Position</th>
                                        <th>Department</th>
                                        <th>Phone Number</th>
                                        <th>Email</th>
                                        <th>Address</th>
                                        <th>Date Hired</th>
                                        <th>Shift Details</th>
                                        <th>Notes</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($staffMembers as $staffMember)
                                    <tr>
                                        <td>{{ $staffMember->id }}</td>
                                        <td>{{ $staffMember->first_name }} {{ $staffMember->last_name }}</td>
                                        <td>{{ $staffMember->position->name ?? '-'}}</td>
                                        <td>{{ $staffMember->department->name ?? '-' }}</td>
                                        <td>{{ $staffMember->contact }}</td>
                                        <td>{{ $staffMember->email }}</td>
                                        <td>{{ $staffMember->address }}</td>
                                        <td>{{ $staffMember->date_hired }}</td>
                                        <td>{{ $staffMember->shift_details }}</td>
                                        <td>{{ $staffMember->notes }}</td>
                                        <td>
                                            @if ($staffMember->status=='1')
                                            Active
                                            @elseif($staffMember->status=='0')
                                            Deactive
                                            @endif
                                        </td>
                                        
                                    </tr>
                                    @endforeach
                                    <!-- Repeat similar rows as needed -->
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- .col// -->
                </div>
                <!-- .row // -->
            </div>
            <!-- card body .// -->
        </div>
        <!-- card .// -->
    </section>
    <!-- content-main end// -->
    

    <!-- JavaScript to handle delete confirmation -->
    <script>
        function confirmDelete(id) {
            if (confirm('Are you sure you want to delete this staff member?')) {
                document.getElementById(`delete-form-${id}`).submit();
            }
        }
    </script>

    <script src="backend/assets/js/vendors/jquery-3.6.0.min.js"></script>
    <script src="backend/assets/js/vendors/bootstrap.bundle.min.js"></script>
    <script src="backend/assets/js/vendors/select2.min.js"></script>
    <script src="backend/assets/js/vendors/perfect-scrollbar.js"></script>
    <script src="backend/assets/js/vendors/jquery.fullscreen.min.js"></script>
    <!-- Main Script -->
    <script src="backend/assets/js/main.js?v=6.0" type="text/javascript"></script>

    <script>
        $(document).ready(function() {
            var table = $('#tableData').DataTable({
                dom: 'Bfrtip', // Layout for DataTables with Buttons
                buttons: [{
                        extend: 'copyHtml5',
                        footer: true
                    },
                    {
                        extend: 'excelHtml5',
                        footer: true
                    },
                    {
                        extend: 'csvHtml5',
                        footer: true
                    },
                    {
                        extend: 'pdfHtml5',
                        footer: true,
                        title: 'Staff Report',
                        customize: function(doc) {
                            // Set a margin for the footer
                            doc.content[1].margin = [0, 0, 0, 20];
                        }
                    },
                    {
                        extend: 'print',
                        footer: true,
                        title: 'Staff Report',
                    }
                ],

            });


        });
    </script>
</body>

</html>

@endsection