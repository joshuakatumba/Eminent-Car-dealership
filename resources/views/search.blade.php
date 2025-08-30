<!DOCTYPE html>
<html lang="en"> 

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!--favicon-->
	<link rel="icon" href="assets/images/favicon-32x32.webp" type="image/webp" />

  <!-- CSS files -->
  <link href="assets/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@500;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
  <!-- Plugins -->
  <link rel="stylesheet" type="text/css" href="assets/plugins/slick/slick.css" />
  <link rel="stylesheet" type="text/css" href="assets/plugins/slick/slick-theme.css" />

  <link href="assets/css/style.css" rel="stylesheet">
  <link href="assets/css/dark-theme.css" rel="stylesheet">

  <title>Shopingo - eCommerce HTML Template</title>
</head>

<body class="bg-section-1">

  <!--page loader-->
  <div class="loader-wrapper">
   <div class="d-flex justify-content-center align-items-center position-absolute top-50 start-50 translate-middle">
     <div class="spinner-border text-dark" role="status">
       <span class="visually-hidden">Loading...</span>
     </div>
   </div>
 </div>
<!--end loader-->

<!-- start page content-->

<section class="section-padding bg-section-2">
  <div class="container">
           @include('components.search.search-header')
  </div>
</section>

     @include('components.search.search-categories')
     @include('components.search.trending-searches')

<!--end page content -->

  <!-- JavaScript files -->
  <script src="assets/js/bootstrap.bundle.min.js"></script>
  <script src="assets/js/jquery.min.js"></script>
  <script src="assets/plugins/slick/slick.min.js"></script>
  <script src="assets/js/main.js"></script>
  <script src="assets/js/loader.js"></script>

</body>
</html>
