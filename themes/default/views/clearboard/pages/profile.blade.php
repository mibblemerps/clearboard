@extends('clearboard.main.template')

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
            <div class="profile-username">{{ $user->name }}</div>
        </div>

    </div>
@endsection