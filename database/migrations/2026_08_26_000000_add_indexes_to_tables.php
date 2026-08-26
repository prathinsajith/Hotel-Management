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
        // Login looks users up by email on every request; a unique index makes
        // that an index seek and also enforces one account per email address.
        Schema::table('users', function (Blueprint $table) {
            $table->unique('email');
        });

        // Foreign-key columns used to fetch a user's bookings / a room's bookings.
        Schema::table('bookings', function (Blueprint $table) {
            $table->index('user_id');
            $table->index('hoteldetail_id');
        });

        // Pivot table joins on both sides — index each foreign key.
        Schema::table('hoteldetail_user', function (Blueprint $table) {
            $table->index('user_id');
            $table->index('hoteldetail_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropUnique(['email']);
        });

        Schema::table('bookings', function (Blueprint $table) {
            $table->dropIndex(['user_id']);
            $table->dropIndex(['hoteldetail_id']);
        });

        Schema::table('hoteldetail_user', function (Blueprint $table) {
            $table->dropIndex(['user_id']);
            $table->dropIndex(['hoteldetail_id']);
        });
    }
};
