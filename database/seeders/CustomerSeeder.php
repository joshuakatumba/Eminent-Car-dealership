<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Customer;
use App\Models\User;
use App\Models\Role;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get or create customer role
        $customerRole = Role::where('name', 'customer')->first();
        if (!$customerRole) {
            $customerRole = Role::create([
                'name' => 'customer',
                'description' => 'Regular customer role'
            ]);
        }

        $customers = [
            [
                'first_name' => 'John',
                'last_name' => 'Smith',
                'email' => 'john.smith@email.com',
                'phone' => '(555) 123-4567',
                'city' => 'Springfield',
                'state' => 'IL',
                'zip_code' => '62701',
                'age' => 38,
                'status' => 'active',
                'district' => 'Central',
                'driver_license' => 'IL123456789',
            ],
            [
                'first_name' => 'Sarah',
                'last_name' => 'Johnson',
                'email' => 'sarah.johnson@email.com',
                'phone' => '(555) 234-5678',
                'city' => 'Chicago',
                'state' => 'IL',
                'zip_code' => '60601',
                'age' => 33,
                'status' => 'active',
                'district' => 'Downtown',
                'driver_license' => 'IL987654321',
            ],
            [
                'first_name' => 'Michael',
                'last_name' => 'Davis',
                'email' => 'michael.davis@email.com',
                'phone' => '(555) 345-6789',
                'city' => 'Peoria',
                'state' => 'IL',
                'zip_code' => '61601',
                'age' => 41,
                'status' => 'active',
                'district' => 'North',
                'driver_license' => 'IL456789123',
            ],
            [
                'first_name' => 'Emily',
                'last_name' => 'Wilson',
                'email' => 'emily.wilson@email.com',
                'phone' => '(555) 456-7890',
                'city' => 'Rockford',
                'state' => 'IL',
                'zip_code' => '61101',
                'age' => 35,
                'status' => 'active',
                'district' => 'West',
                'driver_license' => 'IL789123456',
            ],
            [
                'first_name' => 'David',
                'last_name' => 'Brown',
                'email' => 'david.brown@email.com',
                'phone' => '(555) 567-8901',
                'city' => 'Aurora',
                'state' => 'IL',
                'zip_code' => '60505',
                'age' => 44,
                'status' => 'active',
                'district' => 'East',
                'driver_license' => 'IL321654987',
            ],
            [
                'first_name' => 'Lisa',
                'last_name' => 'Garcia',
                'email' => 'lisa.garcia@email.com',
                'phone' => '(555) 678-9012',
                'city' => 'Naperville',
                'state' => 'IL',
                'zip_code' => '60540',
                'age' => 29,
                'status' => 'active',
                'district' => 'South',
                'driver_license' => 'IL654321987',
            ],
            [
                'first_name' => 'Robert',
                'last_name' => 'Miller',
                'email' => 'robert.miller@email.com',
                'phone' => '(555) 789-0123',
                'city' => 'Joliet',
                'state' => 'IL',
                'zip_code' => '60431',
                'age' => 52,
                'status' => 'active',
                'district' => 'Central',
                'driver_license' => 'IL147258369',
            ],
            [
                'first_name' => 'Jennifer',
                'last_name' => 'Taylor',
                'email' => 'jennifer.taylor@email.com',
                'phone' => '(555) 890-1234',
                'city' => 'Elgin',
                'state' => 'IL',
                'zip_code' => '60120',
                'age' => 31,
                'status' => 'active',
                'district' => 'North',
                'driver_license' => 'IL963852741',
            ],
            [
                'first_name' => 'Christopher',
                'last_name' => 'Anderson',
                'email' => 'christopher.anderson@email.com',
                'phone' => '(555) 901-2345',
                'city' => 'Waukegan',
                'state' => 'IL',
                'zip_code' => '60085',
                'age' => 27,
                'status' => 'active',
                'district' => 'Lake',
                'driver_license' => 'IL852963741',
            ],
            [
                'first_name' => 'Amanda',
                'last_name' => 'Thomas',
                'email' => 'amanda.thomas@email.com',
                'phone' => '(555) 012-3456',
                'city' => 'Champaign',
                'state' => 'IL',
                'zip_code' => '61820',
                'age' => 36,
                'status' => 'active',
                'district' => 'University',
                'driver_license' => 'IL741852963',
            ],
        ];

        foreach ($customers as $customerData) {
            // Create user account for customer
            $user = User::create([
                'name' => $customerData['first_name'] . ' ' . $customerData['last_name'],
                'email' => $customerData['email'],
                'password' => bcrypt('password'), // Default password
                'role_id' => $customerRole->id,
                'phone' => $customerData['phone'],
                'is_active' => true,
            ]);

            // Create customer record
            Customer::create([
                'user_id' => $user->id,
                'first_name' => $customerData['first_name'],
                'last_name' => $customerData['last_name'],
                'email' => $customerData['email'],
                'phone' => $customerData['phone'],
                'city' => $customerData['city'],
                'state' => $customerData['state'],
                'zip_code' => $customerData['zip_code'],
                'age' => $customerData['age'],
                'status' => $customerData['status'],
                'district' => $customerData['district'],
                'driver_license' => $customerData['driver_license'],
            ]);
        }

        $this->command->info('Customer data seeded successfully!');
        $this->command->info('Customer Login: Use any customer email with password "password"');
    }
}
