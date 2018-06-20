@extends('layouts.home')

@section('title', 'Capital 444')

@php
		$user = Auth::user();	
@endphp

@section('content')


	
	<div class="row">
		<img class="img-responsive img-logo-home" src="{{ asset('img/capital44_logo_white.jpg') }}">
	</div>

	<div class="row margin-home-top">
		<div class="col-xs-10 col-sm-5 col-md-4 col-xs-offset-1 col-sm-offset-3 col-md-offset-4">
			<a class="btn btn-primary btn-block" href="{{ route("quienes_somos") }}">CONOZCA MÁS SOBRE CAPITAL 444 </a>
		</div>

	</div>



@endsection
