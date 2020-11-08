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
    Route::get('/carreras', 'Admin\CarrerasController@index')->name('admin.carreras');
    Route::get('/coordinadores', 'Admin\CoordinadoresController@index')->name('admin.coordinadores');
    Route::get('/carreras/agregar', 'Admin\CarrerasController@showAgregar')->name('admin.showAgregar');
    Route::get('/carreras/{idcarrera}', 'Admin\CarrerasController@showCarrera')->name('admin.showCarrera');
    Route::post('/carreras', 'Admin\CarrerasController@storeCarrera')->name('admin.storeCarrera');


    // Password resets routes
    Route::post('/password/email', 'Auth\AdminForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
    Route::get('/password/reset', 'Auth\AdminForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
    Route::post('/password/reset', 'Auth\AdminResetPasswordController@reset')->name('admin.password.update');
    Route::get('/password/reset/{token}', 'Auth\AdminResetPasswordController@showResetForm')->name('admin.password.reset');
});

Route::group(['prefix' => 'coordinador'], function(){
    Route::get('/login', 'Auth\CoordinadorLoginController@showLoginForm')->name('coordinador.login');
    Route::post('/login', 'Auth\CoordinadorLoginController@login')->name('coordinador.login.submit');
    Route::get('/', 'CoordinadorController@index')->name('coordinador.dashboard');
    Route::get('/logout', 'Auth\CoordinadorLoginController@logout')->name('coordinador.logout');

});
