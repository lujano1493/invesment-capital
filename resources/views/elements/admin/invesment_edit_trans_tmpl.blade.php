{{ Form::bsInput('id' ,'hidden' ) }}
{{ Form::bsInput('id_user' ,'hidden', ['value' => $user->id]) }}
{{ Form::bsInput('id_contract' ,'hidden', ['value' => $contrato->id]) }}
{{ Form::bsInput('count' ,'hidden', ['value' => $count]) }}

<div class="card mt-3">

	<div class="card-header"> 
	 Transacción {{ $count }} 
	</div>
	<div class="card-body">
		<div class="row">
			<div class="col-12 col-sm-3">
				{{ Form::bsInput('id_type_transaction' ,'select' , [ 
					'label' =>'Tipo',
					'value' =>old('id_type_transaction'),
					'list' =>$catTypeTrans,
					'attr' =>[
						'required' =>true
					]   
					]) }}
			</div>
			<div class="col-12 col-sm-3">
				{{ Form::bsInput('id_status_transaction' ,'select' , [ 
					'label' =>'Estatus',
					'value' =>old('id_status_transaction'),
					'list' =>$catStatusTrans,
					'attr' =>[
						'required' =>true
					]   
					]) }}
			</div>

			<div class="col-12 col-sm-3">
				{{ Form::bsInput('amount' ,'number' , [ 
					'label' =>'Monto',
					'value' =>old('amount'),
					'attr' =>[
						'required' =>true
					]   
					]) }}
			</div>
			<div class="col-12 col-sm-3">
				{{ Form::bsInput('id_origin' ,'select' , [ 
					'label' =>'Origen',
					'value' =>old('id_origin'),
					'list' =>$catOriginTrans,
					'attr' =>[
						'required' =>true
					]   
					]) }}
			</div>
		
		
		</div>
	</div>

	

</div>
