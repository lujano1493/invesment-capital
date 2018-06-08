@extends('layouts.app')

@section('title', 'Educación Financiera')

@php
		$user = Auth::user();	
@endphp

@section('content')
	<div class="row">
		Educacion financiera
	</div>
@endsection
