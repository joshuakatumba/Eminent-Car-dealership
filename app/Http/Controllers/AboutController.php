<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Models\VehicleBrand;
use App\Models\Testimonial;

class AboutController extends Controller
{
    public function index()
    {
        // Get about page content from settings
        $settings = Setting::pluck('value', 'key')->toArray();
        
        // Get active brands for the brands section
        $brands = VehicleBrand::where('is_active', true)
            ->orderBy('name')
            ->get();
        
        // Get testimonials for social proof
        $testimonials = Testimonial::where('is_approved', true)
            ->orderBy('created_at', 'desc')
            ->limit(6)
            ->get();

        return view('about', compact('settings', 'brands', 'testimonials'));
    }
}
