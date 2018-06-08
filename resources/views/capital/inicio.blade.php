@extends('layouts.app')

@section('title', 'Inicio')

@php
		$user = Auth::user();	
@endphp

@section('content')
   Hola   {{ $user->name . ' ' . $user->last_name  }}


@endsection
