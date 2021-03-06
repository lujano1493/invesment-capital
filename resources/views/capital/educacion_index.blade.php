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
                            <th>Fecha de Finalización</th>
                            <th>Estatus</th>
                            <th>Fecha  Limite</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach( $cuestionarios as $cuestionario )
                        @php
                            $asignar = $cuestionario->asignacion;
                            $clsStatus = "label-primary";
                            $txtStatus= "Asignado";
                            if($asignar->visto){
                                $clsStatus = "label-warning";
                                $txtStatus= "En Proceso";
                            }
                            if ( $asignar->fecha_finalizado ){
                                $clsStatus = "label-success";
                                $txtStatus= "Finalizado";
                            }

                        @endphp
                        <tr>
                            <td> {{ $cuestionario->id }} </td>
                            <td>{{ $cuestionario->titulo }}</td>
                            <td> {{ $asignar->fecha_finalizado ? $asignar->fecha_finalizado->format('d-m-Y H:i:s') : 'Sin Finalizar'  }}</td>
                            <td>  <label class="label {{ $clsStatus }}"> {{ $txtStatus }} </label></td>

                            @php

                                $fechaLimiteLabel ='Sin Limite';
                                 $fechaLimiteLabel = $asignar->fecha_limite ?  $asignar->fecha_limite :$cuestionario->fecha_limite;

                                if($cuestionario->tipo == 1){
                                    $fechaLimiteLabel = $fechaLimiteLabel->format('d-m-Y');
                                } else
                                if ($cuestionario->tipo == 2) {
                                    if($asignar->visto){
                                       $fechaLimiteLabel= $fechaLimiteLabel->format('d-m-Y H:i') ;
                                    } else{
                                        list($horas,$mins) = preg_split( '[:]', $cuestionario->fecha_limite->format('H:i')); 
                                        $fechaLimiteLabel =  "$horas horas y $mins mins.";
                                    }
                                  
                                }
                            @endphp
                            <td> {{$fechaLimiteLabel}}</td>
                            <td> 
                                @if( !$asignar->fecha_finalizado )
                                    <a class="btn btn-primary" href="{{ route('capital.cuestionario.contestar', $asignar ) }}"> Contestar </a>
                                @else
                                    <a class="btn btn-info" href="{{ route('capital.cuestionario.resultado', $asignar ) }}"> Ver Resultados </a>
                                @endif
                            </td>
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
