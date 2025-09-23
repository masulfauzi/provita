<?php

use Illuminate\Support\Facades\Route;
use App\Modules\SekolahAsal\Controllers\SekolahAsalController;

Route::controller(SekolahAsalController::class)->middleware(['web','auth'])->name('sekolahasal.')->group(function(){
	Route::get('/sekolahasal', 'index')->name('index');
	Route::get('/sekolahasal/data', 'data')->name('data.index');
	Route::get('/sekolahasal/create', 'create')->name('create');
	Route::post('/sekolahasal', 'store')->name('store');
	Route::get('/sekolahasal/{sekolahasal}', 'show')->name('show');
	Route::get('/sekolahasal/{sekolahasal}/edit', 'edit')->name('edit');
	Route::patch('/sekolahasal/{sekolahasal}', 'update')->name('update');
	Route::get('/sekolahasal/{sekolahasal}/delete', 'destroy')->name('destroy');
});