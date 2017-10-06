@foreach($comments as $comment)
<div class="box">
    <div class="box-body table-responsive">
        <table id="comments" class="table table-striped table-bordered">
            <thead>
            <tr>
                <th>@lang('Name')</th>
                <th>@lang('Email')</th>
                <th>@lang('Post')</th>
                <th>@lang('New')</th>
                <th>@lang('Valid')</th>
                <th>@lang('Creation')</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $comment->user->name }}</td>
                    <td>{{ $comment->user->email }}</td>
                    <td>
                        <a href="{{ route('posts.display', [$comment->post->slug ]) }}">{{ $comment->post->title }}</a>
                        <br><span class="badge">{{ $comment->post->comments_count }}</span>
                    </td>
                    <td>
                        <input type="checkbox" name="seen" value="{{ $comment->id }}" {{ is_null($comment->ingoing) ?  'disabled' : 'checked'}}>
                    </td>
                    <td>
                        <input type="checkbox" name="uservalid" value="{{ $comment->user->id }}" {{ $comment->user->valid ?  'checked disabled' : ''}}>
                    </td>
                    <td>{{ $comment->created_at->formatLocalized('%c') }}</td>
                    <td><a class="btn btn-danger btn-xs btn-block" href="{{ route('comments.destroy', [$comment->id]) }}" role="button" title="@lang('Destroy')"><span class="fa fa-remove"></span></a></td>
                </tr>
            </tbody>
        </table>
    </div>
    <!-- /.box-body -->
    <div id="message" class="box-footer">
        {{ $comment->body }}
    </div>
</div>
<!-- /.box -->
@endforeach
