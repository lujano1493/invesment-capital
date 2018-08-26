@extends('layouts.app')

@section('title', 'Cuestionario')
 @section('panel-title' ,'Vista Previa Cuestionario')

@section('content')

@php
    $cuestionario = $asignacion->cuestionario;
    $respuestas =$asignacion->respuestas;
    $respuestas= $respuestas->pluck('id','id_opcion')->toArray();

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

        <div class="row">
            <div class="col-12">
                <div class="alert alert-info" role="alert">
                      {{ $cuestionario->descripcion }}

                </div>
            </div>
                


        </div>

        {{ Form::model($cuestionario ,['route' =>['capital.cuestionario.finalizar', $asignacion]]) }}
        {{ Form::bsInput('id','hidden') }}
        @php
         $count =0;
        @endphp
        @foreach( $cuestionario->preguntas()->orderBy('secuencia','asc')->get()  as $pregunta  )
            <div class="row {{ $loop->first ? 'margin-top3' :'margin-top4'   }}" >
                <div class="col-12">
                     <b>{{  $pregunta->secuencia }} .</b>  {{ $pregunta->pregunta }}
                </div>
                
            </div>

            <div class="row margin-top3">
                @php
                    $opciones =  $pregunta->opciones()->orderBy('enciso','asc') ->get();
                @endphp
                @foreach( $opciones as  $opcion )
                <div class="col-11 col-xs-offset-1 opciones">


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
                <button class="btn btn-primary btn-ajax" > Finalizar </button>
            </div>


        {{ Form::close() }}

    </div>
 </div>


   <div class="form-group text-center mt-3">
        <a class="btn btn-danger" href ="{{ route('capital.educacion') }}"> Regresar </a>
    </div>

@endsection