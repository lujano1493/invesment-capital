<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/







// Authentication Routes...
$this->get('login', 'Auth\LoginController@showLoginForm')->name('login');
$this->post('login', 'Auth\LoginController@login')->name('login');

$this->match(['post','get'], 'logout', 'Auth\LoginController@logout')->name('logout');

$this->match(['post','get'],'send_email_activation', 'Auth\LoginController@send_email_activation')->name('send_email_activation');


$this->match(['post','get'],'send_email_password', 'Auth\LoginController@send_email_password')->name('send_email_password');
$this->match(['post','get'],'restore_password/{token}', 'Auth\LoginController@restore_password')->name('restore_password');




$this->match(['get'],'active_user/{token}','Auth\LoginController@active_user') ->name('active.user');
// Registration Routes...
$this->get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
$this->post('register', 'Auth\RegisterController@register');


$this->get('test', 'HomeController@test')->name('test');

// Password Reset Routes...
$this->get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
$this->post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
$this->get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
$this->post('password/reset', 'Auth\ResetPasswordController@reset');


$this->get('/' ,'HomeController@index')->name('home');
$this->get('/quienes_somos' ,'HomeController@whoWe')->name('quienes_somos');
$this->get('/serivicios' ,'HomeController@services')->name('servicios');
$this->match(['get','post'],'/contacto' ,'HomeController@contact')->name('contacto');



//funciones de usuario
Route::prefix('capital')->group(function(){

    Route::get('inicio', 'CapitalController@index')->name('capital.inicio');
    Route::get('profile', 'CapitalController@profile')->name('capital.profile');
    Route::match( ['post'] ,'profile/edit/{field}', 'CapitalController@editProfile')
        ->where("field", "[a-zA-Z0-9]+")->name('capital.profile.edit');
});


Route::group(['prefix' => 'investment' , 'middleware' => 'auth.access:investment' ],function  (){
    Route::get('/', 'CapitalController@invesment')->name('capital.invesment');
    Route::post('/retirar', 'CapitalController@retirar')->name('capital.retirar');
    Route::get('/document/view/{id}','CapitalController@viewDocument')
       ->where('id',"[0-9]+")->name('capital.document.view');
    Route::get('/document/download/{id}','CapitalController@downloadDocument')
       ->where('id',"[0-9]+")->name('capital.document.download');

});


Route::group(['prefix' => 'educacion' , 'middleware' => 'auth.access:educacion' ],function  (){
    Route::get('/', 'CapitalController@educacion')->name('capital.educacion');

    Route::get('/cuestionario/contestar/{id}', 'CapitalController@constestar')->where('id','[0-9]+')->name("capital.cuestionario.contestar");
    Route::post('/cuestionario/guardar/{id}', 'CapitalController@guardar')->where('id','[0-9]+')->name("capital.cuestionario.guardar");
    Route::post('/cuestionario/finalizar/{id}', 'CapitalController@finalizar')->where('id','[0-9]+')->name("capital.cuestionario.finalizar");

    Route::get('/cuestionario/resultado/{id}', 'CapitalController@resultado')->where('id','[0-9]+')->name("capital.cuestionario.resultado");
    Route::get('/cuestionario/intentar/{id}', 'CapitalController@intentar')->where('id','[0-9]+')->name("capital.cuestionario.intentar");
});






//funciones de administrador
Route::prefix('admin')->group(function (){

    Route::get('users','AdminUsersController@index')->name('admin.users');
    Route::match(['get','post'],'users/register','AdminUsersController@register')->name('admin.users.register');

    Route::get('users/{id}/edit', 'AdminUsersController@edit')->where('id','[0-9]+')->name('admin.users.edit');

    Route::post('users/{id}/edit/profile', 'AdminUsersController@editProfile')->where('id','[0-9]+')->name('admin.users.edit.profile');

    Route::post('users/{id}/edit/access', 'AdminUsersController@editAccess')->where('id','[0-9]+')->name('admin.users.edit.access');
    Route::get('users/{idUser}-{id}/delete/access', 'AdminUsersController@deleteAccess')->where(['idUser'=>'[0-9]+','id'=>'[0-9]+'])->name('admin.users.delete.access');



    Route::get('investment','AdminInvesmentController@inicio')->name('admin.invesment');
    Route::get('investment/{id}/edit', 'AdminInvesmentController@edit')->where('id','[0-9]+')->name('admin.invesment.edit');
    Route::post('investment/{id}/edit/contract', 'AdminInvesmentController@editContract')->where('id','[0-9]+')->name('admin.users.edit.contract');

    Route::post('investment/{id}/edit/representant', 'AdminInvesmentController@editRepresentant')->where('id','[0-9]+')->name('admin.users.edit.representant');
    Route::get('investment/delete/representant', 'AdminInvesmentController@deleteRepresentant')->name('admin.users.delete.representant');


    Route::post('investment/{id}/edit/count-bank', 'AdminInvesmentController@editCountBank')->where('id','[0-9]+')->name('admin.users.edit.count.bank');
    Route::get('investment/delete/count-bank', 'AdminInvesmentController@deleteCountBank')->name('admin.users.delete.count.bank');


    Route::post('investment/{id}/edit/document', 'AdminInvesmentController@editDocument')->where('id','[0-9]+')->name('admin.users.edit.document');
    Route::get('investment/delete/document', 'AdminInvesmentController@deleteDocument')->name('admin.users.delete.document');

    Route::get('investment/view/{id}-document', 'AdminInvesmentController@viewDocument')->where('id','[0-9]+')->name('admin.users.view.document');
    Route::get('investment/download/{id}-document', 'AdminInvesmentController@downloadDocument')->where('id','[0-9]+')->name('admin.users.download.document');

    Route::get('investment/{id}/balances', 'AdminInvesmentController@balances')->where('id','[0-9]+')->name('admin.invesment.balances');

    Route::post('investment/transaction-{id}-edit', 'AdminInvesmentController@editTransaction')->where('id','[0-9]+')->name('admin.users.edit.transaction');
    Route::get('investment/delete/transaction', 'AdminInvesmentController@deleteTransaction')->name('admin.users.delete.transaction');

    Route::post('investment/balance-{id}-edit', 'AdminInvesmentController@editBalance')->where('id','[0-9]+')->name('admin.users.edit.balance');
    Route::get('investment/delete/balance', 'AdminInvesmentController@deleteBalance')->name('admin.users.delete.balance');


     Route::get('investment/calcula-depositos/{id}', 'AdminInvesmentController@calcularTotalDepositos')->where('id','[0-9]+')->name('admin.users.calcula.depositos');
     Route::get('investment/calcula-retiros/{id}', 'AdminInvesmentController@calcularTotalRetiros')->where('id','[0-9]+')->name('admin.users.calcula.retiros');


    Route::get('educacion','AdminEducacionController@inicio')->name('admin.educacion');
    Route::match(['get','post'],'educacion/administrar/{id?}', 'AdminEducacionController@administrar')->where('id','[0-9]+')->name('admin.educacion.administrar');
   Route::get('educacion/elimina/cuestionario/{id}', 'AdminEducacionController@eliminaCuestionario')->where('id','[0-9]+')->name('admin.educacion.elimina.cuestionario');

   Route::get('educacion/asigna/cuestionario/{id}', 'AdminEducacionController@asignaCuestionario')->where('id','[0-9]+')->name('admin.educacion.asigna.cuestionario');

   Route::get('educacion/asigna/cuestionario/user-{idUser}-cuestionario-{idCuestionario}', 'AdminEducacionController@asignaUsuario')
         ->where('idUser','[0-9]+')
         ->where('idCuestionario','[0-9]+')
         ->name('admin.educacion.asigna.usuario');

    Route::get('educacion/cuestionario/vista/{id}','AdminEducacionController@verCuestionario')->where('id','[0-9]+')->name('admin.educacion.ver.cuestionario');


    Route::get('educacion/cuestionario/resultado/{id}','AdminEducacionController@verResultado')->where('id','[0-9]+')->name('admin.educacion.ver.resultado');

    Route::post('educacion/pregunta/{id?}', 'AdminEducacionController@editarPregunta')->where('id','[0-9]+')->name('admin.educacion.pregunta');
    Route::get('educacion/elimina/pregunta', 'AdminEducacionController@eliminaPregunta')->name('admin.educacion.elimina.pregunta');


    Route::post('educacion/opcion/{id?}', 'AdminEducacionController@guardarOpcion')->where('id','[0-9]+')->name('admin.educacion.opcion');
    Route::get('educacion/elimina/opcion', 'AdminEducacionController@eliminaOpcion')->name('admin.educacion.elimina.opcion');


});
