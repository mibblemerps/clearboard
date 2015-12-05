@extends('clearboard.main.template')

@section('title', 'Index')

@section('page_assets')
    <link rel="stylesheet" type="text/css" href="{{ theme_asset('css/index.css') }}">
@endsection

@section('content')
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