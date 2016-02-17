@extends('clearboard.common.template')

@section('title', $user->name)

@section('head')
    <link rel="stylesheet" type="text/css" href="{{ theme_asset('css/profile.css') }}">
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
@endsection
