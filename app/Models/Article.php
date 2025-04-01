<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'subtile', 'body', 'image', 'user_id', 'category_id'];

    //funzione che mette in relazione gli articoli ad un solo utente
    public function user(){
        return $this->belongsTo(User::class);
        
    }
    //Relazione tra una categoria e molti articoli
    public function category(){
        return $this->belongsTo(Category::class);
    }
}
