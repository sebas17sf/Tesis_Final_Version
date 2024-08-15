@extends('layouts.app')

@section('title', 'Configuracion de Usuario')

@section('title_component', 'Credenciales de Usuario')

@section('content')

    @if (session('success'))
        <div class="contenedor_alerta success">
            <div class="icon_alert"><i class="fa-regular fa-circle-check fa-beat"></i></div>
            <div class="content_alert">
                <div class="title">Éxito!</div>
                <div class="body">{{ session('success') }}</div>
            </div>
        </div>
    @endif

    @if (session('error'))
        <div class="contenedor_alerta error">
            <div class="icon_alert"><i class="fa-regular fa-circle-x fa-beat"></i></div>
            <div class="content_alert">
                <div class="title">Error!</div>
                <div class="body">{{ session('error') }}</div>
            </div>
        </div>
    @endif

    <section class="content_profile">
        <div class="section1">
            <!-- Informacion estatica -->
            <div class="content_static">
                <div>
                    <span class="title_edit_profile"><b>Información personal</b></span>
                    <hr>
                </div>

                <div class="elements_static">
                    <div class="icon_block">
                        <i class="fa-brands fa-expeditedssl"></i>
                    </div>

                    <div>
                        <label>ID Espe</label>
                        <span>{{ $usuario->estudiante->espeId }}</span>
                    </div>

                    <div>
                        <label for="nombre">Usuario</label>
                        <span>{{ $usuario->nombreUsuario }}</span>
                    </div>

                    <div>
                        <label>Cédula</label>
                        <span>{{ $usuario->estudiante->cedula }}</span>
                    </div>

                    <div>
                        <label>Teléfono</label>
                        <span>{{ $usuario->estudiante->celular }}</span>
                    </div>

                    <div class="last-element">
                        <label>Correo institucional</label>
                        <span>{{ $usuario->estudiante->correo }}</span>
                    </div>
                </div>
            </div>

            <!-- Cambiar contraseña -->
            <div class="content_change_pass">
                <div>
                    <span class="title_edit_profile"><b>Cambiar contraseña</b></span>
                    <hr>
                </div>

                <form class="form_change_passwd"
                    action="{{ route('estudiantes.actualizarCredenciales', ['userId' => auth()->user()->userId]) }}"
                    method="POST" id="changePasswordForm">
                    @csrf
                    @method('PUT')
                    <div>
                        <label for="password">Nueva contraseña <span class="requerido">*</span></label>
                        <input type="password" id="password" name="password" class="input" placeholder="Ingrese la clave">
                        <small id="passwordError" class="error-message" style="color: red;"></small>
                    </div>

                    <div>
                        <label for="password_confirmation">Confirmar contraseña <span class="requerido">*</span></label>
                        <input type="password" id="password_confirmation" name="password_confirmation" class="input"
                            placeholder="Ingrese de nuevo la clave">
                        <small id="confirmPasswordError" class="error-message" style="color: red;"></small>
                    </div>

                    <div class="content_button">
                        <button class="button1 efects_button" type="submit">Actualizar</button>
                    </div>
                </form>
            </div>
        </div>

        <div>
            <br><br>
            <!-- Informacion de perfil -->
            <div class="content_info">
                <div>
                    <span class="title_edit_profile"><b>Actualizar datos personales</b></span>
                    <hr>
                </div>

                <form class="form_profile" id="actualizarDatosFormCredenciales"
                    action="{{ route('estudiantes.updateDatos', ['estudianteId' => $estudiante->estudianteId]) }}"
                    method="POST">
                    @csrf
                    @method('PUT')

                    <div>
                        <label for="firstname_student">Nombres <span class="requerido">*</span></label>
                        <input type="text" id="firstname_student" name="firstname_student" class="form-control input"
                            placeholder="Ingrese sus nombres" value="{{ $estudiante->nombres ?? '' }}">
                        <small id="firstnameError" class="error-message" style="color: red;"></small>
                    </div>

                    <div>
                        <label for="lastname_student">Apellidos <span class="requerido">*</span></label>
                        <input type="text" id="lastname_student" name="lastname_student" class="form-control input"
                            placeholder="Ingrese sus apellidos" value="{{ $estudiante->apellidos ?? '' }}">
                        <small id="lastnameError" class="error-message" style="color: red;"></small>
                    </div>

                    <div>
                        <label for="cohorte_student">Cohorte <span class="requerido">*</span></label>
                        <input type="text" class="form-control input" id="Cohorte" name="Cohorte" readonly
                            value="{{ old('Cohorte', $estudiante->Cohorte ?? '') }}">
                        <small id="cohorteError" class="error-message" style="color: red;"></small>
                    </div>

                    <div>
                        <label for="period_student">Período <span class="requerido">*</span></label>
                        <select class="form-control input input_select" id="Periodo" name="Periodo">
                            <option value="">Seleccione su Periodo</option>
                            @foreach ($periodos as $periodo)
                                <option value="{{ $periodo->id }}" data-numeroPeriodo="{{ $periodo->numeroPeriodo }}"
                                    {{ old('Periodo') == $periodo->id ? 'selected' : '' }}>
                                    {{ $periodo->numeroPeriodo }} {{ $periodo->periodo }}
                                </option>
                            @endforeach
                        </select>
                        <small id="periodoError" class="error-message" style="color: red;"></small>
                    </div>

                    <div>
                        <label for="race_student">Carrera <span class="requerido">*</span></label>
                        <select class="form-control input input_select" id="Carrera" name="Carrera">
                            <option value="">Seleccione su Carrera</option>
                            <option value="Ingeniería en Tecnologías de la información"
                                {{ old('Carrera', $estudiante->carrera ?? '') == 'Ingeniería en Tecnologías de la información' ? 'selected' : '' }}>
                                Tecnologías de la información</option>
                            <option value="Ingeniería en Agropecuaria"
                                {{ old('Carrera', $estudiante->carrera ?? '') == 'Ingeniería en Agropecuaria' ? 'selected' : '' }}>
                                Agropecuaria</option>
                            <option value="Ingeniería en Biotecnologia"
                                {{ old('Carrera', $estudiante->carrera ?? '') == 'Ingeniería en Biotecnologia' ? 'selected' : '' }}>
                                Biotecnologia</option>
                        </select>
                        <small id="carreraError" class="error-message" style="color: red;"></small>
                    </div>

                    <div>
                        <label for="departament_student">Departamento <span class="requerido">*</span></label>
                        <select class="form-control input input_select" id="Departamento" name="Departamento">
                            <option value="">Seleccione su Departamento</option>
                            <option value="Ciencias de la Computación"
                                {{ old('Departamento', $estudiante->departamento ?? '') == 'Ciencias de la Computación' ? 'selected' : '' }}>
                                DCCO - Ciencias de la Computación</option>
                            <option value="Ciencias Exactas"
                                {{ old('Departamento', $estudiante->departamento ?? '') == 'Ciencias Exactas' ? 'selected' : '' }}>
                                DCEX - Ciencias Exactas</option>
                            <option value="Ciencias de la Vida y Agricultura"
                                {{ old('Departamento', $estudiante->departamento ?? '') == 'Ciencias de la Vida y Agricultura' ? 'selected' : '' }}>
                                DCVA - Ciencias de la Vida y Agricultura</option>
                        </select>
                        <small id="departamentoError" class="error-message" style="color: red;"></small>
                    </div>

                    <div class="content_button">
                        <button class="button1 efects_button" type="submit">Actualizar</button>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <br><br>

    <div class="sesion_history">
        <div>
            <span class="title_edit_profile"><b>Control de sesiones</b></span>
            <hr>
        </div>
        <!-- Historial de sesiones -->
        <div class="contenedor_tabla">
            <div class="table-container mat-elevation-z8">
                <div id="tablaProyectos">
                    <table class="mat-mdc-table">
                        <thead class="ng-star-inserted">
                            <tr class="mat-mdc-header-row mdc-data-table__header-row cdk-header-row ng-star-inserted">
                                <th>DISPOSITIVO</th>
                                <th>IP</th>
                                <th>HORA DE INGRESO</th>
                                <th>HORA DE SALIDA</th>
                                <th>UBICACIÓN</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($userSessions as $session)
                                <tr>
                                    <td style="text-transform: uppercase; text-align:center">{{ $session->user_agent }}
                                    </td>
                                    <td style="text-transform: uppercase; text-align:center">{{ $session->ip_address }}
                                    </td>
                                    <td style="text-transform: uppercase; text-align:center">{{ $session->start_time }}
                                    </td>
                                    <td style="text-transform: uppercase; text-align:center">{{ $session->end_time }}</td>
                                    <td>{{ $session->locality }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            function actualizarCohorte() {
                const periodoSelect = document.getElementById('Periodo');
                const cohorteInput = document.getElementById('Cohorte');

                if (periodoSelect.selectedIndex > 0) {
                    const numeroPeriodo = periodoSelect.options[periodoSelect.selectedIndex].getAttribute(
                        'data-numeroPeriodo');
                    cohorteInput.value = numeroPeriodo;
                } else {
                    cohorteInput.value = '';
                }
            }

            document.getElementById('Periodo').addEventListener('change', actualizarCohorte);
        });
    </script>

    <script>
        $(document).ready(function() {
            $('#togglePassword').click(function() {
                var passwordField = $('#password');
                passwordField.attr('type', passwordField.attr('type') === 'password' ? 'text' : 'password');
            });

            $('#toggleConfirmPassword').click(function() {
                var confirmPasswordField = $('#password_confirmation');
                confirmPasswordField.attr('type', confirmPasswordField.attr('type') === 'password' ?
                    'text' : 'password');
            });
        });
    </script>

    <script>
        document.getElementById('changePasswordForm').addEventListener('submit', function(event) {
            // Limpiar mensajes de error previos
            document.getElementById('passwordError').textContent = '';
            document.getElementById('confirmPasswordError').textContent = '';

            const passwordInput = document.getElementById('password');
            const confirmPasswordInput = document.getElementById('password_confirmation');

            const password = passwordInput.value.trim();
            const confirmPassword = confirmPasswordInput.value.trim();

            let formIsValid = true;

            // Verificar que ambos campos estén llenos
            if (password === "") {
                document.getElementById('passwordError').textContent = 'La nueva contraseña es requerida.';
                passwordInput.focus();
                formIsValid = false;
            }

            if (confirmPassword === "") {
                document.getElementById('confirmPasswordError').textContent =
                    'La confirmación de contraseña es requerida.';
                confirmPasswordInput.focus();
                formIsValid = false;
            }

            // Verificar que la contraseña tenga al menos 6 caracteres
            if (password.length > 0 && password.length < 6) {
                document.getElementById('passwordError').textContent =
                    'La contraseña debe tener al menos 6 caracteres.';
                passwordInput.focus();
                formIsValid = false;
            }

            // Verificar que las contraseñas coincidan
            if (password.length >= 6 && password !== confirmPassword) {
                document.getElementById('confirmPasswordError').textContent = 'Las contraseñas no coinciden.';
                confirmPasswordInput.focus();
                formIsValid = false;
            }

            // Si el formulario no es válido, evitar el envío
            if (!formIsValid) {
                event.preventDefault();
            }
        });
    </script>

<script>
   document.getElementById('actualizarDatosFormCredenciales').addEventListener('submit', function(event) {
    // Limpiar mensajes de error previos
    document.getElementById('firstnameError').textContent = '';
    document.getElementById('lastnameError').textContent = '';
    document.getElementById('cohorteError').textContent = '';
    document.getElementById('periodoError').textContent = '';
    document.getElementById('carreraError').textContent = '';
    document.getElementById('departamentoError').textContent = '';

    // Obtener los elementos del formulario
    const firstname = document.getElementById('firstname_student').value.trim();
    const lastname = document.getElementById('lastname_student').value.trim();
    const cohorte = document.getElementById('Cohorte').value.trim();
    const periodo = document.getElementById('Periodo').value.trim();
    const carrera = document.getElementById('Carrera').value.trim();
    const departamento = document.getElementById('Departamento').value.trim();

    let formIsValid = true;

    // Validación de campos requeridos
    if (firstname === "") {
        document.getElementById('firstnameError').textContent = 'El nombre es requerido.';
        formIsValid = false;
    }

    if (lastname === "") {
        document.getElementById('lastnameError').textContent = 'El apellido es requerido.';
        formIsValid = false;
    }

    if (cohorte === "") {
        document.getElementById('cohorteError').textContent = 'El cohorte es requerido.';
        formIsValid = false;
    }

    if (periodo === "") {
        document.getElementById('periodoError').textContent = 'El periodo es requerido.';
        formIsValid = false;
    }

    if (carrera === "") {
        document.getElementById('carreraError').textContent = 'La carrera es requerida.';
        formIsValid = false;
    }

    if (departamento === "") {
        document.getElementById('departamentoError').textContent = 'El departamento es requerido.';
        formIsValid = false;
    }

    // Si el formulario no es válido, evitar el envío
    if (!formIsValid) {
        event.preventDefault();
    }
});

// Funciones para eliminar el error cuando el usuario comienza a escribir
document.getElementById('firstname_student').addEventListener('input', function() {
    document.getElementById('firstnameError').textContent = '';
});

document.getElementById('lastname_student').addEventListener('input', function() {
    document.getElementById('lastnameError').textContent = '';
});

document.getElementById('Cohorte').addEventListener('input', function() {
    document.getElementById('cohorteError').textContent = '';
});

document.getElementById('Periodo').addEventListener('input', function() {
    document.getElementById('periodoError').textContent = '';
});

document.getElementById('Carrera').addEventListener('input', function() {
    document.getElementById('carreraError').textContent = '';
});

document.getElementById('Departamento').addEventListener('input', function() {
    document.getElementById('departamentoError').textContent = '';
});

</script>

@endsection
