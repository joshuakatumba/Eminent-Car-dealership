@extends('admin.layouts.app')

@section('title', 'Vehicle Details')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title">Vehicle Details: {{ $vehicle->brand->name }} {{ $vehicle->model }}</h4>
                    <div>
                        <a href="{{ route('admin.vehicles.edit', $vehicle) }}" class="btn btn-warning">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <a href="{{ route('admin.vehicles.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Back to Vehicles
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h5 class="mb-3">Basic Information</h5>
                            <table class="table table-borderless">
                                <tr>
                                    <td><strong>Category:</strong></td>
                                    <td>{{ $vehicle->category->name }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Brand:</strong></td>
                                    <td>{{ $vehicle->brand->name }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Model:</strong></td>
                                    <td>{{ $vehicle->model }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Year:</strong></td>
                                    <td>{{ $vehicle->year }}</td>
                                </tr>
                                <tr>
                                    <td><strong>VIN Number:</strong></td>
                                    <td>{{ $vehicle->vin_number }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Status:</strong></td>
                                    <td>
                                        <span class="badge bg-{{ 
                                            $vehicle->status == 'available' ? 'success' : 
                                            ($vehicle->status == 'sold' ? 'danger' : 
                                            ($vehicle->status == 'reserved' ? 'warning' : 
                                            ($vehicle->status == 'booked' ? 'info' :
                                            ($vehicle->status == 'out_of_stock' ? 'secondary' :
                                            ($vehicle->status == 'maintenance' ? 'info' : 'secondary'))))) 
                                        }}">
                                            {{ ucfirst(str_replace('_', ' ', $vehicle->status)) }}
                                        </span>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        
                        <div class="col-md-6">
                            <h5 class="mb-3">Specifications</h5>
                            <table class="table table-borderless">
                                <tr>
                                    <td><strong>Mileage:</strong></td>
                                    <td>{{ number_format($vehicle->mileage) }} miles</td>
                                </tr>
                                <tr>
                                    <td><strong>Engine Size:</strong></td>
                                    <td>{{ $vehicle->engine_size ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Fuel Type:</strong></td>
                                    <td>{{ ucfirst($vehicle->fuel_type) }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Transmission:</strong></td>
                                    <td>{{ ucfirst($vehicle->transmission) }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Color:</strong></td>
                                    <td>{{ $vehicle->color }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Interior Color:</strong></td>
                                    <td>{{ $vehicle->interior_color ?? 'N/A' }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    
                    <div class="row mt-4">
                        <div class="col-md-6">
                            <h5 class="mb-3">Pricing</h5>
                            <table class="table table-borderless">
                                <tr>
                                    <td><strong>Price:</strong></td>
                                    <td>UGX {{ number_format($vehicle->price, 2) }}</td>
                                </tr>
                                @if($vehicle->sale_price)
                                <tr>
                                    <td><strong>Sale Price:</strong></td>
                                    <td>UGX {{ number_format($vehicle->sale_price, 2) }}</td>
                                </tr>
                                @endif
                                <tr>
                                    <td><strong>Featured:</strong></td>
                                    <td>
                                        @if($vehicle->is_featured)
                                            <span class="badge bg-success">Yes</span>
                                        @else
                                            <span class="badge bg-secondary">No</span>
                                        @endif
                                    </td>
                                </tr>
                            </table>
                        </div>
                        
                        <div class="col-md-6">
                            <h5 class="mb-3">Additional Information</h5>
                            <table class="table table-borderless">
                                <tr>
                                    <td><strong>Created By:</strong></td>
                                    <td>{{ $vehicle->creator->name ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Created Date:</strong></td>
                                    <td>{{ $vehicle->created_at->format('M d, Y H:i') }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Last Updated:</strong></td>
                                    <td>{{ $vehicle->updated_at->format('M d, Y H:i') }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    
                    @if($vehicle->description)
                    <div class="row mt-4">
                        <div class="col-12">
                            <h5 class="mb-3">Description</h5>
                            <div class="card">
                                <div class="card-body">
                                    {{ $vehicle->description }}
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                    
                    @if($vehicle->images->count() > 0)
                    <div class="row mt-4">
                        <div class="col-12">
                            <h5 class="mb-3">Images</h5>
                            <div class="row">
                                @foreach($vehicle->images as $image)
                                <div class="col-md-3 mb-3">
                                    <img src="{{ asset('storage/' . $image->image_path) }}" 
                                         class="img-fluid rounded" alt="Vehicle Image">
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    @endif
                    
                    @if($vehicle->maintenanceRecords->count() > 0)
                    <div class="row mt-4">
                        <div class="col-12">
                            <h5 class="mb-3">Maintenance Records</h5>
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Date</th>
                                            <th>Service Type</th>
                                            <th>Description</th>
                                            <th>Cost</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($vehicle->maintenanceRecords as $record)
                                        <tr>
                                            <td>{{ $record->service_date->format('M d, Y') }}</td>
                                            <td>{{ $record->service_type }}</td>
                                            <td>{{ $record->description }}</td>
                                            <td>UGX {{ number_format($record->cost, 2) }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
