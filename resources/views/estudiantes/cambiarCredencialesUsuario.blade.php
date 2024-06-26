@extends('layouts.app')

@section('title', 'Configuracion de Usuario')

@section('title_component', 'Credenciales de Usuario')

@section('content')

    @if (session('success'))
        <div class="contenedor_alerta success">
            <div class="icon_alert"><i class="fa-regular fa-check"></i></div>
            <div class="content_alert">
                <div class="title">Éxito!</div>
                <div class="body">{{ session('success') }}</div>
            </div>
            <div class="icon_remove">
                <button class="button4 btn_3_2"><i class="fa-regular fa-xmark"></i></button>
            </div>
        </div>

        <script>
            document.querySelector('.contenedor_alerta .icon_remove button').addEventListener('click', function() {
                this.closest('.contenedor_alerta').style.display = 'none';
            });
        </script>
    @endif


    @if (session('error'))
        <div class="contenedor_alerta error">
            <div class="icon_alert"><i class="fa-regular fa-xmark"></i></div>
            <div class="content_alert">
                <div class="title">Error!</div>
                <div class="body">{{ session('error') }}</div>
            </div>
            <div class="icon_remove">
                <button class="button4 btn_3_2"><i class="fa-regular fa-xmark"></i></button>
            </div>
        </div>

        <script>
            document.querySelector('.contenedor_alerta.error .icon_remove button').addEventListener('click', function() {
                this.closest('.contenedor_alerta').style.display = 'none';
            });
        </script>
    @endif
    <section class="content_profile">

        <div class="section1">
            <!-- Informacion estatica -->
            <div class="content_static">

                <div>
                    <span class="title_edit_profile"><b>Información personal</b>
                    </span>
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
                        <label for= "nombre">Usuario</label>
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
                    <span class="title_edit_profile"><b>Cambiar contraseña</b>

                        <!-- Informacion sobre los datos -->
                        <div class="info-icon">
                            <i class="fa-regular fa-circle-info"></i>
                        </div>
                    </span>
                    <hr>
                </div>

                <form class="form_change_passwd" action="{{ route('estudiantes.actualizarCredenciales', ['userId' => auth()->user()->userId]) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div>
                        <label for="password">Nueva contraseña <span class="requerido">*</span></label>
                        <input type="password" id="password" name="password" class="input" placeholder="Ingrese la clave" required>
                    </div>

                    <div>
                        <label for="password_confirmation">Confirmar contraseña <span class="requerido">*</span></label>
                        <input type="password" id="password_confirmation" name="password_confirmation" class="input" placeholder="Ingrese de nuevo la clave" required>
                    </div>

                    <div class="content_button">
                        <button class="button1 efects_button" type="submit">Actualizar</button>
                    </div>
                </form>

            </div>


        </div>


        <div>
            <!-- Informacion de perfil -->
            <div class="content_info">
                <div>
                    <span class="title_edit_profile"><b>Actualizar datos personales</b>

                        <!-- Informacion sobre los datos -->
                        <div class="info-icon">
                            <i class="fa-regular fa-circle-info"></i>
                        </div>
                    </span>
                    <hr>
                </div>

                <form class="form_profile" action="{{ route('estudiantes.updateDatos', ['estudianteId' => $estudiante->estudianteId]) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div>
                        <label for="firstname_student">Nombres <span class="requerido">*</span></label>
                        <input type="text" id="firstname_student" name="firstname_student" class="input" placeholder="Ingrese sus nombres" value="{{ $estudiante->nombres ?? '' }}" required>
                    </div>

                    <div>
                        <label for="lastname_student">Apellidos <span class="requerido">*</span></label>
                        <input type="text" id="lastname_student" name="lastname_student" class="input" placeholder="Ingrese sus apellidos" value="{{ $estudiante->apellidos ?? '' }}" required>
                    </div>

                    <div>
                        <label for="cohorte_student">Cohorte <span class="requerido">*</span></label>
                        <input type="text" class="form-control input" id="Cohorte" name="Cohorte"
                        readonly value="{{ old('Cohorte', $estudiante->Cohorte ?? '') }}">                    </div>

                    <div>
                        <label for="period_student">Período <span class="requerido">*</span></label>
                        <select class="form-control input input_select" id="Periodo" name="Periodo" required>
                            <option value="">Seleccione su Periodo</option>
                            @foreach ($periodos as $periodo)
                                <option value="{{ $periodo->id }}"
                                    data-numeroPeriodo="{{ $periodo->numeroPeriodo }}"
                                    {{ old('Periodo') == $periodo->id ? 'selected' : '' }}>
                                    {{ $periodo->numeroPeriodo }} {{ $periodo->periodo }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="race_student">Carrera <span class="requerido">*</span></label>
                        <select class="form-control input input_select" id="Carrera" name="Carrera" required>
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
                    </div>

                    <div>
                        <label for="departament_student">Departamento <span class="requerido">*</span></label>
                        <select class="form-control input input_select" id="Departamento" name="Departamento"
                        required>
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
                    </div>



                    <div class="content_button">
                        <button class="button1 efects_button" type="submit">Actualizar</button>
                    </div>

                </form>
            </div>
        </div>

        <!-- Historial de sesiones -->
        <!-- Historial de sesiones -->
        <div class="sesion_history scroll_element">
            @foreach ($userSessions as $session)
                <div class="card">
                    <div class="icon_card">
                        <i class="fa-regular fa-laptop-mobile"></i>
                    </div>

                    <div class="dispositive">
                        <span class="agente_usuario">{{ $session->browser }}</span>
                        <div>
                            <label>IP:</label>
                            <span class="text_sesion">{{ $session->ip_address }}</span>
                        </div>
                    </div>

                    <div class="time_sesion">
                        <div class="data_time">
                            <label>Hora ingreso</label>
                            <span class="text_sesion">{{ $session->start_time }}</span>
                        </div>

                        <div class="data_time">
                            <label>Hora salida</label>
                            <span class="text_sesion">{{ $session->end_time }}</span>
                        </div>
                    </div>

                    <div class="location">
                        <label>Ubicación</label>
                        <span class="text_sesion">{{ $session->locality }}</span>
                    </div>

                </div>
            @endforeach
        </div>

    </section>
    <!--
            <form action="{{ route('admin.updateCredenciales') }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="nombre">Usuario</label>
                    <input type="text" class="form-control input" id="nombre" name="nombre" value="{{ $usuario->nombreUsuario }}"
                        required>
                </div>
                <div class="form-group">
                    <label for="email">Correo Electrónico</label>
                    <input type="email" class="form-control input" id="email" name="email"
                        value="{{ $usuario->correoElectronico }}" required>
                </div>
                <div class="form-group">
                    <label for="password">Nueva Contraseña</label>
                    <div class="input-group">
                        <input type="password" class="form-control input" id="password" name="password" required>
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                <i class="fa fa-eye" aria-hidden="true"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="password_confirmation">Confirmar Nueva Contraseña</label>
                    <div class="input-group">
                        <input type="password" class="form-control input" id="password_confirmation" name="password_confirmation"
                            required>
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary" type="button" id="toggleConfirmPassword">
                                <i class="fa fa-eye" aria-hidden="true"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <button type="submit" class="button">Guardar Cambios</button>
            </form>

        -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            function actualizarCohorte() {
                const periodoSelect = document.getElementById('Periodo');
                const cohorteInput = document.getElementById('Cohorte');

                // Verifica si hay un periodo seleccionado
                if (periodoSelect.selectedIndex > 0) {
                    // Lee el atributo data-numeroPeriodo del periodo seleccionado
                    const numeroPeriodo = periodoSelect.options[periodoSelect.selectedIndex].getAttribute(
                        'data-numeroPeriodo');
                    // Actualiza el valor de Cohorte con el numeroPeriodo
                    cohorteInput.value = numeroPeriodo;
                } else {
                    // Si no hay selección, limpia el campo Cohorte
                    cohorteInput.value = '';
                }
            }

            // Evento para actualizar Cohorte cuando se cambia la selección de Periodo
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








@endsection
