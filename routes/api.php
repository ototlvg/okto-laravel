<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

/* Route::get('/admin/getareas'); */

Route::group(['prefix' => 'admin'], function(){
    Route::get('getareas', 'API\AreasController@getAreas')->name('area.getareas');
    Route::get('getagregados', 'API\AreasController@getAgregados')->name('area.getagregados');
    Route::post('storearea', 'API\AreasController@storeArea')->name('area.store');
    Route::post('deletearea', 'API\AreasController@deleteArea')->name('area.delete');

    Route::get('getcarreras', 'API\Admin\Profesores\CarrerasController@getCarreras')->name('api.admin.profesores.carreras.getcarreras');
    Route::get('getagregados', 'API\Admin\Profesores\CarrerasController@getAgregados')->name('api.admin.profesores.carreras.getagregados');
    Route::post('storecarrera', 'API\Admin\Profesores\CarrerasController@storeCarrera')->name('api.admin.profesores.carreras.storecarrera');
    Route::post('deletecarrera', 'API\Admin\Profesores\CarrerasController@deleteCarrera')->name('api.admin.profesores.carreras.deletecarrera');
});

Route::group(['prefix' => 'coordinador'], function(){
    Route::get('getprofesores', 'API\ProfesoresController@getProfesores')->name('coordinador.profesores');
    Route::get('getagregados', 'API\ProfesoresController@getAgregados')->name('coordinador.getagregados');
    Route::post('addprofesortocarrera', 'API\ProfesoresController@addProfesorToCarrera')->name('coordinador.store');
    Route::post('deletecarrerafromprofesor', 'API\ProfesoresController@deleteCarreraFromProfesor')->name('coordinador.delete');

    Route::apiResource('areas/preguntas', 'API\Coordinadores\Areas\PreguntasController', [
        'as' => 'api.coordinador',
    ]);
    Route::post('areas/preguntas/addanswer', 'API\Coordinadores\Areas\PreguntasController@addAnswer')->name('api.coordinador.preguntas.addanswer');
    Route::post('areas/preguntas/updateanswer', 'API\Coordinadores\Areas\PreguntasController@updateAnswer')->name('api.coordinador.preguntas.updateanswer');
    Route::post('areas/preguntas/updatecorrectanswer', 'API\Coordinadores\Areas\PreguntasController@updateCorrectAnswer')->name('api.coordinador.preguntas.updateanswer');
    Route::delete('areas/preguntas/destroyAnswer', 'API\Coordinadores\Areas\PreguntasController@deleteAnswer')->name('api.coordinador.preguntas.deleteanswer');

});