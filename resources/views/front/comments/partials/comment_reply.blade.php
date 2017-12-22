@unless ($comment->isLeaf())
    @php
        $level++;
    @endphp
    <ul class="children">
        @include('front/comments/comments', ['comments' => $comment->getImmediateDescendants()])
    </ul>
@endunless
