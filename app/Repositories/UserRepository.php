<?php

namespace App\Repositories;

use App\Models\Post;
use App\Models\User;


class UserRepository {

	/**
	 * Get users collection paginate.
	 *
	 * @param  int   $nbrPages
	 * @param  array $parameters
	 *
	 * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
	 */
	public function getAll( $nbrPages, $parameters )
	{
		return User::with( 'ingoing' )
		           ->orderBy( $parameters['order'], $parameters['direction'] )
		           ->when( ( $parameters['role'] !== 'all' ), function ( $query ) use ( $parameters ) {
			           $query->whereRole( $parameters['role'] );
		           } )->when( $parameters['valid'], function ( $query ) {
				$query->whereValid( TRUE );
			} )->when( $parameters['confirmed'], function ( $query ) {
				$query->whereConfirmed( TRUE );
			} )->when( $parameters['new'], function ( $query ) {
				$query->has( 'ingoing' );
			} )->paginate( $nbrPages );
	}

	/**
	 * Update a user.
	 *
	 * @param  \App\Http\Requests\UserUpdateRequest $request
	 * @param  \App\Models\User                     $user
	 *
	 * @return void
	 */
	public function update( $request, $user )
	{
		$inputs = $request->all();

		if ( isset( $inputs['confirmed'] ) ) {
			$inputs['confirmed'] = TRUE;
		}

		if ( isset( $inputs['valid'] ) ) {
			$inputs['valid'] = TRUE;
		}

		$user->update( $inputs );

		if ( ! $request->has( 'new' ) && $user->ingoing ) {
			$user->ingoing->delete();
		}
	}

	public function getTitlesByDateDesc()
	{


		//$users = User::with( 'posts' )
		//             ->with( [ 'posts' => function ( $query ) {
		//	             $query->select( 'title' );
		//	             $query->latest();
		//             }
		//                     ] )
		//             ->withCount( 'posts' )
		//	           ->having( 'posts_count', '=', 1 )
		//             ->orderBy( 'name', 'asc' )
		//             ->get();
		//->select( 'id', 'name', 'email' )


		//$users = Post::select( 'title' )->get();

// Bonne joiture
//		$users = User::leftJoin( 'posts', 'posts.user_id', '=', 'users.id')
//			->select('users.id', 'email', 'name', 'posts.id as PostId', 'title' )
//			->get();


		// Optimale
		//$users = User::select()
		//	//->with( 'posts' )
		//	           ->select( 'users.id', 'email', 'name', 'posts.id as postId', 'title' )
		//             ->leftJoin( 'posts', 'posts.user_id', '=', 'users.id' )
		//             ->orderBy( 'name', 'asc' )
		//             ->withCount( 'posts' )
		//             ->having( 'posts_count', '>=', 1 )
		//             ->get();


		$users = User::with( 'posts' )
		             ->with( [ 'posts' => function ( $query ) {
			             $query->select( 'user_id', 'title', 'slug' );
			             $query->latest();
		             }
		                     ] )
		             ->select( 'id', 'name', 'email' )
		             ->withCount( 'posts' )
		             ->having( 'posts_count', '>', 0 )
		             ->orderBy( 'posts_count', 'desc' )
		             ->get();


		//$users = User::with( 'posts' )
		//             ->get();


		return $users;

//debug($u);

//$users->pop();
//echo $users[0]->posts[0]->title;
		//die ('oki<hr>');
//die();
//		return $users;

	}

}
