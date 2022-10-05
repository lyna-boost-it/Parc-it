<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInsurancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('insurances', function (Blueprint $table) {
            $table->id();
            $table->string('police_number');
            $table->date('effective_date');
            $table->date('expiration_date');
            $table->string('company_name');
            $table->string('agency_code');
            $table->string('agency_address');
            $table->string('insurance_type');
             $table->string('state')->default('en cours');
            $table->unsignedBigInteger('vehicle_id')->nullable();

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
        Schema::dropIfExists('insurances');
    }
}
