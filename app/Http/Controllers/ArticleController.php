<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Routing\Controllers\HasMiddleware;

class ArticleController extends Controller implements HasMiddleware //implementiamo l'interfaccia HasMiddleware(le interfacce sono utilizzate per definire le regole di validazione e le classi figlie sono obbligate ad usare quelle regole)
{
    //!Inserito metodo statico middleware che ritorna un array di middleware, nel nostro caso inseriamo il middleware di autenticazione ('Auth') a tutti i metodi nel controlle ad eccezione dell'index (visualizzazione di tutti gli articoli) e del show (pagina di dettaglio di un singolo articolo) -- index e show sono visibili anche agli utenti ospiti
    public static function middleware(){
        return [new Middleware('auth', except: ['index', 'show'])];
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    //La funzione create() ha il compito di ritornare la vista che conterrà il form di creazione dell'articolo. 
    public function create()
    {
        return view('article.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //Validazioni per ogni campo
        //In questo modo, gestiamo le regole di validazione per i nostri articoli e come l'articolo deve essere salvato nel DB prendendo i dati dalla request
       $request->validate([
        'title' => 'required|unique:articles|min:5',
        'subtitle' => 'required|min:5',
        'body' => 'required|min:10',
        'image' => 'required|image',
        'category' => 'required'
       ]);

       $article = Article::create([
        'title' => $request->title,
        'subtitle' => $request->subtitle,
        'body' => $request->body,
        //le img vengono salvate nello store nella cartella images
        'image' => $request->file('image')->store('images', 'public'),
        'category_id' => $request->category,
        'user_id' => Auth::user()->id
       ]);
       //Re-indirizziamo l'utente alla homepage, dandogli un feedback visivo con un messaggio di successo
       return redirect('homepage')->with('message', 'Articolo creato con successo');
    }

    /**
     * Display the specified resource.
     */
    public function show(Article $article)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Article $article)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Article $article)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article)
    {
        //
    }
}
