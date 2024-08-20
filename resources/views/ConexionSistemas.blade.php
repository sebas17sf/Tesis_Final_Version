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
         <form class="main1" action="{{ route('modulo1') }}" method="post">
            @csrf
            <button type="submit" class="switch">
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
        // Definir rolesMap en el contexto global
        const rolesMap = @json($rolesMap);

        // Mapeo de nombres técnicos a nombres legibles para la alerta
        const readableRoleNames = {
            'Administrador': 'Administrador',
            'Estudiante': 'Estudiante',
            'DirectorVinculacion': 'Director de Vinculación',
            'ParticipanteVinculacion': 'Docente',
            'Vinculacion': 'Coordinador de Vinculación',
            'Director-Departamento': 'Director de Departamento',
            'Practicas': 'Coordinador de Prácticas',
        };

        document.addEventListener('DOMContentLoaded', function() {
            console.log('rolesMap:', rolesMap);

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

            const estado = "{{ $estado }}";

            let roles = [];
            if (estado === 'permiteAdministrativo') {
                roles = ['Administrador', 'ParticipanteVinculacion'];
            } else if (estado === 'permiteVinculacion') {
                roles = ['Vinculacion', 'ParticipanteVinculacion'];
            } else if (estado === 'permiteDepartamento') {
                roles = ['Director-Departamento', 'ParticipanteVinculacion'];
            } else if (estado === 'permitePracticas') {
                roles = ['Practicas', 'ParticipanteVinculacion'];
            } else {
                roles = [];
            }

            // Verificar si hay roles disponibles antes de mostrar la alerta
            if (roles.length > 0) {
                // Usar readableRoleNames para mostrar nombres legibles en la alerta
                Swal.fire({
                    title: 'Seleccione su rol',
                    html: roles.map(role => `
                        <center><button class="custom-role-btn"
                                onclick="selectRole('${role}')">
                            ${readableRoleNames[role] || role}
                        </button></center>
                    `).join(''),
                    background: 'rgba(20, 20, 30, 0.85)',
                    showCancelButton: true,
                    showConfirmButton: false,
                    cancelButtonText: 'Cancelar',
                    customClass: {
                        popup: 'custom-popup',
                        title: 'custom-title',
                        content: 'custom-content',
                        cancelButton: 'custom-cancel-button',
                    },
                });
            }
        });

        function selectRole(role) {
            console.log("Rol seleccionado:", role);

            // Cerrar la alerta inmediatamente
            Swal.close();

            // Obtener el ID del rol seleccionado
            const roleId = getRoleIdByName(role);

            // Enviar solicitud AJAX para actualizar el role_id del usuario
            if (roleId) {
                fetch('{{ route('admin.updateRoleVentana') }}', {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ role_id: roleId })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        console.log("Rol actualizado exitosamente.");
                    } else {
                        console.error("Error al actualizar el rol:", data.message);
                    }
                })
                .catch(error => console.error("Error en la solicitud:", error));
            }
        }

        function getRoleIdByName(roleName) {
            return rolesMap[roleName] || null;
        }
    </script>









    <style>
        .custom-popup {
            border-radius: 15px;
            /* Bordes redondeados */
            padding: 20px;
            border: 2px solid rgba(255, 255, 255, 0.2);
            /* Borde fino translúcido */
            background-color: rgba(20, 20, 30, 0.85);
            /* Fondo translúcido */
            box-shadow: 0px 4px 20px rgba(0, 0, 0, 0.5);
            /* Sombra similar a la imagen */
        }

        .custom-title {
            font-size: 24px;
            font-weight: bold;
            color: #FFFFFF;
            text-shadow: 0 0 10px rgba(0, 0, 0, 0.7);
            /* Sombra del texto para destacarlo */
        }

        .custom-role-btn {
            display: block;
            width: 70%;
            padding: 10px 20px;
            margin: 8px 0;
            background-color: rgba(58, 63, 84, 0.8);
            /* Fondo oscuro translúcido */
            color: #FFFFFF;
            /* Color del texto */
            border: 1px solid rgba(255, 255, 255, 0.3);
            /* Borde fino translúcido */
            border-radius: 10px;
            font-size: 16px;
            text-align: center;
            transition: background-color 0.3s ease, box-shadow 0.3s ease;
        }

        .custom-role-btn:hover {
            background-color: rgba(86, 93, 146, 0.8);
            /* Color de fondo al pasar el mouse */
            box-shadow: 0 0 15px rgba(86, 93, 146, 0.8);
            /* Iluminación al pasar el mouse */
        }

        .custom-cancel-button {
            background-color: rgba(211, 51, 51, 0.8);
            color: #ffffff;
            border: 1px solid rgba(255, 255, 255, 0.3);
            /* Borde fino translúcido */
            border-radius: 10px;
            transition: background-color 0.3s ease, box-shadow 0.3s ease;
        }
    </style>


</body>

</html>
