@extends('layouts.registro')

@section('title', 'Ingresar Datos del Estudiante')

@section('content')

    <div class="mat-elevation-z8 contenedor_general">
        <div class="container mt-3">
            <h3 class="text-center"><b>Validar Datos del Estudiante</b></h3>
            <hr>

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
            <div class="container-fluid">

                <form method="POST" action="{{ route('estudiantes.store') }}" class="custom-form">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-4">
                            <!-- Primera columna -->
                            <div class="form-group">
                                <label for="Nombres">Nombres:</label>
                                <input id="Nombres" type="text" class="form-control input" name="Nombres" required
                                    autofocus placeholder="Ingrese sus Nombres" pattern="[A-Za-zÁ-úñÑ\s]+"
                                    title="Ingrese solo letras (sin caracteres especiales)"
                                    value="{{ old('Nombres', $estudiante->nombres ?? '') }}">
                                <small id="error-message-name" style="color: red; display: none;">Debe ingresar solo
                                    caracteres</small>
                                @error('Nombres')
                                    <small style="color: red;">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="espe_id">ESPE ID:</label>
                                        <input id="espe_id" type="text" class="form-control input" name="espe_id"
                                            required placeholder="Ingrese su ESPE ID"
                                            value="{{ old('espe_id', $estudiante->espeId ?? '') }}">
                                        <small id="espe_id_error" class="form-text text-danger" style="display: none;">El
                                            ESPE ID es de 9 caracteres.</small>
                                        @error('espe_id')
                                            <small style="color: red;">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="Cohorte">Cohorte:</label>
                                        <input type="text" class="form-control input" id="Cohorte" name="Cohorte"
                                            readonly value="{{ old('Cohorte', $estudiante->Cohorte ?? '') }}">
                                        @error('Cohorte')
                                            <small style="color: red;">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md">
                                    <div class="form-group">
                                        <label for="correo">Correo:</label>
                                        <input id="correo" type="email" class="form-control input" name="correo"
                                            required placeholder="Ingrese su correo electrónico"
                                            value="{{ old('correo', $estudiante->correo ?? '') }}">
                                        <small id="error-message-email" style="color: red; display: none;">Correo no
                                            válido</small>
                                        @error('correo')
                                            <small style="color: red;">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>



                            </div>
                        </div>

                        <div class="col-md-4">
                            <!-- Segunda columna -->
                            <div class="form-group">
                                <label for="Apellidos">Apellidos:</label>
                                <input id="Apellidos" type="text" class="form-control input" name="Apellidos" required
                                    placeholder="Ingrese sus Apellidos" pattern="[A-Za-zÁ-úñÑ\s]+"
                                    title="Ingrese solo letras (sin caracteres especiales)"
                                    value="{{ old('Apellidos', $estudiante->apellidos ?? '') }}">
                                <small id="error-message-apellidos" style="color: red; display: none;">Debe ingresar solo
                                    caracteres</small>
                                @error('Apellidos')
                                    <small style="color: red;">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="Carrera">Carrera:</label>
                                <select class="form-control input input_select" id="Carrera" name="Carrera" required>
                                    <option value="">Seleccione su Carrera</option>
                                    <option value="Tecnologías de la información"
                                        {{ old('Carrera', $estudiante->carrera ?? '') == 'Tecnologías de la información' ? 'selected' : '' }}>
                                        Tecnologías de la información</option>
                                    <option value="Agropecuaria"
                                        {{ old('Carrera', $estudiante->carrera ?? '') == 'Agropecuaria' ? 'selected' : '' }}>
                                        Agropecuaria</option>
                                    <option value="Biotecnologia"
                                        {{ old('Carrera', $estudiante->carrera ?? '') == 'Biotecnologia' ? 'selected' : '' }}>
                                        Biotecnologia</option>
                                </select>
                                @error('Carrera')
                                    <small style="color: red;">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="departamento">Seleccione el departamento al que
                                    pertenece:</label>
                                <select id="departamento" name="departamento" class="form-control input_select input">
                                    <option value="">Seleccione un
                                        departamento</option>
                                    @foreach ($departamentos as $departamento)
                                        <option value="{{ $departamento->departamento }}"
                                            data-nombre="{{ $departamento->departamento }}">
                                            {{ $departamento->departamento }}
                                        </option>
                                    @endforeach
                                </select>

                            </div>
                        </div>

                        <div class="col-md-4">
                            <!-- Tercera columna con dos sub-columnas -->
                            <div class="form-group">
                                <label for="Periodo">Periodo de ingreso:</label>
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
                                @error('Periodo')
                                    <small style="color: red;">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="cedula">Cédula:</label>
                                <input id="cedula" type="text" class="form-control input" name="cedula" required
                                    pattern="[0-9]{10}" title="Ingrese un número de cédula válido (10 dígitos)"
                                    placeholder="Ingrese su número de cédula (10 dígitos)"
                                    value="{{ old('cedula', $estudiante->cedula ?? '') }}" readonly>
                                <small id="error-message" style="color: red; display: none;">Cédula no válida</small>
                                @error('cedula')
                                    <small style="color: red;">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="celular">Celular:</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text input">+593</span>
                                    </div>
                                    <input id="celular" type="text" class="form-control input" name="celular"
                                        required placeholder="Ingrese su número de celular"
                                        value="{{ old('celular', $estudiante->celular ?? '') }}">
                                </div>
                                <small id="error-message-cell" style="color: red; display: none;">Número de celular no
                                    válido</small>
                                @error('celular')
                                    <small style="color: red;">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <br>

                    <div class="button-container">
                        <button type="submit" class="button1 efects_button">Guardar Datos</button>
                    </div>
                    <br>
                </form>
            </div>
        </div>
    </div>

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
@endsection
