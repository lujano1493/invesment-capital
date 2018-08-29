@extends('layouts.app-admin')

@section('title', 'Resultados de Cuestionario')
 @section('panel-title' ,'Resultados de Cuestionario')

@section('content')

@php
    $cuestionario = $asignacion->cuestionario;
    $respuestas =$asignacion->respuestas;
    $respuestas= $respuestas->pluck('id','id_opcion')->toArray();
    $preguntas=$cuestionario->preguntas()->orderBy('secuencia','asc')->get();

@endphp
 <div class="card mb-3">
        <div class="card-header">
            <div class="row">
                <div class="col-12 col-sm-8">
                     {{ $cuestionario->titulo }}
                </div>
               
            </div>
 
        </div>
    <div class="card-body text-left">


        @php
         $count =0;
         $preguntasCorrectas=0;
        @endphp
        @foreach( $preguntas  as $pregunta  )
            <div class="row {{ $loop->first ? 'margin-top3' :'margin-top4'   }}" >
                <div class="col-12">
                     <b>{{  $pregunta->secuencia }} .</b>  {{ $pregunta->pregunta }}
                </div>
                
            </div>

            <div class="row margin-top3 pregunta_opcion" id="pregunta_opcion_{{ $loop->index }}">
                @php
                    $opciones =  $pregunta->opciones()->orderBy('enciso','asc') ->get();
                     $opcionesCorrecta=0; 
                     $opcionesCorrectasSeleccionadas=0;
                @endphp
                @foreach( $opciones as  $opcion )
                <div class="col-11 col-xs-offset-1 opciones" >
                    @php
                        $label =$opcion->enciso .') '.$opcion->valor ;
                        $opcionSeleccionada= isset(  $respuestas[ $opcion->id ]   );
                        $clsAlert=  ""; 
                       

                        if($opcion->es_correcto){
                            $opcionesCorrecta++;
                        }

                        if($opcion->es_correcto && $opcionSeleccionada ) {
                             $clsAlert=  "alert-success"; 
                             $opcionesCorrectasSeleccionadas++;
                        }
                        else if ($opcionSeleccionada){
                              $clsAlert=  "alert-danger"; 
                        }   

                    @endphp

                        <div class="alert {{ $clsAlert }}">
                           {{ $label }} 
                         </div>

            
                </div>
                @endforeach
                @php
                    if($opcionesCorrectasSeleccionadas == $opcionesCorrecta ){
                        $preguntasCorrectas++;
                    }
                    
                @endphp
                
            </div>
        @endforeach


    </div>
 </div>


 <div class="row">
     <div class="col-12">
            
        <h5>
            De un total de {{ $preguntas->count() }} preguntas  tuviste {{ $preguntasCorrectas }} correctas y {{ $preguntas->count()-$preguntasCorrectas }} incorrectas
        </h5> 
     </div>
 </div>
 

   <div class="form-group text-center mt-3">
        <a class="btn btn-warning" href ="{{ route('capital.educacion') }}"> Regresar </a>
    </div>

@endsection