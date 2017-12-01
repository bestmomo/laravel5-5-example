<div class="comment-text">
    <p id="comment-body{{ $comment->id }}">{{ $comment->body }}</p>

    @if(Auth::check() && Auth::user()->name == $comment->user->name)
        <form id="comment-form{{ $comment->id }}" method="post" action="{{ route('comments.update', [$comment->id]) }}" class="comment-form hide">
            {{ csrf_field() }}
            <div class="form-field">
                <strong class="red"></strong>
                <textarea title="message" name="message{{ $comment->id }}" id="message{{ $comment->id }}" class="full-width" required></textarea>
            </div>
            <button id="comment-escape{{ $comment->id }}" class="btnescape">@lang('Escape')</button>
            <button type="submit" class="submit button-primary">@lang('Submit')</button>
        </form>
    @endif
</div>
