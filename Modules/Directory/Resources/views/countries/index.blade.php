@extends('directory::layouts.master')

@section('content')
    <h1> {!! config('directory.name') !!}</h1>
    <div id="app">
        <country props-columns='@json($columns)'  props-captions='@json($captions)'  ></country>
    </div>

@endsection
