@extends('skill::layouts.master')

@section('content')
    <h1> {!! config('skill.name') !!}</h1>
    <div id="app">
        <skill-menu></skill-menu>
        <dev-grid-technology props-columns='@json($columns)'  props-captions='@json($captions)'  ></dev-grid-technology>
    </div>
@endsection
