@extends('clearboard.main.template')

@section('title', $forum->name)

@section('head')
    <link rel="stylesheet" type="text/css" href="{{ theme_asset('css/forum.css') }}">
@endsection

@section('content')
    <h1>{{ $forum->name }}</h1>

    
@endsection