<h4 class="product-title fw-bold mb-1">{{ $vehicle->brand->name }} {{ $vehicle->model }}</h4>
<p class="mb-0">{{ $vehicle->year }} Model</p>
<div class="product-rating">
    <div class="hstack gap-2 border p-1 mt-3 width-content">
        <div><span class="rating-number">4.8</span><i class="bi bi-star-fill ms-1 text-warning"></i></div>
        <div class="vr"></div>
        <div>162 Ratings</div>
    </div>
</div>
<hr>
<div class="product-price d-flex align-items-center gap-3">
    @if($vehicle->sale_price && $vehicle->sale_price > 0)
        <div class="h4 fw-bold">UGX {{ number_format($vehicle->sale_price) }}</div>
        <div class="h5 fw-light text-muted text-decoration-line-through">UGX {{ number_format($vehicle->price) }}</div>
        @php
            $discount = round((($vehicle->price - $vehicle->sale_price) / $vehicle->price) * 100);
        @endphp
        <div class="h4 fw-bold text-danger">({{ $discount }}% off)</div>
    @else
        <div class="h4 fw-bold">UGX {{ number_format($vehicle->price) }}</div>
    @endif
</div>
<p class="fw-bold mb-0 mt-1 text-success">Exclusive of all taxes</p>

<div class="more-colors mt-4">
    <h6 class="fw-bold mb-3">Vehicle Status</h6>
    <div class="d-flex align-items-center gap-3">
        <span class="badge bg-{{ $vehicle->status === 'available' ? 'success' : ($vehicle->status === 'sold' ? 'danger' : 'warning') }} fs-6">
            {{ ucfirst($vehicle->status) }}
        </span>
    </div>
</div>

<div class="key-specifications mt-4">
    <h6 class="fw-bold mb-3">Key Specifications</h6>
    <div class="row g-2">
        <div class="col-6">
            <div class="spec-item">
                <div class="spec-label">Year</div>
                <div class="spec-value">{{ $vehicle->year }}</div>
            </div>
        </div>
        <div class="col-6">
            <div class="spec-item">
                <div class="spec-label">Brand</div>
                <div class="spec-value">{{ $vehicle->brand->name }}</div>
            </div>
        </div>
        <div class="col-6">
            <div class="spec-item">
                <div class="spec-label">Fuel Type</div>
                <div class="spec-value">{{ ucfirst($vehicle->fuel_type) }}</div>
            </div>
        </div>
        <div class="col-6">
            <div class="spec-item">
                <div class="spec-label">Transmission</div>
                <div class="spec-value">{{ ucfirst($vehicle->transmission) }}</div>
            </div>
        </div>
        <div class="col-6">
            <div class="spec-item">
                <div class="spec-label">Mileage</div>
                <div class="spec-value">{{ number_format($vehicle->mileage) }} miles</div>
            </div>
        </div>
        @if($vehicle->engine)
        <div class="col-6">
            <div class="spec-item">
                <div class="spec-label">Engine</div>
                <div class="spec-value">{{ $vehicle->engine }}</div>
            </div>
        </div>
        @endif
        @if($vehicle->color)
        <div class="col-6">
            <div class="spec-item">
                <div class="spec-label">Color</div>
                <div class="spec-value">{{ $vehicle->color }}</div>
            </div>
        </div>
        @endif
        @if($vehicle->category)
        <div class="col-6">
            <div class="spec-item">
                <div class="spec-label">Category</div>
                <div class="spec-value">{{ $vehicle->category->name }}</div>
            </div>
        </div>
        @endif
    </div>
</div>
<div class="cart-buttons mt-3">
    <div class="buttons d-flex flex-column flex-lg-row gap-3 mt-4">
        <a href="tel:+256774959446" class="btn btn-lg btn-dark btn-ecomm px-5 py-3 col-lg-6">
            <i class="bi bi-phone"></i>Call to inquire
        </a>
        <a href="https://wa.me/256774959446" class="btn btn-lg btn-outline-dark btn-ecomm px-5 py-3">
            <i class="bi bi-whatsapp me-2"></i>WhatsApp
        </a>
    </div>
</div>
<hr class="my-3">

<style>
/* Key Specifications Styling */
.key-specifications {
    background: #f8f9fa;
    border-radius: 8px;
    padding: 1.5rem;
    border: 1px solid #e9ecef;
}

.spec-item {
    background: white;
    border-radius: 6px;
    padding: 0.75rem;
    border: 1px solid #e9ecef;
    transition: all 0.3s ease;
    height: 100%;
}

.spec-item:hover {
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    transform: translateY(-1px);
}

.spec-label {
    font-size: 0.8rem;
    color: #6c757d;
    font-weight: 500;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    margin-bottom: 0.25rem;
}

.spec-value {
    font-size: 0.95rem;
    font-weight: 600;
    color: #212529;
    line-height: 1.2;
}

/* Responsive adjustments for Key Specifications */
@media (max-width: 768px) {
    .key-specifications {
        padding: 1rem;
    }
    
    .spec-item {
        padding: 0.5rem;
    }
    
    .spec-label {
        font-size: 0.75rem;
    }
    
    .spec-value {
        font-size: 0.9rem;
    }
}
</style>
