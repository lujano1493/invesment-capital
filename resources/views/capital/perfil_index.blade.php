@extends('layouts.app')

@section('title', 'Perfil de Usuario')

@php
		$user = Auth::user();	
@endphp

@section('content')
	<div class="row">
		<div class="panel panel-default">
			<div class="panel-heading">
				<i class="fa fa-user fa-fw"></i>
            			Información de Perfil
			</div>
			<div class="panel-body">
					@include("elements/user/perfil/edit" )
			</div>

		</div>
	</div>


	<div class="row">
		<div class="panel panel-default">
			<div class="panel-heading">
				<i class="fa fa-book fa-fw"></i>
            			Información de Accesos
			</div>
			<div class="panel-body">
					@include("elements/user/perfil/accesos"  )
			</div>

		</div>
	</div>


	@include("elements/user/perfil/modals")




	
@endsection
