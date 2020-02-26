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
Route::post('/activista/editar', 'PerfilController@activista_update');
Route::post('/activista/validar', 'PerfilController@validar_activista')->name('activista.validar');
Route::post('/enlace/save', 'PerfilController@enlace_save');
Route::post('/enlace/editar', 'PerfilController@enlace_edit');
Route::get('/enlace/{id}/delete', 'PerfilController@enlase_delete');

Route::post('/enlace/validar', 'PerfilController@validar_enlace')->name('enlace.validar');
Route::post('/perfil/save', 'PerfilController@perfil_save');

Route::get('/Perfil', 'PerfilController@perfil_view');
Route::post('/persona/validar', 'PerfilController@validar_persona')->name('persona.validar');
Route::post('/persona/editar', 'PerfilController@persona_update');
Route::post('/empresa/validar', 'PerfilController@validar_empresa')->name('empresa.validar');
Route::post('/empresa/editar', 'PerfilController@empresa_update');
Route::post('/refugio/validar', 'PerfilController@validar_refugio')->name('refugio.validar');
Route::post('/refugio/editar', 'PerfilController@refugio_update');
