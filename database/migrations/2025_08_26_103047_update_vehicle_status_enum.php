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
            // Drop the existing enum constraint
            $table->enum('status', ['available', 'sold', 'reserved', 'maintenance', 'booked', 'out_of_stock'])->default('available')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('vehicles', function (Blueprint $table) {
            // Revert to original enum values
            $table->enum('status', ['available', 'sold', 'reserved', 'maintenance'])->default('available')->change();
        });
    }
};
