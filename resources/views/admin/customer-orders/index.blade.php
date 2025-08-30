@extends('admin.layouts.app')

@section('title', 'Customer Orders - Admin Dashboard')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div>
                        <h4 class="card-title">Customer Orders</h4>
                        <p class="card-subtitle">Manage customer inquiries and orders</p>
                    </div>
                    <div>
                        <a href="{{ route('admin.customer-orders.export') }}" class="btn btn-success">
                            <i class="fas fa-file-excel me-2"></i>Export to Excel
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    @if($orders->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Customer Name</th>
                                        <th>Contact Number</th>
                                        <th>Vehicle</th>
                                        <th>Status</th>
                                        <th>Date</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($orders as $order)
                                    <tr>
                                        <td>{{ $order->id }}</td>
                                        <td>{{ $order->customer_name }}</td>
                                        <td>{{ $order->contact_number }}</td>
                                        <td>{{ $order->vehicle_info }}</td>
                                        <td>
                                            <span class="badge bg-{{ $order->status === 'pending' ? 'warning' : ($order->status === 'contacted' ? 'info' : ($order->status === 'completed' ? 'success' : 'danger')) }}">
                                                {{ ucfirst($order->status) }}
                                            </span>
                                        </td>
                                        <td>{{ $order->created_at->format('M d, Y H:i') }}</td>
                                        <td>
                                            <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#orderModal{{ $order->id }}">
                                                View Details
                                            </button>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-4">
                            <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                            <h5>No Customer Orders</h5>
                            <p class="text-muted">No customer inquiries have been submitted yet.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Order Detail Modals -->
@foreach($orders as $order)
<div class="modal fade" id="orderModal{{ $order->id }}" tabindex="-1" aria-labelledby="orderModalLabel{{ $order->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="orderModalLabel{{ $order->id }}">Order #{{ $order->id }} - {{ $order->customer_name }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <h6>Customer Information</h6>
                        <p><strong>Name:</strong> {{ $order->customer_name }}</p>
                        <p><strong>Contact:</strong> {{ $order->contact_number }}</p>
                        <p><strong>Date:</strong> {{ $order->created_at->format('M d, Y H:i') }}</p>
                    </div>
                    <div class="col-md-6">
                        <h6>Vehicle Information</h6>
                        <p><strong>Vehicle:</strong> {{ $order->vehicle_info }}</p>
                        <p><strong>Status:</strong> 
                            <span class="badge bg-{{ $order->status === 'pending' ? 'warning' : ($order->status === 'contacted' ? 'info' : ($order->status === 'completed' ? 'success' : 'danger')) }}">
                                {{ ucfirst($order->status) }}
                            </span>
                        </p>
                    </div>
                </div>
                
                <hr>
                
                <div class="row">
                    <div class="col-12">
                        <h6>Update Status</h6>
                        <form id="statusForm{{ $order->id }}">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="status{{ $order->id }}" class="form-label">Status</label>
                                        <select class="form-select" id="status{{ $order->id }}" name="status">
                                            <option value="pending" {{ $order->status === 'pending' ? 'selected' : '' }}>Pending</option>
                                            <option value="contacted" {{ $order->status === 'contacted' ? 'selected' : '' }}>Contacted</option>
                                            <option value="completed" {{ $order->status === 'completed' ? 'selected' : '' }}>Completed</option>
                                            <option value="cancelled" {{ $order->status === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="notes{{ $order->id }}" class="form-label">Notes</label>
                                        <textarea class="form-control" id="notes{{ $order->id }}" name="notes" rows="3" placeholder="Add notes about this order...">{{ $order->notes }}</textarea>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Update Status</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.getElementById('statusForm{{ $order->id }}').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const formData = new FormData(this);
    const submitBtn = this.querySelector('button[type="submit"]');
    const originalText = submitBtn.textContent;
    
    submitBtn.disabled = true;
    submitBtn.textContent = 'Updating...';
    
    fetch('{{ route("admin.customer-orders.update-status", $order->id) }}', {
        method: 'POST',
        body: formData,
        headers: {
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('Status updated successfully!');
            location.reload();
        } else {
            alert('Error updating status. Please try again.');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Error updating status. Please try again.');
    })
    .finally(() => {
        submitBtn.disabled = false;
        submitBtn.textContent = originalText;
    });
});
</script>
@endforeach
@endsection
