<?php

namespace App\Models;

use App\Models\User;
use App\Models\Category;
use Illuminate\Support\Str;
use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Article extends Model
{
    //Searchble è un trait che ci dà accesso a una funzione che restituirà un array con la specifica di quali campi vogliamo indicizzare e quali sono i valori
    use HasFactory, Searchable;

    protected $fillable = ['title', 'subtitle', 'body', 'image', 'user_id', 'category_id', 'is_accepted', 'slug'];

    //funzione che mette in relazione gli articoli ad un solo utente
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    //Relazione tra una categoria e molti articoli
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function toSearchableArray()
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'subtitle' => $this->subtitle,
            'body' => $this->body,
            'category' => $this->category, //con this->category richiamo la funzione di relazione con Category e NON IL NOME DI UNA COLONNA
        ];
    }
    //Relazione tra un articolo e molti tag
    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
    //!La funzione getRouteKeyName() deve necessariamente chiamarsi così
    public function getRouteKeyName()
    {
        return 'slug';
    }

    //!La funzione readDuration() calcola la durata di lettura di un articolo (in minuti)
    public function readDuration()
    {
        //La funzione Str::wordCount conta il numero di parole all'interno del corpo del nostro articolo
        $totalWords =Str::wordCount($this->body);
        //La funzione round() arrotonda per eccesso i minuti che ci vogliono per leggere il testo( la media di una persona scolarizzata è di 200 parole al minuto), ci restituirà un tipo di dato float
        $minutesToRead = round($totalWords / 200);
        //La funzione intval() restituisce il valore intero di una data variabile
        return intval($minutesToRead);
    }
}
