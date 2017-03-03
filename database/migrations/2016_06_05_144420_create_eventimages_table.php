<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEventimagesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('eventimages', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('uri', 250);
			$table->integer('event_id')->unsigned()->index('FKSliDog_idx');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('eventimages');
	}

}
