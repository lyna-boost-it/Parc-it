<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('missions', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('driver_id');
            $table->string('p_name');
            $table->string('p_last_name');
              $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->string('reason');
            $table->unsignedBigInteger('vehicle_id');
            $table->text('description')->nullable();

            $table->string('to')->nullable();
            $table->string('from')->nullable();
            $table->string('territory')->nullable();
              $table->string('mission_state')->nullable();
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
        Schema::dropIfExists('missions');
    }
}
