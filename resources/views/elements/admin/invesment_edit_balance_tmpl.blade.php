{{ Form::bsInput('id' ,'hidden' ) }}
{{ Form::bsInput('id_user' ,'hidden', ['value' => $user->id]) }}
{{ Form::bsInput('id_contract' ,'hidden', ['value' => $contrato->id]) }}
{{ Form::bsInput('count' ,'hidden', ['value' => $count]) }}

<div class="card mt-3">

	<div class="card-header"> 
	 Balance {{ $count }} 
	</div>
	<div class="card-body">
		<div class="row">
			<div class="col-12 col-sm-3">
				{{ Form::bsInput('payments' ,'number' , [ 
					'label' =>'Deposito Total',
					'value' =>old('payments'),
					'attr' =>[
						'required' =>true
					]   
					]) }}
			</div>

			<div class="col-12 col-sm-3">
				{{ Form::bsInput('withdrawals' ,'number' , [ 
					'label' =>'Retiro Total',
					'value' =>old('withdrawals'),
					'attr' =>[
						'required' =>true
					]   
					]) }}
			</div>
			<div class="col-12 col-sm-3">
				{{ Form::bsInput('change' ,'number' , [ 
					'label' =>'-Min usvalia/ +Plusvalia',
					'value' =>old('change'),
					'attr' =>[
						'required' =>true
					]   
					]) }}
			</div>

			<div class="col-12 col-sm-3">
				{{ Form::bsInput('balance' ,'number' , [ 
					'label' =>'Saldo Base',
					'value' =>old('balance'),
					'attr' =>[
						'required' =>true
					]   
					]) }}
			</div>
			
		</div>

			<div class="row">

			<div class="col-12 col-sm-3">
				{{ Form::bsInput('balance_total' ,'number' , [ 
					'label' =>'Saldo Total',
					'value' =>old('balance_total'),
					'attr' =>[
						'required' =>true
					]   
					]) }}
			</div>

			<div class="col-12 col-sm-3">
				{{ Form::bsInput('renta_variable' ,'number' , [ 
					'label' =>'Fondos Renta Variable',
					'value' =>old('renta_variable'),
					'attr' =>[
						'required' =>true
					]   
					]) }}
			</div>
			<div class="col-12 col-sm-3">
				{{ Form::bsInput('deuda' ,'number' , [ 
					'label' =>'Fondos Deuda',
					'value' =>old('deuda'),
					'attr' =>[
						'required' =>true
					]   
					]) }}
			</div>

			<div class="col-12 col-sm-3">
				{{ Form::bsInput('id_status_balance' ,'select' , [ 
					'label' =>'Saldo Base',
					'value' =>old('id_status_balance'),
					'list' => $catStatusBalance,
					'attr' =>[
						'required' =>true
					]   
					]) }}
			</div>

			
		
		</div>
		@if($type == 'edit')
		<div class="row">
			
			<div class="col-12 col-sm-3">
				{{ Form::bsInput('created_at' ,'text' , [ 
					'label' =>'Registro',
					'value' =>old('created_at'),
					'attr' =>[
						'required' =>true,
						'disabled' => true
					]   
					]) }}
			</div>
		</div>
		@endif
	</div>

	

</div>
