<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FilesPost extends Migration
{
		/**
		 * Run the migrations.
		 *
		 * @return void
		 */
		public function up()
		{
				//
		Schema::create('files_posts', function(Blueprint $table)
		{

			$table->increments('id');
			$table->integer('files_id')->unsigned()->index();
			$table->foreign('files_id')->references('id')->on('files')->onDelete('cascade');
			$table->integer('posts_id')->unsigned()->index();
			$table->foreign('posts_id')->references('id')->on('posts')->onDelete('cascade');		
		
		});
		

	}

		/**
		 * Reverse the migrations.
		 *
		 * @return void
		 */
	public function down()
	{
				//
	}
}
