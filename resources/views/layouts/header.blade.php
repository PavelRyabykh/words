<header>
    <div class="collapse bg-dark" id="navbarHeader">
        <div class="container">
            <div class="row">
                <div class="col-sm-8 col-md-7 py-4">
                </div>
                <div class="col-sm-4 offset-md-1 py-4">
                </div>
            </div>
        </div>
    </div>
    <div class="navbar navbar-dark bg-dark shadow-sm">
        <div class="container d-flex justify-content-between">
            <a href="/" class="navbar-brand d-flex align-items-center">
                <svg class="bi bi-card-text mr-2" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M14.5 3h-13a.5.5 0 00-.5.5v9a.5.5 0 00.5.5h13a.5.5 0 00.5-.5v-9a.5.5 0 00-.5-.5zm-13-1A1.5 1.5 0 000 3.5v9A1.5 1.5 0 001.5 14h13a1.5 1.5 0 001.5-1.5v-9A1.5 1.5 0 0014.5 2h-13z" clip-rule="evenodd"/>
                    <path fill-rule="evenodd" d="M3 5.5a.5.5 0 01.5-.5h9a.5.5 0 010 1h-9a.5.5 0 01-.5-.5zM3 8a.5.5 0 01.5-.5h9a.5.5 0 010 1h-9A.5.5 0 013 8zm0 2.5a.5.5 0 01.5-.5h6a.5.5 0 010 1h-6a.5.5 0 01-.5-.5z" clip-rule="evenodd"/>
                </svg>
                <strong>Words</strong>
            </a>
            @guest
                <div class="wrap">
                    <a class="btn btn-dark" href="{{ route('login') }}">Вход</a>
                    @if (Route::has('register'))
                        <a class="btn btn-dark" href="{{ route('register') }}">Регистрация</a>
                    @endif
                </div>
            @else
                <form method="POST" action="/logout">
                    @csrf
                    <input type="submit" class="btn btn-dark" value="Выйти">
                </form>
            @endguest
        </div>
    </div>
</header>
