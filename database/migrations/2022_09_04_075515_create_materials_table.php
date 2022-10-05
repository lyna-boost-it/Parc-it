<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMaterialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('materials', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->string('ref',)->unique();
             $table->string('type_of_machine');
            $table->string('mark');
            $table->string('model');

            $table->date('acquisition_date');
            $table->date('affectation_date');
            $table->unsignedBigInteger('unit_id');
            $table->timestamps();
            $table->string('material_state');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('materials');
    }
}
