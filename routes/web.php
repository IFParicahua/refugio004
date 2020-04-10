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
Route::get('/Mascotas', 'MascotaController@mascota_view');
Route::post('/raza/search', 'MascotaController@raza_search')->name('raza.search');
Route::post('/size/search', 'MascotaController@size_search')->name('size.search');
Route::post('/persona/search', 'MascotaController@persona_search')->name('persona.search');

Route::post('/mascota/validar', 'MascotaController@validar_mascota')->name('mascota.validar');
Route::post('/rescate/validar', 'MascotaController@validar_rescate')->name('rescate.validar');

Route::post('/mascota/save', 'MascotaController@mascota_save');
Route::post('/rescate/save', 'MascotaController@rescate_save');

Route::get('/mascota/info/{id}', 'MascotaController@info_complete');
Route::post('/mascota/edit', 'MascotaController@mascota_edit');
Route::post('/historial/save', 'MascotaController@mascota_historial_save');
Route::post('/historial/edit', 'MascotaController@mascota_historial_edit');
Route::get('/historial/{id}/delete', 'MascotaController@mascota_historial_delete');
Route::post('/mascota/foto', 'MascotaController@gallery_save');
Route::get('/mascota/{id}/foto', 'MascotaController@gallery_delete');
Route::get('/mascota/{id}/procedimiento', 'MascotaController@process_next');
