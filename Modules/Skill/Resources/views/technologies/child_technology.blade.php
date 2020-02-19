<li>{{ $child_technology->name }}</li>
@if ($child_technology->technologies)
    <ul>
        @foreach ($child_technology->technologies as $childTechnology)
            @include('skill::technologies.child_technology', ['child_technology' => $childTechnology])
        @endforeach
    </ul>
@endif
