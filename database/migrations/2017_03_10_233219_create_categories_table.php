<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCategoriesTable extends Migration {

	public function up()
	{
		Schema::create('categories', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('title')->unique();
			$table->string('slug')->unique();
		});
	}

	public function down()
	{
		Schema::drop('categories');
	}
}
