<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHotelDealsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hotel_deals', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('package_id');
            $table->string('name');
            $table->string('city');
            $table->longText('address');
            $table->integer('star_rating');
            $table->string('stay_start_date');
            $table->string('stay_duration');
            $table->string('stay_end_date');
            $table->longText('information');
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
        Schema::dropIfExists('hotel_deals');
    }
}
