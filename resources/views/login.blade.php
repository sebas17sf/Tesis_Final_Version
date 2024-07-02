<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="/img/logos/logo_tesis.png" alt="logo">
    <title>Iniciar Sesión</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.js"></script>
    <link rel="stylesheet" href="css/login.css">
    @vite(['resources/scss/app.scss', 'resources/js/app.js'])
</head>

<body>
    <section class="global_contenedor">
        <div class="main1" id="main1">
            <div class="switch">
                <div class="switch_circle"></div>
                <div class="switch_circle switch_circle_t"></div>
                <div class="switch_circle switch_circle_t2"></div>
                <div class="switch_circle switch_circle_t3"></div>

                <!-- Boton registrarse -->
                <div class="button_container_register">
                    <a href="{{ route('register') }}" class="boton_registro button1" type="button">Validar <i
                            class="fa-regular fa-angles-right"></i></a>
                </div>

                @if (session('success'))
                    <script>
                        Swal.fire({
                            icon: 'success',
                            title: 'Éxito',
                            text: '{{ session('success') }}',
                            confirmButtonText: 'Ok'
                        });
                    </script>
                @endif

                @if (session('error'))
                    <script>
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: '{{ session('error') }}',
                            confirmButtonText: 'Ok'
                        });
                    </script>
                @endif

                <form class="switch_container" action="{{ route('login') }}" method="POST">
                    <img class="logo_login" src="/img/logos/logo_tesis.png" alt="Logo">
                    <h3 class="title" id="sesionTitulo">INICIAR SESIÓN</h3>

                    @csrf

                    <div class="contenedor_inputs">
                        <div>
                            <!-- Campo de correo electrónico -->
                            <label class="description" for="CorreoElectronico">Usuario</label>
                            <input class="input form_input" type="text" id="CorreoElectronico"
                                name="CorreoElectronico" required placeholder="Ingrese su usuario">
                        </div>
                        <!-- Campo de contraseña -->
                        <div>
                            <!-- Campo de contraseña -->
                            <label class="description" for="Contrasena">Contraseña</label>
                            <div class="input-group" style="position: relative;">
                                <input type="password" class="input form_input" id="Contrasena" name="Contrasena"
                                    placeholder="Ingrese su contraseña" required>

                                <div id="togglePassword"
                                    style="position: absolute; top: 55%; right: 10px; transform: translateY(-50%); cursor: pointer;">
                                    <span class="material-icons">
                                        visibility
                                    </span>
                                </div>

                            </div>
                        </div>
                    </div>

                    <!-- Olvido la contraseña -->
                    <div class="olvidar_contraseña">
                        <a href="{{ route('recuperar-contrasena') }}">¿Olvidaste tu contraseña?</a>
                    </div>

                    <!-- Botón de enviar -->
                    <div class="btn_contenedor_login">
                        <button type="submit" class="button efects_button">Iniciar Sesión</button>
                    </div>

                    <!-- Divisor de botones -->
                    <div class="contenedor_divisor">
                        <hr>
                        <span>o</span>
                        <hr>
                    </div>

                    <!-- Boton de google -->
                    <div class="row">
                        <a href="/auth/github/redirect" class="btn_google">
                            <img src="/img/logos/github.png" alt="GitHub Icon" width="20">
                            <span>Continuar con GitHub</span>
                        </a>
                    </div>
                    <!-- Botón de GitHub -->
                </form>
            </div>
        </div>
    </section>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.js"></script>

    <script>
        let clickCount = 0;

        function handleClick() {
            clickCount++;
            if (clickCount === 4) {
                Swal.fire({
                    icon: 'info',
                    title: 'Mensaje especial',
                    html: '<div>El creador de esta Tesis: Sebastian Flores es Team GODZILLA</div><img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSUlAv_HkJ-_Y4yS98xgQn0AsBRDqamQUCWFKtkm99Lm_lRNXau70V8fiTLM92mXbJQov8&usqp=CAU" alt="Godzilla" style="width: 200px; height: 200px;">'
                });
                clickCount = 0;
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            const sessionTitle = document.getElementById('sesionTitulo');
            sessionTitle.addEventListener('click', handleClick);
        });

        document.getElementById('togglePassword').addEventListener('click', function(e) {
            const passwordInput = document.getElementById('Contrasena');
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            this.children[0].textContent = type === 'password' ? 'visibility' : 'visibility_off';
        });
    </script>
</body>

</html>
