@extends('layouts.app')

@section('title', 'Invesment')

@php
		$user = Auth::user();	
@endphp

@section('content')
	<div class="row">
		Invesment
	</div>
@endsection
