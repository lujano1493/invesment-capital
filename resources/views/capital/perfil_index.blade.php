@extends('layouts.app')

@section('title', 'Perfil de Usuario')

@php
		$user = Auth::user();	
@endphp

@section('content')
	<div class="row">
		Perfil de usuario
	</div>

	@include("elements/user/perfil/edit" )
@endsection
