@extends('layouts.app-admin')



@section('title', 'Usuarios :: Editar de Usuarios')
@section('panel-title' ,'Editar Usuario')



@section('content')


<div class="card">
  <div class="card-header">
        Editar Perfil de Usuario
  </div>
  <div class="card-body">
        @include("elements.admin.users_edit_profile" )
  </div>
</div>



@include("elements.admin.users_edit_access" )


<div class="form-group text-center">
        <a href="{{ route('admin.users') }}" class="btn btn-danger" style="margin-top: 30px;"> Regresar </a>  
</div>
           
        
@endsection
