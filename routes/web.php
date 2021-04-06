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
Route::get('/perfil', 'Alumno\Perfil\PerfilController@index')->name('perfil');

// Route::resource('alumno.perfil', 'Alumno\Perfil\PerfilController');
Route::resource('/perfil', 'Alumno\Perfil\PerfilController', [
    'as' => 'alumno',
]);

Route::get('/user/logout', 'Auth\LoginController@userLogout')->name('user.logout');

Route::resource('/areas', 'Alumno\Areas\AreasController', [
    'as' => 'alumno',
]);
// Route::resource('/areas/survey', 'Alumno\Areas\SurveyController', [
//     'as' => 'alumno.areas',
// ]);

Route::group(['prefix' => 'areas'], function(){

    Route::resource('/survey', 'Alumno\Areas\SurveyController', [
        'as' => 'alumno.areas',
    ]);
    Route::get('/survey/resultados/{areaid}/{iteration}', 'Alumno\Areas\SurveyController@results')->name('alumno.areas.survey.results');

    
    // Route::resource('/', 'Alumno\Areas\SurveyController', [
    //     'as' => 'alumno.areas',
    // ]);
});

// Route::get('/areas/survey/{area}', 'Alumno\Areas\SurveyController@show')->name('alumno.areas.survey');


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

    Route::resource('alumnos', 'Admin\Alumnos\AlumnosController', [
        'as' => 'admin',
    ]);
    Route::post('alumnos/upload', 'Admin\Alumnos\AlumnosController@readExcel')->name('admin.alumnos.excel');



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

    Route::get('/', function () {
        return redirect('coordinador/profesores');
    });
    

    Route::resource('preguntas', 'Coordinador\Preguntas\PreguntasController', [
        'as' => 'coordinador',
    ]);

    Route::resource('profesores', 'Coordinador\Profesores\ProfesoresController', [
        'as' => 'coordinador',
    ]);

    Route::resource('areas', 'Coordinador\Areas\AreasController', [
        'as' => 'coordinador',
    ]);

});


Route::group(['prefix' => 'profesor'], function(){
    Route::get('/login', 'Auth\ProfesorLoginController@showLoginForm')->name('profesor.login');
    Route::post('/login', 'Auth\ProfesorLoginController@login')->name('profesor.login.submit');
    Route::get('/logout', 'Auth\ProfesorLoginController@logout')->name('profesor.logout');
    
    // Route::get('/', 'AdminController@index')->name('profesor.dashboard');

    Route::resource('guia', 'Profesor\Guia\GuiaController', [
        'as' => 'profesor',
    ]);

    // Route::post('/guia/comentario', 'Profesor\Guia\GuiaController@storeComentario')->name('profesor.guia.comentario.store');

    Route::resource('comentario', 'Profesor\Guia\ComentariosController', [
        'as' => 'profesor.guia',
    ]);

    Route::resource('carreras', 'Profesor\Carreras\CarrerasController', [
        'as' => 'profesor',
    ]);

    Route::resource('perfil', 'Profesor\Perfil\PerfilController', [
        'as' => 'profesor',
    ]);
});