<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCategoryPostTable extends Migration {

	public function up()
	{
		Schema::create('category_post', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->integer('category_id')->unsigned();
			$table->integer('post_id')->unsigned();
		});
	}

	public function down()
	{
		Schema::drop('category_post');
	}
}
