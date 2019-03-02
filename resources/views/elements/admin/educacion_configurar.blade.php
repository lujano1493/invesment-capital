<div class="card">
	  <div class="card-header">
	        Cuestionario
	  </div>
  <div class="card-body">
       {{ Form::model(  $cuestionario ,['route' => ['admin.educacion.administrar' , $cuestionario ] ]) }}
   			{{ Form::bsInput('id' ,'hidden' ) }}

			<div class="row">

				<div class="col-12 col-sm-12">
					{{ Form::bsInput('titulo' ,'text' , [ 
						'label' =>'Titulo de Cuestionario',
						'value' =>old('titulo'),
						'attr' =>[
								'required' =>true
							]   
					]) }}

				</div>

				@php

							$defaultDate=  \Carbon\Carbon::today()->addDay(30)->format('Y-m-d');
							if( isset($cuestionario)){
								$tipo =  $cuestionario ->tipo;
								$valueFecha=  $tipo == 1 ? $cuestionario->fecha_limite->format('Y-m-d')  : null;   
								$valueFecha = $tipo == 2 ?  $cuestionario->fecha_limite->format('H:i:s') : $valueFecha;

								$labelFechaLimite=  $tipo == 1 ? 'Fecha Limite' : null;   
								$labelFechaLimite = $tipo == 2 ?  'Tiempo Limite (HH:MM)' : $labelFechaLimite;

								$typeInput= $tipo == 1 ? 'date' : 'hidden';  
								$typeInput= $tipo == 2 ? 'time' : $typeInput;  

								$required= $tipo == 1 ? true : false;  
								$required= $tipo == 2 ? true : $required;  

							}
							else{
								$tipo =null;
								$typeInput ="hidden";
								$labelFechaLimite="";
								$valueFecha= $defaultDate ;
								$required=false;
							}
							
						    
						@endphp

				<div class="col-12 col-sm-6">
					{{ Form::bsInput('tipo' ,'select' , [ 
						'label' =>'Tipo de Limite',
						'list' => [ "" => "Seleccione tipo de limite", "0"  => "Sin Limite" ,"1" => "por Fecha" ,"2" => "por Tiempo" ],
						'value' =>old('tipo'),
						'attr' =>[
								'required' =>true,
								'class' =>'input-dinamic-select',
								'data-target' =>".fecha-limite",
								'data-target-label' => ".input-dinamic-label",
								'data-options' =>  json_encode( [ 
									"0" => [ "type" => "hidden" ,"label" => "" , "default" =>""  , "required" =>"false" ],
									"1" => [ "type" => "date" ,"label" => "Fecha Limite" , "default" => $defaultDate,"required" =>"true"  ] ,
									"2" => ["type" => "time",  "label" =>"Tiempo Limite (HH:MM)",  "default" => "01:00" , "required" =>"true" ]

								] )		
							]   

					]) }}

				</div>
					<div class="col-12 col-sm-6">
						<div class="form-group  ">
							<label class="input-dinamic-label">  {{ $labelFechaLimite }}</label>

						{{ Form::bsInput('fecha_limite' ,$typeInput , [ 
							'value' =>  $valueFecha   ,
							'attr' =>[
									'required' =>$required,
									'class' => 'fecha-limite'
								]   

						]) }}


						</div>


					</div>
			
				
			</div>

			<div class="row">
				<div class="col-12 ">
					{{ Form::bsInput('descripcion' ,'textarea' , [ 
						'label' =>'Descripción',
						'value' =>old('descripcion'),
						'attr' =>[
								'required' =>true
							]   

					]) }}

				</div>
			</div>


		   <div class="form-group text-center">
               {{ Form::Button('Guardar' , ['class' => 'btn btn-primary '.( isset($cuestionario)? 'btn-ajax':'' ) , 'type' =>'submit' ]  ) }}
            </div>
				
      {{ Form::close() }}
  </div>
</div>