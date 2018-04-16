<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFlightBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('flight_bookings', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->text('reference');
            $table->text('pnr')->nullable();
            $table->bigInteger('itinerary_amount');
            $table->bigInteger('markup');
            $table->bigInteger('markdown');
            $table->bigInteger('vat');
            $table->integer('voucher_id');
            $table->bigInteger('voucher_amount');
            $table->bigInteger('total_amount');
            $table->text('ticket_time_limit');
            $table->integer('payment_status')->default("0");
            $table->integer('issue_ticket_status')->default("0");
            $table->integer('void_ticket_status')->default("0");
            $table->integer('cancel_ticket_status')->default("0");
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
        Schema::dropIfExists('flight_bookings');
    }
}
