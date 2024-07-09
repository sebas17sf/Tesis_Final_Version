@extends('layouts.admin')

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
            <hr>

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
                                        <th class="tamanio">NOMBRE DEL PROYECTO</th>
                                        <th class="tamanio4">DIRECTOR</th>
                                        <th class="tamanio">DESCRIPCIÓN</th>
                                        <th>DEPARTAMENTO</th>
                                        <th class="tamanio3">CÓDIGO DEL PROYECTO SOCIAL</th>
                                        <th>FECHA INICIO</th>
                                        <th>FECHA FIN</th>
                                        <th>ESTADO DEL PROYECTO</th>
                                        <th>ACCIONES</th>
                                    </tr>
                                </thead>
                                <tbody class="mdc-data-table__content ng-star-inserted">
                                    @if ($proyectos->isEmpty())
                                        <tr style="text-align:center">
                                            <td class="noExisteRegistro1" style="font-size: 16px !important;"colspan="10">
                                                No hay estudiantes en proceso de revisión.</td>
                                        </tr>
                                    @else
                                        @foreach ($proyectos as $proyecto)
                                            <tr>
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
                                                    {{ strtoupper($proyecto->departamentoTutor) }}
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
                                                        <a href="{{ route('admin.editarProyecto', ['ProyectoID' => $proyecto->proyectoId]) }}"
                                                            type="button" class="button3 efects_button btn_editar3">
                                                            <i class="bx bx-edit-alt"></i>
                                                        </a>
                                                    </div>
                                                    <form class="btn-group shadow-1" id="deleteProjectForm"
                                                        action="{{ route('admin.deleteProyecto', ['ProyectoID' => $proyecto->proyectoId]) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="button3 efects_button btn_eliminar3"
                                                            onclick="confirmDeleteProject(event)"><i
                                                                class='bx bx-trash'></i></button>
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
                                    <form method="GET" action="{{ route('admin.indexProyectos') }}#tablaProyectos">
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
                                <!-- Botones -->
                                <div class="tooltip-container mx-1">
                                    <span class="tooltip-text">Excel</span>
                                    <form action="{{ route('reporte.matrizVinculacion') }}" method="POST">
                                        @csrf
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
                                                <button type="submit" class="button">Importar Archivo</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>

                                <!-- Botón de Filtros para Profesores y Periodos -->
                                <div class="tooltip-container mx-1">
                                    <span class="tooltip-text">Filtros</span>
                                    <button class="button3 efects_button btn_filtro"
                                        onclick="openCard('filtersCardProfesores');">
                                        <i class="fa-solid fa-filter-list"></i>
                                    </button>
                                </div>

                                <!-- Card de Filtros para Profesores y Periodos -->
                                <div class="draggable-card1_2" id="filtersCardProfesores" style="display: none;">
                                    <div class="card-header">
                                        <span class="card-title">Filtros Profesores y Periodos</span>
                                        <button type="button" class="close"
                                            onclick="closeCard('filtersCardProfesores')"><i
                                                class="fa-thin fa-xmark"></i></button>
                                    </div>
                                    <div class="card-body">
                                        <form id="filterFormProfesores" method="GET"
                                            action="{{ route('admin.indexProyectos') }}">
                                            <div class="form-group">
                                                <label for="profesor">Profesor</label>
                                                <select name="profesor" id="profesor"
                                                    class="form-control input input_select">
                                                    <option value="">Todos los docentes</option>
                                                    @foreach ($profesores as $profesor)
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
                                    <span aria-hidden="true">&times;</span>
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
                                            <th class="tamanio"> NOMBRE DE PROYECTO</th>
                                            <th class="tamanio3">CÓDIGO DE PROYECTO</th>
                                            <th class="tamanio4">DIRECTOR</th>
                                            <th class="tamanio4">DOCENTES PARTICIPANTES</th>
                                            <th>FECHA ASIGNACIÓN</th>
                                            <th>ESTUDIANTES</th>
                                            <th>HORAS REALIZADAS</th>
                                            <th>NOTA</th>
                                            <th>PERIODO</th>
                                            <th>NRC</th>
                                            <th>FECHA INICIO</th>
                                            <th>FECHA FIN</th>
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
                                                    <td>{{ $grupo->first()->asignacionFecha ?? '' }}</td>

                                                    <td
                                                        style=" text-transform: uppercase; text-align: left; white-space: nowrap; overflow: hidden;">

                                                        @foreach ($grupo as $asignacion)
                                                            {{ $asignacion->estudiante->apellidos ?? '' }}
                                                            {{ $asignacion->estudiante->nombres ?? '' }}<br>
                                                        @endforeach

                                                    </td>

                                                    <td>
                                                        @foreach ($grupo as $asignacion)
                                                            @foreach ($asignacion->estudiante->horas_vinculacion as $hora)
                                                                {{ $hora->horasVinculacion ?? '' }}<br>
                                                            @endforeach
                                                        @endforeach
                                                    </td>

                                                    <td>
                                                        @foreach ($grupo as $asignacion)
                                                            @foreach ($asignacion->estudiante->notas as $nota)
                                                                {{ $nota->notaFinal ?? 'Sin calificar' }}<br>
                                                            @endforeach
                                                        @endforeach
                                                    </td>
                                                    </td>
                                                    </td>
                                                    <td>{{ $grupo->first()->periodo->numeroPeriodo ?? '' }}</td>
                                                    <td>{{ $grupo->first()->nrcVinculacion->nrc ?? 'NO REQUERIA DE NRC' }}
                                                    </td>
                                                    <td>{{ $grupo->first()->inicioFecha ?? '' }}</td>
                                                    <td>{{ $grupo->first()->finalizacionFecha ?? '' }}</td>
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
                                        <form method="GET"
                                            action="{{ route('admin.indexProyectos') }}#tablaAsignaciones"
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
                                        {{ $profesor->departamento }}
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
            <button type="button" class="close" onclick="$('#draggableCardAsignarDocente').hide()">&times;</button>
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



    </section>
    <link rel="stylesheet" href="https://cdn.ckeditor.com/4.16.1/standard/ckeditor.css">
    <script src="https://cdn.ckeditor.com/4.16.1/standard/ckeditor.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('js/admin/acciones.js') }}"></script>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
                    url: '{{ route('admin.indexProyectos') }}',
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
                    url: '{{ route('admin.indexProyectos') }}',
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
@endsection
