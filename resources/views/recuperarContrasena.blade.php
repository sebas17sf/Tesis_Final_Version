<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="\img\logos\logo_tesis.png" alt="logo">
    <link rel="stylesheet" href="css/change_password.css">
    <title>Restablecer contraseña</title>
    <!-- Add Bootstrap CSS link -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Add Google Icons link -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
</head>

<body>
    <section class="global_contenedor">
        <div class="main1">
            <div class="switch">

                <div class="text-center">
                    @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                    @endif


                </div>


                <form class="switch_container" method="POST" action="{{ route('enviar-correo-recuperacion') }}">

                    <img class="logo_login" src="\img\logos\logo_tesis.png" alt="Logo">
                    <h2 class="title">RECUPERAR CONTRASEÑA</h2>

                    @csrf
                    <!-- Campo de correo electronico -->
                    <label class="description" for="CorreoElectronico">Correo Electrónico</label>
                    <input type="email" class="input form_input" id="CorreoElectronico" name="email" placeholder="Ingrese su correo electrónico"  >
                    @error('email')
                    <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                    <!-- Botón de enviar -->
                    <div class="btn_contenedor_register">
                        <button type="submit" class="button">Enviar</button>
                    </div>

                </form>
            </div>
        </div>
    </section>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
