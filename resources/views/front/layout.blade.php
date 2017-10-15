<!DOCTYPE html>
<!--[if IE 8 ]><html class="no-js oldie ie8" lang="en"> <![endif]-->
<!--[if IE 9 ]><html class="no-js oldie ie9" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html class="no-js" lang="{{ config('app.locale') }}"> <!--<![endif]-->
<head>

	<!--- basic page needs
	================================================== -->
	<meta charset="utf-8">
	<title>{{ isset($post) && $post->seo_title ? $post->seo_title :  __(lcfirst('Title')) }}</title>
	<meta name="description" content="{{ isset($post) && $post->meta_description ? $post->meta_description : __('description') }}">
	<meta name="author" content="@lang(lcfirst ('Author'))">
	@if(isset($post) && $post->meta_keywords)
		<meta name="keywords" content="{{ $post->meta_keywords }}">
	@endif
    <meta name="csrf-token" content="{{ csrf_token() }}">

	<!-- mobile specific metas
	================================================== -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	<!-- CSS
	================================================== -->
	<link rel="stylesheet" href="{{ asset('css/base.css') }}">
	<link rel="stylesheet" href="{{ asset('css/vendor.css') }}">
	<link rel="stylesheet" href="{{ asset('css/main.css') }}">
	@yield('css')

	<style>
		.search-wrap .search-form::after {
			content: "@lang('Press Enter to begin your search.')";
		}
	</style>


	<!-- script
	================================================== -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/pace.min.js"></script>

	<!-- favicons
	================================================== -->
	<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
	<link rel="icon" href="favicon.ico" type="image/x-icon">

</head>

<body id="top">

	<!-- header
   ================================================== -->
   <header class="short-header">

   	<div class="gradient-block"></div>

   	<div class="row header-content">

   		<div class="logo">
	    	<a href="{{ url('') }}">Author</a>
	    </div>

	   	<nav id="main-nav-wrap">
			<ul class="main-navigation sf-menu">
				<li {{ currentRoute('home') }}>
					<a href="{{ route('home') }}">@lang('Home')</a>
				</li>
				<li class="has-children">
					<a href="#">@lang('Categories')</a>
					<ul class="sub-menu">
						@foreach ($categories as $category)
							<li><a href="{{ route('category', [$category->slug ]) }}">{{ $category->title }}</a></li>
						@endforeach
					</ul>
				</li>
				@guest
					<li {{ currentRoute('contacts.create') }}>
						<a href="{{ route('contacts.create') }}">@lang('Contact')</a>
					</li>
				@endguest
				@request('register')
					<li class="current">
						<a href="{{ request()->url() }}">@lang('Register')</a>
					</li>
				@endrequest
				@request('password/email')
					<li class="current">
						<a href="{{ request()->url() }}">@lang('Forgotten password')</a>
					</li>
				@else
					@guest
						<li {{ currentRoute('login') }}>
							<a href="{{ route('login') }}">@lang('Login')</a>
						</li>
						@request('password/reset')
							<li class="current">
								<a href="{{ request()->url() }}">@lang('Password')</a>
							</li>
						@endrequest
						@request('password/reset/*')
							<li class="current">
								<a href="{{ request()->url() }}">@lang('Password')</a>
							</li>
						@endrequest
					@else
						@admin
							<li>
								<a href="{{ url('admin') }}">@lang('Administration')</a>
							</li>
						@endadmin
						@redac
							<li>
								<a href="{{ url('admin/posts') }}">@lang('Administration')</a>
							</li>
						@endredac
						<li>
							<a id="logout" href="{{ route('logout') }}">@lang('Logout')</a>
							<form id="logout-form" action="{{ route('logout') }}" method="POST" class="hide">
								{{ csrf_field() }}
							</form>
						</li>
					@endguest
				@endrequest
			</ul>
		</nav> <!-- end main-nav-wrap -->

		<div class="search-wrap">
			<form role="search" method="get" class="search-form" action="{{ route('posts.search') }}">
				<label>
					<input type="search" class="search-field" placeholder="@lang('Type Your Keywords')"  name="search" autocomplete="off" required>
				</label>
				<input type="submit" class="search-submit" value="">
			</form>

			<a href="#" id="close-search" class="close-btn">Close</a>

		</div> <!-- end search wrap -->

		<div class="triggers">
			<a class="search-trigger" href="#"><i class="fa fa-search"></i></a>
			<a class="menu-toggle" href="#"><span>Menu</span></a>
		</div> <!-- end triggers -->

   	</div>

   </header> <!-- end header -->

   @yield('main')

   <!-- footer
   ================================================== -->
   <footer>

   	<div class="footer-main">

   		<div class="row">

	      	<div class="col-six tab-full mob-full footer-info">

	            <h4>@lang('About Our Site')</h4>

	               <p>@lang('Lorem ipsum Ut velit dolor Ut labore id fugiat in ut fugiat nostrud qui in dolore commodo eu magna Duis cillum dolor officia esse mollit proident Excepteur exercitation nulla. Lorem ipsum In reprehenderit commodo aliqua irure labore.')</p>

		      </div> <!-- end footer-info -->

	      	<div class="col-three tab-1-2 mob-1-2 site-links">

	      		<h4>@lang('Site Links')</h4>

	      		<ul>
				  	<li><a href="#">@lang('About us')</a></li>
					<li><a href="{{ url('') }}">@lang('Blog')</a></li>
					<li><a href="{{ route('contacts.create') }}">@lang('Contact')</a></li>
					<li><a href="#">@lang('Privacy Policy')</a></li>
				</ul>

	      	</div> <!-- end site-links -->

	      	<div class="col-three tab-1-2 mob-1-2 social-links">

	      		<h4>@lang('Social')</h4>

	      		<ul>
	      			<li><a href="#">Twitter</a></li>
					<li><a href="#">Facebook</a></li>
					<li><a href="#">Dribbble</a></li>
					<li><a href="#">Google+</a></li>
					<li><a href="#">Instagram</a></li>
				</ul>

	      	</div> <!-- end social links -->

	      </div> <!-- end row -->

   	</div> <!-- end footer-main -->

      <div class="footer-bottom">
      	<div class="row">

      		<div class="col-twelve">
	      		<div class="copyright">
		         	<span>© Copyright Abstract 2016</span>
		         	<span>Design by <a href="http://www.styleshout.com/">styleshout</a></span>
		         </div>

		         <div id="go-top">
		            <a class="smoothscroll" title="Back to Top" href="#top"><i class="icon icon-arrow-up"></i></a>
		         </div>
	      	</div>

      	</div>
      </div> <!-- end footer-bottom -->

   </footer>

   <div id="preloader">
    	<div id="loader"></div>
   </div>

   <!-- Java Script
   ================================================== -->
   <script src="https://code.jquery.com/jquery-3.2.0.min.js"></script>
   <script src="{{ asset('js/plugins.js') }}"></script>
   <script src="{{ asset('js/main.js') }}"></script>
   <script>
	   $(function() {
		   $('#logout').click(function(e) {
			   e.preventDefault();
			   $('#logout-form').submit()
		   })
	   })
   </script>

   @yield('scripts')

</body>

</html>
