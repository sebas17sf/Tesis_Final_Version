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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.js"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="{{ asset('css/admin/admin.css') }}">

    @vite(['resources/scss/app.scss', 'resources/js/app.js'])

    <style>
        body {
            overflow-x: hidden;
        }
    </style>

    @if (session('show_alert'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                let timeout;
                let countdown;
                let timeLeft = 5 * 60; // 5 minutos en segundos

                window.onload = resetTimer;
                document.onmousemove = resetTimer;
                document.onkeypress = resetTimer;

                function showSessionAlert() {
                    Swal.fire({
                        title: 'Tu sesión está a punto de expirar',
                        html: "¿Deseas mantener la sesión activa? <br> <span id='countdown'></span>",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#7066e0',
                        cancelButtonColor: '#808080',
                        confirmButtonText: 'Mantener sesión',
                        cancelButtonText: 'Salir',
                        allowOutsideClick: false,
                        onOpen: () => {
                            countdown = setInterval(function() {
                                document.getElementById('countdown').innerHTML =
                                    `${Math.floor(timeLeft / 60)} minutos y ${timeLeft % 60} segundos restantes`;
                                timeLeft--;
                            }, 1000);
                        },
                        onClose: () => {
                            clearInterval(countdown);
                        }
                    }).then((result) => {
                        if (result.isConfirmed) {
                            fetch('{{ route('keep-alive') }}', {
                                    method: 'POST',
                                    headers: {
                                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                        'Content-Type': 'application/json'
                                    }
                                })
                                .then(response => response.json())
                                .then(data => {
                                    if (data.success) {
                                        Swal.fire({
                                            title: 'Sesión extendida',
                                            text: 'Tu sesión se ha extendido exitosamente.',
                                            icon: 'success',
                                            allowOutsideClick: false
                                        });
                                    } else {
                                        Swal.fire({
                                            title: 'Error',
                                            text: 'No se pudo extender la sesión.',
                                            icon: 'error',
                                            allowOutsideClick: false
                                        });
                                    }
                                });
                        } else {
                            window.location.href = '{{ route('logout') }}';
                        }
                    });
                }

                function resetTimer() {
                    // Limpiar el temporizador existente
                    clearTimeout(timeout);

                    // Restablecer el tiempo restante
                    timeLeft = 5 * 60;

                    // Establecer un nuevo temporizador
                    timeout = setTimeout(showSessionAlert, 5 * 60 * 1000); // 5 minutos
                }

                resetTimer();
            });
        </script>
    @endif
</head>

<body>
    <!-- Barra de navegación en el lado izquierdo -->
    <section class="content-sidebar {{ session('menuState') == 'collapsed' ? 'content-sidebar-hidden' : '' }}"
        _ngcontent-ng-c4160891441>

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
                            <a class="p-element" href="{{ route('director_vinculacion.index') }}">
                                <div class="icon-sidebar-item">
                                    <i class="material-icons">assignment</i>
                                </div>
                                <div class="name-sidebar-item">
                                    <li>Proyectos</li>
                                </div>
                            </a>
                            <a href="{{ route('director_vinculacion.estudiantes') }}" class="p-element">
                                <div class="icon-sidebar-item">
                                    <i class="material-icons">spellcheck</i>
                                </div>
                                <div class="name-sidebar-item">
                                    <li>Calificar Estudiantes</li>
                                </div>
                            </a>

                            <a href="{{ route('director.repartoEstudiantes') }}" class="p-element">
                                <div class="icon-sidebar-item">
                                    <i class="material-icons">supervisor_account</i>
                                </div>
                                <div class="name-sidebar-item">
                                    <li>Estudiantes</li>
                                </div>
                            </a>

                            <a href="{{ route('director.baremo') }}" class="p-element">
                                <div class="icon-sidebar-item">
                                    <i class="fa-solid fa-file-chart-column"></i>
                                </div>
                                <div class="name-sidebar-item">
                                    <li>Baremo</li>
                                </div>
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
    <section
        class="content-navbar dimension-nav {{ session('menuState') == 'collapsed' ? 'dimension-nav-hidden' : '' }}">
        <!-- Toggle sidebar -->
        <div class="icon-menu-sidebar" onclick="toggleSidebar()">
            <i
                class='{{ session('menuState') == 'collapsed' ? 'bx bx-menu-alt-left menu-icono' : 'bx bx-menu menu-icono' }}'></i>
        </div>
        <div class="nameDirector">
            <label class="labell">Usuario</label>
            <span style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                @if (Auth::user()->role->tipo == 'DirectorVinculacion')
                    Director de proyecto
                @else
                    {{ Str::limit(Auth::user()->role->tipo, 30) }}
                @endif
            </span>
        </div>
        </div>
        <!-- contenido -->
        <main class="navbar">
            <button class="profile-icon dropdown" id="profile-button">

                <div style="display: flex; align-items: center;">
                    <span>
                        {{ explode(' ', Auth::user()->profesorUniversidad->nombres)[0] }}
                        {{ explode(' ', Auth::user()->profesorUniversidad->apellidos)[0] }}
                    </span>
                    <div class="icon-profile" style="margin-left: 20px;">
                        <img src="../img/default/user.svg">
                    </div>
                </div>
            </button>
            <!-- Aquí agregamos el contenedor del menú desplegable -->
            <div class="popup-menu-profile">
                <div class="container">
                    <a href="{{ route('conectarModulos', ['token' => session('token')]) }}" class="change_module">
                        <i class="fa-regular fa-rectangle-vertical-history"></i>
                        <span>Cambiar modulo</span>
                    </a>

                    <a href="{{ route('director_vinculacion.cambio-credenciales') }}" class="change_password">
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
    <section
        class="content-views dimension-content {{ session('menuState') == 'collapsed' ? 'dimension-content-hidden' : '' }}">
        <!-- Title component -->
        <div class="title-component">
            <span class="title-content">@yield('title_component')</span>
            <div class="divisor-title"></div>
        </div>
        <!-- Contenido principal -->
        <div class="views {{ session('menuState') == 'collapsed' ? 'views-active' : '' }}">
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
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

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
                    console.log('Estado del menú actualizado:', response.menuState);
                    // Actualizar el estado del menú en el localStorage si es necesario
                    localStorage.setItem('menuState', response.menuState);
                },
                error: function(xhr, status, error) {
                    console.error('Error al actualizar el estado del menú:', error);
                }
            });


            triggerToggleSidebar();

        }
    </script>
    <script>
        var token = "{{ session('token') }}";
        if (token) {
            localStorage.setItem('token', token);
        }
    </script>

    <script src="{{ asset('js/menu.js') }}"></script>

    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</body>

</html>
