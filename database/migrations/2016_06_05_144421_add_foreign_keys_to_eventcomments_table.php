<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToEventcommentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('eventcomments', function(Blueprint $table)
		{
			$table->foreign('event_id', 'FKcommentEvent')->references('id')->on('events')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('user_id', 'FKcommentUser')->references('id')->on('users')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('eventcomments', function(Blueprint $table)
		{
			$table->dropForeign('FKcommentEvent');
			$table->dropForeign('FKcommentUser');
		});
	}

}
