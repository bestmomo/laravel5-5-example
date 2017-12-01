@extends('front.layout')

@section('css')
    @if (Auth::check())
        <link rel="stylesheet" href="//cdn.jsdelivr.net/sweetalert2/6.3.8/sweetalert2.min.css">
    @endif
@endsection

@section('main')

   <!-- content
   ================================================== -->
   <section id="content-wrap" class="blog-single">
   	<div class="row">
   		<div class="col-twelve">

   			@include('front._post.article', ['post' => $post])

		</div> <!-- end col-twelve -->
   	</div> <!-- end row -->

	<div class="comments-wrap">
		<div id="comments" class="row">
            @if (session('warning'))
                @component('front.components.alert')
                    @slot('type')
                        notice
                    @endslot
                    {!! session('warning') !!}
                @endcomponent
            @endif
            <h3>{{ $post->valid_comments_count }} {{ trans_choice(__('comment|comments'), $post->valid_comments_count) }}</h3>

			<!-- commentlist -->
        @include('front._post.comment_list')

	    @include('front._post.respond')

		</div> <!-- end row comments -->
	</div> <!-- end comments-wrap -->

   </section> <!-- end content -->

@endsection

@section('scripts')
    @include('front._post.js')
@endsection
