<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="\img\logos\logo_tesis.png" alt="logo">

    <title>@yield('title')</title>
    <!-- Agrega el enlace al archivo CSS de Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Agrega el enlace a los íconos de Google Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/fontawesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.js"></script>

    <link rel="stylesheet" href="css/admin/admin.css">
    <script src="js/menu.js"></script>
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
                            <a class="p-element active-section" href="{{ route('coordinador.index') }}"
                                data-bs-toggle="tooltip" data-bs-placement="right" data-bs-custom-class="custom-tooltip"
                                data-bs-title="Proyectos">
                                <div class="icon-sidebar-item">
                                    <i class="material-icons">assignment</i>
                                </div>
                                <div class="name-sidebar-item">
                                    <li>Proyectos</li>
                                </div>
                                <a href="{{ route('coordinador.proyectosEstudiantes') }}" class="p-element"
                                    data-bs-toggle="tooltip" data-bs-placement="right"
                                    data-bs-custom-class="custom-tooltip" data-bs-title="Proyectos-Estudiantes">
                                    <div class="icon-sidebar-item">
                                        <i class="material-icons">assignment_ind</i>
                                    </div>
                                    <div class="name-sidebar-item">
                                        <li>Proyectos-Estudiantes</li>
                                    </div>
                                </a>
                                <a href="{{ route('coordinador.estudiantesAprobados') }}" class="p-element"
                                    data-bs-toggle="tooltip" data-bs-placement="right"
                                    data-bs-custom-class="custom-tooltip" data-bs-title="Estudiantes">
                                    <div class="icon-sidebar-item">
                                        <i class="material-icons">people</i>
                                    </div>
                                    <div class="name-sidebar-item">
                                        <li>Estudiantes</li>
                                    </div>
                                </a>
                                <div class="dropdown">
                                    <a href="#" class="nav-link dropdown-toggle" id="practicasDropdown" role="button"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <div class="icon-sidebar-item">
                                            <i class="material-icons">business</i>
                                        </div>
                                        <div class="name-sidebar-item">
                                            <li>Prácticas</li>
                                        </div>
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="practicasDropdown">
                                        <a class="dropdown-item" href="{{ route('coordinador.agregarEmpresa') }}">
                                            <div class="icon-sidebar-item">
                                                <i class="material-icons">add_business</i>
                                            </div>
                                            <div class="name-sidebar-item">
                                                <li>Agregar-Empresa</li>
                                            </div>
                                        </a>
                                        <a class="dropdown-item" href="{{ route('coordinador.aceptarFaseI') }}"
                                            style="margin-top: 10px;">
                                            <div class="icon-sidebar-item">
                                                <i class="material-icons">check_circle</i>
                                            </div>
                                            <div class="name-sidebar-item">
                                                <li> Aprobar-Fase I </li>
                                            </div>
                                        </a>
                                        </div>
                        
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
       <section class="content-navbar dimension-nav" _ngcontent-ng-c3252749989>
        <!-- Toggle sidebar -->
        <div class="icon-menu-sidebar" onclick="triggerToggleSidebar()">
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
            </div>
        </main>

    </section>
    <button id="btn_top" *ngIf="showScrollButton" (click)="scrollToTop()"><i
            class='bx bxs-chevrons-up'></i></button>
    <!-- CONTENEDOR -->
    <section class="content-views dimension-content" _ngcontent-ng-c3252749989>
        <!-- Title component -->
        <div class="title-component">
            <h1>@yield('title_component')</h1>
            <div class="divisor-title"></div>
        </div>
        <!-- Contenido principal -->
        <div class="views">
            <!-- Contenido específico de la página -->
            @yield('content')
        </div>
    </section>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    
     <script src="{{ asset('js/plantilla/styles.js') }}" defer></script>
    <script src="{{ asset('js/plantilla/vendor.js') }}" type="module"></script>
    <script src="{{ asset('js/plantilla/main.js') }}" type="module"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Box Icons -->
<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</body>

</html>