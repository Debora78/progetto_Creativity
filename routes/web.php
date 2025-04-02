<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\PublicController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PublicController::class, 'homepage'])->name('homepage');

//Raggruppo le rotte che hanno lo stesso controller
Route::controller(ArticleController::class)->group(function () {
    Route::get('/article/create', 'create')->name('article.create');

    //!Rotta di tipo get per visualizzare tutti gli annunci inseriti
    Route::get('/article/index', 'index')->name('article.index');

    //!Questa Rotta gestisce i dati dell'utente e li salva nel DB
    Route::post('/article/store', 'store')->name('article.store');

    //!Rotta di tipo get parametrica che accetta un parametro cioè l'articolo che l'utente vuole visualizzare
    Route::get('/article/show/{article}', 'show')->name('article.show');

    //!Rotta di tipo get parametrica che accetta un parametro cioè l'articolo che l'utente vuole visualizzare nella sua ricerca
    Route::get('/article/category/{category}', 'byCategory')->name('article.byCategory');

    //!Rotta di tipo get parametrica che accetta un parametro cioè il nome di chi ha creato gli articoli
    Route::get('/article/user/{user}', 'byUser')->name('article.byUser');

});

// Route::get('/article/create', [ArticleController::class, 'create'])->name('article.create');

 //Rotta di tipo get per visualizzare tutti gli annunci inseriti
// Route::get('/article/index', [ArticleController::class, 'index'])->name('article.index');

 //Questa Rotta gestisce i dati dell'utente e li salva nel DB
// Route::post('/article/store', [ArticleController::class, 'store'])->name('article.store');




