<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\User;
use App\Models\Article;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Routing\Controllers\HasMiddleware;

class ArticleController extends Controller implements HasMiddleware //implementiamo l'interfaccia HasMiddleware(le interfacce sono utilizzate per definire le regole di validazione e le classi figlie sono obbligate ad usare quelle regole)
{
    //!Inserito metodo statico middleware che ritorna un array di middleware, nel nostro caso inseriamo il middleware di autenticazione ('Auth') a tutti i metodi nel controlle ad eccezione dell'index (visualizzazione di tutti gli articoli) e del show (pagina di dettaglio di un singolo articolo) -- index e show sono visibili anche agli utenti ospiti
    public static function middleware(){
        return [new Middleware('auth', except: ['index', 'show', 'byCategory', 'byUser', 'articleSearch'])];
    }
    /**
     * Display a listing of the resource.
     */
    //!Questa funzione restituisce alla vista tutti gli articoli ordinati dal più recente
    public function index()
    {
        $articles = Article::where('is_accepted', true)->orderBy('created_at', 'desc')->get();
        return view('article.index', compact('articles'));
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
       //! Tramite la funzione explode()  abbiamo ottenuto da una stringa (l'input text 'tags')un array di elementi. Questa funzione accetta 2 parametri il primo è l'elemento divisore (in questo caso è la virgola) e il secondo è la stringa da dividere.
       $tags = explode(',', $request->tags);
       foreach($tags as $i => $tag){
           $tags[$i] = trim($tag);
       }

       foreach($tags as $tag){
        //! La funzione updateOnCreate() automaticamente fa un controllo nel DB: se il tag con quel nome non esiste, lo crea 
        $newTag = Tag::updateOrCreate([
        //! Con il metodo strlower() rendiamo la stringa tutta minuscola, in caso contrario fa un semplice update. In questo modo la tabella tags sarà pulita e senza ripetizioni
            'name' => strtolower($tag)
        ]);
        //! La funzione attach() crea effettivamente il record all'interno dalla tabella pivot e crea la relazione
        $article->tags()->attach($newTag);
       }
       //Re-indirizziamo l'utente alla homepage, dandogli un feedback visivo con un messaggio di successo
       return redirect(route('homepage'))->with('message', 'Articolo creato con successo');
    }

    /**
     * Display the specified resource.
     */
    //La funzione show() ha il compito di ritornare la vista che conterrà il dettaglio di un singolo articolo.
    public function show(Article $article)
    {
       return view('article.show', compact('article'));
    }
    //Funzione che permette di visualizzare gli articoli di una determinata categoria passata come parametro
    public function byCategory(Category $category){
        $articles = $category->articles()->where('is_accepted', true)->orderBy('created_at', 'desc')->get();
        return view('article.by-category', compact('category', 'articles'));
    }
    //Funzione che permette di visualizzare gli articoli in base ad un nome dell'utente che ha creato l'articolo
    public function byUser(User $user){
        $articles = $user->articles()->where('is_accepted', true)->orderBy('created_at', 'desc')->get();
        return view('article.by-user', compact( 'user', 'articles'));
       
    }   

    //Con questa funzione diciamo al DB di recuperare tutti quegli articoli che hanno nel loro contenuto la parola cercata dall'utente tramite un input con nome query, prendendo però solo quelli effettivamente pubblcati e ordinati dal più recente
    public function articleSearch(Request $request){
        $query = $request->input('query');
        $articles = Article::search($query)->where('is_accepted', true)->orderBy('created_at', 'desc')->get();
        return view('article.search-index', compact('articles', 'query'));

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
