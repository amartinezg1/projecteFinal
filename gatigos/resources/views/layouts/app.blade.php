<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ __('Gat i Gos ') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>

    <!--DATEPICKER--><script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!--DATEPICKER--><link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>


    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">


</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
            <!--<div class="container ml-1">-->
                <a class="navbar-brand" href="{{ url('/') }}">
                    <h2>{{ __('Gat i Gos') }}</h2>
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                      @auth
                         <li class="nav-item">
                            <h5><a class="nav-link" href="/">{{ __('language.calendar') }}</a></h5>
                        </li>
                       <li class="nav-item">
                            <h5><a class="nav-link" href="/altas">{{ __('language.signUp') }}</a></h5>
                        </li>

                        <li class="nav-item">
                            <h5><a class="nav-link" href="/buscadorClientes">{{ __('language.searchEngine') }}</a></h5>
                        </li>
                        @if (Auth::user()->user_role=="vet")
                         <li class="nav-item">
                            <h5><a class="nav-link" href="/misCitas">{{ __('language.nextInquiry') }}</a></h5>
                        </li>

                        @endif
                        @if (Auth::user()->user_role=="admin")
                         <li class="nav-item">
                            <h5><a class="nav-link" href="/usuarios">{{ __('language.usersRole') }}</a></h5>
                        </li>

                        @endif
                      @endauth
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <h5><a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a></h5>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <h5><a class="nav-link" href="{{ route('register') }}">{{ __('language.register') }}</a></h5>
                                </li>
                            @endif
                        @else
                            <h5><li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                  <h5><a class="dropdown-item" href="/perfil">
                                      {{ __('language.profile') }}
                                  </a></h5>
                                    <h5><a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a></h5>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>

                                </div>
                            </li></h5>
                        @endguest
                        <li><a href="{{ url('lang', ['en'])}}" class="p-2">English</a></li>
                        <li><a href="{{ url('lang', ['es'])}}" class="p-2">Español</a></li>
                        <li><a href="{{ url('lang', ['cat'])}}" class="p-2">Català</a></li>
                    </ul>
                </div>
            <!--</div>-->
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
