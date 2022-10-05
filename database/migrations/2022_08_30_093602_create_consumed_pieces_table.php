<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConsumedPiecesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('consumed_pieces', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('dt_code');
            $table->string('reference');
            $table->integer('quantity');
            $table->double('price');
       $table->string('designation');

            $table->integer('receip');

            $table->unsignedBigInteger('vehicule_id');

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
        Schema::dropIfExists('consumed_pieces');
    }
}
