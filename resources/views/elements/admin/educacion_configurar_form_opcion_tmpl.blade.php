{{ Form::model( $opcion  ,['route' => ['admin.educacion.opcion' , $opcion ] ] ) }}
	@include('elements/admin/educacion_configurar_opcion_tmpl', compact('type','pregunta','cuestionario'))
{{ Form::close() }}