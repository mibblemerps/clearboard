<!DOCTYPE html>
<html>
    <head>
        <title>{{ \App\Facades\Settings::get('clearboard.sitename') }} - @yield('title')</title>

        <link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/normalize/3.0.3/normalize.min.css">
        <link rel="stylesheet" type="text/css" href="{{ theme_asset('css/main.css') }}">

        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0-alpha1/jquery.min.js" type="text/javascript"></script>
        <script src="{{ theme_asset('js/main.js') }}"></script>

        <script type="text/javascript">
            window.clearboard = {
                basePath: "{{ url() }}",
                isLoggedIn: {{ Auth::check() ? 'true' : 'false' }},
                csrfToken: "{{ csrf_token() }}"
            };
        </script>

        @yield('head')
    </head>
    <body>
        <div id="cover"></div>

        <div class="promptbox" id="promptbox">
            <div class="promptbox-header">Prompt Header</div>
            <p class="promptbox-message">Prompt Body</p>
            <div class="promptbox-buttons"></div>
        </div>

        <div id="header">
            <div class="content-width">
                <a href="{{ url('/') }}"><img src="{{ asset('header.png') }}" alt="{{ config('clearboard.sitename') }}" id="header-img"></a>
                <div class="header-right">
                    <div class="header-right-inner">
                        <div id="userbox" class="{{ Auth::check() ? 'userbox-loggedin' : 'userbox-notloggedin' }}">
                            @if (Auth::check())
                                <img id="userbox-useravatar" alt="Mitchfizz05"
                                    src="{{ Auth::user()->getAvatarUrl() }}">
                                <span id="userbox-name">{{ Auth::user()->name }}</span>
                                <div id="userbox-dropdown">
                                    <a href="{{ Auth::user()->getProfileUrl() }}"><div class="userbox-dropdown-item">My Profile</div></a>
                                    <a href="{{ url('/settings') }}"><div class="userbox-dropdown-item">My Settings</div></a>
                                    <div class="userbox-dropdown-item">Support</div>
                                    <a href="{{ url('/auth/logout/?_token=' . csrf_token()) }}"><div class="userbox-dropdown-item userbox-dropdown-item-warning">Logout</div></a>
                                </div>
                            @else
                                <span class="vertical-align"></span>
                                <span class="button button-green" id="loginbtn">Login</span>
                                <span class="userbox-or">or</span>
                                <a href="{{ url('/register') }}"><span class="button button-green" id="registerbtn">Register</span></a>
                                <div id="userbox-dropdown">
                                    <div id="login-loading" style="display:none;">
                                        <div class="la-ball-scale-pulse"><div></div><div></div></div>
                                    </div>
                                    <form id="loginform" class="ajaxform" action="{{ url('/auth/login') }}" method="POST">
                                        {!! csrf_field() !!}
                                        <input type="text" class="input-field" id="login-username" name="username" placeholder="Username"><br>
                                        <input type="password" class="input-field" id="login-password" name="password" placeholder="Password"><br>
                                        <input type="submit" id="login-button" class="button" value="Login">
                                    </form>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="wrapper">
            @yield('content')
        </div>
        <footer>
            @include('clearboard.common.footer')
        </footer>

        <!-- Low priority assets -->
        <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery.form/3.51/jquery.form.min.js"></script>
        <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Source+Sans+Pro:400,200,300|Open+Sans:400,700|Lato">
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="{{ theme_asset('libs/load-awesome/css/ball-scale-pulse.min.css') }}">
    </body>
</html>