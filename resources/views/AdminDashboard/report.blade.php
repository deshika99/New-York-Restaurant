@extends ('AdminDashboard.master')

@section('content')
<div class="content-header">
    <div>
        <h2 class="content-title card-title">Report & Analysis</h2>
    </div>
</div>

<div class="row">
    <!-- Cards for Revenue, Orders, Customers, and Staff -->
    @php
        $data = [
            'Revenue' => ['icon' => 'attach_money', 'count' => $totals[0] ?? 0],
            'Orders' => ['icon' => 'shopping_cart', 'count' => $totals[1] ?? 0],
            'Customers' => ['icon' => 'people', 'count' => $totals[2] ?? 0],
            'Staff' => ['icon' => 'person', 'count' => $staffCount ?? 0]
        ];
    @endphp

    @foreach ($data as $key => $info)
    <div class="col-lg-3">
        <div class="card card-body mb-4">
            <article class="icontext">
                <span class="icon icon-sm rounded-circle bg-primary-light">
                    <i class="text-primary material-icons md-{{ $info['icon'] }}"></i>
                </span>
                <div class="text">
                    <h6 class="mb-1 card-title">{{ $key }}</h6>
                    <span class="text-sm">{{ $key == 'Revenue' ? 'Excluding Shipping' : '' }}</span>
                    <h4 class="mt-2">{{ $info['count'] }}</h4>
                </div>
            </article>
        </div>
    </div>
    @endforeach
</div>

<!-- Staff, Orders, and Customers Statistics Chart -->
<div class="card">
    <div class="card-body">
        <h5>Staff, Orders, and Customers statistics</h5>
        <canvas id="statisticsChart"></canvas>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    var ctx = document.getElementById('statisticsChart').getContext('2d');
    var statisticsChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            datasets: [
                {
                    label: 'Staff',
                    data: @json($totals), // Use actual data
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 2,
                    fill: true
                },
                {
                    label: 'Orders',
                    data: [15, 19, 20, 23, 25, 12, 19, 24, 26, 21, 18, 16],
                    backgroundColor: 'rgba(75, 192, 192, 0.5)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 2
                },
                {
                    label: 'Customers',
                    data: [15, 18, 20, 23, 25, 22, 19, 24, 26, 21, 18, 16], // Example data
                    backgroundColor: 'rgba(255, 159, 64, 0.2)',
                    borderColor: 'rgba(255, 159, 64, 1)',
                    borderWidth: 2,
                    fill: true
                }
            ]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 2
                    }
                }
            }
        }
    });
</script>


@endsection