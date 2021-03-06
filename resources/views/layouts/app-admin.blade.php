<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
      <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>    @yield('title','Capital 444 Admin') </title>
    <!-- Styles -->
    <link href="{{ asset('css/app-admin.css') }}" rel="stylesheet">
  
</head>

<body class="fixed-nav sticky-footer bg-dark" id="page-top">
  <!-- Navigation-->
  
  @include('elements.admin.menu')


  <div class="content-wrapper">
    <div class="container-fluid">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h4>   @yield('panel-title' ,'Titulo de Modulo') </h4>
        
        </div>

        <div class="panel-body">
            @include('elements.messages')

            @yield('content')
        </div>
    </div>
       
    </div>
    <!-- /.container-fluid-->
    <!-- /.content-wrapper-->
    <footer class="sticky-footer">
      <div class="container">
        <div class="text-center">
          <small>  capital444.com 2018</small>
        </div>
      </div>
    </footer>
    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fa fa-angle-up"></i>
    </a>
   
    <!-- Scripts -->
    <script src="{{ asset('js/app-admin.js') }}"></script>
    <script src="{{ asset('js/plugin-admin.js') }}"></script>
  </div>
</body>

</html>