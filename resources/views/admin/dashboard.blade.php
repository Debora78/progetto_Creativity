<x-layout>

    {{-- ! I 3 componenti sono 3 tabelle diverse che mostrano i dati in base alle richieste. Avendo la necessità di passare dati complessi a questi componenti usiamo la sintassi (:roleRequests) che consente al componente di accettare un dato più strutturato come un array o un oggetto. Abbiamo creato un componente singolo riutilizzabile a cui passiamo dati dinamici --}}
    {{-- Inizio sezione titolo --}}
    <section class="container-fluid p-5 bg-secondary-subtle text-center">
        <div class="row justify-content-center">
            <div class="col-12">
                <h1 class="display-1">Bentornato Amministratore {{ Auth::user()->name }}</h1>
            </div>
        </div>
    </section>
    @if (session('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif
    {{-- Fine sezione titolo --}}

    {{-- Inizio sezione  richieste di ruolo Amministratore --}}
    <section class="container my-5">
        <div class="row justify-content-center">
            <div class="col-12">
                <h2>Richieste di ruolo di Amministratore</h2>
                {{-- ! Richiamo il componente tabella --}}
                <x-requests-table :roleRequests="$adminRequests" role="amministratore" />
            </div>
        </div>
    </section>
    {{-- Fine sezione  richieste di ruolo di Amministratore --}}

    {{-- Inizio sezione  richieste di ruolo Revisore --}}
    <section class="container my-5">
        <div class="row justify-content-center">
            <div class="col-12">
                <h2>Richieste di ruolo di Revisore</h2>
                {{-- ! Richiamo il componente tabella --}}
                <x-requests-table :roleRequests="$revisorRequests" role="revisore" />
            </div>
        </div>
    </section>
    {{-- Fine sezione  richieste di ruolo di Revisore --}}

    {{-- Inizio sezione  richieste di ruolo Redattore --}}
    <section class="container my-5">
        <div class="row justify-content-center">
            <div class="col-12">
                <h2>Richieste di ruolo di Redattore</h2>
                {{-- ! Richiamo il componente tabella --}}
                <x-requests-table :roleRequests="$writerRequests" role="redattore" />
            </div>
        </div>
    </section>
    {{-- Fine sezione  richieste di ruolo di Redattore --}}

    <hr>
    {{-- Inizio sezione  tutti i tags --}}
    <section class="container my-5">
        <div class="row justify-content-center">
            <div class="col-12">
                <h2>Tutti i tags</h2>
                <x-metainfo-table :metaInfos="$tags" metaType="tags" />
            </div>
        </div>
    </section>
    {{-- Fine sezione  tutti i tags --}}

    <section class="container my-5">
        <div class="row justify-content-center">
            <div class="col-12 ">
                <div class="d-flex justify-content-between">
                    <h2>Tutte le categorie</h2>
                    <form action="{{ route('admin.storeCategory') }}" method="POST" class="w-50 d-flex m-3">
                        @csrf
                        <input type="text" name="name" placeholder="Inserisci una nuova categoria"
                            class="form-control me-2">
                        <button type="submit" class="btn btn-secondary">Inserisci</button>
                    </form>
                </div>
                <x-metainfo-table :metaInfos="$categories" metaType="categorie" />
            </div>
        </div>
    </section>


</x-layout>
