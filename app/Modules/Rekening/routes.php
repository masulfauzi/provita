<?php

use Illuminate\Support\Facades\Route;
use App\Modules\Rekening\Controllers\RekeningController;

Route::controller(RekeningController::class)->middleware(['web','auth'])->name('rekening.')->group(function(){
	Route::get('/rekening', 'index')->name('index');
	Route::get('/rekening/data', 'data')->name('data.index');
	Route::get('/rekening/create', 'create')->name('create');
	Route::post('/rekening', 'store')->name('store');
	Route::get('/rekening/{rekening}', 'show')->name('show');
	Route::get('/rekening/{rekening}/edit', 'edit')->name('edit');
	Route::patch('/rekening/{rekening}', 'update')->name('update');
	Route::get('/rekening/{rekening}/delete', 'destroy')->name('destroy');
});