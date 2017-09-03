@foreach($users as $user)
    <tr>
        <td>{{ $user->id }}</td>
        <td>{{ $user->name }}</td>
        <td>{{ $user->email }}</td>
        <td>
            @if($user->role === 'admin')
                Administrator
            @elseif($user->role === 'redac')
                Redactor
            @else
                User
            @endif
        </td>
        <td>
            <input type="checkbox" name="seen" value="{{ $user->id }}" {{ is_null($user->ingoing) ?  'disabled' : 'checked'}}>
        </td>
        <td>
            <span {!! $user->valid ? ' class="fa fa-check"' : '' !!}></span>
        </td>
        <td>
            <span {!! $user->confirmed ? ' class="fa fa-check"' : '' !!}></span>
        </td>
        <td>{{ $user->created_at->formatLocalized('%c') }}</td>
        <td><a class="btn btn-warning btn-xs btn-block" href="{{ route('users.edit', [$user->id]) }}" role="button" title="@lang('Edit')"><span class="fa fa-edit"></span></a></td>
        <td><a class="btn btn-danger btn-xs btn-block" href="{{ route('users.destroy', [$user->id]) }}" role="button" title="@lang('Destroy')"><span class="fa fa-remove"></span></a></td>
    </tr>
@endforeach

