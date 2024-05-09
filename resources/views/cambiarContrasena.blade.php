<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cambiar Contraseña</title>
    <!-- Add Bootstrap CSS link -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Add Google Icons link -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .container {
            max-width: 400px;
            background-color: #ffffff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            padding: 20px;
            margin-top: 100px;
            text-align: center;
        }

        .circular-image {
            border-radius: 50%;
            width: 100px;
            height: 100px;
            margin: 0 auto 20px;
            display: block;
        }

        /* Estilo para hacer que los botones de visibilidad tengan el mismo tamaño que los campos de entrada */
        .input-group-text button {
            width: 2.5rem;
            height: 2.5rem;
            padding: 0.5rem;
            border: none;
            background: none;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-top: 0.1rem;
            /* Ajuste de margen superior */
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="text-center">
            <img src="https://upload.wikimedia.org/wikipedia/commons/2/27/Logo_ESPE.png" alt="Imagen Circular"
                class="circular-image">
            <h2 class="mb-4">Cambiar Contraseña</h2>
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
        <form method="POST"
            action="{{ route('restablecer-contrasena', ['correoElectronico' => $correoElectronico, 'token' => $token]) }}">
            @csrf
            <input type="hidden" name="correoElectronico" value="{{ $correoElectronico }}">
            <input type="hidden" name="token" value="{{ $token }}">
            <div class="form-group">
                <label for="password">Nueva Contraseña:</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="material-icons"
                                style="font-size: 1.25rem;">lock</i></span>
                    </div>
                    <input type="password" class="form-control" id="password" name="password"
                        placeholder="Ingrese su nueva contraseña" required>
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                            <i class="material-icons" id="toggleIcon" style="font-size: 1.25rem;">visibility_off</i>
                        </button>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="password_confirmation">Confirmar Contraseña:</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="material-icons"
                                style="font-size: 1.25rem;">lock</i></span>
                    </div>
                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation"
                        placeholder="Confirme su nueva contraseña" required>
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="button" id="toggleConfirmPassword">
                            <i class="material-icons" id="toggleConfirmIcon"
                                style="font-size: 1.25rem;">visibility_off</i>
                        </button>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Cambiar Contraseña</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="{{ asset('js/cambioClaves.js') }}"></script>
</body>

</html>
