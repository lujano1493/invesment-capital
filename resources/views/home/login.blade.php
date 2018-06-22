
@extends('layouts.home')


@section('content')

<div class="row margin-form-home-top">

    <div class="col-xs-8 col-sm-4 col-md-4  col-lg-4 col-xs-offset-2 col-sm-offset-4 col-md-offset-4 col-lg-offset-4 well">
          {{ Form::open(array('url' => 'login'   )) }}

        <div class="row text-left">

      
            {{ Form::bsInput('email','email',[
                    'label' => ['text' => 'Correo Electrónico', 'class' =>'col-md-12 control-label'],
                    'value' =>  old('email'),
                    'attr' => [
                            'placeholder' => 'Ingresa correo',
                            'required' =>true
                        ]
                    ]
                )
            }}
            
        </div>


        <div class="row text-left">

            {{ Form::bsInput('password','password',[
                    'label' => ['text' => 'Contraseña', 'class' =>'col-md-12 control-label'],
                    'value' =>'',
                    'attr' => [
                            'placeholder' => 'Ingresa contraseña',
                            'required' =>true
                        ]
                    ]
                )
            }}
            
        </div>

        <div class="row text-left">
              {{ Form::bsChecable('remember','checkbox',[
                    'label' => ['text' => 'Recordar Contraseña'],
                    'value' =>'S',
                    'checked' => !!old('remember') ,
                    'attr' =>[
                                'class' => 'form-check-input'
                        ]
                    ]
                )
            }}
        </div>       


        <div class="row text-center">
            {{  Form::bsButton('Ingresar',   ['class' => 'btn btn-primary' , 'type' =>'submit' ] )  }}
        </div>
       
        
         
             
         {{ Form::close() }}
        <div class="row">
            <div class="col-xs-6">
                <div class="form-group text-center">
                     <a class="d-block small" href="{{ route('send_email_password') }}">¿Olvidaste Contraseña?</a>
                </div>
                
            </div>
            <div class="col-xs-6">
                <div class="form-group text-center">
                     <a class="d-block small" href="{{ route('send_email_activation') }}">¿Aún no activas tu cuenta?</a>
                </div>
               
            </div>
        </div>
        
    </div>

   
    
</div>
   

@endsection