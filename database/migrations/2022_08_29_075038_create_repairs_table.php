<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRepairsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('repairs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('dt_code')->nullable();
            $table->date('intervention_date');
            $table->string('diagnostic');

            $table->string('repaired_breakdowns');
             $table->integer('liquid');
              $table->integer('lubricant');
            $table->dateTime('end_date');
            $table->dateTime('end_time');
            $table->string('observation')->nullable();
            $table->unsignedBigInteger('vehicule_id')->nullable();
            $table->unsignedBigInteger('driver_id')->nullable();

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
        Schema::dropIfExists('repairs');
    }
}
