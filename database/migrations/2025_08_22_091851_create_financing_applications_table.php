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
        Schema::create('financing_applications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained()->onDelete('cascade');
            $table->foreignId('vehicle_id')->constrained()->onDelete('cascade');
            $table->decimal('requested_amount', 10, 2);
            $table->decimal('monthly_income', 10, 2);
            $table->enum('employment_status', ['employed', 'self_employed', 'unemployed']);
            $table->string('employer_name', 255)->nullable();
            $table->integer('employment_duration')->nullable(); // months
            $table->integer('credit_score');
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->foreignId('approved_by')->nullable()->constrained('users')->onDelete('set null');
            $table->timestamp('approved_at')->nullable();
            $table->decimal('interest_rate', 5, 2)->nullable();
            $table->integer('loan_term')->nullable(); // months
            $table->decimal('monthly_payment', 10, 2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('financing_applications');
    }
};
