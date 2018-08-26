@extends('layouts.app-admin')



@section('title', 'Usuarios :: Configurar Cuestionario')
@section('panel-title' ,'Administracion de Cuestionario')



@section('content')

	@include('elements.admin.educacion_configurar',compact('cuestionario'))

	@isset( $cuestionario)

	@php
			$preguntas = $cuestionario ->preguntas()->orderBy("secuencia","asc")->get();
	@endphp

	<div class="card">
		<div class="card-header">
		       Registro de Preguntas
		</div>
	  	<div class="card-body">
	  		<div id="preguntas" class="mt-3" >

				@foreach( $preguntas AS $pregunta )
				<div class="pregunta tmpl-item">
					
				  @include("elements.admin.educacion_configurar_form_pregunta_tmpl", 
				  	['count' =>$loop->index +1, "pregunta" => $pregunta, 'type' => 'edit'])
				  

				</div>
					
				@endforeach
			</div>
			<div class="form-group text-right">
				<button 
				class="btn btn-primary add-form" 
				data-target="#preguntas" 
				data-id-tmpl="#tmpl-pregunta"> Agregar Pregunta</button>
			</div>
	  	</div>
	</div>

	<script id="tmpl-pregunta" type="text/x-dot-template">
		@include("elements.admin.educacion_configurar_form_pregunta_tmpl", ['count' =>"{%=it.count+1%}" , "pregunta" => null, 'type' => 'register'])
	</script>

		<script id="tmpl-opcion" type="text/x-dot-template">
		@include("elements.admin.educacion_configurar_opcion_tmpl", [ 'parent_count' => '{%=it.parentCount%}' ,'count' =>"{%=it.count%}" , "pregunta" =>null,  "opcion" => null, 'type' => 'register'])
	</script>
	@endisset

	<div class="form-group text-center mt-3">
        <a href="{{ route('admin.educacion') }}" class="btn btn-danger"> Regresar </a>  
</div>
@endsection
