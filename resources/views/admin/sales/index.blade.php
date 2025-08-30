@extends('admin.layouts.app')

@section('title', 'Sales Management - Admin Panel')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0">Sales Management</h4>
                <div class="page-title-right">
                    <a href="{{ route('admin.sales.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Add New Sale
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
                                    <th>Customer</th>
                                    <th>Vehicle</th>
                                    <th>Sales Person</th>
                                    <th>Amount</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($sales ?? [] as $sale)
                                <tr>
                                    <td>{{ $sale->id }}</td>
                                    <td>{{ $sale->customer->name ?? 'N/A' }}</td>
                                    <td>{{ $sale->vehicle->make ?? 'N/A' }} {{ $sale->vehicle->model ?? '' }}</td>
                                    <td>{{ $sale->salesPerson->name ?? 'N/A' }}</td>
                                    <td>UGX {{ number_format($sale->sale_price, 2) }}</td>
                                    <td>
                                        <span class="badge bg-{{ $sale->status === 'completed' ? 'success' : ($sale->status === 'pending' ? 'warning' : 'info') }}">
                                            {{ ucfirst($sale->status) }}
                                        </span>
                                    </td>
                                    <td>{{ $sale->sale_date ? \Carbon\Carbon::parse($sale->sale_date)->format('M d, Y') : 'N/A' }}</td>
                                    <td>
                                        <a href="{{ route('admin.sales.show', $sale) }}" class="btn btn-sm btn-info">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.sales.edit', $sale) }}" class="btn btn-sm btn-warning">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.sales.destroy', $sale) }}" method="POST" class="d-inline">
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
                                    <td colspan="8" class="text-center">No sales found.</td>
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
