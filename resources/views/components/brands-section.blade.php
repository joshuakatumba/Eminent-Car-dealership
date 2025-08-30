<!-- Brands Section -->
<section class="section-padding brands-section">
    <div class="container">
        <div class="text-center pb-3">
            <h3 class="mb-0 h3 fw-bold">Shop By Brands</h3>
            <p class="mb-0 text-capitalize">Select your favorite brands and purchase</p>
        </div>
        <div class="brands">
            <div class="row row-cols-2 row-cols-lg-5 g-4">
                <!-- Toyota -->
                <div class="col">
                    <div class="p-3 border rounded brand-box">
                        <div class="d-flex align-items-center">
                            <a href="{{ route('vehicles.index', ['brand' => 'Toyota']) }}">
                                <img src="{{ asset('assets/images/brands/01.webp') }}" class="img-fluid" alt="Toyota">
                            </a>
                        </div>
                    </div>
                </div>
                
                <!-- Subaru -->
                <div class="col">
                    <div class="p-3 border rounded brand-box">
                        <div class="d-flex align-items-center">
                            <a href="{{ route('vehicles.index', ['brand' => 'subaru']) }}">
                                <img src="{{ asset('assets/images/brands/02.webp') }}" class="img-fluid" alt="Subaru">
                            </a>
                        </div>
                    </div>
                </div>
                
                <!-- Honda -->
                <div class="col">
                    <div class="p-3 border rounded brand-box">
                        <div class="d-flex align-items-center">
                            <a href="{{ route('vehicles.index', ['brand' => 'Honda']) }}">
                                <img src="{{ asset('assets/images/brands/04.webp') }}" class="img-fluid" alt="Honda">
                            </a>
                        </div>
                    </div>
                </div>
                
                <!-- Mercedes-Benz -->
                <div class="col">
                    <div class="p-3 border rounded brand-box">
                        <div class="d-flex align-items-center">
                            <a href="{{ route('vehicles.index', ['brand' => 'mercedes']) }}">
                                <img src="{{ asset('assets/images/brands/10.webp') }}" class="img-fluid" alt="Mercedes-Benz">
                            </a>
                        </div>
                    </div>
                </div>
                
                <!-- Ford -->
                <div class="col">
                    <div class="p-3 border rounded brand-box">
                        <div class="d-flex align-items-center">
                            <a href="{{ route('vehicles.index', ['brand' => 'Ford']) }}">
                                <img src="{{ asset('assets/images/brands/07.webp') }}" class="img-fluid" alt="Ford">
                            </a>
                        </div>
                    </div>
                </div>
                
                <!-- Hyundai -->
                <div class="col">
                    <div class="p-3 border rounded brand-box">
                        <div class="d-flex align-items-center">
                            <a href="{{ route('vehicles.index', ['brand' => 'hyundai']) }}">
                                <img src="{{ asset('assets/images/brands/13.webp') }}" class="img-fluid" alt="Hyundai">
                            </a>
                        </div>
                    </div>
                </div>
                
                <!-- Lexus -->
                <div class="col">
                    <div class="p-3 border rounded brand-box">
                        <div class="d-flex align-items-center">
                            <a href="{{ route('vehicles.index', ['brand' => 'lexus']) }}">
                                <img src="{{ asset('assets/images/brands/12.webp') }}" class="img-fluid" alt="Lexus">
                            </a>
                        </div>
                    </div>
                </div>
                
                <!-- Mazda -->
                <div class="col">
                    <div class="p-3 border rounded brand-box">
                        <div class="d-flex align-items-center">
                            <a href="{{ route('vehicles.index', ['brand' => 'mazda']) }}">
                                <img src="{{ asset('assets/images/brands/05.webp') }}" class="img-fluid" alt="Mazda">
                            </a>
                        </div>
                    </div>
                </div>
                
                <!-- Mitsubishi -->
                <div class="col">
                    <div class="p-3 border rounded brand-box">
                        <div class="d-flex align-items-center">
                            <a href="{{ route('vehicles.index', ['brand' => 'mitsubishi']) }}">
                                <img src="{{ asset('assets/images/brands/06.webp') }}" class="img-fluid" alt="Mitsubishi">
                            </a>
                        </div>
                    </div>
                </div>
                
                <!-- Nissan -->
                <div class="col">
                    <div class="p-3 border rounded brand-box">
                        <div class="d-flex align-items-center">
                            <a href="{{ route('vehicles.index', ['brand' => 'nissan']) }}">
                                <img src="{{ asset('assets/images/brands/03.webp') }}" class="img-fluid" alt="Nissan">
                            </a>
                        </div>
                    </div>
                </div>
                


            </div>
            <!--end row-->
        </div>
    </div>
</section>
