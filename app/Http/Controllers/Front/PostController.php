<?php

namespace App\Http\Controllers\Front;

//use DB;
use \App\Models\Tag;
use App\Models\User;
use \App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use \App\Repositories\PostRepository;
use \App\Http\Requests\SearchRequest;

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
	public function __construct( PostRepository $postRepository )
	{
		$this->postRepository = $postRepository;
		$this->nbrPages       = config( 'app.nbrPages.front.posts' );
	}

	/**
	 * Display a listing of the posts.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		//$posts = $this->postRepository->getActiveOrderByDate( $this->nbrPages );
		//
		//return view( 'front.index', compact( 'posts' ) );


		//$users = DB::table( 'users' )
		//	->select( 'id', 'name', 'email' )
		//	->latest( 'id' )
		//	->take( 3 )
		//	->get();


		//$users = DB::table( 'users' )
		//           ->Having( 'id', '%', 2 )
		//           ->select( 'id', 'email' )
		//           ->get();

		//
		// $users = DB::select( 'select id, name, email from users where not id%2 order by id' );
		//


		//$monRedaco = User::find( 2 );
		//$monRedaco->email='Redac@la.fr';
		//$monRedaco->save();


		//echo User::find(3)->posts[0]->title;


		// $users = User::has( 'posts' )->get();


		$users = User::take(2)->get();



		//
		//echo '<pre>';
		//	//var_dump( $users );
		//echo '</pre>';
		//


		//foreach ( $users as $user ) {
		//	echo '<strong>' . $user->name . '</strong><br>';
		//	foreach ( $user->posts as $post ) {
		//		echo $post->title . '<br>';
		//	}
		//}
		return view( 'front.listdo', compact( 'users' ) );
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
}
