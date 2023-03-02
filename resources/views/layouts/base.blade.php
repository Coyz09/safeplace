<!DOCTYPE html>
 <html>
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
            <meta http-equiv="X-UA-Compatible" content="ie=edge">
            <meta name="csrf-token" content="{{ csrf_token() }}">

                <title></title>
                <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
                <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

                <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/6.2.1/css/font-awesome.min.css">
                <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"/>

                <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/fontawesome.min.css">
    
                <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" >
                <link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">
                <link rel="stylesheet" type="text/css" href="{{ asset('style.css') }}">
                <!-- <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}"> -->
                <!-- <link rel='stylesheet' href='{{ asset('assets/css/style.css') }}' type='text/css' /> -->
                
                


                @yield('styles')
        </head>
 

        @yield('scripts')
    <div class="container">
        @yield('content')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js?fbclid=IwAR3yFSufp9dyKjMyZjF3_dGB6Vd-ikO7BH0M8TXV-00DyglDblGq4C4kRak"></script>
        <script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ=" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" ></script>
        <script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>


        @yield('body')


        @yield('scripts')
           

    </div>
    <!-- <script src="app.js"></script> -->

    </body>



 </html>













