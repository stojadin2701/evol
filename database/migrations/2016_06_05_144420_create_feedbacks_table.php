<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFeedbacksTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('feedbacks', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('content', 1000);
			$table->integer('user_id')->unsigned()->index('user_id');
			$table->integer('category_id')->unsigned()->index('FKInfKat_idx');
			$table->boolean('shown');
			$table->timestamps();
			$table->integer('feedbackable_id')->unsigned()->index('feedbackable_id');
			$table->string('feedbackable_type');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('feedbacks');
	}

}
