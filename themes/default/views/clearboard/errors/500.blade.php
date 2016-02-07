@extends('clearboard.common.template')

@section('title', '500 Internal Server Error')

@section('content')
    <h1>500 Internal Server Error</h1>
    <p>This one's not your fault...</p>
    <p>If the problem persists, please contact the forum administrator.</p>
    <ul>
        <li><a href="{{ url('/') }}">Goto the homepage</a></li>
    </ul>
@endsection


