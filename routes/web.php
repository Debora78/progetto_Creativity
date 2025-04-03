<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\RevisorController;
use Illuminate\Support\Facades\Route;

//Raggruppo le rotte che hanno Public Controller
Route::controller(PublicController::class)->group(function () {
//!rotta che riporta alla homepage
    Route::get('/','homepage')->name('homepage'); 
//!rotta che riporta alla pagina careers per scegliere il ruolo per cui fare richiesta
    Route::get('/careers','careers')->name('careers');
//!Rotta che gestisce le informazioni inserite nel form
    Route::post('/careers/submit', 'careersSubmit')->name('careers.submit');    
    
});
// Route::get('/', [PublicController::class, 'homepage'])->name('homepage');

//Raggruppo le rotte che hanno Article Controller
Route::controller(ArticleController::class)->group(function () {
   
    //!Rotta di tipo get per visualizzare tutti gli annunci inseriti
    Route::get('/article/index', 'index')->name('article.index');

    //!Rotta di tipo get parametrica che accetta un parametro cioè l'articolo che l'utente vuole visualizzare
    Route::get('/article/show/{article}', 'show')->name('article.show');

    //!Rotta di tipo get parametrica che accetta un parametro cioè l'articolo che l'utente vuole visualizzare nella sua ricerca
    Route::get('/article/category/{category}', 'byCategory')->name('article.byCategory');

    //!Rotta di tipo get parametrica che accetta un parametro cioè il nome di chi ha creato gli articoli
    Route::get('/article/user/{user}', 'byUser')->name('article.byUser');

    //!Rotta di tipo get che gestisce i dati inseriti nella barra di ricerca
    Route::get('/article/search', 'articleSearch')->name('article.search');

});

   


// Route::get('/article/create', [ArticleController::class, 'create'])->name('article.create');

 //Rotta di tipo get per visualizzare tutti gli annunci inseriti
// Route::get('/article/index', [ArticleController::class, 'index'])->name('article.index');

 //Questa Rotta gestisce i dati dell'utente e li salva nel DB
// Route::post('/article/store', [ArticleController::class, 'store'])->name('article.store');

//!Gruppo di rotte che verrà automaticamente protetto dal middleware creato senza utilizzare la funzione statica middleware() nel controller. La rotta porterà l'adminalla sua dashboard personale.
Route::middleware('admin')->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    //!Rotta di tipo patch parametrica che gestisce le richieste per diventare amministratori
    Route::patch('/admin/{user}/set-admin', [AdminController::class, 'setAdmin'])->name('admin.setAdmin');
    //!Rotta di tipo patch parametrica che gestisce le richieste per diventare revisori
    Route::patch('/admin/{user}/set-revisor', [AdminController::class, 'setRevisor'])->name('admin.setRevisor');
    //!Rotta di tipo patch parametrica che gestisce le richieste per diventare redattori
    Route::patch('/admin/{user}/set-writer', [AdminController::class, 'setWriter'])->name('admin.setWriter');
});

//!Gruppo di rotte con middleware che verrà automaticamente protetto dal middleware creato senza utilizzare la funzione statica middleware() nel controller. La rotta porterà il revisore alla sua dashboard personale.
Route::middleware('revisor')->group(function () {
    Route::get('/revisor/dashboard', [RevisorController::class, 'dashboard'])->name('revisor.dashboard');
//!Rotta di tipo post che gestisce gli articoli accettati
    Route::post('/revisor/{article}/accept', [RevisorController::class, 'acceptArticle'])->name('revisor.acceptArticle');
//!Rotta di tipo post che gestisce gli articoli rifiutati
    Route::post('/revisor/{article}/reject', [RevisorController::class, 'rejectArticle'])->name('revisor.rejectArticle');
//!Rotta di tipo post che gestisce gli articoli da revisionare
    Route::post('/revisor/{article}/undo', [RevisorController::class, 'undoArticle'])->name('revisor.undoArticle');
});

Route::middleware('writer')->group(function () {
  //!Questa Rotta gestisce la creazione di un nuovo articolo  
    Route::get('/article/create',[ArticleController::class, 'create'] )->name('article.create');
 //!Questa Rotta gestisce i dati dell'utente e li salva nel DB
 Route::post('/article/store', [ArticleController::class, 'store'])->name('article.store');

});
