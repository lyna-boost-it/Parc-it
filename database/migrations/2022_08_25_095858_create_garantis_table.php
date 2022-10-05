<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGarantisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('garantis', function (Blueprint $table) {
            $table->id();
            $table->string('ref_garanti');
            $table->string('garanti_type');
            $table->integer('km')->nullable();
            $table->integer('year')->nullable();
            $table->string('ref_vendor');
            $table->string('name_vendor');
            $table->string('address_vendor');
            $table->string('after_sold_service');
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
        Schema::dropIfExists('garantis');
    }
}
