@extends('front.layout')

@section('main')
   <section id="content-wrap">
        <div class="row">
            <div class="col-twelve">
                <div class="primary-content">
                    @if (session('status'))
                        @component('front.components.alert')
                            @slot('type')
                                success
                            @endslot
                            <p>{{ session('status') }}</p>
                        @endcomponent
                    @endif
                    <h3>@lang('Reset Password')</h3>
                    <form role="form" method="POST" action="{{ route('password.request') }}">
                        {{ csrf_field() }}
                        <input type="hidden" name="token" value="{{ $token }}">
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
                        <input class="button-primary full-width-on-mobile" type="submit" value="@lang('Reset Password')">
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
