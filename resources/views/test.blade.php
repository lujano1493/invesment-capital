@extends('layouts.credential')

@section('title','Prueba')
@section('page-title', 'Solo Pruebas')
@section('content')

  {{ session('prueba') }}

  <a href="{{route('test')}}"> Recargar</a>

@endsection