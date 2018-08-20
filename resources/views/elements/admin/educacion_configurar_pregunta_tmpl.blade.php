{{ Form::bsInput('id' ,'hidden' ) }}
{{ Form::bsInput('id_cuestionario' ,'hidden', ['value' =>  isset($cuestionario)  ? $cuestionario->id :null     ]) }}

<div class="card mt-3">
	<div class="card-header"> 
	Pregunta {{ $count }} 
	</div>

	<div class="card-body">
		<div class="row">
			<div class="col-12 col-sm-2">
				{{ Form::bsInput('secuencia' ,'number' , [ 
					'label' =>'Secuencia',
					'value' =>old('secuencia'),
					'attr' =>[
						'required' =>true
					]   
					]) }}
			</div>
			<div class="col-12 col-sm-4">
				{{ Form::bsInput('tipo' ,'select' , [ 
					'label' =>'Tipo de Pregunta',
					'value' =>old('tipo'),
					'list' =>[
							1 => 'Opción multiple',
							2 => 'Respuesta abierta'
					],
					'attr' =>[
						'required' =>true
					]   

					]) }}

			</div>
			<div class="col-12 col-sm-6">
				{{ Form::bsInput('pregunta' ,'text' , [ 
					'label' =>'Texto',
					'value' =>old('pregunta'),
					'attr' =>[
						'required' =>true
					]   

					]) }}

			</div>
		</div>
		<div class="row">
			<div class="col-9">
				{{ Form::bsInput('respuesta' ,'text' , [ 
					'label' =>'Respuesta',
					'value' =>old('respuesta'),
					'attr' =>[
						'required' =>true
					]   

					]) }}
				
			</div>


			<div class="col-3">
					{{ Form::Button('+' , [
							'class' => 'btn btn-primary  btn-add-opciones add-form mt-4',
							'data-target' => '#opcion_'.$count , 
							'data-id-tmpl'=>"#tmpl-opcion",
							'data-id-name' => "id_pregunta",
							'data-id-value'=>  isset($pregunta) ? $pregunta->id :"",    
							'type' =>'submit' ]  ) }}
			</div>
		</div>


	</div>
	

	

</div>
