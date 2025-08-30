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
                'address' => '123 Main Street',
                'city' => 'Springfield',
                'state' => 'IL',
                'zip_code' => '62701',
                'date_of_birth' => '1985-03-15',
                'driver_license' => 'IL123456789',
                'credit_score' => 750,
            ],
            [
                'first_name' => 'Sarah',
                'last_name' => 'Johnson',
                'email' => 'sarah.johnson@email.com',
                'phone' => '(555) 234-5678',
                'address' => '456 Oak Avenue',
                'city' => 'Chicago',
                'state' => 'IL',
                'zip_code' => '60601',
                'date_of_birth' => '1990-07-22',
                'driver_license' => 'IL987654321',
                'credit_score' => 720,
            ],
            [
                'first_name' => 'Michael',
                'last_name' => 'Davis',
                'email' => 'michael.davis@email.com',
                'phone' => '(555) 345-6789',
                'address' => '789 Pine Road',
                'city' => 'Peoria',
                'state' => 'IL',
                'zip_code' => '61601',
                'date_of_birth' => '1982-11-08',
                'driver_license' => 'IL456789123',
                'credit_score' => 680,
            ],
            [
                'first_name' => 'Emily',
                'last_name' => 'Wilson',
                'email' => 'emily.wilson@email.com',
                'phone' => '(555) 456-7890',
                'address' => '321 Elm Street',
                'city' => 'Rockford',
                'state' => 'IL',
                'zip_code' => '61101',
                'date_of_birth' => '1988-05-12',
                'driver_license' => 'IL789123456',
                'credit_score' => 800,
            ],
            [
                'first_name' => 'David',
                'last_name' => 'Brown',
                'email' => 'david.brown@email.com',
                'phone' => '(555) 567-8901',
                'address' => '654 Maple Drive',
                'city' => 'Aurora',
                'state' => 'IL',
                'zip_code' => '60505',
                'date_of_birth' => '1979-09-30',
                'driver_license' => 'IL321654987',
                'credit_score' => 650,
            ],
            [
                'first_name' => 'Lisa',
                'last_name' => 'Garcia',
                'email' => 'lisa.garcia@email.com',
                'phone' => '(555) 678-9012',
                'address' => '987 Cedar Lane',
                'city' => 'Naperville',
                'state' => 'IL',
                'zip_code' => '60540',
                'date_of_birth' => '1992-01-18',
                'driver_license' => 'IL654321987',
                'credit_score' => 780,
            ],
            [
                'first_name' => 'Robert',
                'last_name' => 'Martinez',
                'email' => 'robert.martinez@email.com',
                'phone' => '(555) 789-0123',
                'address' => '147 Birch Court',
                'city' => 'Joliet',
                'state' => 'IL',
                'zip_code' => '60431',
                'date_of_birth' => '1987-12-03',
                'driver_license' => 'IL147258369',
                'credit_score' => 710,
            ],
            [
                'first_name' => 'Jennifer',
                'last_name' => 'Taylor',
                'email' => 'jennifer.taylor@email.com',
                'phone' => '(555) 890-1234',
                'address' => '258 Spruce Way',
                'city' => 'Elgin',
                'state' => 'IL',
                'zip_code' => '60120',
                'date_of_birth' => '1991-04-25',
                'driver_license' => 'IL258369147',
                'credit_score' => 760,
            ],
        ];

        foreach ($customers as $customerData) {
            // Create user account for customer
            $user = User::create([
                'name' => $customerData['first_name'] . ' ' . $customerData['last_name'],
                'email' => $customerData['email'],
                'phone' => $customerData['phone'],
                'password' => bcrypt('password'), // Default password
                'role_id' => $customerRole->id,
            ]);

            // Create customer record
            Customer::create([
                'user_id' => $user->id,
                'first_name' => $customerData['first_name'],
                'last_name' => $customerData['last_name'],
                'email' => $customerData['email'],
                'phone' => $customerData['phone'],
                'address' => $customerData['address'],
                'city' => $customerData['city'],
                'state' => $customerData['state'],
                'zip_code' => $customerData['zip_code'],
                'date_of_birth' => $customerData['date_of_birth'],
                'driver_license' => $customerData['driver_license'],
                'credit_score' => $customerData['credit_score'],
            ]);
        }

        $this->command->info('Customer data seeded successfully!');
    }
}
