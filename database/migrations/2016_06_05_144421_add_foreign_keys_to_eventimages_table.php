<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToEventimagesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('eventimages', function(Blueprint $table)
		{
			$table->foreign('event_id', 'FKimagesForEvent')->references('id')->on('events')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('eventimages', function(Blueprint $table)
		{
			$table->dropForeign('FKimagesForEvent');
		});
	}

}
