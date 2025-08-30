<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('vehicles', function (Blueprint $table) {
            // Star rating (1-5 stars)
            $table->integer('star_rating')->default(0)->after('is_featured');
            
            // Discount percentage
            $table->decimal('discount_percentage', 5, 2)->default(0)->after('star_rating');
            
            // Categorization flags
            $table->boolean('is_new_arrival')->default(false)->after('discount_percentage');
            $table->boolean('is_best_seller')->default(false)->after('is_new_arrival');
            $table->boolean('is_trending')->default(false)->after('is_best_seller');
            $table->boolean('is_special_offer')->default(false)->after('is_trending');
            
            // Discount start and end dates
            $table->date('discount_start_date')->nullable()->after('is_special_offer');
            $table->date('discount_end_date')->nullable()->after('discount_start_date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('vehicles', function (Blueprint $table) {
            $table->dropColumn([
                'star_rating',
                'discount_percentage',
                'is_new_arrival',
                'is_best_seller',
                'is_trending',
                'is_special_offer',
                'discount_start_date',
                'discount_end_date'
            ]);
        });
    }
};
