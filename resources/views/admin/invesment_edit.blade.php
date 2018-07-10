@extends('layouts.app-admin')



@section('title', 'Usuarios :: Administración Invesment')
@section('panel-title' ,'Administracion Invesment')


@php
	$contrato =$user->contract;

@endphp


@section('content')

	@include('elements.admin.invesment_edit_contract',compact('contrato'))

	@isset( $contrato)

	@php
			$representantes = $contrato ->representants;
			$documentos= $contrato->documents;

			$transacciones= $contrato->transactions;
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

					<div class="card tmpl-item">
						<div class="card-header">
							<h5>
							<button class="btn btn-link" data-toggle="collapse" data-target="#representantes_{{ $loop->index }}" aria-expanded="true" 
								aria-controls="representantes_{{ $loop->index }}">
								 {{ $representante->typeRepresent->name  }} - {{ $representante->name }} {{ $representante->last_name }} {{ $representante->last_second_name }}
					 		</button>
							</h5>

							</div>
						<div id="representantes_{{ $loop->index }}" class="collapse" data-parent="#representantes">
							<div  class="card-body" >
								@include("elements.admin.invesment_edit_panel_representant_tmpl", ['count' => $loop->index , "representante" => $representante, 'type' => 'edit' ])
							</div>
						</div>
					</div>
					
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


	<div class="card mt-3">
		<div class="card-header">
		      Transacciones
		</div>
	  	<div class="card-body">
	  		
  			    <div class="form-group text-center">
  					<button 
  					class="btn btn-primary add-form" 
  					data-target="#transacciones" 
  					data-title-head="Nueva Transacción"
  					data-id-tmpl="#tmpl-transaccion"> Agregar </button>
  				</div>


	  			<div id="transacciones">
	  				@foreach($transacciones as $transaccion)
	  				<div class="transaccion tmpl-item">
	  					@include("elements.admin.invesment_edit_form_trans_tmpl", ['count' =>$loop->index +1 , 'type' => 'edit' , 'transaccion' => $transaccion])
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
		<div class="cuenta-bancaria">
			@include("elements.admin.invesment_edit_form_count", compact('user','representante','cuenta','count','edit','type'))
		</div>
	</script>

	<script id="tmpl-archivo" type="text/x-dot-template">
		<div class="documento">
		@include("elements.admin.invesment_edit_form_document_tmpl", ['count' =>"{%=it.count +1 %}" ,'type' => 'register' , 'documento' => null])
		</div>
	</script>

	<div id="view-doc" class="modal-view-doc">
		  <span class="close">&times;</span>
		  <div class="content" > </div>
		  <div class="caption"></div>
	</div>

	<script id="tmpl-transaccion" type="text/x-dot-template">
		<div class="transaccion">
		@include("elements.admin.invesment_edit_form_trans_tmpl", ['count' =>"{%=it.count +1 %}" ,'type' => 'register' , 'transaccion' => null])
		</div>
	</script>
	@endisset


	@include('elements.acorddion_tmpl')
@endsection
