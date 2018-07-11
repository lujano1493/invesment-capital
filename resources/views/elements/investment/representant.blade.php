@php

	$address = isset($representante) ?  $representante->address->first() :null;
@endphp
	{{ Form::model( $representante ,['route' => ['admin.users.edit.representant' , $user ]  ] ) }}

	<div class="row">

		<div class="col-12 col-sm-4">
			{{ Form::bsInput('id_type_representant' ,'select' , [ 
				'label' =>'Tipo de Representante',
				'value' =>old('id_type_representant'),
				'list' =>$catTypeReprensentant,
				'empty_option'=> 'Seleccione tipo de representante ...',
				'attr' =>[
					'required' =>true,
					'disabled' => true

				]   

				]) }}

		</div>
		<div class="col-12 col-sm-4">
			{{ Form::bsInput('name' ,'text' , [ 
				'label' =>'Nombres(s)',
				'value' =>old('name'),
				'attr' =>[
					'required' =>true,
					'disabled' => true,
					'class' =>'nombre-rfc'
				]   

				]) }}

		</div>
		<div class="col-12 col-sm-4">
			{{ Form::bsInput('last_name' ,'text' , [ 
				'label' =>'Apellido Paterno',
				'value' =>old('last_name'),
				'attr' =>[
					'required' =>true,
					'disabled' => true,
					'class' =>'apellido-pat-rfc'
				]   

				]) }}

		</div>
	</div>

	<div class="row">

		<div class="col-12 col-sm-4">
			{{ Form::bsInput('last_second_name' ,'text' , [ 
				'label' =>'Apellido Materno',
				'value' =>old('last_second_name'),
				'attr' =>[
					'class' =>'apellido-mat-rfc ',
					'disabled'=>true 
				]   

				]) }}

		</div>
		<div class="col-12 col-sm-4">
			{{ Form::bsInput('birth_date' ,'date' , [ 
			'label' =>'Fecha de Nacimiento',
			'value' =>old('birth_date'),
			'attr' =>[
				'required' =>true,
				'disabled' => true,
				'class' =>'fecha-nac-rfc'
			]   

			]) }}

		</div>
		<div class="col-12 col-sm-4">
			{{ Form::bsInput('rfc' ,'text' , [ 
				'label' =>'RFC',
				'value' =>old('rfc'),
				'attr' =>[
					'class' =>'rfc',
					'required' =>true,
					'disabled' => true
				]   

				]) }}

		</div>
		</div>


		<div class="row">

		<div class="col-12 col-sm-2">
			{{ Form::bsInput('cp' ,'text' , [ 
				'label' =>'Codigo Postal',
			'value' =>isset($address)?  $address->cp : old('cp'),
			'attr' =>[
				'required' =>true,
				'disabled' => true
			]   

			]) }}

		</div>
		<div class="col-12 col-sm-6">
		{{ Form::bsInput('street' ,'text' , [ 
			'label' =>'Calle o Avenida',
			'value' =>isset($address)?  $address->street : old('street'),
			'attr' =>[
					'required' =>true,
					'disabled' => true
				]  

			]) }}

		</div>
		<div class="col-12 col-sm-2">
		{{ Form::bsInput('noExt' ,'text' , [ 
			'label' =>'Numero Exterior',
			'value' => isset($address)?  $address->noExt : old('noExt'),
			'attr' =>[
					'required' =>true,
					'disabled' => true
				]  

			]) }}

		</div>
		<div class="col-12 col-sm-2">
			{{ Form::bsInput('noInt' ,'text' , [ 
				'label' =>'Numero Interior',
				'value' => isset($address)?  $address->noInt : old('noInt'),
				'attr' =>[
					
				]  

				]) }}
			</div>
		</div>
	{{ Form::close() }}
