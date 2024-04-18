<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restablecer contraseña</title>
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
    </style>
</head>

<body>
    <div class="container">
        <div class="text-center">
            <img src="https://upload.wikimedia.org/wikipedia/commons/2/27/Logo_ESPE.png" alt="Imagen Circular"
                class="circular-image">
            <h2 class="mb-4">Recuperar Contraseña</h2>
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
        <form method="POST" action="{{ route('enviar-correo-recuperacion') }}">
            @csrf
            <div class="form-group">
                <label for="CorreoElectronico">Correo Electrónico:</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="material-icons">email</i></span>
                    </div>
                    <input type="email" class="form-control" id="CorreoElectronico" name="email"
                        placeholder="Ingrese su correo electrónico" required>
                </div>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Enviar Enlace de Restablecimiento</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
