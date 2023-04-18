<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>Safeplace</title>
    <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
    
    <link href="{{ URL::asset('auth.css') }}" rel="stylesheet" type="text/css" >


</head>
<body>

    <div class="container">
        @yield('content')
        
        @yield('body')
    </div>

</body>
</html>
