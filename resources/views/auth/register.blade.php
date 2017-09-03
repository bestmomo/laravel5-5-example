@extends('front.layout')

@section('main')
   <section id="content-wrap">
        <div class="row">
            <div class="col-twelve">
                <div class="primary-content">
                    @if (session('confirmation-success'))
                        @component('front.components.alert')
                            @slot('type')
                                success
                            @endslot
                            {!! session('confirmation-success') !!}
                        @endcomponent
                    @endif
                    <h3>@lang('Register')</h3>
                    <form role="form" method="POST" action="{{ route('register') }}">
                        {{ csrf_field() }}
                        @if ($errors->has('name'))
                            @component('front.components.error')
                                {{ $errors->first('name') }}
                            @endcomponent
                        @endif 
                        <input id="name" placeholder="@lang('Name')" type="text" class="full-width"  name="name" value="{{ old('name') }}" required autofocus>
                        @if ($errors->has('email'))
                            @component('front.components.error')
                                {{ $errors->first('email') }}
                            @endcomponent
                        @endif                       
                        <input id="email" placeholder="@lang('Email')" type="email" class="full-width"  name="email" value="{{ old('email') }}" required>
                        @if ($errors->has('password'))
                            @component('front.components.error')
                                {{ $errors->first('password') }}
                            @endcomponent
                        @endif 
                        <input id="password" placeholder="@lang('Password')" type="password" class="full-width"  name="password" required>
                        <input id="password-confirm" placeholder="@lang('Confirm your password')" type="password" class="full-width" name="password_confirmation" required>
                        <input class="button-primary full-width-on-mobile" type="submit" value="@lang('Register')">
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
