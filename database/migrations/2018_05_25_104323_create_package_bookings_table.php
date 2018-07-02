<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePackageBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('package_bookings', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('package_id');
            $table->string('reference');
            $table->integer('adults');
            $table->integer('children');
            $table->integer('infants');
            $table->integer('customer_title_id');
            $table->string('customer_sur_name');
            $table->string('customer_first_name');
            $table->string('customer_other_name');
            $table->string('customer_phone');
            $table->string('customer_email');
            $table->string('total_amount');
            $table->integer('payment_status');
            $table->integer('booking_status')->default(0);
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
        Schema::dropIfExists('package_bookings');
    }
}
