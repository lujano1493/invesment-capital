

{{ Form::open(['route' => ['admin.users.edit.access' , $user ] ]) }}

	<div class="form-group">
		{{ Form::select('select',[1=> 'Invesment',2=> 'Educación Financiera'],[1,2], ['multiple' =>true ,'class' =>'form-control' ]) }}
	</div>


	<div class="form-group text-center">
	    {{ Form::Button('Agregar' , ['class' => 'btn btn-primary col-6' , 'type' =>'submit' ]  ) }}
	</div>

{{ Form::close() }}


