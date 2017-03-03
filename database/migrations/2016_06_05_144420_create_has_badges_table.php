<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateHasBadgesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('has_badges', function(Blueprint $table)
		{
			$table->integer('user_id')->unsigned();
			$table->integer('badge_id')->unsigned()->index('FKimaBedz_idx');
			$table->primary(['user_id','badge_id']);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('has_badges');
	}

}
