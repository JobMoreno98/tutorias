<?php

use App\Http\Controllers\AlumnoController;
use App\Http\Controllers\CicloController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TutorController;
use App\Http\Controllers\TutoriaController;
use App\Http\Controllers\GraficasController;
use Illuminate\Support\Facades\Route;
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

Route::get('/home', [HomeController::class, 'index'])->name('home')->middleware('auth');

Route::get('/capturar-alumno', [AlumnoController::class, 'createAlumno'])->name('createAlumno')->middleware('auth');

Route::post('/guardar-alumno', [AlumnoController::class, 'saveAlumno'])->name('saveAlumno')->middleware('auth');

Route::get('/modificar-alumno/{alumno_id}', [AlumnoController::class, 'editarAlumno'])->name('editarAlumno')->middleware('auth');

Route::get('/elegirTutoria/{alumno_id}/{ciclo}', [TutorController::class, 'obtenerTutorias'])->name('elegirTutoria')->middleware('auth');

Route::post('/update-alumno/{alumno_id}', [AlumnoController::class, 'updateAlumno'])
    ->name('updateAlumno')
    ->middleware('auth');

Route::get('/capturar-tutor', [TutorController::class, 'createTutor'])->name('createTutor')->middleware('auth');

Route::post('/guardar-tutor', [TutorController::class, 'saveTutor'])->name('saveTutor')->middleware('auth');

Route::get('/modificar-tutor/{tutor_id}', [TutorController::class, 'editarTutor'])->name('editarTutor')->middleware('auth');

Route::get('/delete-tutor/{tutor_id}', [TutorController::class, 'deleteTutor'])->name('deleteTutor')->middleware('auth');

Route::get('/capturar-tutoria', [TutorController::class, 'createTutoria'])->name('createTutoria')->middleware('auth');

Route::get('/modificar-tutoria/{tutoria_id}', [TutoriaController::class, 'editarTutoria'])->name('editarTutoria')->middleware('auth');

Route::post('/guardar-tutoria', [TutorController::class, 'saveTutoria'])->name('saveTutoria')->middleware('auth');

Route::get('/delete-tutoria/{tutoria_id}', [TutoriaController::class, 'deleteTutoria'])->name('deleteTutoria');

Route::get('/guardar-seleccion-tutor/{alumno_id}/{tutoria_id}/{ciclo}', [TutoriaController::class, 'saveSeleccionTutor'])
    ->name('saveSeleccionTutor')
    ->middleware('auth');

Route::get('/cancelar-tutoria/{alumno_id}/{inscripcion_id}/{ciclo}', [TutoriaController::class, 'cancelarTutoria'])->name('cancelarTutoria')->middleware('auth');

Route::get('/listaInscritos/{ciclo}', [TutoriaController::class, 'listaInscritos'])->name('listaInscritos')->middleware('auth');

Route::get('/listaInscritosDT/{ciclo}', [TutoriaController::class, 'listaInscritosDT'])->name('listaInscritosDT')->middleware('auth');

Route::get('/listaNoInscritosDT/{ciclo}', [TutoriaController::class, 'listaNoInscritosDT'])->name('listaNoInscritosDT')->middleware('auth');

Route::get('/fichaAlumno/{alumno_id}/{ciclo}', [AlumnoController::class, 'fichaAlumno'])->name('fichaAlumno')->middleware('auth');

Route::get('/listaTutores', [TutorController::class, 'listaTutores'])->name('listaTutores')->middleware('auth');

Route::get('/listaTutorias/{ciclo}', [TutoriaController::class, 'listaTutorias'])->name('listaTutorias')->middleware('auth');

Route::post('/updateTutoria/{tutoria_id}', [TutoriaController::class, 'updateTutoria'])->name('updateTutoria')->middleware('auth');

Route::post('/updateTutor/{tutor_id}', [TutorController::class, 'updateTutor'])->name('updateTutor')->middleware('auth');

Route::get('/graficas', [GraficasController::class, 'graficas'])->name('graficas')->middleware('auth');

Route::post('/vista-ciclo', [CicloController::class, 'vista_ciclo'])
    ->name('vista-ciclo')
    ->middleware('auth');

Route::get('/actualizarEstatus/{alumno_id}', [AlumnoController::class, 'actualizarEstatus'])->name('actualizarEstatus')->middleware('auth');

/* DESDE AQUI*/

Route::get('/ciclos', [CicloController::class, 'index'])->name('ciclos')->middleware('auth');

Route::get('/create-ciclo', [CicloController::class, 'create'])->name('create-ciclo')->middleware('auth');

Route::post('/save-ciclo', [CicloController::class, 'store'])->name('save-ciclo')->middleware('auth');

Route::get('/edit-ciclo/{ciclo_id}', [CicloController::class, 'edit'])->name('edit-ciclo')->middleware('auth');

Route::post('/updated-ciclo/{ciclo_id}', [CicloController::class, 'update'])->name('updated-ciclo')->middleware('auth');

Route::get('/eliminar-ciclo/{ciclo_id}', [CicloController::class, 'destroy'])->name('eliminar-ciclo')->middleware('auth');

Route::get('/ver-tutoria/{alumno_id}/{ciclo_actual}', [AlumnoController::class, 'verTutoria'])->name('ver-tutoria')->middleware('auth');

Route::get("/repetir-tutoria/{ciclo_nuevo}/{ciclo_viejo}", [TutoriaController::class, 'repetir'])->name('repetir.tutoria')->middleware('auth');

Route::post('/registro-evidencia', [AlumnoController::class, 'evidenciaForm'])->name('registro.evidencia');
