@extends('layouts.home')

@section('title', 'Capital 444')

@php
		
@endphp

@section('content')
	<div class="row margin-home-top">

		<div class="col-xs-8 col-sm-4 col-md-4  col-lg-4 col-xs-offset-2 col-sm-offset-4 col-md-offset-4 col-lg-offset-4  well">
				<div class="heading-who-we text-center">
					<div class="line-home-bottom"></div>
					<h2 class="title-who-we"> Contactanos</h2>
					<div class="line-home-bottom"></div>
				</div>
			
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

@endsection