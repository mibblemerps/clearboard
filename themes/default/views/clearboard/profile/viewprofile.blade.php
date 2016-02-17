@extends('clearboard.common.template')

@section('title', $user->name)

@section('head')
    <link rel="stylesheet" type="text/css" href="{{ theme_asset('css/profile.css') }}">
@endsection

@section('content')
    <div id="profile-wrapper">
        <div class="profile-header">
            <div class="profile-buttons">
                <span class="button">Edit Profile</span>
            </div>

            <img src="{{ $user->getAvatarUrl(128) }}" alt="{{ $user->name }}" class="profile-image">
            <div class="profile-header-inner">
                <div id="profile-username">{{ $user->name }}</div><br>
                <div class="profile-group">{!! $user->group->styleUsername($user->group->name) !!}</div>
                <div class="profile-infos">
                    <div class="profile-info">
                        <i class="fa fa-calendar"></i>
                        Joined {{ date('j F Y', $user->created_at->timestamp) }}.
                    </div>
                </div>
            </div>
        </div>

        <div>

        </div>
    </div>
@endsection
