<?php

namespace App\Models;

use App\Models\User;
use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Scout\Searchable;

class Article extends Model
{
    //Searchble è un trait che ci dà accesso a una funzione che restituirà un array con la specifica di quali campi vogliamo indicizzare e quali sono i valori
    use HasFactory, Searchable;

    protected $fillable = ['title', 'subtitle', 'body', 'image', 'user_id', 'category_id', 'is_accepted'];

    //funzione che mette in relazione gli articoli ad un solo utente
    public function user(){
        return $this->belongsTo(User::class);
        
    }
    //Relazione tra una categoria e molti articoli
    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function toSearchableArray(){
        return [
            'id'=>$this->id,
            'title'=>$this->title,
            'subtitle'=>$this->subtitle,
            'body'=>$this->body,
            'category'=>$this->category, //con this->category richiamo la funzione di relazione con Category e NON IL NOME DI UNA COLONNA
        ];
    } 
}
