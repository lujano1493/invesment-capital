@extends('layouts.app-admin')

@section('title', 'Administración de Cuestionarios')
 @section('panel-title' ,'Administración de  Cuestionarios')

@section('content')

   
    <div class="card mb-3">
        <div class="card-header">
            <div class="row">
                <div class="col-12 col-sm-8">
                     <i class="fa fa-table"></i> Cuestionarios 
                </div>
                <div class="col-12 col-sm-4 text-center">
                        <a href="{{route('admin.educacion.administrar')}}" class="my-3 btn btn-primary ">
                             <i class="fa fa-fw fa-book"></i> Nuevo Cuestionario</a>
                 
                </div>
            </div>
           

        </div>
        <div class="card-body">
            <div class="table-responsive">
                <div class="row">
                    <div class="col-12 col-sm-7">
                        {!! $cuestionarios->appends(\Request::except('page'))->render() !!}
                    </div>
                    <div class="col-12 col-sm-5">
                        @include("elements.search_form", [ 'route' => "admin.educacion"  ] )
                    </div>
                </div>
              
                <table class="table mt-3"  cellspacing="0">
                <thead>
                	<tr>
                		<th scope="col">   @sortablelink('id', 'Id') </th>
	                 	<th scope="col">  @sortablelink('titulo', 'Nombre') </th>
	                 	<th scope="col">  @sortablelink('fecha_limite', 'Fecha Limite') </th>
	                 	<th scope="col"> @sortablelink('updated_at', 'Modificacion')  </th>
	                 	<th scope="col" >Acciones</th>
                 	</tr>
                </thead>
                <tbody>
                	@foreach($cuestionarios as $cuestionario)
                	<tr class="tmpl-item">
                			<td>{{ $cuestionario->id }} <input type="hidden" name="id" value = {{ $cuestionario->id }}></td>
                			<td>{{ $cuestionario->titulo }}</td>
                            @php
                                $fechaLimite = $cuestionario->fecha_limite;

                                if( $fechaLimite  ){
                                    $fechaLimite =  $cuestionario->tipo ==2 ? $fechaLimite->format('d-m-Y H:i') : $fechaLimite->format('d-m-Y');
                                } else{
                                    $fechaLimite = 'Sin Limite';
                                }


                            @endphp
                			<td>{{  $fechaLimite }}</td>
                			<td>{{ $cuestionario->updated_at->format('d-m-Y') }}</td>
                			<td>
                				<a class="btn btn-success" href="{{ route('admin.educacion.administrar' , $cuestionario ) }}" title="Editar" > 
                                    <i class="fa fa-edit"></i> 
                                </a>
                                <a class="btn btn-primary" href="{{ route('admin.educacion.ver.cuestionario' , $cuestionario ) }}" title="Vista Previa"  > 
                                    <i class="fa fa-eye"></i>
                                </a>
                                <a class="btn btn-info" href="{{ route('admin.educacion.asigna.cuestionario' , $cuestionario ) }}" title="Asignar"> 
                                    <i class="fa fa-check"></i> 
                                </a>
                                <a class="btn btn-danger btn-delete-form " 
                                    data-scope=".tmpl-item" 
                                    href="{{ route('admin.educacion.elimina.cuestionario' , $cuestionario ) }}"  title="Eliminar">  
                                    <i class="fa fa-trash"></i> 
                                </a>
                			 </td>
                	</tr>
                	@endforeach
                </tbody>
                </table>
                 {!! $cuestionarios->appends(\Request::except('page'))->render() !!}
            </div>
        </div>
    </div>

@endsection
