@extends('back.layout')

@section('css')
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/bootstrap-slider/slider.css') }}">
@endsection

@section('main')
    <div class="row">
        <div class="col-md-12">
            @if ($errors->count())
                @component('back.components.alert')
                    @slot('type')
                        danger
                    @endslot
                    @lang('There is some validation issue...')
                @endcomponent
            @endif
            @if (session('ok'))
                @component('back.components.alert')
                    @slot('type')
                        success
                    @endslot
                    {!! session('ok') !!}
                @endcomponent
            @endif
            <div class="row">
                <div class="col-md-12">

                    <div class="nav-tabs-custom">
                        <ul class="nav nav-pills">
                            <li><a href="#tab_1" data-toggle="tab">@lang('Application')</a></li>
                            <li><a href="#tab_2" data-toggle="tab">@lang('Paginations')</a></li>
                            <li><a href="#tab_3" data-toggle="tab">@lang('Comments')</a></li>
                            <li><a href="#tab_4" data-toggle="tab">@lang('Database')</a></li>
                            <li><a href="#tab_5" data-toggle="tab">@lang('Mails')</a></li>
                        </ul>
                        <div class="tab-content">

                            @inject('envRepository', 'App\Repositories\EnvRepository')

                            <div class="tab-pane fade" id="tab_1">
                                <form method="post" action="{{ route('settings.update', ['page' => 1]) }}">
                                    {{ method_field('PUT') }}
                                    {{ csrf_field() }}
                                    @include('back.partials.input', [
                                        'input' => [
                                            'title' => __('Application name'),
                                            'name' => 'app_name',
                                            'value' => old('app_name', config('app.name')),
                                            'input' => 'text',
                                            'required' => true,
                                        ],
                                    ])
                                    @include('back.partials.input', [
                                        'input' => [
                                            'title' => __('Base URL'),
                                            'name' => 'app_url',
                                            'value' => old('app_url', $envRepository->get('APP_URL')),
                                            'input' => 'text',
                                            'required' => true,
                                        ],
                                    ])
                                    <div class="form-group">
                                        <label for="locale">@lang('Default language')</label>
                                        <select id="locale" name="locale" class="form-control">
                                            @foreach($locales as $id => $locale)
                                                <option value="{{ $id }}" {{ old('locale') ? ($id === old('locale') ? 'selected' : '') : $locale === $actualLocale ? 'selected' : '' }}>{{ $locale }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="timezone">@lang('Server timezone')</label>
                                        <select id="timezone" name="timezone" class="form-control">
                                            @foreach($timezones as $key =>$value)
                                                <option value="{{ $key }}" {{ old('timezone') ? ($id === old('timezone') ? 'selected' : '') : $key === $actualTimezone ? 'selected' : '' }}>{{ $key . ' - ' . $value}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="cache_driver">@lang('Cache driver')</label>
                                        <select id="cache_driver" name="cache_driver" class="form-control">
                                            @foreach($caches as $cache)
                                                <option value="{{ $cache }}" {{ old('mail_driver') ? ($cache === old('cache_driver') ? 'selected' : '') : $cache === $actualCacheDriver ? 'selected' : '' }}>{{ $cache }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <button class="btn btn-primary" type="submit">@lang('Submit')</button>
                                </form>
                            </div>

                            <div class="tab-pane fade" id="tab_2">
                                <form method="post" action="{{ route('settings.update', ['page' => 2]) }}">
                                    {{ method_field('PUT') }}
                                    {{ csrf_field() }}
                                    @include('back.partials.boxinput', [
                                         'box' => [
                                             'type' => 'box-warning',
                                             'title' => __('Front'),
                                         ],
                                         'input' => [
                                             'title' => __('Posts'),
                                             'name' => 'frontposts',
                                             'value' => old('frontposts', config('app.nbrPages.front.posts')),
                                             'input' => 'slider',
                                             'min' => 2,
                                             'max' => 16,
                                         ],
                                     ])
                                    @component('back.components.boxinputs')
                                        @slot('boxtype')
                                            warning
                                        @endslot
                                        @slot('boxtitle')
                                            @lang('Back')
                                        @endslot
                                        @include('back.partials.input', [
                                            'input' => [
                                                'title' => __('Posts'),
                                                'name' => 'backposts',
                                                'value' => old('backposts', config('app.nbrPages.back.posts')),
                                                'input' => 'slider',
                                                'min' => 2,
                                                'max' => 16,
                                            ],
                                        ])
                                        @include('back.partials.input', [
                                            'input' => [
                                                'title' => __('Users'),
                                                'name' => 'backusers',
                                                'value' => old('backusers', config('app.nbrPages.back.users')),
                                                'input' => 'slider',
                                                'min' => 2,
                                                'max' => 16,
                                            ],
                                        ])
                                        @include('back.partials.input', [
                                            'input' => [
                                                'title' => __('Comments'),
                                                'name' => 'backcomments',
                                                'value' => old('backcomments', config('app.nbrPages.back.comments')),
                                                'input' => 'slider',
                                                'min' => 2,
                                                'max' => 10,
                                            ],
                                        ])
                                        @include('back.partials.input', [
                                            'input' => [
                                                'title' => __('Contacts'),
                                                'name' => 'backcontacts',
                                                'value' => old('backcontacts', config('app.nbrPages.back.contacts')),
                                                'input' => 'slider',
                                                'min' => 2,
                                                'max' => 10,
                                            ],
                                        ])
                                    @endcomponent
                                    <button class="btn btn-primary" type="submit">@lang('Submit')</button>
                                </form>
                            </div>

                            <div class="tab-pane fade" id="tab_3">
                                <form method="post" action="{{ route('settings.update', ['page' => 3]) }}">
                                    {{ method_field('PUT') }}
                                    {{ csrf_field() }}
                                    @include('back.partials.input', [
                                        'input' => [
                                                'title' => __('Comments nested level'),
                                                'name' => 'backcommentsnestedlevel',
                                                'value' => old('backcommentsnestedlevel', config('app.commentsNestedLevel')),
                                                'input' => 'slider',
                                                'min' => 2,
                                                'max' => 10,
                                        ],
                                    ])
                                    @include('back.partials.input', [
                                        'input' => [
                                                'title' => __('Number of parent comments to see each time'),
                                                'name' => 'backcommentsparent',
                                                'value' => old('backcommentsparent', config('app.numberParentComments')),
                                                'input' => 'slider',
                                                'min' => 1,
                                                'max' => 10,
                                        ],
                                    ])
                                    <button class="btn btn-primary" type="submit">@lang('Submit')</button>
                                </form>
                            </div>

                            <div class="tab-pane fade" id="tab_4">
                                <h3 class="text-danger text-center">@lang('Be careful not to enter wrong parameters!')</h3>
                                <form id="formdatabase" method="post" action="{{ route('settings.update', ['page' => 4]) }}">
                                    {{ method_field('PUT') }}
                                    {{ csrf_field() }}
                                    <div class="form-group">
                                        <label for="db_connection">@lang('Connection')</label>
                                        <select id="db_connection" name="db_connection" class="form-control">
                                            @foreach($connections as $connection)
                                                <option value="{{ $connection }}" {{ old('db_connection') ? ($connection === old('db_connection') ? 'selected' : '') : $connection === $actualConnection ? 'selected' : '' }}>{{ $connection }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @include('back.partials.input', [
                                        'input' => [
                                            'title' => __('Host'),
                                            'name' => 'db_host',
                                            'value' => old('db_host', $envRepository->get('DB_HOST')),
                                            'input' => 'text',
                                            'required' => true,
                                        ],
                                    ])
                                    @include('back.partials.input', [
                                        'input' => [
                                            'title' => __('Port'),
                                            'name' => 'db_port',
                                            'value' => old('db_port', $envRepository->get('DB_PORT')),
                                            'input' => 'text',
                                            'required' => true,
                                        ],
                                    ])
                                    @include('back.partials.input', [
                                        'input' => [
                                            'title' => __('Database name'),
                                            'name' => 'db_database',
                                            'value' => old('db_database', $envRepository->get('DB_DATABASE')),
                                            'input' => 'text',
                                            'required' => true,
                                        ],
                                    ])
                                    @include('back.partials.input', [
                                        'input' => [
                                            'title' => __('User name'),
                                            'name' => 'db_username',
                                            'value' => old('db_username', $envRepository->get('DB_USERNAME')),
                                            'input' => 'text',
                                            'required' => true,
                                        ],
                                    ])
                                    @include('back.partials.input', [
                                        'input' => [
                                            'title' => __('Password'),
                                            'name' => 'db_password',
                                            'value' => old('db_password', $envRepository->get('DB_PASSWORD')),
                                            'input' => 'text',
                                            'required' => false,
                                        ],
                                    ])
                                    <button class="btn btn-primary" type="submit">@lang('Submit')</button>
                                </form>
                            </div>

                            <div class="tab-pane fade" id="tab_5">
                                <form method="post" action="{{ route('settings.update', ['page' => 5]) }}">
                                    {{ method_field('PUT') }}
                                    {{ csrf_field() }}
                                    @include('back.partials.input', [
                                        'input' => [
                                            'title' => __('Sender mail address'),
                                            'name' => 'mail_from_address',
                                            'value' => old('mail_from_address', $envRepository->get('MAIL_FROM_ADDRESS')),
                                            'input' => 'mail',
                                            'required' => true,
                                        ],
                                    ])
                                    @include('back.partials.input', [
                                        'input' => [
                                            'title' => __('Sender name'),
                                            'name' => 'mail_from_name',
                                            'value' => old('mail_from_name', $envRepository->get('MAIL_FROM_NAME')),
                                            'input' => 'text',
                                            'required' => true,
                                        ],
                                    ])
                                    <div class="form-group">
                                        <label for="mail_driver">@lang('Driver')</label>
                                        <select id="mail_driver" name="mail_driver" class="form-control">
                                            @foreach($drivers as $key => $value)
                                                <option value="{{ $key }}" {{ old('mail_driver') ? ($key === old('mail_driver') ? 'selected' : '') : $key === $actualDriver ? 'selected' : '' }}>{{ $value }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div id="smtp" @if (old('mail_driver', $actualDriver) === 'mail') style="display: none" @endif>
                                        @include('back.partials.input', [
                                            'input' => [
                                                'title' => __('Host'),
                                                'name' => 'mail_host',
                                                'value' => old('mail_host', $envRepository->get('MAIL_HOST')),
                                                'input' => 'text',
                                                'required' => true,
                                            ],
                                        ])
                                        @include('back.partials.input', [
                                            'input' => [
                                                'title' => __('Port'),
                                                'name' => 'mail_port',
                                                'value' => old('mail_port', $envRepository->get('MAIL_PORT')),
                                                'input' => 'text',
                                                'required' => false,
                                            ],
                                        ])
                                        @include('back.partials.input', [
                                            'input' => [
                                                'title' => __('User name'),
                                                'name' => 'mail_username',
                                                'value' => old('mail_username', $envRepository->get('MAIL_USERNAME')),
                                                'input' => 'mail',
                                                'required' => false,
                                            ],
                                        ])
                                        @include('back.partials.input', [
                                            'input' => [
                                                'title' => __('Password'),
                                                'name' => 'mail_password',
                                                'value' => old('mail_password', $envRepository->get('MAIL_PASSWORD')),
                                                'input' => 'text',
                                                'required' => false,
                                            ],
                                        ])
                                        @include('back.partials.input', [
                                            'input' => [
                                                'title' => __('Encryption'),
                                                'name' => 'mail_encryption',
                                                'value' => old('mail_encryption', $envRepository->get('MAIL_ENCRYPTION')),
                                                'input' => 'text',
                                                'required' => false,
                                            ],
                                        ])
                                    </div>
                                    <button class="btn btn-primary" type="submit">@lang('Submit')</button>
                                </form>
                            </div>
                        </div>
                        <!-- /.tab-content -->
                    </div>
                    <!-- nav-tabs-custom -->
                </div>
                <!-- /.col -->
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ asset('adminlte/plugins/bootstrap-slider/bootstrap-slider.js') }}"></script>
    <script>
        $(function() {
            $('.slider').slider()
            $('#mail_driver').change (function() {
                if ($(this).val() == 'smtp') {
                    $('#smtp').show().slow()
                } else {
                    $('#smtp').hide().slow()
                }
            })
            $('a[href="#tab_{{ setTabActive () }}"]').tab('show')
        })
    </script>
@endsection
