@extends('layouts.directorVinculacion')
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
                    <form method="POST" action="{{ route('reporte.director') }}"
                        class="form-inline d-flex align-items-center">
                        @csrf
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
                            <form id="filtersForm" method="GET" action="{{ route('admin.indexProyectos') }}">
                                <div class="form-group">
                                    <label for="estado" class="mr-2">Estado del Proyecto:</label>
                                    <select name="estado" id="estado" class="form-control input input_select">
                                        <option value="">Todos</option>
                                        <option value="Ejecucion" {{ request('estado') == 'Ejecucion' ? 'selected' : '' }}>
                                            En Ejecución
                                        </option>
                                        <option value="Terminado" {{ request('estado') == 'Terminado' ? 'selected' : '' }}>
                                            Terminado
                                        </option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="departamento" class="mr-2">Departamento:</label>
                                    <select name="departamento" id="departamento" class="form-control input input_select">
                                        <option value="">Todos</option>
                                        <option value="Ciencias de la Computación"
                                            {{ request('departamento') == 'Ciencias de la Computación' ? 'selected' : '' }}>
                                            Ciencias de la Computación</option>
                                        <option value="Ciencias Exactas"
                                            {{ request('departamento') == 'Ciencias Exactas' ? 'selected' : '' }}>
                                            Ciencias Exactas</option>
                                        <option value="Ciencias de la Vida y Agricultura"
                                            {{ request('departamento') == 'Ciencias de la Vida y Agricultura' ? 'selected' : '' }}>
                                            Ciencias de la Vida y Agricultura</option>
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
                                    @foreach ($asignacionesProyectos as $asignaciones)
                                        <tr class="mat-mdc-row mdc-data-table__row ng-star-inserted">
                                            <td>{{ $loop->iteration }}</td>
                                            <td
                                                style="text-align:justify; text-transform: uppercase; word-wrap: break-word;">
                                                {{ $asignaciones->proyecto->nombreProyecto }}</td>
                                            <td
                                                style="text-align:center; text-transform: uppercase; word-wrap: break-word;">
                                                {{ $asignaciones->proyecto->codigoProyecto }}</td>
                                            <td style="text-align:left; text-transform: uppercase; word-wrap: break-word;">
                                                {{ $asignaciones->proyecto->director->nombres }}
                                                {{ $asignaciones->proyecto->director->apellidos }}</td>
                                            <td
                                                style="text-align:center; text-transform: uppercase; word-wrap: break-word;">
                                                {{ $asignaciones->proyecto->departamentoTutor }}</td>
                                            <td style="text-align:left; text-transform: uppercase; word-wrap: break-word;">
                                                {{ $asignaciones->docenteParticipante->nombres }}
                                                {{ $asignaciones->docenteParticipante->apellidos }}</td>
                                            <td style="text-align:left; text-transform: uppercase; word-wrap: break-word;">
                                                {{ $asignaciones->docenteParticipante->departamento }}</td>
                                            <td style="text-align:left; text-transform: uppercase; word-wrap: break-word;">
                                                {{ $asignaciones->estudiante->nombres }}
                                                {{ $asignaciones->estudiante->apellidos }}</td>
                                            <td
                                                style="text-align:center; text-transform: uppercase; word-wrap: break-word;">
                                                {{ $asignaciones->periodo->numeroPeriodo }}</td>
                                            <td
                                                style="text-align:center; text-transform: uppercase; word-wrap: break-word;">
                                                {{ $asignaciones->nrcVinculacion->nrc ?? 'NO REQUIERE NRC' }}</td>

                                            <td style="text-align:left; text-transform: uppercase; word-wrap: break-word;">
                                                {{ $asignaciones->estudiante->carrera }}</td>
                                            <td
                                                style="text-align:center; text-transform: uppercase; word-wrap: break-word;">
                                                {{ $asignaciones->estudiante->notas->notaFinal ?? 'AUN NO TIENE NOTA' }}
                                            </td>
                                            <td
                                                style="text-align:center; text-transform: uppercase; word-wrap: break-word;">
                                                {{ $asignaciones->inicioFecha }}</td>
                                            <td
                                                style="text-align:center; text-transform: uppercase; word-wrap: break-word;">
                                                {{ $asignaciones->finalizacionFecha }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
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
                                class="form-inline d-flex align-items-center">
                                @csrf
                                <div class="tooltip-container">
                                    <button type="submit" class="button3 btn_excel efects_button">
                                        <i class="fas fa-file-excel"></i>
                                    </button>
                                </div>
                            </form>
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
                                    <form id="filtersForm" method="GET" action="{{ route('admin.indexProyectos') }}">
                                        <div class="form-group">
                                            <label for="estado" class="mr-2">Estado del Proyecto:</label>
                                            <select name="estado" id="estado"
                                                class="form-control input input_select">
                                                <option value="">Todos</option>
                                                <option value="Ejecucion"
                                                    {{ request('estado') == 'Ejecucion' ? 'selected' : '' }}>En Ejecución
                                                </option>
                                                <option value="Terminado"
                                                    {{ request('estado') == 'Terminado' ? 'selected' : '' }}>Terminado
                                                </option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="departamento" class="mr-2">Departamento:</label>
                                            <select name="departamento" id="departamento"
                                                class="form-control input input_select">
                                                <option value="">Todos</option>
                                                <option value="Ciencias de la Computación"
                                                    {{ request('departamento') == 'Ciencias de la Computación' ? 'selected' : '' }}>
                                                    Ciencias de la Computación</option>
                                                <option value="Ciencias Exactas"
                                                    {{ request('departamento') == 'Ciencias Exactas' ? 'selected' : '' }}>
                                                    Ciencias Exactas</option>
                                                <option value="Ciencias de la Vida y Agricultura"
                                                    {{ request('departamento') == 'Ciencias de la Vida y Agricultura' ? 'selected' : '' }}>
                                                    Ciencias de la Vida y Agricultura</option>
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
                                        @foreach ($asignacionParticipante as $asignaciones)
                                            <tr class="mat-mdc-row mdc-data-table__row ng-star-inserted">
                                                <td>{{ $loop->iteration }}</td>
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
                                                    {{ $asignaciones->estudiante->notas->notaFinal ?? 'AUN NO TIENE NOTA' }}
                                                </td>

                                                <td
                                                    style="text-align:center; text-transform: uppercase; word-wrap: break-word;">
                                                    {{ $asignaciones->inicioFecha }}</td>

                                                <td
                                                    style="text-align:center; text-transform: uppercase; word-wrap: break-word;">
                                                    {{ $asignaciones->finalizacionFecha }}</td>
                                            </tr>
                                        @endforeach


                                    </tbody>
                                </table>


                            </div>
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
                    url: '{{ route('director_vinculacion.index') }}',
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
                    url: '{{ route('director_vinculacion.index') }}',
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





@endsection
