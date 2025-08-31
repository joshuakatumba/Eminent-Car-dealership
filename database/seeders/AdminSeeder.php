<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\Permission;
use App\Models\User;
use App\Models\VehicleCategory;
use App\Models\VehicleBrand;
use App\Models\Setting;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create Roles
        $roles = [
            ['name' => 'super_admin', 'description' => 'Full system access'],
            ['name' => 'sales_manager', 'description' => 'Manage sales and leads'],
            ['name' => 'inventory_manager', 'description' => 'Manage vehicle inventory'],
            ['name' => 'finance_manager', 'description' => 'Manage financing applications'],
            ['name' => 'customer_service_manager', 'description' => 'Manage customer support'],
            ['name' => 'marketing_manager', 'description' => 'Manage content and marketing'],
        ];

        foreach ($roles as $role) {
            Role::create($role);
        }

        // Create Permissions
        $permissions = [
            ['name' => 'Manage Users', 'slug' => 'manage_users', 'description' => 'Can manage all users'],
            ['name' => 'Manage Vehicles', 'slug' => 'manage_vehicles', 'description' => 'Can manage vehicle inventory'],
            ['name' => 'Manage Sales', 'slug' => 'manage_sales', 'description' => 'Can manage sales transactions'],
            ['name' => 'Manage Finance', 'slug' => 'manage_finance', 'description' => 'Can manage financing applications'],
            ['name' => 'Manage Content', 'slug' => 'manage_content', 'description' => 'Can manage blog posts and content'],
            ['name' => 'Manage Support', 'slug' => 'manage_support', 'description' => 'Can manage support tickets'],
            ['name' => 'View Reports', 'slug' => 'view_reports', 'description' => 'Can view system reports'],
            ['name' => 'Manage Settings', 'slug' => 'manage_settings', 'description' => 'Can manage system settings'],
        ];

        foreach ($permissions as $permission) {
            Permission::create($permission);
        }

        // Assign permissions to roles
        $superAdmin = Role::where('name', 'super_admin')->first();
        $superAdmin->permissions()->attach(Permission::all());

        $salesManager = Role::where('name', 'sales_manager')->first();
        $salesManager->permissions()->attach(
            Permission::whereIn('slug', ['manage_sales', 'view_reports'])->get()
        );

        $inventoryManager = Role::where('name', 'inventory_manager')->first();
        $inventoryManager->permissions()->attach(
            Permission::whereIn('slug', ['manage_vehicles', 'view_reports'])->get()
        );

        $financeManager = Role::where('name', 'finance_manager')->first();
        $financeManager->permissions()->attach(
            Permission::whereIn('slug', ['manage_finance', 'view_reports'])->get()
        );

        $customerServiceManager = Role::where('name', 'customer_service_manager')->first();
        $customerServiceManager->permissions()->attach(
            Permission::whereIn('slug', ['manage_support', 'view_reports'])->get()
        );

        $marketingManager = Role::where('name', 'marketing_manager')->first();
        $marketingManager->permissions()->attach(
            Permission::whereIn('slug', ['manage_content', 'view_reports'])->get()
        );

        // Create Super Admin User
        $superAdminRole = Role::where('name', 'super_admin')->first();
        User::create([
            'name' => 'Super Admin',
            'email' => 'admin@cardealership.com',
            'password' => Hash::make('password'),
            'role_id' => $superAdminRole->id,
            'phone' => '+1234567890',
            'address' => '123 Admin Street, Admin City, AC 12345',
            'is_active' => true,
        ]);

        // Create Vehicle Categories
        $categories = [
            ['name' => 'Sedan', 'description' => 'Four-door passenger cars'],
            ['name' => 'SUV', 'description' => 'Sport Utility Vehicles'],
            ['name' => 'Truck', 'description' => 'Pickup trucks and commercial vehicles'],
            ['name' => 'Hatchback', 'description' => 'Compact cars with rear hatch'],
            ['name' => 'Van', 'description' => 'Passenger and cargo vans'],
        ];

        foreach ($categories as $category) {
            VehicleCategory::create($category);
        }

        // Create Vehicle Brands
        $brands = [
            ['name' => 'Toyota', 'description' => 'Japanese automotive manufacturer'],
            ['name' => 'Honda', 'description' => 'Japanese automotive manufacturer'],
            ['name' => 'Ford', 'description' => 'American automotive manufacturer'],
            ['name' => 'BMW', 'description' => 'German luxury automotive manufacturer'],
            ['name' => 'Mercedes-Benz', 'description' => 'German luxury automotive manufacturer'],
            ['name' => 'Nissan', 'description' => 'Japanese automotive manufacturer'],
            ['name' => 'Hyundai', 'description' => 'South Korean automotive manufacturer'],
            ['name' => 'Kia', 'description' => 'South Korean automotive manufacturer'],
        ];

        foreach ($brands as $brand) {
            VehicleBrand::create($brand);
        }

        // Create System Settings
        $settings = [
            ['key' => 'site_name', 'value' => 'Car Dealership', 'description' => 'Website name'],
            ['key' => 'contact_email', 'value' => 'info@cardealership.com', 'description' => 'Contact email'],
            ['key' => 'business_hours', 'value' => 'Mon-Fri: 9AM-6PM, Sat: 9AM-5PM, Sun: Closed', 'description' => 'Business hours'],
            ['key' => 'tax_rate', 'value' => '8.5', 'description' => 'Sales tax rate percentage'],
            ['key' => 'default_interest_rate', 'value' => '5.99', 'description' => 'Default financing interest rate'],
            ['key' => 'phone_number', 'value' => '+1 (555) 123-4567', 'description' => 'Business phone number'],
            ['key' => 'address', 'value' => '123 Car Street, Auto City, AC 12345', 'description' => 'Business address'],
        ];

        foreach ($settings as $setting) {
            Setting::create($setting);
        }

        $this->command->info('Admin data seeded successfully!');
        $this->command->info('Super Admin Login: admin@cardealership.com / password');
    }
}
