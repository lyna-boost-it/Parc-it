<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExternalMaterialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('external_materials', function (Blueprint $table) {
            $table->id();
            $table->timestamps();



            $table->unsignedBigInteger('dt_code')->nullable();
            $table->unsignedBigInteger('mm_id')->nullable();
            $table->string('contract');
             $table->string('supplier');
            $table->string('panne_type');
           $table->string('changed_piece');
$table->date('start_date');
$table->date('end_date');

            $table->double('price');



        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('external_materials');
    }
}
