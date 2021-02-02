<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class HoteldetailUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hoteldetail_user', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('hoteldetail_id');
            $table->integer('no_of_days');
            $table->integer('total_cost');
            $table->date('check_in');
            $table->date('check_out');
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
        Schema::dropIfExists('hoteldetail_user');

    }
}
