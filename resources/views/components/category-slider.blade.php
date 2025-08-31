<!-- Category Slider Section -->
<section class="cartegory-slider section-padding bg-section-2">
    <div class="container">
        <div class="text-center pb-3">
            <h3 class="mb-0 h3 fw-bold">Top Categories</h3>
            <p class="mb-0 text-capitalize">Select your favorite categories and purchase</p>
        </div>
        <div class="cartegory-box">
            <a href="{{ route('vehicles.index', ['category' => 'SUV']) }}">
                <div class="card">
                    <div class="card-body top-categories">
                        <div class="overflow-hidden card-img-top">
                            <img src="{{ asset('assets/images/categories/01.jpg') }}" class="card-img-top rounded-0" alt="SUV Category">
                        </div>
                        <div class="text-center">
                            <h5 class="mb-1 cartegory-name mt-3 fw-bold">SUV</h5>
                            <h6 class="mb-0 product-number fw-bold">{{ \App\Models\Vehicle::whereHas('category', function($q) { $q->where('name', 'SUV'); })->count() }} Products</h6>
                        </div>
                    </div>
                </div>
            </a>
            <a href="{{ route('vehicles.index', ['category' => 'Van']) }}">
                <div class="card">
                    <div class="card-body top-categories">
                        <div class="overflow-hidden card-img-top">
                            <img src="{{ asset('assets/images/categories/02.webp') }}" class="card-img-top rounded-0" alt="VAN Category">
                        </div>
                        <div class="text-center">
                            <h5 class="mb-1 cartegory-name mt-3 fw-bold">VAN</h5>
                            <h6 class="mb-0 product-number fw-bold">{{ \App\Models\Vehicle::whereHas('category', function($q) { $q->where('name', 'Van'); })->count() }} Products</h6>
                        </div>
                    </div>
                </div>
            </a>
            <a href="{{ route('vehicles.index', ['category' => 'Truck']) }}">
                <div class="card">
                    <div class="card-body top-categories">
                        <div class="overflow-hidden card-img-top">
                            <img src="{{ asset('assets/images/categories/03.jpg') }}" class="card-img-top rounded-0" alt="TRUCK Category">
                        </div>
                        <div class="text-center">
                            <h5 class="mb-1 cartegory-name mt-3 fw-bold">TRUCK</h5>
                            <h6 class="mb-0 product-number fw-bold">{{ \App\Models\Vehicle::whereHas('category', function($q) { $q->where('name', 'Truck'); })->count() }} Products</h6>
                        </div>
                    </div>
                </div>
            </a>
            <a href="{{ route('vehicles.index', ['category' => 'Hatchback']) }}">
                <div class="card">
                    <div class="card-body top-categories">
                        <div class="overflow-hidden card-img-top">
                            <img src="{{ asset('assets/images/categories/04.jpg') }}" class="card-img-top rounded-0" alt="HATCHBACK Category">
                        </div>
                        <div class="text-center">
                            <h5 class="mb-1 cartegory-name mt-3 fw-bold">HATCHBACK</h5>
                            <h6 class="mb-0 product-number fw-bold">{{ \App\Models\Vehicle::whereHas('category', function($q) { $q->where('name', 'Hatchback'); })->count() }} Products</h6>
                        </div>
                    </div>
                </div>
            </a>
            <a href="{{ route('vehicles.index', ['category' => 'Sedan']) }}">
                <div class="card">
                    <div class="card-body top-categories">
                        <div class="overflow-hidden card-img-top">
                            <img src="{{ asset('assets/images/categories/05.jpg') }}" class="card-img-top rounded-0" alt="SEDAN Category">
                        </div>
                        <div class="text-center">
                            <h5 class="mb-1 cartegory-name mt-3 fw-bold">SEDAN</h5>
                            <h6 class="mb-0 product-number fw-bold">{{ \App\Models\Vehicle::whereHas('category', function($q) { $q->where('name', 'Sedan'); })->count() }} Products</h6>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>
</section>
