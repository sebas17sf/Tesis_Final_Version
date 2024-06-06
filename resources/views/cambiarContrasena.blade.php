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
    color: #494949;}

    
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
                    <img class="mb-4" src="\img\logos\logo_tesis.png" alt="Logo" width="100" height="100">
                    <h2 class="title">Recuperar Contraseña</h>
                </div>

                <div class="form-group">
                    <label for="password">Nueva Contraseña</label>
                    <div class="input-group">

                        <input type="password" class="form-control input" id="password" name="password" placeholder="Ingrese su nueva contraseña" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="password_confirmation">Confirmar Contraseña</label>
                    <div class="input-group">
                       
                        <input type="password" class="form-control input" id="password_confirmation" name="password_confirmation" placeholder="Confirme su nueva contraseña" required>
                    </div>
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
</body>

</html>
