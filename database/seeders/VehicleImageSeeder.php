<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Vehicle;
use App\Models\VehicleImage;
use Illuminate\Support\Facades\Storage;

class VehicleImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $vehicles = Vehicle::all();
        
        if ($vehicles->isEmpty()) {
            $this->command->error('No vehicles found. Please run VehicleSeeder first.');
            return;
        }

        // Get existing image files from storage
        $imageFiles = [];
        for ($i = 1; $i <= 12; $i++) {
            $imagePath = "assets/images/product-images/{$i}.jpg";
            if (file_exists(public_path($imagePath))) {
                $imageFiles[] = $imagePath;
            }
        }

        if (empty($imageFiles)) {
            $this->command->error('No image files found in public/assets/images/product-images/');
            return;
        }

        $imageIndex = 0;
        foreach ($vehicles as $vehicle) {
            // Skip if vehicle already has images
            if ($vehicle->images()->count() > 0) {
                continue;
            }

            // Copy image from public to storage
            if (isset($imageFiles[$imageIndex])) {
                $sourcePath = public_path($imageFiles[$imageIndex]);
                $filename = basename($imageFiles[$imageIndex]);
                $destinationPath = "vehicles/{$vehicle->id}/{$filename}";
                
                // Create directory if it doesn't exist
                $directory = "vehicles/{$vehicle->id}";
                if (!Storage::disk('public')->exists($directory)) {
                    Storage::disk('public')->makeDirectory($directory);
                }
                
                // Copy file to storage
                if (Storage::disk('public')->put($destinationPath, file_get_contents($sourcePath))) {
                    // Create database record
                    VehicleImage::create([
                        'vehicle_id' => $vehicle->id,
                        'image_path' => $destinationPath,
                        'image_name' => $filename,
                        'is_primary' => true, // First image is primary
                        'sort_order' => 1
                    ]);
                    
                    $this->command->info("Associated image with vehicle {$vehicle->brand->name} {$vehicle->model}");
                }
                
                $imageIndex++;
                
                // If we run out of images, start over
                if ($imageIndex >= count($imageFiles)) {
                    $imageIndex = 0;
                }
            }
        }

        $this->command->info('Vehicle images associated successfully!');
    }
}
