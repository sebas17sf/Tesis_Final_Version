<!DOCTYPE html>
<html lang="en" class="hydrated">

<head>
    <meta charset="UTF-8">
    <link rel="icon" type="image/x-icon" href="\img\logos\logo_tesis.png" alt="logo">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/admin/admin.css') }}">

    @vite(['resources/scss/app.scss', 'resources/js/app.js'])

    <style>
        .contenedor_alerta {
            display: flex;
            align-items: center;
            justify-content: space-between;
            background-color: #dff0d8;
            border: 1px solid #d6e9c6;
            color: #3c763d;
            padding: 15px;
            margin: 15px;
            border-radius: 4px;
            box-shadow: 0 1px 1px rgba(0, 0, 0, 0.05);
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 1000;
            max-width: 300px;
            width: auto;
        }

        .contenedor_alerta .icon_alert {
            margin-right: 10px;
            font-size: 24px;
        }

        .contenedor_alerta .content_alert {
            flex: 1;
        }

        .contenedor_alerta .title {
            font-weight: bold;
            margin-bottom: 5px;
        }

        .contenedor_alerta .icon_remove button {
            background: none;
            border: none;
            color: #3c763d;
            font-size: 24px;
            cursor: pointer;
        }

        .contenedor_alerta .icon_remove button:hover {
            color: #2b542c;
        }

        .contenedor_alerta .body {
            word-wrap: break-word;
        }
    </style>


</head>




<body>

    <script>
        window.routes = {
            keepAlive: '{{ route('keep-alive') }}',
            logout: '{{ route('logout') }}'
        };
    </script>

    <?php
    $user = auth()->user()->profesorUniversidad ?? null;
    $currentRoute = \Route::currentRouteName();

    if ($user && $user->actualizacion == 0 && $currentRoute !== 'participante-vinculacion.cambio-credenciales') {
        echo "<script>
                Swal.fire({
                    icon: 'warning',
                    title: 'Primera sesión',
                    text: 'Es obligatorio que realice el cambio de clave.',
                    confirmButtonText: 'Aceptar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = '" .
            route('participante-vinculacion.cambio-credenciales') .
            "';
                    }
                });
            </script>";
        exit();
    }
    ?>


    <section class="content-sidebar content-sidebar-hidden">
        <div class="content scroll-small">
            <div class="sidebar">
                <a class="logo_site">
                    <div class="img_logo">
                        <img src="\img\logos\logo_tesis.png" alt="logo">
                    </div>
                    <div class="title-text">
                        <p>VINCULACIÓN Y PRÁCTICAS</p>
                    </div>
                </a>
                <div class="links_site">
                    <nav class="nav">
                        <ul class="nav-list">
                            <a class="p-element" href="{{ route('admin.index') }}">
                                <div class="icon-sidebar-item">
                                    <i class="fa-solid fa-grid"></i>
                                </div>
                                <div class="name-sidebar-item">
                                    <li>Panel Administrativo</li>
                                </div>
                            </a>
                            <a href="{{ route('admin.indexProyectos') }}" class="p-element">
                                <div class="icon-sidebar-item">
                                    <i class="fa-solid fa-layer-plus"></i>
                                </div>
                                <div class="name-sidebar-item">
                                    <li>Proyectos</li>
                                </div>
                            </a>

                            <a href="{{ route('admin.estudiantes') }}" class="p-element">
                                <div class="icon-sidebar-item">
                                    <i class="fa-solid fa-users fontawesome"></i>
                                </div>
                                <div class="name-sidebar-item">
                                    <li>Estudiantes</li>
                                </div>
                            </a>

                            <!-- Menu Prácticas -->
                            <a class="p-element submenu" id="practicasMenu">
                                <div class="icon-sidebar-item">
                                    <i class="fa-solid fa-building"></i>
                                </div>
                                <div class="name-sidebar-item">
                                    <li>Prácticas</li>
                                </div>
                                <div class="icon-sidebar-item-list color_a">
                                    <i class="fa-regular fa-angle-down"></i>
                                </div>
                            </a>

                            <!-- Sublista -->
                            <div class="item-list sublista">
                                <a class="p-element mb-1 subitem" href="{{ route('admin.agregarEmpresa') }}">
                                    <div class="icon-sidebar-item">
                                        <i class="fa-solid fa-grid-2-plus"></i>
                                    </div>
                                    <div class="name-sidebar-item">
                                        <li>Agregar Empresa</li>
                                    </div>
                                </a>
                                <a class="p-element subitem" href="{{ route('admin.aceptarFaseI') }}">
                                    <div class="icon-sidebar-item">
                                        <i class="fa-solid fa-circle-check"></i>
                                    </div>
                                    <div class="name-sidebar-item">
                                        <li>Aprobar Prácticas</li>
                                    </div>
                                </a>
                            </div>
                        </ul>
                    </nav>
                </div>
                <div class="content-autors">
                    <span class="autors1">
                        <i>Designed by </i>
                        <b><a>Sebastian Flores</a></b>
                        <i> & </i>
                        <b><a>Karen Cueva</a></b>.
                    </span>
                </div>
            </div>
        </div>
    </section>

    <!-- SIDEBAR -->
    <section class="content-navbar dimension-nav dimension-nav-hidden">
        <!-- Toggle sidebar -->
        <div class="icon-menu-sidebar" onclick="triggerToggleSidebar()">
            <i class='menu-icono bx bx-menu'></i>
        </div>

        <div class="nameDirector">
            <label class="labell">Usuario</label>
            <span>Administrador</span>
        </div>
        </div>
        <!-- contenido -->
        <main class="navbar">
            <button class="profile-icon dropdown" id="profile-button">

                <div class="name-profile">
                    <span><?php echo Auth::user()->nombreUsuario; ?></span>
                    <span>Sistema</span>
                </div>
                <div class="icon-profile">
                    <img src="/img/default/user.svg">
                </div>
            </button>
            <!-- Aquí agregamos el contenedor del menú desplegable -->
            <div class="popup-menu-profile">
                <div class="container">
                    <a href="{{ route('conectarModulos') }}" class="change_module">
                        <i class="fa-regular fa-rectangle-vertical-history"></i>
                        <span>Cambiar modulo</span>
                    </a>

                    <a href="{{ route('participante-vinculacion.cambio-credenciales') }}"
                        class="change_password active-section p-element">
                        <i class="fa-regular fa-user"></i>
                        <span>Credenciales</span>
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
    <section class="content-views dimension-content dimension-content-hidden">
        <!-- Title component -->
        <div class="title-component">
            <span class="title-content">@yield('title_component')</span>
            <div class="divisor-title"></div>
        </div>
        <!-- Contenido principal -->
        <div class="views views-active">
            <!-- Contenido específico de la página -->
            @yield('content')

        </div>
    </section>

    <!-- Scripts de jQuery y Popper.js -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <!-- Script de Bootstrap 4.5.2 -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- Script de Bootstrap 5.3.0 -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/ui/1.13.0/jquery-ui.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="{{ asset('js/admin/general.js') }}"></script>
    <script src="{{ asset('js/admin/empresa.js') }}"></script>
    <script src="{{ asset('js/input_file.js') }}"></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script src="{{ asset('js/menu.js') }}"></script>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('js/sesiones.js') }}"></script>

    <script>
        function toggleSidebar() {
            var menuState = localStorage.getItem('menuState') === 'expanded' ? 'collapsed' : 'expanded';

            // Enviar una solicitud AJAX al controlador para actualizar el estado del menú
            $.ajax({
                url: '{{ route('toggle-menu') }}', // Ruta que apunta al controlador MenuController
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    menuState: menuState
                },
                success: function(response) {
                    /*    console.log('Estado del menú enviado:',menuState);
                    console.log('Estado del menú actualizado:', response.menuState); */
                    // Actualizar el estado del menú en el localStorage si es necesario
                    //localStorage.setItem('menuState', response.menuState);
                },
                error: function(xhr, status, error) {
                    /*    console.error('Error al actualizar el estado del menú:', error); */
                }
            });

            triggerToggleSidebar();
        }
    </script>


    <script>
        @if (session('token'))
            localStorage.setItem('token', '{{ session('token') }}');
        @endif

        $(document).ready(function() {
            $('#practicasMenu').click(function() {
                $('#practicasSubmenu').slideToggle('fast');
                // Alternar el ícono
                var icon = $(this).find('.icon-sidebar-item-list i');
                icon.toggleClass('fa-angle-down fa-angle-up');
            });
        });
    </script>

    <style>
        .color_a {
            color: #1d1d1d
        }
    </style>


</body>

</html>
