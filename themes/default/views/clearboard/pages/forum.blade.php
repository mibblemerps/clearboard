@extends('clearboard.main.template')

@section('title', $forum->name)

@section('head')
    <link rel="stylesheet" type="text/css" href="{{ theme_asset('css/forum.css') }}">
@endsection

@section('content')
    <h1>Viewing Forum &dash; {{ $forum->name }}</h1><br>
    <div id="listing">
        <div class="listing-category">
            {{ $forum->name }}
            <a href="{{ url('/newthread/' . $forum->id) }}"><span class="button button-green newthread-button">New Thread</span></a>
        </div>

        @foreach($forum->threads as $thread)
            @include('clearboard.partials.threadlisting', ['thread' => $thread])
        @endforeach
    </div>
    
@endsection