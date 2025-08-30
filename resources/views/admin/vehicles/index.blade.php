@extends('admin.layouts.app')

@section('title', 'Vehicles')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Vehicles</h2>
    <a href="{{ route('admin.vehicles.create') }}" class="btn btn-primary btn-admin">
        <i class="fas fa-plus"></i> Add Vehicle
    </a>
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Image</th>
                        <th>Brand</th>
                        <th>Model</th>
                        <th>Year</th>
                        <th>Price</th>
                        <th>Rating</th>
                        <th>Discount</th>
                        <th>Categories</th>
                        <th>Status</th>
                        <th>Created By</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($vehicles as $vehicle)
                    <tr>
                        <td>{{ $vehicle->id }}</td>
                        <td>
                            @if($vehicle->primaryImage)
                                <img src="{{ asset('storage/' . $vehicle->primaryImage->image_path) }}" 
                                     alt="{{ $vehicle->model }}" 
                                     class="img-thumbnail" 
                                     style="width: 50px; height: 50px; object-fit: cover;">
                            @else
                                <div class="bg-light d-flex align-items-center justify-content-center" 
                                     style="width: 50px; height: 50px;">
                                    <i class="fas fa-car text-muted"></i>
                                </div>
                            @endif
                        </td>
                        <td>{{ $vehicle->brand->name }}</td>
                        <td>{{ $vehicle->model }}</td>
                        <td>{{ $vehicle->year }}</td>
                        <td>UGX {{ number_format($vehicle->price, 2) }}</td>
                        <td>
                            @if($vehicle->star_rating > 0)
                                <div class="d-flex align-items-center">
                                    @for($i = 1; $i <= 5; $i++)
                                        @if($i <= $vehicle->star_rating)
                                            <i class="fas fa-star text-warning" style="font-size: 12px;"></i>
                                        @else
                                            <i class="far fa-star text-muted" style="font-size: 12px;"></i>
                                        @endif
                                    @endfor
                                    <span class="ms-1 small">{{ $vehicle->star_rating }}/5</span>
                                </div>
                            @else
                                <span class="text-muted small">No rating</span>
                            @endif
                        </td>
                        <td>
                            @if($vehicle->discount_percentage > 0 && $vehicle->isDiscountActive())
                                <span class="badge bg-danger">{{ $vehicle->discount_percentage }}% OFF</span>
                                <br>
                                <small class="text-muted">UGX {{ number_format($vehicle->discounted_price, 2) }}</small>
                            @else
                                <span class="text-muted small">No discount</span>
                            @endif
                        </td>
                        <td>
                            <div class="d-flex flex-wrap gap-1">
                                @if($vehicle->is_new_arrival)
                                    <span class="badge bg-primary" style="font-size: 10px;">New</span>
                                @endif
                                @if($vehicle->is_best_seller)
                                    <span class="badge bg-success" style="font-size: 10px;">Best</span>
                                @endif
                                @if($vehicle->is_trending)
                                    <span class="badge bg-warning" style="font-size: 10px;">Trend</span>
                                @endif
                                @if($vehicle->is_special_offer)
                                    <span class="badge bg-danger" style="font-size: 10px;">Offer</span>
                                @endif
                                @if($vehicle->is_featured)
                                    <span class="badge bg-info" style="font-size: 10px;">Featured</span>
                                @endif
                            </div>
                        </td>
                        <td>
                            <span class="badge bg-{{ 
                                $vehicle->status === 'available' ? 'success' : 
                                ($vehicle->status === 'sold' ? 'danger' : 
                                ($vehicle->status === 'reserved' ? 'warning' : 
                                ($vehicle->status === 'booked' ? 'info' :
                                ($vehicle->status === 'out_of_stock' ? 'secondary' :
                                ($vehicle->status === 'maintenance' ? 'info' : 'secondary'))))) 
                            }}">
                                {{ ucfirst(str_replace('_', ' ', $vehicle->status)) }}
                            </span>
                        </td>
                        <td>{{ $vehicle->creator->name }}</td>
                        <td>
                            <div class="btn-group" role="group">
                                <a href="{{ route('admin.vehicles.show', $vehicle) }}" 
                                   class="btn btn-sm btn-outline-primary">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('admin.vehicles.edit', $vehicle) }}" 
                                   class="btn btn-sm btn-outline-warning">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.vehicles.destroy', $vehicle) }}" 
                                      method="POST" 
                                      onsubmit="return confirm('Are you sure you want to delete this vehicle?')"
                                      style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="12" class="text-center">No vehicles found</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        @if($vehicles->hasPages())
        <div class="d-flex justify-content-center mt-4">
            {{ $vehicles->links() }}
        </div>
        @endif
    </div>
</div>
@endsection
