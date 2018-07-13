{{ Form::model( $transaccion  ,['route' => ['admin.users.edit.transaction' , $user ] ] ) }}
	@include('elements/admin/invesment_edit_trans_tmpl', compact('user','transaccion','type'))
	<div class="form-group text-center mt-3">
			@if ( $type ==='register')
				{{ Form::Button('Registrar' , ['class' => 'btn btn-primary btn-ajax ' , 'type' =>'submit' ]  ) }}
			@elseif ($type === 'edit')
				{{ Form::Button('Editar' , ['class' => 'btn btn-success btn-ajax' , 'type' =>'submit' ]  ) }}
			@endif
		{{ Form::Button('Eliminar' , ['class' => 'btn btn-danger  btn-delete-form' , 'type' =>'submit'  , 'data-url' => route('admin.users.delete.transaction') ]  ) }}
	</div>
{{ Form::close() }}