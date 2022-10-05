<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTechnicalControlsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('technical_controls', function (Blueprint $table) {
            $table->id();
            $table->string('technical_control_number');
            $table->date('effective_date');
            $table->date('expiration_date');
            $table->string('reserve');
            $table->string('transmitter');
            $table->text('observation')->nullable();
            $table->string('SirGaz');
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
        Schema::dropIfExists('technical_controls');
    }
}
