<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMarkupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('markups', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('role_id')->nullable();
            $table->integer('flight_markup_type')->default("1");
            $table->integer('flight_markup_value')->default("0");
            $table->integer('hotel_markup_type')->default("1");
            $table->integer('hotel_markup_value')->default("0");
            $table->integer('car_markup_type')->default("1");
            $table->integer('car_markup_value')->default("0");
            $table->integer('package_markup_type')->default("1");
            $table->integer('package_markup_value')->default("0");
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
        Schema::dropIfExists('markups');
    }
}
