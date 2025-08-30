@extends('layouts.app')

@section('title', 'Product Details - Eminent Car Dealership')

@section('content')
@include('components.shared.breadcrumb-product-details')

<!--start product details-->
<section class="py-4">
    <div class="container">
        <div class="row g-4 eminent1">
            <div class="col-12 col-xl-7">
                <div class="product-images">
                    <div class="product-zoom-images">
                        <div class="row row-cols-1 g-3">
                            <div class="container mt-5">
                                @include('components.product.product-carousel')
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-xl-5">
                <div class="product-info">
                    @include('components.product.product-info')
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
                                @include('components.product.vehicle-description')
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-xl-5">
                <div class="product-info">
                    @include('components.product.contact-section')
                </div>
            </div>
        </div>
    </div>
</section>
<!--end product details-->
@endsection

@push('styles')
<link rel="stylesheet" href="{{ asset('assets/plugins/slick/slick.css') }}">
<link rel="stylesheet" href="{{ asset('assets/plugins/slick/slick-theme.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/dark-theme.css') }}">
@endpush

@push('scripts')
<script src="{{ asset('assets/js/jquery.min.js') }}"></script>
<script src="{{ asset('assets/js/pace.min.js') }}"></script>
<script src="{{ asset('assets/js/loader.js') }}"></script>
<script src="{{ asset('assets/js/main.js') }}"></script>
<script src="{{ asset('assets/js/shop-grid.js') }}"></script>
<script src="{{ asset('assets/js/index.js') }}"></script>
<script src="{{ asset('assets/plugins/slick/slick.min.js') }}"></script>
<script src="{{ asset('assets/plugins/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
@endpush
