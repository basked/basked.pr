@extends('skill::layouts.master')

@section('content')
    <div id="app">
        <skill-menu></skill-menu>
        <dev-tree-technology props-columns='@json($columns)'  props-captions='@json($captions)'  ></dev-tree-technology>
    </div>
@endsection
