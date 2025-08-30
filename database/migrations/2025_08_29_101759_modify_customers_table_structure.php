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
        Schema::table('customers', function (Blueprint $table) {
            // Remove existing columns
            $table->dropColumn(['credit_score', 'address', 'date_of_birth']);
            
            // Add new columns
            $table->integer('age')->nullable()->after('zip_code');
            $table->enum('status', ['active', 'inactive'])->default('active')->after('age');
            $table->string('district', 100)->nullable()->after('city');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('customers', function (Blueprint $table) {
            // Remove new columns
            $table->dropColumn(['age', 'status', 'district']);
            
            // Add back original columns
            $table->text('address')->after('phone');
            $table->date('date_of_birth')->nullable()->after('zip_code');
            $table->integer('credit_score')->nullable()->after('driver_license');
        });
    }
};
