<x-layout>

    {{-- ! I 3 componenti sono 3 tabelle diverse che mostrano i dati in base alle richieste. Avendo la necessità di passare dati complessi a questi componenti usiamo la sintassi (:roleRequests) che consente al componente di accettare un dato più strutturato come un array o un oggetto. Abbiamo creato un componente singolo riutilizzabile a cui passiamo dati dinamici --}}
    {{-- Inizio sezione titolo --}}
<section class="container-fluid p-5 bg-secondary-subtle text-center">
    <div class="row justify-content-center">
        <div class="col-12">
            <h1 class="display-1">Bentornato Revisore {{Auth::user()->name}}</h1>
        </div>
    </div>
</section>
@if (session('message'))
    <div class="alert alert-success">
        {{ session('message') }}
    </div>
    
@endif

{{-- Fine sezione titolo --}}

{{-- Inizio sezione  Articoli da revisionare --}}
<section class="container my-5">
    <div class="row justify-content-center">
        <div class="col-12">
            <h2>Articoli da revisionare</h2>
            {{-- ! Richiamo il componente tabella --}}
            <x-articles-table :articles="$unrevisionedArticles" />
        </div>
    </div>
</section>
{{-- Fine sezione  Articoli da revisionare --}}

{{-- Inizio sezione  Articoli Accettati --}}
<section class="container my-5">
    <div class="row justify-content-center">
        <div class="col-12">
            <h2>Articoli pubblicati</h2>
            {{-- ! Richiamo il componente tabella --}}
            <x-articles-table :articles="$acceptedArticles" />
        </div>
    </div>
</section>
{{-- Fine sezione  Articoli accettati --}}

{{-- Inizio sezione  Articoli rifiutati--}}
<section class="container my-5">
    <div class="row justify-content-center">
        <div class="col-12">
            <h2>Articoli respinti</h2>
            {{-- ! Richiamo il componente tabella --}}
            <x-articles-table :articles="$rejectedArticles" />
        </div>
    </div>
</section>
{{-- Fine sezione  Articoli rifiutati --}}


</x-layout>