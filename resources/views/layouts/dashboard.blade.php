<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>
    <div class="container">
        {{-- <nav class="navbar navbar-expand-md navbar-dark bg-light d-flex py-0 px-3 justify-content-between">
            <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="#">
                <img id="_logo" src="{{ asset('images/logoboolbnb.png') }}" alt="">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <ul class="navbar-nav px-3 ml-auto">
                <li class="nav-item">
                    <a class="nav-link text-black" href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                                     document.getElementById('logout-form').submit();">
                        Logout
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
            </ul>
        </nav> --}}

        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid p-0">
                <a class="navbar-brand" href="{{ route('admin.home') }}">
                    <img src="{{ asset('images/logoboolbnb.png') }}" alt="" style="width:150px">
                    <!-- boolbnb -->
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-end text-center" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link text-black _primary_color" href="{{ route('admin.home') }}">
                                <i class="fas fa-home"></i>
                                Homepage
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-black" href="{{ route('admin.apartments.index') }}">
                                <i class="fas fa-building"></i>
                                Your Apartments
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-black" href="{{ route('admin.apartments.create') }}">
                                <i class="far fa-building"></i>
                                Create new Apartment
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-black" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                                <i class="fas fa-power-off"></i>
                                Logout
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                style="display: none;">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <div class="container-fluid">
            <div class="d-flex">
                <main role="main" style="width: 100%">
                    @yield('content')
                </main>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/back.js') }}"></script>

</body>

</html>
