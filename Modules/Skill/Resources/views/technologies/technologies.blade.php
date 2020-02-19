@extends('skill::layouts.master')

@section('content')
    <div id="app">
        <skill-menu></skill-menu>
        @foreach ($technologies as $technology)
            <li>{{ $technology->name }}</li>
            <ul>
                @foreach ($technology->childrenTechnologies as $childTechnology)
                    @include('skill::technologies.child_technology', ['child_technology' => $childTechnology])
                @endforeach
            </ul>
        @endforeach
    </div>
@endsection
