<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateParticipationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('participations', function(Blueprint $table)
		{
			$table->integer('user_id')->unsigned();
			$table->integer('event_id')->unsigned()->index('FKevidencijaDog_idx');
			$table->integer('user_rating');
			$table->string('note', 500)->nullable();
			$table->primary(['user_id','event_id']);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('participations');
	}

}
