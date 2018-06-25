@php
  $menu=[
      [ 'route' => 'admin.users' , 'title' => 'Usuarios','icon' =>'fa-fw fa-user' ,'titleDesc' =>'Administrar Usuarios'  ],
      [ 'route' => 'admin.invesment' , 'title' => 'Invesment' ,'icon' =>'fa-fw fa-money' ],
      [ 'route' => 'admin.educacion' , 'title' => 'Educación','icon' =>'fa-fw fa-book' ,'titleDesc' =>'Administrar Cuestionarios' ]
  ]  
@endphp


<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
    <a class="navbar-brand" href="#">  Capital 444 Admin</a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
          @foreach(  $menu  as  $opcion )
            @include("elements/admin/option_menu",$opcion )
          @endforeach
      </ul>
      <ul class="navbar-nav sidenav-toggler">
        <li class="nav-item">
          <a class="nav-link text-center" id="sidenavToggler">
            <i class="fa fa-fw fa-angle-left"></i>
          </a>
        </li>
      </ul>

      @include("elements.admin.notification_menu")
    </div>
  </nav>