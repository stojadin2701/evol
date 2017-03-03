<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEventsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('events', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('user_id')->unsigned()->index('user_id');
			$table->dateTime('dateTimeFrom');
			$table->dateTime('dateTimeTo');
			$table->string('location', 50);
			$table->string('name', 50);
			$table->string('summary', 300);
			$table->string('description', 1000);
			$table->integer('participantsApplied')->unsigned()->nullable()->default(0);
			$table->integer('participantsNeeded');
			$table->string('status', 7);
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
		Schema::drop('events');
	}

}
