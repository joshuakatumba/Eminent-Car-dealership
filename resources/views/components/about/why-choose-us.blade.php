<!--start why choose us-->
<div class="separator section-padding">
  <div class="line"></div>
  <h3 class="mb-0 h3 fw-bold">{{ $settings['why_choose_title'] ?? 'Why Choose Us' }}</h3>
  <div class="line"></div>
</div>

<div class="row row-cols-1 row-cols-xl-3 g-4 why-choose">
  <div class="col d-flex">
    <div class="card rounded-0 shadow-none w-100">
      <div class="card-body">
        <img src="{{ $settings['feature_1_icon'] ?? 'assets/images/icons/delivery.webp' }}" width="60" alt="">
        <h5 class="my-3 fw-bold">{{ $settings['feature_1_title'] ?? 'Quality Assurance' }}</h5>
        <p class="mb-0">{{ $settings['feature_1_description'] ?? 'Every vehicle in our inventory undergoes rigorous quality checks to ensure you get a reliable and well-maintained car that meets our high standards.' }}</p>
      </div>
    </div>
  </div>
  <div class="col d-flex">
    <div class="card rounded-0 shadow-none w-100">
      <div class="card-body">
        <img src="{{ $settings['feature_2_icon'] ?? 'assets/images/icons/money-bag.webp' }}" width="60" alt="">
        <h5 class="my-3 fw-bold">{{ $settings['feature_2_title'] ?? 'Best Price Guarantee' }}</h5>
        <p class="mb-0">{{ $settings['feature_2_description'] ?? 'We offer competitive pricing and transparent deals. If you find a better price elsewhere, we\'ll match it to ensure you get the best value for your money.' }}</p>
      </div>
    </div>
  </div>
  <div class="col d-flex">
    <div class="card rounded-0 shadow-none w-100">
      <div class="card-body">
        <img src="{{ $settings['feature_3_icon'] ?? 'assets/images/icons/support.webp' }}" width="60" alt="">
        <h5 class="my-3 fw-bold">{{ $settings['feature_3_title'] ?? 'Expert Support' }}</h5>
        <p class="mb-0">{{ $settings['feature_3_description'] ?? 'Our team of automotive experts is here to help you make informed decisions. From selection to financing, we provide comprehensive support throughout your journey.' }}</p>
      </div>
    </div>
  </div>
</div>
<!--end why choose us-->
