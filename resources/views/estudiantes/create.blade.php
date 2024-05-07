@extends('layouts.registro')

@section('title', 'Ingresar Datos del Estudiante')


@section('content')

<div class="mat-elevation-z8 contenedor_general">
    <div class="container mt-3">
        <h6 class="text-center"><b>Ingresar Datos del Estudiante</b></h6>
        <hr>

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

        <form method="POST" action="{{ route('estudiantes.store') }}" class="custom-form">
            @csrf

            <div class="form-column">
                <div class="form-group">
                    <label for="Nombres">Nombres:</label>
                    <input id="Nombres" type="text" class="form-control input" name="Nombres" required autofocus
                        placeholder="Ingrese sus Nombres" pattern="[A-Za-zÁ-úñÑ\s]+"
                        title="Ingrese solo letras (sin caracteres especiales)">
                </div>

                <div class="form-group">
                    <label for="Apellidos"> Apellidos:</label>
                    <input id="Apellidos" type="text" class="form-control input" name="Apellidos" required
                        placeholder="Ingrese sus Apellidos" pattern="[A-Za-zÁ-úñÑ\s]+"
                        title="Ingrese solo letras (sin caracteres especiales)">
                </div>

                <div class="form-group">
                    <label for="espe_id"> ESPE ID:</label>
                    <input id="espe_id" type="text" class="form-control input" name="espe_id" required
                        placeholder="Ingrese su ESPE ID">
                </div>

                <div class="form-group">
                    <label for="celular">Celular:</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text input">+593</span>
                        </div>
                        <input id="celular" type="text" class="form-control input" name="celular" required
                            pattern="[0-9]{10}" placeholder="Ingrese su número de celular (10 dígitos)">
                    </div>
                </div>

                <div class="form-group">
                    <label for="cedula">Cédula:</label>
                    <input id="cedula" type="text" class="form-control input" name="cedula" required pattern="[0-9]{10}"
                        title="Ingrese un número de cédula válido (10 dígitos)"
                        placeholder="Ingrese su número de cédula (10 dígitos)">
                </div>
            </div>
            <div class="form-column">
                <div class="form-group">
                    <label for="Cohorte"> Cohorte:</label>
                    <select class="form-control input input-select" id="Cohorte" name="Cohorte" required>
                        <option value="">Seleccione su Cohorte</option>
                        @foreach ($periodos as $periodo)
                        <option value="{{ $periodo->numeroPeriodo }}">{{ $periodo->numeroPeriodo }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="Periodo">Periodo:</label>
                    <select class="form-control input input-select" id="Periodo" name="Periodo" required>
                        <option value="">Seleccione su Periodo</option>
                        @foreach ($periodos as $periodo)
                        <option value="{{ $periodo->id }}">{{ $periodo->numeroPeriodo }} {{ $periodo->Periodo }}
                        </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="Carrera">Carrera:</label>
                    <select class="form-control input input-select" id="Carrera" name="Carrera" required>
                        <option value="">Seleccione su Carrera</option>
                        <option value="Ingeniería en Tecnologías de la información">Ingeniería en Tecnologías de la
                            información
                        </option>
                        <option value="Ingeniería en Agropecuaria">Ingeniería en Agropecuaria</option>
                        <option value="Ingeniería en Biotecnologia">Ingeniería en Biotecnologia</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="Provincia">Localidad:</label>
                    <select class="form-control input input-select" id="Provincia" name="Provincia" required>
                        <option value="">Seleccione su Localidad</option>
                        <option value="Santo Domingo">Santo Domingo</option>
                        <option value="Luz de America">Luz de America</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="Departamento">Departamento:</label>
                    <select class="form-control input input-select" id="Departamento" name="Departamento" required>
                        <option value="">Seleccione su Departamento</option>
                        <option value="Ciencias de la Computación">DCCO - Departamento de Computación</option>
                        <option value="Ciencias Exactas">DCEX - Ciencias Exactas</option>
                        <option value="Ciencias de la Vida y Agricultura">DCVA - Departamento de Ciencias de la Vida y
                            Agricultura</option>
                    </select>
                </div>
            </div>
            <div class="button-container">
                <button type="submit" class="button efects_button">Guardar Datos</button>
            </div>

        </form>

    </div>
</div>
@endsection