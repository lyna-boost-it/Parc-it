<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExternalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('externals', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('dt_code')->nullable();
            $table->unsignedBigInteger('vehicule_id')->nullable();
            $table->string('contract');
             $table->string('supplier');
            $table->string('panne_type');
           $table->string('changed_piece');
$table->date('start_date');
$table->date('end_date');

            $table->double('price');

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
        Schema::dropIfExists('externals');
    }
}
