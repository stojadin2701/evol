<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name', 50);
			$table->string('username', 20)->unique('username');
			$table->string('email', 50)->unique();
			$table->string('password');
			$table->string('imgURI', 250)->nullable();
			$table->boolean('banned');
			$table->integer('privilege')->default(0);
			$table->integer('ratingSum')->unsigned()->nullable()->default(0);
			$table->integer('ratingNum')->unsigned()->nullable()->default(0);
			$table->string('city', 50)->nullable();
			$table->string('bio', 500)->nullable();
			$table->string('remember_token', 100)->nullable();
			$table->timestamps();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('users');
	}

}
