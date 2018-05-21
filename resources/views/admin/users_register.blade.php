@extends('layouts.app')



@section('title', 'Usuarios :: Registrar de Usuarios')
@section('panel-title' ,'Registrar Usuario')



@section('content')


        {{ Form::open(array('route' => 'admin.users.register' , 'class'=> 'form-horizontal' ,'style' => 'width:80%' )) }}
      
            {{ Form::bsInput('name','text',[
                    'label' => ['text' => 'Nombre(s)', 'class' =>'col-12 control-label'],
                    'value' =>  old('name'),
                    'attr' => [
                            'placeholder' => 'Ingresa nombre',
                            'required' =>true
                        ]
                    ]
                )
            }}

            {{ Form::bsInput('last_name','text',[
                    'label' => ['text' => 'Apellidos', 'class' =>'col-12 control-label'],
                    'value' =>  old('last_name'),
                    'attr' => [
                            'placeholder' => 'Ingresa apellidos',
                            'required' =>true
                        ]
                    ]
                )
            }}
           
            {{ Form::bsInput('nickname','text',[
                    'label' => ['text' => 'Nombre de Usuario', 'class' =>'col-12 control-label'],
                    'value' =>  old('nickname'),
                    'attr' => [
                            'placeholder' => 'Ingrese nombre de usuario',
                            'required' =>true
                        ]
                    ]
                )
            }}

            {{ Form::bsInput('birth_date','date',[
                    'label' => ['text' => 'Fecha de Nacimiento', 'class' =>'col-12 control-label'],
                    'value' =>  old('birth_date'),
                    'attr' => [
                            'placeholder' => 'Ingrese fecha de nacimiento',
                            'required' =>true
                        ]
                    ]
                )
            }}


             {{ Form::bsInput('email','email',[
                    'label' => ['text' => 'Correo Electrónico', 'class' =>'col-12 control-label'],
                    'value' =>  old('email'),
                    'attr' => [
                            'placeholder' => 'Ingrese correo electrónico',
                            'required' =>true
                        ]
                    ]
                )
            }}

              {{ Form::bsInput('password','password',[
                    'label' => ['text' => 'Contraseña', 'class' =>'col-12 control-label'],
                    'value' => '',
                    'attr' => [
                            'placeholder' => 'Ingrese contraseña',
                            'required' =>true
                        ]
                    ]
                )
                }}
          
          
              {{ Form::bsInput('password_confirmation','password',[
                    'label' => ['text' => 'Confirme Contraseña', 'class' =>'col-12 control-label'],
                    'value' => '',
                    'attr' => [
                            'placeholder' => 'Ingrese confirmación',
                            'required' =>true
                        ]
                    ]
                )
                }}
                <div class="form-group">
                    <div class="row">
                        <div class="col-6">
                            {{ Form::Button('Registrar' , ['class' => 'btn btn-primary btn-block' , 'type' =>'submit' ]  ) }}
                        </div> 
                        <div class="col-6">
                            <a href="{{ route('admin.users') }}" class="btn btn-danger btn-block"> Cancelar </a>
                        </div>

                    </div>
                    
                </div>
         
        {{ Form::close() }}
@endsection
