<!--start brands section-->
<div class="separator section-padding">
  <div class="line"></div>
  <h3 class="mb-0 h3 fw-bold">Shop By Brands</h3>
  <div class="line"></div>
</div>

<div class="brands">
  <div class="row row-cols-2 row-cols-lg-5 g-4">
    @forelse($brands as $brand)
      <div class="col">
        <div class="p-3 border rounded brand-box">
          <div class="d-flex align-items-center">
            <a href="{{ route('vehicles.search', ['brand' => $brand->id]) }}">
              @if($brand->logo)
                <img src="{{ asset('storage/' . $brand->logo) }}" class="img-fluid" alt="{{ $brand->name }}">
              @else
                <div class="text-center w-100">
                  <h6 class="mb-0 fw-bold">{{ $brand->name }}</h6>
                </div>
              @endif
            </a>
          </div>
        </div>
      </div>
    @empty
      <div class="col-12 text-center">
        <p class="text-muted">No brands available at the moment.</p>
      </div>
    @endforelse
  </div>
  <!--end row-->
</div>
<!--end brands section-->
