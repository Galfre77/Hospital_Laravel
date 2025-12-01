<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Hospital</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/hospital.css') }}">
</head>
<body>
<div class="container">
	<header>
		<h1 id="title">HOSPITAL</h1>
	</header>
    <div class='flex'>
        <nav class="navbar bg-body-secondary">
            <h3>Menu opciones:</h3>
            <br>
            <a class="navbar-brand" href="{{ route('consulta.pacientes') }}">Consulta pacientes</a>
            @auth
            <a class="navbar-brand" href="{{ route('alta.paciente') }}">Alta paciente</a>

            <a class="navbar-brand" href="{{ route('consulta.usuarios') }}">Consulta usuarios</a>
            @endauth
            <hr>
            @guest

                <a class="navbar-brand" href="{{ route('login')}}">Login usuario</a>
                <a class="navbar-brand" href="{{ route('registro.usuarios')}}">Registro usuarios</a>

            @endguest
            @auth
                <!-- Si el usuario está autenticado, se muestra el formulario de logout -->
                <form method="POST" action="{{ route('logout.usuario') }}" class="d-inline">
                    @csrf
                    <!-- Enlace que al hacer clic, previene el comportamiento por defecto y envía el formulario -->
                    <a class="navbar-brand" href="#" onclick="event.preventDefault(); this.closest('form').submit();">
                        Logout
                    </a>
                </form>
            @endauth

            @auth
                <!-- Si el usuario está autenticado, se muestra su nombre completo -->
                <p>{{ Auth::user()->nombre }} {{ Auth::user()->apellidos }}</p>

                <!-- Se muestra la imagen del usuario desde la carpeta de assets -->
                <img class="fotousuario" src="{{ asset('assets/img')}}/{{ Auth::user()->foto }}">
            @endauth

        </nav>

        <section id='contenido'>
            <div>
                @yield('contenido')
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif
            </div>
        </section>
    </div>
</div>
</body>
</html>
