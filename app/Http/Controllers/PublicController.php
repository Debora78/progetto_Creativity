<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Routing\Controllers\HasMiddleware;

//Implementiamo Public Controller con l'interfaccia HasMiddleware per impedire la visualizzazione della pagina careers senza autenticazione escludendo la pagina di homepage

class PublicController extends Controller implements HasMiddleware
{
   public static function middleware()
   {
      return [new Middleware('auth', except: ['homepage'])];
   }
   //con questa funzione facciamo una query al DB, prima ordiniamo gli articoli in ordine decrescente di creazione, poi di questi ne prendiamo 4 e li passiamo alla view. Per rendere disponibili questi articoli alla vista, utilizziamo la funzione compact
   public function homepage()
   {
      $articles = Article::orderBy('created_at', 'desc')->take(4)->get();
      return view('welcome', compact('articles'));
   }

   //con questa funzione ritorniamo la vista careers
   public function careers()
   {
      return view('careers');
   }

   //con questa funzione prenderà i dati dalla request e li validiamo
   public function careersSubmit(Request $request)
   {
      $request->validate([
         'role' => 'required',
         'email' => 'required|email',
         'message' => 'required'


      ]);
   }
}
