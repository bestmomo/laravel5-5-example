<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class testController extends Controller {
	public function index()
	{
	$v = $this->testManyToMany();






		if ( isset( $v ) ) {
			debug( $v );
		}

		//$v='Ok';
		return view( 'front.vide', compact( 'v' ) );

	}


	public function testManyToMany()
	{
		return $this->getPostsCategories();
	}

	public function getPostsCategories()
	{
		$posts = Post::with( 'categories' )
		             ->with( [ 'categories' => function ( $query ) {
			             $query->select( 'title', 'slug' );
			             $query->latest( 'categories.id' );
		             }
		                     ] )
		             ->select( 'id', 'title' )
		             ->get();

		$v = [ ];
		$i = 0;
		foreach ( $posts as $k => $p ) {
			$lst[] = '<strong>' . $p->title . '</strong>';
			$i ++;
			foreach ( $p->categories as $c ) {
				$lst[] = $c->title . '';
				$i ++;
			}
			$lst[ $i - 1 ] .= '<br>';
			//$lst[]='<br>'.$i;
		}

		//echo $i;
		return $lst;
	}
}
