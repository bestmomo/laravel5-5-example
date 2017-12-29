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

   			<article class="format-standard">

   				<div class="content-media">
					<div class="post-thumb">
						<img src="{{ $post->image }}">
					</div>
				</div>

				<div class="primary-content">

					<h1 class="page-title">{{ $post->title }}</h1>

					<ul class="entry-meta">
						<li class="date">{{ ucfirst (utf8_encode ($post->created_at->formatLocalized('%A %d %B %Y'))) }}</li>
                        <li class="cat">
                            @foreach ($post->categories as $category)
                                <a href="{{ route('category', [$category->slug]) }}">{{ $category->title }}</a>
                            @endforeach
                        </li>
					</ul>

					{!! $post->body !!}

                    <!-- Tags -->
					@if ($post->tags->count())
						<p class="tags">
							<span>@lang('Tagged in') :</span>
							@foreach($post->tags as $tag)
								<a href="{{ route('posts.tag', [$tag->id]) }}">{{ $tag->tag }}</a>
							@endforeach
						</p>
					@endif

					<div class="author-profile">
						<img src="{{ Gravatar::get($post->user->email) }}" alt="">
						<div class="about">
							<h4>{{ $post->user->name }}</h4>
						</div>
					</div> <!-- end author-profile -->

				</div> <!-- end entry-primary -->

				<div class="pagenav group">
					@if ($post->previous)
						<div class="prev-nav">
							<a href="{{ url('posts/' . $post->previous->slug) }}" rel="prev">
								<span>@lang('Previous')</span>
								{{ $post->previous->title }}
							</a>
						</div>
					@endif
					@if ($post->next)
						<div class="next-nav">
							<a href="{{ url('posts/' . $post->next->slug) }}" rel="next">
								<span>@lang('Next')</span>
								{{ $post->next->title }}
							</a>
						</div>
					@endif
				</div>

			</article>

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
			@if ($post->valid_comments_count)
                @php
                    $level = 0;
                @endphp
				<ol class="commentlist">
					@include('front/comments/comments', ['comments' => $post->parentComments])
				</ol>
                @if ($post->parent_comments_count > config('app.numberParentComments'))
                    <p id="morebutton" class="text-center">
                        <a id="nextcomments" href="{{ route('posts.comments', [$post->id, 1]) }}" class="button">@lang('More comments')</a>
                    </p>
                        <p id="moreicon" class="text-center hide">
                        <span class="fa fa-spinner fa-pulse fa-3x fa-fw"></span>
                    </p>
                @endif
			@endif

			<!-- respond -->
			<div class="respond">

			    <h3>@lang('Leave a Comment')</h3>
                @if (Auth::check())
    				<form method="post" action="{{ route('posts.comments.store', [$post->id]) }}">
                        {{ csrf_field() }}
    					<div class="message form-field">
                            @if ($errors->has('message'))
                                @component('front.components.error')
                                    {{ $errors->first('message') }}
                                @endcomponent
                            @endif
    						<textarea name="message" id="message" class="full-width" placeholder="@lang('Your message')" value="{{ old('message') }}" required></textarea>
    					</div>
    					<button type="submit" class="submit button-primary">@lang('Submit')</button>
    				</form>
                @else
                    <em>@lang('You must be logged to add a comment !')</em>
                @endif

			</div> <!-- Respond End -->

		</div> <!-- end row comments -->
	</div> <!-- end comments-wrap -->

   </section> <!-- end content -->

@endsection

@section('scripts')
    @if (auth()->check())
        <script src="//cdn.jsdelivr.net/sweetalert2/6.3.8/sweetalert2.min.js"></script>
        <script>

            var post = (function () {

                var onReady = function () {
                    $('body').on('click', 'a.deletecomment', deleteComment)
                        .on('click', 'a.editcomment', editComment)
                        .on('click', '.btnescape', escapeComment)
                        .on('submit', '.comment-form', submitComment)
                        .on('click', 'a.reply', replyCreation)
                        .on('click', '.btnescapereply', escapeReply)
                        .on('submit', '.reply-form', submitReply)
                }

                var toggleEditControls = function (id) {
                    $('#comment-edit' + id).toggle()
                    $('#comment-body' + id).toggle('slow')
                    $('#comment-form' + id).toggle('slow')
                }

                // Delete comment
                var deleteComment = function (event) {
                    event.preventDefault()
                    var that = $(this)
                    swal({
                        title: "{!! __('Really delete this comment ?') !!}",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "{!! __('Yes') !!}",
                        cancelButtonText: "{!! __('No') !!}"
                    }).then(function () {
                        that.next('form').submit()
                    })
                }

                // Set comment edition
                var editComment = function (event) {
                    event.preventDefault()
                    var i = $(this).attr('id').substring(12);
                    $('form.comment-form textarea#message' + i).val($('#comment-body' + i).text())
                    toggleEditControls(i)
                }

                // Escape comment edition
                var escapeComment = function (event) {
                    event.preventDefault()
                    var i = $(this).attr('id').substring(14)
                    toggleEditControls(i)
                    $('form.comment-form textarea#message' + i).prev().text('')
                }

                // Submit comment
                var submitComment = function (event) {
                    event.preventDefault();
                    $.ajax({
                        method: 'put',
                        url: $(this).attr('action'),
                        data: $(this).serialize()
                    })
                        .done(function (data) {
                            $('#comment-body' + data.id).text(data.message)
                            toggleEditControls(data.id)
                        })
                        .fail(function(data) {
                            var errors = data.responseJSON
                            $.each(errors, function(index, value) {
                                value = value[0].replace(index, '@lang('message')')
                                $('form.comment-form textarea[name="' + index + '"]').prev().text(value)
                            });
                        });
                }

                // Set reply creation
                var replyCreation = function (event) {
                    event.preventDefault()
                    var i = $(this).attr('id').substring(12)
                    $('form.reply-form textarea#message' + i).val('')
                    $('#reply-form' + i).toggle('slow')
                }

                // Escape reply creation
                var escapeReply = function (event) {
                    event.preventDefault()
                    var i = $(this).attr('id').substring(12)
                    $('#reply-form' + i).toggle('slow')
                }

                // Submit reply
                var submitReply = function (event) {
                    event.preventDefault()
                    $.ajax({
                        method: 'post',
                        url: $(this).attr('action'),
                        data: $(this).serialize()
                    })
                        .done(function (data) {
                            document.location.reload(true)
                        })
                        .fail(function(data) {
                            var errors = data.responseJSON
                            $.each(errors, function(index, value) {
                                value = value[0].replace(index, '@lang('message')')
                                $('form.reply-form textarea[name="' + index + '"]').prev().text(value)
                            });
                        });
                }

                return {
                    onReady: onReady
                }

            })()

            $(document).ready(post.onReady)

        </script>
    @endif

    <script>
        $(function() {
            // Get next comments
            $('#nextcomments').click (function(event) {
                event.preventDefault()
                $('#morebutton').hide()
                $('#moreicon').show()
                $.get($(this).attr('href'))
                .done(function(data) {
                    $('ol.commentlist').append(data.html)
                    if(data.href !== 'none') {
                        $('#nextcomments').attr('href', data.href)
                        $('#morebutton').show()
                    }
                    $('#moreicon').hide()
                })
            })
        })
    </script>
@endsection
