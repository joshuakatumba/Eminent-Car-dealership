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
        @include('components.shared.breadcrumb-billing-details')
        
        <!--start address selection details-->
        <section class="section-padding">
            <div class="container">
                <div class="d-flex align-items-center px-3 py-2 border mb-4">
                    <div class="text-start">
                        <h4 class="mb-0 h4 fw-bold">Select Delivery Address</h4>
                    </div>
                </div>
                <div class="row g-4">
                    <div class="col-12 col-lg-8 col-xl-8">
                        @include('components.checkout.address-selection')
                    </div>
                    <div class="col-12 col-lg-4 col-xl-4">
                        @include('components.checkout.order-summary')
                    </div>
                </div><!--end row-->
            </div>
        </section>
        <!--end address selection details-->
        
        @include('components.checkout.add-new-address-modal')
        @include('components.checkout.edit-address-modal')
    </div>
    <!--end page content-->

    @include('components.shared.footer')
    @include('components.shared.cart-sidebar')
    @include('components.shared.back-to-top')
    @include('components.shared.scripts')
</body>

</html>
