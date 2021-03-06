
@extends('layouts.home')


@section('content')


<div id="home-form">

    <div class="col-xs-12 col-sm-4 col-md-4  col-lg-4 col-xs-offset-0 col-sm-offset-4 col-md-offset-4 col-lg-offset-4 well">
     <form method="POST" action="{{ route('send_email_activation') }}">
              {{ csrf_field() }}

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

          <div class="form-group text-center">
               <button class="btn btn-primary" type="submit">Enviar Correo de Activación</button>
          </div>
      </form>

       <div class="row">
            <div class="col-12">
                <div class="form-group text-center">
                     <a class="d-block small" href="{{ route('login') }}">Iniciar Sesión</a>
                </div>
                
            </div>
        </div>
    
    </div>
</div>
   

@endsection