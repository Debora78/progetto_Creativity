<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class PublicController extends Controller
{
   //con questa funzione facciamo una query al DB, prima ordiniamo gli articoli in ordine decrescente di creazione, poi di questi ne prendiamo 4 e li passiamo alla view. Per rendere disponibili questi articoli alla vista, utilizziamo la funzione compact
      public function homepage() {
      $articles = Article::orderBy('created_at', 'desc')->take(4)->get();
    return view('welcome', compact('articles'));
   }
}
