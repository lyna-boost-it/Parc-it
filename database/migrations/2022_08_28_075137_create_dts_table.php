<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDtsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('unit_id');
            $table->unsignedBigInteger('staff_id');
            $table->unsignedBigInteger('vehicule_id')->default(' ');
            $table->unsignedBigInteger('driver_id');
            $table->timestamps();
            $table->string('code_dt')->default(' ');
            $table->string('action');
            $table->string('observation');
            $table->string('nature_panne');
            $table->string('type_maintenance');
            $table->string('type_panne');
            $table->string('type');
 $table->string('state')->default('en attente');

            $table->time('enter_time');
           $table->date('enter_date');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dts');
    }
}
