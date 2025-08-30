<!--start Featured Products slider-->
<section class="section-padding">
  <div class="container">
    <div class="text-center pb-3">
      <h3 class="mb-0 h3 fw-bold">HOT DEALS</h3>
      <p class="mb-0 text-capitalize">Find hottest deals here.</p>
    </div>
    <div class="product-thumbs" data-slick='{"slidesToShow": 4, "slidesToScroll": 1, "autoplay": true, "autoplaySpeed": 3000, "dots": true, "arrows": true, "responsive": [{"breakpoint": 1200, "settings": {"slidesToShow": 3}}, {"breakpoint": 768, "settings": {"slidesToShow": 2}}, {"breakpoint": 576, "settings": {"slidesToShow": 1}}]}'>
      @forelse($hotDeals as $vehicle)
        <x-shared.hot-deals-card :vehicle="$vehicle" />
      @empty
        <div class="text-center">
          <p class="text-muted">No hot deals available at the moment.</p>
        </div>
      @endforelse
    </div>
  </div>
</section>
<!--end Featured Products slider-->
