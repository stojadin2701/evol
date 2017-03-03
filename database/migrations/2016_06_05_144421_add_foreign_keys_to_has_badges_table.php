<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToHasBadgesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('has_badges', function(Blueprint $table)
		{
			$table->foreign('badge_id', 'FKhasBadgesBadge')->references('id')->on('badges')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('user_id', 'FKhasBadgesUser')->references('id')->on('users')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('has_badges', function(Blueprint $table)
		{
			$table->dropForeign('FKhasBadgesBadge');
			$table->dropForeign('FKhasBadgesUser');
		});
	}

}
