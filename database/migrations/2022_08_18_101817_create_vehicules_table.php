<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehiculesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicules', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->string('serial_numbers',)->unique();
            $table->string('year_commissioned');
            $table->string('type_of_fuel');
            $table->string('tank_capacity');
            $table->string('litter_by_100km');
            $table->string('tire_size');
            $table->string('pressure_forward');
            $table->string('pressure_back');
            $table->string('battery_type');
            $table->string('grey_card');
            $table->string('registration');
            $table->date('acquisition_date');
            $table->unsignedBigInteger('unit_id');
            $table->timestamps();
            $table->string('vehicle_type');
            $table->string('vehicle_state');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vehicules');
    }
}
