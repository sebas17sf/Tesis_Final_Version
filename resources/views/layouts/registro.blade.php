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
    {{--  <link rel="stylesheet" href="../css/admin/admin.css"> --}}

    <link rel="stylesheet" href="{{ asset('css/admin/admin.css') }}">
    <link rel="stylesheet" href="{{ asset('css/estudiante/estudiante.css') }}">

    {{--   <link rel="stylesheet" href="../css/estudiante/estudiante.css"> --}}
    @vite(['resources/scss/app.scss', 'resources/js/app.js'])
    <style>
        body {
            overflow-x: hidden;
        }
    </style>
    {{--  <script src="../js/menu.js"></script> --}}
    {{--  <script src="{{ asset('js/menu.js') }}"></script> --}}
</head>
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
                            document.getElementById('countdown').innerText =
                                `${Math.floor(timeLeft / 60)} minutos y ${timeLeft % 60} segundos restantes`;
                            timeLeft--;
                        }, 5000);
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
                            <a href="{{ route('estudiantes.create') }}" class="p-element">
                                <div class="icon-sidebar-item" style="    justify-content: end;;
}">
                                    <i class="material-icons">check_circle</i>
                                </div>
                                <div class="name-sidebar-item">
                                    <li>Registro</li>
                                </div>
                            </a>
                    </nav>
                </div>
            </div>
            <div class="content-autors">
                <span class="autors1">
                <i>Designed by </i>
      <b><a>Sebastian Flores</a></b>
      <i> & </i>
      <b><a>Karen Cueva</a></b>.

                </span>
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
        <!-- contenido -->
        <main class="navbar">
            <button class="profile-icon dropdown" id="profile-button">

                <div class="name-profile">
                    @if (Auth::check())
                        <span>{{ Auth::user()->NombreUsuario }}</span>
                    @else
                        <span>No disponible</span>
                    @endif
                </div>
                <div class="icon-profile">
                    <img src="../img/default/user.svg">
                </div>
            </button>
            <!-- Aquí agregamos el contenedor del menú desplegable -->
            <div class="popup-menu-profile">
                <div class="container">
                    <a href="{{ route('conectarModulos', ['token' => session('token')]) }}" class="change_module">
                        <i class="fa-regular fa-rectangle-vertical-history"></i>
                        <span>Cambiar módulo</span>
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
        class="content-views dimension-content {{ session('menuState') == 'collapsed' ? 'dimension-content-hidden' : '' }}"
        [ngClass]="{'dimension-content-hidden': sidebarHidden}">
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
    <script src="{{ asset('js/estudiante/general.js') }}"></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <!-- Box Icons -->
    {{--  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
        integrity="sha384-gL5q2wHNwpg9voDwmz1onh73oSJ8lFvZEydTHpw4M4okQ7N8qI+v5h0zitOykKdp" crossorigin="anonymous"> --}}
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>


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

</body>

</html>
