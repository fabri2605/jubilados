<?php

use Illuminate\Support\Facades\Route;

Auth::routes();
Route::get('/', 'SitioController@sitio')->name('home');
Route::get('/landing', 'SitioController@landing')->name('landing');
Route::get('/home', 'HomeController@index')->name('menu');

Route::resource('users', 'UserController');
Route::resource('solicitudes', 'SolicitudController');

Route::group(['prefix' => 'sitio'], function () {
    Route::post('/validar/abono', 'SitioController@validarAbono')->name('sitio.abono');
    Route::post('/registrar', 'SitioController@registrar')->name('sitio.registrar');
});  

Route::group(['prefix' => 'solicitudes'], function () {
    Route::delete('/eliminar/{data}', 'SolicitudController@destroy')->name('solicitudes.eliminar');
    Route::post('/generar/reporte/', 'SolicitudController@reporte')->name('solicitudes.reporte');
});  

Route::group(['prefix' => 'enviados'], function () {
    Route::get('/', 'EnviadoController@index')->name('enviados.index');
    Route::post('importar/','EnviadoController@importar')->name('enviados.upload');
});  