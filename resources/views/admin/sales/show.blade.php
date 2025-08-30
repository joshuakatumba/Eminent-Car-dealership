@extends('admin.layouts.app')

@section('title', 'Sale Details')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-file-invoice-dollar"></i> Sale Details
                    </h5>
                    <div>
                        <a href="{{ route('admin.sales.edit', $sale) }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <a href="{{ route('admin.sales.index') }}" class="btn btn-secondary btn-sm">
                            <i class="fas fa-arrow-left"></i> Back
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <!-- Sale Information -->
                    <div class="col-md-6">
                        <h6 class="text-primary mb-3">Sale Information</h6>
                        <table class="table table-borderless">
                            <tr>
                                <td><strong>Sale ID:</strong></td>
                                <td>#{{ $sale->id }}</td>
                            </tr>
                            <tr>
                                <td><strong>Sale Date:</strong></td>
                                <td>{{ $sale->sale_date ? $sale->sale_date->format('F d, Y') : 'N/A' }}</td>
                            </tr>
                            <tr>
                                <td><strong>Status:</strong></td>
                                <td>
                                    <span class="badge bg-{{ $sale->status === 'completed' ? 'success' : ($sale->status === 'pending' ? 'warning' : 'danger') }}">
                                        {{ ucfirst($sale->status) }}
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Payment Method:</strong></td>
                                <td>{{ ucfirst($sale->payment_method) }}</td>
                            </tr>
                            <tr>
                                <td><strong>Salesperson:</strong></td>
                                <td>{{ $sale->salesperson->name ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <td><strong>Created:</strong></td>
                                <td>{{ $sale->created_at->format('F d, Y \a\t g:i A') }}</td>
                            </tr>
                            <tr>
                                <td><strong>Last Updated:</strong></td>
                                <td>{{ $sale->updated_at->format('F d, Y \a\t g:i A') }}</td>
                            </tr>
                        </table>
                    </div>

                    <!-- Financial Information -->
                    <div class="col-md-6">
                        <h6 class="text-success mb-3">Financial Details</h6>
                        <table class="table table-borderless">
                            <tr>
                                <td><strong>Sale Price:</strong></td>
                                <td class="text-end">UGX {{ number_format($sale->sale_price, 2) }}</td>
                            </tr>
                            <tr>
                                <td><strong>Down Payment:</strong></td>
                                <td class="text-end">UGX {{ number_format($sale->down_payment ?? 0, 2) }}</td>
                            </tr>
                            <tr>
                                <td><strong>Financing Amount:</strong></td>
                                <td class="text-end">UGX {{ number_format($sale->financing_amount ?? 0, 2) }}</td>
                            </tr>
                            <tr>
                                <td><strong>Trade-in Value:</strong></td>
                                <td class="text-end">UGX {{ number_format($sale->trade_in_value ?? 0, 2) }}</td>
                            </tr>
                            <tr>
                                <td><strong>Tax Amount:</strong></td>
                                <td class="text-end">UGX {{ number_format($sale->tax_amount ?? 0, 2) }}</td>
                            </tr>
                            <tr class="table-active">
                                <td><strong>Total Amount:</strong></td>
                                <td class="text-end"><strong>UGX {{ number_format($sale->total_amount, 2) }}</strong></td>
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
                                <td>{{ $sale->customer->first_name ?? 'N/A' }} {{ $sale->customer->last_name ?? '' }}</td>
                            </tr>
                            <tr>
                                <td><strong>Email:</strong></td>
                                <td>{{ $sale->customer->email ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <td><strong>Phone:</strong></td>
                                <td>{{ $sale->customer->phone ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <td><strong>Address:</strong></td>
                                <td>{{ $sale->customer->address ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <td><strong>City:</strong></td>
                                <td>{{ $sale->customer->city ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <td><strong>State:</strong></td>
                                <td>{{ $sale->customer->state ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <td><strong>ZIP Code:</strong></td>
                                <td>{{ $sale->customer->zip_code ?? 'N/A' }}</td>
                            </tr>
                        </table>
                    </div>

                    <!-- Vehicle Information -->
                    <div class="col-md-6">
                        <h6 class="text-warning mb-3">Vehicle Information</h6>
                        <table class="table table-borderless">
                            <tr>
                                <td><strong>Brand:</strong></td>
                                <td>{{ $sale->vehicle->brand->name ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <td><strong>Model:</strong></td>
                                <td>{{ $sale->vehicle->model ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <td><strong>Year:</strong></td>
                                <td>{{ $sale->vehicle->year ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <td><strong>Color:</strong></td>
                                <td>{{ $sale->vehicle->color ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <td><strong>VIN:</strong></td>
                                <td>{{ $sale->vehicle->vin ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <td><strong>Mileage:</strong></td>
                                <td>{{ number_format($sale->vehicle->mileage ?? 0) }} miles</td>
                            </tr>
                            <tr>
                                <td><strong>Original Price:</strong></td>
                                <td>UGX {{ number_format($sale->vehicle->price ?? 0, 2) }}</td>
                            </tr>
                            <tr>
                                <td><strong>Status:</strong></td>
                                <td>
                                    <span class="badge bg-{{ $sale->vehicle->status === 'available' ? 'success' : ($sale->vehicle->status === 'sold' ? 'danger' : 'warning') }}">
                                        {{ ucfirst($sale->vehicle->status) }}
                                    </span>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>

                @if($sale->notes)
                <hr>
                <div class="row">
                    <div class="col-12">
                        <h6 class="text-secondary mb-3">Notes</h6>
                        <div class="alert alert-light">
                            {{ $sale->notes }}
                        </div>
                    </div>
                </div>
                @endif

                <!-- Action Buttons -->
                <div class="row mt-4">
                    <div class="col-12">
                        <div class="d-flex justify-content-between">
                            <div>
                                <a href="{{ route('admin.sales.edit', $sale) }}" class="btn btn-primary">
                                    <i class="fas fa-edit"></i> Edit Sale
                                </a>
                                <a href="{{ route('admin.customers.show', $sale->customer) }}" class="btn btn-info">
                                    <i class="fas fa-user"></i> View Customer
                                </a>
                                <a href="{{ route('admin.vehicles.show', $sale->vehicle) }}" class="btn btn-warning">
                                    <i class="fas fa-car"></i> View Vehicle
                                </a>
                            </div>
                            <div>
                                <form action="{{ route('admin.sales.destroy', $sale) }}" method="POST" 
                                      onsubmit="return confirm('Are you sure you want to delete this sale?')" 
                                      style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">
                                        <i class="fas fa-trash"></i> Delete Sale
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
