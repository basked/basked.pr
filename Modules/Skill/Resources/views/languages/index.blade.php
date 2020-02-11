@extends('skill::layouts.master')

@section('content')
    <h1> {!! config('skill.name') !!}</h1>
    <div id="app">
        <dev-grid-language props-columns='@json($columns)'  props-captions='@json($captions)'  ></dev-grid-language>
    </div>
@endsection
