@extends('layouts.coordinador')

@section('title', 'Proyectos')

@section('title_component', 'Listado de proyectos')

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


    <div class="container" style="overflow-x: auto;">


        <a href="{{ route('coordinador.agregarProyecto') }}" class="btn btn-outline-secondary btn-sm">
            <i class="material-icons">add</i> Proyecto
        </a>

        <br><br>
        <div class="d-flex">
            <form method="GET" action="{{ route('coordinador.index') }}">
                <div class="d-flex align-items-center mb-3">
                    <label for="perPage" class="me-2">Proyectos por página:</label>
                    <select id="perPage" name="perPage" class="form-select input input-select"
                        onchange="this.form.submit()">
                        <option value="10" @if ($perPage == 10) selected @endif>10</option>
                        <option value="20" @if ($perPage == 20) selected @endif>20</option>
                        <option value="50" @if ($perPage == 50) selected @endif>50</option>
                        <option value="100" @if ($perPage == 100) selected @endif>100</option>
                    </select>
                </div>
            </form>

            <div class="mb-3">
                <form id="formBusquedaProyectos" class="d-flex">
                    <input type="text" name="search" value="{{ $search }}" class="input"
                        placeholder="Buscar proyectos...">
                </form>
            </div>

        </div>


        <div id="tablaProyectos">
            @if ($proyectos->isEmpty())
                <p>No se encontraron resultados para la busqueda</p>
            @else
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Nombre del director del proyecto</th>
                            <th>Nombres Docentes participantes</th>
                            <th>Nombre del proyecto</th>
                            <th>Descripción</th>
                            <th>Correo del director</th>
                            <th>Correos de Docentes participantes</th>
                            <th>Departamento del director</th>
                            <th>Código del Proyecto Social</th>
                            <th>NRC</th>
                            <th>Periodo</th>
                            <th>Fecha de inicio</th>
                            <th>Fecha de finalización</th>
                            <th>Cupos</th>
                            <th>Estado del proyecto</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($proyectos as $proyecto)
                            <tr>
                                <td>{{ strtoupper($proyecto->director->Apellidos) }}
                                    {{ strtoupper($proyecto->director->Nombres) }}</td>
                                <td>
                                    {{ strtoupper($proyecto->docenteParticipante->Apellidos) }}
                                    {{ strtoupper($proyecto->docenteParticipante->Nombres) }}
                                    @foreach ($proyecto->participantesAdicionales as $participanteAdicional)
                                        <br>
                                        {{ strtoupper($participanteAdicional->Apellidos) }}
                                        {{ strtoupper($participanteAdicional->Nombres) }}
                                    @endforeach
                                </td>
                                <td >
                                    {{ strtoupper($proyecto->NombreProyecto) }}</td>
                                <td>{{ strtoupper($proyecto->DescripcionProyecto) }}</td>
                                <td>{{ strtoupper($proyecto->director->Correo) }}</td>
                                <td>
                                    {{ strtoupper($proyecto->docenteParticipante->Correo) }}
                                    @foreach ($proyecto->participantesAdicionales as $participanteAdicional)
                                        <br>
                                        {{ strtoupper($participanteAdicional->Correo) }}
                                    @endforeach
                                </td>
                                <td>{{ strtoupper($proyecto->DepartamentoTutor) }}</td>
                                <td>
                                    @if (empty($proyecto->codigoProyecto))
                                        {{ strtoupper('No requiere código de proyecto') }}
                                    @else
                                        {{ strtoupper($proyecto->codigoProyecto) }}
                                    @endif
                                </td>
                                <td>{{ strtoupper($proyecto->nrcs->nrc) }}</td>
                                <td>{{ strtoupper($proyecto->nrcs->periodo->numeroPeriodo) }}</td>
                                <td>{{ strtoupper($proyecto->FechaInicio) }}</td>
                                <td>{{ strtoupper($proyecto->FechaFinalizacion) }}</td>
                                <td>{{ strtoupper($proyecto->cupos) }}</td>
                                <td>{{ strtoupper($proyecto->Estado) }}</td>
                                <td>
                                    <a href="{{ route('coordinador.editarProyecto', ['ProyectoID' => $proyecto->ProyectoID]) }}"
                                        class="btn btn-outline-secondary btn-block">
                                        <i class="material-icons">edit</i>
                                    </a>
                                    <form
                                        action="{{ route('coordinador.deleteProyecto', ['ProyectoID' => $proyecto->ProyectoID]) }}"
                                        method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-secondary btn-block"
                                            onclick="return confirm('¿Estás seguro de eliminar este proyecto?')">
                                            <i class="material-icons">delete</i>
                                        </button>
                                    </form>
                                    <a href="{{ route('coordinador.descargarEvidencias', ['ProyectoID' => $proyecto->ProyectoID]) }}"
                                        class="btn btn-outline-secondary btn-block">
                                        <i class="material-icons">download</i>
                                    </a>
                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>


        <div class="d-flex justify-content-center paginator-container">
            <ul class="pagination">
                <form method="GET" action="{{ route('coordinador.index') }}">
                    <select class="input paginator-container" name="perPage" id="perPage" onchange="this.form.submit()">
                        <option value="10" @if ($perPage == 10) selected @endif>10</option>
                        <option value="20" @if ($perPage == 20) selected @endif>20</option>
                        <option value="50" @if ($perPage == 50) selected @endif>50</option>
                        <option value="100" @if ($perPage == 100) selected @endif>100</option>
                    </select>
                </form>
                <br>
                @if ($proyectos->onFirstPage())
                    <li class="page-item disabled">
                        <span class="page-link">Anterior</span>
                    </li>
                @else
                    <li class="page-item">
                        <a class="page-link" href="{{ $proyectos->previousPageUrl() }}" aria-label="Anterior">Anterior</a>
                    </li>
                @endif

                @for ($i = 1; $i <= $proyectos->lastPage(); $i++)
                    <li class="page-item {{ $proyectos->currentPage() == $i ? 'active' : '' }}">
                        <a class="page-link" href="{{ $proyectos->url($i) }}">{{ $i }}</a>
                    </li>
                @endfor

                @if ($proyectos->hasMorePages())
                    <li class="page-item">
                        <a class="page-link" href="{{ $proyectos->nextPageUrl() }}" aria-label="Siguiente">Siguiente</a>
                    </li>
                @else
                    <li class="page-item disabled">
                        <span class="page-link">Siguiente</span>
                    </li>
                @endif
            </ul>
        </div>

        <form method="POST" action="{{ route('coordinador.reportesProyectos') }}">
            @csrf
            <div class="form-inline">
                <div class="form-group mr-2">
                    <label for="estado" class="mr-2">Estado del Proyecto:</label>
                    <select name="estado" id="estado" class="form-control input input-select">
                        <option value="">Todos</option>
                        <option value="Ejecucion">En Ejecución</option>
                        <option value="Terminado">Terminado</option>
                    </select>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-sm btn-secondary">
                        <i class="fas fa-file-excel"></i> Reporte Proyectos
                    </button>
                </div>
            </div>
        </form>


    </div>

    <hr>

    <div class="container">
        <button id="toggleFormBtn" class="btn btn-outline-secondary btn-block">Asignar estudiante</button>
        <div id="asignarEstudiante" style="display: none;">

            <HR>
            <h4>Asignar Proyecto</h4>
            <form method="POST" action="{{ route('coordinador.guardarAsignacion') }}">
                @csrf

                <div class="form-group">
                    <label for="proyecto_id">Proyecto Disponible:</label>
                    <select name="proyecto_id" id="proyecto_id" class="form-control input input-select">
                        @foreach ($proyectosDisponibles as $proyecto)
                            @if ($proyecto->cupos > 0)
                                <option value="{{ $proyecto->ProyectoID }}">
                                    {{ $proyecto->director->Apellidos }} {{ $proyecto->director->Nombres }} -
                                    Cupos disponibles: {{ $proyecto->cupos }} -
                                    {{ $proyecto->DepartamentoTutor }}
                                </option>
                            @endif
                        @endforeach
                    </select>
                </div>




                <div class="form-group">
                    <label for="estudiante_id">Estudiante Aprobado:</label>
                    <select name="estudiante_id" id="estudiante_id" class="form-control input input-select">
                        @foreach ($estudiantesAprobados as $estudiante)
                            <option value="{{ $estudiante->EstudianteID }}">
                                {{ $estudiante->Nombres }} {{ $estudiante->Apellidos }} -
                                {{ $estudiante->Departamento }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="fecha_asignacion">Fecha de Asignación:</label>
                    <input type="date" name="fecha_asignacion" id="fecha_asignacion" class="form-control input"
                        value="{{ now()->toDateString() }}">
                </div>

                <button type="submit" class="btn btn-secondary">Asignar Proyecto</button>
            </form>
        </div>

    </div>


    <link rel="stylesheet" href="https://cdn.ckeditor.com/4.16.1/standard/ckeditor.css">
    <script src="https://cdn.ckeditor.com/4.16.1/standard/ckeditor.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            var asignarEstudianteVisible = localStorage.getItem('asignarEstudianteVisible');

             if (asignarEstudianteVisible === 'true') {
                $("#asignarEstudiante").show();
                $("#toggleFormBtn").text("Ocultar Asignar Estudiante");
            }

             $("#toggleFormBtn").click(function() {
                $("#asignarEstudiante").toggle();
                 localStorage.setItem('asignarEstudianteVisible', $("#asignarEstudiante").is(":visible"));
                 if ($("#asignarEstudiante").is(":visible")) {
                    $(this).text("Ocultar Asignar Estudiante");
                } else {
                    $(this).text("Asignar estudiante");
                }
            });

            var delayTimer;
            $('#formBusquedaProyectos input[name="search"]').on('keyup', function() {
                clearTimeout(delayTimer);
                var query = $(this).val();
                delayTimer = setTimeout(function() {
                    $.ajax({
                        url: '{{ route('coordinador.index') }}',
                        type: 'GET',
                        data: {
                            search: query
                        },
                        success: function(response) {
                            $('#tablaProyectos').html($(response).find(
                                '#tablaProyectos').html());
                        }
                    });
                }, 500);
            });
        });
    </script>




@endsection



<style>
    table {
        width: 100%;
        border-collapse: collapse;
    }

    table,
    th,
    td {
        font-size: 14px;
    }

    th,
    td {
        padding: 8px 12px;
        text-align: left;
        border: 1px solid #ddd;
        white-space: nowrap;
        /* Evita el salto de línea */
        overflow: hidden;
        text-overflow: ellipsis;
        /* Agrega puntos suspensivos si el contenido es demasiado largo */
    }

    th {
        background-color: #f2f2f2;
    }

    body,
    input,
    select,
    th,
    td,
    label,
    button,
    table {
        background-color: #F5F5F5;
        font-family: Arial, sans-serif;
        font-size: 14px;
        line-height: 1.5;

    }
</style>
