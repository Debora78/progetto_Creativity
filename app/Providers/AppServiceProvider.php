<?php

namespace App\Providers;

use App\Models\Category;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Se nel database c'è una tabella categories, prendi tutte le categorie e condividile in tutte le viste
        if(Schema::hasTable('categories')){
            $categories = Category::all();
            View::share(['categories' => $categories]);
        }
    }
}
