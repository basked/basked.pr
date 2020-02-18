@extends('skill::layouts.master')

@section('content')
    <div id="app">
        <skill-menu></skill-menu>
        <dev-grid-developer props-columns='@json($columns)'  props-captions='@json($captions)'  ></dev-grid-developer>
    </div>
@endsection
