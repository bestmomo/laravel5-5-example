@extends('back.layout')

@section('css')

@endsection

@section('main')

    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            @if (session('user-updated'))
                @component('back.components.alert')
                    @slot('type')
                        success
                    @endslot
                    {!! session('user-updated') !!}
                @endcomponent
            @endif
            <!-- general form elements -->
            <div class="box box-primary">
                <!-- form start -->
                <form role="form" method="POST" action="{{ route('users.update', [$user->id]) }}">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}
                    <div class="box-body">
                        <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                            <label for="name">@lang('Name')</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $user->name) }}" required>
                            {!! $errors->first('name', '<small class="help-block">:message</small>') !!}
                        </div>
                        <div class="form-group {{ $errors->has('email') ? 'has-error' : ''}}">
                            <label for="email">@lang('Email')</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $user->email) }}" required>
                            {!! $errors->first('email', '<small class="help-block">:message</small>') !!}
                        </div>
                        <div class="form-group">
                            <label for="role">@lang('Role')</label>
                            <select class="form-control" name="role" id="role">
                                <option value="admin" {{ old('role', $user->role) === 'admin' ? 'selected' : '' }}>@lang('Administrator')</option>
                                <option value="redac" {{ old('role', $user->role) === 'redac' ? 'selected' : '' }}>@lang('Redactor')</option>
                                <option value="user" {{ old('role', $user->role) === 'user' ? 'selected' : '' }}>@lang('User')</option>
                            </select>
                        </div>
                        @if ($user->ingoing)
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="new" checked> @lang('New')
                                </label>
                            </div>
                        @endif
                        @if ($user->confirmed)
                            <p><span class="badge bg-green">@lang('Confirmed')</span></p>
                        @else
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="confirmed" {{ old('confirmed') ? 'checked' : ''}}> @lang('Confirmed')
                                </label>
                            </div>
                        @endif
                        @if ($user->valid)
                            <p><span class="badge bg-green">@lang('Valid')</span></p>
                        @else
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="valid" {{ old('valid') ? 'checked' : ''}}> @lang('Valid')
                                </label>
                            </div>
                        @endif
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary">@lang('Submit')</button>
                    </div>
                </form>
            </div>
            <!-- /.box -->
        </div>
        <!--/.col (right) -->
    </div>
    <!-- /.row -->
@endsection

