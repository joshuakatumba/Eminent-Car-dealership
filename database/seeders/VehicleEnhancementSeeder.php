<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Vehicle;

class VehicleEnhancementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get all vehicles and update them with sample data
        $vehicles = Vehicle::all();
        
        foreach ($vehicles as $index => $vehicle) {
            $updates = [];
            
            // Add star rating (1-5 stars, with some having no rating)
            if ($index % 3 !== 0) { // 2/3 of vehicles get ratings
                $updates['star_rating'] = rand(1, 5);
            } else {
                $updates['star_rating'] = 0;
            }
            
            // Add discount (30% of vehicles get discounts)
            if ($index % 3 === 0) {
                $updates['discount_percentage'] = rand(5, 25);
                $updates['discount_start_date'] = now()->subDays(rand(1, 30));
                $updates['discount_end_date'] = now()->addDays(rand(30, 90));
            } else {
                $updates['discount_percentage'] = 0;
                $updates['discount_start_date'] = null;
                $updates['discount_end_date'] = null;
            }
            
            // Add categorization flags
            $updates['is_new_arrival'] = $index < 3; // First 3 vehicles are new arrivals
            $updates['is_best_seller'] = $index % 4 === 0; // Every 4th vehicle is best seller
            $updates['is_trending'] = $index % 5 === 0; // Every 5th vehicle is trending
            $updates['is_special_offer'] = $index % 3 === 0; // Every 3rd vehicle is special offer
            
            $vehicle->update($updates);
        }
        
        $this->command->info('Enhanced ' . $vehicles->count() . ' vehicles with ratings, discounts, and categorization.');
    }
}
