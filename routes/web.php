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

Route::get('/estudiante*', function(){
  return view('home');
});

Route::get('/parroquia', function(){
  return view('home');
});

Route::get('/estado', function(){
  return view('home');
});

Route::get('/municipio', function(){
  return view('home');
});

Route::resource("/student", "EstudianteController")->except([
  'create', 'show', 'edit'
])->middleware('auth');

Route::get("/student/{pagina}/{vista}/{orden}/{tipo}", "EstudianteController@index");

Route::get("/student/contar", "EstudianteController@contar");

Route::get("/student/search/{buscar}/{pagina}/{vista}/{orden}/{tipo}", "EstudianteController@search");

Route::resource("/estado", "EstadoController")->except([
  'create', 'show', 'edit'
])->middleware('auth');

Route::get("/municipio/estado/{estado}", "MunicipioController@byEstado");

Route::resource("/municipio", "MunicipioController")->except([
  'create', 'show', 'edit'
])->middleware('auth');

Route::get("/parroquia/municipio/{municipio}", "ParroquiaController@byMunicipio");

Route::resource("/parroquia", "ParroquiaController")->except([
  'create', 'show', 'edit'
])->middleware('auth');

Route::resource("/representante", "RepresentanteController")->except([
  'create', 'show', 'edit'
])->middleware('auth');
