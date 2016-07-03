@extends('clearboard.common.template')

@section('title', 'Account Settings')

@section('head')
    <link rel="stylesheet" type="text/css" href="{{ theme_asset('css/settings.css') }}">

    <link rel="stylesheet" href="//cdn.jsdelivr.net/simplemde/latest/simplemde.min.css">
    <script src="//cdn.jsdelivr.net/simplemde/latest/simplemde.min.js"></script>
    <script type="text/javascript" src="{{ theme_asset('js/settings.js') }}"></script>
    <script type="text/javascript" src="{{ theme_asset('js/partials/tabs.js') }}"></script>
@endsection

@section('content')
    <div class="tabs">
        <div id="tabs" class="tabs">
            <div class="tab-header">Settings</div>
            <div class="tab" data-tab="general" data-tab-default="true"><i class="fa fa-user"></i> General</div>
            <div class="tab" data-tab="security-login" id="tabbtn-security"><i class="fa fa-lock"></i> Security</div>
            <div class="tab" data-tab="name"><i class="fa fa-tag"></i> Display Name</div>
            <div class="tab" data-tab="blocked"><i class="fa fa-ban"></i> Blocked Users</div>
        </div>
    </div>
    <div class="tab-view">
        <div class="tab-header"><i class="fa fa-user"></i> General</div>
        <div class="tab-content">

            <!-- General Settings -->
            <div class="tab-pane" data-tab="general">
                @include('clearboard.settings.tabs.general')
            </div>

            <!-- Security Settings -->
            <div class="tab-pane" data-tab="security">
                @include('clearboard.settings.tabs.security')
            </div>

            <!-- Security login tab -->
            <div class="tab-pane" data-tab="security-login">
                @include('clearboard.settings.tabs.security-login')
            </div>

        </div>

        <noscript>
            JavaScript is required to use the account settings system.
        </noscript>
    </div>
@endsection