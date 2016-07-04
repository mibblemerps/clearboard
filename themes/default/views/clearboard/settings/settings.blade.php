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
    {{--<div class="tabs">
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
    </div>--}}

    <div class="row">
        <div class="profile-sidebar tabbedpanel-settings col-md-3">
            <ul class="nav nav-pills nav-stacked tabbedpanel-tabs">
                <li role="presentation" data-tab="general" class="active"><a><i class="fa fa-user"></i> General</a></li>
                <li role="presentation" data-tab="security-login" id="tabbtn-security"><a><i class="fa fa-lock"></i> Security</a></li>
                <li role="presentation" data-tab="name"><a><i class="fa fa-tag"></i> Display Name</a></li>
                <li role="presentation" data-tab="blocked"><a><i class="fa fa-ban"></i> Blocked Users</a></li>
            </ul>
        </div>
        <div class="col-md-9">
            <div class="tabbedpanel-view tabbedpanel-settings">

                <!-- General tab -->
                <div data-tab="general" class="tabbedpanel-panel">
                    <div class="panel panel-default">
                        <div class="panel-heading">General</div>
                        <div class="panel-body">
                            @include('clearboard.settings.tabs.general')
                        </div>
                    </div>
                </div>

                <!-- Security login tab -->
                <div data-tab="security-login" class="tabbedpanel-panel">
                    <div class="panel panel-danger">
                        <div class="panel-heading">Security - Login</div>
                        <div class="panel-body">
                            @include('clearboard.settings.tabs.security-login')
                        </div>
                    </div>
                </div>

                <!-- Security tab -->
                <div data-tab="security" class="tabbedpanel-panel">
                    <div class="panel panel-default">
                        <div class="panel-heading">Security</div>
                        <div class="panel-body">
                            @include('clearboard.settings.tabs.security')
                        </div>
                    </div>
                </div>

                <!-- Display name tab -->
                <div data-tab="name" class="tabbedpanel-panel">
                    <div class="panel panel-default">
                        <div class="panel-heading">Display Name</div>
                        <div class="panel-body">
                            {{-- TODO: put stuff here --}}
                        </div>
                    </div>
                </div>

                <!-- Blocked users tab -->
                <div data-tab="blocked" class="tabbedpanel-panel">
                    <div class="panel panel-default">
                        <div class="panel-heading">Blocked Users</div>
                        <div class="panel-body">
                            {{-- TODO: put stuff here --}}
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <script type="text/javascript">
            TabbedPanel.initTabbedPanel("tabbedpanel-settings");
        </script>
    </div>
@endsection