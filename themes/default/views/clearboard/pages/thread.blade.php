@extends('clearboard.main.template')

@section('title', $thread->name)

@section('head')
    <link rel="stylesheet" type="text/css" href="{{ theme_asset('css/thread.css') }}">
@endsection

@section('content')
    <div id="listing">
        <div class="listing-category">{{ $thread->name }}</div>
        <div id="thread_wrapper">
            @foreach($thread->posts as $post)
                <div class="post">
                    <p>{{ $post->body }}</p>
                </div>
            @endforeach
        </div>
    </div>
@endsection