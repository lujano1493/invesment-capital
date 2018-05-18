@extends('layouts.app')

@section('title', 'Inicio Admin Invesment Capital')
 @section('panel-title' ,'Administrar Usuario')

@section('content')
    Hola Bienvenido a Administrador



    <div class="card mb-3">
        <div class="card-header">
            <i class="fa fa-table"></i> Data Table Example</div>
        <div class="card-body">
            <div class="table-responsive">

                 {{ $users->links()}}  <a href="{{route('admin.register_user')}}" class="btn btn-primary ">
                     <i class="fa fa-fw fa-user"></i> Registrar Nuevo Usuario</a>
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                	<tr>
                		<th>Id</th>
	                 	<th>nombre</th>
	                 	<th>Apellidos</th>
	                 	<th>Fecha de Nacimiento</th>
	                 	<th>Correo</th>
	                 	<th>Nickname</th>
	                 	<th>Estatus</th>
	                 	<th>Fecha de Registro</th>
	                 	<th>Acciones</th>
                 	</tr>
                </thead>
                <tbody>
                	@foreach($users as $user)
                	<tr>
                			<td>{{ $user->id }}</td>
                			<td>{{ $user->name }}</td>
                			<td>{{ $user->last_name . ( isset($user->last_second_name) ? ' '. $user->last_second_name : '' )    }}</td>
                			<td>{{ $user->birth_date->format('d-m-Y') }}</td>
                			<td>{{ $user->email }}</td>
                			<td>{{ $user->nickname }}</td>
                			<td>{{ $user->estatus === 0? 'INACTIVO': 'ACTIVO' }}</td>
                			<td>{{ $user->created_at!=null?  $user->created_at->format('d-m-Y') : ''  }}</td>
                			<td>
                				<a class="btn btn-success" href="" > Modificar </a>
                			 </td>

                	</tr>
                	@endforeach
                </tbody>
                </table>

                 {{ $users->links()}}
            </div>
        </div>
        <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
    </div>
@endsection
