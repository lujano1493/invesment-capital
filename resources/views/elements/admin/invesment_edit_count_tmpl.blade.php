{{ Form::bsInput('id' ,'hidden' ) }}
{{ Form::bsInput('id_user' ,'hidden', ['value' => $user->id]) }}
{{ Form::bsInput('id_contract' ,'hidden', ['value' => $contrato->id]) }}
{{ Form::bsInput('id_representant' ,'hidden', ['value' =>  isset($representante) ? $representante->id : '']) }}

<div class="card mt-3">

	<div class="card-header"> 
	Cuenta Bancaria {{ $count }} 
	</div>

	<div class="card-body">
		<div class="row">
			<div class="col-12 col-sm-3">
				{{ Form::bsInput('id_bank' ,'select' , [ 
					'label' =>'Banco',
					'value' =>old('id_bank'),
					'list' =>$catBancks,
					'empty_option'=> 'Seleccione banco ...',
					'attr' =>[
						'required' =>true
					]   
					]) }}
			</div>
			<div class="col-12 col-sm-3">
				{{ Form::bsInput('number_count' ,'text' , [ 
					'label' =>'Numero de cuenta',
					'value' =>old('number_count'),
					'attr' =>[
						'required' =>true
					]   

					]) }}

			</div>
			<div class="col-12 col-sm-3">
				{{ Form::bsInput('clabe' ,'text' , [ 
					'label' =>'CLABE',
					'value' =>old('clabe'),
					'attr' =>[
						'required' =>true
					]   

					]) }}

			</div>
			<div class="col-12 col-sm-3">
				{{ Form::bsInput('type_clasif' ,'select' , [ 
					'label' =>'Tipo de Cuenta',
					'value' =>old('type_clasif'),
					'list' =>$catClasifCountBanck,
					'empty_option'=> 'Seleccione tipo de cuenta ...',
					'attr' =>[
						'required' =>true
					]   
					]) }}
			</div>
		</div>
		
	</div>
	

	

</div>
