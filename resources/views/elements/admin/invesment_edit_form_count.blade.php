{{ Form::model( $cuenta ,['route' => ['admin.users.edit.count.bank' , $user ]  ] ) }}
	@include('elements/admin/invesment_edit_count_tmpl', compact('user','representante','count'))
	<div class="form-group text-center">
			@if ( $type ==='register')
				{{ Form::Button('Registrar' , ['class' => 'btn btn-primary btn-ajax' , 'type' =>'submit' ]  ) }}
			@elseif ($type === 'edit')
				{{ Form::Button('Editar' , ['class' => 'btn btn-success btn-ajax' , 'type' =>'submit' ]  ) }}
			@endif
		{{ Form::Button('Eliminar' , ['class' => 'btn btn-danger  btn-delete-form' , 'type' =>'submit'  , 'data-url' => route('admin.users.delete.count.bank') ]  ) }}
	</div>
{{ Form::close() }}