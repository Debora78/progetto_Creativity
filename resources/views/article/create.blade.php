<x-layout>
    {{-- sezione titolo form --}}
    <section class="container-fluid p-5 bg-seccondary-subtle text-center">
        <div class="row justify-content-center">
            <div class="col-12">
                <h1 class="display-1">Inserisci un articolo</h1>
            </div>
        </div>
    </section>
    {{-- fine sezione titolo form --}}
    
    {{--  sezione  form --}}
    <section class="container my-5 ">
        <div class="row justify-content-center">
            <div class="col-12 col-md-8">
                <form class="card p-5 shadow" enctype="multipart/form-data" action="{{ route('article.store') }}" method="POST"> {{----- enctype="multipart/form-data" per caricare immagini ( o altro tipo di file)--}}
                    @csrf
                    <div class="mb-3">
                      <label for="title" class="form-label">Titolo</label>
                      <input type="text" class="form-control" id="title" value="{{old('title')}}" name="title">
                      @error('title')
                          {{-- in caso di errore stampa il messaggio di errore --}}
                          <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                          
                    <div class="mb-3">
                      <label for="subtitle" class="form-label">Sottotitolo</label>
                      <input type="text" class="form-control" id="subtitle" value="{{old('subtitle')}}" name="subtitle">
                      @error('subtitle')
                          {{-- in caso di errore stampa il messaggio di errore --}}
                          <span class="text-danger">{{$message}}</span>
                          @enderror
                        </div>
                          
                    <div class="mb-3 ">
                        <label for="image" class="form-label">Immagine</label>
                        <input type="file" class="form-control" id="image" name="image">
                        @error('image')
                            {{-- in caso di errore stampa il messaggio di errore --}}
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                    </div>

                    <div class="mb-3 ">
                        <label for="category" class="form-label">Categoria</label>
                        <select name="category" id="category" class="form-control">
                            <option selected disabled>Seleziona una categoria</option>
                            @foreach ($categories as $category) 
                            <option value="{{$category->id}}">{{$category->name}}</option>
                            @endforeach
                        </select>
                                
                        @error('category')
                            {{-- in caso di errore stampa il messaggio di errore --}}
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                    </div>

                    <div class="mb-3 ">
                        <label for="body" class="form-label">Corpo del testo</label>
                        <textarea name="body" id="body" cols="30" rows="7" class="form-control"></textarea>
                        @error('body')
                            {{-- in caso di errore stampa il messaggio di errore --}}
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                    </div>

                    <div class="mb-3">
                        <label for="tags" class="form-label">Tags</label>
                        <input type="text" class="form-control" id="tags" value="{{old('tags')}}" name="tags">
                        <span class="small text-muted fst-italic">Separa i tag con una virgola</span>
                        @error('tags')
                            {{-- in caso di errore stampa il messaggio di errore --}}
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>

                    <div class="mt-3 d-flex justify-content-center flex-column align-items-center">
                    <button type="submit" class="btn btn-outline-secondary">Inserisci Articolo</button>
                    <a href="{{route('homepage')}}" class="text-secondary -mt-2">Torna alla home</a>
                    </div>
                </form>
            </div>
        </div>
    </section>
    {{--  sezione fine form --}}
    
    
</x-layout>
    