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

Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

Route::get('changepassword', 'RrhhController@changePassword')->name('changepassword');
Route::post('password', 'RrhhController@nuevaPassword')->name('nuevaPassword');

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/home/myactivacion/{usuario}/{estado}','HomeController@myActivacion')->name('home.activacion');
Route::get('/home/myreporte/{usuario}/reporte','HomeController@reporte')->name('home.reporte');

Route::prefix('rrhh')->middleware(['auth','role:rrhh'])->group(function () {
	Route::get('usuarios/{usuarios}/roles','RrhhController@roles')
	->name('usuarios.roles');
	Route::get('usuarios/{usuarios}/restablecer','RrhhController@restablecerPassword')
	->name('usuarios.restablecer');
	Route::get('usuarios/asistencia','RrhhController@asistencia')
	->name('usuarios.asistencia');
	Route::post('usuarios/asistencia/lista', 'RrhhController@asistenciaLista')
	->name('usuarios.asistencialista');
	Route::match(['put','patch'],'usuarios/roles/{usuarios}','RrhhController@permisos')
	->name('usuarios.permisos');
	Route::get('usuarios/{usuarios}/especialidad','RrhhController@especialidad')
	->name('usuarios.especialidad');
	Route::match(['put','patch'],'usuarios/{usuarios}/especialidades','RrhhController@updateEspecialidad')
	->name('usuarios.updateEspecialidad');
    Route::resource('usuarios','RrhhController');

    Route::get('conductores/{id}/reporte','ConductorController@reporte')
	->name('conductores.reporte');
    Route::resource('conductores','ConductorController');
});

Route::get('activacion/view', 'ActivacionController@cuartelesActivos')->name('activacion.vista')->middleware('auth','role:activacion');

Route::get('activacion/cuarteles','ActivacionController@showCuarteles')->name('activacion.cuarteles')->middleware('auth','role:activacion');

Route::resource('activacion','ActivacionController',['middleware' => ['role:activacion', 'auth']]);

Route::get('bitacora/search', 'BitacoraController@searchConductor')->middleware('auth','role:bitacora');
Route::get('bitacora/searchVol', 'BitacoraController@searchObac')->middleware('auth','role:bitacora');
Route::get('bitacora/{bitacora}/show', 'BitacoraController@verBitacora')->name('bitacora.ver')->middleware('auth','role:bitacora');
Route::resource('bitacora','BitacoraController',['middleware' => ['role:bitacora', 'auth']]);

Route::get('activacion/{usuario}/{vehiculo}/{estado}','ActivacionController@Activacion')->name('activacion.vehiculo')->middleware('auth','role:activacion');

Route::get('activacion/{usuario}/{tipo}','ActivacionController@tipo_conductor')->name('activacion.tipo')->middleware('auth','role:activacion');

Route::prefix('admin')->group(function () {
	Route::match(['put','patch'],'material_mayor/revision/{material_mayor}','MatMayorController@revision')->name('material_mayor.revision')->middleware('auth','role:adminCBI');
	Route::match(['put','patch'],'material_mayor/permiso/{material_mayor}','MatMayorController@permiso')->name('material_mayor.permiso')->middleware('auth','role:adminCBI');
	Route::match(['put','patch'],'material_mayor/seguro/{material_mayor}','MatMayorController@seguro')->name('material_mayor.seguro')->middleware('auth','role:adminCBI');		
    Route::resource('material_mayor','MatMayorController',['middleware' => ['role:adminCBI', 'auth']]);
    Route::resource('especialidades','EspecialidadController',['middleware' => ['role:adminCBI', 'auth']]);
    Route::resource('claves','ClaveController',['middleware' => ['role:adminCBI', 'auth']]);
});

Route::get('emergencia/listar','EmergenciaController@showEmergencia')->name('emergencia.showCantidad')->middleware('auth','role:emergencia');

Route::get('emergencia/viewActivos', 'EmergenciaController@volActivos')->name('emergencia.vista')->middleware('auth','role:emergencia');

Route::get('visor/volActivos','NotLogin@verVoluntarios')->name('visor');
Route::get('visor/viewActivos', 'NotLogin@volActivos')->name('visor.vol');
Route::get('visor/CuartelesActivos', 'NotLogin@cuartelesActivos')->name('visor.cuartel');
Route::get('visor/operador/{usuario}/{estado}','HomeController@opActivacion')->name('visor.activacion');
Route::get('visor/{usuario}','NotLogin@usuariosActivos')->name('visor.usuario');

Route::get('visor/operadorUnidad/{usuario}/{unidad}/{estado}','HomeController@opActivacionUnidad')->name('visor.unidad');

Route::get('emergencia/{id}/pdf','EmergenciaController@partePDF')->name('emergencia.pdf')->middleware('auth','role:emergencia');
Route::resource('emergencia','EmergenciaController',['middleware' => ['role:emergencia', 'auth']]);

Route::get('partesonline/{parte}/lista', 'PartesController@lista')->name('partesonline.lista')->middleware('auth','role:partes');

Route::get('partesonline/{parte}/pdf', 'PartesController@partePDF')->name('partesonline.pdf')->middleware('auth','role:partes');

Route::match(['put','patch'],'partesonline/lista/{parte}','PartesController@listaParte')->name('partesonline.listaparte')->middleware('auth','role:partes');
Route::resource('partesonline','PartesController',['middleware' => ['role:partes', 'auth']]);

Route::get('cia/busqueda', 'CiaController@busqueda')->name('cia.busqueda')->middleware('auth','role:adminCIA');
Route::match(['put','patch'],'cia/busqueda/{cia}', 'CiaController@busquedalista')->name('cia.busquedalista')->middleware('auth','role:adminCIA');
Route::resource('cia','CiaController',['middleware' => ['role:adminCIA', 'auth']]);

Route::resource('ficha','FichaController',['middleware' => ['role:ficha', 'auth']]);