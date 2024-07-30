@extends('layouts.participante')
@section('title', 'Panel Proyectos')

@section('title_component', 'Panel Proyectos')
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
        <div class="contenedor_alerta error">
            <div class="icon_alert"><i class="fa-regular fa-circle-x fa-beat"></i></div>
            <div class="content_alert">
                <div class="title">Error!</div>
                <div class="body">{{ session('error') }}</div>
            </div>
        </div>
    @endif



    <section class="contenedor_registro_genero">
        <h4><b>Historial Proyectos como Director</b></h4>
        <hr>
        <div class="mat-elevation-z8 contenedor_general">
            <div class="contenedor_acciones_tabla sidebar_active_content_acciones_tabla">
                <div class="contenedor_botones">
                    <form id="reportForm" method="POST" action="{{ route('reporte.director') }}"
                        class="form-inline d-flex align-items-center">
                        @csrf
                        <input type="hidden" name="profesor" id="hiddenProfesor">
                        <input type="hidden" name="periodo" id="hiddenPeriodo">
                        <div class="tooltip-container">
                            <button type="submit" class="button3 btn_excel efects_button">
                                <i class="fas fa-file-excel"></i>
                            </button>
                        </div>
                    </form>


                    <!-- Botón para abrir el card de filtros -->
                    <div class="tooltip-container">
                        <span class="tooltip-text">Filtros</span>
                        <button class="button3 efects_button btn_filtro" onclick="openCard('filtersCard');">
                            <i class="fa-solid fa-filter-list"></i>
                        </button>
                    </div>

                    <!-- Card de Filtros -->
                    <div class="draggable-card1_2" id="filtersCard" style="display: none;">
                        <div class="card-header">
                            <span class="card-title">Filtros</span>
                            <button type="button" class="close" onclick="closeCard('filtersCard')"><i
                                    class="fa-thin fa-xmark"></i></button>
                        </div>
                        <div class="card-body">
                            <form id="filtersForm" method="GET" action="{{ route('ParticipanteVinculacion.index') }}">
                                <div class="form-group">
                                    <label for="profesor" class="mr-2">Docente Participante:</label>
                                    <select name="profesor" id="profesor" class="form-control input input_select">
                                        <option value="">Todos los docentes</option>
                                        @foreach ($profesTodos as $profesor)
                                            <option value="{{ $profesor->apellidos }}">{{ $profesor->apellidos }}
                                                {{ $profesor->nombres }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="periodo" class="mr-2">Periodo:</label>
                                    <select name="periodo" id="periodo" class="form-control input input_select">
                                        <option value="">Todos los periodos</option>
                                        @foreach ($obtenerPeriodo as $periodo)
                                            <option value="{{ $periodo->numeroPeriodo }}">{{ $periodo->numeroPeriodo }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Botón de Eliminar Filtros -->
                    <div class="tooltip-container">
                        <span class="tooltip-text">Eliminar Filtros</span>
                        <button class="button3 efects_button btn_delete_filter" onclick="resetFilters()">
                            <i class="fa-sharp fa-solid fa-filter-circle-xmark"></i>
                        </button>
                    </div>
                </div>


                <div class="contenedor_buscador">
                    <div>
                        <form id="searchForm">
                            <input type="text" class="input" name="search" value="{{ $search }}" id="search"
                                placeholder="Buscar ...">
                            <i class='bx bx-search-alt'></i>
                        </form>
                    </div>
                </div>
            </div>


            <div class="mat-elevation-z8 contenedor_general">

                <div class="contenedor_tabla">
                    <div class="table-container mat-elevation-z8">

                        <div id="tablaDirector">
                            <table class="mat-mdc-table">
                                <thead class="ng-star-inserted">
                                    <tr
                                        class="mat-mdc-header-row mdc-data-table__header-row cdk-header-row ng-star-inserted">
                                        <th>N°</th>
                                        <th class="tamanio">NOMBRE DE PROYECTO</th>
                                        <th class="tamanio3">CÓDIGO DE PROYECTO</th>
                                        <th class="tamanio4">DIRECTOR</th>
                                        <th class="tamanio2">DEPARTAMENTO DIRECTOR</th>
                                        <th class="tamanio4">DOCENTE PARTICIPANTE</th>
                                        <th class="tamanio2">DEPARTAMENTO PARTICIPANTE</th>
                                        <th class="tamanio1">ESTUDIANTE</th>
                                        <th class="tamanio2">PERIODO VINCULACION</th>
                                        <th>NRC</th>
                                        <th class="tamanio2">CARRERA</th>
                                        <th class="tamanio2">NOTA</th>
                                        <th>FECHA INICIO</th>
                                        <th>FECHA FIN</th>
                                    </tr>
                                </thead>
                                <tbody class="mdc-data-table__content ng-star-inserted">
                                    @forelse ($asignacionesProyectos as $index => $asignaciones)
                                        <tr class="mat-mdc-row mdc-data-table__row ng-star-inserted">
                                            <td style="text-align: center;">
                                                {{ $asignacionesProyectos->currentPage() == 1 ? $index + 1 : $index + 1 + $asignacionesProyectos->perPage() * ($asignacionesProyectos->currentPage() - 1) }}
                                            </td>
                                            <td
                                                style="text-align:justify; text-transform: uppercase; word-wrap: break-word;">
                                                {{ $asignaciones->proyecto->nombreProyecto }}
                                            </td>
                                            <td
                                                style="text-align:center; text-transform: uppercase; word-wrap: break-word;">
                                                {{ $asignaciones->proyecto->codigoProyecto }}
                                            </td>
                                            <td style="text-align:left; text-transform: uppercase; word-wrap: break-word;">
                                                {{ $asignaciones->proyecto->director->nombres }}
                                                {{ $asignaciones->proyecto->director->apellidos }}
                                            </td>
                                            <td
                                                style="text-align:center; text-transform: uppercase; word-wrap: break-word;">
                                                {{ $asignaciones->proyecto->departamentoTutor }}
                                            </td>
                                            <td style="text-align:left; text-transform: uppercase; word-wrap: break-word;">
                                                {{ $asignaciones->docenteParticipante->nombres }}
                                                {{ $asignaciones->docenteParticipante->apellidos }}
                                            </td>
                                            <td style="text-align:left; text-transform: uppercase; word-wrap: break-word;">
                                                {{ $asignaciones->docenteParticipante->departamento }}
                                            </td>
                                            <td style="text-align:left; text-transform: uppercase; word-wrap: break-word;">
                                                {{ $asignaciones->estudiante->nombres }}
                                                {{ $asignaciones->estudiante->apellidos }}
                                            </td>
                                            <td
                                                style="text-align:center; text-transform: uppercase; word-wrap: break-word;">
                                                {{ $asignaciones->periodo->numeroPeriodo }}
                                            </td>
                                            <td
                                                style="text-align:center; text-transform: uppercase; word-wrap: break-word;">
                                                {{ $asignaciones->nrcVinculacion->nrc ?? 'NO REQUIERE NRC' }}
                                            </td>
                                            <td style="text-align:left; text-transform: uppercase; word-wrap: break-word;">
                                                {{ $asignaciones->estudiante->carrera }}
                                            </td>
                                            <td
                                                style="text-align:center; text-transform: uppercase; word-wrap: break-word;">
                                                @foreach ($asignaciones->estudiante->notas as $nota)
                                                        {{ $nota->notaFinal ?? 'AUN NO TIENE NOTA' }}
                                                    @endforeach
                                            </td>
                                            <td
                                                style="text-align:center; text-transform: uppercase; word-wrap: break-word;">
                                                {{ $asignaciones->inicioFecha }}
                                            </td>
                                            <td
                                                style="text-align:center; text-transform: uppercase; word-wrap: break-word;">
                                                {{ $asignaciones->finalizacionFecha }}
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td class="noExisteRegistro1" style="font-size: 16px !important;"
                                                colspan="10">
                                                No eixsten datos registrados.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>




                        </div>
                    </div>
                    <div class="paginator-container">
                        <nav aria-label="..."
                            style="display: flex; justify-content: space-between; align-items: baseline; color: gray;">
                            <div id="totalRows">Proyectos: {{ $asignacionesProyectos->total() }}</div>
                            <ul class="pagination">
                                <li class="page-item mx-3">
                                    <form method="GET"
                                        action="{{ route('ParticipanteVinculacion.index') }}#tablaDirector">
                                        <select class="form-control page-item" name="perPage" id="perPage"
                                            onchange="this.form.submit()">
                                            <option value="10" @if ($perPage == 10) selected @endif>10
                                            </option>
                                            <option value="20" @if ($perPage == 20) selected @endif>20
                                            </option>
                                            <option value="50" @if ($perPage == 50) selected @endif>50
                                            </option>
                                            <option value="100" @if ($perPage == 100) selected @endif>100
                                            </option>
                                        </select>
                                    </form>
                                </li>
                                @if ($asignacionesProyectos->onFirstPage())
                                    <li class="page-item disabled">
                                        <span class="page-link">Anterior</span>
                                    </li>
                                @else
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $asignacionesProyectos->previousPageUrl() }}"
                                            aria-label="Anterior">Anterior</a>
                                    </li>
                                @endif

                                @for ($i = 1; $i <= $asignacionesProyectos->lastPage(); $i++)
                                    <li
                                        class="page-item {{ $asignacionesProyectos->currentPage() == $i ? 'active' : '' }}">
                                        <a class="page-link"
                                            href="{{ $asignacionesProyectos->url($i) }}">{{ $i }}</a>
                                    </li>
                                @endfor

                                @if ($asignacionesProyectos->hasMorePages())
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $asignacionesProyectos->nextPageUrl() }}"
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


            <br>

            <div class="mat-elevation-z8 contenedor_general">

                <h4><b>Historial Proyectos como Participante</b></h4>
                <hr>
                <div class="mat-elevation-z8 contenedor_general">
                    <div class="contenedor_acciones_tabla sidebar_active_content_acciones_tabla">
                        <div class="contenedor_botones">
                            <form method="POST" action="{{ route('reporte.historicoParticipante') }}"
                                class="form-inline d-flex align-items-center" id="reportForm2">
                                @csrf
                                <input type="hidden" name="profesorParticipante" id="hiddenProfesorParticipante">
                                <input type="hidden" name="periodoParticipante" id="hiddenPeriodoParticipante">
                                <div class="tooltip-container">
                                    <button type="submit" class="button3 btn_excel efects_button">
                                        <i class="fas fa-file-excel"></i>
                                    </button>
                                </div>
                            </form>
                            <div class="tooltip-container">
                                <span class="tooltip-text">Filtros</span>
                                <button class="button3 efects_button btn_filtro" onclick="openCard('filtersCard2');">
                                    <i class="fa-solid fa-filter-list"></i>
                                </button>
                            </div>

                            <!-- Card de Filtros -->
                            <div class="draggable-card1_2" id="filtersCard2" style="display: none;">
                                <div class="card-header">
                                    <span class="card-title">Filtros</span>
                                    <button type="button" class="close" onclick="closeCard('filtersCard2')"><i
                                            class="fa-thin fa-xmark"></i></button>
                                </div>
                                <div class="card-body">
                                    <form id="filtersForm" method="GET"
                                        action="{{ route('ParticipanteVinculacion.index') }}">
                                        <div class="form-group">
                                            <label for="profesorParticipante" class="mr-2">Director de proyecto:</label>
                                            <select name="profesorParticipante" id="profesorParticipante"
                                                class="form-control input input_select">
                                                <option value="">Todos los docentes</option>
                                                @foreach ($profesTodos as $profesor)
                                                    <option value="{{ $profesor->apellidos }}">{{ $profesor->apellidos }}
                                                        {{ $profesor->nombres }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="periodoParticipante" class="mr-2">Periodo:</label>
                                            <select name="periodoParticipante" id="periodoParticipante"
                                                class="form-control input input_select">
                                                <option value="">Todos los periodos</option>
                                                @foreach ($obtenerPeriodo as $periodo)
                                                    <option value="{{ $periodo->numeroPeriodo }}">
                                                        {{ $periodo->numeroPeriodo }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </form>
                                </div>
                            </div>


                            <!-- Botón de Eliminar Filtros -->
                            <div class="tooltip-container">
                                <span class="tooltip-text">Eliminar Filtros</span>
                                <button class="button3 efects_button btn_delete_filter" onclick="resetFilters2()">
                                    <i class="fa-sharp fa-solid fa-filter-circle-xmark"></i>
                                </button>
                            </div>
                        </div>

                        <div class="contenedor_buscador">
                            <div>
                                <form id="searchForm2">
                                    <input type="text" class="input" name="search2" value="{{ $search2 }}"
                                        id="search2" placeholder="Buscar ...">
                                    <i class='bx bx-search-alt'></i>
                                </form>

                            </div>
                        </div>
                    </div>
                    <div class="contenedor_tabla">
                        <div class="table-container mat-elevation-z8">

                            <div id="tablaParticipante">



                                <table class="mat-mdc-table">
                                    <thead class="ng-star-inserted">
                                        <tr
                                            class="mat-mdc-header-row mdc-data-table__header-row cdk-header-row ng-star-inserted">
                                            <th>N°</th>
                                            <th class="tamanio"> NOMBRE DE PROYECTO</th>
                                            <th class="tamanio3">CÓDIGO DE PROYECTO</th>
                                            <th class="tamanio4">DIRECTOR</th>
                                            <th class="tamanio2">DEPARTAMENTO DIRECTOR</th>
                                            <th class="tamanio4">DOCENTE PARTICIPANTE</th>
                                            <th class="tamanio2">DEPARTAMENTO PARTICIPANTE</th>
                                            <th class="tamanio1">ESTUDIANTE</th>
                                            <th class="tamanio2">PERIODO VINCULACION</th>
                                            <th class="tamanio2">CARRERA</th>
                                            <th class="tamanio2">NOTA</th>
                                            <th>FECHA INICIO</th>
                                            <th>FECHA FIN</th>
                                        </tr>
                                    </thead>
                                    <tbody class="mdc-data-table__content ng-star-inserted">
                                        @forelse ($asignacionParticipante as $index => $asignaciones)
                                            <tr class="mat-mdc-row mdc-data-table__row ng-star-inserted">
                                                <td style="text-align: center;">
                                                    {{ $asignacionParticipante->currentPage() == 1 ? $index + 1 : $index + 1 + $asignacionParticipante->perPage() * ($asignacionParticipante->currentPage() - 1) }}
                                                </td>

                                                <td
                                                    style="text-align:justify; text-transform: uppercase; word-wrap: break-word;">
                                                    {{ $asignaciones->proyecto->nombreProyecto }}</td>
                                                <td
                                                    style="text-align:center; text-transform: uppercase; word-wrap: break-word;">
                                                    {{ $asignaciones->proyecto->codigoProyecto }}</td>
                                                <td
                                                    style="text-align:left; text-transform: uppercase; word-wrap: break-word;">
                                                    {{ $asignaciones->proyecto->director->nombres }}
                                                    {{ $asignaciones->proyecto->director->apellidos }}</td>
                                                <td
                                                    style="text-align:center; text-transform: uppercase; word-wrap: break-word;">
                                                    {{ $asignaciones->proyecto->departamentoTutor }}</td>
                                                <td
                                                    style="text-align:left; text-transform: uppercase; word-wrap: break-word;">
                                                    {{ $asignaciones->docenteParticipante->nombres }}
                                                    {{ $asignaciones->docenteParticipante->apellidos }}</td>
                                                <td
                                                    style="text-align:left; text-transform: uppercase; word-wrap: break-word;">
                                                    {{ $asignaciones->docenteParticipante->departamento }}</td>
                                                <td
                                                    style="text-align:left; text-transform: uppercase; word-wrap: break-word;">
                                                    {{ $asignaciones->estudiante->nombres }}
                                                    {{ $asignaciones->estudiante->apellidos }}</td>
                                                <td
                                                    style="text-align:center; text-transform: uppercase; word-wrap: break-word;">
                                                    {{ $asignaciones->periodo->numeroPeriodo }}</td>
                                                <td
                                                    style="text-align:left; text-transform: uppercase; word-wrap: break-word;">
                                                    {{ $asignaciones->estudiante->carrera }}</td>
                                                <td
                                                    style="text-align:center; text-transform: uppercase; word-wrap: break-word;">
                                                    @foreach ($asignaciones->estudiante->notas as $nota)
                                                        {{ $nota->notaFinal ?? 'AUN NO TIENE NOTA' }}
                                                    @endforeach
                                                </td>

                                                <td
                                                    style="text-align:center; text-transform: uppercase; word-wrap: break-word;">
                                                    {{ $asignaciones->inicioFecha }}</td>

                                                <td
                                                    style="text-align:center; text-transform: uppercase; word-wrap: break-word;">
                                                    {{ $asignaciones->finalizacionFecha }}</td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td class="noExisteRegistro1" style="font-size: 16px !important;"
                                                    colspan="10">
                                                    No eixsten datos registrados.</td>
                                            </tr>
                                        @endforelse


                                    </tbody>
                                </table>


                            </div>
                        </div>

                        <div class="paginator-container">
                            <nav aria-label="..."
                                style="display: flex; justify-content: space-between; align-items: baseline; color: gray;">
                                <div id="totalRows">Proyectos: {{ $asignacionParticipante->total() }}</div>
                                <ul class="pagination">
                                    <li class="page-item mx-3">
                                        <form method="GET"
                                            action="{{ route('ParticipanteVinculacion.index') }}#tablaParticipante">
                                            <select class="form-control page-item" name="perPage2" id="perPage2"
                                                onchange="this.form.submit()">
                                                <option value="10" @if ($perPage2 == 10) selected @endif>10
                                                </option>
                                                <option value="20" @if ($perPage2 == 20) selected @endif>20
                                                </option>
                                                <option value="50" @if ($perPage2 == 50) selected @endif>
                                                    50</option>
                                                <option value="100" @if ($perPage2 == 100) selected @endif>
                                                    100</option>
                                            </select>
                                        </form>
                                    </li>
                                    @if ($asignacionParticipante->onFirstPage())
                                        <li class="page-item disabled">
                                            <span class="page-link">Anterior</span>
                                        </li>
                                    @else
                                        <li class="page-item">
                                            <a class="page-link"
                                                href="{{ $asignacionParticipante->appends(['perPage2' => $perPage2])->previousPageUrl() }}#tablaParticipante"
                                                aria-label="Anterior">Anterior</a>
                                        </li>
                                    @endif

                                    @for ($i = 1; $i <= $asignacionParticipante->lastPage(); $i++)
                                        <li
                                            class="page-item {{ $asignacionParticipante->currentPage() == $i ? 'active' : '' }}">
                                            <a class="page-link"
                                                href="{{ $asignacionParticipante->appends(['perPage2' => $perPage2])->url($i) }}#tablaParticipante">{{ $i }}</a>
                                        </li>
                                    @endfor

                                    @if ($asignacionParticipante->hasMorePages())
                                        <li class="page-item">
                                            <a class="page-link"
                                                href="{{ $asignacionParticipante->appends(['perPage2' => $perPage2])->nextPageUrl() }}#tablaParticipante"
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.ckeditor.com/4.16.1/standard/ckeditor.css">
    <script src="https://cdn.ckeditor.com/4.16.1/standard/ckeditor.js"></script>
    <script src="{{ asset('js/plantilla/main.js') }}" type="module"></script>
    <script src="js/admin/acciones.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://code.jquery.com/ui/1.13.0/jquery-ui.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


    <style>
        .contenedor_tabla .table-container table td {
            width: 200px;
            min-width: 150px;
            font-size: 11px !important;
            padding: .5rem !important;
        }

        .contenedor_general .contenedor_tabla {
            min-height: 1px !important;
        }

        .table-container {
            height: 275px !important;
        }
    </style>

    <script>
        var delayTimer;
        $('#searchForm input[name="search"]').on('keyup', function() {
            clearTimeout(delayTimer);
            var query = $(this).val();
            delayTimer = setTimeout(function() {
                $.ajax({
                    url: '{{ route('ParticipanteVinculacion.index') }}',
                    type: 'GET',
                    data: {
                        search: query
                    },
                    success: function(response) {
                        $('#tablaDirector').html($(response).find('#tablaDirector').html());
                    }
                });
            }, 500);
        });
    </script>

    <script>
        var delayTimer;
        $('#searchForm2 input[name="search2"]').on('keyup', function() {
            clearTimeout(delayTimer);
            var query = $(this).val();
            delayTimer = setTimeout(function() {
                $.ajax({
                    url: '{{ route('ParticipanteVinculacion.index') }}',
                    type: 'GET',
                    data: {
                        search2: query
                    },
                    success: function(response) {
                        $('#tablaParticipante').html($(response).find('#tablaParticipante')
                            .html());
                    }
                });
            }, 500);
        });
    </script>

    <script>
        $(document).ready(function() {
            $('#profesor, #periodo').change(function() {
                var profesor = $('#profesor').val();
                var periodo = $('#periodo').val();

                $.ajax({
                    url: "{{ route('ParticipanteVinculacion.index') }}",
                    method: 'GET',
                    data: {
                        profesor: profesor,
                        periodo: periodo
                    },
                    success: function(response) {
                        $('#tablaDirector').html($(response).find('#tablaDirector').html());
                    },
                    error: function(xhr) {
                        console.error(xhr.responseText);
                    }
                });
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $('#profesorParticipante, #periodoParticipante').change(function() {
                var profesorParticipante = $('#profesorParticipante').val();
                var periodoParticipante = $('#periodoParticipante').val();

                $.ajax({
                    url: "{{ route('ParticipanteVinculacion.index') }}",
                    method: 'GET',
                    data: {
                        profesorParticipante: profesorParticipante,
                        periodoParticipante: periodoParticipante
                    },
                    success: function(response) {
                        $('#tablaParticipante').html($(response).find('#tablaParticipante')
                            .html());
                    },
                    error: function(xhr) {
                        console.error(xhr.responseText);
                    }
                });
            });
        });
    </script>



    <script>
        function resetFilters() {
            $('#profesor').val('');
            $('#periodo').val('');
            $('#search').val('');
            $('#search2').val('');

            var profesor = $('#profesor').val();
            var periodo = $('#periodo').val();

            $.ajax({
                url: "{{ route('ParticipanteVinculacion.index') }}",
                method: 'GET',
                data: {
                    profesor: profesor,
                    periodo: periodo
                },
                success: function(response) {
                    $('#tablaDirector').html($(response).find('#tablaDirector').html());
                },
                error: function(xhr) {
                    console.error(xhr.responseText);
                }
            });
        }

        function resetFilters2() {
            $('#profesorParticipante').val('');
            $('#periodoParticipante').val('');
            $('#search').val('');
            $('#search2').val('');

            var profesorParticipante = $('#profesorParticipante').val();
            var periodoParticipante = $('#periodoParticipante').val();

            $.ajax({
                url: "{{ route('ParticipanteVinculacion.index') }}",
                method: 'GET',
                data: {
                    profesorParticipante: profesorParticipante,
                    periodoParticipante: periodoParticipante
                },
                success: function(response) {
                    $('#tablaParticipante').html($(response).find('#tablaParticipante').html());
                },
                error: function(xhr) {
                    console.error(xhr.responseText);
                }
            });
        }
    </script>

    <script>
        function openCard(card) {
            $('#' + card).show();
        }

        function closeCard(card) {
            $('#' + card).hide();
        }
    </script>

    <script>
        document.getElementById('reportForm').addEventListener('submit', function(event) {
            event.preventDefault();
            var profesor = document.getElementById('profesor').value;
            var periodo = document.getElementById('periodo').value;

            document.getElementById('hiddenProfesor').value = profesor;
            document.getElementById('hiddenPeriodo').value = periodo;

            this.submit();
        });
    </script>

    <script>
        document.getElementById('reportForm2').addEventListener('submit', function(event) {
            event.preventDefault();
            var profesorParticipante = document.getElementById('profesorParticipante').value;
            var periodoParticipante = document.getElementById('periodoParticipante').value;

            document.getElementById('hiddenProfesorParticipante').value = profesorParticipante;
            document.getElementById('hiddenPeriodoParticipante').value = periodoParticipante;

            this.submit();
        });
    </script>




@endsection
