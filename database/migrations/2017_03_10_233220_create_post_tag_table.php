<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePostTagTable extends Migration {

	public function up()
	{
		Schema::create('post_tag', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->integer('post_id')->unsigned();
			$table->integer('tag_id')->unsigned();
		});
	}

	public function down()
	{
		Schema::drop('post_tag');
	}
}
