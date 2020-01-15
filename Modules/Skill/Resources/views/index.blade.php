@extends('skill::layouts.master')

@section('content')

    @basket('Derictive baket')

    <br>
    @role('project-manager')
    Project Manager Panel
    @endrole
    <br>
    @role('web-developer')
    Web Developer Panel
    @endrole


    <h1>Hello World</h1>

    <p>
        This view is loaded from module: {!! config('skill.name') !!}
    </p>
@endsection
