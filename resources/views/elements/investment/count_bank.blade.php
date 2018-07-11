
{{ Form::model( $cuenta ,['route' => ['admin.users.edit.count.bank' , $user ]  ] ) }}
<div class="panel panel-info">

	<div class="panel-heading"> 
		<h5 class="panel-title">
			Cuenta Bancaria {{ $numero }} 
		</h5>
	
	</div>

	<div class="panel-body">
		<div class="row">
			<div class="col-12 col-sm-3">
				{{ Form::bsInput('id_bank' ,'select' , [ 
					'label' =>'Banco',
					'value' =>old('id_bank'),
					'list' =>$catBancks,
					'empty_option'=> 'Seleccione banco ...',
					'attr' =>[
						'required' =>true,
						'disabled' =>true
					]   
					]) }}
			</div>
			<div class="col-12 col-sm-3">
				{{ Form::bsInput('number_count' ,'text' , [ 
					'label' =>'Numero de cuenta',
					'value' =>old('number_count'),
					'attr' =>[
						'required' =>true,
						'disabled' =>true
					]   

					]) }}

			</div>
			<div class="col-12 col-sm-3">
				{{ Form::bsInput('clabe' ,'text' , [ 
					'label' =>'CLABE',
					'value' =>old('clabe'),
					'attr' =>[
						'required' =>true,
						'disabled' =>true
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
						'required' =>true,
						'disabled' =>true
					]   
					]) }}
			</div>
		</div>
		
	</div>
</div>

{{ Form::close() }}
