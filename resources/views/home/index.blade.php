@extends('layouts.home')

@section('title', 'Capital 444')

@php
		$user = Auth::user();	
@endphp

@section('content')

	<div  id="home-init"  >
			<a class="btn btn-primary " href="{{ route("login") }}"> Ingresar</a>
	</div>



@endsection
