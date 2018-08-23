@extends('layouts.app-admin')

@section('title', 'Asignación de Cuestionario')
 @section('panel-title' ,'Asignación de Cuestionario')

@section('content')


    <div class="card mb-3">
        <div class="card-header">
            <div class="row">
                <div class="col-12 col-sm-8">
                     <i class="fa fa-table"></i> Asignación a Usuarios 
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
                        @include("elements.search_form", [ 'route' => "admin.educacion.asigna.cuestionario"  ,   "params" => $cuestionario  ] )
                    </div>
                </div>

                 <div class="row mt-3">
                    <div class="col-12 col-sm-6">
                        <a class="btn btn-primary btn-request" href=""> Asignar Todos</a>
                    </div>
                    <div class="col-12 col-sm-6">
                         <a class="btn btn-danger btn-request" href=""> Desasignar Todos</a>
                    </div>
                </div>
              
                <table class="table mt-3"  cellspacing="0">
                <thead>
                	<tr>
                        <th scope="col" >   </th>
                		<th scope="col">   @sortablelink('id', 'Id') </th>
	                 	<th scope="col">  Nombre Completo </th>
	                 	<th scope="col"> @sortablelink('email', 'Correo')  </th>
	                 	
	                 	<th scope="col" >Acciones</th>
                 	</tr>
                </thead>
                <tbody>
                	@foreach($users as $user)
                	<tr>
                            <td> <input type="checkbox" name="select" value="{{$user->id}}"> </td>
                			<td>{{ $user->id }}</td>
                			<td>{{ $user->fullName }}</td>
                			<td>{{ $user->email }}</td>
                			<td>

                                @php

                                    $cuestionarios= $user->cuestionarios()->wherePivot('id_cuestionario',$cuestionario->id)->get();
                                    $clsClass= $cuestionarios->isNotEmpty() ? 'btn-danger' : 'btn-success';
                                    $textBtn = $cuestionarios->isEmpty() ? 'Asignar' :'Desasignar';
                                @endphp

                				<a class="btn {{ $clsClass }}" href="{{ 
                                        route('admin.educacion.asigna.usuario', [
                                            'idUser' => $user->id ,
                                            'idCuestionario' => $cuestionario->id 
                                            ])  

                                    }}" > {{ $textBtn }} </a>
                			 </td>

                	</tr>
                	@endforeach
                </tbody>
                </table>
                 {!! $users->appends(\Request::except('page'))->render() !!}
            </div>
        </div>
      
    </div>

    <div class="mt-3 text-center">
        <a class="btn btn-danger" href ="{{ route('admin.educacion') }}"> Regresar </a>
    </div>

@endsection
