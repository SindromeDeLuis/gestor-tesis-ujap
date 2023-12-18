<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- User Authenticated-->
    <meta name="user" content="{{ Auth::user() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="{{ mix('js/app.js') }}"></script>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/home') }}">
                    <img src="{{ asset('images/ujap_logo.jpg') }}" alt="logo" width="60" height="60">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse fs-5" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        @auth
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('/home') }}">
                                    {{ 'Inicio' }}
                                </a>
                            </li>
                            @if (Auth::user()->role === 'Administrador')
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ url('/usuarios') }}">
                                        {{ 'Lista de usuarios' }}
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ url('/calendario') }}" class="nav-link">
                                        {{ 'Cronograma' }}
                                    </a>
                                </li>
                            @elseif (Auth::user()->role === 'Director')
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ url('/revisionDirector') }}">
                                        {{ 'Tesis por aprobar' }}
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ url('/calendario') }}" class="nav-link">
                                        {{ 'Cronograma' }}
                                    </a>
                                </li>
                            @elseif (Auth::user()->role === 'Docente')
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ url('/revisionTutor') }}">
                                        {{ 'Tutor' }}
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ url('/revisionJurado') }}">
                                        {{ 'Jurado' }}
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ url('/calendario') }}" class="nav-link">
                                        {{ 'Cronograma' }}
                                    </a>
                                </li>
                            @elseif (Auth::user()->role === 'Estudiante')
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ url('/registroTomo') }}">
                                        {{ 'Registrar tomo' }}
                                    </a>
                                </li>
                            @endif
                        @endauth
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Iniciar sesión') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Registro') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('profile') }}">
                                        {{ __('Perfil') }}
                                    </a>

                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                                        {{ __('Cerrar sesión') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        <main class="py-4">
            @yield('content')
        </main>
    </div>  
    <script src="{{ mix('js/app.js') }}"></script>
</body>
</html>
