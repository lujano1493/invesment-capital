@extends('layouts.app-admin')



@section('title', 'Usuarios :: Registrar de Usuarios')
@section('panel-title' ,'Registrar Usuario')



@section('content')


        {{ Form::open(array('route' => 'admin.users.register' , 'class'=> 'form-horizontal' ,'style' => 'width:80%' )) }}
      
            {{ Form::bsInput('name','text',[
                    'label' => ['text' => 'Nombre(s)', 'class' =>'col-12 control-label'],
                    'value' =>  old('name'),
                    'attr' => [
                            'placeholder' => 'Ingresa nombre',
                            'required' =>true,
                            'class' =>'nombre-rfc'
                        ]
                    ]
                )
            }}

            {{ Form::bsInput('last_name','text',[
                    'label' => ['text' => 'Apellido Paterno', 'class' =>'col-12 control-label'],
                    'value' =>  old('last_name'),
                    'attr' => [
                            'placeholder' => 'Ingresa apellido paterno',
                            'required' =>true,
                            'class' =>'apellido-pat-rfc'
                        ]
                    ]
                )
            }}

                {{ Form::bsInput('last_second_name','text',[
                    'label' => ['text' => 'Apellido Materno', 'class' =>'col-12 control-label'],
                    'value' =>  old('last_second_name'),
                    'attr' => [
                            'placeholder' => 'Ingresa apellido materno',
                            'class' =>'apellido-mat-rfc'
                        ]
                    ]
                )
            }}
            {{ Form::bsInput('birth_date','date',[
                    'label' => ['text' => 'Fecha de Nacimiento', 'class' =>'col-12 control-label'],
                    'value' =>  old('birth_date'),
                    'attr' => [
                            'placeholder' => 'Ingrese fecha de nacimiento',
                            'class' =>'fecha-nac-rfc',
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
                            'class' =>'rfc',
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

            <div class="row">
                <div class="col-6">
                    
                       {{ Form::bsInput('password','text',[
                    'label' => ['text' => 'Contraseña', 'class' =>'col-12 control-label'],
                    'value' => '',
                    'attr' => [
                            'placeholder' => 'Ingrese contraseña',
                            'class' =>'input-password',
                            'required' =>true
                        ]
                    ]
                )
                }}
                </div>
                <div class="col-6 text-center" style="margin-top:30px">
                         {{ Form::Button('Generar Clave' , ['class' => 'btn generate-password btn-warning' , 'type' =>'button' ]  ) }}
                </div>   
            </div>

           
          
          
            
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
