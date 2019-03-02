@extends('layouts.app')

@section('title', 'Cuestionario')
 @section('panel-title' ,'Vista Previa Cuestionario')

@section('content')

@php
    $cuestionario = $asignacion->cuestionario;
    $respuestas =$asignacion->respuestas;
    $respuestas= $respuestas->pluck('id','id_opcion')->toArray();

    $diffTime=   $asignacion->fecha_limite->timestamp -\Carbon\Carbon::now()->timestamp;


@endphp
 <div class="card mb-3">
        <div class="card-header">
            <div class="row">
                <div class="col-12 col-sm-8">
                     {{ $cuestionario->titulo }}
                </div>
               
            </div>

            @if ($cuestionario->tipo == 2 )
                <div class="row" >
                    <div class="text-right col-12 col-sm-12" style="font-size: 18px" >
                        Tiempo restante:  <label class="label label-warning time-test"> {{ gmdate("H:i:s", $diffTime) }} </label>
                    </div>
                    
                </div>
            @endif
 
        </div>
    <div class="card-body text-left tab-margin-top">

        <div class="row">
            <div class="col-12">
                <div class="alert alert-info no-selection " role="alert">
                      {{ $cuestionario->descripcion }}

                </div>
            </div>
                


        </div>

        {{ Form::model($cuestionario ,['route' =>['capital.cuestionario.finalizar', $asignacion],'id' => 'cuestionario' ] ) }}
        {{ Form::bsInput('id','hidden', [
                'value' => $asignacion->id,
                'class' =>'id-master'
            ]) }}
        {{ Form::bsInput('tipo','hidden' ,[ 'class' => 'type-questions']) }}

         {{ Form::bsInput('diffTime','hidden' ,[ 'value' => $diffTime]) }}
        @php
         $count =0;
        @endphp
        @foreach( $cuestionario->preguntas()->orderBy('secuencia','asc')->get()  as $pregunta  )
            <div class="row {{ $loop->first ? 'margin-top3' :'margin-top4'   }}" >
                <div id="pregunta_{{ $loop->index }}" class="col-12 no-selection ">
                     <b>{{  $pregunta->secuencia }} .</b>  {{ $pregunta->pregunta }}
                </div>
                
            </div>

            <div class="row margin-top3 pregunta_opcion" id="pregunta_opcion_{{ $loop->index }}" data-index="{{ $loop->index }}">
                @php
                    $opciones =  $pregunta->opciones()->orderBy('enciso','asc') ->get();
                @endphp
                @foreach( $opciones as  $opcion )
                <div class="col-11 col-xs-offset-1 opciones no-selection " >


                        {{ Form::bsCheck( "opciones[".( $count++)."]" ,'checkbox' , [ 
                                'label' => $opcion->enciso .') '.$opcion->valor ,
                                'id' => "opcion_{$loop->parent->index}_{$loop->index}",
                                'value' => $opcion->id,
                                'checked' =>  isset(  $respuestas[ $opcion->id ]   )

                                ]) }}
                </div>
                @endforeach
                
            </div>
        @endforeach

            <div class="form-group text-center ">
                <button  class="btn btn-primary btn-test btn-ajax" id="btn-test" data-no-show-msg = "true"   data-custom-validate="validateTest" > Finalizar </button>
            </div>




        {{ Form::close() }}

    </div>
 </div>
 <div  id="modalFinalizar" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Finalización de Cuestionario</h4>
      </div>
      <div class="modal-body">
        <p> El proceso del cuestionario ha terminado con exito. Te invitamos a elegir las siguientes opciones </p>
      </div>
      <div class="modal-footer">
        <a id="btnResultados" class="btn btn-primary"  href="{{route('capital.cuestionario.resultado' , $asignacion) }}" >Revisar Resultados</a>
        <a class="btn btn-warning" href ="{{ route('capital.educacion') }}"> Regresar </a>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


   <div class="form-group text-center mt-3">
        <a class="btn btn-warning" href ="{{ route('capital.educacion') }}"> Regresar </a>
    </div>

@endsection