<nav class="navbar navbar-expand-lg bg-body-tertiary" data-bs-theme="dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Navbar</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{ route('homepage') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{ route('article.index') }}">Tutti gli
                        Articoli</a>
                </li>

                {{-- Ciò che vedrà l'utente loggato cioè il suo nome e il form di logout --}}
                @auth

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Ciao {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu">
                            @if (Auth::user()->is_admin)
                            <li><a class="dropdown-item" href="{{route('admin.dashboard')}}">Dashboard Admin</a></li>
                            @endif
                            @if (Auth::user()->is_revisor)
                            <li><a class="dropdown-item" href="{{route('revisor.dashboard')}}">Dashboard Revisor</a></li>
                            @endif
                            @if (Auth::user()->is_writer)
                            <li><a class="dropdown-item" href="{{route('writer.dashboard')}}">Dashboard Writer</a></li>
                            @endif
                                
                            <li>
                                <a class="dropdown-item" href="#"
                                    onclick="event.preventDefault(); document.querySelector('#form-logout').submit();">Logout</a>
                            </li>
                            <form action="{{ route('logout') }}"method="POST" id="form-logout" class="d-none">
                                @csrf
                            </form>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('article.create') }}">Inserisci un Articolo</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{ route('careers') }}">Lavora con noi</a>
                    </li>

                @endauth

                {{-- Ciò che vedrà l'utente ospite cioè i tasti che portano alla pagina di login  e alla pagina di register --}}
                @guest

                    <li class="nav-item dropdown">
                        <a class="nav-link drop-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">Benvenuto Ospite</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('register') }}">Registrati</a></li>
                            <li><a class="dropdown-item" href="{{ route('login') }}">Accedi</a></li>
                        </ul>
                    </li>
                @endguest
            </ul>
            <form action="{{ route('article.search') }}" method="GET" class="d-flex" role="search">
                <input class="form-control me-2" type="search" name="query" placeholder="Cerca gli articoli" aria-label="Search">
                <button class="btn btn-outline-secondary" type="submit">Cerca</button>
            </form>
        </div>
    </div>
</nav>
