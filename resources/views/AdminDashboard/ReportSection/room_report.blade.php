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
                <h2 class="content-title">Report - Rooms</h2>
            </div>

            <!-- Room Form -->
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <!-- Room Table -->
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table id="tableData" class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Room Number</th>
                                            <th>Apartment</th>
                                            <th>Floor</th>
                                            <th>Room Type</th>
                                            <th>Facilities</th>
                                            <th>Rental Price (LKR)</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($rooms as $index=> $room)
                                        <tr>
                                            <td>{{ $index+1 }}</td>
                                            <td>{{ $room->room_number }}</td>
                                            <td>{{ $room->apartment->apartment_name }}</td>
                                            <td>{{ $room->floor->floor_number }}</td>
                                            <td>{{ $room->roomType->type_name }}</td>
                                            <td>{{ $room->facilities }}</td>
                                            <td>{{ $room->rental_price }}</td>
                                            <td>{{ ucfirst($room->occupancy_status) }}</td>
                                            
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
            function confirmDeleteRoom(id) {
                if (confirm('Are you sure you want to delete this room?')) {
                    document.getElementById(`delete-room-form-${id}`).submit();
                }
            }
        </script>
        
        <script src="backend/assets/js/vendors/jquery-3.6.0.min.js"></script>
        <script src="backend/assets/js/vendors/bootstrap.bundle.min.js"></script>
        <script src="backend/assets/js/vendors/select2.min.js"></script>
        <script src="backend/assets/js/vendors/perfect-scrollbar.js"></script>
        <script src="backend/assets/js/vendors/jquery.fullscreen.min.js"></script>
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
                        title: 'Rooms Report',
                        customize: function(doc) {
                            // Set a margin for the footer
                            doc.content[1].margin = [0, 0, 0, 20];
                        }
                    },
                    {
                        extend: 'print',
                        footer: true,
                        title: 'Rooms Report',
                    }
                ],

            });


        });
    </script>
    </body>
</html>
@endsection
