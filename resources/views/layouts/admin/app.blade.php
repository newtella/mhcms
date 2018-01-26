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
    <link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.4/summernote.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/css/bootstrap-select.min.css">
    <link href="{{ asset('css/jquery.toast.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/mhcss.css') }}" rel="stylesheet">
    <!-- <link href="{{ asset('css/summernote.css') }}" rel="stylesheet"> -->
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-dark bluebg navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse" aria-expanded="false">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{ config('app.name', 'MuniHuite') }}
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        &nbsp;
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @guest
                            <li><a href="{{ route('login') }}">Login</a></li>
                            <li><a href="{{ route('register') }}">Register</a></li>
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

        <div class="container">
        <div class="row">
        <div class="col-md-3">
        <div class="panel panel-default">
            <div class=""></div>
            <img src="https://i.pinimg.com/736x/06/70/d0/0670d0a78996a2d944d5d9983d089190--munchkin-cat-baby-kitty.jpg" alt="..." class="img-circle center-block imgprofile">
            <p class="text-center">
                <a href="mailto:{{ Auth::user()->email}}" class="">Bienvenido, {{ Auth::user()->username}}</a>
            </p>
           
                <div class="toptitle well">
                    <div class="marginbottom list-group">
                        <h4 class="text-muted"><i class="fas fa-address-card"></i> Administraci&oacute;n</h4>
                    <a href="{{route('articles.index')}}" class="list-group-item"> <i class="fas fa-newspaper"></i> Articulos</a>
                    <a href="" class="list-group-item"> <i class="fas fa-comments"></i> Comentarios</a>
                    <a href="{{route('tags.index')}}" class="list-group-item"> <i class="fas fa-tags"></i> Etiquetas</a>
                    <a href="{{route('categories.index')}}" class="list-group-item"> <i class="fas fa-list"></i> Categorias</a>
                </div>
                <div class="list-group">
                <h4 class="toptitle2 text-muted"><i class="fas fa-cog fa-spin"></i> Configuraci&oacute;n</h4>
                    <a href="" class="list-group-item"> <i class="fas fa-users"></i> Usuarios</a>
                    <a href="" class="list-group-item"> <i class="fas fa-database"></i> Copia BD</a>
                    <a href="" class="list-group-item"> <i class="fas fa-sync-alt"></i> Restaurar BD</a>
                </div>
            </div>
            
        </div>
        
    </div>
    
    <div class="col-md-9">
    @yield('content')
    </div>
    
</div>        
</div>

</div>

    <!-- Scripts -->
    
    <script src="{{ asset('js/app.js') }}"></script>
    
    <script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.4/summernote.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/js/bootstrap-select.min.js"></script>
    <script src="{{ asset('js/sweetalert.min.js')}}"></script>
    <script src="{{ asset('js/jquery.toast.min.js')}}"></script>
    <script src="{{ asset('js/script.js')}}"></script>

    <!-- <script src="{{ asset('js/summernote.min.js') }}"></script> -->

    @yield('script')

    
    
   
</body>




</html>
