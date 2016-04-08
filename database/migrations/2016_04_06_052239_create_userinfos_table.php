<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserinfosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('userinfos', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('user_id');
			$table->string('phone_number')->nullable();
			$table->string('province')->nullable();
			$table->string('city')->nullable();
			$table->string('area')->nullable();
			$table->string('address_detail')->nullable();
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
		Schema::drop('userinfos');
	}

}
