@php
	$modules = Auth::user()->modules;
@endphp

@foreach( $modules as   $module)

	{{ Form::model( $module->access ,['route' =>'capital.profile' ,'class' =>'well'  ] ) }}
		<div class="row">
			<div class="col-sm-6">
				{{ Form::bsInput('id_module' ,'select' , [ 
				'label' => ['text' =>'Módulo', 'class'=>'control-label' ],
				'list' =>$catModulos,
				'value_current' =>true,
				'elementIndex' => $loop->index,
				'attr' =>[
						'required' =>true,
						'disabled' =>true
					]   

				]) }}

				
			</div>

			<div class="row">
				<div class="col-sm-6">
					{{ Form::bsInput('date_expired', 'date',[
							'label' =>['text' => 'Fecha Limite','class' =>'control-label' ],
							'elementIndex' => $loop->index,
				            'attr' => [
				                            'placeholder' => 'Ingresa fecha limite',
				                            'required' =>true,
											'disabled' =>true
				                        ]
						]) }}
				</div>
			</div>
					
		

			

		</div>
		
	{{ Form::close() }}
@endforeach



{{ Form::close() }}











