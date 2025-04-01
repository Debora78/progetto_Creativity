<?php

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
        //Creo i campi che formano la tablella ed anche le colonne che relazionano ogni articolo con un utente ed una categoria, entrambe queste colonne sono delle Foreign Keys
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('subtitle');
            $table->longText('body');
            $table->string('image');
            $table->unsignedBigInteger('user_id')->nullable();
            //Con onDelete('SET NULL) specifichiamo che in caso l'utente venisse cancellata, questo campo assume valore di NULL
            $table->foreign('user_id')->references('id')->on('users')->onDelete('SET NULL');
            $table->unsignedBigInteger('category_id')->nullable();
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('SET NULL');
            //Con onDelete('SET NULL) specifichiamo che in caso la categoria venisse cancellata, questo campo assume valore di NULL
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};
