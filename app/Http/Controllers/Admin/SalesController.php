<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Sale;
use App\Models\Customer;
use App\Models\Vehicle;
use App\Models\User;
use App\Services\ActivityService;
use Illuminate\Http\Request;

class SalesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $sales = Sale::with(['customer', 'vehicle', 'salesperson'])
            ->orderBy('sale_date', 'desc')
            ->paginate(15);

        return view('admin.sales.index', compact('sales'));
    }

    public function create()
    {
        $customers = Customer::all();
        $vehicles = Vehicle::where('status', 'available')->get();
        $salespeople = User::whereHas('role', function($query) {
            $query->whereIn('name', ['super_admin', 'sales_manager']);
        })->get();

        return view('admin.sales.create', compact('customers', 'vehicles', 'salespeople'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'vehicle_id' => 'required|exists:vehicles,id',
            'salesperson_id' => 'required|exists:users,id',
            'sale_date' => 'required|date',
            'sale_price' => 'required|numeric|min:0',
            'down_payment' => 'nullable|numeric|min:0',
            'financing_amount' => 'nullable|numeric|min:0',
            'trade_in_value' => 'nullable|numeric|min:0',
            'tax_amount' => 'nullable|numeric|min:0',
            'total_amount' => 'required|numeric|min:0',
            'payment_method' => 'required|in:cash,financing,lease',
            'status' => 'required|in:completed,pending,cancelled',
            'notes' => 'nullable|string',
        ]);

        $sale = Sale::create($request->all());

        // Update vehicle status to sold
        $sale->vehicle->update(['status' => 'sold']);

        // Log the sale creation
        ActivityService::logCreate($sale, "Recorded new sale: UGX " . number_format($sale->total_amount, 0) . " for {$sale->vehicle->brand->name} {$sale->vehicle->model}");

        return redirect()->route('admin.sales.index')
            ->with('success', 'Sale recorded successfully!');
    }

    public function show(Sale $sale)
    {
        $sale->load(['customer', 'vehicle', 'salesperson']);
        
        return view('admin.sales.show', compact('sale'));
    }

    public function edit(Sale $sale)
    {
        $customers = Customer::all();
        $vehicles = Vehicle::all();
        $salespeople = User::whereHas('role', function($query) {
            $query->whereIn('name', ['super_admin', 'sales_manager']);
        })->get();

        return view('admin.sales.edit', compact('sale', 'customers', 'vehicles', 'salespeople'));
    }

    public function update(Request $request, Sale $sale)
    {
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'vehicle_id' => 'required|exists:vehicles,id',
            'salesperson_id' => 'required|exists:users,id',
            'sale_date' => 'required|date',
            'sale_price' => 'required|numeric|min:0',
            'down_payment' => 'nullable|numeric|min:0',
            'financing_amount' => 'nullable|numeric|min:0',
            'trade_in_value' => 'nullable|numeric|min:0',
            'tax_amount' => 'nullable|numeric|min:0',
            'total_amount' => 'required|numeric|min:0',
            'payment_method' => 'required|in:cash,financing,lease',
            'status' => 'required|in:completed,pending,cancelled',
            'notes' => 'nullable|string',
        ]);

        $sale->update($request->all());

        // Log the sale update
        ActivityService::logUpdate($sale, "Updated sale: UGX " . number_format($sale->total_amount, 0) . " for {$sale->vehicle->brand->name} {$sale->vehicle->model}");

        return redirect()->route('admin.sales.index')
            ->with('success', 'Sale updated successfully!');
    }

    public function destroy(Sale $sale)
    {
        // Log the sale deletion before deleting
        ActivityService::logDelete($sale, "Deleted sale: UGX " . number_format($sale->total_amount, 0) . " for {$sale->vehicle->brand->name} {$sale->vehicle->model}");

        // Update vehicle status back to available if sale is cancelled
        if ($sale->status === 'cancelled') {
            $sale->vehicle->update(['status' => 'available']);
        }

        $sale->delete();

        return redirect()->route('admin.sales.index')
            ->with('success', 'Sale deleted successfully!');
    }
}
