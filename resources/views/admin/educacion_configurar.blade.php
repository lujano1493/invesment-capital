@extends('layouts.app-admin')



@section('title', 'Usuarios :: Configurar Cuestionario')
@section('panel-title' ,'Administracion de Cuestionario')



@section('content')

	@include('elements.admin.educacion_configurar',compact('cuestionario'))

	@isset( $cuestionario)

	@php
			$preguntas = $cuestionario ->preguntas;
	@endphp

	<div class="card">
		<div class="card-header">
		       Registro de Preguntas
		</div>
	  	<div class="card-body">
		  	<div class="form-group text-center">
				<button 
				class="btn btn-primary add-form" 
				data-target="#preguntas" 
				data-id-tmpl="#tmpl-pregunta"> Agregar Pregunta</button>
			</div>
	  		<div id="preguntas" class="mt-3" >

				@foreach( $preguntas AS $pregunta )
				<div class="pregunta tmpl-item">
				  @include("elements.admin.educacion_configurar_form_pregunta_tmpl", 
				  	['count' =>$loop->index +1, "pregunta" => $pregunta, 'type' => 'edit'])
				</div>

				@php
					$opciones = $pregunta->opciones;
				@endphp
					
				@endforeach
			</div>
	  	</div>
	</div>

	<script id="tmpl-pregunta" type="text/x-dot-template">
		<div class="pregunta">
		@include("elements.admin.educacion_configurar_form_pregunta_tmpl", ['count' =>"{%=it.count +1%}" , "pregunta" => null, 'type' => 'register'])
		</div>
	</script>
	@endisset

	<div class="form-group text-center mt-3">
        <a href="{{ route('admin.educacion') }}" class="btn btn-danger"> Regresar </a>  
</div>
@endsection
