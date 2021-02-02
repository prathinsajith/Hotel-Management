<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHoteldetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hoteldetails', function (Blueprint $table) {
            $table->id();
            $table->string('room_no')->unique();
            $table->string('imagepath');
            $table->integer('cost');
            $table->boolean('status')->default('0');
            $table->string('category');
            $table->string('guest_no');
            $table->string('room_size');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hoteldetails');
    }
}
