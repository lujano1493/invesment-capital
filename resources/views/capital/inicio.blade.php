@extends('layouts.app')

@section('title', 'Inicio')

@php
		$user = Auth::user();	
@endphp

@section('content')

	<div class="row">
		
		 Hola   <b>{{ $user->name . ' ' . $user->last_name  }}</b>
	</div>
  



@endsection
