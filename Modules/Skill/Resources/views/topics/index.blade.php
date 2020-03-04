@extends('skill::layouts.master')

@section('content')
    <div id="app">
        <skill-menu></skill-menu>
        <dev-grid-topic props-columns='@json($columns)'  props-captions='@json($captions)' props-technology_id='@json($technology_id)'  ></dev-grid-topic>
        <skill-footer></skill-footer>
    </div>
@endsection
