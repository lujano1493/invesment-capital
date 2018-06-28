@extends('layouts.app-admin')



@section('title', 'Usuarios :: Administración Invesment')
@section('panel-title' ,'Administracion Invesment')


@php
	$contrato =$user->contract;

@endphp


@section('content')

	@include('elements.admin.invesment_edit_contract',compact('contrato'))

	@isset( $contrato)

	<div class="card">
		<div class="card-header">
		       Registro de  Representantes
		</div>
	  	<div class="card-body">
	  		{{ Form::open( ['route' => ['admin.users.edit.contract' , $user ] ]) }}
   			{{ Form::bsInput('id' ,'hidden' ) }}
   			{{ Form::bsInput('id_user' ,'hidden', ['value' => $user->id]) }}
   			{{ Form::bsInput('id_contract' ,'hidden', ['value' => $contrato->id]) }}
			<div class="row">

				<div class="col-12 col-sm-4">
					{{ Form::bsInput('id_type_representant' ,'select' , [ 
						'label' =>'Tipo de Representante',
						'value' =>old('id_type_representant'),
						'list' =>$catTypeReprensentant,
						'empty_option'=> 'Seleccione tipo de representante ...',
						'attr' =>[
								'required' =>true
								
							]   

					]) }}

				</div>
				<div class="col-12 col-sm-4">
					{{ Form::bsInput('name' ,'text' , [ 
						'label' =>'Nombres(s)',
						'value' =>old('name'),
						'attr' =>[
								'required' =>true,
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
								'class' =>'apellido-mat-rfc '
							]   

					]) }}

				</div>
				<div class="col-12 col-sm-4">
					{{ Form::bsInput('birth_date' ,'date' , [ 
						'label' =>'Fecha de Nacimiento',
						'value' =>old('birth_date'),
						'attr' =>[
								'required' =>true,
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
								'required' =>true
							]   

					]) }}

				</div>
			</div>


			<div class="row">

				<div class="col-12 col-sm-2">
					{{ Form::bsInput('cp' ,'text' , [ 
						'label' =>'Codigo Postal',
						'value' =>old('cp'),
						'attr' =>[
								
							]   

					]) }}

				</div>
				<div class="col-12 col-sm-6">
					{{ Form::bsInput('street' ,'date' , [ 
						'label' =>'Calle o Avenida',
						'value' =>old('street')

					]) }}

				</div>
				<div class="col-12 col-sm-2">
					{{ Form::bsInput('noExt' ,'text' , [ 
						'label' =>'Numero Exterior',
						'value' =>old('noExt')

					]) }}

				</div>
				<div class="col-12 col-sm-2">
					{{ Form::bsInput('noInt' ,'text' , [ 
						'label' =>'Numero Interior',
						'value' =>old('noInt')

					]) }}
				</div>
			</div>

		   <div class="form-group text-center">
               {{ Form::Button('Registrar' , ['class' => 'btn btn-primary ' , 'type' =>'submit' ]  ) }}
            </div>
				
      {{ Form::close() }}


	  	</div>
	</div>
	@endisset



@endsection
