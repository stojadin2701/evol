<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToBelongsToCategoriesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('belongs_to_categories', function(Blueprint $table)
		{
			$table->foreign('event_id', 'FKbelongsToEv')->references('id')->on('events')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('category_id', 'FKbelongsToEvCat')->references('id')->on('eventcategories')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('belongs_to_categories', function(Blueprint $table)
		{
			$table->dropForeign('FKbelongsToEv');
			$table->dropForeign('FKbelongsToEvCat');
		});
	}

}
