<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>University of Peradeniya | People</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    @yield('clickablerow-script')
    @yield('addtitle-script')
    @yield('confirmmodal-script')
    @yield('datatable-script')
    @yield('tooltip-script')
    @yield('styles')
    @yield('loggerscripts')
    
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!-- favicon -->
    <link rel="icon" href="img/favicon.png">
    <!-- apple touch icon -->
    <link rel="apple-touch-icon" href="img/favicon.png">

    <script src="https://kit.fontawesome.com/1c62222909.js" crossorigin="anonymous"></script>

</head>
<body class="d-flex flex-column min-vh-100">
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm" style="background-image: linear-gradient(to right, #4e0000, #8b0008);">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="/img/logo.png" alt="" style="height:60px;">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest('administration')
                        @guest('student')
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="/" style="color: white;">Home</a>
                                </li>
                            
                                <li class="nav-item">
                                    <a class="nav-link" href="/catalogue" style="color: white;">People</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" href="/forum/form" style="color: white;">Forum</a>
                                </li>
                                
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}" style="color: white;">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }} " style="color: white;">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @endguest
                        @endguest
                        
                        @auth('administration')
                            <li class="nav-item">
                                <a class="nav-link" href="/" style="color: white;">Home</a>
                            </li>
                        
                            <li class="nav-item">
                                <a class="nav-link" href="/catalogue" style="color: white;">People</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="/forum/student" style="color: white;">Forum</a>
                            </li>

                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre style="color: white;">
                                    {{ Auth::guard('administration')->user()->username }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a href="/profile" class="dropdown-item">Dashboard</a>
                                    
                                    @yield('navbar')
                                    
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endauth

                        @auth('student')
                            <li class="nav-item">
                                <a class="nav-link" href="/" style="color: white;">Home</a>
                            </li>
                        
                            <li class="nav-item">
                                <a class="nav-link" href="/catalogue" style="color: white;">People</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="/forum/student" style="color: white;">Forum</a>
                            </li>

                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre style="color: white;">
                                    {{ Auth::guard('student')->user()->username }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a href="/profile" class="dropdown-item">Dashboard</a>
                                    
                                    @yield('navbar')
                                    
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endauth
                    </ul>
                </div>
            </div>
        </nav>

        @yield('welcome')

        <main class="py-4">
            @yield('content')
        </main>

    </div>
    @yield('charts')
    @yield('footer')
</body>
@yield('script')
</html>