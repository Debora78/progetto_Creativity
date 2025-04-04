<?php

use App\Models\Category;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name'); //creo una colonna di tipo stringa che conterrà il nome della categoria
            $table->timestamps();
        });
        //Array delle nostre categorie di default
        $categories = [
            'Gioielli', 'Accessori', 'Abbigliamento', 'Arredamento', 'Decorazioni', 'Giocattoli'
        ];
        //Tramite questo foreach inseriamo le categorie nel database
        foreach($categories as $category){
            Category::create([
                'name'=>$category
            ]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
