<div class="card">
	  <div class="card-header">
	        Cuestionario
	  </div>
  <div class="card-body">
       {{ Form::model(  $cuestionario ,['route' => ['admin.educacion.administrar' , $cuestionario ] ]) }}
   			{{ Form::bsInput('id' ,'hidden' ) }}

			<div class="row">

				<div class="col-12 col-sm-6">
					{{ Form::bsInput('titulo' ,'text' , [ 
						'label' =>'Titulo de Cuestionario',
						'value' =>old('titulo'),
						'attr' =>[
								'required' =>true
							]   

					]) }}

				</div>
				<div class="col-12 col-sm-6">
					@php
						$expiredDefault =\Carbon\Carbon::today()->addDay(15);   // fecha de caducidad por defecto
					@endphp
					{{ Form::bsInput('fecha_limite' ,'date' , [ 
						'label' =>'Fecha Limite',
						'value' =>old('fecha_limite') ? :$expiredDefault ,
						'attr' =>[
								'required' =>true
							]   

					]) }}

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