<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="\img\logos\logo_tesis.png" alt="logo">
    <link rel="stylesheet" href="css/change_password.css">
    <title>Cambiar contraseña</title>
    <!-- Add Bootstrap CSS link -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Add Google Icons link -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    @vite(['resources/scss/app.scss', 'resources/js/app.js'])
</head>
<style>
    .title {
        margin: 0;
        margin-bottom: 20px;
        font-size: 25px;
        font-weight: 700;
        line-height: 1.5;
        color: #494949;
    }
</style>

<body style="background-color: #40456c;">
    <section class="d-flex justify-content-center align-items-center vh-100">
        <div class="card p-5 shadow-lg" style="border-radius: 20px; background-color: #f8f9fa;">
            <div class="text-center">
                <!-- Mensajes de éxito, error y validación -->
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
                @if ($errors->any())
                    <div class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            {{ $error }}
                        @endforeach
                    </div>
                @endif
            </div>

             <form method="POST" action="{{ route('restablecer-contrasena', ['correoElectronico' => $correoElectronico, 'token' => $token]) }}">
                @csrf
                <input type="hidden" name="correoElectronico" value="{{ $correoElectronico }}">
                <input type="hidden" name="token" value="{{ $token }}">

                <div class="text-center mb-4">
                    <img class="mb-4" src="/img/logos/logo_tesis.png" alt="Logo" width="100" height="100">
                    <h2 class="title">Recuperar Contraseña</h2>
                </div>

                <div class="form-group">
                    <label for="password">Nueva Contraseña</label>
                    <div class="input-group">
                        <input type="password" class="form-control input" id="password" name="password" placeholder="Ingrese su nueva contraseña">
                     </div>
                     <small id="passwordError" class="form-text text-danger" style="display: none;"></small>

                </div>

                <div class="form-group">
                    <label for="password_confirmation">Confirmar Contraseña</label>
                    <div class="input-group">
                        <input type="password" class="form-control input" id="password_confirmation" name="password_confirmation" placeholder="Confirme su nueva contraseña">

                    </div>
                    <small id="confirmPasswordError" class="form-text text-danger" style="display: none;"></small>
                </div>
                <center>
                    <button type="submit" class="button">Cambiar Contraseña</button>
                </center>
            </form>

        </div>
    </section>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.js"></script>

    <script>
     document.querySelector('form').addEventListener('submit', function(event) {
    let isValid = true;

    // Obtener los valores de las contraseñas
    const passwordField = document.getElementById('password');
    const confirmPasswordField = document.getElementById('password_confirmation');
    const password = passwordField.value.trim();
    const confirmPassword = confirmPasswordField.value.trim();

    // Limpiar mensajes de error previos
    const passwordError = document.getElementById('passwordError');
    const confirmPasswordError = document.getElementById('confirmPasswordError');
    passwordError.style.display = 'none';
    confirmPasswordError.style.display = 'none';

    // Validar que el campo de contraseña esté lleno y tenga al menos 6 caracteres
    if (password === '') {
        isValid = false;
        passwordError.textContent = 'El campo de contraseña es requerido.';
        passwordError.style.display = 'block';
    } else if (password.length < 6) {
        isValid = false;
        passwordError.textContent = 'La contraseña debe tener al menos 6 caracteres.';
        passwordError.style.display = 'block';
    }

    // Validar que el campo de confirmación de contraseña esté lleno
    if (confirmPassword === '') {
        isValid = false;
        confirmPasswordError.textContent = 'El campo de confirmación de contraseña es requerido.';
        confirmPasswordError.style.display = 'block';
    }

    // Validar que ambas contraseñas coincidan
    if (password !== '' && confirmPassword !== '' && password !== confirmPassword) {
        isValid = false;
        confirmPasswordError.textContent = 'Las contraseñas no coinciden.';
        confirmPasswordError.style.display = 'block';
    }

    // Si hay algún error, prevenir el envío del formulario
    if (!isValid) {
        event.preventDefault();
    }
});

// Función para eliminar el mensaje de error cuando el usuario empieza a escribir
function clearErrorMessage(event) {
    const errorElement = document.getElementById(event.target.id + 'Error');
    if (errorElement) {
        errorElement.style.display = 'none';
    }
}

// Añadir eventos de input a cada campo para eliminar el mensaje de error al escribir
document.getElementById('password').addEventListener('input', clearErrorMessage);
document.getElementById('password_confirmation').addEventListener('input', clearErrorMessage);

        </script>
</body>

</html>
