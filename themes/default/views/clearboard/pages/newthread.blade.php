@extends('clearboard.main.template')

@section('title', 'Posting Thread')

@section('head')
    <link rel="stylesheet" type="text/css" href="{{ theme_asset('css/newthread.css') }}">

    <link rel="stylesheet" href="//cdn.jsdelivr.net/simplemde/latest/simplemde.min.css">
    <script src="//cdn.jsdelivr.net/simplemde/latest/simplemde.min.js"></script>
    <script type="text/javascript" src="{{ theme_asset('js/newthread.js') }}"></script>

    <script type="text/javascript">
        window.forum_id = {{ $forum->id }};
    </script>
@endsection

@section('content')
    <h1>Posting Thread</h1>
    <div id="newthread">
        <div class="newthread-left">
            <input type="text" id="newthread-title"><br>
            <textarea id="newthread-editor"></textarea>
        </div>

        <div class="newthread-buttons">
            <a href="{{ $forum->getUserFriendlyURL() }}"><span id="newthread-discard" class="button button-red">Discard</span></a>
            <span id="newthread-submit" class="button">Create Thread</span>
        </div>
    </div>
@endsection