@extends('skill::layouts.master')

@section('content')
    <div id="app">
        <skill-menu></skill-menu>
        <dev-grid-topic props-columns='@json($columns)'  props-captions='@json($captions)'  ></dev-grid-topic>
    </div>
@endsection
