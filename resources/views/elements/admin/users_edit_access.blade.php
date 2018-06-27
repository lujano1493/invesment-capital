<div class="card card-form">
  <div class="card-header">
        Agregar Accesos a Módulos
  </div>
  <div class="card-body">
		  	{{ Form::open(['route' => ['admin.users.edit.access' , $user ] ]) }}

			<div class="row">

				<div class="col-12 col-sm-4">
					{{ Form::bsInput('id_module' ,'select' , [ 
						'label' =>'Módulo',
						'value' =>old('id_module'),
						'list' =>$catModules,
						'attr' =>[
								'required' =>true
							]   

					]) }}

				</div>
				


				<div class="col-12 col-sm-4">
					@php
						$date_expired_default =\Carbon\Carbon::today()->addDay(30);   // fecha de caducidad por defecto
					@endphp
					{{ Form::bsInput('date_expired', 'date',[
						'label' =>'Fecha Limite',
						'value' =>  old('date_expired') ? : $date_expired_default,
			            'attr' => [
			                            'placeholder' => 'Ingresa fecha limite',
			                            'required' =>true
			                        ]
					]) }}

					

				</div>
				<div class="col-12 col-sm-4">
					<div class="form-group text-center">
					    {{ Form::Button('Agregar' , ['class' => 'btn btn-primary col-6' ,'style' => 'margin-top:30px', 'type' =>'submit' ]  ) }}
					</div>

				</div>
			

			</div>

		{{ Form::close() }}
       
  </div>
</div>








<div class="card">
  <div class="card-header">
        Modificación Accesos a Módulos
  </div>
  <div class="card-body">

	@php
		$modules = $user->modules;
	@endphp

	@foreach( $modules as   $module)

	<div class="card card-form">

		<div class="card-body">
		{{ Form::model( $module->access ,['route' => ['admin.users.edit.access' , $user ] ]) }}

			{{ Form::hidden("index" ,  $loop->index  ) }}

			{{ Form::bsInput("id" , 'hidden',[
					'elementIndex' => $loop->index
				] ) }}

			{{ Form::bsInput('id_module' ,'select' , [ 
					'label' =>'Módulo',
					'value' =>old('id_module'),
					'list' =>$catModules,
					'value_current' =>true,
					'elementIndex' => $loop->index,
					'attr' =>[
							'required' =>true
						]   

				]) }}
			
			{{ Form::bsInput('date_expired', 'date',[
					'label' =>'Fecha Limite',
					'elementIndex' => $loop->index,
		            'attr' => [
		                            'placeholder' => 'Ingresa fecha limite',
		                            'required' =>true
		                        ]
				]) }}


				<div class="form-group text-center">
					{{ Form::Button('Modificar' , ['class' => 'btn btn-primary ' , 'type' =>'submit' ]  ) }}
			   		 <a href="{{ route('admin.users.delete.access' , ['idUser' =>$user->id , 'id' =>$module->id ]  ) }}" class="btn btn-danger ">Eliminar</a>
				</div>
		</div>
	</div>    

		{{ Form::close() }}
	@endforeach
	</div>
</div>












