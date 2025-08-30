<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use App\Models\VehicleCategory;
use App\Models\VehicleBrand;
use App\Models\BlogPost;
use App\Models\Setting;

class HomeController extends Controller
{
    public function index()
    {
        // Get vehicles for different sections
        $newArrivals = Vehicle::with(['category', 'brand', 'images'])
            ->where('status', 'available')
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();

        $bestSellers = Vehicle::with(['category', 'brand', 'images'])
            ->where('status', 'available')
            ->where('is_featured', true)
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();

        $trendingVehicles = Vehicle::with(['category', 'brand', 'images'])
            ->where('status', 'available')
            ->where('is_featured', true)
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();

        $specialOffers = Vehicle::with(['category', 'brand', 'images'])
            ->where('status', 'available')
            ->whereNotNull('sale_price')
            ->where('sale_price', '>', 0)
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();

        $hotDeals = Vehicle::with(['category', 'brand', 'images'])
            ->where('status', 'available')
            ->where(function($query) {
                $query->where('is_featured', true)
                      ->orWhereNotNull('sale_price');
            })
            ->orderBy('created_at', 'desc')
            ->limit(8)
            ->get();

        $featuredVehicles = Vehicle::with(['category', 'brand', 'images'])
            ->where('status', 'available')
            ->where('is_featured', true)
            ->orderBy('created_at', 'desc')
            ->limit(4)
            ->get();

        // Get categories for search
        $categories = VehicleCategory::where('is_active', true)->get();
        
        // Get brands for search
        $brands = VehicleBrand::where('is_active', true)->get();

        // Get recent blog posts
        $recentPosts = BlogPost::with('author')
            ->where('status', 'published')
            ->whereNotNull('published_at')
            ->orderBy('published_at', 'desc')
            ->limit(3)
            ->get();

        // Get settings
        $settings = Setting::pluck('value', 'key')->toArray();

        return view('home', compact(
            'newArrivals',
            'bestSellers', 
            'trendingVehicles',
            'specialOffers',
            'hotDeals',
            'featuredVehicles',
            'categories',
            'brands',
            'recentPosts',
            'settings'
        ));
    }
}
