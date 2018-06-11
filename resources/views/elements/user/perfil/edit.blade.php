{{ Form::model(  Auth::user() ,array('route' =>'capital.profile'  )) }}
            
<div class="row">
    <div class="col-sm-6 ">
        {{ Form::bsInput('name','text',[
                    'label' => ['text' => 'Nombre(s)', 'class' =>'control-label'],
                    'attr' => [
                            'placeholder' => 'Ingresa nombre',
                            'required' =>true,
                            'readonly' =>true
                        ]
                    ]
                )
            }}
    </div>   
    <div class="col-sm-6 ">
          {{ Form::bsInput('last_name','text',[
                    'label' => ['text' => 'Apellidos', 'class' =>'control-label'],
                    'value' =>  old('last_name'),
                    'attr' => [
                            'placeholder' => 'Ingresa apellidos',
                            'required' =>true,
                             'readonly' =>true
                        ]
                    ]
                )
            }}
    </div>  

</div>



<div class="row">
    <div class="col-sm-6 ">
           {{ Form::bsInput('nickname','text',[
                    'label' => ['text' => 'Nombre de Usuario', 'class' =>'control-label'],
                    'value' =>  old('nickname'),
                    'attr' => [
                            'placeholder' => 'Ingrese nombre de usuario',
                            'required' =>true,
                             'readonly' =>true
                        ]
                    ]
                )
            }}
        
    </div>   
    <div class="col-sm-6 ">
           {{ Form::bsInput('birth_date','date',[
                'label' => ['text' => 'Fecha de Nacimiento', 'class' =>'control-label'],
                'attr' => [
                        'placeholder' => 'Ingrese fecha de nacimiento',
                        'required' =>true,
                        'readonly' =>true
                    ]
                ]
            )
        }}
    </div>  

</div>
        
<div class="row"> 
    <div class="col-sm-6 ">
           {{ Form::bsInput('email','email',[
                'label' => ['text' => 'Correo Electrónico', 'class' =>'control-label'],
                'attr' => [
                        'placeholder' => 'Ingrese correo electrónico',
                        'required' =>true,
                        'readonly' =>true

                    ],
                'value_current' => true
                ]
            )
        }}
    </div>  

    <div class="col-sm-6 ">
        {{ Form::bsInput('status','select',[
                'label' => ['text' => 'Estatus de Cuenta', 'class' =>'control-label'],
                'list' =>$catEstatus,
                'attr' => [
                        'required' =>true,
                         'readonly' =>true
                    ],
                'value_current' => true
                ]
            )
        }}
        
        </div>  

</div>
        

 <div class="row">
   
    <div class="col-sm-4  text-center">
        <div class="form-group ">
             <button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#modal-cambio-nickname">
             Cambiar Nombre de Usuario </button>
        </div>
       
    </div>  
    <div class="col-sm-4 text-center ">
        <div class="form-group ">
             <button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#modal-cambio-password">Cambiar Contraseña </button>
        </div>
       
    </div> 
    <div class="col-sm-4 text-center">
        <div class="form-group ">
            <button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#modal-cambio-email">Cambiar Correo Electrónico</button>
        </div>
    </div>  

</div>

{{ Form::close() }}

