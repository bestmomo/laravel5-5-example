@foreach($categories as $category)
    <tr>
        <td>{{ $category->id }}</td>
        <td>{{ $category->title }}</td>
        <td>{{ $category->slug }}</td>
        <td>{{ $category->posts_count }}</td>
        <td><a class="btn btn-warning btn-xs btn-block" href="{{ route('categories.edit', [$category->id]) }}" role="button" title="@lang('Edit')"><span class="fa fa-edit"></span></a></td>
        <td><a class="btn btn-danger btn-xs btn-block" href="{{ route('categories.destroy', [$category->id]) }}" role="button" title="@lang('Destroy')"><span class="fa fa-remove"></span></a></td>
    </tr>
@endforeach

