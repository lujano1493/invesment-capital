<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav navbar-collapse">
        <ul class="nav" id="side-menu">
            <li class="sidebar-search">
                <div class="input-group custom-search-form">
                    <input type="text" class="form-control" placeholder="Buscar...">
                    <span class="input-group-btn">
                    <button class="btn btn-default" type="button">
                        <i class="fa fa-search"></i>
                    </button>
                </span>
                </div>
                <!-- /input-group -->
            </li>
            <li>
                <a href="{{ route('capital.inicio') }}"><i class="fa fa-dashboard fa-fw"></i> Inicio</a>
            </li>
            @php
                $modules = Auth::user()->modules;
            @endphp

            @foreach( $modules as $module)
                <li>
                      <a href="{{ route( $module->route ) }}"> <i class="{{ ($module->icon ) }} "></i> {{ $module->name }}  </a>
                    
                </li>
                  
            @endforeach
         
        </ul>
    </div>
    <!-- /.sidebar-collapse -->
</div>
<!-- /.navbar-static-side -->