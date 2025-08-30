<!--start breadcrumb-->
<div class="py-4 border-bottom">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('vehicles.index') }}">Vehicles</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $vehicle->brand->name }} {{ $vehicle->model }}</li>
            </ol>
        </nav>
    </div>
</div>
<!--end breadcrumb-->
