<!--start top header-->
<header class="top-header">
  <nav class="navbar navbar-expand-xl w-100 navbar-dark container gap-3">
    <a class="navbar-brand d-none d-xl-inline" href="/"><img src="{{ asset('assets/images/Eminent-LOGO-No-BG.png') }}"
        class="logo-img" alt="Eminent Car Dealership"></a>
    <a class="mobile-menu-btn d-inline d-xl-none" href="javascript:;" data-bs-toggle="offcanvas"
      data-bs-target="#offcanvasNavbar">
      <i class="bi bi-list"></i>
    </a>
    <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasNavbar">
      <div class="offcanvas-header">
        <div class="offcanvas-logo"><img src="{{ asset('assets/images/Eminent-LOGO-White-BG.png') }}" class="logo-img" alt="Eminent Car Dealership">
        </div>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
      <div class="offcanvas-body primary-menu">
        <ul class="navbar-nav justify-content-start flex-grow-1 gap-1">
          <li class="nav-item">
            <a class="nav-link" href="/">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('vehicles.index') }}">Vehicles</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/about">About</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" href="{{ route('vehicles.index') }}"
              data-bs-toggle="dropdown">
              Categories
            </a>
            <div class="dropdown-menu dropdown-large-menu">
              <div class="row">
                @if($categories->count() > 0)
                  <div class="col-12 col-xl-4">
                    <h6 class="large-menu-title">Vehicle Categories</h6>
                    <ul class="list-unstyled">
                      @foreach($categories->take(8) as $category)
                        <li><a href="{{ route('vehicles.search', ['category' => $category->id]) }}">{{ $category->name }}</a></li>
                      @endforeach
                    </ul>
                  </div>
                @endif
                @if($brands->count() > 0)
                  <div class="col-12 col-xl-4">
                    <h6 class="large-menu-title">Popular Brands</h6>
                    <ul class="list-unstyled">
                      @foreach($brands->take(8) as $brand)
                        <li><a href="{{ route('vehicles.search', ['brand' => $brand->id]) }}">{{ $brand->name }}</a></li>
                      @endforeach
                    </ul>
                  </div>
                @endif
                <div class="col-12 col-xl-4 d-none d-xl-block">
                  <div class="pramotion-banner1">
                    <img src="assets/images/menu-img.webp" class="img-fluid" alt="" />
                  </div>
                </div>
              </div>
            </div>
          </li>          
          <li class="nav-item">
            <a class="nav-link" href="{{ route('contact') }}">Contact</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/blog-post">Blogs</a>
          </li>
        </ul>
      </div>
    </div>
    <ul class="navbar-nav secondary-menu flex-row">
      <li class="nav-item">
        <a class="nav-link dark-mode-icon" href="javascript:;">
          <div class="mode-icon">
            <i class="bi bi-moon"></i>
          </div>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/search"><i class="bi bi-search"></i></a>
    </ul>
  </nav>
</header>
<!--end top header-->
