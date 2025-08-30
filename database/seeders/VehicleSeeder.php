<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Vehicle;
use App\Models\VehicleCategory;
use App\Models\VehicleBrand;
use App\Models\User;

class VehicleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get categories and brands
        $categories = VehicleCategory::all();
        $brands = VehicleBrand::all();
        $adminUser = User::where('email', 'admin@cardealership.com')->first();

        if (!$adminUser) {
            $this->command->error('Admin user not found. Please run AdminSeeder first.');
            return;
        }

        $vehicles = [
            [
                'category_id' => $categories->where('name', 'SUV')->first()->id,
                'brand_id' => $brands->where('name', 'Toyota')->first()->id,
                'model' => 'RAV4',
                'year' => 2022,
                'mileage' => 15000,
                'price' => 25000,
                'sale_price' => 22000,
                'vin_number' => '1HGBH41JXMN109186',
                'engine_size' => '2.5L',
                'fuel_type' => 'gasoline',
                'transmission' => 'automatic',
                'color' => 'Silver',
                'interior_color' => 'Black',
                'description' => 'Excellent condition Toyota RAV4 with low mileage.',
                'is_featured' => true,
                'status' => 'available',
                'created_by' => $adminUser->id,
            ],
            [
                'category_id' => $categories->where('name', 'Sedan')->first()->id,
                'brand_id' => $brands->where('name', 'Honda')->first()->id,
                'model' => 'Civic',
                'year' => 2021,
                'mileage' => 25000,
                'price' => 20000,
                'sale_price' => null,
                'vin_number' => '2T1BURHE0JC123456',
                'engine_size' => '1.5L',
                'fuel_type' => 'gasoline',
                'transmission' => 'automatic',
                'color' => 'Blue',
                'interior_color' => 'Gray',
                'description' => 'Well-maintained Honda Civic with great fuel efficiency.',
                'is_featured' => false,
                'status' => 'available',
                'created_by' => $adminUser->id,
            ],
            [
                'category_id' => $categories->where('name', 'Truck')->first()->id,
                'brand_id' => $brands->where('name', 'Ford')->first()->id,
                'model' => 'F-150',
                'year' => 2023,
                'mileage' => 5000,
                'price' => 45000,
                'sale_price' => 42000,
                'vin_number' => '1FTEW1EG8JFA12345',
                'engine_size' => '3.5L',
                'fuel_type' => 'gasoline',
                'transmission' => 'automatic',
                'color' => 'White',
                'interior_color' => 'Black',
                'description' => 'Brand new Ford F-150 with premium features.',
                'is_featured' => true,
                'status' => 'available',
                'created_by' => $adminUser->id,
            ],
            [
                'category_id' => $categories->where('name', 'SUV')->first()->id,
                'brand_id' => $brands->where('name', 'BMW')->first()->id,
                'model' => 'X5',
                'year' => 2022,
                'mileage' => 18000,
                'price' => 65000,
                'sale_price' => 58000,
                'vin_number' => '5UXCR6C56KLL12345',
                'engine_size' => '3.0L',
                'fuel_type' => 'gasoline',
                'transmission' => 'automatic',
                'color' => 'Black',
                'interior_color' => 'Cream',
                'description' => 'Luxury BMW X5 with premium leather interior.',
                'is_featured' => true,
                'status' => 'available',
                'created_by' => $adminUser->id,
            ],
            [
                'category_id' => $categories->where('name', 'Hatchback')->first()->id,
                'brand_id' => $brands->where('name', 'Toyota')->first()->id,
                'model' => 'Corolla',
                'year' => 2021,
                'mileage' => 30000,
                'price' => 18000,
                'sale_price' => null,
                'vin_number' => '1NXBU4EE0AZ123456',
                'engine_size' => '2.0L',
                'fuel_type' => 'gasoline',
                'transmission' => 'automatic',
                'color' => 'Red',
                'interior_color' => 'Black',
                'description' => 'Reliable Toyota Corolla with excellent condition.',
                'is_featured' => false,
                'status' => 'available',
                'created_by' => $adminUser->id,
            ],
            [
                'category_id' => $categories->where('name', 'Van')->first()->id,
                'brand_id' => $brands->where('name', 'Toyota')->first()->id,
                'model' => 'Sienna',
                'year' => 2022,
                'mileage' => 12000,
                'price' => 35000,
                'sale_price' => 32000,
                'vin_number' => '5TDYK3DC4NS123456',
                'engine_size' => '2.5L',
                'fuel_type' => 'hybrid',
                'transmission' => 'automatic',
                'color' => 'Silver',
                'interior_color' => 'Gray',
                'description' => 'Hybrid Toyota Sienna with great fuel economy.',
                'is_featured' => true,
                'status' => 'available',
                'created_by' => $adminUser->id,
            ],
            [
                'category_id' => $categories->where('name', 'Sedan')->first()->id,
                'brand_id' => $brands->where('name', 'Mercedes-Benz')->first()->id,
                'model' => 'C-Class',
                'year' => 2023,
                'mileage' => 8000,
                'price' => 55000,
                'sale_price' => 50000,
                'vin_number' => 'WDDWF4JB0FR123456',
                'engine_size' => '2.0L',
                'fuel_type' => 'gasoline',
                'transmission' => 'automatic',
                'color' => 'White',
                'interior_color' => 'Black',
                'description' => 'Luxury Mercedes C-Class with premium features.',
                'is_featured' => true,
                'status' => 'available',
                'created_by' => $adminUser->id,
            ],
            [
                'category_id' => $categories->where('name', 'SUV')->first()->id,
                'brand_id' => $brands->where('name', 'Audi')->first()->id,
                'model' => 'Q5',
                'year' => 2022,
                'mileage' => 22000,
                'price' => 48000,
                'sale_price' => null,
                'vin_number' => 'WA1LAAF75JD123456',
                'engine_size' => '2.0L',
                'fuel_type' => 'gasoline',
                'transmission' => 'automatic',
                'color' => 'Blue',
                'interior_color' => 'Black',
                'description' => 'Premium Audi Q5 with quattro all-wheel drive.',
                'is_featured' => false,
                'status' => 'available',
                'created_by' => $adminUser->id,
            ],
        ];

        foreach ($vehicles as $vehicleData) {
            Vehicle::create($vehicleData);
        }

        $this->command->info('Sample vehicles seeded successfully!');
    }
}
