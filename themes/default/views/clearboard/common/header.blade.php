<div id="header">
    <div class="container">
        <a href="{{ url('/') }}"><img src="{{ asset('header.png') }}" alt="{{ config('clearboard.sitename') }}" id="header-img"></a>
        <div class="header-right">
            <div class="header-right-inner">
                <div id="userbox" class="{{ Auth::check() ? 'userbox-loggedin' : 'userbox-notloggedin' }}">
                    @if (Auth::check())
                        <img id="userbox-useravatar" alt="Mitchfizz05"
                             src="{{ Auth::user()->getAvatarUrl(70) }}">
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