@extends('layouts.app')

@section('title', 'Resultados de Cuestionario')
 @section('panel-title' ,'Resultados de Cuestionario')

@section('content')

@php


  


    $resultado = $asignacion->calcularCalificacion();
    extract($resultado);

    $cuestionario = $asignacion->cuestionario;
    $respuestas =$asignacion->respuestas;
    $respuestas= $respuestas->pluck('id','id_opcion')->toArray();
    $preguntas=$cuestionario->preguntas;

@endphp



  @php
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

<div class="row">
   <div class="card mb-3">
        <div class="card-header">
            <div class="row">
                <div class="col-12 col-sm-8 no-selection">
                     {{ $cuestionario->titulo }}
                </div>
               
            </div>
 
        </div>
    <div class="card-body text-left">

        @foreach( $preguntas  as $pregunta  )
            <div class="row {{ $loop->first ? 'margin-top3' :'margin-top4'   }}" >
                <div class="col-12 no-selection">
                     <b>{{  $pregunta->secuencia }} .</b>  {{ $pregunta->pregunta }}

                     <span class="label {{ $pregunta->es_correcta? 'label-success' : 'label-danger' }}"> 

                      {{ $pregunta->es_correcta ? 'es correcta' :'incorrecta' }}

                    </span>
                </div>
                
            </div>

            <div class="row margin-top3 pregunta_opcion no-selection" id="pregunta_opcion_{{ $loop->index }}">
                @foreach( $pregunta->opciones as  $opcion )
                <div class="col-11 col-xs-offset-1 opciones" >
                    @php
                        $label =$opcion->enciso .') '.$opcion->valor ;
                        $clsAlert=  ""; 
                      
                        if($opcion->es_correcto  ) {
                             $clsAlert=  "alert-success"; 
                        }
                        else if (!$opcion->es_correcto && $opcion->es_seleccionada){
                              $clsAlert=  "alert-danger"; 
                        }   

                    @endphp

                        <div class="alert {{ $clsAlert }}">
                           {{ $label }}     <input type="hidden" name="opcion" value="{{ $opcion->id }}"   data-select= {{ $opcion->es_seleccionada }}  >
                         </div>

            
                </div>
                @endforeach
              
                
            </div>
        @endforeach


    </div>
 </div>



</div>


  

   <div class="form-group text-center mt-3">


        @if( $porcentaje< 60)
          <a class="btn btn-primary" href ="{{ route('capital.cuestionario.intentar', $asignacion ) }}"> Intentar Nuevamente </a>
        @endif
        <a class="btn btn-warning" href ="{{ route('capital.educacion') }}"> Regresar </a>
    </div>

@endsection