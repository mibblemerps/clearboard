@extends('clearboard.main.template')

@section('title', 'Index')

@section('head')
    <link rel="stylesheet" type="text/css" href="{{ theme_asset('css/index.css') }}">
@endsection

@section('content')
    <h1>Forums</h1>

    <div id="forumlisting">
        @foreach( $forums->sortBy('position') as $forum )
            @if( ($forum->type == 0) || ($forum->type == 2) )
                @include('clearboard.parts.forumlisting', ['forum' => $forum])
            @elseif($forum->type == 1)
                <div class="forumlisting-category">{{ $forum->name }}</div>
            @endif
        @endforeach
    </div>
@endsection