<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHotelBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hotel_bookings', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('reference');
            $table->string('pnr');
            $table->string('hotel_name');
            $table->string('hotel_code');
            $table->string('hotel_city_code');
            $table->string('hotel_chain_code');
            $table->string('hotel_context_code');
            $table->string('room_booking_code');
            $table->string('rate_plan_code');
            $table->string('guarantee');
            $table->integer('adult_guest');
            $table->integer('child_guest');
            $table->string('check_in_date');
            $table->string('check_out_date');
            $table->bigInteger('base_amount');
            $table->bigInteger('vat');
            $table->bigInteger('markup');
            $table->bigInteger('markdown');
            $table->bigInteger('voucher_id');
            $table->bigInteger('voucher_amount');
            $table->bigInteger('total_amount');
            $table->string('expiry_date');
            $table->integer('payment_status')->default(0);
            $table->integer('reservation_status')->default(0);
            $table->integer('cancellation_status')->default(0);
            $table->longText('pnr_request_response');
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
        Schema::dropIfExists('hotel_bookings');
    }
}
