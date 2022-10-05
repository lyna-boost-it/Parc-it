<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttendancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attendances', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->time('arrived_at_time');
  $table->date('arrived_at_date');
            $table->time('left_at_time')->nullable();
  $table->date('left_at_date')->nullable();
  $table->string('arrived_note')->nullable();
  $table->string('left_note')->nullable();
  $table->string('observation')->nullable();
  $table->string('work_place');
  $table->string('work_type');


            $table->unsignedBigInteger('staff_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('attendances');
    }
}
