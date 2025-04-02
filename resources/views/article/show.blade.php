<x-layout>
    {{-- sezione titolo --}}
    <section class="container-fluid p-5 bg-secondary-subtle text-center">
        <div class="row justify-content-center">
            <div class="col-12">
                <h1 class="display-1">{{ $article->title }}</h1>

            </div>
        </div>
    </section>
    {{-- fine sezione titolo --}}


    <section class="container my-5">
        <div class="row justify-content-center">
            <div class="col-12 col-md-8 d-flex flex-column">
                <img src="{{ Storage::url($article->image) }}" class="img-fluid"
                    alt="Immagine dell'articolo: {{ $article->title }}">
                <div class="text-center">
                    <h2>{{ $article->subtitle }}</h2>
                    <p class="fs-5">Categoria:
                        <a href="{{ route('article.byCategory', $article->category) }}" class="text-capitalize text-muted fw-bold">{{ $article->category->name }}</a>
                    </p>
                    <div class="text-muted my-3">
                        <p>Redatto il: {{ $article->created_at->format('d/m/Y') }} da: {{ $article->user->name }}</p>

                    </div>
                </div>
                <br>
                <p>{{ $article->body }}</p>
                <div class="text-center">
                    <a href="{{ route('article.index') }}" class="Text-secondary">Vai alla lista deglia articoli</a>

                </div>



            </div>
        </div>
    </section>
</x-layout>
