<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha384-KyZXEAg3QhqLMpG8r+JzWGyT5Lb8LwF4dPAKzLo16TGf5A/J3zX+3qmCOJCpbo5" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.js"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    @vite(['resources/scss/app.scss', 'resources/js/app.js'])
    <link rel="stylesheet" href="css/connect_modules.css">
    <title>Selección del sistema</title>
</head>

<body>
    <section class="global_contenedor">

        <!-- Boton para ir al modulo 1 -->
        <form class="main1" action="{{ route('modulo1') }}" method="post">
            @csrf
            <button type="submit" class="switch">
                <span class="title">Modulo 1</span>
            </button>
        </form>

        <!-- Boton para ir al modulo 2 -->
        <a href="{{ route('modulo2') }}" class="main2">
            <div class="switch">
                <span class="title">GESTIÓN ACADEMICA</span>
            </div>
        </a>


        <a href="{{ route('logout') }}" class="button1 btn_cerrar_sesion efects_button">
            <i class="material-icons">exit_to_app</i> Cerrar Sesión
        </a>

    </section>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        var token = "{{ session('token') }}";
        if (token) {
            localStorage.setItem('token', token);
        }
    </script>
</body>

</html>
