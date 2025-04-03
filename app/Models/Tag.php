<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = ['name'];

//Relazione tra un tag e molti articoli
    public function articles()
    {
        return $this->belongsToMany(Article::class);
    }
}
