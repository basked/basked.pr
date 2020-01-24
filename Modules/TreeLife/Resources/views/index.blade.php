@extends('treelife::layouts.master')

@section('content')
    <h1>Hello World</h1>
    <div id="app">
        <dev-grid-elationship></dev-grid-elationship>
    </div>

    <p>
        This view is loaded from module: {!! config('treelife.name') !!}

{{--    {{$relationships->name}}--}}
    </p>
@endsection
