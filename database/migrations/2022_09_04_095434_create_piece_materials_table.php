<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePieceMaterialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('piece_materials', function (Blueprint $table) {
            $table->id();
            $table->string('ref');
            $table->string('designation');
            $table->integer('quantity');
            $table->double('price');
            $table->unsignedBigInteger('mm_id');
            $table->unsignedBigInteger('dt_code');
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
        Schema::dropIfExists('piece_materials');
    }
}
