<div class="card">
	  <div class="card-header">
	        Contrato de Usuario
	  </div>
  <div class="card-body">
       {{ Form::model(  $contrato ,['route' => ['admin.users.edit.contract' , $user ] ]) }}
   			{{ Form::bsInput('id' ,'hidden' ) }}
   			{{ Form::bsInput('id_user' ,'hidden', ['value' => $user->id]) }}
			<div class="row">

				<div class="col-12 col-sm-4">
					{{ Form::bsInput('id_profile_invesment' ,'select' , [ 
						'label' =>'Perfil de inversión',
						'value' =>old('id_profile_invesment'),
						'list' =>$catProfile,
						'empty_option'=> 'Seleccione perfil ...',
						'attr' =>[
								'required' =>true
							]   

					]) }}

				</div>
				<div class="col-12 col-sm-4">
					{{ Form::bsInput('id_horizon_invesment' ,'select' , [ 
						'label' =>'Horizonte de Inversion',
						'value' =>old('id_horizon_invesment'),
						'list' =>$catHorizon,
						'empty_option'=> 'Seleccione horizonte  ...',
						'attr' =>[
								'required' =>true
							]   

					]) }}

				</div>
				<div class="col-12 col-sm-4">
					{{ Form::bsInput('id_type_objective' ,'select' , [ 
						'label' =>'Tipo de Objetivo',
						'value' =>old('id_type_objective'),
						'list' =>$catTypeObjective,
						'empty_option'=> 'Seleccione objetivo  ...',
						'attr' =>[
								'required' =>true
							]   

					]) }}

				</div>
			</div>


			   <div class="form-group text-center">
                   {{ Form::Button('Guardar' , ['class' => 'btn btn-primary ' , 'type' =>'submit' ]  ) }}
                </div>
				
      {{ Form::close() }}
  </div>
</div>