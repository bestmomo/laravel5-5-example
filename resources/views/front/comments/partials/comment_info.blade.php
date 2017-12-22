<cite>{{ $comment->user->name }}</cite>

@if(Auth::check() && Auth::user()->name == $comment->user->name)
    <a href="#" class="deletecomment">
        <span class="fa fa-fw fa-trash fa-lg  pull-right" title="@lang('Delete comment')"></span>
    </a>
    <form action="{{ route('front.comments.destroy', [$comment->id]) }}" method="POST" class="hide">
        {{ csrf_field() }}
        {{ method_field('DELETE') }}
    </form>
    <a id="comment-edit{!! $comment->id !!}" href="#" class="editcomment">
        <span class="fa fa-fw fa-pencil fa-lg pull-right" title="@lang('Edit comment')"></span>
    </a>
@endif