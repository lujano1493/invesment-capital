<!-- Modal -->
<div class="modal fade" id="modal-cambio-nickname" tabindex="-1" role="dialog" aria-labelledby="labelModalNickname" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="labelModalNickname"> Cambiar Nombre de Usuario</h4>
            </div>
            <div class="modal-body">
               {{ Form::open( array('route' =>['capital.profile.edit'  , "field" =>"nickname"] )) }}
                <div class="row">
                        <div class="col-sm-12">
                            {{ Form::bsInput('nickname','text',[
                                'label' => ['text' => 'Nuevo Nombre de Usuario', 'class' =>'control-label'],
                                'attr' => [
                                        'id' => 'nickname_change',
                                        'placeholder' => 'Ingresa nuevo nombre de usuario',
                                        'required' =>true
                                    ]
                                ]
                            )
                            }}
                            
                        </div>
                        <div class="col-sm-12">
                            {{ Form::bsInput('nickname_confirmation','text',[
                                'label' => ['text' => 'Confirmacion Nuevo Nombre de Usuario', 'class' =>'control-label'],
                                'attr' => [
                                    'id' => 'nickname_change_confirmation',
                                        'placeholder' => 'Ingresa nuevo nombre de usuario',
                                        'required' =>true
                                    ]
                                ]
                            )
                            }}
                            
                        </div>
                        
                </div>

                {{ Form::close() }}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" data-confirm-change="#confirm-password" >Guardar Cambios</button>
            </div>
        </div>
    </div>
</div>




<!-- Modal -->
<div class="modal fade" id="modal-cambio-password" tabindex="-1" role="dialog" aria-labelledby="labelModalpassword" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="labelModalpassword"> Cambiar Contraseña</h4>
            </div>
            <div class="modal-body">
               {{ Form::open( array('route' =>['capital.profile.edit'  , "field" =>"password"] )) }}
                <div class="row">
                        <div class="col-sm-12">
                            {{ Form::bsInput('password_change','password',[
                                'label' => ['text' => 'Nueva Contraseña', 'class' =>'control-label'],
                                'attr' => [
                                        'id' => 'password_change',
                                        'placeholder' => 'Ingresa nueva contraseña',
                                        'required' =>true
                                    ]
                                ]
                            )
                            }}
                            
                        </div>
                        <div class="col-sm-12">
                            {{ Form::bsInput('password_change_confirmation','password',[
                                'label' => ['text' => 'Confirmacion de Contraseña', 'class' =>'control-label'],
                                'attr' => [
                                    'id' => 'password_change_confirmation',
                                        'placeholder' => 'Ingresa confirmacion',
                                        'required' =>true
                                    ]
                                ]
                            )
                            }}
                            
                        </div>
                        
                </div>

                {{ Form::close() }}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" data-confirm-change="#confirm-password" >Guardar Cambios</button>
            </div>
        </div>
    </div>
</div>



<div class="modal fade" id="modal-cambio-email" tabindex="-1" role="dialog" aria-labelledby="labelModalemail" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="labelModalemail"> Cambiar Correo Electrónico</h4>
            </div>
            <div class="modal-body">
               {{ Form::open( array('route' =>['capital.profile.edit'  , "field" =>"email"] )) }}
                <div class="row">
                        <div class="col-sm-12">
                            {{ Form::bsInput('email','email',[
                                'label' => ['text' => 'Nuevo Correo Electrónico', 'class' =>'control-label'],
                                'attr' => [
                                        'id' => 'email_change',
                                        'placeholder' => 'Ingresa nuevo correo electrónico',
                                        'required' =>true
                                    ]
                                ]
                            )
                            }}
                            
                        </div>
                        <div class="col-sm-12">
                            {{ Form::bsInput('email_confirmation','email',[
                                'label' => ['text' => 'Confirmacion Nuevo Correo Electrónico', 'class' =>'control-label'],
                                'attr' => [
                                    'id' => 'email_change_confirmation',
                                        'placeholder' => 'Ingresa  confirmación',
                                        'required' =>true
                                    ]
                                ]
                            )
                            }}
                            
                        </div>
                        
                </div>

                {{ Form::close() }}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" data-confirm-change="#confirm-password" >Guardar Cambios</button>
            </div>
        </div>
    </div>
</div>





<!-- Modal -->
<div class="modal fade" id="confirm-password" tabindex="-1" role="dialog" aria-labelledby="labelModalConfirmacion" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="labelModalConfirmacion"> Confirmacion de Cambios</h4>
            </div>
            <div class="modal-body">
                {{ Form::open( array('route' =>['capital.profile.edit'  , "field" =>"nickname"] )) }}
                <div class="row">
                        <div class="col-sm-12">
                            {{ Form::bsInput('password','password',[
                                'label' => ['text' => 'Ingresa contraseña', 'class' =>'control-label'],
                                'attr' => [
                                        'placeholder' => 'Ingresa contraseña',
                                        'required' =>true
                                    ]
                                ]
                            )
                            }}
                            
                        </div>
                        
                </div>

                {{ Form::close() }}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary btn-confirm-change">Aceptar</button>
            </div>
        </div>
    </div>
</div>
