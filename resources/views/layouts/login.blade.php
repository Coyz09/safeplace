<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Safeplace</title>
    <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
    {{-- <link rel="stylesheet" type="text/css" href="{{ asset('auth.css') }}"> --}}
    <link href="{{ URL::asset('auth.css') }}" rel="stylesheet" type="text/css" >


</head>
<body>

    <div class="container">
        @yield('content')
    </div>

</body>
</html>