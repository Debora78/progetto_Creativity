<x-layout>
    {{-- Inizio sezione titolo --}}
<section class="container-fluid p-5 bg-secondary-subtle text-center">
    <div class="row justify-content-center">
        <div class="col-12">
            <h1 class="display-1">Modifica l' articolo</h1>
        </div>
    </div>
</section>
{{-- fine sezione titolo --}}

{{-- Inizio sezione form --}}
<section class="container my-5">
    <div class="row justify-content-center">
        <div class="col-12 col-md-8">
            <form action="{{route('article.update', $article)}}" method="POST" class="card p-5 shadow" enctype="multipart/form-data">
                @csrf
                @method('PUT')
            <div class="mb-">
                <label for="title" class="form-label">Titolo</label>
                <input type="text" name="title" class="form-control" id="title" value="{{$article->title}}">
                @error('title')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
            <div class="mb-">
                <label for="subtitle" class="form-label">Sottotitolo</label>
                <input type="text" name="subtitle" class="form-control" id="subtitle" value="{{$article->subtitle}}">
                @error('subtitle')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
            <div class="mb-3">
                <label>Immagine Attuale</label>
                <img src="{{Storage::url($article->image)}}" alt="{{$article->title}}" class="w-50 d-flex">
            </div>
            <div class="mb-">
                <label for="image" class="form-label">Nuova immagine</label>
                <input type="file" name="image" class="form-control" id="image">
                @error('image')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
            {{-- Con la select nel caso in cui ci fosse una categoria collegata all'articolo, la visualizzeremo già selezionata --}}
            <div class="mb-">
                <label for="category" class="form-label">Categoria</label>
                <select name="category" id="category" class="form-control">
                    <option selected disabled>Seleziona Categoria</option>
                    @foreach ($categories as $category) 
                    <option value="{{$category->id}}" @if ($article->category->id == $category->id) selected @endif>{{$category->name}}
                        </option>
                        
                    @endforeach
                </select>
                @error('category')
                    <span class="text-danger">{{$message}}</span>
                    
                @enderror
            </div>
            {{-- Nell'input dedicato ai tags, recuperiamo la collezione dei tags legata all'articolo e poi utilizziamo la funzione implode() per trasformare tutti gli elementi che ci interessano (ovvero il name del tag) in una stringa --}}
            <div class="mb-"></div>
                <label for="tags" class="form-label">Tags</label>
                <input type="text" name="tags" class="form-control" id="tags" value="{{$article->tags->implode('name', ', ' )}}">
                <span class="small text-muted fst-italic">Divivi ogni tag con una virgola</span></span>
                @error('tags')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
            <div class="mb-">
                <label for="body" class="form-label">Corpo del testo</label>
                <textarea name="body" class="form-control" id="body" cols="30" rows="7">{{$article->body}}</textarea>
                @error('body')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
            <div class="mt-3 d-flex justify-content-center flex-column align-items-center">
                <button type="submit" class="btn btn-outline-secondary">Modifica Articolo</button>
                <a href="{{route('homepage')}}" class="text-secondary -mt-2">Torna alla home</a>
            </div>
            </form>
        </div>
    </div>
</section>
{{-- fine sezione form --}}
                    

            





            
            </form>











</x-layout>