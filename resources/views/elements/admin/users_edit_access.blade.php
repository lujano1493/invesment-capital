@php
	$modules = $user->modules;
@endphp

@foreach( $modules as   $module)

	{{ Form::model( $module->access ,['route' => ['admin.users.edit.access' , $user ] ]) }}

		{{ Form::hidden("index" ,  $loop->index  ) }}

		{{ Form::bsInput("id" , 'hidden',[
				'elementIndex' => $loop->index
			] ) }}

		{{ Form::bsInput('id_module' ,'select' , [ 
				'label' =>'Modulo',
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


		<div class="form-group ">
			<div class="row">
				{{ Form::Button('Modificar' , ['class' => 'btn btn-primary col-6' , 'type' =>'submit' ]  ) }}
		   		 <a href="{{ route('admin.users.delete.access' , ['idUser' =>$user->id , 'id' =>$module->id ]  ) }}" class="btn btn-danger col-6">Eliminar</a>
			</div>
		    
		</div>

	{{ Form::close() }}
@endforeach

{{ Form::open(['route' => ['admin.users.edit.access' , $user ] ]) }}

	{{ Form::bsInput('id_module' ,'select' , [ 
			'label' =>'Modulo',
			'value' =>old('id_module'),
			'list' =>$catModules,
			'attr' =>[
					'required' =>true
				]   

		]) }}

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

	<div class="form-group text-center">
	    {{ Form::Button('Agregar' , ['class' => 'btn btn-primary col-6' , 'type' =>'submit' ]  ) }}
	</div>

{{ Form::close() }}











