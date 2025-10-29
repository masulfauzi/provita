<?php

use Illuminate\Support\Facades\Route;
use App\Modules\Akun\Controllers\AkunController;

Route::controller(AkunController::class)->middleware(['web','auth'])->name('akun.')->group(function(){
	Route::get('/akun', 'index')->name('index');
	Route::get('/akun/data', 'data')->name('data.index');
	Route::get('/akun/create', 'create')->name('create');
	Route::post('/akun', 'store')->name('store');
	Route::get('/akun/{akun}', 'show')->name('show');
	Route::get('/akun/{akun}/edit', 'edit')->name('edit');
	Route::patch('/akun/{akun}', 'update')->name('update');
	Route::get('/akun/{akun}/delete', 'destroy')->name('destroy');
});