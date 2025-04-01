<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\PublicController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PublicController::class, 'homepage'])->name('homepage');

Route::get('/article/create', [ArticleController::class, 'create'])->name('article.create');

//Questa Rotta gestisce i dati dell'utente e li salva nel DB
Route::post('/article/store', [ArticleController::class, 'store'])->name('article.store');
