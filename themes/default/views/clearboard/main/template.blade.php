<!DOCTYPE html>
<html>
    <head>
        <title>{{ config('clearboard.sitename') }} - @yield('title')</title>

        <link rel="stylesheet" type="text/css" href="{{ theme_asset('css/main.css') }}">

        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0-alpha1/jquery.min.js" type="text/javascript"></script>
        <script src="{{ theme_asset('js/main.js') }}"></script>

        <script type="text/javascript">
            window.isLoggedIn = {{ Auth::check() ? 'true' : 'false' }};
        </script>

        @yield('head')
    </head>
    <body>
        <div id="header">
            <div class="content-width">
                <img src="{{ asset('header.png') }}" alt="{{ config('clearboard.sitename') }}" id="header-img">
                <div id="header-rightside">
                    <div id="header-rightside-inner">
                        <div id="userbox" class="{{ Auth::check() ? 'userbox-loggedin' : 'userbox-notloggedin' }}">
                            @if (Auth::check())
                                <img id="userbox-img" alt="Mitchfizz05"
                                    src="http://www.gravatar.com/avatar/4083e548052988dbd2b4c47e39efa7ce.png?size=70">
                                <span id="userbox-name">Mitchfizz05</span>
                                <div id="userbox-dropdown">
                                    <div class="userbox-dropdown-item">My Profile</div>
                                    <div class="userbox-dropdown-item">My Settings</div>
                                    <div class="userbox-dropdown-item">Support</div>
                                    <a href="{{ url('/auth/logout') }}"><div class="userbox-dropdown-item userbox-dropdown-item-warning">Logout</div></a>
                                </div>
                            @else
                                <span class="vertical-align"></span>
                                <span class="button" id="loginbtn">Login</span>
                                <span id="userbox-or">or</span>
                                <a href="{{ url('/register') }}"><span class="button" id="registerbtn">Register</span></a>
                                <div id="userbox-dropdown">
                                    <form id="loginform" action="{{ url('/auth/login') }}" method="POST">
                                        {!! csrf_field(); !!}
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
        <div id="wrapper" class="content-width">
            @yield('content')
        </div>
        <div id="footer" class="content-width">
            @include('clearboard.main.footer')
        </div>


        <!-- Low priority assets -->
        <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Open+Sans:400,700|Lato|Merriweather'">
    </body>
</html>