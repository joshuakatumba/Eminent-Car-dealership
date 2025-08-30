<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->check()) {
            return redirect()->route('admin.login');
        }

        $user = auth()->user();
        
        // Check if user has admin role
        if (!$user->role || !in_array($user->role->name, ['super_admin', 'sales_manager', 'inventory_manager', 'finance_manager', 'customer_service_manager', 'marketing_manager'])) {
            abort(403, 'Access denied. Admin privileges required.');
        }

        return $next($request);
    }
}
