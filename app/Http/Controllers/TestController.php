<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;

class TestController extends Controller {

	protected $postRepository;

	public function index()
	{


		if ( isset( $v ) ) {
			debug( $v );
		}

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
			             $query->orderBy( 'categories.title' );
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
				$lst[] = $c->title . ' ( ' . $c->slug . ' )';
				$i ++;
			}
			$lst[ $i - 1 ] .= '<br>';
			//$lst[]='<br>'.$i;
		}

		//echo $i;
		return $lst;
	}

	public function attachDetachSync()
	{


		$p = Post::find( 1 );
		echo $p->title . '<br>';


		foreach ( $p->categories as $c ) {
			echo $c->title . '<br>';
		}


		$c_id = Category::whereId( 2 )->first()->id;
		//$c_id = Category::whereId( 1 )
		//->select ('id');

		debug( $c_id );

		//$p->categories()->attach( $c_id );
		//$p->categories()->attach( [1,3] );
		//$p->categories()->detach( $c_id );
		//$p->categories()->detach( 2 );
		//$p->categories()->sync([1,3]);  Attach 1 et 3 détache tous les autres
		//$p->categories()->sync([]); // Détache tout
		//$p->categories()->syncWithoutDetaching([2]);
		//$p->categories()->toggle([1,2]);


	}
}
