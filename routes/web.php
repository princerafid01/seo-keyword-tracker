<?php

use Illuminate\Support\Facades\Route;

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('index');
Route::get('/locations', [App\Http\Controllers\HomeController::class, 'locations'])->name('locations');
Route::post('/search', [App\Http\Controllers\HomeController::class, 'search'])->name('search');

Route::get('rankings/list', [App\Http\Controllers\RankingKeywordController::class, 'getRankings'])->name('rankings.list');

Route::get('regenerate-ranking-keyword/{keyword_id}', [App\Http\Controllers\RankingKeywordController::class, 'regenerate_ranking_keyword'])->name('regenerate.ranking.keyword');
