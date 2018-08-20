{{ Form::bsInput('id' ,'hidden' ) }}
{{ Form::bsInput('id_cuestionario' ,'hidden', ['value' =>  isset($cuestionario)  ? $cuestionario->id :null     ]) }}
{{ Form::bsInput('id_pregunta' ,'hidden', ['value' =>  isset($pregunta)  ? $pregunta->id :null     ]) }}

<div class="row">
	<div class="col-12 col-sm-3">
		{{ Form::bsInput('enciso' ,'text' , [ 
			'label' =>'Enciso',
			'value' =>old('enciso'),
			'attr' =>[
				'required' =>true
			]   
			]) }}
	</div>
	<div class="col-12 col-sm-3 ">
		{{ Form::bsInput('valor' ,'text' , [ 
			'label' =>'Valor',
			'value' =>old('valor'),
			'attr' =>[
				'required' =>true
			]   

			]) }}

	</div>
	@if ( $type ==='register')
		<div class="col-6 col-sm-3 mt-4">
			<div class="form-group text-center">
				{{ Form::Button('Guardar' , ['class' => 'btn btn-primary btn-ajax ' , 'type' =>'submit' ]  ) }}
			</div>
		</div>
	@endif
	<div class="col-6 col-sm-3 mt-4">
		<div class="form-group text-center">
			{{ Form::Button('Eliminar' , ['class' => 'btn btn-danger  btn-delete-form' , 'type' =>'submit','data-url' => route('admin.educacion.elimina.opcion') ]  ) }}
		</div>
	</div>
</div>
	
