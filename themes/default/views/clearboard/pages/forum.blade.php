@extends('clearboard.main.template')

@section('title', $forum->name)

@section('page_assets')
    <link rel="stylesheet" type="text/css" href="{{ theme_asset('css/forum.css') }}">
@endsection

@section('content')
    <h1>Viewing Forum &dash; {{ $forum->name }}</h1><br>
    <div id="listing">
        <div class="listing-category">{{ $forum->name }}</div>

        @foreach($forum->threads as $thread)
            @include('clearboard.partials.threadlisting', ['thread' => $thread])
        @endforeach
    </div>
    
@endsection