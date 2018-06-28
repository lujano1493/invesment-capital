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


Route::group(['prefix' => 'invesment' , 'middleware' => 'auth.access:invesment' ],function  (){
    Route::get('/', 'CapitalController@invesment')->name('capital.invesment');
});


Route::group(['prefix' => 'educacion' , 'middleware' => 'auth.access:educacion' ],function  (){
    Route::get('/', 'CapitalController@educacion')->name('capital.educacion');
});






//funciones de administrador
Route::prefix('admin')->group(function (){

    Route::get('users','AdminUsersController@index')->name('admin.users');
    Route::match(['get','post'],'users/register','AdminUsersController@register')->name('admin.users.register');

    Route::get('users/{id}/edit', 'AdminUsersController@edit')->where('id','[0-9]+')->name('admin.users.edit');

    Route::post('users/{id}/edit/profile', 'AdminUsersController@editProfile')->where('id','[0-9]+')->name('admin.users.edit.profile');

    Route::post('users/{id}/edit/access', 'AdminUsersController@editAccess')->where('id','[0-9]+')->name('admin.users.edit.access');
    Route::get('users/{idUser}-{id}/delete/access', 'AdminUsersController@deleteAccess')->where(['idUser'=>'[0-9]+','id'=>'[0-9]+'])->name('admin.users.delete.access');



    Route::get('invesment','AdminInvesmentController@inicio')->name('admin.invesment');
    Route::get('invesment/{id}/edit', 'AdminInvesmentController@edit')->where('id','[0-9]+')->name('admin.invesment.edit');
    Route::post('invesment/{id}/edit/contract', 'AdminInvesmentController@editContract')->where('id','[0-9]+')->name('admin.users.edit.contract');


    Route::get('educacion','AdminEducacionController@inicio')->name('admin.educacion');

});
