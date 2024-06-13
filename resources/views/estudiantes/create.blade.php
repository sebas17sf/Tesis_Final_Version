@extends('layouts.registro')

@section('title', 'Ingresar Datos del Estudiante')


@section('content')

    <div class="mat-elevation-z8 contenedor_general">
        <div class="container mt-3">
            <h3 class="text-center"><b>Ingresar Datos del Estudiante</b></h3>
            <hr>

            @if (session('success'))
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'Éxito',
                    text: '{{ session('success ') }}',
                    confirmButtonText: 'Ok'
                });
            </script>
            @endif

            @if (session('error'))
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: '{{ session('error ') }}',
                    confirmButtonText: 'Ok'
                });
            </script>
            @endif
            <div class="container-fluid">


            <form method="POST" action="{{ route('estudiantes.store') }}" class="custom-form">
    @csrf
    <div class="row">
        <div class="col-md-4">
            <!-- Primera columna -->
            <div class="form-group">
                <label for="Nombres">Nombres:</label>
                <input id="Nombres" type="text" class="form-control input" name="Nombres" required autofocus placeholder="Ingrese sus Nombres" pattern="[A-Za-zÁ-úñÑ\s]+" title="Ingrese solo letras (sin caracteres especiales)">
                <small id="error-message-name" style="color: red; display: none;">Debe ingresar solo caracteres</small>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="espe_id">ESPE ID:</label>
                        <input id="espe_id" type="text" class="form-control input" name="espe_id" required placeholder="Ingrese su ESPE ID">
                        <small id="espe_id_error" class="form-text text-danger" style="display: none;">El ESPE ID es de 9 caracteres.</small>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="Cohorte">Cohorte:</label>
                        <input type="text" class="form-control input" id="Cohorte" name="Cohorte" readonly>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="celular">Celular:</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text input">+593</span>
                    </div>
                    <input id="celular" type="text" class="form-control input" name="celular" required placeholder="Ingrese su número de celular">
                </div>
                <small id="error-message-cell" style="color: red; display: none;">Número de celular no válido</small>
            </div>
            
        </div>

        <div class="col-md-4">
            <!-- Segunda columna -->
            <div class="form-group">
                <label for="Apellidos">Apellidos:</label>
                <input id="Apellidos" type="text" class="form-control input" name="Apellidos" required placeholder="Ingrese sus Apellidos" pattern="[A-Za-zÁ-úñÑ\s]+" title="Ingrese solo letras (sin caracteres especiales)">
                <small id="error-message-apellidos" style="color: red; display: none;">Debe ingresar solo caracteres</small>
            </div>
            <div class="form-group">
                <label for="Carrera">Carrera:</label>
                <select class="form-control input input_select" id="Carrera" name="Carrera" required>
                    <option value="">Seleccione su Carrera</option>
                    <option value="Ingeniería en Tecnologías de la información">Tecnologías de la información</option>
                    <option value="Ingeniería en Agropecuaria">Agropecuaria</option>
                    <option value="Ingeniería en Biotecnologia">Biotecnologia</option>
                </select>
            </div>
            <div class="form-group">
                                <label for="Departamento">Departamento:</label>
                                <select class="form-control input input_select" id="Departamento" name="Departamento"
                                    required>
                                    <option value="">Seleccione su Departamento</option>
                                    <option value="Ciencias de la Computación">DCCO - Ciencias de la Computación</option>
                                    <option value="Ciencias Exactas">DCEX - Ciencias Exactas</option>
                                    <option value="Ciencias de la Vida y Agricultura">DCVA - Ciencias de la
                                        Vida y
                                        Agricultura</option>
                                </select>
                            </div>
        </div>

        <div class="col-md-4">
            <!-- Tercera columna con dos sub-columnas -->
            <div class="form-group">
                <label for="Periodo">Periodo:</label>
                <select class="form-control input input_select" id="Periodo" name="Periodo" required>
                    <option value="">Seleccione su Periodo</option>
                    @foreach ($periodos as $periodo)
                    <option value="{{ $periodo->id }}" data-numero="{{ $periodo->numeroPeriodo }}">{{ $periodo->numeroPeriodo }} {{ $periodo->periodo }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="cedula">Cédula:</label>
                <input id="cedula" type="text" class="form-control input" name="cedula" required pattern="[0-9]{10}" title="Ingrese un número de cédula válido (10 dígitos)" placeholder="Ingrese su número de cédula (10 dígitos)">
                <small id="error-message" style="color: red; display: none;">Cédula no válida</small>
            </div>

            <div class="form-group">
                <label for="Provincia">Localidad:</label>
                <select class="form-control input input_select" id="Provincia" name="Provincia" required>
                    <option value="">Seleccione su Localidad</option>
                    <option value="Santo Domingo">Santo Domingo</option>
                    <option value="Luz de America">Luz de America</option>
                </select>
            </div>
        </div>
    </div>

    <div class="button-container">
        <button type="submit" class="button1 efects_button">Guardar Datos</button>
    </div>
    <br>
</form>



            </div>
        </div>
    </div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var periodoSelect = document.getElementById('Periodo');
        var cohorteInput = document.getElementById('Cohorte');

        // Evento para actualizar el valor del input de Cohorte al cambiar el Periodo seleccionado
        periodoSelect.addEventListener('change', function () {
            var selectedOption = periodoSelect.options[periodoSelect.selectedIndex];
            var numeroPeriodo = selectedOption.getAttribute('data-numero');
            cohorteInput.value = numeroPeriodo;
        });

        // Disparar el evento inicialmente para mostrar el valor del primer Periodo seleccionado, si lo hay
        if (periodoSelect.selectedIndex !== -1) {
            var selectedOption = periodoSelect.options[periodoSelect.selectedIndex];
            var numeroPeriodo = selectedOption.getAttribute('data-numero');
            cohorteInput.value = numeroPeriodo;
        }
    });
</script>
@endsection
