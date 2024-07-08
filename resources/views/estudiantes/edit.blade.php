@extends('layouts.app')

@section('title', 'Editar Datos del Estudiante')

@section('title_component', 'Información del Estudiante')


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

<form method="POST" action="{{ route('estudiantes.update', ['estudiante' => $estudiante->estudianteId]) }}" class="custom-form">
    @csrf
    @method('PUT')
    <div class="row">
        <div class="col-md-4">
            <!-- Primera columna -->
            <div class="form-group">
                <label for="Nombres">Nombres:</label>
                <input id="Nombres" type="text" class="form-control input" name="Nombres" value="{{ $estudiante->nombres }}" required autofocus placeholder="Ingrese sus Nombres" pattern="[A-Za-zÁ-úñÑ\s]+" title="Ingrese solo letras (sin caracteres especiales)">
                <small id="error-message-name" style="color: red; display: none;">Debe ingresar solo caracteres</small>
            </div>
            <div class="form-group">
                <label for="celular">Celular:</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text input">+593</span>
                    </div>
                    <input id="celular" type="text" class="form-control input" name="celular" value="{{ $estudiante->celular }}" required placeholder="Ingrese su número de celular">
                </div>
                <small id="error-message-cell" style="color: red; display: none;">Número de celular no válido</small>
            </div>
            <div class="form-group">
                <label for="Periodo">Periodo:</label>
                <select class="form-control input input-select" id="Periodo" name="Periodo" required>
                    @foreach ($periodos as $periodo)
                        <option value="{{ $periodo->id }}">{{ $periodo->numeroPeriodo }} {{ $periodo->periodo }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="col-md-4">
            <!-- Segunda columna -->
            <div class="form-group">
                <label for="Apellidos">Apellidos:</label>
                <input id="Apellidos" type="text" class="form-control input" name="Apellidos" value="{{ $estudiante->apellidos }}" required placeholder="Ingrese sus Apellidos" pattern="[A-Za-zÁ-úñÑ\s]+" title="Ingrese solo letras (sin caracteres especiales)">
                <small id="error-message-apellidos" style="color: red; display: none;">Debe ingresar solo caracteres</small>
            </div>
            <div class="form-group">
                <label for="Carrera">Carrera:</label>
                <select class="form-control input input_select" id="Carrera" name="Carrera" required>
                    <option value="">Seleccione su Carrera</option>
                    <option value="Ingeniería en Tecnologías de la información" @if ($estudiante->carrera == 'Ingeniería en Tecnologías de la información') selected @endif>Ingeniería en Tecnologías de la información</option>
                    <option value="Ingeniería en Agropecuaria" @if ($estudiante->carrera == 'Ingeniería en Agropecuaria') selected @endif>Ingeniería en Agropecuaria</option>
                    <option value="Ingeniería en Biotecnologia" @if ($estudiante->carrera == 'Ingeniería en Biotecnologia') selected @endif>Ingeniería en Biotecnologia</option>
                </select>
            </div>
            <div class="form-group">
                <label for="Departamento">Departamento:</label>
                <select class="form-control input input_select" id="Departamento" name="Departamento" required>
                    <option value="">Seleccione su Departamento</option>
                    <option value="Ciencias de la Computación" @if ($estudiante->departamento == 'Ciencias de la Computación') selected @endif>DCCO - Ciencias de la Computación</option>
                    <option value="Ciencias Exactas" @if ($estudiante->departamento == 'Ciencias Exactas') selected @endif>DCEX - Ciencias Exactas</option>
                    <option value="Ciencias de la Vida y Agricultura" @if ($estudiante->departamento == 'Ciencias de la Vida y Agricultura') selected @endif>DCVA - Ciencias de la Vida y Agricultura</option>
                </select>
            </div>
        </div>

        <div class="col-md-4">
            <!-- Tercera columna con dos sub-columnas -->
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="espe_id">ESPE ID:</label>
                        <input id="espe_id" type="text" class="form-control input" name="espe_id" value="{{ $estudiante->espeId }}" required placeholder="Ingrese su ESPE ID">
                        <small id="espe_id_error" class="form-text text-danger" style="display: none;">El ESPE ID es de 9 caracteres.</small>

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
                    <option value="Santo Domingo" @if ($estudiante->provincia == 'Santo Domingo') selected @endif>Santo Domingo</option>
                    <option value="Luz de America" @if ($estudiante->provincia == 'Luz de America') selected @endif>Luz de America</option>
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
