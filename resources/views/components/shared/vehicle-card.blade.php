@props(['vehicle'])

<div class="col">
    <div class="card">
        @if($vehicle->sale_price && $vehicle->sale_price > 0)
            @php
                $discount = round((($vehicle->price - $vehicle->sale_price) / $vehicle->price) * 100);
            @endphp
            <div class="ribban">{{ $discount }}% DISCOUNT</div>
        @elseif($vehicle->is_featured)
            <div class="ribban bg-primary">FEATURED</div>
        @elseif($vehicle->status === 'sold')
            <div class="ribban">SOLD</div>
        @elseif($vehicle->status === 'booked')
            <div class="ribban-booked">BOOKED</div>
        @elseif($vehicle->status === 'available')
            <div class="ribban-available">AVAILABLE</div>
        @endif
        
        <div class="position-relative overflow-hidden">
            <div class="product-options d-flex align-items-center justify-content-center gap-2 mx-auto position-absolute bottom-0 start-0 end-0">
                <a href="javascript:;" class="quick-view-btn" data-vehicle-id="{{ $vehicle->id }}" data-bs-toggle="modal" data-bs-target="#QuickViewModal" title="Quick View">
                    <i class="bi bi-zoom-in"></i>
                </a>
            </div>
            <a href="{{ route('vehicles.show', $vehicle->id) }}">
                @if($vehicle->images->where('is_primary', true)->first())
                    <img src="{{ asset('storage/' . $vehicle->images->where('is_primary', true)->first()->image_path) }}" 
                         class="card-img-top" alt="{{ $vehicle->brand->name }} {{ $vehicle->model }}">
                @elseif($vehicle->images->first())
                    <img src="{{ asset('storage/' . $vehicle->images->first()->image_path) }}" 
                         class="card-img-top" alt="{{ $vehicle->brand->name }} {{ $vehicle->model }}">
                @else
                    <img src="{{ asset('assets/images/placeholder-vehicle.svg') }}" 
                         class="card-img-top" alt="Vehicle placeholder">
                @endif
            </a>
        </div>
        <div class="card-body">
            <div class="product-info text-center">
                <h6 class="mb-1 fw-bold product-name">{{ $vehicle->brand->name }} {{ $vehicle->model }}</h6>
                <div class="ratings mb-1 h6">
                    <i class="bi bi-star-fill text-warning"></i>
                    <i class="bi bi-star-fill text-warning"></i>
                    <i class="bi bi-star-fill text-warning"></i>
                    <i class="bi bi-star-fill text-warning"></i>
                    <i class="bi bi-star-fill text-warning"></i>
                </div>
                <p class="mb-0 h6 fw-bold product-price">
                    @if($vehicle->sale_price && $vehicle->sale_price > 0)
                                            <span class="text-decoration-line-through text-muted">UGX {{ number_format($vehicle->price) }}</span>
                    <span class="text-danger">UGX {{ number_format($vehicle->sale_price) }}</span>
                @else
                    UGX {{ number_format($vehicle->price) }}
                    @endif
                </p>
                <small class="text-muted">{{ $vehicle->year }} • {{ number_format($vehicle->mileage) }} miles</small>
            </div>
        </div>
    </div>
</div>
