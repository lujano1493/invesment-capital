{{ Form::bsInput('id' ,'hidden' ) }}
{{ Form::bsInput('id_cuestionario' ,'hidden', ['value' =>  isset($cuestionario)  ? $cuestionario->id :null     ]) }}

<div class="card mt-3">
	<div class="card-header"> 
	Pregunta {{ $count  }} 
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

			<div class="col-5">
				{{ Form::bsInput('puntaje' ,'number' , [ 
					'label' =>'Puntaje',
					'value' =>old('puntaje'),
					'attr' =>[
						'required' =>true
					]   

					]) }}
				
			</div>
			
		</div>
		<div class="row">
			
			<div class="col-12 ">
				{{ Form::bsInput('pregunta' ,'textarea' , [ 
					'label' =>'Texto',
					'value' =>old('pregunta'),
					'attr' =>[
						'required' =>true,
						'rows' => 2,
						'cols' =>50
					]   

					]) }}

			</div>
		</div>

		<div class="row">
			<div class="col-12 text-left">
			<h7 > <b> Opciones </b></h7>
			</div>
			
		</div>		
		<div class="row">
			<div id="opcion_{{$count}}" class="mt-3 sub-tmpl body-opcion">

			 @isset( $pregunta  )
				@php
					$opciones = $pregunta->opciones;
				@endphp
					@foreach( $opciones AS $opcion )
							<div class="opcion tmpl-item">
								@include("elements.admin.educacion_configurar_opcion_tmpl", 
				  				[  'parent_count' => $count ,'count' =>$loop->index , "opcion" => $opcion, 'type' => 'edit'])
			  				</div>

					@endforeach
			@endisset

			</div>	
		
		</div>	

		

		<div class="row">
		 	<div class="mt-3 col-12 text-left">
					{{ Form::Button('Agregar opciones' , [
							'class' => 'btn btn-primary  btn-add-opciones add-form',
							'data-target' => '#opcion_'.$count , 
							'data-id-tmpl'=>"#tmpl-opcion",
							'data-id-name' => "id_pregunta",
							'data-cls-tmpl' =>"opcion",
							'data-parent-target' => '.pregunta',
							'data-id-value'=>  isset($pregunta) ? $pregunta->id :"",    
							'type' =>'submit' ]  ) }}
			</div>
			
		</div>


	</div>
	

	

</div>
