<!-- Special Product Section -->
<section class="section-padding bg-section-2 special-product-section">
    <div class="container">
        <div class="card border-0 rounded-0 p-3 depth">
            <div class="row align-items-center justify-content-center">
                <div class="col-lg-6 text-center">
                    <img src="{{ asset('assets/images/extra-images/promo-large-high-res.jpg') }}" class="img-fluid rounded-0" alt="Special Product Promotion">
                </div>
                <div class="col-lg-6">
                    <div class="card-body">
                        <h3 class="fw-bold">New Features of Trending Products</h3>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item bg-transparent px-0 item-description">
                                <i class="fas fa-shield-alt text-primary me-2"></i>
                                Smart sensors automatically brake, steer, and prevent collisions safely.
                            </li>
                            <li class="list-group-item bg-transparent px-0 item-description">
                                <i class="fas fa-leaf text-success me-2"></i>
                                Zero emissions electric motor delivers instant torque and efficiency.
                            </li>
                            <li class="list-group-item bg-transparent px-0 item-description">
                                <i class="fas fa-mobile-alt text-info me-2"></i>
                                Seamless smartphone integration with wireless charging and voice commands.
                            </li>
                            <li class="list-group-item bg-transparent px-0 item-description">
                                <i class="fas fa-lightbulb text-warning me-2"></i>
                                Intelligent headlights automatically adjust brightness and direction for visibility.
                            </li>
                        </ul>
                        <div class="buttons mt-4 d-flex flex-column flex-lg-row gap-3">
                            <a href="{{ route('vehicles.index') }}" class="btn btn-lg btn-dark btn-ecomm px-5 py-3">
                                <i class="fas fa-shopping-cart me-2"></i>Buy Now
                            </a>
                            <a href="{{ route('vehicles.index') }}" class="btn btn-lg btn-outline-dark btn-ecomm px-5 py-3">
                                <i class="fas fa-eye me-2"></i>View Details
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
