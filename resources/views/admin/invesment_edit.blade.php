@extends('layouts.app-admin')



@section('title', 'Usuarios :: Administración Investment')
@section('panel-title' ,'Administracion Investment')


@php
	$contrato =$user->contract;

@endphp


@section('content')

	@include('elements.admin.invesment_edit_contract',compact('contrato'))

	@isset( $contrato)

	@php
			$representantes = $contrato ->representants;
			$documentos= $contrato->documents;

	@endphp

	<div class="card">
		<div class="card-header">
		       Registro de  Representantes
		</div>
	  	<div class="card-body">
		  	<div class="form-group text-center">
				<button 
				class="btn btn-primary add-form" 
				data-target="#representantes" 
				data-type="accordion" 
				data-title-head="Nuevo Representante"
				data-id-tmpl="#tmpl-representante"> Agregar Representante</button>
			</div>
	  		<div id="representantes" class="mt-3" >

				@foreach( $representantes AS $representante )
					

					@include('elements.acorddion_tmpl', [
					'extraClsTmpl' => "tmpl-item",
					'target' => "#repr_".$loop->index,
					'idTarget' => "repr_".$loop->index,
					'title' => $representante->typeRepresent->name  ." - ". $representante->name." ".$representante->last_name." ".$representante->last_second_name  ,
					'parent' => "#representantes",
					'body' => View::make("elements.admin.invesment_edit_panel_representant_tmpl", 
								[
								'user' => $user,
								'contrato' => $contrato,
								'count' => $loop->index , 
								"representante" => $representante, 
								'type' => 'edit' ,
								'catTypeReprensentant' =>$catTypeReprensentant, 
								'catBancks' => $catBancks,
								'catClasifCountBanck' => $catClasifCountBanck
							])->render()
					])

					
					
				@endforeach
			</div>
	  	</div>
	</div>

	<div class="card mt-3">
		<div class="card-header">
		       Registro de Recibos (Archivos)
		</div>
	  	<div class="card-body">
	  			<div class="form-group text-center">
  					<button 
  					class="btn btn-primary add-form" 
  					data-target="#archivos" 
  					data-title-head="Nuevo Documento"
  					data-cls-tmpl="documento"
  					data-id-tmpl="#tmpl-archivo"> Agregar Documento</button>
  				</div>

	  			<div id="archivos">
	  				@foreach($documentos as $documento)
	  				<div class="documento tmpl-item">
	  					@include("elements.admin.invesment_edit_form_document_tmpl", ['count' =>$loop->index +1 , 'type' => 'edit' , 'documento' => $documento])
	  				</div>

	  				@endforeach

	  			</div>



	  	</div>
	</div>



	<script id="tmpl-representante" type="text/x-dot-template">
		@include("elements.admin.invesment_edit_panel_representant_tmpl", ['count' =>"{%=it.count%}" , "representante" => null, 'type' => 'register'])
	</script>

	<script id="tmpl-cuenta-banco" type="text/x-dot-template">
		@php
			$representante= null;
			$cuenta=null;
			$count = "{%=it.count + 1%}";
			$type= "register";
		@endphp
			@include("elements.admin.invesment_edit_form_count", compact('user','representante','cuenta','count','edit','type'))
	</script>

	<script id="tmpl-archivo" type="text/x-dot-template">
		@include("elements.admin.invesment_edit_form_document_tmpl", ['count' =>"{%=it.count +1 %}" ,'type' => 'register' , 'documento' => null])
	
	</script>

	<div id="view-doc" class="modal-view-doc">
		  <span class="close">&times;</span>
		  <div class="content" > </div>
		  <div class="caption"></div>
	</div>


	@endisset


	<div class="form-group text-center mt-3">
	        <a href="{{ route('admin.invesment') }}" class="btn btn-danger"> Regresar </a>  
	</div>

	<script id="tmpl-accordion-add" type="text/x-dot-template">
		@include('elements.acorddion_tmpl', [
				'target' => "{%=it.targetContent%}",
				'idTarget' => "{%=it.targetContent.substring(1)%}",
				'title' => "{%=it.titleHead%}",
				'parent' => "{%=it.target%}",
				'body' =>'{%=it.body%}'
			])
	</script>
@endsection
