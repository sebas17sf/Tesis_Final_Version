<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <!-- Agrega el enlace al archivo CSS de Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Agrega el enlace a los íconos de Google Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/fontawesome.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.js"></script>
<link rel="stylesheet" href="css/coordinador/coordinador.css">
<link rel="stylesheet" href="css/admin/admin.css">
    <script src="js/menu.js"></script>
    @vite(['resources/scss/app.scss', 'resources/js/app.js'])
</head>

<body>
    <header>
        <div class="sidebar">
            <div class="logo-container">
            <img src="/plantillas/favicon.jpg" alt="Logo ESPE" class="logo-image">
            </div>
            <div class="sidebar-links">
            <a href="{{ route('coordinador.index') }}">
                <i class="material-icons">assignment</i> Proyectos
            </a>
            <a href="{{ route('coordinador.proyectosEstudiantes') }}">
                <i class="material-icons">assignment_ind</i> Proyectos-Estudiantes
            </a>
            <a href="{{ route('coordinador.estudiantesAprobados') }}">
                <i class="material-icons">people</i> Estudiantes
            </a>

           
            <div class="dropdown">
                <a href="#" class="nav-link dropdown-toggle" id="practicasDropdown" role="button" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    <i class="material-icons">business</i> Prácticas
                </a>
                <div class="dropdown-menu" aria-labelledby="practicasDropdown">
                    <a class="dropdown-item" href="{{ route('coordinador.agregarEmpresa') }}"><i
                            class="material-icons">add_business</i> Agregar-Empresa</a>
                    <a class="dropdown-item" href="{{ route('coordinador.aceptarFaseI') }}"><i
                            class="material-icons">check_circle</i> Aprobar-Fase I</a>
                </div>
            </div>
    </div>


            <a href="{{ route('logout') }}" class="logout-btn">
                <i class="material-icons">exit_to_app</i> Cerrar Sesión
            </a>
        </div>

    </header>
    
    <div class="config-links">
        <a class="navbar-brand config-link">
            <i class="material-icons">person</i> {{ Auth::user()->Nombre }} {{ Auth::user()->Apellido }}
        </a>
    </div>

    <div class="content">
        <main class="container py-4">
            @yield('content')
        </main>
    </div>

    <footer class="footer">
        <div class="container">
            <span>© 202 Universidad de las Fuerzas Armadas ESPE - Todos los derechos reservados</span>
        </div>
    </footer>


    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
