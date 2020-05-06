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
    return redirect('/home');
    //return view('welcome');
 });

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource("/estudiante", "EstudianteController")->except([
  'create', 'show', 'edit'
]);

Route::resource("/representante", "RepresentanteController")->except([
  'create', 'show', 'edit'
]);

Route::get('/prueba', function(){
    return view('prueba');
});
