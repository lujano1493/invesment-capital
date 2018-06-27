{{ Form::model($user ,array('route' => ['admin.users.edit.profile',$user ] ,  'class'=> 'form-horizontal' )) }}
            {{ Form::bsInput('name','text',[
                    'label' => ['text' => 'Nombre(s)', 'class' =>'col-12 control-label'],
                    'attr' => [
                           'class' =>'nombre-rfc',
                            'placeholder' => 'Ingresa nombre',
                            'required' =>true
                        ]
                    ]
                )
            }}
            {{ Form::bsInput('last_name','text',[
                    'label' => ['text' => 'Apellido Paterno', 'class' =>'col-12  control-label'],
                    'value' =>  old('last_name'),
                    'attr' => [
                            'placeholder' => 'Ingresa apellido paterno',
                            'class' =>'apellido-pat-rfc',
                            'required' =>true
                        ]
                    ]
                )
            }}

             {{ Form::bsInput('last_second_name','text',[
                    'label' => ['text' => 'Apellido Materno', 'class' =>'col-12 control-label'],
                    'value' =>  old('last_second_name'),
                    'attr' => [
                            'placeholder' => 'Ingresa apellido materno',
                            'class' =>'apellido-mat-rfc',
                            'required' =>true
                        ]
                    ]
                )
            }}
           

            {{ Form::bsInput('birth_date','date',[
                    'label' => ['text' => 'Fecha de Nacimiento', 'class' =>'col-12 control-label'],
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
                            'class' =>'nickname',
                            'required' =>true
                        ]
                    ]
                )
            }}

             {{ Form::bsInput('email','email',[
                    'label' => ['text' => 'Correo Electrónico', 'class' =>'col-12 control-label'],
                    'attr' => [
                            'placeholder' => 'Ingrese correo electrónico',
                            'required' =>true
                        ],
                    'value_current' => true
                    ]
                )
            }}


                {{ Form::bsInput('status','select',[
                    'label' => ['text' => 'Estatus de Cuenta', 'class' =>'col-12 control-label'],
                    'list' =>$catEstatus,
                    'attr' => [
                            'required' =>true
                        ],
                    'value_current' => true
                    ]
                )
            }}


             
                <div class="form-group text-center">
                    {{ Form::Button('Modificar' , ['class' => 'btn btn-primary' , 'type' =>'submit' ]  ) }}
                </div>
         
        {{ Form::close() }}

