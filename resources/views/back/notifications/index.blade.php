@extends('back.layout')

@section('css')
    <link rel="stylesheet" href="//cdn.jsdelivr.net/sweetalert2/6.3.8/sweetalert2.min.css">
@endsection

@section('main')

    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-body table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th>@lang('Post')</th>
                            <th>@lang('Author')</th>
                            <th>@lang('Date')</th>
                            <th>@lang('Valid')</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>@lang('Post')</th>
                            <th>@lang('Author')</th>
                            <th>@lang('Date')</th>
                            <th>@lang('Valid')</th>
                            <th></th>
                        </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($user->unreadNotifications as $notification)
                                <tr>
                                    @php $user = user($notification->data['user_id']) @endphp
                                    <td><a href="{{ route('posts.display', [$notification->data['slug']]) }}">{{ $notification->data['title'] }}</a></td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $notification->created_at->formatLocalized('%c') }}</td>
                                    <td><input type="checkbox" name="valid" {{ $user->valid ? 'checked' : '' }} disabled></td>
                                    <td>
                                        <form action="{{ route('notifications.update', [$notification->id]) }}" method="POST">
                                            {{ csrf_field() }}
                                            {{ method_field('PUT') }}
                                            <input type="submit" class="btn btn-success btn-xs btn-block" value="@lang('Mark as read')">
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- /.box -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->

@endsection
