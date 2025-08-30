<!--start about story-->
<div class="row g-4">
  <div class="col-12 col-xl-6">
    <h3 class="fw-bold">{{ $settings['about_title'] ?? 'Our Story' }}</h3>
    <p>{{ $settings['about_paragraph_1'] ?? 'Welcome to our premier car dealership, where we have been serving customers with excellence and integrity for many years. Our commitment to quality vehicles and exceptional service has made us a trusted name in the automotive industry.' }}</p>
    <p>{{ $settings['about_paragraph_2'] ?? 'We take pride in offering a carefully curated selection of vehicles from top brands, ensuring that every car in our inventory meets our high standards for quality and reliability. Our team of experienced professionals is dedicated to helping you find the perfect vehicle that fits your needs and budget.' }}</p>
    <p>{{ $settings['about_paragraph_3'] ?? 'At our dealership, we believe in building lasting relationships with our customers through transparent pricing, honest communication, and outstanding after-sales support. Your satisfaction is our top priority, and we strive to exceed your expectations at every step of your car-buying journey.' }}</p>
  </div>
  <div class="col-12 col-xl-6">
    <img src="{{ $settings['about_image'] ?? 'https://images.pexels.com/photos/7679877/pexels-photo-7679877.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1' }}" class="img-fluid" alt="About Us">     
  </div>
</div><!--end row-->
