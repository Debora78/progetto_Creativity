<x-layout>
    {{-- sezione titolo --}}
    <section class="container-fluid p-5 bg-secondary-subtle text-center">
        <div class="row justify-content-center">
            <div class="col-12">
                <h1 class=" main-title">Welcome to Creativity</h1>
                @if (session('message'))
                    <div class="alert alert-success">
                        {{ session('message') }}
                @endif
                @if (session('alert'))
                    <div class="alert alert-danger">
                        {{ session('alert') }}
                    </div>
                @endif
            </div>
    </section>
    {{-- fine sezione titolo --}}
    {{-- sezione header --}}
    {{-- .header-with-curtain è il contenitore del sipario --}}
    <header class="header-with-curtain">
        {{-- .curtain.curtain-left e .curtain.curtain-right: Questi due div simuleranno le metà del sipario. --}}
        <div class="curtain curtain-left"></div>
        <div class="curtain curtain-right"></div>
        {{-- .header-background: Questo div conterrà l'immagine di sfondo ed eventuali altri contenuti dell'header. --}}
        <div class="header-background">
          
        </div>
      </header>
    {{-- fine sezione header --}}

    {{-- inizio sezione  cards --}}
    <section class="container my-5">
        <div class="row justify-content-evenly">
            @foreach ($articles as $article)
                <div class="col-12 col-md-3">
                    {{-- Richiamo il componente card passando i dati dinamici di ogni articolo. Per farlo utilizziamo il BINDING ESPLICITO ( legame esplicito ) mettendo i : (due punti) davanti agli attributi HTML. Questo aiuta Laravel a capire che sto passando come dato una variabile e non una stringa statica--}}
                    <x-article-card :article="$article" />
                </div>
            @endforeach

        </div>

    </section>
    {{-- fine sezione  cards --}}

</x-layout>
