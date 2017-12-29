<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsersTable extends Migration {

	public function up() {
		Schema::create( 'users', function ( Blueprint $table ) {
			$table->increments( 'id' );
			$table->timestamps();
			$table->string( 'name' )->unique();
			$table->string( 'email' )->unique();
			$table->string( 'password' );
			$table->rememberToken();
			$table->enum( 'role', [ 'user', 'redac', 'admin' ] );
			$table->boolean( 'valid' )->default( FALSE );
		} );
	}

	public function down() {
		Schema::drop( 'users' );
	}
}
