@extends ('AdminDashboard.master')

@section('content')
<div class="content-header">

    <div>
        <h2 class="content-title card-title">Dashboard</h2>
        <p>Summery data about your hotel here</p>
    </div>
    <div>
      
    </div>
</div>
<div class="row">
    <div class="col-lg-3">
        <div class="card card-body mb-4">
            <article class="icontext">
                <span class="icon icon-sm rounded-circle bg-primary-light"><i class="text-primary material-icons md-monetization_on"></i></span>
                <div class="text">
                    <h6 class="mb-1 card-title">Revenue</h6>
                    <span>LKR {{$totalRevenue}}</span>
                    <span class="text-sm">Total paid amount</span>
                </div>
            </article>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="card card-body mb-4">
            <article class="icontext">
                <span class="icon icon-sm rounded-circle bg-primary-light"><i class="text-primary material-icons md-monetization_on"></i></span>
                <div class="text">
                    <h6 class="mb-1 card-title">Due Amount</h6>
                    <span>LKR {{$totalDueAmount}}</span>
                    <span class="text-sm">Amount currently receivable</span>
                </div>
            </article>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="card card-body mb-4">
            <article class="icontext">
                <span class="icon icon-sm rounded-circle bg-primary-light"><i class="text-success material-icons md-event"></i></span>
                <div class="text">
                    <h6 class="mb-1 card-title">Online Bookings</h6>
                    <span>{{$totalOnlineBookings}}</span>
                    <span class="text-sm">Total bookings by online</span>
                </div>
            </article>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="card card-body mb-4">
            <article class="icontext">
                <span class="icon icon-sm rounded-circle bg-primary-light"><i class="text-success material-icons md-beenhere"></i></span>
                <div class="text">
                    <h6 class="mb-1 card-title">In-Office Bookings</h6>
                    <span>{{$totalInOfficeBookings}}</span>
                    <span class="text-sm">Total bookings in office</span>
                </div>
            </article>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="card card-body mb-4">
            <article class="icontext">
                <span class="icon icon-sm rounded-circle bg-primary-light"><i class="text-warning material-icons md-king_bed"></i></span>
                <div class="text">
                    <h6 class="mb-1 card-title">Available Rooms</h6>
                    <span>{{$availableRooms}}</span>
                    <span class="text-sm">Rooms available at this time</span>
                </div>
            </article>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="card card-body mb-4">
            <article class="icontext">
                <span class="icon icon-sm rounded-circle bg-primary-light"><i class="text-warning material-icons md-home_work"></i></span>
                <div class="text">
                    <h6 class="mb-1 card-title">Total Rooms</h6>
                    <span>{{$totalRooms}}</span>
                    <span class="text-sm">Total Rooms in Hotels</span>
                </div>
            </article>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="card card-body mb-4">
            <article class="icontext">
                <span class="icon icon-sm rounded-circle bg-primary-light"><i class="text-info material-icons md-people"></i></span>
                <div class="text">
                    <h6 class="mb-1 card-title">Customers</h6>
                    <span>{{$totalCustomers}}</span>
                    <span class="text-sm">Total registered customers</span>
                </div>
            </article>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="card card-body mb-4">
            <article class="icontext">
                <span class="icon icon-sm rounded-circle bg-primary-light"><i class="text-info material-icons md-assignment_ind"></i></span>
                <div class="text">
                    <h6 class="mb-1 card-title">Staff</h6>
                    <span>{{$totalStaff}}</span>
                    <span class="text-sm">Total staff members</span>
                </div>
            </article>
        </div>
    </div>

</div>
<div class="row">
    <div class="col-md-12 col-lg-12">
        <div class="card mb-4">
            <article class="card-body">
                <h5 class="card-title">Bookings & Customer Statistics</h5>
                <canvas id="myChart" height="120px"></canvas>
            </article>
        </div>
       
    </div>
    <div class="col-md-12 col-lg-12">
        <div class="card mb-4">
            <article class="card-body">
                <h5 class="card-title">Revenue Base on Months</h5>
                <canvas id="myChart2" height="120px"></canvas>
            </article>
        </div>
        
    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    (function ($) {
        "use strict";

        /* Sale Statistics Chart */
        if ($('#myChart').length) {
            var ctx = document.getElementById('myChart').getContext('2d');
            var chart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                    datasets: [
                        {
                            label: 'Online Bookings',
                            tension: 0.3,
                            fill: true,
                            backgroundColor: 'rgba(44, 120, 220, 0.2)',
                            borderColor: 'rgba(44, 120, 220)',
                            data: @json($onlineBookingsData)
                        },
                        {
                            label: 'In-Office Bookings',
                            tension: 0.3,
                            fill: true,
                            backgroundColor: 'rgba(4, 209, 130, 0.2)',
                            borderColor: 'rgb(4, 209, 130)',
                            data:@json($officeBookingsData)
                        },
                        {
                            label: 'Customers',
                            tension: 0.3,
                            fill: true,
                            backgroundColor: 'rgba(380, 200, 230, 0.2)',
                            borderColor: 'rgb(380, 200, 230)',
                            data: @json($customersData)
                        }
                    ]
                },
                options: {
                    plugins: {
                        legend: {
                            labels: {
                                usePointStyle: true,
                            },
                        },
                    },
                },
            });
        }

        /* Revenue Based on Month Chart */
        if ($('#myChart2').length) {
            var ctx2 = document.getElementById('myChart2').getContext('2d');
            var myChart2 = new Chart(ctx2, {
                type: 'bar',
                data: {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                    datasets: [
                        {
                            label: 'Revenue',
                            backgroundColor: '#5897fb',
                            barThickness: 10,
                            data: @json($revenueData),
                        }
                    ]
                },
                options: {
                    plugins: {
                        legend: {
                            labels: {
                                usePointStyle: true,
                            },
                        },
                        tooltip: {
                            callbacks: {
                                label: function (tooltipItem) {
                                    return `$${tooltipItem.raw.toFixed(2)}`;
                                }
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                callback: function (value) {
                                    return `LKR ${value}`;
                                }
                            }
                        }
                    }
                },
            });
        }
    })(jQuery);
</script>




@endsection