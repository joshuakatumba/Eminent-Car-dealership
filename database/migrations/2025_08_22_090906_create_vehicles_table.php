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
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained('vehicle_categories')->onDelete('cascade');
            $table->foreignId('brand_id')->constrained('vehicle_brands')->onDelete('cascade');
            $table->string('model', 100);
            $table->integer('year');
            $table->integer('mileage');
            $table->decimal('price', 10, 2);
            $table->decimal('sale_price', 10, 2)->nullable();
            $table->string('vin_number', 17)->unique();
            $table->string('engine_size', 50)->nullable();
            $table->enum('fuel_type', ['gasoline', 'diesel', 'electric', 'hybrid']);
            $table->enum('transmission', ['automatic', 'manual', 'cvt']);
            $table->string('color', 50);
            $table->string('interior_color', 50)->nullable();
            $table->json('features')->nullable();
            $table->text('description')->nullable();
            $table->enum('status', ['available', 'sold', 'reserved', 'maintenance'])->default('available');
            $table->boolean('is_featured')->default(false);
            $table->foreignId('created_by')->constrained('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicles');
    }
};
