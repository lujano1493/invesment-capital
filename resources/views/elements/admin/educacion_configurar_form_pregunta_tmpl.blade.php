{{ Form::model( $pregunta  ,['route' => ['admin.educacion.pregunta' , $pregunta ] ] ) }}
	@include('elements/admin/educacion_configurar_pregunta_tmpl' , compact('pregunta'))
	<div class="form-group text-center mt-3">
			@if ( $type ==='register')
				{{ Form::Button('Registrar' , ['class' => 'btn btn-primary btn-ajax ' , 'type' =>'submit' ]  ) }}
			@elseif ($type === 'edit')
				{{ Form::Button('Editar' , ['class' => 'btn btn-success btn-ajax' , 'type' =>'submit' ]  ) }}
			@endif
		{{ Form::Button('Eliminar' , ['class' => 'btn btn-danger  btn-delete-form' , 'type' =>'submit','data-url' => route('admin.educacion.elimina.pregunta') ]  ) }}
	</div>
{{ Form::close() }}


<div id="opcion_{{$count}}">

	 @isset( $pregunta  )
		@php
			$opciones = $pregunta->opciones;
		@endphp
			@foreach( $opciones AS $opcion )
					<div class="opcion tmpl-item">
						@include("elements.admin.educacion_configurar_form_opcion_tmpl", 
		  				['count' =>$loop->index +1, "opcion" => $opcion, 'type' => 'edit'])
	  				</div>

			@endforeach
	@endisset

</div>