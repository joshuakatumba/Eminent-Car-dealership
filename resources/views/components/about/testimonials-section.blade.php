<!--start testimonials section-->
@if($testimonials->count() > 0)
<div class="separator section-padding">
  <div class="line"></div>
  <h3 class="mb-0 h3 fw-bold">What Our Customers Say</h3>
  <div class="line"></div>
</div>

<div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
  @foreach($testimonials as $testimonial)
    <div class="col">
      <div class="card h-100">
        <div class="card-body text-center">
          <div class="mb-3">
            @for($i = 1; $i <= 5; $i++)
              <i class="bi bi-star-fill text-warning"></i>
            @endfor
          </div>
          <p class="mb-3">{{ $testimonial->content }}</p>
          <div class="d-flex align-items-center justify-content-center">
            <div class="avatar me-3">
              <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                <span class="text-white fw-bold">{{ strtoupper(substr($testimonial->customer_name, 0, 1)) }}</span>
              </div>
            </div>
                          <div class="text-start">
                <h6 class="mb-0 fw-bold">{{ $testimonial->customer_name }}</h6>
                <small class="text-muted">Satisfied Customer</small>
              </div>
          </div>
        </div>
      </div>
    </div>
  @endforeach
</div>
@endif
<!--end testimonials section-->
