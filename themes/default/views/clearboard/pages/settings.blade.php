@extends('clearboard.main.template')

@section('title', 'Account Settings')

@section('head')
    <link rel="stylesheet" type="text/css" href="{{ theme_asset('css/settings.css') }}">

    <link rel="stylesheet" href="//cdn.jsdelivr.net/simplemde/latest/simplemde.min.css">
    <script src="//cdn.jsdelivr.net/simplemde/latest/simplemde.min.js"></script>
    <script type="text/javascript" src="{{ theme_asset('js/settings.js') }}"></script>
@endsection

@section('content')
    <div id="settings-wrap">
        <div class="settings-left">
            <div class="side-header">Settings</div>
            <div id="tabs">
                <div class="tab" data-tab="general"><i class="fa fa-user"></i> General</div>
                <div class="tab" data-tab="security"><i class="fa fa-lock"></i> Security</div>
                <div class="tab" data-tab="name"><i class="fa fa-tag"></i> Display Name</div>
                <div class="tab" data-tab="blocked"><i class="fa fa-ban"></i> Blocked Users</div>
            </div>
        </div>
        <div class="settings-right">
            <div class="side-header"><i class="fa fa-user"></i> General</div>
            <div class="settings-control-area" style="display: none;">

                <!-- General Settings -->
                <div class="settings-pane" data-tab="general">
                    <h1>General Settings</h1>
                    <em>Work in progress...</em>
                </div>

            </div>

            <noscript>
                JavaScript is required to use the account settings system.
            </noscript>
        </div>
    </div>
@endsection