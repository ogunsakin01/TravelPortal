<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCooperateCustomerProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cooperate_customer_profiles', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('company_name');
            $table->longText('company_address');
            $table->string('company_cac_rc_number');
            $table->string('company_phone_number');
            $table->string('company_email');
            $table->string('company_contact_person_email');
            $table->string('company_contact_person_phone_number');
            $table->longText('company_contact_person_address');
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
        Schema::dropIfExists('cooperate_customer_profiles');
    }
}
