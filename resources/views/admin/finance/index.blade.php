@extends('admin.layouts.app')

@section('title', 'Finance Applications - Admin Panel')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0">Finance Applications</h4>
                <div class="page-title-right">
                    <a href="{{ route('admin.finance.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Add New Application
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
                                    <th>Loan Amount</th>
                                    <th>Status</th>
                                    <th>Applied Date</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($applications ?? [] as $app)
                                <tr>
                                    <td>{{ $app->id }}</td>
                                    <td>{{ $app->customer->name ?? 'N/A' }}</td>
                                    <td>{{ $app->vehicle->make ?? 'N/A' }} {{ $app->vehicle->model ?? '' }}</td>
                                    <td>UGX {{ number_format($app->loan_amount, 2) }}</td>
                                    <td>
                                        <span class="badge bg-{{ $app->status === 'approved' ? 'success' : ($app->status === 'pending' ? 'warning' : ($app->status === 'rejected' ? 'danger' : 'info')) }}">
                                            {{ ucfirst($app->status) }}
                                        </span>
                                    </td>
                                    <td>{{ $app->created_at->format('M d, Y') }}</td>
                                    <td>
                                        <a href="{{ route('admin.finance.show', $app) }}" class="btn btn-sm btn-info">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.finance.edit', $app) }}" class="btn btn-sm btn-warning">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        @if($app->status === 'pending')
                                        <form action="{{ route('admin.finance.approve', $app) }}" method="POST" class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-success">
                                                <i class="fas fa-check"></i> Approve
                                            </button>
                                        </form>
                                        <form action="{{ route('admin.finance.reject', $app) }}" method="POST" class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-danger">
                                                <i class="fas fa-times"></i> Reject
                                            </button>
                                        </form>
                                        @endif
                                        <form action="{{ route('admin.finance.destroy', $app) }}" method="POST" class="d-inline">
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
                                    <td colspan="7" class="text-center">No finance applications found.</td>
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
