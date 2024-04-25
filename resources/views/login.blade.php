<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="\img\logos\logo_tesis.png" alt="logo">
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
    <div class="container-box">
        <div class="login-box">
            <img src="\img\logos\logo_tesis.png" alt="Imagen Circular"
                class="circular-image">
            <h2 class="mb-4" id="sesionTitulo">Iniciar Sesión</h2>
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

            <form action="{{ route('login') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="CorreoElectronico">Correo Electrónico:</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="material-icons">email</i></span>

                        </div>
                        <input class="input" type="email" id="CorreoElectronico" name="CorreoElectronico" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="Contrasena">Contraseña:</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="material-icons">lock</i></span>
                        </div>
                        <input class="input" type="password" id="Contrasena" name="Contrasena" required>
                    </div>
                </div>
                <button type="submit" class="button">Iniciar Sesión</button>
                <div class="mt-2">
                    <a href="{{ route('recuperar-contrasena') }}">¿Olvidaste tu contraseña?</a>
                </div>
            </form>
            <div class="text-center mt-3">
                <p>¿No tienes una cuenta? <a href="{{ route('register') }}">Regístrate aquí</a></p>
            </div>
        </div>
    </div>

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
                    html: '<div>El creador de esta Tesis: Sebastian Flores es Team GODZILLA</div><img src="https://media.tenor.com/amLCd4kVrX4AAAAi/team-godzilla.gif" alt="Godzilla" style="width: 200px; height: 200px;">',
                    imageWidth: 200,
                    imageHeight: 200
                });
                clickCount = 0;
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            const sessionTitle = document.getElementById('sesionTitulo');
            sessionTitle.addEventListener('click', handleClick);
        });
    </script>

</body>

</html>
