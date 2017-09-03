<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateIngoingsTable extends Migration {

	public function up()
	{
		Schema::create('ingoings', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->integer('ingoing_id')->unsigned()->index();
			$table->string('ingoing_type')->index();
		});
	}

	public function down()
	{
		Schema::drop('ingoings');
	}
}
