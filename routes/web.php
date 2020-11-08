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
        // Rutas para mostrar los menus de arriba
        Route::get('/carreras', 'Admin\Carreras\CarrerasController@index')->name('admin.carreras');
        Route::get('/coordinadores', 'Admin\Coordinadores\CoordinadoresController@index')->name('admin.coordinadores');
        Route::get('/profesores', 'Admin\Profesores\ProfesoresController@index')->name('admin.profesores');
    
        // Rutas de carreras (Programas educativos)
        Route::get('/carreras/agregar', 'Admin\Carreras\CarrerasController@showAgregar')->name('admin.showAgregar');
        Route::post('/carreras', 'Admin\Carreras\CarrerasController@storeCarrera')->name('admin.storeCarrera');
        Route::resource('/areas', 'Admin\Carreras\AreasController');
        Route::get('/areas/agregar/{carreraid}', 'Admin\Carreras\AreasController@agregarAreaACarrera')->name('admin.carreras.area.agregar');
    
        // Rutas de profesores
        Route::get('/profesores/pe/{profesorid}', 'Admin\Profesores\ProfesoresController@indexCarreras')->name('admin.profesores.carreras');
        Route::get('/profesores/carreras', 'Admin\Carreras\CarrerasController@showCarrera')->name('admin.showCarrera');
    

        // Resources
        Route::resources([
            'crud' => Admin\Coordinadores\CRUDController::class,
            'profesorescrud' => Admin\Profesores\ProfesoresCRUDController::class,
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
    // Route::get('/', 'Admin\Coordinador\CoordinadorController@index')->name('coordinador.dashboard');
    Route::get('/logout', 'Auth\CoordinadorLoginController@logout')->name('coordinador.logout');
});


Route::group(['prefix' => 'profesor'], function(){
    Route::get('/login', 'Auth\ProfesorLoginController@showLoginForm')->name('profesor.login');
    Route::post('/login', 'Auth\ProfesorLoginController@login')->name('profesor.login.submit');
    // Route::get('/', 'AdminController@index')->name('profesor.dashboard');
    Route::get('/logout', 'Auth\ProfesorLoginController@logout')->name('profesor.logout');
});