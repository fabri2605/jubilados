<?php

use Illuminate\Support\Facades\Route;

Auth::routes();
Route::get('/', 'SitioController@landing')->name('inicio');
Route::get('/testing', 'SitioController@testing')->name('testing');
Route::get('/waiting', 'SitioController@landingSR')->name('inicio_sanrafael');

Route::get('/particulares', 'SitioController@particulares')->name('particulares');
Route::get('/sanrafael/solicitud', 'SitioController@sanrafael')->name('sanrafael');
Route::get('/inicio', 'SitioController@sitio')->name('home');
Route::get('/testing/sanrafael', 'SitioController@sitioSanRafael')->name('home_sr');
Route::get('/sanrafael', 'SitioController@sitioSanRafael')->name('home_san_rafael');

Route::get('/retira', 'SitioController@retirala')->name('retirala');
Route::get('/home', 'HomeController@index')->name('menu');
Route::get('/turno', 'SitioController@turno')->name('turno');

Route::resource('users', 'UserController');
Route::resource('solicitudes', 'SolicitudController');
Route::resource('solicitudes_san_rafael', 'SolicitudSanRafaelController');
Route::resource('oficina', 'OficinaController');
Route::resource('turnos', 'TurnoController');
Route::resource('dias', 'DiaEspecialController');

Route::group(['prefix' => 'sitio'], function () {
    Route::post('/validar/abono', 'SitioController@validarAbono')->name('sitio.abono');
    Route::post('/validar/abono/particular', 'SitioController@validarAbonoParticular')->name('sitio.abono_particular');
    Route::post('/validar/abono/particular/sanrafael', 'SitioController@validarAbonoParticularSanRafael')->name('sitio.abono_particular_sanrafael');
    Route::post('/registrar/abono/particulares', 'SitioController@registrarParticular')->name('sitio.abono_registro');
    Route::post('/registrar', 'SitioController@registrar')->name('sitio.registrar');
    Route::post('/registrar/abono/particulares/sanrafael', 'SitioController@registrarParticularSanRafael')->name('sitio.abono_registro_san_rafael');
    //TURNOS
    Route::post('/obtener/oficinas', 'SitioController@obtenerOficinasXLocalidad')->name('sitio.turnos_obtener_oficinas');
    Route::post('/obtener/dias/especiales', 'SitioController@diasEspeciales')->name('sitio.diasEspeciales');
    Route::post('/obtener/dias/disponibles', 'SitioController@diasDisponibles')->name('sitio.diasDisponibles');
    Route::post('/obtener/horarios/dia', 'SitioController@horariosDia')->name('sitio.diasDisponibles');
    //OFICINAS
    Route::get('oficinas/obtener/coordenadas/{data}', 'SitioController@oficinaXId')->name('sitio.coordenadas');

    Route::post('/registrarTurno', 'SitioController@registrarTurno')->name('sitio.registrar_turno');
});  

Route::group(['prefix' => 'solicitudes'], function () {
    Route::delete('/eliminar/{data}', 'SolicitudController@destroy')->name('solicitudes.eliminar');
    Route::post('/generar/reporte/', 'SolicitudController@reporte')->name('solicitudes.reporte');
});  

Route::group(['prefix' => 'solicitudes_san_rafael'], function () {
    Route::delete('/eliminar/{data}', 'SolicitudSanRafaelController@destroy')->name('solicitudes_san_rafael.eliminar');
    Route::post('/generar/reporte/', 'SolicitudSanRafaelController@reporte')->name('solicitudes_san_rafael.reporte');
});  

Route::group(['prefix' => 'enviados'], function () {
    Route::get('/', 'EnviadoController@index')->name('enviados.index');
    Route::post('importar/','EnviadoController@importar')->name('enviados.upload');
});  


Route::group(['prefix' => 'enviado_san_rafael'], function () {
    Route::get('/', 'EnviadoSanRafaelController@index')->name('enviado_san_rafael.index');
    Route::post('importar/','EnviadoSanRafaelController@importar')->name('enviado_san_rafael.upload');
});  


Route::group(['prefix' => 'oficina'], function () {
    Route::delete('/eliminar/{data}', 'OficinaController@destroy')->name('oficina.eliminar');
});

Route::group(['prefix' => 'dias'], function () {
    Route::delete('/eliminar/{data}', 'DiaEspecialController@destroy')->name('dias.eliminar');
});

Route::group(['prefix' => 'turnos/'], function () {
    Route::delete('/eliminar/{data}', 'TurnoController@destroy')->name('turnos.eliminar');
    Route::get('/buscar/filtro/documento', 'TurnoController@searchByDocumento')->name('turnos.search_documento');
    Route::get('/buscar/filtro/', 'TurnoController@searchByNumero')->name('turnos.search_numeros');
    Route::get('/confirmar/{data}', 'TurnoController@confirmarTurno')->name('turnos.confirmar');
    Route::post('/rechazar/{data}', 'TurnoController@rechazarTurno')->name('turnos.rechazar');
    Route::post('/generar/reporte/tramite/', 'TurnoController@generarReporte')->name('turnos.rechazar');
    Route::post('/reprogramar/seleccionado/{data}', 'TurnoController@reprogramarTurno')->name('turnos.reprogramar');
    Route::post('/reprogramar/obtener/horarios/dia', 'TurnoController@horariosDia')->name('turnos.horarios_reprogramacion');
    Route::post('/reprogramar/confirmar/seleccion/dia/{data}', 'TurnoController@confirmarReprogramacion')->name('turnos.confirmar_reprogramacion');
});