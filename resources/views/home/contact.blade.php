@extends('layouts.home')

@section('title', 'Capital 444')

@php
		
@endphp

@section('content')
	<div class="row ">

		<div class="col-xs-8 col-sm-4 col-md-4  col-lg-4 col-xs-offset-2 col-sm-offset-4 col-md-offset-4 col-lg-offset-4  well">
				
			     {{ Form::open(array('url' => 'contacto'   )) }}

			    <div class="row text-left">

			  
			        {{ Form::bsInput('name','text',[
			                'label' => ['text' => 'Nombre', 'class' =>'col-md-12 control-label'],
			                'value' =>  old('name'),
			                'attr' => [
			                        'placeholder' => 'Ingresa nombre completo',
			                        'required' =>true
			                    ]
			                ]
			            )
			        }}
			        
			    </div>


			    <div class="row text-left">

			        {{ Form::bsInput('correo','email',[
			                'label' => ['text' => 'Correo Electrónico', 'class' =>'col-md-12 control-label'],
			                'value' =>old('correo'),
			                'attr' => [
			                        'placeholder' => 'Ingresa correo electrónico',
			                        'required' =>true
			                    ]
			                ]
			            )
			        }}
			        
			    </div>

			    <div class="row text-left">
			          
			        {{ Form::bsInput('mensaje','textarea',[
			                'label' => ['text' => 'Mensaje', 'class' =>'col-md-12 control-label'],
			                'value' =>'',
			                'attr' => [
			                        'placeholder' => 'Ingresa mensaje',
			                        'required' =>true
			                    ]
			                ]
			            )
			        }}
			    </div>       


			    <div class="row text-center">
			        {{  Form::bsButton('ENVIAR',   ['class' => 'btn btn-primary' , 'type' =>'submit' ] )  }}
			    </div>
			   
			    
			     
			         
			     {{ Form::close() }}
		</div>
	</div>

	<div class="row">
		<div class="col-xs-12">
			<img src="/img/mapa.png"  class="img-responsive icon-home-location" >
		</div>
		<div class="col-xs-12 text-home-location text-center"> Dr Erazo 85 Int 703, Del Cuauhtémoc CP: 06720, CDMX.</div>
	</div>


@endsection