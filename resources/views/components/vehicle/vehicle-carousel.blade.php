<!-- Main Carousel -->
<div id="productCarousel" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner rounded shadow">
        @if($vehicle->images->count() > 0)
            @foreach($vehicle->images as $index => $image)
                <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                    <img src="{{ asset('storage/' . $image->image_path) }}" 
                         class="d-block w-100 main-carousel-img"
                         alt="{{ $vehicle->brand->name }} {{ $vehicle->model }} - Image {{ $index + 1 }}">
                </div>
            @endforeach
        @else
            <div class="carousel-item active">
                <img src="{{ asset('assets/images/placeholder-vehicle.svg') }}" 
                     class="d-block w-100 main-carousel-img"
                     alt="{{ $vehicle->brand->name }} {{ $vehicle->model }}">
            </div>
        @endif
    </div>

    @if($vehicle->images->count() > 1)
        <!-- Controls -->
        <button class="carousel-control-prev" type="button" data-bs-target="#productCarousel"
            data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#productCarousel"
            data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
        </button>
    @endif
</div>

@if($vehicle->images->count() > 1)
    <!-- Thumbnail Row -->
    <div class="thumbnail-scroll-container mt-3">
        <div class="d-flex flex-nowrap" id="thumbnailRow">
            @foreach($vehicle->images as $index => $image)
                <img src="{{ asset('storage/' . $image->image_path) }}" 
                     class="thumbnail-img {{ $index === 0 ? 'active-thumb' : '' }}"
                     data-bs-target="#productCarousel" 
                     data-bs-slide-to="{{ $index }}" 
                     alt="Thumb {{ $index + 1 }}">
            @endforeach
        </div>
    </div>
@endif

<style>
.main-carousel-img {
    height: 400px;
    object-fit: cover;
}

.thumbnail-scroll-container {
    overflow-x: auto;
    white-space: nowrap;
}

.thumbnail-img {
    width: 80px;
    height: 60px;
    object-fit: cover;
    border: 2px solid transparent;
    border-radius: 4px;
    cursor: pointer;
    margin-right: 8px;
    transition: border-color 0.3s ease;
}

.thumbnail-img.active-thumb {
    border-color: #007bff;
}
</style>

<script>
// Thumbnail click functionality
document.addEventListener('DOMContentLoaded', function() {
    const thumbnails = document.querySelectorAll('.thumbnail-img');
    thumbnails.forEach(function(thumb) {
        thumb.addEventListener('click', function() {
            // Remove active class from all thumbnails
            thumbnails.forEach(t => t.classList.remove('active-thumb'));
            // Add active class to clicked thumbnail
            this.classList.add('active-thumb');
        });
    });
});
</script>
