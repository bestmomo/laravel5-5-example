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