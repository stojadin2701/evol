<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToParticipationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('participations', function(Blueprint $table)
		{
			$table->foreign('event_id', 'FKparticipatingEvent')->references('id')->on('events')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('user_id', 'FKparticipatingUser')->references('id')->on('users')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('participations', function(Blueprint $table)
		{
			$table->dropForeign('FKparticipatingEvent');
			$table->dropForeign('FKparticipatingUser');
		});
	}

}
