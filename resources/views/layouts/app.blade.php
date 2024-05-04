<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <!-- Add Bootstrap CSS link -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Add Google Icons link -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="css/admin/admin.css">
    <script src="js/menu.js"></script>

    @vite(['resources/scss/app.scss', 'resources/js/app.js'])
</head>

<body>
    <!-- Barra de navegación en el lado izquierdo -->
    <section class="content-sidebar" [ngClass]="{'content-sidebar-hidden': sidebarHidden}">

        <div class="content scroll-small">
            <div class="sidebar">
                <a class="logo_site">
                    <div class="img_logo">
                        <img src="\img\logos\logo_tesis.png" alt="logo">
                    </div>
                    <div class="title-text">
                        <p>Gestion Academica</p>
                    </div>
                </a>
                <div class="links_site">
                    <nav class="nav">
                        <ul class="nav-list">
                            <a href="{{ route('estudiantes.index') }}"
                                class="{{ Request::is('estudiantes/index') ? 'active' : '' }}">
                                <i class="material-icons">assignment</i> Informacion
                            </a>

                            <a href="{{ route('estudiantes.documentos') }}"
                                class="{{ Request::is('estudiantes/documentos') ? 'active' : '' }}">
                                <i class="material-icons">people_alt</i> Vinculación con la Sociedad
                            </a>

                            <a href="{{ route('estudiantes.practica1') }}"
                                class="{{ Request::is('estudiantes/practica1') ? 'active' : '' }}">
                                <i class="material-icons">work</i> Prácticas pre profesionales
                            </a>

                        </ul>
                    </nav>
                </div>
            </div>
            <div class="content-autors">
                <span class="autors1">
                    <i>Designed by Sebastian Flores & Karen Cueva.</i>

                </span>
            </div>
        </div>
        </div>
    </section>
    <!-- SIDEBAR -->
    <section class="content-navbar dimension-nav" [ngClass]="{'dimension-nav-hidden': sidebarHidden}">
        <!-- Toggle sidebar -->
        <div class="icon-menu-sidebar" (click)="triggerToggleSidebar()">
            <i class='bx bx-menu-alt-left'
                [ngClass]="{'bx-menu': sidebarHidden,'bx-menu-alt-left': !sidebarHidden}"></i>
        </div>
        <!-- contenido -->
        <main class="navbar">
            <button class="profile-icon dropdown" id="profile-button">
                <div class="icon-profile">
                    <i class="material-icons">person</i>
                </div>
                <div class="name-profile">
                    <span><?php echo Auth::user()->NombreUsuario; ?></span>
                </div>

            </button>

            <!-- Aquí agregamos el contenedor del menú desplegable -->
            <div class="popup-menu-profile">
                <div class="container">
                    <a class="logout" href="{{ route('logout') }}">
                        <i class="material-icons">exit_to_app</i>
                        <span>Cerrar sesión</span>
                    </a>
                </div>
        </main>
    </section>
    <button id="btn_top" *ngIf="showScrollButton" (click)="scrollToTop()"><i class='bx bxs-chevrons-up'></i></button>
    <!-- CONTENEDOR -->
    <section class="content-views dimension-content" [ngClass]="{'dimension-content-hidden': sidebarHidden}">
        <!-- Title component -->
        <div class="title-component">
            <h1>@yield('title_component')</h1>
            <div class="divisor-title"></div>
        </div>
        <!-- Contenido principal -->

    <div class="views">
        @yield('content')
    </div>
</section>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="{{ asset('js/practica1/general.js') }}"></script>

</body>

</html>