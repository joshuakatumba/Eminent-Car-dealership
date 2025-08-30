<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\VehicleCategory;
use App\Models\VehicleBrand;
use App\Models\Setting;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Share categories and brands with header component
        View::composer('components.shared.header', function ($view) {
            $categories = VehicleCategory::where('is_active', true)->get();
            $brands = VehicleBrand::where('is_active', true)->get();
            
            $view->with(compact('categories', 'brands'));
        });
        
        // Share settings with footer component
        View::composer('components.shared.footer', function ($view) {
            $settings = Setting::pluck('value', 'key')->toArray();
            $categories = VehicleCategory::where('is_active', true)->get();
            $view->with(compact('settings', 'categories'));
        });
    }
}
