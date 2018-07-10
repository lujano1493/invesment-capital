@extends('layouts.app')
@section('title', 'Inicio')
@php
		$user = Auth::user();	
		$modules=$user->modules()->get();
		$now = \Carbon\Carbon::today();
		$view_session = [
				"investment" => "elements/user/inicio/invesment_summary",
				"educacion"=>"elements/user/inicio/educacion_summary"
		];
@endphp
@section('content')
	<div class="row">
		<div class="col-lg-12 col-md-12">
			<div class="alert alert-info">
				 Bienvenido   <b>{{ $user->name . ' ' . $user->last_name  }}</b>, a continuación te mostramos las ultimas novedades:
			</div>
		</div>
		
	</div>
	@forelse ( $modules as $module  )
		@if( $module->access->date_expired >=  $now  )
			@include( $view_session[$module->ident ]  , ["module" => $module])
		@endif

		@empty 
	    	@include("elements/user/inicio/sin_acceso_modulos")
	@endforelse
	 

@endsection
