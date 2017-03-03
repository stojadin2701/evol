<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToSignedUpsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('signed_ups', function(Blueprint $table)
		{
			$table->foreign('event_id', 'FKsignedUpForEvent')->references('id')->on('events')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('user_id', 'FKsignedUpForUser')->references('id')->on('users')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('signed_ups', function(Blueprint $table)
		{
			$table->dropForeign('FKsignedUpForEvent');
			$table->dropForeign('FKsignedUpForUser');
		});
	}

}
