@extends('layouts.app-admin')



@section('title', 'Usuarios :: Administración de Saldos')
@section('panel-title' ,'Administracion de Saldos')


@php
	$contrato =$user->contract;

@endphp


@section('content')


	@isset( $contrato)

	@php
		
			$transacciones= $contrato->transactions;
			$balances = $contrato->balances;
	@endphp

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

	<div class="card mt-3">
		<div class="card-header">
		     Historial de Saldos
		</div>
	  	<div class="card-body">
	  		
  			    <div class="form-group text-center">
  					<button 
  					class="btn btn-primary add-form" 
  					data-target="#balances" 
  					data-title-head="Nuevo Balance"
  					data-id-tmpl="#tmpl-balance"> Agregar </button>
  				</div>


	  			<div id="balances">
	  				@foreach($balances as $balance)
	  				<div class="balance tmpl-item">
	  					@include("elements.admin.invesment_edit_form_balance_tmpl", ['count' =>$loop->index +1 , 'type' => 'edit' , 'balance' => $balance])
	  				</div>

	  				@endforeach

	  			</div>



	  	</div>
	</div>



		<script id="tmpl-transaccion" type="text/x-dot-template">
			<div class="transaccion">
			@include("elements.admin.invesment_edit_form_trans_tmpl", ['count' =>"{%=it.count +1 %}" ,'type' => 'register' , 'transaccion' => null])
			</div>
		</script>

		<script id="tmpl-balance" type="text/x-dot-template">
		<div class="balance">
			@include("elements.admin.invesment_edit_form_balance_tmpl", ['count' =>"{%=it.count +1 %}" ,'type' => 'register' , 'balance' => null])
		</div>
		</script>
	@endisset
	
	<div class="form-group text-center mt-3">
	        <a href="{{ route('admin.invesment') }}" class="btn btn-danger"> Regresar </a>  
	</div>
	<script id="tmpl-accordion-add" type="text/x-dot-template">
		@include('elements.acorddion_tmpl')
	</script>
@endsection