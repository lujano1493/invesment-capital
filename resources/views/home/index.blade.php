@extends('layouts.home')

@section('title', 'Capital 444')

@php
		$user = Auth::user();	
@endphp

@section('content')

	<div class="row text-center " style="margin-top: 11%">
		
			<a class="btn btn-primary " href="{{ route("login") }}"> Ingresar</a>
	</div>



@endsection
