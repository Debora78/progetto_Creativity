<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use App\Mail\CareerRequestMail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
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

      //!Accediamo ai dati dell'utente loggato che fa la richiesta, poi prendiamo le info che inserisce nel form tramite la request e tramite il metodo compact() le compattiamo in un'unica variabile. Poi, inviamo la mail con le info che ci ha inviato l'utente all'indirizzo di un amministratore della piattaforma.
      //In base al ruolo selezionato dall'utente , tramite uno switch() settiamo a NULL la colonna corrispondente nella tab users.  Poi aggiorniamo il record dell'utente e lo rimandiamo alla homepage con un messaggio di successo

      $user = Auth::user();
      $role = $request->role;
      $email = $user->email;
      $message = $request->message;
      $info = compact('role', 'email', 'message');

      Mail::to('admin@admin.it')->send(new CareerRequestMail($info));

      switch ($role) {
         case 'admin':
            $user->is_admin = NULL;
            break;
         case 'revisor':
            $user->is_revisor = NULL;
            break;
         case 'writer':
            $user->is_writer = NULL;
            break;
      }

      $user->update();
      
      return redirect(route('homepage'))->with('message', 'Mail inviata con successo');
         
   }
   
}  

