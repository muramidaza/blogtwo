<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Contragents extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contragents', function (Blueprint $table) {
            $table->bigIncrements('id');
			$table->string('name');
			$table->string('numberdogovor')->nullable();	
            $table->string('address');
			$table->string('contactface1');
			$table->string('contactface2')->nullable();	
			$table->string('contact1');
			$table->string('contact2')->nullable();	
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
        Schema::dropIfExists('contragents');
    }
}
