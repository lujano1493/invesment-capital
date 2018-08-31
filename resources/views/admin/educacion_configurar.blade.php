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
	  		<div id="preguntas" class="mt-3" >

				@foreach( $preguntas AS $pregunta )


					@include('elements.acorddion_tmpl', [
						'extraClsTmpl' => "tmpl-item",
						'show' => $loop->first,
						'target' => "#preguntas_".$loop->index,
						'idTarget' => "preguntas_".$loop->index,
						'title' => "Pregunta " .( $pregunta->secuencia ) ,
						'parent' => "#preguntas",
						'body' => View::make("elements.admin.educacion_configurar_form_pregunta_tmpl", 
									['count' =>$loop->index +1, "pregunta" => $pregunta, 'type' => 'edit']
								)->render()
						])
					
				@endforeach
			</div>
			<div class="form-group text-right">
				<button 
				class="btn btn-primary add-form" 
				data-target="#preguntas" 
				data-cls-tmpl ="pregunta"
				data-type="accordion" 
				data-title-head="Nueva Pregunta"
  				data-add-position="last"
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

	<script id="tmpl-accordion-add" type="text/x-dot-template">
		@include('elements.acorddion_tmpl', [
				'target' => "{%=it.targetContent%}",
				'idTarget' => "{%=it.targetContent.substring(1)%}",
				'title' => "{%=it.titleHead%}",
				'parent' => "{%=it.target%}",
				'body' =>'{%=it.body%}'
			])
	</script>

	@endisset

	<div class="form-group text-center mt-3">
        <a href="{{ route('admin.educacion') }}" class="btn btn-danger"> Regresar </a>  
</div>
@endsection
