<!DOCTYPE html>
<html lang="en" class="light-theme">

<head>
    @include('components.shared.head')
</head>

<body class="blog-read">
    @include('components.shared.page-loader')
    @include('components.shared.header')
    
    <!--start page content-->
    <div class="page-content">
        @include('components.shared.breadcrumb-blog-read')
        
        <!--start blog read details-->
        <section class="section-padding">
            <div class="container">
                <div class="row g-4">
                    <div class="col-12 col-xl-8">
                        @include('components.blog.blog-single-post')
                    </div>
                    <div class="col-12 col-xl-4">
                        @include('components.blog.blog-sidebar')
                    </div>
                </div><!--end row-->
            </div>
        </section>
        <!--end blog read details-->
    </div>
    <!--end page content-->

    @include('components.shared.footer')
    @include('components.shared.cart-sidebar')
    @include('components.shared.back-to-top')
    @include('components.shared.scripts')
</body>

</html>
