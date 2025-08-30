<!--start tabular product-->
<section class="product-tab-section section-padding bg-light">
  <div class="container">
    <div class="text-center pb-3">
      <h3 class="mb-0 h3 fw-bold">Latest Products</h3>
      <p class="mb-0 text-capitalize">Grab the best out of all cars</p>
    </div>
    <div class="row">
      <div class="col-auto mx-auto">
        <div class="product-tab-menu table-responsive">
          <ul class="nav nav-pills flex-nowrap" id="pills-tab" role="tablist">
            <li class="nav-item" role="presentation">
              <button class="nav-link active" data-bs-toggle="pill" data-bs-target="#new-arrival" type="button">New
                Arrival</button>
            </li>
            <li class="nav-item" role="presentation">
              <button class="nav-link" data-bs-toggle="pill" data-bs-target="#best-sellar" type="button">Best
                Sellar</button>
            </li>
            <li class="nav-item" role="presentation">
              <button class="nav-link" data-bs-toggle="pill" data-bs-target="#trending-product"
                type="button">Trending</button>
            </li>
            <li class="nav-item" role="presentation">
              <button class="nav-link" data-bs-toggle="pill" data-bs-target="#special-offer" type="button">Special
                Offer</button>
            </li>
          </ul>
        </div>
      </div>
    </div>
    <hr>
    <div class="tab-content tabular-product">
      <div class="tab-pane fade show active" id="new-arrival">
        <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-4 row-cols-xxl-5 g-4">
          @forelse($newArrivals as $vehicle)
            <x-shared.vehicle-card :vehicle="$vehicle" />
          @empty
            <div class="col-12 text-center">
              <p class="text-muted">No new arrivals available at the moment.</p>
            </div>
          @endforelse
        </div>
      </div>
      <div class="tab-pane fade" id="best-sellar">
        <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-4 row-cols-xxl-5 g-4">
          @forelse($bestSellers as $vehicle)
            <x-shared.vehicle-card :vehicle="$vehicle" />
          @empty
            <div class="col-12 text-center">
              <p class="text-muted">No best sellers available at the moment.</p>
            </div>
          @endforelse
        </div>
      </div>
      <div class="tab-pane fade" id="trending-product">
        <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-4 row-cols-xxl-5 g-4">
          @forelse($trendingVehicles as $vehicle)
            <x-shared.vehicle-card :vehicle="$vehicle" />
          @empty
            <div class="col-12 text-center">
              <p class="text-muted">No trending vehicles available at the moment.</p>
            </div>
          @endforelse
        </div>
      </div>
      <div class="tab-pane fade" id="special-offer">
        <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-4 row-cols-xxl-5 g-4">
          @forelse($specialOffers as $vehicle)
            <x-shared.vehicle-card :vehicle="$vehicle" />
          @empty
            <div class="col-12 text-center">
              <p class="text-muted">No special offers available at the moment.</p>
            </div>
          @endforelse
        </div>
      </div>
    </div>
  </div>
</section>
<!--end tabular product-->
