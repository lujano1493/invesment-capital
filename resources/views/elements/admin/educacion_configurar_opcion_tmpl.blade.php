<div class="row">


	{{ Form::bsInput('opciones['.  $count . '][id]' ,'hidden' , [

			] ) }}



	<div class="col-12 col-sm-4">
		{{ Form::bsInput('opciones['.  $count . '][enciso]'  ,'text' , [ 
			'label' =>'Enciso',
			'value' => old('enciso'),
			'attr' =>[
				'required' =>true
			]   
			]) }}
	</div>
	<div class="col-12 col-sm-4 ">
		{{ Form::bsInput( 'opciones['.  $count . '][valor]'  ,'text' , [ 
			'label' =>'Valor',
			'value' => old('valor'),
			'attr' =>[
				'required' =>true
			]   

			]) }}

	</div>

	<div class="col-6 col-sm-4 mt-4">
		<div class="form-group text-center">
			{{ Form::Button('Eliminar' , [
				'class' => 'btn btn-danger  btn-delete-form' ,
				'type' =>'submit', 
				'data-name-id' => 'opciones['.  $count . '][id]'  ,
				'data-scope' => '.opcion' ,
				'data-url' => route('admin.educacion.elimina.opcion') 
				]  )
				 }}
		</div>
	</div>
</div>
	
