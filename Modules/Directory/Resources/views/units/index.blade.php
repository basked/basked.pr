@extends('directory::layouts.master')

@section('content')

    <h1>UNITS INDEX</h1>

    <div id="app">
{{--        <dev-grid-spr-unit  props-fields="{{ "yughkghk"}}"></dev-grid-spr-unit>--}}
        <dev-grid-spr-unit   props-fields='@json($fields)'></dev-grid-spr-unit>
    </div>
    {{--    @foreach($countries as $country)--}}
    {{--        <h2><a href="https://gtmarket.ru{{$country->details->url}}">{{$country->name}}</a></h2>--}}
    {{--        @foreach($country->attributes as $at)--}}
    {{--            <ul>--}}
    {{--                <li><b>{{$at->name}}</b> : {{$at->pivot->val}}</li>--}}
    {{--            </ul>--}}
    {{--        @endforeach--}}
    {{--    @endforeach--}}
    <h1>Hello World</h1>

    <p>
        This view is loaded from module: {!! config('directory.name') !!}

    </p>
@endsection
