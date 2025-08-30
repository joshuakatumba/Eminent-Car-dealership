<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;

class CreateAdminUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'admin:create-user';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create an admin user for the admin panel';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Check if admin user already exists
        $existingAdmin = User::where('email', 'admin@cardealership.com')->first();
        
        if ($existingAdmin) {
            $this->info('Admin user already exists!');
            $this->info('Email: admin@cardealership.com');
            $this->info('Password: password');
            return;
        }

        // Create or get super admin role
        $superAdminRole = Role::firstOrCreate(
            ['name' => 'super_admin'],
            ['description' => 'Full system access']
        );

        // Create admin user
        $admin = User::create([
            'name' => 'Super Admin',
            'email' => 'admin@cardealership.com',
            'password' => Hash::make('password'),
            'role_id' => $superAdminRole->id,
            'phone' => '+1234567890',
            'address' => '123 Admin Street, Admin City, AC 12345',
            'is_active' => true,
        ]);

        $this->info('Admin user created successfully!');
        $this->info('Email: admin@cardealership.com');
        $this->info('Password: password');
        $this->info('Access URL: http://localhost:8001/login');
    }
}
