<div class="row">
	{{ Form::bsInput('opciones['.  $count . '][id]' ,'hidden' , [

			] ) }}
	<div class="col-12 col-sm-2">
		{{ Form::bsInput('opciones['.  $count . '][enciso]'  ,'text' , [ 
			'label' =>'Enciso',
			'value' => old('enciso'),
			'attr' =>[
				'required' =>true
			]   
			]) }}
	</div>
	<div class="col-12 col-sm-10">


		{{ Form::bsCheck( 'opciones['.  $count . '][es_correcto]'  ,'checkbox' , [ 
			'label' =>'Opción correcta',
			'clsExtra' => 'mb-3 mt-4',
			'id' => "es_correcto_{$parent_count}_{$count}",
			'value' => true,
			'attr' =>[
				
			]   

			]) }}
	
	</div>

	<div class="col-12 ">
		{{ Form::bsInput( 'opciones['.  $count . '][valor]'  ,'textarea' , [ 
			'label' =>'Valor',
			'value' => old('valor'),
			'attr' =>[
				'required' =>true,
				'cols' =>50,
				'rows' =>2
			]   

			]) }}

	</div>

	<div class="col-12">
		<div class="form-group text-center">
			{{ Form::Button('Eliminar Opción' , [
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
	
