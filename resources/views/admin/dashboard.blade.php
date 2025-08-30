@extends('admin.layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="row">
    <!-- Statistics Cards -->
    <div class="col-lg-3 col-md-6 mb-4">
        <div class="stats-card">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h3>{{ $totalVehicles ?? 0 }}</h3>
                    <p>Total Vehicles</p>
                </div>
                <i class="fas fa-car fa-2x opacity-75"></i>
            </div>
        </div>
    </div>
    
    <div class="col-lg-3 col-md-6 mb-4">
        <div class="stats-card success">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h3>UGX {{ number_format($totalRevenue ?? 0, 0) }}</h3>
                    <p>Total Revenue</p>
                </div>
                <i class="fas fa-money-bill-wave fa-2x opacity-75"></i>
            </div>
        </div>
    </div>
    
    <div class="col-lg-3 col-md-6 mb-4">
        <div class="stats-card warning">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h3>{{ $totalCustomers ?? 0 }}</h3>
                    <p>Total Customers</p>
                </div>
                <i class="fas fa-users fa-2x opacity-75"></i>
            </div>
        </div>
    </div>
    
    <div class="col-lg-3 col-md-6 mb-4">
        <div class="stats-card danger">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h3>{{ $pendingLeads ?? 0 }}</h3>
                    <p>Pending Leads</p>
                </div>
                <i class="fas fa-user-clock fa-2x opacity-75"></i>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <!-- Additional Statistics -->
    <div class="col-lg-3 col-md-6 mb-4">
        <div class="stats-card info">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h3>{{ $totalSales ?? 0 }}</h3>
                    <p>Total Sales</p>
                </div>
                <i class="fas fa-chart-line fa-2x opacity-75"></i>
            </div>
        </div>
    </div>
    
    <div class="col-lg-3 col-md-6 mb-4">
        <div class="stats-card secondary">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h3>{{ $openTickets ?? 0 }}</h3>
                    <p>Open Tickets</p>
                </div>
                <i class="fas fa-headset fa-2x opacity-75"></i>
            </div>
        </div>
    </div>
    

    
    <div class="col-lg-3 col-md-6 mb-4">
        <div class="stats-card light">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h3>{{ $totalBlogPosts ?? 0 }}</h3>
                    <p>Blog Posts</p>
                </div>
                <i class="fas fa-file-alt fa-2x opacity-75"></i>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <!-- Charts -->
    <div class="col-lg-8 mb-4">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Sales & Revenue Overview</h5>
            </div>
            <div class="card-body">
                <canvas id="salesChart" height="100"></canvas>
            </div>
        </div>
    </div>
    
    <div class="col-lg-4 mb-4">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Vehicle Status</h5>
            </div>
            <div class="card-body">
                <canvas id="vehicleStatusChart" height="200"></canvas>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <!-- Recent Activities -->
    <div class="col-lg-12 mb-4">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Recent Sales</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Customer</th>
                                <th>Vehicle</th>
                                <th>Amount</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentSales ?? [] as $sale)
                            <tr>
                                <td>{{ $sale->customer->first_name ?? 'N/A' }} {{ $sale->customer->last_name ?? '' }}</td>
                                <td>{{ $sale->vehicle->brand->name ?? 'N/A' }} {{ $sale->vehicle->model ?? '' }}</td>
                                <td>UGX {{ number_format($sale->sale_price ?? 0, 2) }}</td>
                                <td>{{ $sale->sale_date ? $sale->sale_date->format('M d, Y') : 'N/A' }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center">No recent sales</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    

</div>

<div class="row">
    <!-- Top Performing Vehicles -->
    <div class="col-lg-6 mb-4">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Top Performing Vehicles</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Vehicle</th>
                                <th>Brand</th>
                                <th>Sales Count</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($topVehicles ?? [] as $vehicle)
                            <tr>
                                <td>{{ $vehicle->model ?? 'N/A' }}</td>
                                <td>{{ $vehicle->brand->name ?? 'N/A' }}</td>
                                <td>{{ $vehicle->sales_count ?? 0 }}</td>
                                <td>
                                    <span class="badge bg-{{ $vehicle->status === 'available' ? 'success' : ($vehicle->status === 'sold' ? 'danger' : 'warning') }}">
                                        {{ ucfirst($vehicle->status ?? 'unknown') }}
                                    </span>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center">No vehicles found</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    

</div>

<div class="row">
    <!-- Recent Activities -->
    <div class="col-lg-12 mb-4">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Recent Activities</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>User</th>
                                <th>Action</th>
                                <th>Description</th>
                                <th>Time</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $recentActivities = \App\Models\Activity::with('user')
                                    ->orderBy('created_at', 'desc')
                                    ->limit(5)
                                    ->get();
                            @endphp
                            @forelse($recentActivities as $activity)
                                <tr>
                                    <td>
                                        <strong>{{ $activity->user->name ?? 'Unknown' }}</strong>
                                    </td>
                                    <td>
                                        <span class="badge bg-{{ $activity->action === 'login' ? 'success' : ($activity->action === 'logout' ? 'warning' : ($activity->action === 'create' ? 'primary' : ($activity->action === 'update' ? 'info' : ($activity->action === 'delete' ? 'danger' : 'secondary')))) }}">
                                            {{ $activity->formatted_action }}
                                        </span>
                                    </td>
                                    <td>
                                        <small>{{ Str::limit($activity->description, 50) }}</small>
                                    </td>
                                    <td>
                                        <small class="text-muted">{{ $activity->time_ago }}</small>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center text-muted">No recent activities</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="text-center mt-3">
                    <a href="{{ route('admin.activity.log') }}" class="btn btn-outline-primary btn-sm">
                        View All Activities
                    </a>
                </div>
            </div>
        </div>
    </div>


</div>
@endsection

@push('scripts')
<script>
// Sales Chart
const salesCtx = document.getElementById('salesChart').getContext('2d');
const salesChart = new Chart(salesCtx, {
    type: 'line',
    data: {
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
        datasets: [{
            label: 'Sales',
            data: [12, 19, 3, 5, 2, 3],
            borderColor: '#3498db',
            backgroundColor: 'rgba(52, 152, 219, 0.1)',
            tension: 0.4
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                display: false
            }
        },
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});

// Vehicle Status Chart
const vehicleCtx = document.getElementById('vehicleStatusChart').getContext('2d');
const vehicleChart = new Chart(vehicleCtx, {
    type: 'doughnut',
    data: {
        labels: ['Available', 'Sold', 'Reserved', 'Maintenance'],
        datasets: [{
            data: [65, 20, 10, 5],
            backgroundColor: [
                '#27ae60',
                '#e74c3c',
                '#f39c12',
                '#3498db'
            ]
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                position: 'bottom'
            }
        }
    }
});
</script>
@endpush
