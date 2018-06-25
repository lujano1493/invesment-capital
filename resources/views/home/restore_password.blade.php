 

@extends('layouts.home')


@section('content')


<div id="home-form">

    <div class="col-xs-12 col-sm-4 col-md-4  col-lg-4 col-xs-offset-0 col-sm-offset-4 col-md-offset-4 col-lg-offset-4 well">

   <form method="POST" action="{{ route('restore_password',$token) }}">
        {{ csrf_field() }}

      <input type="hidden" name="token" value="{{ $token }}">


      <div class="row text-left">

          {{ Form::bsInput('password','password',[
                  'label' => ['text' => 'Contraseña', 'class' =>'col-md-12 control-label'],
                  'value' =>  old('password'),
                  'attr' => [
                          'placeholder' => 'Ingresa contraseña',
                          'required' =>true
                      ]
                  ]
              )
          }}
      </div>

        <div class="row text-left">
          {{ Form::bsInput('password_confirmation','password',[
                  'label' => ['text' => 'Confirmación', 'class' =>'col-md-12 control-label'],
                  'value' =>  old('password_confirmation'),
                  'attr' => [
                          'placeholder' => 'Ingresa Confirmación',
                          'required' =>true
                      ]
                  ]
              )
          }}
      </div>



       <div class="form-group text-center">
           <button type="submit" class="btn btn-primary " > Restablecer Contraseña</button>
      </div>

    
    </form>

  </div>
</div>

  


@endsection