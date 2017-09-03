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
                    <div class="alert-box ss-notice hideit">
                        <p>@lang('You have forgotten your password, dont mind ! You can create a new one. But for your own security we want to be sure of your identity. So send us your email by filling this form. You will get a message with instruction to create your new password.')</p>
                        <i class="fa fa-times close"></i>
                    </div>
                    <h3>@lang('Reset Password')</h3>
                    <form role="form" method="POST" action="{{ route('password.email') }}">
                        {{ csrf_field() }}
                        @if ($errors->has('email'))
                            @component('front.components.error')
                                {{ $errors->first('email') }}
                            @endcomponent
                        @endif   
                        <input id="email" type="email" placeholder="@lang('Email')" class="full-width" name="email" value="{{ old('email') }}" required>
                        <input class="button-primary full-width-on-mobile" type="submit" value="@lang('Send Password Reset Link')">
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
