<!-- Vehicle Description -->
<div class="mb-4">
    <h5 class="fw-bold mb-3">Vehicle Description</h5>
    <p class="product-description">
        @if($vehicle->description)
            {{ $vehicle->description }}
        @else
            Experience the exceptional {{ $vehicle->brand->name }} {{ $vehicle->model }}. This {{ $vehicle->year }} model combines luxury, performance, and reliability in one outstanding vehicle. With {{ number_format($vehicle->mileage) }} miles on the odometer, this {{ ucfirst($vehicle->fuel_type) }}-powered vehicle features {{ ucfirst($vehicle->transmission) }} transmission for smooth and responsive driving. Don't miss the opportunity to own this exceptional vehicle at an unbeatable price.
        @endif
    </p>
</div>

<style>
.product-description {
    line-height: 1.6;
    color: #495057;
}
</style>
