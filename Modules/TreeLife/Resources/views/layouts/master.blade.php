<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="https://cdn3.devexpress.com/jslib/19.2.5/css/dx-diagram.min.css" />

        <title>Module TreeLife</title>

       {{-- Laravel Mix - CSS File --}}
        <link rel="stylesheet" href="{{ mix('css/treelife.css') }}">

    </head>
    <body>
        @yield('content')

        {{-- Laravel Mix - JS File --}}
         <script src="{{ mix('js/treelife.js') }}"></script>
    </body>
</html>
