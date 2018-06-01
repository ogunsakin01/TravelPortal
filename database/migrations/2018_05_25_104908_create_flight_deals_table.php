<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFlightDealsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('flight_deals', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('package_id');
            $table->string('origin');
            $table->string('destination');
            $table->string('date');
            $table->string('airline');
            $table->string('cabin');
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
        Schema::dropIfExists('flight_deals');
    }
}
