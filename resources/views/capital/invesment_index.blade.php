@extends('layouts.app')

@section('title', 'Investment')

@php
		$user = Auth::user();	
@endphp

@section('content')
		<ul class="nav nav-tabs" > 
			<li  class="active">
				<a href="#estrategia"  data-toggle="tab"  >
				 <h4> Mi Estrategia </h4>
				</a>
			</li> 
			<li  >
				<a href="#info-cuenta"  data-toggle="tab"  >
					<h4> Información de la Cuenta </h4>
				</a>
			</li>  
		</ul> 
		<div class="tab-content" > 
			<div class="tab-pane  fade active in"  id="estrategia" > 
				@include("elements.investment.summary")

			</div> 


			<div class="tab-pane"  id="info-cuenta" > 
				@include("elements.investment.info")
			</div> 
			
		</div> 


		<div id="view-doc" class="modal-view-doc">
			  <span class="close">&times;</span>
			  <div class="content" > </div>
			  <div class="caption"></div>
		</div>
	
@endsection
