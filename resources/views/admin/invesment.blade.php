@extends('layouts.app-admin')

@section('title', 'Administración Invesment')
 @section('panel-title' ,'Administración Invesment')

@section('content')
    <div class="card mb-3">
        <div class="card-body">
            <div class="table-responsive">
                <div class="row">
                    <div class="col-7">
                        {!! $users->appends(\Request::except('page'))->render() !!}
                    </div>
                    <div class="col-5">
                        @include("elements.search_form", [ 'route' => "admin.invesment"  ] )
                    </div>
                </div>
              
                <table class="table table-bordered"   cellspacing="0">
                <thead>
                	<tr>
                		<th scope="col">   @sortablelink('id', 'Id') </th>
	                 	<th scope="col">  @sortablelink('name', 'Nombre') </th>
	                 	<th scope="col">  @sortablelink('last_name', 'Apellidos') </th>
	                 	<th scope="col"> @sortablelink('email', 'Correo')  </th>
	                 	<th scope="col"> Acciones</th>
                 	</tr>
                </thead>
                <tbody>
                	@foreach($users as $user)
                	<tr>
                			<td>{{ $user->id }}</td>
                			<td>{{ $user->name }}</td>
                			<td>{{ $user->last_name . ( isset($user->last_second_name) ? ' '. $user->last_second_name : '' )    }}</td>
                			<td>{{ $user->email }}</td>
                			<td>
                				<a class="btn btn-success" href="{{ route('admin.invesment.edit' , ['id' => $user->id ]) }}" > Modificar </a>
                			 </td>

                	</tr>
                	@endforeach
                </tbody>
                </table>
                 {!! $users->appends(\Request::except('page'))->render() !!}
            </div>
        </div>
    </div>
@endsection
