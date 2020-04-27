<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="{{ asset('icono/js/all.min.js')}}"></script>
    <script src="{{ asset('js/jquery-3.4.1.min.js')}}"></script>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css')}}" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('estilo/estilo.css')}}">

    <title>Document</title>
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark menu fixed-top">

            <a class="navbar-brand" href="{{ url('/') }}" >
                <i class="fas fa-paw" width="30" height="30" class="d-inline-block align-top"></i>
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav">
                    <li class="nav-item"><a href="{{ url('/index') }}" class="nav-link text-white">Inicio</a></li>
                    <li class="nav-item"><a href="{{ url('/adopciones') }}" class="nav-link text-white">Adopciones</a></li>
                    <li class="nav-item"><a href="{{ url('/donaciones') }}" class="nav-link text-white">Donaciones</a></li>
                    <li class="nav-item"><a href="{{ url('/actividades') }}" class="nav-link text-white">Actividades</a></li>
                    <li class="nav-item"><a href="{{ url('/refugios') }}" class="nav-link text-white">Refugios</a></li>
                </ul>
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item form-inline">
                        <a class="nav-link text-white" href="/">Iniciar sesión</a>
                        <a class="nav-link text-white" href="/">Registro</a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>

    <main>
        @yield('content')

    </main>

    <script src="{{ asset('js/popper.min.js')}}" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="{{ asset('js/bootstrap.min.js')}}" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>
