<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $customers = Customer::with('user')
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return view('admin.customers.index', compact('customers'));
    }

    public function create()
    {
        return view('admin.customers.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:50',
            'last_name' => 'required|string|max:50',
            'email' => 'required|email|unique:customers,email',
            'phone' => 'required|string|max:20',
            'city' => 'required|string|max:100',
            'state' => 'required|string|max:50',
            'zip_code' => 'required|string|max:20',
            'age' => 'nullable|integer|min:18|max:100',
            'status' => 'required|in:active,inactive',
            'district' => 'nullable|string|max:100',
            'driver_license_number' => 'nullable|string|max:50',
        ]);

        Customer::create($request->all());

        return redirect()->route('admin.customers.index')
            ->with('success', 'Customer created successfully!');
    }

    public function show(Customer $customer)
    {
        $customer->load(['user', 'salesLeads', 'sales', 'financingApplications']);
        
        return view('admin.customers.show', compact('customer'));
    }

    public function edit(Customer $customer)
    {
        return view('admin.customers.edit', compact('customer'));
    }

    public function update(Request $request, Customer $customer)
    {
        $request->validate([
            'first_name' => 'required|string|max:50',
            'last_name' => 'required|string|max:50',
            'email' => 'required|email|unique:customers,email,' . $customer->id,
            'phone' => 'required|string|max:20',
            'city' => 'required|string|max:100',
            'state' => 'required|string|max:50',
            'zip_code' => 'required|string|max:20',
            'age' => 'nullable|integer|min:18|max:100',
            'status' => 'required|in:active,inactive',
            'district' => 'nullable|string|max:100',
            'driver_license_number' => 'nullable|string|max:50',
        ]);

        $customer->update($request->all());

        return redirect()->route('admin.customers.index')
            ->with('success', 'Customer updated successfully!');
    }

    public function destroy(Customer $customer)
    {
        $customer->delete();

        return redirect()->route('admin.customers.index')
            ->with('success', 'Customer deleted successfully!');
    }
}
