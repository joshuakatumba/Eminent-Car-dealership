@extends('layouts.app')

@section('title', $vehicle->brand->name . ' ' . $vehicle->model . ' - Eminent Car Dealership')

@push('styles')
    @include('components.shared.head')
@endpush

@section('content')
    @include('components.shared.header')
    {{-- @include('components.shared.breadcrumb-vehicle-details') --}}

    {{-- <!-- Logo Section -->
    <section class="py-3 bg-light">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-auto">
                    <div class="d-flex align-items-center">
                        <img src="{{ asset('assets/images/Eminent-LOGO-No-BG.png') }}" alt="Eminent Car Dealership" height="60" class="me-3">
                        <div>
                            <h4 class="mb-1 fw-bold text-primary">Eminent Car Dealership</h4>
                            <p class="mb-0 text-muted">Your trusted partner for quality vehicles</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}

    <!--start product details-->
    <section class="py-4">
        <div class="container">
            <div class="row g-4 eminent1">
                <div class="col-12 col-xl-7">
                    <div class="product-images">
                        <div class="product-zoom-images">
                            <div class="row row-cols-1 g-3">
                                <div class="container mt-5">
                                    @include('components.vehicle.vehicle-carousel')
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-xl-5">
                    <div class="product-info">
                        @include('components.vehicle.vehicle-info')
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-4">
        <div class="container">
            <div class="row g-4 eminent1">
                <div class="col-12 col-xl-7">
                    <div class="product-images">
                        <div class="product-zoom-images">
                            <div class="row row-cols-1 g-3">
                                <div class="container mt-5">
                                    @include('components.vehicle.vehicle-description')
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-xl-5">
                    <div class="product-info">
                        @include('components.vehicle.contact-section')
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--end product details-->

    @if(isset($relatedVehicles) && $relatedVehicles->count() > 0)
        @include('components.vehicle.related-vehicles')
    @endif
@endsection

@push('scripts')
<!-- Bootstrap JavaScript - Required for modals -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('assets/js/jquery.min.js') }}"></script>
<script src="{{ asset('assets/js/pace.min.js') }}"></script>
<script src="{{ asset('assets/js/loader.js') }}"></script>
<script src="{{ asset('assets/js/main.js') }}"></script>
<script src="{{ asset('assets/js/shop-grid.js') }}"></script>
<script src="{{ asset('assets/js/index.js') }}"></script>
<script src="{{ asset('assets/plugins/slick/slick.min.js') }}"></script>
<script src="{{ asset('assets/plugins/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
@endpush
