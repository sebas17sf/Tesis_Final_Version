@extends('layouts.director')

@section('title', 'Panel de Director')

@section('title_component', 'Proyectos')

@section('content')
    <section class="contenedor_agregar_periodo">
        <div class="mat-elevation-z8 contenedor_general">
            <br>
            <h6><b>Listado de Proyectos</b></h6>
            <hr>
            <div class="contenedor_acciones_tabla">



                <div class="contenedor_botones">

                    <form method="POST" action="{{ route('coordinador.reportesProyectos') }}" class="mt-1">
                        @csrf

                        <button type="submit" class="btn btn-sm btn-secondary">
                            <i class="fas fa-file-excel"></i> Generar Reporte
                        </button>
                    </form>
                    <form method="GET" action="{{ route('director.indexProyectos') }}">
                        @csrf
                        <div class="form-group d-flex align-items-center">

                            <label for="buscarEstudiantesEnRevision" class="mr-2">Buscar Proyectos:</label>
                            <input type="text" class="input" name="buscar" id="buscar"
                                placeholder="Buscar proyectos..." value="{{ request('buscar') }}">
                            <div class="btn-group ml-2 shadow-0">
                                <button type="submit" class="button5">Buscar
                                    <i class="bx bx-search-alt"></i>
                                </button>
                            </div>
                        </div>
                    </form>


                </div>

            </div>

            <div class="contenedor_tabla">
                <div class="table-container mat-elevation-z8">
                    <div>
                        <table class="mat-mdc-table">
                            <thead class="ng-star-inserted">
                                <tr class="mat-mdc-header-row mdc-data-table__header-row cdk-header-row ng-star-inserted">
                                    <th class="medium_size">Tutor</th>
                                    <th class="size_">Nombre del profesor participante</th>
                                    <th class="size_">Nombre del proyecto</th>
                                    <th class="size_">Descripción</th>
                                    <th class="center_size">Correo del tutor</th>
                                    <th class="center_size">Correo del profesor participante</th>
                                    <th class="medium_size">Departamento</th>
                                    <th class="center_size">Fecha de inicio</th>
                                    <th class="center_size">Fecha fin</th>
                                    <th>Cupos</th>
                                    <th class="center_size">Estado del proyecto</th>
                                </tr>
                            </thead>
                            <tbody class="mdc-data-table__content ng-star-inserted">
                                @foreach ($proyectos as $proyecto)
                                    <tr>
                                        <td>{{ strtoupper($proyecto->ApellidoProfesor) }}
                                            {{ strtoupper($proyecto->NombreProfesor) }}
                                        </td>
                                        <td>{{ strtoupper($proyecto->ApellidoAsignado) }}
                                            {{ strtoupper($proyecto->NombreAsignado) }}
                                        </td>
                                        <td>{{ strtoupper($proyecto->NombreProyecto) }}</td>
                                        <td>{{ strtoupper($proyecto->DescripcionProyecto) }}</td>
                                        <td>{{ strtoupper($proyecto->CorreoElectronicoTutor) }}</td>
                                        <td>{{ strtoupper($proyecto->CorreoProfeAsignado) }}</td>
                                        <td>{{ strtoupper($proyecto->DepartamentoTutor) }}</td>
                                        <td>{{ strtoupper($proyecto->FechaInicio) }}</td>
                                        <td>{{ strtoupper($proyecto->FechaFinalizacion) }}</td>
                                        <td>{{ strtoupper($proyecto->cupos) }}</td>
                                        <td>{{ strtoupper($proyecto->Estado) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="paginator-container">


                    <nav aria-label="...">

                        <ul class="pagination">



                            <li class="page-item mx-3">
                                <form method="GET" action="{{ route('director.indexProyectos') }}" class="mr-3">
                                    <select class="form-control page-item" class="input" name="elementosPorPagina"
                                        id="elementosPorPagina" onchange="this.form.submit()">
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
                            </li>

                            @if ($proyectos->onFirstPage())
                                <li class="page-item disabled">
                                    <span class="page-link">Anterior</span>
                                </li>
                            @else
                                <li class="page-item">
                                    <a class="page-link" href="{{ $proyectos->previousPageUrl() }}"
                                        aria-label="Anterior">Anterior</a>
                                </li>
                            @endif

                            @foreach ($proyectos->getUrlRange(1, $proyectos->lastPage()) as $page => $url)
                                @if ($page == $proyectos->currentPage())
                                    <li class="page-item active">
                                        <span class="page-link">{{ $page }}</span>
                                    </li>
                                @else
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                                    </li>
                                @endif
                            @endforeach

                            @if ($proyectos->hasMorePages())
                                <li class="page-item">
                                    <a class="page-link" href="{{ $proyectos->nextPageUrl() }}"
                                        aria-label="Siguiente">Siguiente</a>
                                </li>
                            @else
                                <li class="page-item disabled">
                                    <span class="page-link">Siguiente</span>
                                </li>
                            @endif
                        </ul>
                    </nav>
                </div>

            </div>
        </div>
    </section>

@endsection

{{-- <style>
    table {
        width: 100%;
        border-collapse: collapse;
        white-space: nowrap;
        /* Evita el desbordamiento de texto */
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
</style>
 --}}
