<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="/img/logos/logo_tesis.png" alt="logo">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
        integrity="sha384-KyZXEAg3QhqLMpG8r+JzWGyT5Lb8LwF4dPAKzLo16TGf5A/J3zX+3qmCOJCpbo5" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.js"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    @vite(['resources/scss/app.scss', 'resources/js/app.js'])
    <link rel="stylesheet" href="css/connect_modules.css">
    <title>Selección del sistema</title>
</head>

<body>
    <div class="gradient-bg">
        <svg viewBox="0 0 100vw 100vw" xmlns='http://www.w3.org/2000/svg' class="noiseBg">
            <filter id='noiseFilterBg'>
                <feTurbulence type='fractalNoise' baseFrequency='0.6' stitchTiles='stitch' />
            </filter>
            <rect width='100%' height='100%' preserveAspectRatio="xMidYMid meet" filter='url(#noiseFilterBg)' />
        </svg>
        <svg xmlns="http://www.w3.org/2000/svg" class="svgBlur">
            <defs>
                <filter id="goo">
                    <feGaussianBlur in="SourceGraphic" stdDeviation="10" result="blur" />
                    <feColorMatrix in="blur" mode="matrix" values="1 0 0 0 0 0 1 0 0 0 0 0 1 0 0 0 0 0 18 -8"
                        result="goo" />
                    <feBlend in="SourceGraphic" in2="goo" />
                </filter>
            </defs>
        </svg>
        <div class="gradients-container">
            <div class="g1"></div>
            <div class="g2"></div>
            <div class="g3"></div>
            <div class="g4"></div>
            <div class="g5"></div>
            <div class="interactive"></div>
        </div>
    </div>

    <section class="global_contenedor">
        <!-- Boton para ir al modulo 1 -->
        <form class="main1" action="{{ route('modulo1') }}" method="post" id="modulo1Form">
            @csrf
            <button type="button" class="switch" id="modulo1Button">
                <span class="title">VINCULACIÓN Y PRÁCTICAS</span>
                <img src="{{ asset('img/default/modulopracticas.png') }}">
            </button>
        </form>

        <!-- Boton para ir al modulo 2 -->
        <a href="{{ route('modulo2') }}" class="main2">
            <div class="switch">
                <div class="shadow"></div>
                <span class="title">
                    <span>GESTIÓN ACADÉMICA</span>
                </span>
                <img src="{{ asset('img/default/modulo2.png') }}">
            </div>
        </a>

        <a href="{{ route('logout') }}" class="button1 btn_cerrar_sesion">
            <i class="material-icons">exit_to_app</i> Cerrar Sesión
        </a>
    </section>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Verificar y almacenar el token en localStorage
            const token = "{{ session('token') }}";
            if (token) {
                console.log("Token encontrado en la sesión, almacenando en localStorage:", token);
                localStorage.setItem('token', token);
            } else {
                console.log("No se encontró token en la sesión.");
            }

            const storedToken = localStorage.getItem('token');
            if (storedToken) {
                console.log("Token cargado desde localStorage:", storedToken);
            } else {
                console.log("No se encontró un token en localStorage.");
            }

            // Manejar la selección de roles y redirección
            const roles = @json($roles);

            const roleNames = {
                'Administrador': 'Administrador',
                'Vinculacion': 'Coordinador de Vinculación',
                'Practicas': 'Coordinador de Prácticas',
                'Director-Departamento': 'Director de departamento',
                'Director-Carrera': 'Director de carrera',
                'DirectorVinculacion': 'Director de proyectos sociales',
                'ParticipanteVinculacion': 'Docente',
                'Estudiante': 'Estudiante'
            };

            document.getElementById('modulo1Button').addEventListener('click', function(event) {
                // Si el usuario tiene más de un rol, mostramos la ventana emergente
                if (roles.length > 1) {
                    event.preventDefault();

                    Swal.fire({
                        title: 'Seleccione su rol',
                        html: roles.map(role => `
                            <button class="custom-role-btn"
                                    onclick="selectRole('${role}')">
                                ${roleNames[role] || role}
                            </button>
                        `).join(''),
                        background: '#2A3F54', // Fondo de la alerta
                        color: '#FFFFFF', // Color del texto
                        showCancelButton: true,
                        showConfirmButton: false,
                        cancelButtonText: 'Cancelar',
                        cancelButtonColor: '#d33',
                        customClass: {
                            popup: 'custom-popup',
                            title: 'custom-title',
                            cancelButton: 'custom-cancel-button',
                        },
                    });

                } else if (roles.length === 1) {
                    // Si solo hay un rol, redirigir automáticamente
                    redirectToRole(roles[0]);
                } else {
                    // Si no hay roles definidos, envía el formulario normalmente
                    document.getElementById('modulo1Form').submit();
                }
            });
        });

        // Función para redirigir según el rol seleccionado
        function selectRole(role) {
            redirectToRole(role);
        }

        function redirectToRole(role) {
            if (role === 'Administrador') {
                window.location.href = "{{ route('admin.index') }}";
            } else if (role === 'Vinculacion' || role === 'Practicas') {
                window.location.href = "{{ route('coordinador.index') }}";
            } else if (role === 'Director-Departamento' || role === 'Director-Carrera') {
                window.location.href = "{{ route('director.indexProyectos') }}";
            } else if (role === 'DirectorVinculacion') {
                window.location.href = "{{ route('director_vinculacion.index') }}";
            } else if (role === 'ParticipanteVinculacion') {
                window.location.href = "{{ route('ParticipanteVinculacion.index') }}";
            } else if (role === 'Estudiante') {
                window.location.href = "{{ route('estudiantes.create') }}";
            }
        }

        // Mover la burbuja interactiva
        document.addEventListener('DOMContentLoaded', () => {
            const interBubble = document.querySelector('.interactive');
            let curX = 0;
            let curY = 0;
            let tgX = 0;
            let tgY = 0;

            const move = () => {
                curX += (tgX - curX) / 20;
                curY += (tgY - curY) / 20;
                interBubble.style.transform = `translate(${Math.round(curX)}px, ${Math.round(curY)}px)`;
                requestAnimationFrame(move);
            };

            window.addEventListener('mousemove', (event) => {
                tgX = event.clientX;
                tgY = event.clientY;
            });

            move();
        });
    </script>

    <style>
        .custom-role-btn {
            display: block;
            width: 100%;
            padding: 10px 20px;
            margin: 5px 0;
            background-color: #1A202C; /* Fondo del botón */
            color: #FFFFFF; /* Color del texto */
            border: none;
            border-radius: 5px;
            font-size: 16px;
            text-align: center;
            transition: background-color 0.3s ease;
        }

        .custom-role-btn:hover {
            background-color: #3F51B5; /* Color de fondo al pasar el mouse */
        }

        .custom-popup {
            border-radius: 15px; /* Bordes redondeados del popup */
            padding: 20px;
        }

        .custom-title {
            font-size: 24px;
            font-weight: bold;
        }

        .custom-cancel-button {
            background-color: #d33;
            color: #ffffff;
        }

        /* Opcional: estilizar el fondo del botón de cancelar */
        .custom-cancel-button:hover {
            background-color: #c12;
        }
    </style>


</body>

</html>
