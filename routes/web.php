<?php

use Illuminate\Support\Facades\Route;

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('index');
Route::get('/locations', [App\Http\Controllers\HomeController::class, 'locations'])->name('locations');
Route::post('/search', [App\Http\Controllers\HomeController::class, 'search'])->name('search');
