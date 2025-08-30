@extends('admin.layouts.app')

@section('title', 'Financing Application Details')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-money-bill-wave"></i> Financing Application Details
                    </h5>
                    <div>
                        <a href="{{ route('admin.finance.edit', $finance) }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <a href="{{ route('admin.finance.index') }}" class="btn btn-secondary btn-sm">
                            <i class="fas fa-arrow-left"></i> Back
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <!-- Application Information -->
                    <div class="col-md-6">
                        <h6 class="text-primary mb-3">Application Information</h6>
                        <table class="table table-borderless">
                            <tr>
                                <td><strong>Application ID:</strong></td>
                                <td>#{{ $finance->id }}</td>
                            </tr>
                            <tr>
                                <td><strong>Status:</strong></td>
                                <td>
                                    <span class="badge bg-{{ $finance->status === 'approved' ? 'success' : ($finance->status === 'pending' ? 'warning' : 'danger') }}">
                                        {{ ucfirst($finance->status) }}
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Created:</strong></td>
                                <td>{{ $finance->created_at->format('F d, Y \a\t g:i A') }}</td>
                            </tr>
                            <tr>
                                <td><strong>Last Updated:</strong></td>
                                <td>{{ $finance->updated_at->format('F d, Y \a\t g:i A') }}</td>
                            </tr>
                            @if($finance->approved_by)
                            <tr>
                                <td><strong>Approved By:</strong></td>
                                <td>{{ $finance->approvedBy->name ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <td><strong>Approved At:</strong></td>
                                <td>{{ $finance->approved_at ? $finance->approved_at->format('F d, Y \a\t g:i A') : 'N/A' }}</td>
                            </tr>
                            @endif
                        </table>
                    </div>

                    <!-- Financial Information -->
                    <div class="col-md-6">
                        <h6 class="text-success mb-3">Financial Details</h6>
                        <table class="table table-borderless">
                            <tr>
                                <td><strong>Loan Amount:</strong></td>
                                <td class="text-end">UGX {{ number_format($finance->loan_amount, 2) }}</td>
                            </tr>
                            <tr>
                                <td><strong>Down Payment:</strong></td>
                                <td class="text-end">UGX {{ number_format($finance->down_payment, 2) }}</td>
                            </tr>
                            <tr>
                                <td><strong>Loan Term:</strong></td>
                                <td class="text-end">{{ $finance->loan_term_months }} Months</td>
                            </tr>
                            <tr>
                                <td><strong>Interest Rate:</strong></td>
                                <td class="text-end">{{ $finance->interest_rate }}%</td>
                            </tr>
                            <tr class="table-active">
                                <td><strong>Monthly Payment:</strong></td>
                                <td class="text-end"><strong>UGX {{ number_format($finance->monthly_payment, 2) }}</strong></td>
                            </tr>
                        </table>
                    </div>
                </div>

                <hr>

                <div class="row">
                    <!-- Customer Information -->
                    <div class="col-md-6">
                        <h6 class="text-info mb-3">Customer Information</h6>
                        <table class="table table-borderless">
                            <tr>
                                <td><strong>Name:</strong></td>
                                <td>{{ $finance->customer->first_name ?? 'N/A' }} {{ $finance->customer->last_name ?? '' }}</td>
                            </tr>
                            <tr>
                                <td><strong>Email:</strong></td>
                                <td>{{ $finance->customer->email ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <td><strong>Phone:</strong></td>
                                <td>{{ $finance->customer->phone ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <td><strong>Address:</strong></td>
                                <td>{{ $finance->customer->address ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <td><strong>City:</strong></td>
                                <td>{{ $finance->customer->city ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <td><strong>State:</strong></td>
                                <td>{{ $finance->customer->state ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <td><strong>ZIP Code:</strong></td>
                                <td>{{ $finance->customer->zip_code ?? 'N/A' }}</td>
                            </tr>
                        </table>
                    </div>

                    <!-- Vehicle Information -->
                    <div class="col-md-6">
                        <h6 class="text-warning mb-3">Vehicle Information</h6>
                        <table class="table table-borderless">
                            <tr>
                                <td><strong>Brand:</strong></td>
                                <td>{{ $finance->vehicle->brand->name ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <td><strong>Model:</strong></td>
                                <td>{{ $finance->vehicle->model ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <td><strong>Year:</strong></td>
                                <td>{{ $finance->vehicle->year ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <td><strong>Color:</strong></td>
                                <td>{{ $finance->vehicle->color ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <td><strong>VIN:</strong></td>
                                <td>{{ $finance->vehicle->vin ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <td><strong>Price:</strong></td>
                                <td>UGX {{ number_format($finance->vehicle->price ?? 0, 2) }}</td>
                            </tr>
                            <tr>
                                <td><strong>Status:</strong></td>
                                <td>
                                    <span class="badge bg-{{ $finance->vehicle->status === 'available' ? 'success' : ($finance->vehicle->status === 'sold' ? 'danger' : 'warning') }}">
                                        {{ ucfirst($finance->vehicle->status) }}
                                    </span>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>

                <hr>

                <div class="row">
                    <!-- Employment Information -->
                    <div class="col-md-6">
                        <h6 class="text-secondary mb-3">Employment Information</h6>
                        <table class="table table-borderless">
                            <tr>
                                <td><strong>Employment Status:</strong></td>
                                <td>{{ ucfirst(str_replace('_', ' ', $finance->employment_status)) }}</td>
                            </tr>
                            <tr>
                                <td><strong>Employer:</strong></td>
                                <td>{{ $finance->employer_name ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <td><strong>Job Title:</strong></td>
                                <td>{{ $finance->job_title ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <td><strong>Monthly Income:</strong></td>
                                <td>UGX {{ number_format($finance->monthly_income, 2) }}</td>
                            </tr>
                            <tr>
                                <td><strong>Credit Score:</strong></td>
                                <td>
                                    <span class="badge bg-{{ $finance->credit_score >= 700 ? 'success' : ($finance->credit_score >= 600 ? 'warning' : 'danger') }}">
                                        {{ $finance->credit_score }}
                                    </span>
                                </td>
                            </tr>
                        </table>
                    </div>

                    <!-- Approval Actions -->
                    <div class="col-md-6">
                        <h6 class="text-dark mb-3">Approval Actions</h6>
                        @if($finance->status === 'pending')
                            <div class="d-grid gap-2">
                                <form action="{{ route('admin.finance.approve', $finance) }}" method="POST" style="display: inline;">
                                    @csrf
                                    <button type="submit" class="btn btn-success w-100" 
                                            onclick="return confirm('Are you sure you want to approve this application?')">
                                        <i class="fas fa-check"></i> Approve Application
                                    </button>
                                </form>
                                <form action="{{ route('admin.finance.reject', $finance) }}" method="POST" style="display: inline;">
                                    @csrf
                                    <button type="submit" class="btn btn-danger w-100" 
                                            onclick="return confirm('Are you sure you want to reject this application?')">
                                        <i class="fas fa-times"></i> Reject Application
                                    </button>
                                </form>
                            </div>
                        @else
                            <div class="alert alert-{{ $finance->status === 'approved' ? 'success' : 'danger' }}">
                                <i class="fas fa-{{ $finance->status === 'approved' ? 'check' : 'times' }}"></i>
                                Application has been <strong>{{ $finance->status }}</strong>
                                @if($finance->approved_at)
                                    on {{ $finance->approved_at->format('F d, Y \a\t g:i A') }}
                                @endif
                            </div>
                        @endif
                    </div>
                </div>

                @if($finance->notes)
                <hr>
                <div class="row">
                    <div class="col-12">
                        <h6 class="text-secondary mb-3">Notes</h6>
                        <div class="alert alert-light">
                            {{ $finance->notes }}
                        </div>
                    </div>
                </div>
                @endif

                <!-- Action Buttons -->
                <div class="row mt-4">
                    <div class="col-12">
                        <div class="d-flex justify-content-between">
                            <div>
                                <a href="{{ route('admin.finance.edit', $finance) }}" class="btn btn-primary">
                                    <i class="fas fa-edit"></i> Edit Application
                                </a>
                                <a href="{{ route('admin.customers.show', $finance->customer) }}" class="btn btn-info">
                                    <i class="fas fa-user"></i> View Customer
                                </a>
                                <a href="{{ route('admin.vehicles.show', $finance->vehicle) }}" class="btn btn-warning">
                                    <i class="fas fa-car"></i> View Vehicle
                                </a>
                            </div>
                            <div>
                                <form action="{{ route('admin.finance.destroy', $finance) }}" method="POST" 
                                      onsubmit="return confirm('Are you sure you want to delete this application?')" 
                                      style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">
                                        <i class="fas fa-trash"></i> Delete Application
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
