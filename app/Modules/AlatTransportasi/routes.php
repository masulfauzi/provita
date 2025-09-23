<?php

use Illuminate\Support\Facades\Route;
use App\Modules\AlatTransportasi\Controllers\AlatTransportasiController;

Route::controller(AlatTransportasiController::class)->middleware(['web','auth'])->name('alattransportasi.')->group(function(){
	Route::get('/alattransportasi', 'index')->name('index');
	Route::get('/alattransportasi/data', 'data')->name('data.index');
	Route::get('/alattransportasi/create', 'create')->name('create');
	Route::post('/alattransportasi', 'store')->name('store');
	Route::get('/alattransportasi/{alattransportasi}', 'show')->name('show');
	Route::get('/alattransportasi/{alattransportasi}/edit', 'edit')->name('edit');
	Route::patch('/alattransportasi/{alattransportasi}', 'update')->name('update');
	Route::get('/alattransportasi/{alattransportasi}/delete', 'destroy')->name('destroy');
});