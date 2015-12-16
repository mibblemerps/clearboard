@extends('clearboard.main.template')

@section('title', "Register")

@section('head')
    <link rel="stylesheet" type="text/css" href="{{ theme_asset('css/register.css') }}">

    <script type="text/javascript" src="{{ theme_asset('js/register.js') }}"></script>

    <script src='https://www.google.com/recaptcha/api.js'></script>
@endsection

@section('content')
    <div id="listing">
        <div class="register-error" style="display:none">
            <ul></ul>
        </div>

        <div class="register-wrap">
            <h1>Register</h1>

            <table class="register-table">
                <tr>
                    <td><div class="register-label">Email</div></td>
                    <td>
                        <input type="text" maxlength="32" id="register-email" class="register-field">
                    </td>
                </tr>
                <tr>
                    <td><div class="register-label">Username</div></td>
                    <td>
                        <input type="text" id="register-username" class="register-field">
                    </td>
                </tr>
                <tr>
                    <td><div class="register-label">Password</div></td>
                    <td>
                        <input type="password" id="register-password" class="register-field">
                    </td>
                </tr>
                <tr>
                    <td><div class="register-label"><em>...and again</em></div></td>
                    <td>
                        <input type="password" id="register-password-again" class="register-field">
                    </td>
                </tr>
            </table>
            <div class="register-captcha">
                {!! Recaptcha::render() !!}
            </div>
            <div class="register-buttons">
                <span class="button button-green" id="register-submit">Register</span>
            </div>
        </div>
    </div>
@endsection