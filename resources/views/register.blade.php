<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="/img/logos/logo_tesis.png" alt="logo">
    <title>Registro de Usuario</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
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

                <div class="button_container_login">
                    <a href="{{ route('login') }}" class="boton_login button1" type="button" id="toggleButton2"><i
                            class="fa-regular fa-angles-left"></i> Inicia sesión</a>
                </div>

                <div class="text-center">
                    <img class="logo_login" src="\img\logos\logo_tesis.png" alt="Logo">
                    <h3 class="title" id="sesionTitulo">Validar usuario</h3>
                    <!-- Botones para seleccionar tipo de usuario -->
                    <div class="btn-group btn-group-toggle mt-3" data-toggle="buttons">
                        <label class="btn btn-secondary active" id="btn-estudiante">
                            <input type="radio" name="options" autocomplete="off" checked> Estudiante
                        </label>
                        <label class="btn btn-secondary" id="btn-docente">
                            <input type="radio" name="options" autocomplete="off"> Docente
                        </label>
                    </div>
                </div>

                <!-- Formulario para Estudiantes -->
                <form class="switch_container mt-4" id="form-estudiante" method="POST" action="{{ route('register') }}"
                    style="display: none;">
                    @csrf
                    <div class="contenedor_inputs">
                        <div>
                            <label class="description" for="cedula">Cédula estudiante:</label>
                            <input type="text" class="input form_input" id="cedula" name="cedula"
                                placeholder="Ingrese su cédula" required>
                            <small id="cedulaError" class="form-text text-danger"></small>
                            @error('cedula')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div>
                            <label class="description" for="cedula">Repetir Cédula:</label>
                            <input type="text" class="input form_input" id="cedula_confirmation"
                                name="cedula_confirmation" placeholder="Repita su cédula" required>
                            <small id="cedulaConfirmationError" class="form-text text-danger"></small>
                        </div>
                    </div>
                    <div class="btn_contenedor_register">
                        <button type="submit" class="button efects_button">Validar estudiante</button>
                    </div>
                </form>

                <!-- Formulario para Docentes -->
                <form class="switch_container mt-4" id="form-docente" method="POST"
                    action="{{ route('ParticipanteVinculacion.comprobar') }}" style="display: none;">
                    @csrf
                    <div class="contenedor_inputs">
                        <div>
                            <label class="description" for="cedula_docente">Cédula docente:</label>
                            <input type="text" class="input form_input" id="cedula_docente" name="cedula_docente"
                                placeholder="Ingrese su cédula" required>
                            <small id="cedulaDocenteError" class="form-text text-danger"></small>
                            @error('cedula_docente')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div>
                            <label class="description" for="cedula_docente">Repetir Cédula:</label>
                            <input type="text" class="input form_input" id="cedula_docente_confirmation"
                                name="cedula_docente_confirmation" placeholder="Repita su cédula" required>
                            <small id="cedulaDocenteConfirmationError" class="form-text text-danger"></small>

                        </div>
                    </div>
                    <div class="btn_contenedor_register">
                        <button type="submit" class="button efects_button">Validar docente</button>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {
            // Función para mostrar el formulario de estudiante
            function showEstudianteForm() {
                $('#form-estudiante').show();
                $('#form-docente').hide();
                $('#btn-estudiante').addClass('active');
                $('#btn-docente').removeClass('active');
            }

            // Función para mostrar el formulario de docente
            function showDocenteForm() {
                $('#form-estudiante').hide();
                $('#form-docente').show();
                $('#btn-docente').addClass('active');
                $('#btn-estudiante').removeClass('active');
            }

            $('#btn-estudiante').on('click', function() {
                showEstudianteForm();
                localStorage.setItem('selectedForm', 'estudiante');
            });

            $('#btn-docente').on('click', function() {
                showDocenteForm();
                localStorage.setItem('selectedForm', 'docente');
            });

            // Verifica la selección guardada al cargar la página
            if (localStorage.getItem('selectedForm') === 'docente') {
                showDocenteForm();
            } else {
                // Por defecto, muestra el formulario de estudiante
                showEstudianteForm();
            }
        });
    </script>


    <script src="{{ asset('js/validaciones/registerLogin.js') }}"></script>
</body>

</html>
