{{ Form::model( $documento ,['route' => ['admin.users.edit.document' , $user ]  ,'files' => true] ) }}
	@include('elements/admin/invesment_edit_document_tmpl', compact('user','documento','type'))
	<div class="form-group text-center mt-3">
			@if ( $type ==='register')
				{{ Form::Button('Registrar' , ['class' => 'btn btn-primary btn-ajax ' , 'type' =>'submit' ]  ) }}
			@endif
		{{ Form::Button('Eliminar' , ['class' => 'btn btn-danger  btn-delete-form' , 'type' =>'submit'  , 'data-url' => route('admin.users.delete.document') ]  ) }}
	</div>
{{ Form::close() }}