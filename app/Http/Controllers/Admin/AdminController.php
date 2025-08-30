<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Vehicle;
use App\Models\Sale;
use App\Models\SalesLead;
use App\Models\Customer;
use App\Models\BlogPost;
use App\Models\Testimonial;
use App\Models\Activity;
use App\Services\ActivityService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{

    public function dashboard()
    {
        // Get comprehensive statistics
        $totalVehicles = Vehicle::count();
        $totalSales = Sale::count();
        $totalRevenue = Sale::sum('sale_price');
        $pendingLeads = SalesLead::where('status', 'new')->count();
        $totalCustomers = Customer::count();
        $totalBlogPosts = BlogPost::count();
        $totalTestimonials = Testimonial::count();
        
        // Get recent sales with revenue
        $recentSales = Sale::with(['customer', 'vehicle.brand'])
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();
            
        // Get recent leads
        $recentLeads = SalesLead::with('customer')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();
            
        // Get recent customers
        $recentCustomers = Customer::orderBy('created_at', 'desc')
            ->limit(5)
            ->get();
            
        // Get monthly sales data for chart
        $monthlySales = Sale::selectRaw('strftime("%m", sale_date) as month, COUNT(*) as count, SUM(sale_price) as revenue')
            ->whereRaw('strftime("%Y", sale_date) = ?', [date('Y')])
            ->groupBy('month')
            ->orderBy('month')
            ->get();
            
        // Get vehicle status data for chart
        $vehicleStatus = Vehicle::selectRaw('status, COUNT(*) as count')
            ->groupBy('status')
            ->get();

        // Get top performing vehicles
        $topVehicles = Vehicle::withCount('sales')
            ->orderBy('sales_count', 'desc')
            ->limit(5)
            ->get();



        return view('admin.dashboard', compact(
            'totalVehicles',
            'totalSales', 
            'totalRevenue',
            'pendingLeads',
            'totalCustomers',
            'totalBlogPosts',
            'totalTestimonials',
            'recentSales',
            'recentLeads',
            'recentCustomers',
            'monthlySales',
            'vehicleStatus',
            'topVehicles'
        ));
    }

    public function profile()
    {
        $user = auth()->user();
        return view('admin.profile', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $user = auth()->user();
        
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
        ]);

        $user->update($request->only(['name', 'email', 'phone', 'address']));

        // Log the profile update
        ActivityService::log('profile_update', "Updated profile information");

        return redirect()->back()->with('success', 'Profile updated successfully!');
    }

    public function settings()
    {
        $settings = \App\Models\Setting::pluck('value', 'key')->toArray();
        return view('admin.settings', compact('settings'));
    }

    public function updateSettings(Request $request)
    {
        $settings = $request->except('_token', '_method');
        
        foreach ($settings as $key => $value) {
            // Convert null values to empty strings to satisfy NOT NULL constraint
            $value = $value ?? '';
            
            \App\Models\Setting::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
        }

        // Log the settings update
        ActivityService::logSettingsUpdate("Updated application settings");

        return redirect()->back()->with('success', 'Settings updated successfully!');
    }

    public function systemInfo()
    {
        $systemInfo = [
            'php_version' => PHP_VERSION,
            'laravel_version' => app()->version(),
            'database' => config('database.default'),
            'app_environment' => config('app.env'),
            'app_debug' => config('app.debug'),
            'timezone' => config('app.timezone'),
            'cache_driver' => config('cache.default'),
            'session_driver' => config('session.driver'),
            'queue_driver' => config('queue.default'),
        ];

        return view('admin.system-info', compact('systemInfo'));
    }

    public function activityLog()
    {
        $activities = Activity::with('user')
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('admin.activity-log', compact('activities'));
    }
}
