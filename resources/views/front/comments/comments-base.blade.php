<li>
    <div class="avatar">
        <img width="50" height="50" class="avatar" src="{{ Gravatar::get($comment->user->email) }}" alt="">
    </div>

    <div class="comment-content">

        <div class="comment-info">
            <cite>{{ $comment->user->name }}</cite>

            @if(Auth::check() && Auth::user()->name == $comment->user->name)
                <a href="#" class="deletecomment"><span class="fa fa-fw fa-trash fa-lg  pull-right" title="@lang('Delete comment')"></span></a>
                <form action="{{ route('front.comments.destroy', [$comment->id]) }}" method="POST" class="hide">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                </form>
                <a id="comment-edit{!! $comment->id !!}" href="#" class="editcomment"><span class="fa fa-fw fa-pencil fa-lg pull-right" title="@lang('Edit comment')"></span></a>
            @endif

            <div class="comment-meta">
                <time class="comment-time" datetime="{{ $comment->created_at }}">{{ ucfirst (utf8_encode ($comment->created_at->formatLocalized('%A %d %B %Y'))) }}</time>
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
        </div>

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

        @unless ($comment->isLeaf())
            @php
                $level++;
            @endphp
            <ul class="children">
                @include('front/comments/comments', ['comments' => $comment->getImmediateDescendants()])
            </ul>
        @endunless

    </div>
</li>
