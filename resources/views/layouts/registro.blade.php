<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <!-- Add Bootstrap CSS link -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="../css/admin/admin.css">
    <link rel="stylesheet" href="../css/estudiante/estudiante.css">
    @vite(['resources/scss/app.scss', 'resources/js/app.js'])

</head>
<style>
        body {
            overflow-x: hidden;
        }
    </style>
    <script src="../js/menu.js"></script>
<body>
    <!-- Barra de navegación en el lado izquierdo -->
    <section class="content-sidebar " _ngcontent-ng-c4160891441>

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
                            <a href="#">
                            <div class="icon-sidebar-item">
                                        <i class="material-icons">check_circle</i>
                                        </div>
                                        <div class="name-sidebar-item">
                                        <li>Registro Estudiantes</li>
                                        </div>
                            </a>
                    </nav>
                </div>
            </div>
            <div class="content-autors">
                <span class="autors1">
                    <i>Designed by Sebastian Flores & Karen Cueva.</i>

                </span>
            </div>
    </section>
    <!-- SIDEBAR -->
    <section class="content-navbar dimension-nav">
        <!-- Toggle sidebar -->
        <div class="icon-menu-sidebar" onclick="triggerToggleSidebar()">
            <i class='bx bx-menu-alt-left'
                [ngClass]="{'bx-menu': sidebarHidden,'bx-menu-alt-left': !sidebarHidden}"></i>
        </div>
        <!-- contenido -->
        <main class="navbar">
            <button class="profile-icon dropdown" id="profile-button">

                <div class="name-profile">
                    <span><?php echo Auth::user()->NombreUsuario; ?></span>
                </div>
                <div class="icon-profile">
                    <img src="../img/default/user.svg">
                </div>

            </button>
            <!-- Aquí agregamos el contenedor del menú desplegable -->
            <div class="popup-menu-profile">
                <div class="container">
                    <a href="#" class="change_module">
                        <i class="fa-regular fa-rectangle-vertical-history"></i>
                        <span>Cambiar modulo</span>
                    </a>
                    <a class="logout" href="{{ route('logout') }}">
    <i class="fa-sharp fa-regular fa-arrow-up-left-from-circle fontawesome"></i>
    <span>Cerrar sesión</span>
</a>

                </div>
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
            <!-- Contenido específico de la página -->
            @yield('content')
        </div>
        {{--   <button id="btn_top" ><i class='bx bxs-chevrons-up'></i></button> --}}

    </section>
    <!-- Scripts de jQuery y Popper.js -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <!-- Script de Bootstrap 4.5.2 -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- Script de Bootstrap 5.3.0 -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('js/plantilla/styles.js') }}" type="module"></script>
    <script src="{{ asset('js/plantilla/vendor.js') }}" type="module"></script>
    <script src="{{ asset('js/plantilla/main.js') }}" type="module"></script>
    <script src="{{ asset('js/admin/general.js') }}"></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
<!-- Box Icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
    integrity="sha384-gL5q2wHNwpg9voDwmz1onh73oSJ8lFvZEydTHpw4M4okQ7N8qI+v5h0zitOykKdp" crossorigin="anonymous">
<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</body>

</html>
