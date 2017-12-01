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

        @include('front._layout.search_form')

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
