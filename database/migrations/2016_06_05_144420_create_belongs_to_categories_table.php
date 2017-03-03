<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBelongsToCategoriesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('belongs_to_categories', function(Blueprint $table)
		{
			$table->integer('event_id')->unsigned();
			$table->integer('category_id')->unsigned()->index('FKpripadaKatDog_idx');
			$table->primary(['event_id','category_id']);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('belongs_to_categories');
	}

}
