<?php

use Illuminate\Support\Facades\Route;
use App\Modules\JenisRekening\Controllers\JenisRekeningController;

Route::controller(JenisRekeningController::class)->middleware(['web','auth'])->name('jenisrekening.')->group(function(){
	Route::get('/jenisrekening', 'index')->name('index');
	Route::get('/jenisrekening/data', 'data')->name('data.index');
	Route::get('/jenisrekening/create', 'create')->name('create');
	Route::post('/jenisrekening', 'store')->name('store');
	Route::get('/jenisrekening/{jenisrekening}', 'show')->name('show');
	Route::get('/jenisrekening/{jenisrekening}/edit', 'edit')->name('edit');
	Route::patch('/jenisrekening/{jenisrekening}', 'update')->name('update');
	Route::get('/jenisrekening/{jenisrekening}/delete', 'destroy')->name('destroy');
});