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
        @include('components.shared.breadcrumb')
        
        <!--start about details-->
        <section class="section-padding">
            <div class="container">
                <div class="row g-4">
                    <div class="col-12">
                        @include('components.about.about-story', ['settings' => $settings])
                        @include('components.about.why-choose-us', ['settings' => $settings])
                    </div>
                </div><!--end row-->
                
                <!-- Shop by Brands Section -->
                @include('components.brands-section')
            </div>
        </section>
        <!--end about details-->
    </div>
    <!--end page content-->

    @include('components.shared.footer')
    @include('components.shared.cart-sidebar')
    @include('components.shared.back-to-top')
    @include('components.shared.scripts')
</body>

</html>
