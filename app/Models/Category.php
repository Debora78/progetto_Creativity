<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    
    protected$fillable = ['name'];
//Relazione tra una categoria e tanti articoli
    public function articles(){
        return $this->hasMany(Article::class);
    }
}
