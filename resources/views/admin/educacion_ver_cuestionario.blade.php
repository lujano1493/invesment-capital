@extends('layouts.app-admin')

@section('title', 'Vista de cuestionario')
 @section('panel-title' ,'Vista Previa Cuestionario')

@section('content')
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

    	@foreach( $cuestionario->preguntas()->orderBy('secuencia','asc')->get()  as $pregunta  )
	    	<div class="row mt-4" >
	    		<div class="col-12">
	    			 <b>{{  $pregunta->secuencia }} .</b>  {{ $pregunta->pregunta }}
	    		</div>
	    		
	    	</div>

	    	<div class="row mt-3">
	    		@foreach( $pregunta->opciones()->orderBy('enciso','asc') ->get() as  $opcion )
	    		<div class="col-11 offset-1">


	    				{{ Form::bsCheck( ""  ,'checkbox' , [ 
								'label' => $opcion->enciso .') '.$opcion->valor ,
								'id' => "opcion{$loop->parent->index}_{$loop->index}",
								'value' => $opcion->id,
								'checked' => false,
								'attr' =>[
									'required' =>true
								]   

								]) }}
	    		</div>
	    		@endforeach
	    		
	    	</div>
	    @endforeach
    	

    </div>
 </div>


   <div class="form-group text-center mt-3">
        <a class="btn btn-danger" href ="{{ route('admin.educacion') }}"> Regresar </a>
    </div>

@endsection