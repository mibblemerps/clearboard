@extends('clearboard.common.template')

@section('title', $user->name)

@section('head')
    <link rel="stylesheet" type="text/css" href="{{ theme_asset('css/profile.css') }}">

    <script type="text/javascript" src="{{ theme_asset('js/viewprofile.js') }}"></script>
    <script type="text/javascript" src="{{ theme_asset('js/partials/tabs.js') }}"></script>
@endsection

@section('content')
    <div id="profile-header">
        <div id="profile-buttons">
            <span class="button">Edit Profile</span>
        </div>

        <img src="{{ $user->getAvatarUrl(128) }}" alt="{{ $user->name }}" id="profile-image">
        <div id="profile-header-inner">
            <div id="profile-username">{{ $user->name }}</div><br>
            <div id="profile-group">{!! $user->group->styleUsername($user->group->name) !!}</div>
            <div id="profile-info">
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

    <div id="profile-body">
        <div id="tabs" class="tabs">
            <div class="tab-header">{{ $user->name }}</div>
            <div class="tab" data-tab="profile" data-tab-default="true"><i class="fa fa-user"></i> Profile</div>
            <div class="tab" data-tab="posts"><i class="fa fa-file-text-o"></i> Posts</div>
            <div class="tab" data-tab="stats"><i class="fa fa-certificate"></i> Stats</div>
        </div>

        <div class="tab-view">
            <div class="tab-header">Loading...</div>
            <div class="tab-content">
                <div class="tab-pane" data-tab="profile">
                    @include('clearboard.profile.tabs.profile')
                </div>
                <div class="tab-pane" data-tab="posts">
                    Coming soon...
                </div>
                <div class="tab-pane" data-tab="stats">
                    Coming soon...
                </div>
            </div>
        </div>
    </div>
@endsection
