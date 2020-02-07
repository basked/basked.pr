@extends('directory::layouts.master')

@section('content')
    <h1> {!! config('directory.name') !!}</h1>
    <div id="app">
        <dev-grid-spr-unit props-columns='@json($columns)'  props-captions='@json($captions)'  ></dev-grid-spr-unit>
    </div>

@endsection
