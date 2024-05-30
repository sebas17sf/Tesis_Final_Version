@extends('layouts.app')

@section('title', 'Editar Datos del Estudiante')

@section('title_component', 'Información del Estudiante')


@section('content')

    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Éxito',
                text: '{{ session('success') }}',
                confirmButtonText: 'Ok'
            });
        </script>
    @endif

    @if (session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: '{{ session('error') }}',
                confirmButtonText: 'Ok'
            });
        </script>
    @endif

    <div class="mat-elevation-z8 contenedor_general">
    <div class="container mt-3">
        <h3 class="text-center"><b>Editar Datos del Estudiante</b></h3>
        <hr>

        <div class="container-fluid">

<form method="POST" action="{{ route('estudiantes.update', ['estudiante' => $estudiante->EstudianteID]) }}" class="custom-form">
    @csrf
    @method('PUT')
    <div class="row">
        <div class="col-md-4">
            <!-- Primera columna -->
            <div class="form-group">
                <label for="Nombres">Nombres:</label>
                <input id="Nombres" type="text" class="form-control input" name="Nombres" value="{{ $estudiante->Nombres }}" required autofocus placeholder="Ingrese sus Nombres" pattern="[A-Za-zÁ-úñÑ\s]+" title="Ingrese solo letras (sin caracteres especiales)">
                <span id="error-message-name" style="color: red; display: none;">Debe ingresar solo caracteres</span>
            </div>
            <div class="form-group">
                <label for="celular">Celular:</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text input">+593</span>
                    </div>
                    <input id="celular" type="text" class="form-control input" name="celular" value="{{ $estudiante->celular }}" required placeholder="Ingrese su número de celular">
                </div>
                <span id="error-message-cell" style="color: red; display: none;">Número de celular no válido</span>
            </div>
            <div class="form-group">
                <label for="Periodo">Periodo:</label>
                <select class="form-control input input-select" id="Periodo" name="Periodo" required>
                    @foreach ($periodos as $periodo)
                        <option value="{{ $periodo->id }}">{{ $periodo->numeroPeriodo }} {{ $periodo->Periodo }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="col-md-4">
            <!-- Segunda columna -->
            <div class="form-group">
                <label for="Apellidos">Apellidos:</label>
                <input id="Apellidos" type="text" class="form-control input" name="Apellidos" value="{{ $estudiante->Apellidos }}" required placeholder="Ingrese sus Apellidos" pattern="[A-Za-zÁ-úñÑ\s]+" title="Ingrese solo letras (sin caracteres especiales)">
                <span id="error-message-apellidos" style="color: red; display: none;">Debe ingresar solo caracteres</span>
            </div>
            <div class="form-group">
                <label for="Carrera">Carrera:</label>
                <select class="form-control input input_select" id="Carrera" name="Carrera" required>
                    <option value="">Seleccione su Carrera</option>
                    <option value="Ingeniería en Tecnologías de la información" @if ($estudiante->Carrera == 'Ingeniería en Tecnologías de la información') selected @endif>Ingeniería en Tecnologías de la información</option>
                    <option value="Ingeniería en Agropecuaria" @if ($estudiante->Carrera == 'Ingeniería en Agropecuaria') selected @endif>Ingeniería en Agropecuaria</option>
                    <option value="Ingeniería en Biotecnologia" @if ($estudiante->Carrera == 'Ingeniería en Biotecnologia') selected @endif>Ingeniería en Biotecnologia</option>
                </select>
            </div>
            <div class="form-group">
                <label for="Departamento">Departamento:</label>
                <select class="form-control input input_select" id="Departamento" name="Departamento" required>
                    <option value="">Seleccione su Departamento</option>
                    <option value="Ciencias de la Computación" @if ($estudiante->Departamento == 'Ciencias de la Computación') selected @endif>DCCO - Ciencias de la Computación</option>
                    <option value="Ciencias Exactas" @if ($estudiante->Departamento == 'Ciencias Exactas') selected @endif>DCEX - Ciencias Exactas</option>
                    <option value="Ciencias de la Vida y Agricultura" @if ($estudiante->Departamento == 'Ciencias de la Vida y Agricultura') selected @endif>DCVA - Ciencias de la Vida y Agricultura</option>
                </select>
            </div>
        </div>

        <div class="col-md-4">
            <!-- Tercera columna con dos sub-columnas -->
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="espe_id">ESPE ID:</label>
                        <input id="espe_id" type="text" class="form-control input" name="espe_id" value="{{ $estudiante->espe_id }}" required placeholder="Ingrese su ESPE ID">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="Cohorte">Cohorte:</label>
                        <select class="form-control input input_select" id="Cohorte" name="Cohorte" required >
                            <option value="">Seleccione su Cohorte</option>
                            @foreach ($periodos as $periodo)
                                <option value="{{ $periodo->numeroPeriodo }}" @if ($periodo->numeroPeriodo == $estudiante->Cohorte) selected @endif>{{ $periodo->numeroPeriodo }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="cedula">Cédula:</label>
                <input id="cedula" type="text" class="form-control input" name="cedula" value="{{ $estudiante->cedula }}" required pattern="[0-9]{10}" title="Ingrese un número de cédula válido (10 dígitos)" placeholder="Ingrese su número de cédula (10 dígitos)">
                <span id="error-message" style="color: red; display: none;">Cédula no válida</span>
            </div>

            <div class="form-group">
                <label for="Provincia">Localidad:</label>
                <select class="form-control input input_select" id="Provincia" name="Provincia" required>
                    <option value="">Seleccione su Localidad</option>
                    <option value="Santo Domingo" @if ($estudiante->Provincia == 'Santo Domingo') selected @endif>Santo Domingo</option>
                    <option value="Luz de America" @if ($estudiante->Provincia == 'Luz de America') selected @endif>Luz de America</option>
                </select>
            </div>
        </div>
    </div>

    <div class="button-container text-center">
        <button type="submit" class="button1 efects_button">Guardar Datos</button>
    </div>
    <br>
</form>
</div>
</div>
</div>   
@endsection
