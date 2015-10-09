<!DOCTYPE html>
<html>
    <head>
        <title>{{ config('clearboard.sitename') }} - @yield('title')</title>

        <link rel="stylesheet" type="text/css" href="{{ theme_asset('css/main.css') }}">

        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0-alpha1/jquery.min.js" type="text/javascript"></script>
        <script src="{{ theme_asset('js/main.js') }}"></script>

        @yield('head')
    </head>
    <body>
        <div id="header">
            <div class="content-width">
                <img src="{{ asset('header.png') }}" alt="{{ config('clearboard.sitename') }}" id="header-img">
                <div id="header-rightside">
                    <div id="header-rightside-inner">
                        <div id="userbox">
                            @if (Auth::check())
                                <img id="userbox-img" alt="Mitchfizz05"
                                    src="http://www.gravatar.com/avatar/4083e548052988dbd2b4c47e39efa7ce.png?size=70">
                                <span id="userbox-name">Mitchfizz05</span>
                                <div id="userbox-dropdown">
                                    <div class="userbox-dropdown-item">My Profile</div>
                                    <div class="userbox-dropdown-item">My Settings</div>
                                    <div class="userbox-dropdown-item">Support</div>
                                    <div class="userbox-dropdown-item userbox-dropdown-item-warning">Logout</div>
                                </div>
                            @else
                                <img id="userbox-img" alt="Mitchfizz05"
                                    src="http://www.gravatar.com/avatar/4083e548052988dbd2b4c47e39efa7ce.png?size=70">
                                <span id="userbox-name">Mitchfizz05</span>
                                <div id="userbox-dropdown">
                                    <div class="userbox-dropdown-item">My Profile</div>
                                    <div class="userbox-dropdown-item">My Settings</div>
                                    <div class="userbox-dropdown-item">Support</div>
                                    <div class="userbox-dropdown-item userbox-dropdown-item-warning">Logout</div>
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