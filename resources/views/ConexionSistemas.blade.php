<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="/img/logos/logo_tesis.png" alt="logo">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
        integrity="sha384-KyZXEAg3QhqLMpG8r+JzWGyT5Lb8LwF4dPAKzLo16TGf5A/J3zX+3qmCOJCpbo5" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.js"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    @vite(['resources/scss/app.scss', 'resources/js/app.js'])
    <link rel="stylesheet" href="css/connect_modules.css">
    <title>Selección del sistema</title>
</head>

<body>
    <div class="gradient-bg">
        <svg viewBox="0 0 100vw 100vw" xmlns='http://www.w3.org/2000/svg' class="noiseBg">
            <filter id='noiseFilterBg'>
                <feTurbulence type='fractalNoise' baseFrequency='0.6' stitchTiles='stitch' />
            </filter>
            <rect width='100%' height='100%' preserveAspectRatio="xMidYMid meet" filter='url(#noiseFilterBg)' />
        </svg>
        <svg xmlns="http://www.w3.org/2000/svg" class="svgBlur">
            <defs>
                <filter id="goo">
                    <feGaussianBlur in="SourceGraphic" stdDeviation="10" result="blur" />
                    <feColorMatrix in="blur" mode="matrix" values="1 0 0 0 0 0 1 0 0 0 0 0 1 0 0 0 0 0 18 -8"
                        result="goo" />
                    <feBlend in="SourceGraphic" in2="goo" />
                </filter>
            </defs>
        </svg>
        <div class="gradients-container">
            <div class="g1"></div>
            <div class="g2"></div>
            <div class="g3"></div>
            <div class="g4"></div>
            <div class="g5"></div>
            <div class="interactive"></div>
        </div>
    </div>

    <section class="global_contenedor">
        <!-- Boton para ir al modulo 1 -->
        <form class="main1" action="{{ route('modulo1') }}" method="post">
            @csrf
            <button type="submit" class="switch">
                <span class="title">VINCULACIÓN Y PRÁCTICAS</span>
                <img src="{{ asset('img/default/modulopracticas.png') }}">
            </button>
        </form>

        <!-- Boton para ir al modulo 2 -->
        <a href="{{ route('modulo2') }}" class="main2">
            <div class="switch">
                <div class="shadow"></div>
                <span class="title">
                    <span>GESTIÓN ACADÉMICA</span>
                </span>
                <img src="{{ asset('img/default/modulo2.png') }}">
            </div>
        </a>

        <a href="{{ route('logout') }}" class="button1 btn_cerrar_sesion">
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



    <script>
        @if (session('token'))
            localStorage.setItem('token', '{{ session('token') }}');

            ////cuando se cierra en logout se elimina el token de localstorage
            window.addEventListener('beforeunload', function (e) {
                localStorage.removeItem('token');
            });

        @endif
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const interBubble = document.querySelector('.interactive');
            let curX = 0;
            let curY = 0;
            let tgX = 0;
            let tgY = 0;

            const move = () => {
                curX += (tgX - curX) / 20;
                curY += (tgY - curY) / 20;
                interBubble.style.transform = `translate(${Math.round(curX)}px, ${Math.round(curY)}px)`;
                requestAnimationFrame(move);
            };

            window.addEventListener('mousemove', (event) => {
                tgX = event.clientX;
                tgY = event.clientY;
            });

            move();
        });
    </script>
</body>

</html>
