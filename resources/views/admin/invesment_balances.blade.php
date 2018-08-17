@extends('layouts.app-admin')



@section('title', 'Usuarios :: Administración de Saldos')
@section('panel-title' ,'Administración de Saldos')


@php
	$contrato =$user->contract;

@endphp


@section('content')


	@isset( $contrato)

	@php
		
			$transacciones= $contrato->transactions()->orderBy("id","asc")->get();
			$balances = $contrato->balances()->orderBy("id","desc")->get();
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
  					data-cls-tmpl="transaccion"
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
  					id="btnAgregaSaldos"
  					class="btn btn-primary add-form" 
  					data-target="#balances" 
  					data-type="accordion" 
  					data-title-head="Nuevo Balance"
  					data-add-position="first"
  					data-id-tmpl="#tmpl-balance"> Agregar </button>
  				</div>


	  			<div id="balances">
	  				@foreach($balances as $balance)

	  				@include('elements.acorddion_tmpl', [
						'extraClsTmpl' => "tmpl-item",
						'show' => $loop->first,
						'target' => "#balance_".$loop->index,
						'idTarget' => "balance_".$loop->index,
						'title' => "Balance del " .( $balance->creacion ) ,
						'parent' => "#balances",
						'body' => View::make("elements.admin.invesment_edit_form_balance_tmpl", 
									[
										'count' =>$loop->index +1 , 
										'type' => 'edit' , 
										'user' => $user,
										'contrato' => $contrato,
										'balance' => $balance,
										'catStatusBalance' =>$catStatusBalance
									]
								)->render()
						])

	  				@endforeach

	  			</div>



	  	</div>
	</div>



		<script id="tmpl-transaccion" type="text/x-dot-template">
			@include("elements.admin.invesment_edit_form_trans_tmpl", ['count' =>"{%=it.count +1 %}" ,'type' => 'register' , 'transaccion' => null])
		</script>

		<script id="tmpl-balance" type="text/x-dot-template">
			@include("elements.admin.invesment_edit_form_balance_tmpl", ['count' =>"{%=it.count +1 %}" ,'type' => 'register' , 'balance' => null])
		</script>
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