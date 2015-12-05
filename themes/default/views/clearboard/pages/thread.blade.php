@extends('clearboard.main.template')

@section('title', $thread->name)

@section('head')
    <link rel="stylesheet" type="text/css" href="{{ theme_asset('css/thread.css') }}">

    <link rel="stylesheet" href="//cdn.jsdelivr.net/simplemde/latest/simplemde.min.css">
    <script src="//cdn.jsdelivr.net/simplemde/latest/simplemde.min.js"></script>
    <script type="text/javascript" src="{{ theme_asset('js/thread.js') }}"></script>

    <script type="text/javascript">
        window.thread_id = "{{ $thread->id }}";
    </script>
@endsection

@section('content')
    <div id="listing">
        <div class="listing-category">{{ $thread->name }}</div>
        <div id="thread_wrapper">
            @foreach($thread->posts as $post)
                @include('clearboard.partials.post')
            @endforeach

            @include('clearboard.partials.postreply')
        </div>
    </div>
@endsection