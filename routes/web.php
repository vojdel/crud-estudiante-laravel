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

Route::get("/estudiante/{pagina}/{vista}/{orden}/{tipo}", "EstudianteController@index");

Route::get("/estudiante/contar", "EstudianteController@contar");

Route::resource("/estudiante", "EstudianteController")->except([
  'create', 'show', 'edit'
])->middleware('auth');

Route::resource("/representante", "RepresentanteController")->except([
  'create', 'show', 'edit'
])->middleware('auth');

Route::get("/estudiante/search/{buscar}/{pagina}/{vista}/{orden}/{tipo}", "EstudianteController@search");
