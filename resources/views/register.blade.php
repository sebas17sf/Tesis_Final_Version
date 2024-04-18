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
    <link rel="stylesheet" href="css/login.css">
    @vite(['resources/scss/app.scss', 'resources/js/app.js'])

    <style>
       body {
            background-color: #f8f9fa;
        }
        .container {
            max-width: 400px;
            margin: 50px auto 0; /* Ajusta el valor del margin-top para controlar la separación desde arriba */
            background-color: #ffffff;
            border-radius: 5px;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-group label {
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container">
    <div class="login-box">
    <img src="\img\logos\logo_tesis.png" alt="Imagen Circular"
                class="circular-image">
        <h3 class="text-center">Registro de Usuario</h3>
        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="form-group">
                <label for="NombreUsuario">Nombre de Usuario:</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="material-icons">person</i></span>
                    </div>
                    <input type="text" class="form-control" id="NombreUsuario" name="NombreUsuario" required>
                </div>

            <div class="form-group">
                <label for="CorreoElectronico">Correo Electrónico:</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="material-icons">email</i></span>
                    </div>
                    <input type="email" class="form-control" id="CorreoElectronico" name="CorreoElectronico" required>
                </div>
            </div>

             <div class="form-group">
                <label for="FechaNacimiento">Fecha de Nacimiento:</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="material-icons">date_range</i></span>
                    </div>
                    <input type="date" class="form-control" id="FechaNacimiento" name="FechaNacimiento" required>
                </div>

            <div class="form-group">
                <label for="Contrasena">Contraseña:</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="material-icons">lock</i></span>
                    </div>
                    <input type="password" class="form-control" id="Contrasena" name="Contrasena" required>
                </div>
            </div>

            

            <button type="submit" class="btn btn-primary btn-block">Registrarse</button>
        </form>
        </div>
    </div>

    <!-- Add Bootstrap JavaScript and jQuery dependencies (optional) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
