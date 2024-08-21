@extends('layouts.coordinador')

@section('title', 'Editar Proyecto')

@section('title_component', 'Panel Editar Proyecto')

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
        @section('content')
<div class="mat-elevation-z8">
    <div class="card" style="margin: auto; max-width: 800px; box-shadow: 0 6px 10px 0 rgba(64, 69, 108, 0.6); transition: 0.5s;">
        <div class="card-body" style="padding: 1rem; text-align: center;">
            <h4><b>Editar Proyecto</b></h4>
            <hr>
            <form id="editarProyectos" action="{{ route('coordinador.updateProyecto', ['proyectoId' => $proyecto->proyectoId]) }}" method="POST" style="display: inline-block; width: 100%; max-width: 600px;">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="codigoProyecto">Ingrese código del proyecto:</label>
                            <input type="text" value="{{ $proyecto->codigoProyecto }}" id="codigoProyecto" name="codigoProyecto" class="form-control input" placeholder="Ingrese el código del proyecto. Si no, déjelo vacío">
                            <small id="codigoProyectoError" class="form-text text-danger" style="display: none;">Este campo es obligatorio.</small>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="NombreProyecto">Nombre del Proyecto:</label>
                            <textarea type="text" class="form-control input" id="NombreProyecto" rows="4" name="NombreProyecto" required>{{ $proyecto->nombreProyecto }}</textarea>
                            <small id="NombreProyectoError" class="form-text text-danger" style="display: none;">Este campo es obligatorio.</small>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="DirectorProyecto">Director del Proyecto:</label>
                            <select name="DirectorProyecto" id="DirectorProyecto" class="form-control input input-select" required>
                                <option value="">Seleccionar Director</option>
                                @foreach ($profesores as $profesor)
                                    <option value="{{ $profesor->id }}" {{ $proyecto->directorId === $profesor->id ? 'selected' : '' }}>
                                        {{ $profesor->apellidos }} {{ $profesor->nombres }} - {{ $profesor->departamento->departamento }} - {{ $profesor->correo }}
                                    </option>
                                @endforeach
                            </select>
                            <small id="DirectorProyectoError" class="form-text text-danger" style="display: none;">Este campo es obligatorio.</small>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="DescripcionProyecto">Descripción del Proyecto:</label>
                            <textarea class="form-control input" id="DescripcionProyecto" name="DescripcionProyecto" rows="4" required>{{ $proyecto->descripcionProyecto }}</textarea>
                            <small id="DescripcionProyectoError" class="form-text text-danger" style="display: none;">Este campo es obligatorio.</small>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="DepartamentoTutor">Departamento:</label>
                            <select id="DepartamentoTutor" name="DepartamentoTutor" class="form-control input_select input">
                                <option value="">Seleccione un departamento</option>
                                @foreach ($departamentos as $departamento)
                                    <option value="{{ $departamento->id }}" data-nombre="{{ $departamento->departamento }}">
                                        {{ $departamento->departamento }}
                                    </option>
                                @endforeach
                            </select>
                            <small id="DepartamentoTutorError" class="form-text text-danger" style="display: none;">Este campo es obligatorio.</small>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="FechaInicio">Fecha de Inicio:</label>
                            <input type="date" class="form-control input" id="FechaInicio" name="FechaInicio" value="{{ $proyecto->inicioFecha }}" required>
                            <small id="FechaInicioError" class="form-text text-danger" style="display: none;">Este campo es obligatorio.</small>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="FechaFinalizacion">Fecha de Finalización:</label>
                            <input type="date" class="form-control input" id="FechaFinalizacion" name="FechaFinalizacion" value="{{ $proyecto->finFecha }}" required>
                            <small id="FechaFinalizacionError" class="form-text text-danger" style="display: none;">Este campo es obligatorio.</small>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="Estado">Estado:</label>
                            <select class="form-control input input-select" id="Estado" name="Estado" required>
                                <option value="Ejecucion" {{ $proyecto->estado === 'Ejecucion' ? 'selected' : '' }}>Ejecución</option>
                                <option value="Terminado" {{ $proyecto->estado === 'Terminado' ? 'selected' : '' }}>Terminado</option>
                            </select>
                            <small id="EstadoError" class="form-text text-danger" style="display: none;">Este campo es obligatorio.</small>
                        </div>
                    </div>
                </div>
                <div class="text-center">
                    <button type="submit" class="button1">Guardar Cambios</button>
                </div>
            </form>
        </div>
    </div>
    <br>
</div>

<script>
    document.getElementById('editarProyectos').addEventListener('submit', function(event) {
        let valid = true;

        // Obtener los campos
        const codigoProyecto = document.getElementById('codigoProyecto');
        const nombreProyecto = document.getElementById('NombreProyecto');
        const directorProyecto = document.getElementById('DirectorProyecto');
        const descripcionProyecto = document.getElementById('DescripcionProyecto');
        const departamentoTutor = document.getElementById('DepartamentoTutor');
        const fechaInicio = document.getElementById('FechaInicio');
        const fechaFinalizacion = document.getElementById('FechaFinalizacion');
        const estado = document.getElementById('Estado');

        // Validar Código del Proyecto (si se requiere)
        if (codigoProyecto.value.trim() === '') {
            valid = false;
            document.getElementById('codigoProyectoError').style.display = 'block';
        } else {
            document.getElementById('codigoProyectoError').style.display = 'none';
        }

        // Validar Nombre del Proyecto
        if (nombreProyecto.value.trim() === '') {
            valid = false;
            document.getElementById('NombreProyectoError').style.display = 'block';
        } else {
            document.getElementById('NombreProyectoError').style.display = 'none';
        }

        // Validar Director del Proyecto
        if (directorProyecto.value === '') {
            valid = false;
            document.getElementById('DirectorProyectoError').style.display = 'block';
        } else {
            document.getElementById('DirectorProyectoError').style.display = 'none';
        }

        // Validar Descripción del Proyecto
        if (descripcionProyecto.value.trim() === '') {
            valid = false;
            document.getElementById('DescripcionProyectoError').style.display = 'block';
        } else {
            document.getElementById('DescripcionProyectoError').style.display = 'none';
        }

        // Validar Departamento Tutor
        if (departamentoTutor.value === '') {
            valid = false;
            document.getElementById('DepartamentoTutorError').style.display = 'block';
        } else {
            document.getElementById('DepartamentoTutorError').style.display = 'none';
        }

        // Validar Fecha de Inicio
        if (fechaInicio.value === '') {
            valid = false;
            document.getElementById('FechaInicioError').style.display = 'block';
        } else {
            document.getElementById('FechaInicioError').style.display = 'none';
        }

        // Validar Fecha de Finalización
        if (fechaFinalizacion.value === '') {
            valid = false;
            document.getElementById('FechaFinalizacionError').style.display = 'block';
        } else {
            document.getElementById('FechaFinalizacionError').style.display = 'none';
        }

        // Validar Estado del Proyecto
        if (estado.value === '#') {
            valid = false;
            document.getElementById('EstadoError').style.display = 'block';
        } else {
            document.getElementById('EstadoError').style.display = 'none';
        }

        // Prevenir envío si no es válido
        if (!valid) {
            event.preventDefault();
        }
    });

    // Escuchar eventos de entrada para validar en tiempo real
    const inputs = [
        { field: 'codigoProyecto', error: 'codigoProyectoError' },
        { field: 'NombreProyecto', error: 'NombreProyectoError' },
        { field: 'DirectorProyecto', error: 'DirectorProyectoError' },
        { field: 'DescripcionProyecto', error: 'DescripcionProyectoError' },
        { field: 'DepartamentoTutor', error: 'DepartamentoTutorError' },
        { field: 'FechaInicio', error: 'FechaInicioError' },
        { field: 'FechaFinalizacion', error: 'FechaFinalizacionError' },
        { field: 'Estado', error: 'EstadoError' },
    ];

    inputs.forEach(input => {
        document.getElementById(input.field).addEventListener('input', function() {
            if (this.value.trim() !== '' && this.value !== '#') {
                document.getElementById(input.error).style.display = 'none';
            }
        });
    });

    // Manejo especial para selects que cambian en `change`
    ['DirectorProyecto', 'DepartamentoTutor', 'Estado'].forEach(select => {
        document.getElementById(select).addEventListener('change', function() {
            if (this.value !== '') {
                document.getElementById(select + 'Error').style.display = 'none';
            }
        });
    });
</script>
@endsection
