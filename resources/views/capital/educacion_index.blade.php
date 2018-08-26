@extends('layouts.app')
@section('title', 'Educación Financiera')

@php
		$user = Auth::user();	

	$cuestionarios =$user->cuestionarios;

@endphp

@section('content')
	
<div class="row">
    <div class="panel panel-default">
        <div class="panel-heading">
        	<i class="fa fa-tasks fa-fw"></i>
          Asignación de Cuestionario
        </div>
        <!-- /.panel-heading -->
        <div class="panel-body">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nombre de Cuestionario</th>
                            <th>Fecha de Fecha Limite</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach( $cuestionarios as $cuestionario )
                        @php
                            $asignar = $cuestionario->asignacion;
                        @endphp
                        <tr>
                            <td> {{ $cuestionario->id }} </td>
                            <td>{{ $cuestionario->titulo }}</td>
                            <td> {{ $cuestionario->fecha_limite->format('d-m-Y') }}</td>
                            <td> <a class="btn btn-primary" href="{{ route('capital.cuestionario.contestar', $asignar ) }}"> Contestar </a></td>
                        </tr>
                        @endforeach



                    </tbody>
                    
                </table>
            </div>
            <!-- /.table-responsive -->
        </div>
    <!-- /.panel-body -->
    </div>
	</div>
@endsection
