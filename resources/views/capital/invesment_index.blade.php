@extends('layouts.app')

@section('title', 'Investment')

@php
		$user = Auth::user();	
@endphp

@section('content')
	<div class="row">
		<div class="bs-example bs-example-tabs" data-example-id="togglable-tabs"> 
			<ul class="nav nav-pills" id="mi-tab-inv" role="tablist"> 
				<li role="presentation" class="active">
					<a href="#estrategia" id="estrategia-tab" role="tab" data-toggle="tab" aria-controls="estrategia" aria-expanded="true">
					 <h4> Mi Estrategia </h4>
					</a>
				</li> 
				<li role="presentation" >
					<a href="#info-cuenta" role="tab" id="info-cuenta-tab" data-toggle="tab" aria-controls="info-cuenta" aria-expanded="false">
						<h4> Información de la Cuenta </h4>
					</a>
				</li>  
			</ul> 
			<div class="tab-content" id="myTabContent"> 
				<div class="tab-pane fade active in" role="tabpanel" id="estrategia" aria-labelledby="estrategia-tab"> 
					<div class="panel panel-default">
					 
					  <div class="panel-body">
					    Panel content
					  </div>
					</div>
				</div> 
				<div class="tab-pane  " role="tabpanel" id="info-cuenta" aria-labelledby="info-cuenta-tab"> 
					info
				</div> 
				
			</div> 
		</div>
	</div>
@endsection
