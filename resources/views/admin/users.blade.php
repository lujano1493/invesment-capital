@extends('layouts.app-admin')

@section('title', 'Administración de Usuarios')
 @section('panel-title' ,'Administración de  Usuarios')

@section('content')

    <ol class="breadcrumb">
      <li class="breadcrumb-item active">  Bienvenido <b>{{ Auth::user()->nickname }}</b> </li>
    </ol>
    <div class="card mb-3">
        <div class="card-header">
            <div class="row">
                <div class="col-12 col-sm-8">
                     <i class="fa fa-table"></i> Usarios Registrados 
                </div>
                <div class="col-12 col-sm-4 text-center">
                        <a href="{{route('admin.users.register')}}" class="my-3 btn btn-primary ">
                             <i class="fa fa-fw fa-user"></i> Nuevo Usuario</a>
                 
                </div>
            </div>
           

        </div>
        <div class="card-body">
            <div class="table-responsive">
                <div class="row">
                    <div class="col-12 col-sm-7">
                        {!! $users->appends(\Request::except('page'))->render() !!}
                    </div>
                    <div class="col-12 col-sm-5">
                        @include("elements.search_form", [ 'route' => "admin.users"  ] )
                    </div>
                </div>
              
                <table class="table"  cellspacing="0">
                <thead>
                	<tr>
                		<th scope="col">   @sortablelink('id', 'Id') </th>
	                 	<th scope="col">  @sortablelink('name', 'Nombre') </th>
	                 	<th scope="col">  @sortablelink('last_name', 'Apellidos') </th>
	                 	<th scope="col"> @sortablelink('email', 'Correo')  </th>
	                 	<th scope="col"> @sortablelink('nickname', 'Nickname') </th>
	                 	<th scope="col" >  @sortablelink('status', 'Estatus') </th>
	                 	<th scope="col" >Acciones</th>
                 	</tr>
                </thead>
                <tbody>
                	@foreach($users as $user)
                	<tr>
                			<td>{{ $user->id }}</td>
                			<td>{{ $user->name }}</td>
                			<td>{{ $user->last_name . ( isset($user->last_second_name) ? ' '. $user->last_second_name : '' )    }}</td>
                			<!--<td>{{ $user->birth_date->format('d-m-Y') }}</td>-->
                			<td>{{ $user->email }}</td>
                			<td>{{ $user->nickname }}</td>
                			<td>
                                @php
                                    $text= $user->status === 0? 'INACTIVO':  ($user->status === -1 ? 'BLOQUEADO': 'ACTIVO') ;
                                    $clazz= $user->status === 0? ' badge-warning': ($user->status === -1 ? 'badge-danger' : 'badge-success')  ;
                                    $estatus= "<span class='badge {$clazz}'> {$text}</span>";
                                @endphp
                                <?php echo $estatus;?>
                            </td>
                			<!--<td>{{ $user->created_at!=null?  $user->created_at->format('d-m-Y') : ''  }}</td> -->
                			<td>
                				<a class="btn btn-success" href="{{ route('admin.users.edit' , ['id' => $user->id ]) }}" > Modificar </a>
                			 </td>

                	</tr>
                	@endforeach
                </tbody>
                </table>
                 {!! $users->appends(\Request::except('page'))->render() !!}
            </div>
        </div>
        <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
    </div>

@endsection
