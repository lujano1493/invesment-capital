@extends('layouts.app')

@section('title', 'Resultados de Cuestionario')
 @section('panel-title' ,'Resultados de Cuestionario')

@section('content')

@php
    $preguntasCorrectas= $resultado['preguntasCorrectas'];
    $totalPreguntas= $resultado['totalPreguntas'];
    $porcentaje =  ($preguntasCorrectas / $totalPreguntas ) *100;
    $clsAlert=  $porcentaje < 60 ? 'alert-danger' : 'alert-success';
    $text = $porcentaje < 60 ? 'no cumples con el minimo para aprobar cuestionario intente nuevamente.' 
        :'has aprobado la encuesta satifacctorianente puedes pasar al siguiente modulo.'

@endphp


 <div class="row">
     <div class="col-12">
           
        <h5>
            <div class="alert {{ $clsAlert }}">
              tu porcentaje fue de  <b>@percentage($porcentaje) </b>,  {{ $text }}

            </div>
        </h5> 
     </div>
 </div>
  



   <div class="form-group text-center mt-3">


        @if( $porcentaje< 60)
          <a class="btn btn-primary" href ="{{ route('capital.cuestionario.intentar',$id) }}"> Intentar Nuevamente </a>
        @endif
        <a class="btn btn-warning" href ="{{ route('capital.educacion') }}"> Regresar </a>
    </div>

@endsection