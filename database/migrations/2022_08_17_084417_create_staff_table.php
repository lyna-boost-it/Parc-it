<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStaffTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('staff', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('last_name');
            $table->string('serial_numbers')->unique();
            $table->string('number_ss')->unique();
            $table->string('sex');
            $table->date('date_of_birth');
            $table->string('place_of_birth');
            $table->string('family_situation');
            $table->string('address');
            $table->date('date_of_recruitment');
            $table->string('function');
            $table->string('phone');

            $table->string('driver_license_number')->nullable();
            $table->string('driver_license_type')->nullable();
            $table->date('driver_license_date')->nullable();
            $table->string('diploma')->nullable();
            $table->unsignedBigInteger('unit_id')->nullable();
            $table->string('person_type');
            $table->string('staff_state');
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
        Schema::dropIfExists('staff');
    }
}
