<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShiftStaffTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shift__staff', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('staff_id')->nullable();
            $table->unsignedBigInteger('shift_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shift__staff');
    }
}
