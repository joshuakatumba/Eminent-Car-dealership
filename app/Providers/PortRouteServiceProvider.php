<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\VehicleController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\SalesController;
use App\Http\Controllers\Admin\FinanceController;
use App\Http\Controllers\Admin\ContentController;
use App\Http\Controllers\Admin\SupportController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ForgotPasswordController;

class PortRouteServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Always load both user and admin routes so admin is available under /admin on port 8000
        $this->mapUserRoutes();
        $this->mapAdminRoutes();
    }
    
    /**
     * Get the current port number.
     */
    protected function getPort(): int
    {
        // Try multiple methods to detect the port
        if (request()->getPort()) {
            return request()->getPort();
        }
        
        if (env('APP_PORT')) {
            return (int) env('APP_PORT');
        }
        
        if (isset($_SERVER['SERVER_PORT'])) {
            return (int) $_SERVER['SERVER_PORT'];
        }
        
        // Default to port 8000
        return 8000;
    }

    /**
     * Define the admin routes for the application.
     */
    protected function mapAdminRoutes(): void
    {
        Route::middleware('web')
            ->prefix('admin')
            ->as('admin.')
            ->group(base_path('routes/admin.php'));
    }

    /**
     * Define the user routes for the application.
     */
    protected function mapUserRoutes(): void
    {
        Route::middleware('web')
            ->group(base_path('routes/user.php'));
    }
}
