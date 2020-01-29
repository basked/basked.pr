@extends('treelife::layouts.master')

@section('content')
    <h1>Hello World</h1>
    <div id="app">
        @role('project-manager')
        <dev-grid-elationship></dev-grid-elationship>
        @endrole
        <dev-grid-diagram></dev-grid-diagram>
    </div>

    <p>
        This view is loaded from module: {!! config('treelife.name') !!}

{{--    {{$relationships->name}}--}}
    </p>
@endsection
