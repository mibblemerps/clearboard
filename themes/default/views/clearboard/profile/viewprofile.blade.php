@extends('clearboard.common.template')

@section('title', $user->name)

@section('head')
    <link rel="stylesheet" type="text/css" href="{{ theme_asset('css/profile.css') }}">

    <script type="text/javascript" src="{{ theme_asset('js/viewprofile.js') }}"></script>
    <script type="text/javascript" src="{{ theme_asset('js/partials/tabs.js') }}"></script>
@endsection

@section('content')
    <div class="profile-header">
        <div class="profile-buttons">
            <span class="button">Edit Profile</span>
        </div>

        <img src="{{ $user->getAvatarUrl(128) }}" alt="{{ $user->name }}" class="profile-image">
        <div class="profile-header-inner">
            <div class="profile-username">{{ $user->name }}</div><br>
            <div class="profile-group">{!! $user->group->styleUsername($user->group->name) !!}</div>
            <div class="profile-infos">
                <div class="profile-info">
                    <i class="fa fa-clock-o"></i>
                    Last active {{ format_time($user->last_active) }}
                </div>
                <div class="profile-info">
                    <i class="fa fa-calendar"></i>
                    Joined {{ date('j F Y', $user->created_at->timestamp) }}.
                </div>
            </div>
        </div>
    </div>

    <div class="profile-body">
        <div class="row">
            <div class="profile-sidebar tabbedpanel-profile col-md-3">
                <ul class="nav nav-pills nav-stacked tabbedpanel-tabs">
                    <li role="presentation" data-tab="profile" class="active"><a><i class="fa fa-user"></i> Profile</a></li>
                    <li role="presentation" data-tab="posts"><a><i class="fa fa-file-text-o"></i> Posts</a></li>
                    <li role="presentation" data-tab="stats"><a><i class="fa fa-certificate"></i> Stats</a></li>
                </ul>
            </div>
            <div class="col-md-9">
                <div class="tabbedpanel-view tabbedpanel-profile">

                    <!-- Profile tab -->
                    <div data-tab="profile" class="tabbedpanel-panel">
                        <div class="panel panel-default">
                            <div class="panel-heading">Profile</div>
                            <div class="panel-body">
                                @include('clearboard.profile.tabs.profile')
                            </div>
                        </div>
                    </div>

                    <!-- Posts tab -->
                    <div data-tab="posts" class="tabbedpanel-panel">
                        <div class="panel panel-default">
                            <div class="panel-heading">Posts</div>
                            <div class="panel-body">
                                <!-- TODO: put stuff here -->
                            </div>
                        </div>
                    </div>

                    <!-- Stats tab -->
                    <div data-tab="stats" class="tabbedpanel-panel">
                        <div class="panel panel-default">
                            <div class="panel-heading">Posts</div>
                            <div class="panel-body">
                                <!-- TODO: put stuff here -->
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <script type="text/javascript">
                TabbedPanel.initTabbedPanel("tabbedpanel-profile");
            </script>
        </div>
    </div>
@endsection
