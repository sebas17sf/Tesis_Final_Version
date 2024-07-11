<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="\img\logos\logo_tesis.png" alt="logo">
    <title>Registro de Usuario</title>
    <!-- Add Bootstrap CSS link -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Add Google Icons link -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="css/register.css">
    @vite(['resources/scss/app.scss', 'resources/js/app.js'])

</head>

<body>
    <section class="global_contenedor">
        <div class="main1">
            <div class="switch">

                <div class="switch_circle"></div>
                <div class="switch_circle switch_circle_t"></div>
                <div class="switch_circle switch_circle_t2"></div>
                <div class="switch_circle switch_circle_t3"></div>

                <!-- Boton iniciar sesion -->
                <div class="button_container_login">
                    <a href="{{ route('login') }}" class="boton_login button1" type="button" id="toggleButton2"><i class="fa-regular fa-angles-left"></i>
                        Inicia sesión</a>
                </div>



                <form class="switch_container" method="POST" action="{{ route('register') }}">

                    <img class="logo_login" src="\img\logos\logo_tesis.png" alt="Logo">
                    <h3 class="title" id="sesionTitulo">Validación</h3>
                    @csrf

                    <div class="contenedor_inputs">
                        <div>
                            <!-- Campo de nombre -->
                            <label class="description" for="cedula">Cédula</label>
                            <input type="text" class="input form_input" id="cedula" name="cedula" placeholder="Ingrese su cédula" required>
                            @error('cedula')
                            <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div>
                            <!-- Campo de correo electronico -->
                            <label class="description" for="cedula">Repetir Cédula</label>
                            <input type="text" class="input form_input" id="cedula" name="cedula" placeholder="Repita su cédula" required>

                        </div>


                    </div>



                    <!-- Botón de enviar -->
                    <div class="btn_contenedor_register">
                        <button type="submit" class="button efects_button">Validar</button>
                    </div>

                </form>

            </div>
        </div>
    </section>

    <!-- Add Bootstrap JavaScript and jQuery dependencies (optional) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        document.getElementById('togglePassword').addEventListener('click', function(e) {
            const passwordInput = document.getElementById('Contrasena');
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            this.children[0].textContent = type === 'password' ? 'visibility' : 'visibility_off';
        });
    </script>

</body>

</html>
