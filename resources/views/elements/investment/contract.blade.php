@php
	 $user=  Auth::user();
@endphp


{{ Form::model(  $user->contract ,['route' => ['admin.users.edit.contract' , $user ] ]) }}
	<div class="row">

		<div class="col-xs-12 col-sm-4">
			{{ Form::bsInput('id_profile_invesment' ,'select' , [ 
				'label' =>'Perfil de inversión',
				'value' =>old('id_profile_invesment'),
				'list' =>$catProfile,
				'empty_option'=> 'Seleccione perfil ...',
				'attr' =>[
						'required' =>true,
						'disabled' =>true
					]   

			]) }}

		</div>
		<div class="col-xs-12 col-sm-4">
			{{ Form::bsInput('id_horizon_invesment' ,'select' , [ 
				'label' =>'Horizonte de Inversion',
				'value' =>old('id_horizon_invesment'),
				'list' =>$catHorizon,
				'empty_option'=> 'Seleccione horizonte  ...',
				'attr' =>[
						'required' =>true,
						'disabled' =>true
					]   

			]) }}

		</div>
		<div class="col-xs-12 col-sm-4">
			{{ Form::bsInput('id_type_objective' ,'select' , [ 
				'label' =>'Tipo de Objetivo',
				'value' =>old('id_type_objective'),
				'list' =>$catTypeObjective,
				'empty_option'=> 'Seleccione objetivo  ...',
				'attr' =>[
						'required' =>true,
						'disabled' =>true
					]   

			]) }}

		</div>
	</div>
{{ Form::close() }}
 