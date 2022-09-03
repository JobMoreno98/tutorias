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

Route::get('/capturar-alumno', array(
    'as' => 'createAlumno',
    'uses' => 'AlumnoController@createAlumno'
));
Route::post('/guardar-alumno', array(
    'as' => 'saveAlumno',
    'uses' => 'AlumnoController@saveAlumno'
));
Route::get('/modificar-alumno/{alumno_id}', array(
    'as' => 'editarAlumno',
    'uses' => 'AlumnoController@editarAlumno'
));
Route::post('/update-alumno/{alumno_id}', array(
    'as' => 'updateAlumno',
    'uses' => 'AlumnoController@updateAlumno'
));
Route::get('/elegirTutoria/{alumno_id}/{ciclo}', array(
    'as' => 'elegirTutoria',
    'middleware' => 'auth',
    'uses' => 'TutorController@obtenerTutorias'
));
Route::get('/capturar-tutor', array(
    'as' => 'createTutor',
    'uses' => 'TutorController@createTutor'
));
Route::post('/guardar-tutor', array(
    'as' => 'saveTutor',
    'uses' => 'TutorController@saveTutor'
));
Route::get('/modificar-tutor/{tutor_id}', array(
    'as' => 'editarTutor',
    'uses' => 'TutorController@editarTutor'
));
Route::get('/delete-tutor/{tutor_id}', array(
    'as' => 'deleteTutor',
    'uses' => 'TutorController@deleteTutor'
));
Route::get('/capturar-tutoria', array(
    'as' => 'createTutoria',
    'uses' => 'TutorController@createTutoria'
));
Route::get('/modificar-tutoria/{tutoria_id}', array(
    'as' => 'editarTutoria',
    'uses' => 'TutoriaController@editarTutoria'
));
Route::post('/guardar-tutoria', array(
    'as' => 'saveTutoria',
    'uses' => 'TutorController@saveTutoria'
));
Route::get('/delete-tutoria/{tutoria_id}', array(
    'as' => 'deleteTutoria',
    'uses' => 'TutoriaController@deleteTutoria'
));
Route::get('/guardar-seleccion-tutor/{alumno_id}/{tutoria_id}/{ciclo}', array(
    'as' => 'saveSeleccionTutor',
    'middleware' => 'auth',
    'uses' => 'TutoriaController@saveSeleccionTutor'
));
Route::get('/cancelar-tutoria/{alumno_id}/{inscripcion_id}/{ciclo}', array(
    'as' => 'cancelarTutoria',
    'uses' => 'TutoriaController@cancelarTutoria'
));
Route::get('/listaInscritos/{ciclo}', array(
    'as' => 'listaInscritos',
    'middleware' => 'auth',
    'uses' => 'TutoriaController@listaInscritos'
));
Route::get('/listaInscritosDT/{ciclo}', array(
    'as' => 'listaInscritosDT',
    'middleware' => 'auth',
    'uses' => 'TutoriaController@listaInscritosDT'
));
Route::get('/listaNoInscritosDT/{ciclo}', array(
    'as' => 'listaNoInscritosDT',
    'middleware' => 'auth',
    'uses' => 'TutoriaController@listaNoInscritosDT'
));
Route::get('/fichaAlumno/{alumno_id}/{ciclo}', array(
    'as' => 'fichaAlumno',
    'middleware' => 'auth',
    'uses' => 'AlumnoController@fichaAlumno'
));
Route::get('/listaTutores', array(
    'as' => 'listaTutores',
    'middleware' => 'auth',
    'uses' => 'TutorController@listaTutores'
));
Route::get('/listaTutorias/{ciclo}', array(
    'as' => 'listaTutorias',
    'middleware' => 'auth',
    'uses' => 'TutoriaController@listaTutorias'
));
Route::post('/updateTutoria/{tutoria_id}', array(
    'as' => 'updateTutoria',
    'middleware' => 'auth',
    'uses' => 'TutoriaController@updateTutoria'
    ));
Route::post('/updateTutor/{tutor_id}', array(
    'as' => 'updateTutor',
    'middleware' => 'auth',
    'uses' => 'TutorController@updateTutor'
));
Route::get('/graficas', 'GraficasController@graficas')->name('graficas');
Route::post('/vista-ciclo', array(
    'as' => 'vista-ciclo',
    'middleware' => 'auth',
    'uses' => 'CicloController@vista_ciclo'
));
Route::get('/actualizarEstatus/{alumno_id}', array(
    'as' => 'actualizarEstatus',
    'middleware' => 'auth',
    'uses' => 'AlumnoController@actualizarEstatus'
));
Route::get('/ciclos', array(
    'as' => 'ciclos',
    'middleware' => 'auth',
    'uses' => 'CicloController@index'
));
Route::get('/create-ciclo', array(
    'as' => 'create-ciclo',
    'middleware' => 'auth',
    'uses' => 'CicloController@create'
));
Route::post('/save-ciclo', array(
    'as' => 'save-ciclo',
    'middleware' => 'auth',
    'uses' => 'CicloController@store'
));
Route::get('/edit-ciclo/{ciclo_id}', array(
    'as' => 'edit-ciclo',
    'middleware' => 'auth',
    'uses' => 'CicloController@edit'
));
Route::post('/updated-ciclo', array(
    'as' => 'updated-ciclo',
    'middleware' => 'auth',
    'uses' => 'CicloController@update'
));
Route::get('/eliminar-ciclo/{ciclo_id}', array(
    'as' => 'eliminar-ciclo',
    'middleware' => 'auth',
    'uses' => 'CicloController@destroy'
));
Route::get('/ver-tutoria/{alumno_id}/{ciclo_actual}', array(
    'as' => 'ver-tutoria',
    'uses' => 'AlumnoController@verTutoria'
));
