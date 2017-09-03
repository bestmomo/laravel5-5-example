@foreach($posts as $post)
    <tr>
        <td>{{ $post->title }}</td>
        <td><img src="{{ thumb($post->image) }}" alt=""></td>
        <td>
            <input type="checkbox" name="status" value="{{ $post->id }}" {{ $post->active ? 'checked' : ''}}>
        </td>
        <td>{{ $post->created_at->formatLocalized('%c') }}</td>
        <td>
            <input type="checkbox" name="seen" value="{{ $post->id }}" {{ is_null($post->ingoing) ?  'disabled' : 'checked'}}>
        </td>
        <td>{{ $post->seo_title }}</td>
        <td><a class="btn btn-success btn-xs btn-block" href="{{ route('posts.show', [$post->id]) }}" role="button" title="@lang('Show')"><span class="fa fa-eye"></span></a></td>
        <td><a class="btn btn-warning btn-xs btn-block" href="{{ route('posts.edit', [$post->id]) }}" role="button" title="@lang('Edit')"><span class="fa fa-edit"></span></a></td>
        <td><a class="btn btn-danger btn-xs btn-block" href="{{ route('posts.destroy', [$post->id]) }}" role="button" title="@lang('Destroy')"><span class="fa fa-remove"></span></a></td>
    </tr>
@endforeach

