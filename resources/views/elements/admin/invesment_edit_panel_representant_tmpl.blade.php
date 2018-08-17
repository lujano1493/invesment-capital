<div id="panel-representante{{$count}}">
	<ul class="nav nav-tabs" id="myTab{{$count}}" role="tablist">
			<li class="nav-item">
		    <a class="nav-link active" id="datos-general{{$count}}" data-toggle="tab" href="#datosGeneral{{$count}}" role="tab" aria-controls="datosGeneral{{$count}}" aria-selected="true">Datos Generales</a>
		  </li>
		  <li class="nav-item">
		    <a class="nav-link" id="cuentas-tab{{$count}}" data-toggle="tab" href="#cuentas{{$count}}" role="tab" aria-controls="profil{{$count}}" aria-selected="false">
		    Cuentas Bancarias</a>
		  </li>
	</ul>
	<div class="tab-content mt-3" id="myTabContent{{$count}}">

		<div class="tab-pane fade show active" id="datosGeneral{{$count}}" role="tabpanel" aria-labelledby="datos-general{{$count}}">
			{{ Form::model( $representante ,['route' => ['admin.users.edit.representant' , $user ]  ] ) }}
	
				@include('elements/admin/invesment_edit_represent_tmpl', compact('user','representante','catTypeReprensentant'))
				<div class="form-group text-center">
					@if ( $type ==='register')
						{{ Form::Button('Registrar' , ['class' => 'btn btn-primary btn-ajax' , 'type' =>'submit' ]  ) }}
					@elseif ($type === 'edit')
						{{ Form::Button('Editar' , ['class' => 'btn btn-success btn-ajax' , 'type' =>'submit' ]  ) }}
					@endif
					{{ Form::Button('Eliminar' , [
						'class' => 'btn btn-danger  btn-delete-form' , 
						'type' =>'submit' , 
						'data-url' => route("admin.users.delete.representant" ) 
						 ]  ) }}
				</div>
			{{ Form::close() }}
		</div>

	 	<div class="tab-pane fade" id="cuentas{{$count}}" role="tabpanel" aria-labelledby="cuentas-tab{{$count}}">
			
 
			<div class="form-group text-center mt-3">
					<button 
					class="btn btn-primary add-form" 
					data-target="#cuentas-bancarias{{$count}}" 
					data-id-name="id_representant"
					data-cls-tmpl="cuenta-banco"
					data-id-value="{{ isset($representante) ? $representante->id : ''}}"
					data-id-tmpl="#tmpl-cuenta-banco"> Agregar Cuenta</button>
				</div>

				<div id="cuentas-bancarias{{$count}}"> 
					@isset($representante )
						@foreach( $representante->count_banks as $cuenta )
							@php
								$count = $loop->index + 1;
								$type = 'edit'
							@endphp
							<div class="cuenta-banco tmpl-item ">
								@include("elements.admin.invesment_edit_form_count", compact('user','representante','cuenta','catBancks','catClasifCountBanck','count','edit'))
							</div>
						@endforeach
					@endisset
				</div>
		</div>
	</div>
</div>