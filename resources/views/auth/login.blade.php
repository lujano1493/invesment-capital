@extends('layouts.credential')

@section('title','Iniciar Sesión')
@section('page-title', 'Iniciar Sesión')
@section('content')

   {{ Form::open(array('url' => 'login'  )) }}
  
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
   
        {{  Form::bsButton('Ingresar',   ['class' => 'btn btn-primary btn-block' , 'type' =>'submit' ] )  }}
     
         
     {{ Form::close() }}
    <div class="row">
        <div class="col-6">
            <div class="form-group">
                 <a class="d-block small" href="{{ route('send_email_password') }}">¿Olvidaste Contraseña?</a>
            </div>
            
        </div>
        <div class="col-6">
            <div class="form-group">
                 <a class="d-block small" href="{{ route('send_email_activation') }}">¿Aún no activas tu cuenta?</a>
            </div>
           
        </div>
    </div>

@endsection
