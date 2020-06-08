@extends('skill::layouts.master')

@section('content')
    <div id="app">
        <skill-menu></skill-menu>
        <list-links :props-list='@json($test_data)'></list-links>
    </div>
@endsection
