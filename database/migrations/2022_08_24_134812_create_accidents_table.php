<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccidentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accidents', function (Blueprint $table) {
            $table->id();

            $table->string('accident_type');
            $table->string('result');
            $table->string('cause');
            $table->string('opponent_driver_name');
             $table->string('opponent_driver_last_name');
            $table->string('opponent_insurance');
            $table->string('opponent_number_insurance');
            $table->string('opponent_insurance_address');
            $table->string('state');
            $table->date('declaration_date');
            $table->date('expertise_date');
            $table->unsignedBigInteger('driver_id');
            $table->unsignedBigInteger('vehicle_id')->nullable();
            $table->string('path')->default(' ');


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
        Schema::dropIfExists('accidents');
    }
}
