<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEquipmentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('equipment', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->string('type');
			$table->string('model');
			$table->string('serialnumber')->nullable();
			$table->string('invnumber')->nullable();
			$table->string('contragent_id');
			$table->string('photo1')->nullable();
			$table->string('photo2')->nullable();
			$table->string('photo3')->nullable();
			$table->string('photo4')->nullable();
			$table->text('note')->nullable();
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
        Schema::dropIfExists('equipment');
    }
}
