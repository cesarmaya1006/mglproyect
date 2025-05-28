<?php

use App\Http\Controllers\Extranet\ExtranetPageController;
use Illuminate\Support\Facades\Route;

//Route::get('/', function () {return view('welcome');});

Route::controller(ExtranetPageController::class)->group(function(){
    Route::get('/', 'index')->name('extranet.index');
    Route::get('registro', 'registro')->name('extranet.registro');
    Route::post('registrar', 'registrar')->name('extranet.registrar');
});

Route::middleware(['auth:sanctum',config('jetstream.auth_session'),'verified',])->group(function () {
    Route::get('/dashboard', function () {return view('dashboard');})->name('dashboard');
});
