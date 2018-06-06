<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
  <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title> @yield('title') </title>

    <!-- Styles -->
    <link href="{{ asset('css/app-admin.css') }}" rel="stylesheet">
</head>

<body class="bg-dark">
  <div class="container">



<div class="card card-login mx-auto mt-5">
      <div class="card-header"> @yield('page-title')</div>
      <div class="card-body">

        @include('elements.messages')
        
        @yield('content')
      </div>
    </div>

   
    
  </div>
  
    <!-- Scripts -->
    <script src="{{ asset('js/app-admin.js') }}"></script>
</body>

</html>