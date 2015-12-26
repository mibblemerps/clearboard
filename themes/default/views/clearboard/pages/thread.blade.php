@extends('clearboard.main.template')

@section('title', $thread->name)

@section('head')
    <link rel="stylesheet" type="text/css" href="{{ theme_asset('css/thread.css') }}">

    <link rel="stylesheet" href="//cdn.jsdelivr.net/simplemde/latest/simplemde.min.css">
    <script src="//cdn.jsdelivr.net/simplemde/latest/simplemde.min.js"></script>
    <script type="text/javascript" src="{{ theme_asset('js/thread.js') }}"></script>

    <script type="text/javascript">
        window.thread_id = "{{ $thread->id }}";

        window.thread_page = {{ $posts->currentPage() }};
        window.thread_last_page = {{ $posts->lastPage() }};
    </script>
@endsection

@section('content')
    <div class="listing">
        <div class="listing-category">{{ $thread->name }}</div>
        <div class="thread-wrapper">
            @foreach($posts as $post)
                @include('clearboard.partials.post')
            @endforeach

            @if($posts->currentPage() == $posts->lastPage()) <span id="postreply-insert-anchor"></span> @endif

            {!! $posts->render() !!}

            <p class="postreply-other-page-info" style="display:none;">Posted on last page...</p>
            @if($posts->currentPage() != $posts->lastPage()) <span id="postreply-insert-anchor"></span> @endif

            @include('clearboard.partials.postreply')
        </div>
    </div>
@endsection