@extends('layouts.app')



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


<div class="card">
  <div class="card-header">
        Editar Accesos a Módulos
  </div>
  <div class="card-body">
        @include("elements.admin.users_edit_access" )
  </div>
</div>
           



<div class="form-group">
    <div class="col-6 offset-6">
        <a href="{{ route('admin.users') }}" class="btn btn-danger btn-block"> Regresar </a>  
    </div>

</div>
           
        
@endsection
