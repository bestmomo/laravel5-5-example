<!DOCTYPE html>
<!--[if IE 8 ]><html class="no-js oldie ie8" lang="en"> <![endif]-->
<!--[if IE 9 ]><html class="no-js oldie ie9" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html class="no-js" lang="{{ config('app.locale') }}"> <!--<![endif]-->
@include('front._layout.head')
<body id="top">

	<!-- header
   ================================================== -->
   <header class="short-header">

   	<div class="gradient-block"></div>

   	<div class="row header-content">

   		<div class="logo">
	    	<a href="{{ url('') }}">Author</a>
	    </div>

	   	@include('front._layout.main_nav')

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
	@include('front._layout.footer')

   <div id="preloader">
    	<div id="loader"></div>
   </div>

	@include('front._layout.js')
    @yield('scripts')

</body>

</html>
