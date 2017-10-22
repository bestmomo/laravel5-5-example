<?php

namespace App\Http\Controllers\Front;

use DB;
use \App\Models\Tag;
use App\Models\User;
use App\Models\Post;
use \App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use \App\Repositories\PostRepository;
use \App\Http\Requests\SearchRequest;
use Illuminate\Support\Collection;

use \App\Repositories\UserRepository;

class PostController extends Controller {
	/**
	 * The PostRepository instance.
	 *
	 * @var \App\Repositories\PostRepository
	 */
	protected $postRepository;

	/**
	 * The pagination number.
	 *
	 * @var int
	 */
	protected $nbrPages;

	/**
	 * Create a new PostController instance.
	 *
	 * @param  \App\Repositories\PostRepository $postRepository
	 *
	 * @return void
	 */
	public function __construct( UserRepository $userRepository, PostRepository $postRepository )
	{
		$this->postRepository = $postRepository;
		$this->nbrPages       = config( 'app.nbrPages.front.posts' );

		$this->userRepository = $userRepository;
	}

	/**
	 * Display a listing of the posts.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$posts = $this->postRepository->getActiveOrderByDate( $this->nbrPages );

		return view( 'front.index', compact( 'posts' ) );

	}

	/**
	 * Display a listing of the posts for the specified category.
	 *
	 * @param  \App\Models\Category $category
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function category( Category $category )
	{
		$posts = $this->postRepository->getActiveOrderByDateForCategory( $this->nbrPages, $category->slug );
		$info  = __( 'Posts for category: ' ) . '<strong>' . $category->title . '</strong>';

		return view( 'front.index', compact( 'posts', 'info' ) );
	}

	/**
	 * Display the specified post by slug.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @param  string                   $slug
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function show( Request $request, $slug )
	{
		$user = $request->user();

		debug($user);


		return view( 'front.post', array_merge( $this->postRepository->getPostBySlug( $slug ), compact( 'user' ) ) );
	}

	/**
	 * Get posts for specified tag
	 *
	 * @param  \App\Models\Tag $tag
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function tag( Tag $tag )
	{
		$posts = $this->postRepository->getActiveOrderByDateForTag( $this->nbrPages, $tag->id );
		$info  = __( 'Posts found with tag ' ) . '<strong>' . $tag->tag . '</strong>';

		return view( 'front.index', compact( 'posts', 'info' ) );
	}

	/**
	 * Get posts with search
	 *
	 * @param  \App\Http\Requests\SearchRequest $request
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function search( SearchRequest $request )
	{
		$search = $request->search;
		$posts  = $this->postRepository->search( $this->nbrPages, $search )->appends( compact( 'search' ) );
		$info   = __( 'Posts found with search: ' ) . '<strong>' . $search . '</strong>';

		return view( 'front.index', compact( 'posts', 'info' ) );
	}

	public function getTitlesEachAuthor()
	{


		$users = $this->getTitlesByDateDesc();


		//$users = DB::table( 'users' )
		//	->select( 'id', 'name', 'email' )
		//	->latest( 'id' )
		//	->take( 3 )
		//	->get();


		//$users = DB::table( 'users' )
		//  ->Having( 'id', '%', 2 )
		//  ->select( 'id', 'email' )
		//  ->get();

		//
		// $users = DB::select( 'select id, name, email from users where not id%2 order by id' );
		//


		//$monRedaco = User::find( 2 );
		//$monRedaco->email='Redac@la.fr';
		//$monRedaco->save();


		//echo User::find(3)->posts[0]->title;


		// $users = User::has( 'posts' )->get();

		// 5 requêtes !!!
		//$users = User::has( 'posts' )->take( 2 )->get();
		//$users = User::take( 2 )->get();
		// Lazy loading (Chargement paresseux)

		// 2 requêtes (y) ( + classement ici par titre)
		//$users = User::with( ['posts'=> function ($query) {
		//	$query->latest('title');
		//}])->take( 2 )->get();
		// L'eager loading


		// Exemple avec tri + restrictions
		//$users = User::with( [ 'posts' => function ( $query ) {
		//	$query->where( 'title', 'like', '%ost%' );
		//	$query->latest( 'title' );
		//}
		//                     ] )
		//             ->where( 'id', '<', 3 )
		//             ->take( 5 )
		//             ->get();


		//echo '<pre>';
		//var_dump( $users );
		//echo '</pre>';


		//echo '<pre>';
		//var_dump( $users );
		//echo '</pre>';


		//foreach ( $users as $user ) {
		//	echo '<strong>' . $user->name . '</strong><br>';
		//	foreach ( $user->posts as $post ) {
		//		echo $post->title . '<br>';
		//	}
		//}


		/*
				$users = User::with( [ 'posts' => function ( $query ) {
					$query->where( 'title', 'like', '%ost%' );
					$query->latest( 'title' );
				}
														 ] )
										 ->where( 'id', '<', 30 )
										 ->take( 50 )
										 ->get();
		*/

		/*
				$users = \App\Models\User::has('posts')->get();
				foreach($users as $user) {
					echo $user->name . '<br>';
				}


			 // TOP Bonne requête
					$users = User::withCount( 'posts' )
											 ->with( [ 'posts' => function ( $query ) {
												 $query->latest();
											 }
															 ] )
											 ->having( 'posts_count', '>', 0 )
											 ->orderBy( 'name', 'asc' )
											 ->get();
			*/


		//->with( [ 'posts' =>
		//           function ( $q ) {
		//             $q->select( 'id', 'title' );
		//           }
		//        ] )

		/*
				$users = User::withCount( 'posts' )
										 ->with( [ 'posts' => function ( $query ) {
											 $query->latest();
										 }
														 ] )
										 ->having( 'posts_count', '>', 0 )
										 //->orderBy( 'posts.id', 'desc' )
										 ->get();*/


		//echo '<pre>';
		//var_dump( $users );
		//echo '</pre>';


		//echo $users->name . '<hr>';


		//$users=$users->toJson();


		//$tableMultiplication=Collection::times(12, function   ($i) {
		//	return $i. ' x 9 = ' . $i*9;
		//});


		//return $users;


		//->select( 'id', 'name', 'email', 'posts_count' )


		//echo '<pre>'; var_dump( $users ); echo '</pre>';

		//debug( $users );

//		$users=[];
		return view( 'front.listdo', compact( 'users' ) );

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
