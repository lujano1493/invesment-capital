{{ Form::model($user ,array('route' => ['admin.users.edit.profile',$user ] ,  'class'=> 'form-horizontal' )) }}
            {{ Form::bsInput('name','text',[
                    'label' => ['text' => 'Nombre(s)', 'class' =>'col-12 control-label'],
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
                    'attr' => [
                            'placeholder' => 'Ingrese fecha de nacimiento',
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


             
                <div class="form-group text-center">
                    {{ Form::Button('Modificar' , ['class' => 'btn btn-primary col-6' , 'type' =>'submit' ]  ) }}
                </div>
         
        {{ Form::close() }}


        <!--  <a href="{{ route('admin.users') }}" class="btn btn-danger btn-block"> Cancelar </a>  -->