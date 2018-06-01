<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('packages', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('package_category_id')->nullable();
            $table->string('package_name')->nullable();
            $table->smallInteger('flight')->nullable();
            $table->smallInteger('hotel')->nullable();
            $table->smallInteger('attraction')->nullable();
            $table->string('location')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('time_length')->nullable();
            $table->longText('info')->nullable();
            $table->string('duration_type')->nullable();
            $table->string('transports')->nullable();
            $table->string('language_spoken')->nullable();
            $table->string('adult_price')->nullable();
            $table->string('kids_price')->nullable();
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
        Schema::dropIfExists('packages');
    }
}
