<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <!-- Agrega el enlace al archivo CSS de Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="css/director/director.css">
    @vite(['resources/scss/app.scss', 'resources/js/app.js'])
    <style>
        body {
            overflow-x: hidden;
        }
    </style>
</head>
<body>
<header>
    <!-- Barra de navegación en el lado izquierdo -->
    <div class="sidebar">
    <div class="logo-container">
    <img src="/plantillas/favicon.jpg" alt="Logo ESPE" class="logo-image">
    </div>
    <div class="sidebar-links">

        <a href="{{ route('director.indexProyectos') }}">
            <i class="material-icons">library_books</i> Proyectos
        </a>
        <a href="{{ route('director.estudiantesAprobados') }}">
            <i class="material-icons">people</i> Estudiantes
        </a>
        <a href="{{ route('director.practicas') }}">
            <i class="material-icons">business</i> Prácticas
        </a>

        <a href="{{ route('logout') }}" class="logout-btn">
            <i class="material-icons">exit_to_app</i> Cerrar Sesión
            </a>
    </div>
    </div>
</header>

<!-- Contenido principal -->
<div class="content">
    <main class="container py-4">
        <!-- Contenido específico de la página -->
        @yield('content')
    </main>
</div>

<footer class="footer">
        <div class="container">
            <span>© 202 Universidad de las Fuerzas Armadas ESPE - Todos los derechos reservados</span>
        </div>
    </footer>

<!-- Agrega los scripts de Bootstrap al final del cuerpo del documento -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
