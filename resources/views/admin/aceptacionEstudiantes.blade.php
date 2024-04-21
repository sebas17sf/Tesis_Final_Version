@extends('layouts.admin')


@section('title', 'Aceptación de Estudiantes')


@section('title_component', 'Aceptación de Estudiantes')

@section('content')

    <h4>Estudiantes en Proceso de Revisión</h4>

    <form action="{{ route('admin.estudiantes') }}" method="GET">
        @csrf
        <div class="form-group">
            <label for="buscarEstudiantesEnRevision">Buscar Estudiantes en Proceso de Revisión:</label>
            <input type="text" class="input" name="buscarEstudiantesEnRevision" id="buscarEstudiantesEnRevision">
            <button type="submit" class="button">Buscar</button>
        </div>
    </form>

    @if ($estudiantesEnRevision->isEmpty())
        <p>No hay estudiantes en proceso de revisión.</p>
    @else
        <table class="table">
            <thead>
                <tr>
                    <th>Nombres</th>
                    <th>Apellidos</th>
                    <th>ID ESPE</th>
                    <th>Celular</th>
                    <th>Cédula</th>
                    <th>Cohorte</th>
                    <th>Departamento</th>
                    <th>Estado Actual</th>
                    <th>Actualizar Estado</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($estudiantesEnRevision as $estudiante)
                    <tr>
                        <td>{{ strtoupper($estudiante->Nombres) }}</td>
                        <td>{{ strtoupper($estudiante->Apellidos) }}</td>
                        <td>{{ $estudiante->espe_id }}</td>
                        <td>{{ $estudiante->celular }}</td>
                        <td>{{ $estudiante->cedula }}</td>
                        <td>{{ $estudiante->cohortes->Cohorte }}</td>
                        <td>{{ strtoupper($estudiante->Departamento) }}</td>
                        <td>{{ strtoupper($estudiante->Estado) }}</td>
                        <td>
                            <form action="{{ route('admin.updateEstudiante', ['id' => $estudiante->EstudianteID]) }}"
                                method="POST">
                                @csrf
                                @method('PUT')
                                <input type="hidden" id="motivoNegacion" name="motivoNegacion" class="input">
                                <select name="nuevoEstado" id="nuevoEstado" onchange="verificarEstado()"
                                    class="input input-select">
                                    <option value="Aprobado">Aprobado</option>
                                    <option value="Negado">Negado</option>
                                </select>
                                <button type="submit">Enviar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    <h4>Seguimiento Estudiantes</h4>
    <div class="d-flex">
        <form method="GET" action="{{ route('admin.estudiantes') }}" class="mr-3">
            <label for="elementosPorPaginaAprobados">Estudiantes a visualizar:</label>
            <select name="elementosPorPaginaAprobados" class="input input-select"id="elementosPorPaginaAprobados"
                onchange="this.form.submit">
                <option value="10" @if ($elementosPorPaginaAprobados == 10) selected @endif>10</option>
                <option value="20" @if ($elementosPorPaginaAprobados == 20) selected @endif>20</option>
                <option value="50" @if ($elementosPorPaginaAprobados == 50) selected @endif>50</option>
                <option value="100" @if ($elementosPorPaginaAprobados == 100) selected @endif>100</option>
            </select>
        </form>

        <form action="{{ route('admin.estudiantes') }}" method="GET">
            @csrf
            <div class="form-group">
                <label for="buscarEstudiantesAprobados">Buscar estudiantes aprobados:</label>
                <input class="input" type="text" name="buscarEstudiantesAprobados" id="buscarEstudiantesAprobados"
                    placeholder="Buscar estudiantes aprobados">
                <button type="submit" class="button">Buscar</button>
            </div>
        </form>
    </div>

    @if ($estudiantesAprobados->isEmpty())
        <p>No hay estudiantes aprobados.</p>
    @else
        <div style="overflow-x: auto;">
            <table class="table">
                <thead>
                    <tr>
                        <th>Nombres</th>
                        <th>ID ESPE</th>
                        <th>Carrera</th>
                        <th>Celular</th>
                        <th>Cédula</th>
                        <th>Cohorte</th>
                        <th>Periodo</th>
                        <th>Departamento</th>
                        <th>Estado</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($estudiantesAprobados as $estudiante)
                        <tr>
                            <td>{{ strtoupper($estudiante->Apellidos . ' ' . $estudiante->Nombres) }}</td>
                            <td>{{ $estudiante->espe_id }}</td>
                            <td>{{ strtoupper($estudiante->Carrera) }}</td>
                            <td>{{ $estudiante->celular }}</td>
                            <td>{{ $estudiante->cedula }}</td>
                            <td>{{ $estudiante->cohortes->Cohorte }}</td>
                            <td>{{ $estudiante->periodos->Periodo }}</td>
                            <td>{{ strtoupper($estudiante->Departamento) }}</td>
                            <td>
                                @if ($estudiante->Estado == 'Aprobado')
                                    {{ strtoupper('Vinculacion') }}
                                @elseif ($estudiante->Estado == 'Aprobado-practicas')
                                    {{ strtoupper('Practicas') }}
                                @else
                                    {{ strtoupper($estudiante->Estado) }}
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <form method="POST" action="{{ route('coordinador.reportesEstudiantes') }}">
                @csrf
                <button type="submit" class="btn btn-sm btn-secondary">
                    <i class="fas fa-file-excel"></i> Generar Reporte
                </button>
            </form>
        </div>

        <div class="d-flex justify-content-center">
            <ul class="pagination">
                @if ($estudiantesAprobados->onFirstPage())
                    <li class="page-item disabled">
                        <span class="page-link">Anterior</span>
                    </li>
                @else
                    <li class="page-item">
                        <a class="page-link" href="{{ $estudiantesAprobados->previousPageUrl() }}"
                            aria-label="Anterior">Anterior</a>
                    </li>
                @endif

                @foreach ($estudiantesAprobados->getUrlRange(1, $estudiantesAprobados->lastPage()) as $page => $url)
                    @if ($page == $estudiantesAprobados->currentPage())
                        <li class="page-item active">
                            <span class="page-link">{{ $page }}</span>
                        </li>
                    @else
                        <li class="page-item">
                            <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                        </li>
                    @endif
                @endforeach

                @if ($estudiantesAprobados->hasMorePages())
                    <li class="page-item">
                        <a class="page-link" href="{{ $estudiantesAprobados->nextPageUrl() }}"
                            aria-label="Siguiente">Siguiente</a>
                    </li>
                @else
                    <li class="page-item disabled">
                        <span class="page-link">Siguiente</span>
                    </li>
                @endif
            </ul>
        </div>
    @endif

    <h4>Estudiantes culminados Vinculación a la sociedad</h4>
    <div class="d-flex">
        <form method="GET" action="{{ route('admin.estudiantes') }}" class="mr-3">
            <label for="elementosPorPagina">Estudiantes a visualizar:</label>
            <select name="elementosPorPagina" class="input input-select" id="elementosPorPagina"
                onchange="this.form.submit()">
                <option value="10" @if (request('elementosPorPagina', $elementosPorPagina) == 10) selected @endif>10
                </option>
                <option value="20" @if (request('elementosPorPagina', $elementosPorPagina) == 20) selected @endif>20
                </option>
                <option value="50" @if (request('elementosPorPagina', $elementosPorPagina) == 50) selected @endif>50
                </option>
                <option value="100" @if (request('elementosPorPagina', $elementosPorPagina) == 100) selected @endif>100
                </option>
            </select>
        </form>

        <form id="formBusquedaEstudiantes" method="GET" action="{{ route('admin.estudiantes') }}">
            <input type="text" name="buscarEstudiantes" id="buscarEstudiantes" class="input"
                placeholder="Buscar estudiantes de vinculación a la sociedad">
        </form>

    </div>

    <div id="tablaEstudiantes">
        @if ($estudiantesVinculacion->isEmpty() && $noResultadosEstudiantesVinculacion)
            <p>No se encontraron resultados para la búsqueda.</p>
        @elseif ($estudiantesVinculacion->isEmpty())
            <p>No hay estudiantes de vinculación a la sociedad culminados.</p>
        @else
            <div style="overflow-x: auto;">
                <table class="table">
                    <thead>
                        <tr>
                            <th>N°</th>
                            <th>Nombres</th>
                            <th>Cédula de Identidad</th>
                            <th>Correo Electrónico</th>
                            <th>ESPE ID</th>
                            <th>Período de Ingreso</th>
                            <th>Período de Vinculación</th>
                            <th>Actividades Macro</th>
                            <th>Docente Participante</th>
                            <th>Fecha de Inicio</th>
                            <th>Fecha de Fin</th>
                            <th>Total de Horas</th>
                            <th>Director del Proyecto</th>
                            <th>Nombre del Proyecto</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $contador = ($estudiantesVinculacion->currentPage() - 1) * $elementosPorPagina + 1;
                        @endphp

                        @foreach ($estudiantesVinculacion as $estudiante)
                            <tr>
                                <td>{{ $contador }}</td>
                                <td>{{ mb_strtoupper($estudiante->nombres) }}</td>
                                <td>{{ $estudiante->cedula_identidad }}</td>
                                <td>{{ mb_strtolower($estudiante->correo_electronico) }}</td>
                                <td>{{ $estudiante->espe_id }}</td>
                                <td>{{ $estudiante->periodo_ingreso }}</td>
                                <td>{{ $estudiante->periodo_vinculacion }}</td>
                                <td>{{ mb_strtoupper($estudiante->actividades_macro) }}</td>
                                <td>{{ mb_strtoupper($estudiante->docente_participante) }}</td>
                                <td>{{ $estudiante->fecha_inicio }}</td>
                                <td>{{ $estudiante->fecha_fin }}</td>
                                <td>{{ $estudiante->total_horas }}</td>
                                <td>{{ mb_strtoupper($estudiante->director_proyecto) }}</td>
                                <td>{{ mb_strtoupper($estudiante->nombre_proyecto) }}</td>
                            </tr>
                            @php
                                $contador++;
                            @endphp
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>





    <form action="{{ route('coordinador.reportesVinculacion') }}" method="post">
        @csrf
        <button type="submit" class="btn btn-sm btn-secondary">
            <i class="fas fa-file-excel"></i> Generar Reporte
        </button>
    </form>

    <div class="d-flex justify-content-center">
        <ul class="pagination">
            @if ($estudiantesVinculacion->onFirstPage())
                <li class="page-item disabled">
                    <span class="page-link">Anterior</span>
                </li>
            @else
                <li class="page-item">
                    <a class="page-link"
                        href="{{ $estudiantesVinculacion->previousPageUrl() }}&elementosPorPagina={{ $elementosPorPagina }}"
                        aria-label="Anterior">Anterior</a>
                </li>
            @endif

            @foreach ($estudiantesVinculacion->getUrlRange(1, $estudiantesVinculacion->lastPage()) as $page => $url)
                @if ($page == $estudiantesVinculacion->currentPage())
                    <li class="page-item active">
                        <span class="page-link">{{ $page }}</span>
                    </li>
                @else
                    <li class="page-item">
                        <a class="page-link"
                            href="{{ $url }}&elementosPorPagina={{ $elementosPorPagina }}">{{ $page }}</a>
                    </li>
                @endif
            @endforeach

            @if ($estudiantesVinculacion->hasMorePages())
                <li class="page-item">
                    <a class="page-link"
                        href="{{ $estudiantesVinculacion->nextPageUrl() }}&elementosPorPagina={{ $elementosPorPagina }}"
                        aria-label="Siguiente">Siguiente</a>
                </li>
            @else
                <li class="page-item disabled">
                    <span class="page-link">Siguiente</span>
                </li>
            @endif
        </ul>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        var delayTimer;
        $('#buscarEstudiantes').on('keyup', function() {
            clearTimeout(delayTimer);
            var query = $(this).val();
            delayTimer = setTimeout(function() {
                $.ajax({
                    url: '{{ route('admin.estudiantes') }}',
                    type: 'GET',
                    data: {
                        buscarEstudiantes: query
                    },
                    success: function(response) {
                        $('#tablaEstudiantes').html($(response).find('#tablaEstudiantes')
                        .html());
                    }
                });
            }, 500);  
        });
    </script>

@endsection


<style>
    table {
        width: 100%;
        border-collapse: collapse;
        white-space: nowrap;
    }

    table,
    th,
    td {
        font-size: 0.8rem;
    }

    th,
    td {
        padding: 8px 12px;
        text-align: left;
        border: 1px solid #ddd;
        overflow: hidden;
        text-overflow: ellipsis;
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
