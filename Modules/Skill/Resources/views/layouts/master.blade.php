<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Module Skill</title>
    <link rel="stylesheet"  href="//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.18.1/styles/default.min.css">
    {{-- Laravel Mix - CSS File --}}
    <link rel="stylesheet" href="{{ mix('css/skill.css') }}">

</head>
<body>
{{--style="background-color: #363640"--}}
<div class="skill-menu">
    <skill-menu></skill-menu>
</div>

@yield('content')

{{-- Laravel Mix - JS File --}}
<script src="{{ mix('js/skill.js') }}"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.18.1/highlight.min.js"></script>
</body>
</html>
