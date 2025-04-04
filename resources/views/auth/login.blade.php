<x-layout>
    {{-- sezione titolo form --}}
    <section class="container-fluid p-5 bg-seccondary-subtle text-center">
        <div class="row justify-content-center">
            <div class="col-12">
                <h1 class="display-1">Accedi</h1>
            </div>
        </div>
    </section>
    {{-- fine sezione titolo form --}}

    {{-- inizio sezione form --}}
    <section class="container my-5">
        <div class="row justify-content-center">
            <div class="col-12 col-md-8">
                <form action="{{ route('login') }}"method="POST" class="card p-5 shadow">

                    @csrf

                    <div class="mb-3">
                        <label for="email" class="form-label">Email </label>
                        <input type="email" class="form-control" id="email" name="email"
                            value="{{ old('email')}}">
                        @error('email')
                            {{-- in caso di errore stampa il messaggio di errore --}}
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password">
                        @error('password')
                            {{-- in caso di errore stampa il messaggio di errore --}}
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3 d-flex justify-content-center flex-column align-items-center">
                        <button type="submit" class="btn btn-outline-secondary">Accedi</button>
                        <p class="mt-2">Non sei registrato? <a href="{{ route('register') }}"
                                class="text-secondary">Clicca qui</a></p>
                    </div>

                </form>

            </div>
        </div>
    </section>
    {{-- fine sezione form --}}
</x-layout>
