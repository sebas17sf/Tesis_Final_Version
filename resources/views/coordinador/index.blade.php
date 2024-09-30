@extends('layouts.coordinador')

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


    <section>
        <div class="contenedor_registro_genero ">
            <h4><b>Listado de Proyectos Sociales</b></h4>



            <div class="mat-elevation-z8 contenedor_general">
                <div class="contenedor_acciones_tabla sidebar_active_content_acciones_tabla">
                    <!-- Botones -->
                    <div class="row">
                        <div class="col-md-12 d-flex align-items-center">
                            <!-- Formulario para exportar a Excel -->
                            <!-- Botón para agregar proyecto -->
                            <div class="tooltip-container mr-2">
                                <span class="tooltip-text">Agregar</span>
                                <button type="button" onclick="location.href='{{ route('admin.agregarProyecto') }}';"
                                    class="button3 efects_button btn_primary" id="button3">
                                    <i class="fa-solid fa-plus"></i>
                                </button>
                            </div>
                            <form method="POST" action="{{ route('coordinador.reportesProyectos') }}"
                                class="form-inline mr-2 d-flex align-items-center">
                                @csrf
                                <input type="hidden" name="estado" id="hiddenEstado" value="{{ request('estado') }}">
                                <input type="hidden" name="departamento" id="hiddenDepartamento"
                                    value="{{ request('departamento') }}">
                                <div class="tooltip-container">
                                    <span class="tooltip-text">Excel</span>
                                    <button type="submit" class="button3 efects_button btn_excel" id="submitButton">
                                        <span id="loadingIcon" style="display: none !important; ">
                                            <img src="gif/load2.gif" alt="Loading" style="height: 20px;">
                                        </span>
                                        <i class="fa-solid fa-file-excel" id="excelIcon"></i>
                                    </button>
                                </div>
                            </form>
                            <!-- Success alert -->
                            <div class="contenedor_alerta success" id="successAlert" style="display: none !important;">
                                <div class="icon_alert"><i class="fa-regular fa-check"></i></div>
                                <div class="content_alert">
                                    <div class="title">Éxito!</div>
                                    <div class="body">El archivo Excel ha sido exportado.</div>
                                </div>
                                <div class="icon_remove">
                                    <button class="button4 btn_3_2" onclick="closeAlert('successAlert')"><i
                                            class="fa-sharp fa-regular fa-xmark"></i></button>
                                </div>
                            </div>

                            <!-- Error alert -->
                            <div class="contenedor_alerta error" id="errorAlert" style="display: none !important;">
                                <div class="icon_alert"><i class="fa-regular fa-xmark"></i></div>
                                <div class="content_alert">
                                    <div class="title">Error!</div>
                                    <div class="body">Ha ocurrido un error al exportar el archivo Excel.</div>
                                </div>
                                <div class="icon_remove">
                                    <button class="button4 btn_3_2" onclick="closeAlert('errorAlert')"><i
                                            class="fa-sharp fa-regular fa-xmark"></i></button>
                                </div>
                            </div>
                            <!-- Botón para abrir el card de filtros -->
                            <div class="tooltip-container">
                                <span class="tooltip-text">Filtros</span>
                                <button class="button3 efects_button btn_filtro"
                                    onclick="openCard('filtersCard'); toggleIcon();">
                                    <i id="filterIcon" class="fa-solid fa-filter-list"></i>
                                </button>
                            </div>

                            <!-- Card de Filtros -->
                            <div class="draggable-card1_2" id="filtersCard" style="display: none;">
                                <div class="card-header">
                                    <span class="card-title">Filtros</span>
                                    <button type="button" class="close" onclick="closeCard('filtersCard')">
                                        <i class="fa-thin fa-xmark"></i>
                                    </button>
                                </div>
                                <div class="card-body">
                                    <form id="filtersForm" method="GET" action="{{ route('coordinador.index') }}">
                                        <div class="form-group">
                                            <label for="estado" class="mr-2">Estado del Proyecto:</label>
                                            <select name="estado" id="estado" class="form-control input input_select">
                                                <option value="">Todos</option>
                                                <option value="Ejecucion"
                                                    {{ request('estado') == 'Ejecucion' ? 'selected' : '' }}>En Ejecución
                                                </option>
                                                <option value="Terminado"
                                                    {{ request('estado') == 'Terminado' ? 'selected' : '' }}>Terminado
                                                </option>
                                            </select>
                                        </div>
                                        <div>
                                            <label for="departament_student">Departamento <span
                                                    class="requerido">*</span></label>
                                            <select class="form-control input input_select" id="departamento"
                                                name="departamento">
                                                <option value="">Seleccione un departamento</option>
                                                @foreach ($departamentos as $departamento)
                                                    <option value="{{ $departamento->id }}"
                                                        @if (isset($estudiante->departamentoId) && $estudiante->departamentoId == $departamento->id) selected @endif>
                                                        {{ $departamento->departamento }}</option>
                                                @endforeach
                                            </select>
                                            <small id="departamentoError" class="error-message"
                                                style="color: red;"></small>
                                        </div>
                                    </form>

                                    <!-- Formulario para descargar el reporte en Excel -->
                                    <form method="POST" action="{{ route('coordinador.reportesProyectos') }}"
                                        class="form-inline d-flex align-items-center">
                                        @csrf
                                        <input type="hidden" name="estado" id="hiddenEstado"
                                            value="{{ request('estado') }}">
                                        <input type="hidden" name="departamento" id="hiddenDepartamento"
                                            value="{{ request('departamento') }}">
                                        <div style="display: flex; align-items: center;">
                                            <label for="submitButton" style="margin-right: 30px;">Descargar
                                                Reporte</label>
                                            <button type="submit" class="button3 efects_button btn_excel"
                                                id="submitButton">
                                                <span id="loadingIcon" style="display: none !important;">
                                                    <img src="gif/load2.gif" alt="Loading" style="height: 20px;">
                                                </span>
                                                <i class="fa-solid fa-download"></i>
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>


                            <!-- Botón de Eliminar Filtros -->
                            <div class="tooltip-container mx-2">
                                <span class="tooltip-text">Eliminar Filtros</span>
                                <button class="button3 efects_button btn_delete_filter" onclick="resetFilters()">
                                    <i class="fa-sharp fa-solid fa-filter-circle-xmark"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Buscador -->
                    <div class="contenedor_buscador">
                        <div>
                            <form id="formBusquedaProyectos">
                                <input type="text" class="input" name="search" value="{{ $search }}"
                                    matInput placeholder="Buscar proyectos...">
                                <i class='bx bx-search-alt'></i>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="contenedor_tabla">
                    <div class="table-container mat-elevation-z8">
                        <div id="tablaProyectos">
                            <table class="mat-mdc-table">
                                <thead class="ng-star-inserted">
                                    <tr
                                        class="mat-mdc-header-row mdc-data-table__header-row cdk-header-row ng-star-inserted">
                                        <th>N°</th>
                                        <th class="tamanio">NOMBRE DEL PROYECTO</th>
                                        <th class="tamanio4">DIRECTOR</th>
                                        <th class="tamanio">DESCRIPCIÓN</th>
                                        <th>DEPARTAMENTO</th>
                                        <th class="tamanio3">CÓDIGO DEL PROYECTO</th>
                                        <th>FECHA INICIO</th>
                                        <th>FECHA FIN</th>
                                        <th>ESTADO</th>
                                        <th>ACCIONES</th>
                                    </tr>
                                </thead>
                                <tbody class="mdc-data-table__content ng-star-inserted">
                                    @if ($proyectos->isEmpty())
                                        <tr style="text-align:center">
                                            <td class="noExisteRegistro1" style="font-size: 16px !important;"colspan="10">
                                                Proyectos no disponibles.</td>
                                        </tr>
                                    @else
                                        @foreach ($proyectos as $index => $proyecto)
                                            <tr>
                                                <td style="text-align: center;">
                                                    {{ $proyectos->currentPage() == 1 ? $index + 1 : $index + 1 + $proyectos->perPage() * ($proyectos->currentPage() - 1) }}
                                                </td>

                                                <td
                                                    style="text-transform: uppercase; word-wrap: break-word; text-align: justify; padding: 5px 8px;">
                                                    {{ strtoupper($proyecto->nombreProyecto) }}
                                                </td>
                                                <td
                                                    style="text-transform: uppercase; word-wrap: break-word; text-align: left;">
                                                    @if ($proyecto->director)
                                                        {{ strtoupper($proyecto->director->apellidos) }}
                                                        {{ strtoupper($proyecto->director->nombres) }}
                                                    @else
                                                        DIRECTOR NO ASIGNADO
                                                    @endif
                                                </td>
                                                <td
                                                    style="text-transform: uppercase; word-wrap: break-word; text-align: justify; padding: 5px 8px;">
                                                    {{ strtoupper($proyecto->descripcionProyecto) }}
                                                </td>
                                                <td style="text-transform: uppercase;">
                                                    {{ strtoupper($proyecto->departamento->departamento ?? '') }}
                                                </td>
                                                <td>
                                                    @if (empty($proyecto->codigoProyecto))
                                                        {{ strtoupper('No requiere código de proyecto') }}
                                                    @else
                                                        {{ strtoupper($proyecto->codigoProyecto) }}
                                                    @endif
                                                </td>
                                                <td>{{ $proyecto->inicioFecha }}</td>
                                                <td>{{ $proyecto->finFecha }}</td>
                                                <td style="text-transform: uppercase;">
                                                    {{ strtoupper($proyecto->estado) }}
                                                </td>
                                                <td>
                                                    <div class="btn-group shadow-0">
                                                        <a href="{{ route('coordinador.editarProyecto', ['proyectoId' => $proyecto->proyectoId]) }}"
                                                            type="button" class="button3 efects_button btn_editar3">
                                                            <i class="bx bx-edit-alt"></i>
                                                        </a>
                                                    </div>
                                                    <form class="btn-group shadow-1"
                                                        id="deleteProjectForm{{ $proyecto->proyectoId }}"
                                                        action="{{ route('admin.deleteProyecto', ['ProyectoID' => $proyecto->proyectoId]) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <input type="hidden" name="proyectoId"
                                                            value="{{ $proyecto->proyectoId }}">
                                                        <button type="submit" class="button3 efects_button btn_eliminar3"
                                                            onclick="confirmDeleteProject(event, '{{ $proyecto->proyectoId }}')">
                                                            <i class='bx bx-trash'></i>
                                                        </button>
                                                    </form>

                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="paginator-container">
                        <nav aria-label="..."
                            style="display: flex; justify-content: space-between; align-items: baseline; color: gray;">
                            <div id="totalRows">Proyectos: {{ $proyectos->total() }}</div>
                            <ul class="pagination">
                                <li class="page-item mx-3">
                                    <form method="GET" action="{{ route('coordinador.index') }}#tablaProyectos">
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

                                @for ($i = 1; $i <= $proyectos->lastPage(); $i++)
                                    <li class="page-item {{ $proyectos->currentPage() == $i ? 'active' : '' }}">
                                        <a class="page-link" href="{{ $proyectos->url($i) }}">{{ $i }}</a>
                                    </li>
                                @endfor

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



            <br>


            <div class="contenedor_registro_genero ">
                <h4><b>Listado de asignaciones de proyectos</b></h4>
                <hr>

                <div class="mat-elevation-z8 contenedor_general">

                    <div class="contenedor_acciones_tabla sidebar_active_content_acciones_tabla">
                        <!-- Fila de Botones -->
                        <div class="row">
                            <!-- Columna de Botones -->
                            <div class="col-md-12 d-flex">

                                <!-- Botón de Matriz de Vinculación -->
                                <div class="tooltip-container mx-1">
                                    <span class="tooltip-text">Excel</span>
                                    <form action="{{ route('reporte.matrizVinculacion') }}" method="POST"
                                        id="reportForm">
                                        @csrf
                                        <input type="hidden" name="fechaInicio" id="hiddenFechaInicio">
                                        <input type="hidden" name="fechaFin" id="hiddenFechaFin">
                                        <input type="hidden" name="profesor" id="hiddenProfesor">
                                        <input type="hidden" name="periodos" id="hiddenPeriodos">

                                        <button type="submit" class="button3 efects_button btn_excel">
                                            <i class="fas fa-file-excel"></i>
                                        </button>
                                    </form>
                                </div>
                                <!-- Botón de Importar archivo -->
                                <div class="tooltip-container mx-1">
                                    <span class="tooltip-text">Importar archivo</span>
                                    <button type="button" class="button3 efects_button btn_copy"
                                        onclick="openCard('cardImportarArchivo');">
                                        <i class="fa fa-upload"></i>
                                    </button>
                                </div>

                                <!-- Card de Importar archivo -->
                                <div class="draggable-card1_4" id="cardImportarArchivo" style="display: none;">
                                    <div class="card-header">
                                        <span class="card-title">Importar archivo</span>
                                        <button type="button" class="close"
                                            onclick="closeCard('cardImportarArchivo')"><i
                                                class="fa-thin fa-xmark"></i></button>
                                    </div>
                                    <div class="card-body">
                                        <form id="idModalImportar2" action="{{ route('import') }}" method="POST"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-group">
                                                <div class="input_file input">
                                                    <span id="fileText2" class="fileText">
                                                        <i class="fa fa-upload"></i> Haz clic aquí para subir el documento
                                                    </span>
                                                    <input type="file" class="form-control-file input input_file"
                                                        id="file2" name="file"
                                                        onchange="displayFileName(this, 'fileText2')" required>
                                                    <span title="Eliminar archivo" onclick="removeFile(this)"
                                                        class="remove-icon">✖</span>
                                                </div>
                                            </div>
                                            <div class="card-footer d-flex justify-content-center align-items-center">
                                                <button type="button" class="button"
                                                    onclick="showImportConfirmation()">Importar Archivo</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>

                                <!-- Botón de Filtros para Profesores y Periodos -->
                                <div class="tooltip-container mx-1">
                                    <span class="tooltip-text">Filtros</span>
                                    <button class="button3 efects_button btn_filtro"
                                        onclick="openCard('filtersCardProfesores'); toggleIcon();">
                                        <i id="filterIcon" class="fa-solid fa-filter-list"></i>
                                    </button>
                                </div>

                                <!-- Card de Filtros para Profesores y Periodos -->
                                <div class="draggable-card1_2" id="filtersCardProfesores" style="display: none;">
                                    <div class="card-header">
                                        <span class="card-title">Filtros</span>
                                        <button type="button" class="close"
                                            onclick="closeCard('filtersCardProfesores')"><i
                                                class="fa-thin fa-xmark"></i></button>
                                    </div>
                                    <div class="card-body">
                                        <form id="filterFormProfesores" method="GET"
                                            action="{{ route('coordinador.index') }}">
                                            <div class="form-group">
                                                <label for="profesor">Docente</label>
                                                <select name="profesor" id="profesor"
                                                    class="form-control input input_select">
                                                    <option value="">Todos los docentes</option>
                                                    @foreach ($todoslosProfesores as $profesor)
                                                        <option value="{{ $profesor->id }}"
                                                            {{ request('profesor') == $profesor->id ? 'selected' : '' }}>
                                                            {{ $profesor->apellidos }} {{ $profesor->nombres }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="periodos">Períodos</label>
                                                <select name="periodos" id="periodos"
                                                    class="form-control input input_select">
                                                    <option value="">Todos los periodos</option>
                                                    @foreach ($periodos as $periodo)
                                                        <option value="{{ $periodo->id }}"
                                                            {{ request('periodos') == $periodo->id ? 'selected' : '' }}>
                                                            {{ $periodo->numeroPeriodo }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="fechaInicio">Fecha inicio</label>
                                                <input type="date" class=" form-control input input_f"
                                                    name="fechaInicio" id="fechaInicio">
                                            </div>
                                            <div class="form-group">
                                                <label for="fechaFin">Fecha Fin</label>
                                                <input type="date" class=" form-control input input_f" name="fechaFin"
                                                    id="fechaFin">
                                            </div>
                                        </form>

                                        <!-- Formulario para descargar el reporte en Excel -->
                                        <form action="{{ route('reporte.matrizVinculacion') }}" method="POST"
                                            id="reportForm">
                                            @csrf
                                            <input type="hidden" name="fechaInicio" id="hiddenFechaInicio">
                                            <input type="hidden" name="fechaFin" id="hiddenFechaFin">
                                            <input type="hidden" name="profesor" id="hiddenProfesor">
                                            <input type="hidden" name="periodos" id="hiddenPeriodos">

                                            <div style="display: flex; align-items: center;">
                                                <label for="submitButton" style="margin-right: 20px;">Descargar
                                                    Reporte</label>
                                                <button type="submit" class="button3 efects_button btn_excel">
                                                    <i class="fa-solid fa-download"></i>
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>


                                <!-- Botón de Eliminar Filtros Profesores y Periodos -->
                                <div class="tooltip-container mx-1">
                                    <span class="tooltip-text">Eliminar Filtros</span>
                                    <button class="button3 efects_button btn_delete_filter"
                                        onclick="resetFiltersProfesores()">
                                        <i class="fa-sharp fa-solid fa-filter-circle-xmark"></i>
                                    </button>
                                </div>


                            </div>
                        </div>
                        <!-- Error alert -->
                        <div class="contenedor_alerta error" id="errorAlert1" style="display: none !important;">
                            <div class="icon_alert"><i class="fa-regular fa-xmark"></i></div>
                            <div class="content_alert">
                                <div class="title">Error!</div>
                                <div class="body">Error en el filtro.</div>
                            </div>
                            <div class="icon_remove" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true"><i class="fa-thin fa-xmark"></i></span>
                                </button>
                            </div>
                        </div>
                        <div class="contenedor_buscador">
                            <div>
                                <form id="formBusquedaAsignaciones">
                                    <input type="text" class="input" name="search2" value="{{ $search2 }}"
                                        matInput placeholder="Buscar asignaciones...">
                                    <i class='bx bx-search-alt'></i>
                                </form>
                            </div>
                        </div>
                    </div>


                    <div class="contenedor_tabla">
                        <div class="table-container mat-elevation-z8">

                            <div id="tablaAsignaciones">
                                <table id="tablaAsignaciones" class="mat-mdc-table">

                                    <thead class="ng-star-inserted">
                                        <tr
                                            class="mat-mdc-header-row mdc-data-table__header-row cdk-header-row ng-star-inserted">
                                            <th>N°</th>
                                            <th class="tamanio"> NOMBRE DE PROYECTO</th>
                                            <th class="tamanio3">CÓDIGO DEL PROYECTO</th>
                                            <th class="tamanio4">DIRECTOR</th>
                                            <th class="tamanio4">DOCENTES PARTICIPANTES</th>
                                            <th>ESTUDIANTES</th>
                                            <th>DEPARTAMENTO</th>
                                            <th>HORAS REALIZADAS</th>
                                            <th class="tamanio4">NOTA</th>
                                            <th>PERIODO</th>
                                            <th>NRC</th>
                                            <th>FECHA INICIO</th>
                                            <th>FECHA FIN</th>
                                            <th>ESTADO</th>
                                            <th>PERMITIR CAMBIOS</th>
                                            <th>DESCARGAR EVIDENCIAS</th>
                                        </tr>
                                    </thead>
                                    <tbody class="mdc-data-table__content ng-star-inserted">
                                        @if ($asignacionesAgrupadas->isEmpty())
                                            <tr style="text-align:center">
                                                <td class="noExisteRegistro1"
                                                    style="font-size: 16px !important;"colspan="10">No hay estudiantes en
                                                    proceso de revisión.</td>
                                            </tr>
                                        @else
                                            @foreach ($asignacionesAgrupadas as $grupo)
                                                <tr>
                                                    <td>{{ $asignacionesAgrupadas->currentPage() == 1 ? $loop->index + 1 : $loop->index + 1 + $asignacionesAgrupadas->perPage() * ($asignacionesAgrupadas->currentPage() - 1) }}
                                                    </td>
                                                    <td
                                                        style="text-transform: uppercase; text-align: justify; padding: 5px 8px;">
                                                        {{ $grupo->first()->proyecto->nombreProyecto ?? '' }}</td>
                                                    <td>{{ $grupo->first()->proyecto->codigoProyecto ?? '' }}</td>

                                                    <td style="text-transform: uppercase; text-align: left;">
                                                        {{ $grupo->first()->proyecto->director->apellidos ?? '' }}
                                                        {{ $grupo->first()->proyecto->director->nombres ?? '' }}
                                                    </td>




                                                    <td style="text-transform: uppercase; text-align: left;">

                                                        {{ $grupo->first()->docenteParticipante->apellidos ?? '' }}
                                                        {{ $grupo->first()->docenteParticipante->nombres ?? '' }}<br>

                                                    </td>

                                                    <td
                                                        style=" text-transform: uppercase; text-align: left; white-space: nowrap; overflow: hidden;">

                                                        @foreach ($grupo as $asignacion)
                                                            <a href="#" class="edit-student"
                                                                data-id="{{ $asignacion->estudiante->estudianteId }}"
                                                                data-nombres="{{ $asignacion->estudiante->nombres }}"
                                                                data-apellidos="{{ $asignacion->estudiante->apellidos }}"
                                                                data-proyecto-id="{{ $asignacion->proyectoId }}"
                                                                data-nrc-id="{{ $asignacion->nrc }}">
                                                                {{ $asignacion->estudiante->apellidos ?? '' }}
                                                                {{ $asignacion->estudiante->nombres ?? '' }}
                                                            </a><br>
                                                        @endforeach

                                                    </td>

                                                    <td
                                                        style=" text-transform: uppercase; text-align: left; white-space: nowrap; overflow: hidden;">

                                                        @foreach ($grupo as $asignacion)
                                                            {{ $asignacion->estudiante->departamento->departamento ?? '' }}<br>
                                                        @endforeach

                                                    </td>

                                                    <td>
                                                        @foreach ($grupo as $asignacion)
                                                            @php
                                                                $horas = $asignacion->estudiante->horas_vinculacion
                                                                    ->pluck('horasVinculacion')
                                                                    ->filter()
                                                                    ->toArray();
                                                                echo implode(' / ', $horas) ?: 'NO ASIGNADA';
                                                            @endphp
                                                            <br>
                                                        @endforeach
                                                    </td>

                                                    <td>
                                                        @foreach ($grupo as $asignacion)
                                                            @php
                                                                $notas = $asignacion->estudiante->notas
                                                                    ->pluck('notaFinal')
                                                                    ->filter()
                                                                    ->toArray();
                                                                echo implode(' / ', $notas) ?: 'SIN CALIFICAR';
                                                            @endphp
                                                            <br>
                                                        @endforeach
                                                    </td>

                                                    </td>
                                                    </td>
                                                    <td>{{ $grupo->first()->periodo->numeroPeriodo ?? '' }}</td>
                                                    <td>{{ $grupo->first()->nrcVinculacion->nrc ?? 'NO REQUERIA DE NRC' }}
                                                    </td>
                                                    <td
                                                        style="text-transform: uppercase; text-align: left; white-space: nowrap; overflow: hidden;">
                                                        @foreach ($grupo as $asignacion)
                                                            <a href="#" class="edit-date"
                                                                data-fecha="{{ $asignacion->inicioFecha }}"
                                                                data-estudiante-id="{{ $asignacion->estudiante->estudianteId }}"
                                                                data-tipo="inicio">
                                                                {{ $asignacion->inicioFecha ?? 'Sin fecha' }}
                                                            </a><br>
                                                        @endforeach
                                                    </td>

                                                    <td
                                                        style="text-transform: uppercase; text-align: left; white-space: nowrap; overflow: hidden;">
                                                        @foreach ($grupo as $asignacion)
                                                            <a href="#" class="edit-date"
                                                                data-fecha="{{ $asignacion->finalizacionFecha }}"
                                                                data-estudiante-id="{{ $asignacion->estudiante->estudianteId }}"
                                                                data-tipo="fin">
                                                                {{ $asignacion->finalizacionFecha ?? 'Sin fecha' }}
                                                            </a><br>
                                                        @endforeach
                                                    </td>
                                                    <td
                                                        style=" text-transform: uppercase; text-align: left; white-space: nowrap; overflow: hidden;">

                                                        @foreach ($grupo as $asignacion)
                                                            {{ $asignacion->estado ?? '' }}<br>
                                                        @endforeach
                                                    </td>
                                                    <td>
                                                        <form class="btn-group shadow-1"
                                                            action="{{ route('admin.revertirAsignacion', ['proyectoId' => $grupo->first()->proyectoId, 'idPeriodo' => $grupo->first()->idPeriodo]) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('PATCH')
                                                            <button type="submit"
                                                                class="button3 efects_button btn_eliminar3">

                                                                <i class="bx bx-undo"></i>
                                                            </button>
                                                        </form>

                                                    </td>

                                                    <td>

                                                        <form class="btn-group shadow-1"
                                                            action="{{ route('admin.descargarEvidencias', ['proyectoId' => $grupo->first()->proyectoId]) }}"
                                                            method="GET">
                                                            <button type="submit"
                                                                class="button3 efects_button btn_eliminar3">
                                                                <i class="fas fa-download"></i>
                                                            </button>
                                                        </form>
                                                    </td>




                                                </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>

                            </div>

                        </div>

                        <div class="paginator-container">
                            <nav aria-label="..."
                                style="display: flex; justify-content: space-between; align-items: center; align-items: baseline; color: gray;">
                                <div id="totalRows">Asignaciones: {{ $paginator->total() }}</div>

                                <ul class="pagination d-flex align-items-center">



                                    <li class="page-item mx-3 d-flex align-items-center">
                                        <form method="GET" action="{{ route('coordinador.index') }}#tablaAsignaciones"
                                            class="form-inline">
                                            <div class="form-group">
                                                <label for="perPage2" class="sr-only">Items per page</label>
                                                <select class="form-control page-item" name="perPage2" id="perPage2"
                                                    onchange="this.form.submit()">
                                                    <option value="10"
                                                        @if ($perPage2 == 10) selected @endif>
                                                        10</option>
                                                    <option value="20"
                                                        @if ($perPage2 == 20) selected @endif>
                                                        20</option>
                                                    <option value="50"
                                                        @if ($perPage2 == 50) selected @endif>
                                                        50</option>
                                                    <option value="100"
                                                        @if ($perPage2 == 100) selected @endif>
                                                        100</option>
                                                </select>
                                            </div>
                                        </form>
                                    </li>

                                    @if ($paginator->onFirstPage())
                                        <li class="page-item disabled">
                                            <span class="page-link">Anterior</span>
                                        </li>
                                    @else
                                        <li class="page-item">
                                            <a class="page-link"
                                                href="{{ $paginator->appends(['perPage2' => $perPage2, 'search2' => $search2])->previousPageUrl() }}#tablaAsignaciones"
                                                aria-label="Anterior">Anterior</a>
                                        </li>
                                    @endif

                                    @for ($i = 1; $i <= $paginator->lastPage(); $i++)
                                        <li class="page-item {{ $paginator->currentPage() == $i ? 'active' : '' }}">
                                            <a class="page-link"
                                                href="{{ $paginator->appends(['perPage2' => $perPage2, 'search2' => $search2])->url($i) }}#tablaAsignaciones">{{ $i }}</a>
                                        </li>
                                    @endfor

                                    @if ($paginator->hasMorePages())
                                        <li class="page-item">
                                            <a class="page-link"
                                                href="{{ $paginator->appends(['perPage2' => $perPage2, 'search2' => $search2])->nextPageUrl() }}#tablaAsignaciones"
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

    </section>
    <hr>

    <!-- Asignar proyecto al estudiante -->
    <center>
        <button type="button" class="button1_1 efects_button"
            onclick="$('#draggableCardAsignarEstudiante').show();">Asignar docente con estudiante</button>

        <button type="button" class="button1_1 efects_button"
            onclick="$('#draggableCardAsignarDocente').show();">Asignar Docente</button>
    </center>
    <!-- Tarjeta movible para Asignar Estudiante -->
    <div class="draggable-card1_3" id="draggableCardAsignarEstudiante">
        <div class="card-header">
            <span class="card-title">Asignar Proyecto</span>
            <button type="button" class="close" onclick="$('#draggableCardAsignarEstudiante').hide()"><i
                    class="fa-thin fa-xmark"></i></button>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('admin.guardarAsignacion') }}">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="label" for="proyecto_id"><strong>Proyecto Disponible:</strong></label>
                            <select name="proyecto_id" id="proyecto_id" class="form-control input input_select">
                                <option value="">Seleccione un proyecto</option>
                                @foreach ($proyectosDisponibles as $proyecto)
                                    <option value="{{ $proyecto->proyectoId }}">
                                        @if ($proyecto->director)
                                            {{ $proyecto->director->apellidos }} {{ $proyecto->director->nombres }}
                                        @endif
                                        {{ $proyecto->codigoProyecto }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="label" for="ProfesorParticipante">Docente Participante:</label>
                            <select name="ProfesorParticipante" class="form-control input input_select" required>
                                <option value="">Seleccionar Docente Participante</option>
                                @foreach ($profesores as $profesor)
                                    <option value="{{ $profesor->id }}">
                                        {{ $profesor->apellidos }} {{ $profesor->nombres }} -
                                        {{ $profesor->departamento->departamento }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <br>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="label" for="estudiante_id"><strong>Estudiante Aprobado:</strong></label>
                            <select name="estudiante_id[]" id="estudiante_seleccion"
                                class="form-control input input_select" multiple="multiple">
                                @foreach ($estudiantesAprobados as $estudiante)
                                    <option value="{{ $estudiante->estudianteId }}">
                                        {{ $estudiante->nombres }} {{ $estudiante->apellidos }} -
                                        {{ trim($estudiante->carrera) === 'Ingeniería en Tecnologías de la información' ? 'ITIN' : $estudiante->carrera }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="label" for="nrc">Vinculacion NRC:</label>
                            <select name="nrc" id="nrc" class="form-control input input_select" required>
                                <option value="">Seleccionar NRC</option>
                                @foreach ($nrcs as $nrc)
                                    <option value="{{ $nrc->id }}"
                                        data-periodo="{{ $nrc->periodo->numeroPeriodo }} {{ $nrc->periodo->periodo }}">
                                        {{ $nrc->nrc }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="label" for="periodo"><strong>Periodo:</strong></label>
                            <input type="text" id="periodo" class="form-control input" readonly
                                placeholder="Periodo">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="label" for="FechaInicio">Fecha de Inicio de intervención en el
                                proyecto:</label>
                            <input type="date" name="FechaInicio" class="form-control input" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="label" for="FechaFinalizacion">Fecha de Fin de intervención en el
                                proyecto:</label>
                            <input type="date" name="FechaFinalizacion" class="form-control input" required>
                        </div>
                    </div>
                </div>
                <div class="card-footer  d-flex justify-content-center align-items-center">
                    <button type="submit" class="button">Asignar Proyecto</button>
                </div>
            </form>
        </div>
    </div>




    <!-- Asignar proyecto al docenteeeeeeeeeeeeeeeeeeeeeeeeeeee -->


    <div class="draggable-card1_3" id="draggableCardAsignarDocente">
        <div class="card-header">
            <span class="card-title">Asignar Docente</span>
            <button type="button" class="close" onclick="$('#draggableCardAsignarDocente').hide()"><i
                    class="fa-thin fa-xmark"></i></button>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('admin.guardarDocentesProyectos') }}">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="label" for="proyecto_id"><strong>Proyecto Disponible:</strong></label>
                            <select name="proyecto_id" id="proyecto_id" class="form-control input input_select">
                                <option value="">Seleccione un proyecto</option>
                                @foreach ($proyectosDisponibles as $proyecto)
                                    <option value="{{ $proyecto->proyectoId }}">
                                        @if ($proyecto->director)
                                            {{ $proyecto->director->apellidos }} {{ $proyecto->director->nombres }}
                                        @endif
                                        {{ $proyecto->codigoProyecto }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="label" for="ProfesorParticipante">Docente Participante:</label>
                            <select name="ProfesorParticipante" class="form-control input input_select" required>
                                <option value="">Seleccionar Docente Participante</option>
                                @foreach ($profesores as $profesor)
                                    <option value="{{ $profesor->id }}">
                                        Nombres: {{ $profesor->apellidos }} {{ $profesor->nombres }} - Departamento:
                                        {{ $profesor->departamento }} - Correo: {{ $profesor->correo }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <br>


                <div class="row">

                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="label" for="periodo"><strong>Periodo:</strong></label>
                            <select id="periodo" class="form-control input" name="periodo">
                                @foreach ($periodoAsignacion as $periodo)
                                    <option value="{{ $periodo->id }}">{{ $periodo->numeroPeriodo }}
                                        {{ $periodo->periodo }} </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="label" for="FechaInicio">Fecha de Inicio de intervención en el
                                proyecto:</label>
                            <input type="date" name="FechaInicio" class="form-control input" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="label" for="FechaFinalizacion">Fecha de Fin de intervención en el
                                proyecto:</label>
                            <input type="date" name="FechaFinalizacion"
                                class="form-control input {{ $errors->has('FechaFinalizacion') ? 'is-invalid' : '' }}"
                                required>
                            @if ($errors->has('FechaFinalizacion'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('FechaFinalizacion') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="card-footer  d-flex justify-content-center align-items-center">
                    <button type="submit" class="button">Asignar Docente</button>
                </div>
            </form>
        </div>
    </div>



    <!------------------------- BOTONES DEL ADMIN PARA PERIODO O NRC-------------------------->
    <!-- Tarjeta movible para Agregar NRC -->
    <div class="draggable-card" id="draggableCardNRC">
        <div class="card-header">
            <span class="card-title">Agregar NRC</span>
            <button type="button" class="close" onclick="$('#draggableCardNRC').hide()"><i
                    class="fa-thin fa-xmark"></i></button>
        </div>
        <div class="card-body">
            <form class="FormularioNRC" action="{{ route('admin.nrcVinculacion') }}" method="post">
                @csrf
                <div class="form-group">
                    <label class="label" for="nrc"><strong>Ingrese el NRC:</strong></label>
                    <input type="text" id="nrc" name="nrc" class="form-control input"
                        placeholder="Ingrese 5 números" pattern="\d{5}" title="Ingrese exactamente 5 dígitos"
                        value="{{ old('nrc') }}" required>
                    <small id="nrcError" class="form-text text-danger" style="display: none;"></small>
                    @error('nrc')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="periodo"><strong>Seleccione el período:</strong></label>
                    <select id="periodo" name="periodo" class="form-control input_select input" required>
                        <option value="">Seleccione un período</option>
                        @foreach ($periodos as $periodo)
                            <option value="{{ $periodo->id }}" {{ old('periodo') == $periodo->id ? 'selected' : '' }}>
                                {{ $periodo->numeroPeriodo }} - {{ $periodo->periodo }}
                            </option>
                        @endforeach
                    </select>
                    @error('periodo')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="tipo"><strong>Tipo de proceso:</strong></label>
                    <select id="tipo" name="tipo" class="form-control input_select input" required>
                        <option value="">Seleccione el proceso</option>
                        <option value="Vinculacion">Vinculación con la Sociedad</option>
                        <option value="Practicas">Prácticas preprofesionales</option>
                    </select>
                    @error('tipo')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="card-footer1 d-flex justify-content-center align-items-center">
                    <button type="submit" class="button01">Guardar NRC</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Tarjeta movible para Agregar Periodo -->
    <div class="draggable-card" id="draggableCardPeriodo">
        <div class="card-header">
            <span class="card-title">Agregar Periodo</span>
            <button type="button" class="close" onclick="$('#draggableCardPeriodo').hide()"><i
                    class="fa-thin fa-xmark"></i></button>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.guardarPeriodo') }}" method="post">
                @csrf
                <div class="form-group">
                    <label for="periodoInicio"><strong>Ingrese el inicio del Periodo
                            Académico:</strong></label>
                    <input type="date" id="periodoInicio" name="periodoInicio" class="form-control input"
                        value="{{ old('periodoInicio') }}" required>
                    @error('periodoInicio')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="periodoFin"><strong>Ingrese el fin del Periodo Académico:</strong></label>
                    <input type="date" id="periodoFin" name="periodoFin" class="form-control input"
                        value="{{ old('periodoFin') }}" required>
                    @error('periodoFin')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="numeroPeriodo"><strong>Ingrese el número identificador del
                            periodo:</strong></label>
                    <input type="text" id="numeroPeriodo" name="numeroPeriodo" placeholder="Ingrese 6 números"
                        class="form-control input" pattern="[0-9]{1,6}"
                        title="Ingrese un número no negativo de hasta 6 dígitos" value="{{ old('numeroPeriodo') }}"
                        required>
                    <small id="numeroPeriodoError" class="form-text text-danger" style="display: none;"></small>
                    @error('numeroPeriodo')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="card-footer1 d-flex justify-content-center align-items-center">
                    <button type="submit" class="button01">Guardar Periodo</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Tarjeta movible para Editar Periodo -->
    <div class="draggable-card" id="draggableCardEditarPeriodo">
        <div class="card-header">
            <span class="card-title">Editar Periodo</span>
            <button type="button" class="close" onclick="$('#draggableCardEditarPeriodo').hide()"><i
                    class="fa-thin fa-xmark"></i></button>
        </div>
        <div class="card-body">
            <div class="form-group col-md-12">
                <label for="periodo"><strong>Periodos Agregados (Seleccione el periodo a
                        editar):</strong></label>
                <select id="selectPeriodo" class="form-control input input_select">
                    <option value="" data-inicio="" data-fin="" data-numero="">Seleccionar Periodo
                    </option>
                    @foreach ($periodos as $periodo)
                        <option value="{{ $periodo->id }}" data-inicio="{{ $periodo->inicioPeriodo }}"
                            data-fin="{{ $periodo->finPeriodo }}" data-numero="{{ $periodo->numeroPeriodo }}">
                            {{ $periodo->numeroPeriodo }} {{ $periodo->periodo }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-12" hidden>
                <div class="form-group col-md-6">
                    <form id="editarPeriodoForm" method="GET">
                        @csrf
                        <button type="submit" class="button">Editar</button>
                    </form>
                </div>
            </div>
            <div class="col-md-12" id="desplegarEditarPeriodo">
                <form class="formulario" method="POST"
                    action="{{ route('admin.actualizarPeriodo', ['id' => $periodo->id]) }}">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="periodoInicio">Fecha de Inicio:</label>
                        <input type="date" name="periodoInicio" id="periodoInicio" class="form-control input"
                            value="" required>
                    </div>
                    <div class="form-group">
                        <label for="periodoFin">Fecha de Fin:</label>
                        <input type="date" name="periodoFin" id="periodoFin" class="form-control input"
                            value="" required>
                    </div>
                    <div class="form-group">
                        <label for="numeroPeriodo">Ingrese el numero identificador del periodo:</label>
                        <input type="text" name="numeroPeriodo" id="numeroPeriodo" class="form-control input"
                            value="" required>
                    </div>
                    <div class="card-footer1 d-flex justify-content-center align-items-center">
                        <center><button type="submit" class="button01">Guardar Cambios</button></center>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <div class="draggable-card" id="modalEditarFecha" style="display: none;">
        <div class="card-header">
            <span class="card-title">Editar Fecha</span>
            <button type="button" class="close" onclick="$('#modalEditarFecha').hide()"><i
                    class="fa-thin fa-xmark"></i></button>
        </div>
        <div class="card-body">
            <form id="formEditarFecha" method="POST" action="{{ route('admin.updateFecha') }}">
                @csrf
                @method('PATCH')

                <input type="hidden" name="estudiante_id" id="estudiante_id">
                <input type="hidden" name="tipo_fecha" id="tipo_fecha">

                <div class="form-group col-md-12">
                    <label for="nombre_estudiante"><strong>Nombre del Estudiante:</strong></label>
                    <input type="text" name="nombre_estudiante" id="nombre_estudiante" class="form-control input"
                        readonly>
                </div>

                <div class="form-group col-md-12">
                    <label for="fecha"><strong>Selecciona la nueva fecha:</strong></label>
                    <input type="date" name="fecha" id="fecha" class="form-control input" required>
                </div>

                <div class="card-footer1 d-flex justify-content-center align-items-center">
                    <center><button type="submit" class="button01">Guardar Cambios</button></center>
                </div>
            </form>
        </div>
    </div>

    <div id="editStudentModal" class="draggable-card" style="display: none;">
        <div class="modal-content">
            <div class="card-header">
                <span class="card-title">Detalles del Estudiante</span>
                <button type="button" class="close" onclick="$('#editStudentModal').hide()">
                    <i class="fa-thin fa-xmark"></i>
                </button>
            </div>
            <div class="card-body">
                <form id="editStudentForm" action="{{ route('admin.actualizarEstudiantes') }}" method="POST">
                    @csrf
                    @method('PUT') <!-- Usamos PUT ya que estamos actualizando -->

                    <input type="hidden" name="estudiante_id" id="estudiante_id_modal">

                    <div class="form-group">
                        <label for="nombre_estudiante_modal"><strong>Nombre del Estudiante:</strong></label>
                        <input type="text" id="nombre_estudiante_modal" class="form-control input" readonly>
                    </div>

                    <div class="form-group">
                        <label for="proyecto_id"><strong>Proyecto Disponible:</strong></label>
                        <select id="proyecto_id_modal" name="proyecto_id" class="form-control input input_select"
                            required>
                            <option value="">Seleccione un proyecto</option>
                            @foreach ($proyectosDisponibles as $proyecto)
                                <option value="{{ $proyecto->proyectoId }}">{{ $proyecto->director->nombres }}
                                    {{ $proyecto->director->apellidos }} {{ $proyecto->codigoProyecto }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="nrc"><strong>NRC:</strong></label>
                        <select id="nrc_modal" name="nrc" class="form-control input input_select">
                            <option value="">Seleccione un NRC</option>
                            @foreach ($nrcs as $nrc)
                                <option value="{{ $nrc->id }}">{{ $nrc->nrc }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="card-footer d-flex justify-content-center align-items-center">
                        <button type="submit" class="button">Guardar Cambios</button>
                    </div>
                </form>
            </div>
        </div>
    </div>




    </section>
    <link rel="stylesheet" href="https://cdn.ckeditor.com/4.16.1/standard/ckeditor.css">
    <script src="https://cdn.ckeditor.com/4.16.1/standard/ckeditor.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('js/admin/acciones.js') }}"></script>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $(document).ready(function() {
            // Usamos event delegation para manejar los clicks en los enlaces de fecha
            $(document).on('click', '.edit-date', function(e) {
                e.preventDefault();

                // Obtener los datos de la fecha seleccionada y el estudiante
                var fecha = $(this).data('fecha');
                var estudianteId = $(this).data('estudiante-id');
                var tipo = $(this).data('tipo');

                // Establecer los valores en el modal
                $('#fecha').val(fecha);
                $('#estudiante_id').val(estudianteId);
                $('#tipo_fecha').val(tipo);

                // Cargar el nombre del estudiante en el modal
                loadStudentName(estudianteId);

                // Mostrar el modal
                $('#modalEditarFecha').show();
            });

            // Hacer el modal draggable
            $('#modalEditarFecha').draggable({
                handle: ".card-header"
            });
        });

        // Si prefieres hacer una consulta AJAX al servidor (en lugar de pasar la lista completa de estudiantes):
        function loadStudentName(estudianteId) {
            $.ajax({
                url: '/admin/estudiante/' + estudianteId, // Ruta que devuelve los datos del estudiante
                method: 'GET',
                success: function(response) {
                    if (response.success) {
                        $('#nombre_estudiante').val(response.estudiante.apellidos + ' ' + response.estudiante
                            .nombres);
                    } else {
                        $('#nombre_estudiante').val('Estudiante no encontrado');
                    }
                },
                error: function(xhr) {
                    console.log(xhr.responseText);
                    $('#nombre_estudiante').val('Error al cargar los datos');
                }
            });
        }
    </script>

    <script>
        $(document).ready(function() {
            $('#estado, #departamento').change(function() {
                $('#hiddenEstado').val($('#estado').val());
                $('#hiddenDepartamento').val($('#departamento').val());
            });
        });
    </script>
    <script>
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
                        $('#tablaProyectos').html($(response).find('#tablaProyectos').html());
                    }
                });
            }, 500);
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const nrcSelect = document.getElementById('nrc');
            const periodoInput = document.getElementById('periodo');
            nrcSelect.addEventListener('change', function() {
                const selectedOption = nrcSelect.options[nrcSelect.selectedIndex];
                const periodo = selectedOption.getAttribute('data-periodo');
                periodoInput.value = periodo ? periodo : '';
            });
        });
    </script>
    <script>
        var delayTimer;
        $('#formBusquedaAsignaciones input[name="search2"]').on('keyup', function() {
            clearTimeout(delayTimer);
            var query = $(this).val();
            delayTimer = setTimeout(function() {
                $.ajax({
                    url: '{{ route('coordinador.index') }}',
                    type: 'GET',
                    data: {
                        search2: query
                    },
                    success: function(response) {
                        $('#tablaAsignaciones').html($(response).find('#tablaAsignaciones')
                            .html());
                    }
                });
            }, 500);
        });

        function resetFiltersProyectos() {
            document.getElementById('estado').value = '';
            document.getElementById('filterFormProyectos').reset();
            submitFormAndKeepOpen('filterFormProyectos');
        }

        function resetFiltersProfesores() {
            document.getElementById('profesor').value = '';
            document.getElementById('periodos').value = '';
            document.getElementById('filterFormProfesores').reset();
            submitFormAndKeepOpen('filterFormProfesores');
        }

        function submitFormAndKeepOpen(formId) {
            let form = document.getElementById(formId);
            let formData = new FormData(form);
            let url = form.action;

            fetch(url + '?' + new URLSearchParams(formData).toString(), {
                    method: 'GET',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(response => response.text())
                .then(html => {
                    document.getElementById('tablaProyectos').innerHTML = html;
                })
                .catch(error => console.error('Error:', error));
        }
    </script>

    <script>
        $(document).ready(function() {
            $('#draggableCardAsignarEstudiante').draggable({
                handle: ".card-header"
            });

            $('#estudiante_seleccion').select2({
                placeholder: "Seleccione un estudiante",
                closeOnSelect: false,
                width: 'resolve',
                templateResult: formatState,
                templateSelection: formatSelection,
                escapeMarkup: function(markup) {
                    return markup;
                }
            }).on('select2:select', function(e) {
                var element = e.params.data.element;
                var $element = $(element);
                $element.detach();
                $(this).append($element).trigger('change');
            }).on('select2:unselect', function(e) {
                var element = e.params.data.element;
                var $element = $(element);
                $element.detach();
                $(this).append($element).trigger('change');
            });

            function formatState(state) {
                if (!state.id) {
                    return state.text;
                }
                var $state = $(
                    '<span><input type="checkbox" class="styled-checkbox" /> ' + state.text + '</span>'
                );
                return $state;
            }

            function formatSelection(state) {
                if (!state.id) {
                    return state.text;
                }
                var $state = $(
                    '<span>' + state.text + '</span>'
                );
                return $state;
            }
        });

        // Hacer el card draggable

        $(document).ready(function() {
            // Hacer que los cards sean draggable
            $('.draggable-card1_1').draggable({
                handle: ".card-header",
                containment: "window"
            });
        });
        $(document).ready(function() {
            // Hacer que los cards sean draggable
            $('.draggable-card1_4').draggable({
                handle: ".card-header",
                containment: "window"
            });
        });
        $(document).ready(function() {
            // Hacer que los cards sean draggable
            $('.draggable-card1_3').draggable({
                handle: ".card-header",
                containment: "window"
            });
        });
        $(document).ready(function() {
            // Hacer que el card sea draggable
            $('.draggable-card1_2').draggable({
                handle: ".card-header",
                containment: "window"
            });


            // Enviar el formulario cuando cambian los select
            $('#filtersForm select').change(function() {
                applyFilter('#filtersForm', '#tablaProyectos');
            });
            $('#filterFormProfesores select').change(function() {
                applyFilter('#filterFormProfesores', '#tablaAsignaciones');
            });

        });

        function openCard(cardId) {
            $('#' + cardId).css({
                top: '100px',
                left: '1px'
            }).show();
        }

        function closeCard(cardId) {
            $('#' + cardId).hide();
        }

        function applyFilter(formId = '#filtersForm', tableId = '#tablaProyectos') {
            $.ajax({
                url: $(formId).attr('action'),
                data: $(formId).serialize(),
                success: function(data) {
                    if (tableId === '#tablaProyectos') {
                        $(tableId).html($(data).find('#tablaProyectos').html());
                    } else if (tableId === '#tablaAsignaciones') {
                        $(tableId).html($(data).find('#tablaAsignaciones').html());
                    }
                },
                error: function() {
                    showAlert('errorAlert1', 'Error al aplicar el filtro');
                }
            });
        }

        function resetFilters() {
            $('#filtersForm')[0].reset();
            applyFilter('#filtersForm', '#tablaProyectos');
        }

        function resetFiltersProfesores() {
            $('#filterFormProfesores')[0].reset();
            applyFilter('#filterFormProfesores', '#tablaAsignaciones');
        }


        document.addEventListener('DOMContentLoaded', function() {
            const nrcSelect = document.getElementById('nrc');
            const periodoInput = document.getElementById('periodo');

            nrcSelect.addEventListener('change', function() {
                const selectedOption = nrcSelect.options[nrcSelect.selectedIndex];
                const periodo = selectedOption.getAttribute('data-periodo');
                periodoInput.value = periodo ? periodo : '';
            });
        });



        $('#modalImportar').on('hidden.bs.modal', function() {
            console.log('Modal hidden');
            $('#idModalImportar')[0].reset();
            $('#idModalImportar').find('.form-group').removeClass('has-error');
            $('#idModalImportar').find('.help-block').text('');
            removeFile();
        });


        function displayFileName(input, fileTextId) {
            const fileName = input.files[0].name;
            document.getElementById(fileTextId).textContent = fileName;
            document.querySelector('.remove-icon').style.display = 'inline'; // Mostrar la "X"
        }

        function removeFile(inputId, fileTextId) {
            document.getElementById(inputId).value = ""; // Clear the input
            document.getElementById(fileTextId).innerHTML =
                '<i class="fa fa-upload"></i> Haz clic aquí para subir el documento'; // Reset the text
            document.querySelector('.remove-icon').style.display = 'none'; // Ocultar la "X"
        }

        function showAlert(alertId, message) {
            const alert = document.getElementById(alertId);
            alert.querySelector('.body').textContent = message;
            alert.style.display = 'flex';
            setTimeout(() => {
                closeAlert(alertId);
            }, 5000); // Ocultar automáticamente después de 5 segundos
        }

        function closeAlert(alertId) {
            const alert = document.getElementById(alertId);
            alert.style.display = 'none';
        }
    </script>

    <script>
        document.getElementById('reportForm').addEventListener('submit', function() {
            document.getElementById('hiddenFechaInicio').value = document.getElementById('fechaInicio').value;
            document.getElementById('hiddenFechaFin').value = document.getElementById('fechaFin').value;
            document.getElementById('hiddenProfesor').value = document.getElementById('profesor').value;
            document.getElementById('hiddenPeriodos').value = document.getElementById('periodos').value;
        });
    </script>

    <script>
        function displayFileName(input, fileTextId) {
            const fileName = input.files[0]?.name || 'Haz clic aquí para subir el documento';
            document.getElementById(fileTextId).textContent = fileName;
        }

        function showImportConfirmation() {
            const fileInput = document.getElementById('file2');

            // Validar que un archivo esté seleccionado
            if (!fileInput.files.length) {
                Swal.fire('Error', 'Por favor, seleccione un archivo primero.', 'error');
                return;
            }

            const formData = new FormData();
            formData.append('file', fileInput.files[0]);

            // Mostrar SweetAlert de carga
            Swal.fire({
                title: 'Cargando...',
                text: 'Procesando archivo, por favor espere',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });

            // Realizar la solicitud AJAX para previsualizar la importación
            fetch('{{ route('import.preview') }}', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    Swal.close(); // Cerrar la alerta de carga
                    Swal.fire({
                        title: 'Confirmación de Importación',
                        html: `
                    <p>Se van a <strong>insertar</strong> ${data.insertCount} registros.</p>
                    <p>Se van a <strong>actualizar</strong> ${data.updateCount} registros.</p>
                    <p>¿Deseas proceder con esta operación?</p>
                `,
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Sí, proceder',
                        cancelButtonText: 'Cancelar',
                    }).then((result) => {
                        if (result.isConfirmed) {
                            document.getElementById('idModalImportar2').submit();
                        }
                    });
                })
                .catch(error => {
                    Swal.close(); // Cerrar la alerta de carga
                    Swal.fire('Error', 'Ocurrió un error al previsualizar la importación.', 'error');
                    console.error('Error:', error);
                });
        }

        function removeFile(span) {
            const fileInput = document.getElementById('file2');
            fileInput.value = ''; // Limpiar el input file
            document.getElementById('fileText2').textContent = 'Haz clic aquí para subir el documento'; // Resetear el texto
        }
    </script>

    <script>
        $(document).ready(function() {
            // Event listener for when a student name link is clicked
            $('.edit-student').click(function(event) {
                event.preventDefault(); // Prevent default link behavior

                // Obtener los datos del estudiante del enlace (data-*)
                var estudianteId = $(this).data('id');
                var nombres = $(this).data('nombres');
                var apellidos = $(this).data('apellidos');
                var proyectoId = $(this).data('proyecto-id'); // Proyecto actual asignado
                var nrcId = $(this).data('nrc-id'); // NRC actual asignado

                // Asignar el valor del ID del estudiante al input oculto
                $('#estudiante_id_modal').val(estudianteId);

                // Asignar los otros valores a los campos del modal
                $('#nombre_estudiante_modal').val(apellidos + ' ' + nombres);
                $('#proyecto_id_modal').val(proyectoId);
                $('#nrc_modal').val(nrcId);

                // Mostrar el modal
                $('#editStudentModal').show();
            });

            // Hacer que el modal sea draggable (opcional)
            $('#editStudentModal').draggable({
                handle: ".card-header"
            });
        });
    </script>





    <script src="{{ asset('js\admin\index.js') }}"></script>

    <style>
        .btn_revertir3 {
            color: #ffc107;
            /* Puedes ajustar este color para que coincida con el estilo deseado */
            background-color: transparent;
            border: none;
            padding: 0;
            font-size: 1.5em;
            /* Ajusta el tamaño del ícono si es necesario */
        }
    </style>


@endsection
