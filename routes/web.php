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
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/registro', function () {
    return view('auth.registro');
});
//Vista de registros
Route::get('/registro/activista', 'RegistroController@activista_view');
Route::get('/registro/empresa', 'RegistroController@empresa_view');
Route::get('/registro/refugio', 'RegistroController@refugio_view');
Route::post('/activista/create', 'RegistroController@activista_save')->name('activista.create');
Route::post('/empresa/create', 'RegistroController@empresa_save')->name('empresa.create');
Route::post('/refugio/create', 'RegistroController@refugio_save')->name('refugio.create');

