<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGasVehiculesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gas_vehicules', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('driver_id');
                $table->unsignedBigInteger('staff_id');
            $table->date('date');
            $table->double('km');
            $table->string('type');
            $table->integer('ticket');
            $table->double('price');

            $table->double('litter');
             $table->double('litter_price');
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
        Schema::dropIfExists('gas_vehicules');
    }
}
