@extends('clearboard.main.template')

@section('title', 'Index')

@section('head')
    <link rel="stylesheet" type="text/css" href="{{ theme_asset('css/index.css') }}">
@endsection

@section('content')
    @if( \App\Facades\Settings::get('clearboard.board_message') !== '' )
        <div class="board-message">
            {!! \App\Facades\Settings::get('clearboard.board_message') !!}
        </div>
    @endif

    <h1>Forums</h1>

    <div id="listing">
        @foreach( $forums->sortBy('position') as $forum )
            @if( ($forum->type == 0) || ($forum->type == 2) )
                @include('clearboard.partials.forumlisting', ['forum' => $forum])
            @elseif($forum->type == 1)
                <div class="listing-category">{{ $forum->name }}</div>
            @endif
        @endforeach
    </div>
@endsection