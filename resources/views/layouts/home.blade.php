<!DOCTYPE html>
<html lang="en">
    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title> @yield('title','Capital 444') </title>

        <link href="{{ asset('css/app-invesment.css') }}" rel="stylesheet">
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

    </head>

    @php
         $idBody = Auth::user() ? 'user-capital' : 'home-capital'   ;
    @endphp
    <body  id="{{ $idBody }}">

        <div class="container-fluid">
                @include("elements/home/menu")
                <div  id="container-home">
                        @include('elements.messages', [ 'floatMsg' => true ])
                         @yield('content')
                </div>
        </div>
      
            <script src="{{ asset('js/app.js') }}" ></script>
         <script src="{{ asset('js/app-plugin.js') }}"></script>
       
    </body>
</html>