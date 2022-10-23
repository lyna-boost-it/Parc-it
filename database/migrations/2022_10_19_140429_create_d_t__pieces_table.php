<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDTPiecesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('d_t__pieces', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('dt_id');
            $table->foreign('dt_id')->references('id')->on('dts');
            $table->unsignedInteger('piece_id');
            $table->foreign('piece_id')->references('id')->on('consumed_pieces');
            $table->integer('quantity');
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
        Schema::dropIfExists('d_t__pieces');
    }
}
