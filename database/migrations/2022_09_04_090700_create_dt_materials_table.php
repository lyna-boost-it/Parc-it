<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDtMaterialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dt_materials', function (Blueprint $table) {
            $table->id();
            $table->timestamps();


            $table->string('code_dt')->default(' ');
  $table->time('enter_time');
           $table->date('enter_date');
      $table->string('type_panne');
     $table->string('nature_panne');
     $table->unsignedBigInteger('emp_id');
 $table->unsignedBigInteger('unit_id');
 $table->unsignedBigInteger('staff_id');
 $table->string('action');
 $table->string('observation');
 $table->unsignedBigInteger('mm_id');


          $table->string('type_maintenance');

 $table->string('state')->default('en attente');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dt_materials');
    }
}
