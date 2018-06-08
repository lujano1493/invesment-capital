
<ul class="nav navbar-top-links navbar-right">
  <li class="nav-item">
        <a class="nav-link" href="#"> {{ Auth::user()->name }} Ultimo Acceso </a>  
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('capital.profile') }}"><i class="fa fa-user fa-fw"></i> Perfil </a>
    </li>
    <li class="nav-item">
        <a  class="nav-link" href="{{ route('logout') }}"><i class="fa fa-sign-out fa-fw"></i> Salir</a>       
    </li>
</ul>


<!-- /.navbar-top-links -->