<!-- Related Vehicles Section -->
<section class="py-4 bg-light">
    <div class="container">
        <h4 class="mb-4 fw-bold">Related Vehicles</h4>
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4">
            @foreach($relatedVehicles as $relatedVehicle)
            <div class="col">
                <div class="card h-100">
                    @if($relatedVehicle->images->count() > 0)
                        <img src="{{ asset('storage/' . $relatedVehicle->images->first()->image_path) }}" 
                             class="card-img-top" 
                             alt="{{ $relatedVehicle->brand->name }} {{ $relatedVehicle->model }}">
                    @else
                        <img src="{{ asset('assets/images/placeholder-vehicle.svg') }}" 
                             class="card-img-top" 
                             alt="Vehicle placeholder">
                    @endif
                    <div class="card-body">
                        <h6 class="card-title">{{ $relatedVehicle->brand->name }} {{ $relatedVehicle->model }}</h6>
                        <p class="card-text text-muted">{{ $relatedVehicle->year }} • {{ number_format($relatedVehicle->mileage) }} miles</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="fw-bold">
                                @if($relatedVehicle->sale_price && $relatedVehicle->sale_price > 0)
                                    UGX {{ number_format($relatedVehicle->sale_price) }}
                                @else
                                    UGX {{ number_format($relatedVehicle->price) }}
                                @endif
                            </span>
                            <a href="{{ route('vehicles.show', $relatedVehicle->id) }}" class="btn btn-sm btn-outline-primary">View Details</a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
