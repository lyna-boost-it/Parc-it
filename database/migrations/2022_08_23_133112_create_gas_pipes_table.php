<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGasPipesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gas_pipes', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('driver_id');
                $table->unsignedBigInteger('staff_id');
                 $table->unsignedBigInteger('unit_id');
                 $table->double('price');
                $table->integer('ticket');
 $table->double('litter');
             $table->double('litter_price');

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
        Schema::dropIfExists('gas_pipes');
    }
}
