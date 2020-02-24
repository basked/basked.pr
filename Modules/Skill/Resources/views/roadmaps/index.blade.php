@extends('skill::layouts.master')

@section('content')
    <div id="app">
        <skill-menu></skill-menu>
        <dev-grid-roadmap props-columns='@json($columns)'  props-captions='@json($captions)'  ></dev-grid-roadmap>
    </div>
@endsection
