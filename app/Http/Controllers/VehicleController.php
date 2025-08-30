<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use App\Models\VehicleCategory;
use App\Models\VehicleBrand;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    public function index(Request $request)
    {
        $query = Vehicle::with(['category', 'brand', 'images'])
            ->where('status', 'available');

        // Filter by category
        if ($request->has('category') && $request->category) {
            $query->whereHas('category', function($q) use ($request) {
                $q->where('name', 'like', '%' . $request->category . '%');
            });
        }

        // Filter by brand
        if ($request->has('brand') && $request->brand) {
            $query->whereHas('brand', function($q) use ($request) {
                $q->where('name', 'like', '%' . $request->brand . '%');
            });
        }

        // Filter by price range
        if ($request->has('min_price') && $request->min_price) {
            $query->where('price', '>=', $request->min_price);
        }
        if ($request->has('max_price') && $request->max_price) {
            $query->where('price', '<=', $request->max_price);
        }

        // Filter by year
        if ($request->has('year') && $request->year) {
            $query->where('year', $request->year);
        }

        // Filter by color
        if ($request->has('color') && $request->color) {
            $query->where('color', 'like', '%' . $request->color . '%');
        }

        // Search by model or description
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('model', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%")
                  ->orWhereHas('brand', function($brandQuery) use ($search) {
                      $brandQuery->where('name', 'like', "%{$search}%");
                  });
            });
        }

        $vehicles = $query->orderBy('created_at', 'desc')->paginate(12);
        $categories = VehicleCategory::where('is_active', true)->get();
        $brands = VehicleBrand::where('is_active', true)->get();
        
        // Get available colors from existing vehicles
        $colors = Vehicle::where('status', 'available')
            ->whereNotNull('color')
            ->where('color', '!=', '')
            ->distinct()
            ->pluck('color')
            ->sort()
            ->values();

        return view('vehicles.index', compact('vehicles', 'categories', 'brands', 'colors'));
    }

    public function show($id)
    {
        $vehicle = Vehicle::with(['category', 'brand', 'images', 'creator'])
            ->where('status', 'available')
            ->findOrFail($id);

        // Get related vehicles
        $relatedVehicles = Vehicle::with(['category', 'brand', 'images'])
            ->where('status', 'available')
            ->where('id', '!=', $vehicle->id)
            ->where(function($query) use ($vehicle) {
                $query->where('category_id', $vehicle->category_id)
                      ->orWhere('brand_id', $vehicle->brand_id);
            })
            ->limit(4)
            ->get();

        // Get settings
        $settings = \App\Models\Setting::pluck('value', 'key')->toArray();

        return view('vehicles.show', compact('vehicle', 'relatedVehicles', 'settings'));
    }

    public function search(Request $request)
    {
        return $this->index($request);
    }

    public function newArrivals()
    {
        $vehicles = Vehicle::with(['category', 'brand', 'images'])
            ->where('status', 'available')
            ->newArrivals()
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();

        return response()->json($vehicles);
    }

    public function bestSellers()
    {
        $vehicles = Vehicle::with(['category', 'brand', 'images'])
            ->where('status', 'available')
            ->bestSellers()
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();

        return response()->json($vehicles);
    }

    public function trending()
    {
        $vehicles = Vehicle::with(['category', 'brand', 'images'])
            ->where('status', 'available')
            ->trending()
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();

        return response()->json($vehicles);
    }

    public function specialOffers()
    {
        $vehicles = Vehicle::with(['category', 'brand', 'images'])
            ->where('status', 'available')
            ->specialOffers()
            ->withActiveDiscounts()
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();

        return response()->json($vehicles);
    }

    public function hotDeals()
    {
        $vehicles = Vehicle::with(['category', 'brand', 'images'])
            ->where('status', 'available')
            ->where(function($query) {
                $query->where('is_featured', true)
                      ->orWhere('is_special_offer', true)
                      ->orWhere('discount_percentage', '>', 0);
            })
            ->orderBy('created_at', 'desc')
            ->limit(8)
            ->get();

        return response()->json($vehicles);
    }

    public function quickView($id)
    {
        $vehicle = Vehicle::with(['category', 'brand', 'images'])
            ->where('status', 'available')
            ->findOrFail($id);

        // Transform the data for the frontend
        $vehicleData = [
            'id' => $vehicle->id,
            'brand' => $vehicle->brand,
            'model' => $vehicle->model,
            'description' => $vehicle->description,
            'price' => $vehicle->price,
            'sale_price' => $vehicle->sale_price,
            'year' => $vehicle->year,
            'mileage' => $vehicle->mileage,
            'fuel_type' => $vehicle->fuel_type,
            'transmission' => $vehicle->transmission,
            'engine' => $vehicle->engine,
            'status' => $vehicle->status,
            'images' => $vehicle->images->map(function($image) {
                return [
                    'id' => $image->id,
                    'image_path' => asset('storage/' . $image->image_path),
                    'is_primary' => $image->is_primary
                ];
            })
        ];

        return response()->json($vehicleData);
    }
}
