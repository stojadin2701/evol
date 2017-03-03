<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEventcommentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('eventcomments', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('text', 500);
			$table->integer('user_id')->unsigned()->index('FKkomentarKor_idx');
			$table->integer('event_id')->unsigned()->index('FKkomentarDog_idx');
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
		Schema::drop('eventcomments');
	}

}
