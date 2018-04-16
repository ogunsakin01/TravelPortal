<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePayLatersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pay_laters', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->text('reference');
            $table->text('booking_reference');
            $table->integer('amount');
            $table->integer('bank_detail_id');
            $table->string('slip_photo');
            $table->integer('status');
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
        Schema::dropIfExists('pay_laters');
    }
}
