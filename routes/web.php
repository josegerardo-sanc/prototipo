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


Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');


Route::get('/', function () {
    return view('auth.login');
})->middleware('guest');


Route::get('/error',function(){
    return view('Error.error');
});

Route::get('/Usuario', function () {
    return view('Usuario.index');
});

Route::resource('/allUser', 'DatosUsersController');
Route::post('/allUser/{id}/entrada', 'DatosUsersController@entrada');


Route::resource('/Areas', 'AreaController');
Route::resource('/reporte', 'EntradasUsersController');
Route::post('/imprimir', 'EntradasUsersController@imprimir');
