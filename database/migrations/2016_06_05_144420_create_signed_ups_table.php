<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSignedUpsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('signed_ups', function(Blueprint $table)
		{
			$table->integer('user_id')->unsigned();
			$table->integer('event_id')->unsigned()->index('FKprijavljen_naDog_idx');
			$table->boolean('tracked');
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
		Schema::drop('signed_ups');
	}

}
