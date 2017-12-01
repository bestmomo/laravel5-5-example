<li>
    <div class="avatar">
        <img width="50" height="50" class="avatar" src="{{ Gravatar::get($comment->user->email) }}" alt="">
    </div>

    <div class="comment-content">

        <div class="comment-info">
            @include('front.comments.partials.comment_info')
            @include('front.comments.partials.comment_meta')
        </div>

        @include('front.comments.partials.comment_text')

        @include('front.comments.partials.comment_reply')

    </div>
</li>
