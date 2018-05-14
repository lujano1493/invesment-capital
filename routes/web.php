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

Route::get('/', function () {
     return redirect('login');
});




Route::get('foo', function () {
    return 'Hello World';
});



// Authentication Routes...
$this->match(['post','get'],'login', 'Auth\LoginController@showLoginForm')->name('login');
$this->match(['post','get'], 'logout', 'Auth\LoginController@logout')->name('logout');

$this->match(['post','get'],'send_email_activation', 'Auth\LoginController@send_email_activation')->name('send_email_activation');


$this->match(['post','get'],'send_email_password', 'Auth\LoginController@send_email_password')->name('send_email_password');
$this->match(['post','get'],'restore_password/{token}', 'Auth\LoginController@restore_password')->name('restore_password');




$this->match(['get'],'active_user/{token}','Auth\LoginController@active_user') ->name('active.user');
// Registration Routes...
$this->get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
$this->post('register', 'Auth\RegisterController@register');

// Password Reset Routes...
$this->get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
$this->post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
$this->get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
$this->post('password/reset', 'Auth\ResetPasswordController@reset');

Route::prefix('invesment')->group(function(){

    Route::get('inicio', 'UserController@index')->name('invesment.inicio');
});


Route::prefix('admin')->group(function (){

    Route::get('inicio','AdminController@index')->name('admin.inicio');

});




