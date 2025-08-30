@extends('admin.layouts.app')

@section('title', 'Customers - Admin Panel')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0">Customers Management</h4>
                <div class="page-title-right">
                    <a href="{{ route('admin.customers.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Add New Customer
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Age</th>
                                    <th>City</th>
                                    <th>District</th>
                                    <th>Status</th>
                                    <th>Created</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($customers ?? [] as $customer)
                                <tr>
                                    <td>{{ $customer->id }}</td>
                                    <td>{{ $customer->first_name }} {{ $customer->last_name }}</td>
                                    <td>{{ $customer->email }}</td>
                                    <td>{{ $customer->phone }}</td>
                                    <td>{{ $customer->age ?? 'N/A' }}</td>
                                    <td>{{ $customer->city ?? 'N/A' }}</td>
                                    <td>{{ $customer->district ?? 'N/A' }}</td>
                                    <td>
                                        <span class="badge bg-{{ $customer->status === 'active' ? 'success' : 'danger' }}">
                                            {{ ucfirst($customer->status) }}
                                        </span>
                                    </td>
                                    <td>{{ $customer->created_at->format('M d, Y') }}</td>
                                    <td>
                                        <a href="{{ route('admin.customers.show', $customer) }}" class="btn btn-sm btn-info">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.customers.edit', $customer) }}" class="btn btn-sm btn-warning">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.customers.destroy', $customer) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="10" class="text-center">No customers found.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
