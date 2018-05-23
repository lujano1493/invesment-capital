@extends('layouts.app')

@section('title', 'Administración de Usuarios')
 @section('panel-title' ,'Administración de  Usuarios')

@section('content')

    <ol class="breadcrumb">
      <li class="breadcrumb-item active">  Bienvenido <b>{{ Auth::user()->nickname }}</b> </li>
    </ol>
    <div class="card mb-3">
        <div class="card-header">
            <div class="row">
                <div class="col-8">
                     <i class="fa fa-table"></i> Usarios Registrados 
                </div>
                <div class="col-4">
                    <a href="{{route('admin.users.register')}}" class="btn btn-primary btn-block ">
                             <i class="fa fa-fw fa-user"></i> Nuevo Usuario</a>
                </div>
            </div>
           

        </div>
        <div class="card-body">
            <div class="table-responsive">

                 {{ $users->links()}}  
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                	<tr>
                		<th width="5%">Id</th>
	                 	<th width="15%">nombre</th>
	                 	<th width="15%">Apellidos</th>
	                 	<th width="15%">Correo</th>
	                 	<th width="15%">Nickname</th>
	                 	<th width="5%">Estatus</th>
	                 	<th>Acciones</th>
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
                                       $text= $user->status === 0? 'INACTIVO': 'ACTIVO' ;
                                       $clazz= $user->status === 0? ' badge-warning': 'badge-success';
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

                 {{ $users->links()}}
            </div>
        </div>
        <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
    </div>
@endsection
