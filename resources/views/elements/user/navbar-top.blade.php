@php
	$user= Auth::user();

	$last_login =  $user->last_login !==null ? $user->last_login->format('d-m-Y  H:i:s')  :'Primera vez';

@endphp

<ul class="nav navbar-top-links navbar-right">

  <li class="nav-item">
        <a class="nav-link" href="#">  <b> {{ $user->name }}</b> último acceso :  {{ $last_login  }}    </a>  
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('capital.profile') }}"><i class="fa fa-user fa-fw"></i> Perfil </a>
    </li>
    <li class="nav-item">
        <a  class="nav-link" href="{{ route('logout') }}"><i class="fa fa-sign-out fa-fw"></i> Salir</a>       
    </li>
</ul>


<!-- /.navbar-top-links -->