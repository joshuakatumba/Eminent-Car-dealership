<!--start footer-->
<section class="footer-section bg-section-2 section-padding footer-btm">
  <div class="container">
    <div class="row row-cols-1 row-cols-lg-4 g-4">
      <div class="col">
        <div class="footer-widget-6">
          <img src="assets/images/Eminent-LOGO-White-BG.png" class="logo-img mb-3" alt="">
          <h5 class="mb-3 fw-bolds">About Us</h5>
          <p class="mb-2">{{ $settings['about_paragraph_1'] ?? 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable.' }}</p>

          <a class="link-dark" href="{{ route('about') }}">Read More</a>
        </div>
      </div>
      <div class="col">
        <div class="footer-widget-7">
          <h5 class="mb-3 fw-bolds">Explore</h5>
          <ul class="widget-link list-unstyled">
            @forelse($categories->take(7) as $category)
              <li><a href="{{ route('vehicles.search', ['category' => $category->id]) }}">{{ $category->name }}</a></li>
            @empty
              <li><a href="javascript:;">SUVs</a></li>
              <li><a href="javascript:;">Sedans</a></li>
              <li><a href="javascript:;">Pickup Trucks</a></li>
              <li><a href="javascript:;">Hatchbacks</a></li>
              <li><a href="javascript:;">Vans</a></li>
              <li><a href="javascript:;">Wagons</a></li>
              <li><a href="javascript:;">EVs</a></li>
            @endforelse
          </ul>
        </div>
      </div>
      <div class="col">
        <div class="footer-widget-8">
          <h5 class="mb-3 fw-bolds">Company</h5>
          <ul class="widget-link list-unstyled">
            <li><a href="{{ route('about') }}">About Us</a></li>
            <li><a href="{{ route('contact') }}">Contact Us</a></li>
            <!-- <li><a href="javascript:;">FAQ</a></li>
            <li><a href="javascript:;">Privacy</a></li>
            <li><a href="javascript:;">Terms</a></li>
            <li><a href="javascript:;">Complaints</a></li> -->
          </ul>
        </div>
      </div>
      <div class="col">
        <div class="footer-widget-9">
          <h5 class="mb-3 fw-bolds">Follow Us</h5>
          <div class="social-link d-flex align-items-center gap-2">
            @if(isset($settings['facebook_url']) && $settings['facebook_url'])
              <a href="{{ $settings['facebook_url'] }}" target="_blank"><i class="bi bi-facebook"></i></a>
            @endif
            @if(isset($settings['twitter_url']) && $settings['twitter_url'])
              <a href="{{ $settings['twitter_url'] }}" target="_blank"><i class="bi bi-twitter"></i></a>
            @endif
            @if(isset($settings['linkedin_url']) && $settings['linkedin_url'])
              <a href="{{ $settings['linkedin_url'] }}" target="_blank"><i class="bi bi-linkedin"></i></a>
            @endif
            @if(isset($settings['youtube_url']) && $settings['youtube_url'])
              <a href="{{ $settings['youtube_url'] }}" target="_blank"><i class="bi bi-youtube"></i></a>
            @endif
            @if(isset($settings['instagram_url']) && $settings['instagram_url'])
              <a href="{{ $settings['instagram_url'] }}" target="_blank"><i class="bi bi-instagram"></i></a>
            @endif
            @if(isset($settings['tiktok_url']) && $settings['tiktok_url'])
              <a href="{{ $settings['tiktok_url'] }}" target="_blank"><i class="bi bi-tiktok"></i></a>
            @endif
          </div>
          <div class="mb-3 mt-3">
            <h5 class="mb-0 fw-bolds">Support</h5>
            <p class="mb-0 text-muted">{{ $settings['contact_email'] ?? 'info@eminent.com' }}</p>
          </div>
          <div class="">
            <h5 class="mb-0 fw-bolds">24/7 Quick Support</h5>
            <p class="mb-0 text-muted">{{ $settings['contact_phone'] ?? '+256 774 959 446' }}</p>
          </div>
        </div>
      </div>
    </div><!--end row-->
    <div class="my-5"></div>
    <div class="row">
      <div class="col-12">
        <div class="text-center">
          <h5 class="fw-bolds mb-3">Download Mobile App</h5>
        </div>
        <div class="app-icon d-flex flex-column flex-sm-row align-items-center justify-content-center gap-2">
          <div>
            <a href="javascript:;">
              <img src="assets/images/play-store.webp" width="160" alt="">
            </a>
          </div>
          <div>
            <a href="javascript:;">
              <img src="assets/images/apple-store.webp" width="160" alt="">
            </a>
          </div>
        </div>
      </div>
    </div><!--end row-->

  </div>
</section>
<!--end footer-->

<footer class="footer-strip text-center py-3 bg-section-2 border-top positon-absolute bottom-0">
  <p class="mb-0 text-muted">Designed by <a href="souritetech.com">SOURITE Technologies</a> | All rights reserved.</p>
</footer>
