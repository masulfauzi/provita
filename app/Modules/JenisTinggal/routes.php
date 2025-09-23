<?php

use Illuminate\Support\Facades\Route;
use App\Modules\JenisTinggal\Controllers\JenisTinggalController;

Route::controller(JenisTinggalController::class)->middleware(['web','auth'])->name('jenistinggal.')->group(function(){
	Route::get('/jenistinggal', 'index')->name('index');
	Route::get('/jenistinggal/data', 'data')->name('data.index');
	Route::get('/jenistinggal/create', 'create')->name('create');
	Route::post('/jenistinggal', 'store')->name('store');
	Route::get('/jenistinggal/{jenistinggal}', 'show')->name('show');
	Route::get('/jenistinggal/{jenistinggal}/edit', 'edit')->name('edit');
	Route::patch('/jenistinggal/{jenistinggal}', 'update')->name('update');
	Route::get('/jenistinggal/{jenistinggal}/delete', 'destroy')->name('destroy');
});