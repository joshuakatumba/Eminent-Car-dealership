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
        Schema::table('users', function (Blueprint $table) {
            $table->foreignId('role_id')->nullable()->after('password')->constrained('roles')->onDelete('set null');
            $table->string('phone', 20)->nullable()->after('role_id');
            $table->text('address')->nullable()->after('phone');
            $table->string('profile_image', 255)->nullable()->after('address');
            $table->boolean('is_active')->default(true)->after('profile_image');
            $table->timestamp('last_login_at')->nullable()->after('is_active');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['role_id']);
            $table->dropColumn(['role_id', 'phone', 'address', 'profile_image', 'is_active', 'last_login_at']);
        });
    }
};
