<div class="comment-meta">
    <time class="comment-time" datetime="{{ $comment->created_at }}">{{ $comment->created_at->formatLocalized('%A %d %B %Y') }}</time>
    @if(Auth::check() && $level < config('app.commentsNestedLevel'))
        <span class="sep">/</span><a id="reply-create{!! $comment->id !!}" class="reply" href="#">@lang('Reply')</a>
        <form id="reply-form{{ $comment->id }}" method="post" action="{{ route('posts.comments.comments.store', [$post->id, $comment->id]) }}" class="reply-form hide">
            {{ csrf_field() }}
            <div class="form-field">
                <strong class="red"></strong>
                <textarea name="message{{ $comment->id }}" id="message{{ $comment->id }}" placeholder="@lang('Your Reply')" class="full-width" required></textarea>
            </div>
            <button id="reply-escape{{ $comment->id }}" class="btnescapereply">@lang('Escape')</button>
            <button type="submit" class="submit button-primary">@lang('Submit')</button>
        </form>
    @endif
</div>