@extends('admin.layouts.app')

@section('title', 'Customer Details')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title">Customer Details: {{ $customer->first_name }} {{ $customer->last_name }}</h4>
                    <div>
                        <a href="{{ route('admin.customers.edit', $customer) }}" class="btn btn-warning">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <a href="{{ route('admin.customers.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Back to Customers
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="row">
                                <div class="col-md-6">
                                    <h5 class="mb-3">Personal Information</h5>
                                    
                                    <table class="table table-borderless">
                                        <tr>
                                            <td><strong>Full Name:</strong></td>
                                            <td>{{ $customer->first_name }} {{ $customer->last_name }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Email:</strong></td>
                                            <td>{{ $customer->email }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Phone:</strong></td>
                                            <td>{{ $customer->phone }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Age:</strong></td>
                                            <td>{{ $customer->age ?? 'Not provided' }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Status:</strong></td>
                                            <td>
                                                <span class="badge bg-{{ $customer->status === 'active' ? 'success' : 'danger' }}">
                                                    {{ ucfirst($customer->status) }}
                                                </span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><strong>Driver's License:</strong></td>
                                            <td>{{ $customer->driver_license_number ?? 'Not provided' }}</td>
                                        </tr>
                                    </table>
                                </div>
                                
                                <div class="col-md-6">
                                    <h5 class="mb-3">Location Information</h5>
                                    
                                    <table class="table table-borderless">
                                        <tr>
                                            <td><strong>City:</strong></td>
                                            <td>{{ $customer->city }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>District:</strong></td>
                                            <td>{{ $customer->district ?? 'Not provided' }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>State:</strong></td>
                                            <td>{{ $customer->state }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>ZIP Code:</strong></td>
                                            <td>{{ $customer->zip_code }}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            
                            <div class="row mt-4">
                                <div class="col-12">
                                    <h5 class="mb-3">Customer Activity</h5>
                                    
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="card text-center">
                                                <div class="card-body">
                                                    <h3 class="text-primary">{{ $customer->salesLeads->count() }}</h3>
                                                    <p class="text-muted mb-0">Sales Leads</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="card text-center">
                                                <div class="card-body">
                                                    <h3 class="text-success">{{ $customer->sales->count() }}</h3>
                                                    <p class="text-muted mb-0">Completed Sales</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="card text-center">
                                                <div class="card-body">
                                                    <h3 class="text-info">{{ $customer->financingApplications->count() }}</h3>
                                                    <p class="text-muted mb-0">Financing Apps</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="card text-center">
                                                <div class="card-body">
                                                    <h3 class="text-warning">{{ $customer->supportTickets->count() }}</h3>
                                                    <p class="text-muted mb-0">Support Tickets</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">Customer Information</h5>
                                </div>
                                <div class="card-body">
                                    <p class="mb-2"><strong>Customer ID:</strong> #{{ $customer->id }}</p>
                                    <p class="mb-2"><strong>Created:</strong> {{ $customer->created_at->format('M d, Y H:i') }}</p>
                                    <p class="mb-0"><strong>Last Updated:</strong> {{ $customer->updated_at->format('M d, Y H:i') }}</p>
                                </div>
                            </div>
                            
                            @if($customer->user)
                            <div class="card mt-3">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">User Account</h5>
                                </div>
                                <div class="card-body">
                                    <p class="mb-2"><strong>Username:</strong> {{ $customer->user->name }}</p>
                                    <p class="mb-0"><strong>Account Status:</strong> 
                                        <span class="badge bg-{{ $customer->user->email_verified_at ? 'success' : 'warning' }}">
                                            {{ $customer->user->email_verified_at ? 'Verified' : 'Pending' }}
                                        </span>
                                    </p>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
