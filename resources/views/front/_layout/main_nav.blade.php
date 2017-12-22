<nav id="main-nav-wrap">
    <ul class="main-navigation sf-menu">
        <li {{ currentRoute('home') }}>
            <a href="{{ route('home') }}">@lang('Home')</a>
        </li>
        <li class="has-children">
            <a href="#">@lang('Categories')</a>
            <ul class="sub-menu">
                @foreach ($categories as $category)
                    <li><a href="{{ route('category', [$category->slug ]) }}">{{ $category->title }}</a></li>
                @endforeach
            </ul>
        </li>
        @guest
            <li {{ currentRoute('contacts.create') }}>
                <a href="{{ route('contacts.create') }}">@lang('Contact')</a>
            </li>
        @endguest
        @request('register')
        <li class="current">
            <a href="{{ request()->url() }}">@lang('Register')</a>
        </li>
        @endrequest
        @request('password/email')
        <li class="current">
            <a href="{{ request()->url() }}">@lang('Forgotten password')</a>
        </li>
        @else
            @guest
                <li {{ currentRoute('login') }}>
                    <a href="{{ route('login') }}">@lang('Login')</a>
                </li>
                @request('password/reset')
                <li class="current">
                    <a href="{{ request()->url() }}">@lang('Password')</a>
                </li>
                @endrequest
                @request('password/reset/*')
                <li class="current">
                    <a href="{{ request()->url() }}">@lang('Password')</a>
                </li>
                @endrequest
                @else
                    @admin
                    <li>
                        <a href="{{ url('admin') }}">@lang('Administration')</a>
                    </li>
                    @endadmin
                    @redac
                    <li>
                        <a href="{{ url('admin/posts') }}">@lang('Administration')</a>
                    </li>
                    @endredac
                    <li>
                        <a id="logout" href="{{ route('logout') }}">@lang('Logout')</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hide">
                            {{ csrf_field() }}
                        </form>
                    </li>
                    @endguest
                    @endrequest
    </ul>
</nav> <!-- end main-nav-wrap -->