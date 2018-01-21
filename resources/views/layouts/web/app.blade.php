<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'MuniHuite') }}</title>

    <!-- Styles -->
    
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/fontawesome-all.css') }}" rel="stylesheet">
    <link href="{{ asset('css/mhcss.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-inverse bluebg navbar-static-top">
            <div class="container">
                <div class="navbar-header">
                    <div class="navbar-collapse collapse">
                        <ul class="nav navbar-nav navbar-right">
                            <!-- Branding Image -->
                            <a class="navbar-brand" href="{{ url('/') }}">
                                {{ config('', 'MuniHuite') }}
                            </a>
                            <li><a href="#home-sec">Inicio</a></li>
                            <li><a href="#features-sec">Tu Muni</a></li>
                            <li><a href="#advance-sec">Informacion Publica</a></li>
                            <li><a href="#gallery-sec">Solicitud de Informacion</a></li>
                            <li><a href="#location-sec">Tramite y Servicios</a></li>
                        </ul>
                    </div>
                    
                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse" aria-expanded="false">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    

                
                </div>
               
                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        
                    
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @guest
                            <li><a href="{{ route('login') }}">Login</a></li>
                            
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
                                <i class="fas fa-user-circle fa-lg"></i>
                                    {{ Auth::user()->username }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>
                                        <a href="{{ url('/home') }}">
                                            Dashboard
                                        </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                            @endguest
                    </ul>
                </div>
            </div>
        </nav>
@yield('content')
</div>

    <!-- Scripts -->
    <script src="{{ asset('js/script.js')}}"></script>
    <script src="{{ asset('js/app.js') }}"></script>

    <script src="{{ asset('assets/jquery/jquery-1.12.4.min.js') }}"></script>
    
    <script src="{{ asset('assets/dataTables/js/jquery.dataTables.min.js') }}"></script>

    <script src="{{ asset('assets/validator/validator.min.js') }}"></script>
    
    
   
</body>
</html>
