<!DOCTYPE html>
<html lang="en" class="light-theme">

<head>
    @include('components.shared.head')
    <title>Vehicles - Car Dealership</title>
    <style>
        /* Filter Card Styling */
        .filter-card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            height: fit-content;
            max-height: 600px;
            overflow-y: auto;
        }

        .filter-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 35px rgba(0, 0, 0, 0.15);
        }

        .filter-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-radius: 15px 15px 0 0 !important;
            border: none;
            padding: 1.5rem;
        }

        .filter-header h5 {
            margin: 0;
            font-weight: 600;
            font-size: 1.1rem;
        }

        .filter-label {
            color: #495057;
            font-weight: 600;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 0.5rem;
        }

        .filter-label i {
            color: #667eea;
        }

        /* Search Input Styling */
        .search-input {
            border: 2px solid #e9ecef;
            border-radius: 10px;
            padding: 0.75rem 1rem;
            transition: all 0.3s ease;
            background: linear-gradient(145deg, #f8f9fa, #ffffff);
        }

        .search-input:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
            background: white;
        }

        /* Filter Select Styling */
        .filter-select {
            border: 2px solid #e9ecef;
            border-radius: 10px;
            padding: 0.75rem 1rem;
            transition: all 0.3s ease;
            background: linear-gradient(145deg, #f8f9fa, #ffffff);
            cursor: pointer;
        }

        .filter-select:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
            background: white;
        }

        .filter-select option {
            padding: 0.5rem;
        }

        /* Price Input Styling */
        .price-input {
            border: 2px solid #e9ecef;
            border-radius: 10px;
            padding: 0.75rem 0.5rem;
            transition: all 0.3s ease;
            background: linear-gradient(145deg, #f8f9fa, #ffffff);
            text-align: center;
        }

        .price-input:focus {
            border-color: #28a745;
            box-shadow: 0 0 0 0.2rem rgba(40, 167, 69, 0.25);
            background: white;
        }

        /* Gradient Button */
        .btn-gradient {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            border-radius: 10px;
            padding: 0.75rem 1.5rem;
            color: white;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
        }

        .btn-gradient:hover {
            background: linear-gradient(135deg, #5a6fd8 0%, #6a4190 100%);
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(102, 126, 234, 0.4);
            color: white;
        }

        .btn-gradient:active {
            transform: translateY(0);
        }

        /* Clear Filters Button */
        .btn-clear-filters {
            background: linear-gradient(135deg, #ff6b6b 0%, #ee5a24 100%);
            border: none;
            border-radius: 10px;
            padding: 0.5rem 1rem;
            color: white;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(255, 107, 107, 0.3);
        }

        .btn-clear-filters:hover {
            background: linear-gradient(135deg, #ff5252 0%, #e74c3c 100%);
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(255, 107, 107, 0.4);
            color: white;
            text-decoration: none;
        }

        /* Vehicle Count Styling */
        .d-flex.justify-content-between.align-items-center h4 {
            color: #495057;
            font-weight: 700;
        }

        .d-flex.justify-content-between.align-items-center h4 i {
            color: #667eea;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .filter-card {
                margin-bottom: 2rem;
            }
            
            .filter-header {
                padding: 1rem;
            }
            
            .filter-header h5 {
                font-size: 1rem;
            }
        }

        /* Animation for filter elements */
        .filter-card .card-body > div {
            animation: fadeInUp 0.6s ease forwards;
            opacity: 0;
            transform: translateY(20px);
        }

        .filter-card .card-body > div:nth-child(1) { animation-delay: 0.1s; }
        .filter-card .card-body > div:nth-child(2) { animation-delay: 0.2s; }
        .filter-card .card-body > div:nth-child(3) { animation-delay: 0.3s; }
        .filter-card .card-body > div:nth-child(4) { animation-delay: 0.4s; }
        .filter-card .card-body > div:nth-child(5) { animation-delay: 0.5s; }
        .filter-card .card-body > div:nth-child(6) { animation-delay: 0.6s; }

        @keyframes fadeInUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>

<body>
    @include('components.shared.page-loader')
    @include('components.shared.header')
    
    <!--start page content-->
    <div class="page-content">
        @include('components.shared.breadcrumb')
        
        <!-- Vehicle Listing Section -->
        <section class="section-padding">
            <div class="container">
                <div class="row">
                    <!-- Filters Sidebar -->
                    <div class="col-lg-3">
                        <div class="card filter-card">
                            <div class="card-header filter-header">
                                <h5 class="mb-0"><i class="fas fa-filter me-2"></i>Search Filters</h5>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('vehicles.search') }}" method="GET">
                                    <!-- Search -->
                                    <div class="mb-4">
                                        <label class="form-label filter-label">
                                            <i class="fas fa-search me-2"></i>Search Vehicles
                                        </label>
                                        <input type="text" name="search" class="form-control search-input" value="{{ request('search') }}" placeholder="Search vehicles...">
                                    </div>

                                    <!-- Category Filter -->
                                    <div class="mb-4">
                                        <label class="form-label filter-label">
                                            <i class="fas fa-car me-2"></i>Category
                                        </label>
                                        <select name="category" class="form-select filter-select">
                                            <option value="">All Categories</option>
                                            @foreach($categories as $category)
                                                <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                                    {{ $category->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <!-- Brand Filter -->
                                    <div class="mb-4">
                                        <label class="form-label filter-label">
                                            <i class="fas fa-tag me-2"></i>Brand
                                        </label>
                                        <select name="brand" class="form-select filter-select">
                                            <option value="">All Brands</option>
                                            @foreach($brands as $brand)
                                                <option value="{{ $brand->id }}" {{ request('brand') == $brand->id ? 'selected' : '' }}>
                                                    {{ $brand->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <!-- Price Range -->
                                    <div class="mb-4">
                                        <label class="form-label filter-label">
                                            <i class="fas fa-dollar-sign me-2"></i>Price Range
                                        </label>
                                        <div class="row">
                                            <div class="col-6">
                                                <input type="number" name="min_price" class="form-control price-input" value="{{ request('min_price') }}" placeholder="Min">
                                            </div>
                                            <div class="col-6">
                                                <input type="number" name="max_price" class="form-control price-input" value="{{ request('max_price') }}" placeholder="Max">
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Year Filter -->
                                    <div class="mb-4">
                                        <label class="form-label filter-label">
                                            <i class="fas fa-calendar me-2"></i>Year
                                        </label>
                                        <select name="year" class="form-select filter-select">
                                            <option value="">All Years</option>
                                            @for($year = date('Y'); $year >= 2010; $year--)
                                                <option value="{{ $year }}" {{ request('year') == $year ? 'selected' : '' }}>
                                                    {{ $year }}
                                                </option>
                                            @endfor
                                        </select>
                                    </div>

                                    <!-- Color Filter -->
                                    <div class="mb-4">
                                        <label class="form-label filter-label">
                                            <i class="fas fa-palette me-2"></i>Color
                                        </label>
                                        <select name="color" class="form-select filter-select">
                                            <option value="">All Colors</option>
                                            @foreach($colors as $color)
                                                <option value="{{ $color }}" {{ request('color') == $color ? 'selected' : '' }}>
                                                    {{ $color }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <button type="submit" class="btn btn-gradient w-100">
                                        <i class="fas fa-search me-2"></i>Apply Filters
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Vehicle Grid -->
                    <div class="col-lg-9">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h4 class="mb-0"><i class="fas fa-car me-2"></i>Available Vehicles ({{ $vehicles->total() }})</h4>
                            <div class="d-flex gap-2">
                                <a href="{{ route('vehicles.index') }}" class="btn btn-clear-filters">
                                    <i class="fas fa-times me-2"></i>Clear Filters
                                </a>
                            </div>
                        </div>

                        @if($vehicles->count() > 0)
                            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                                @foreach($vehicles as $vehicle)
                                    <x-shared.vehicle-card :vehicle="$vehicle" />
                                @endforeach
                            </div>

                            <!-- Pagination -->
                            <div class="d-flex justify-content-center mt-4">
                                {{ $vehicles->appends(request()->query())->links() }}
                            </div>
                        @else
                            <div class="text-center py-5">
                                <h5 class="text-muted">No vehicles found matching your criteria.</h5>
                                <p class="text-muted">Try adjusting your filters or <a href="{{ route('vehicles.index') }}">view all vehicles</a>.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </section>
    </div>
    <!--end page content-->

    @include('components.shared.footer')
    @include('components.shared.cart-sidebar')
    @include('components.shared.back-to-top')
    @include('components.shared.scripts')
</body>

</html>

