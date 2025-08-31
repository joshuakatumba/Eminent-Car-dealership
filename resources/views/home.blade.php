<!DOCTYPE html>
<html lang="en" class="light-theme">

<head>
    @include('components.shared.head')
</head>

<body>
    @include('components.shared.page-loader')
    @include('components.shared.header')
    
    <!--start page content-->
    <div class="page-content">
        <!-- Hero Carousel - First and foremost -->
        @include('components.home.hero-carousel')
        
        @include('components.shared.breadcrumb')
        
        <!-- Hot Deals Section -->
        @include('components.home.hot-deals')
    
        
        <!-- Features Section -->
        @include('components.home.features')
        
        <!-- Quick View Section -->
        @include('components.home.quick-view-section')
        
        <!-- Tabular Products Section -->
        @if($newArrivals->count() > 0 || $bestSellers->count() > 0 || $trendingVehicles->count() > 0 || $specialOffers->count() > 0)
            @include('components.home.tabular-products')
        @endif
        
        <!-- Special Product Section -->
        @include('components.special-product-section')
        
        <!-- Brands Section -->
        @include('components.brands-section')
        
        <!-- Blog Section -->
        @include('components.blog-section')
        
        <!-- Category Slider Section -->
        @include('components.category-slider')
    </div>
    <!--end page content-->

    @include('components.shared.footer')
    @include('components.shared.cart-sidebar')
    @include('components.shared.quick-view-modal')
    @include('components.shared.back-to-top')
    @include('components.shared.scripts')
</body>

</html>