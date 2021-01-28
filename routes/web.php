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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/user/logout', 'Auth\LoginController@userLogout')->name('user.logout');


Route::group(['prefix' => 'admin'], function(){
    // Login
    Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
    Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');
    Route::get('/', 'AdminController@index')->name('admin.dashboard');
    Route::get('/logout', 'Auth\AdminLoginController@logout')->name('admin.logout');


    // Perzonalizado
    
    Route::resource('carreras/areas', 'Admin\Carreras\AreasController', [
        'as' => 'admin.carreras',
    ]);


    Route::resource('carreras', 'Admin\Carreras\CarrerasController', [
        'as' => 'admin',
    ]);

    Route::resource('profesores', 'Admin\Profesores\ProfesoresController', [
        'as' => 'admin',
    ]);

    Route::resource('coordinadores', 'Admin\Coordinadores\CoordinadoresController', [
        'as' => 'admin',
    ]);




    // Password resets routes
    // Route::post('/password/email', 'Auth\AdminForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
    // Route::get('/password/reset', 'Auth\AdminForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
    // Route::post('/password/reset', 'Auth\AdminResetPasswordController@reset')->name('admin.password.update');
    // Route::get('/password/reset/{token}', 'Auth\AdminResetPasswordController@showResetForm')->name('admin.password.reset');
});

Route::group(['prefix' => 'coordinador'], function(){
    Route::get('/login', 'Auth\CoordinadorLoginController@showLoginForm')->name('coordinador.login');
    Route::post('/login', 'Auth\CoordinadorLoginController@login')->name('coordinador.login.submit');
    Route::get('/', 'Coordinador\CoordinadorController@index')->name('coordinador.dashboard');
    Route::get('/logout', 'Auth\CoordinadorLoginController@logout')->name('coordinador.logout');
    

    Route::resource('preguntas', 'Coordinador\Preguntas\PreguntasController', [
        'as' => 'coordinador',
    ]);

    Route::resource('profesores', 'Coordinador\Profesores\ProfesoresController', [
        'as' => 'coordinador',
    ]);

});


Route::group(['prefix' => 'profesor'], function(){
    Route::get('/login', 'Auth\ProfesorLoginController@showLoginForm')->name('profesor.login');
    Route::post('/login', 'Auth\ProfesorLoginController@login')->name('profesor.login.submit');
    // Route::get('/', 'AdminController@index')->name('profesor.dashboard');
    Route::get('/logout', 'Auth\ProfesorLoginController@logout')->name('profesor.logout');
});