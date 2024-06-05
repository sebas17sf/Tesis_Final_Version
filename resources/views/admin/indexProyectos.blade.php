@extends('layouts.admin')

@section('title', 'Proyectos')

@section('title_component', 'Proyectos')

@section('content')

    @if (session('exito'))
        <div class="contenedor_alerta success">
            <div class="icon_alert"><i class="fa-sharp fa-regular fa-check"></i></div>
            <div class="content_alert">
                <div class="title">Éxito!</div>
                <div class="body">{{ session('exito') }}</div>
            </div>
            <div class="icon_remove">
                <button class="button4 btn_3_2"><i class="fa-sharp fa-regular fa-xmark"></i></button>
            </div>
        </div>
    @endif

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


    <section>
        <div class="contenedor_registro_genero ">
            <h4><b>Listado de Proyectos</b></h4>
            <hr>

            <div class="mat-elevation-z8 contenedor_general">
                <div class="contenedor_acciones_tabla sidebar_active_content_acciones_tabla">
                    <!-- Botones -->
                    <div class="row">
                        <div class="col-md-12 d-flex align-items-center">
                            <!-- Formulario para exportar a Excel -->






                            <form method="POST" action="{{ route('coordinador.reportesProyectos') }}"
                                class="form-inline mr-2 d-flex align-items-center">
                                @csrf
                                <div class="tooltip-container">
                                    <span class="tooltip-text">Excel</span>
                                    <button type="submit" class="button3 efects_button btn_excel" pTooltip="Excel"
                                        tooltipPosition="top">
                                        <i class="fa-solid fa-file-excel"></i>
                                    </button>
                                </div>
                            </form>





                            <!-- Botón para agregar proyecto -->
                            <div class="tooltip-container mr-2">
                                <span class="tooltip-text">Agregar</span>
                                <button type="button" onclick="location.href='{{ route('admin.agregarProyecto') }}';"
                                    class="button3 efects_button btn_primary" id="button3">
                                    <i class="fa-solid fa-plus"></i>
                                </button>
                            </div>

                            <!-- Selector de estado del proyecto -->
                            <div class="form-group mr-2">
                                <label for="estado" class="mr-2"> Estado del Proyecto:</label>
                                <form method="GET" action="{{ route('admin.indexProyectos') }}">
                                    <select name="estado" id="estado" class="form-control input input_select"
                                        onchange="this.form.submit()">
                                        <option value="">Todos</option>
                                        <option value="Ejecucion" {{ old('estado') == 'Ejecucion' ? 'selected' : '' }}>En
                                            Ejecución</option>
                                        <option value="Terminado" {{ old('estado') == 'Terminado' ? 'selected' : '' }}>
                                            Terminado
                                        </option>
                                    </select>
                                </form>
                            </div>

                        </div>
                    </div>


                    <!-- Buscador -->
                    <div class="contenedor_buscador">
                        <div>
                            <form id="formBusquedaProyectos">
                                <input type="text" class="input" name="search" value="{{ $search }}" matInput
                                    placeholder="Buscar proyectos...">
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
                                        <th>DIRECTOR</th>
                                        <th class="tamanio">DESCRIPCION</th>
                                        <th>DEPARTAMENTO</th>
                                        <th>CODIGO DEL PROYECTO SOCIAL</th>
                                        <th>ESTADO DEL PROYECTO</th>
                                        <th>ACCIONES</th>
                                    </tr>
                                </thead>
                                <tbody class="mdc-data-table__content ng-star-inserted">
                                    @if ($proyectos->isEmpty())

                                        <tr class="noExisteRegistro ng-star-inserted" style="text-align:center">

                                            <td colspan="6">No se encontraron resultados para la busqueda</td>
                                        </tr>
                                    @else
                                        @foreach ($proyectos as $proyecto)
                                            <tr>
                                                <td style="word-wrap: break-word; text-align: justify; padding: 5px 8px;">
                                                    {{ strtoupper($proyecto->NombreProyecto) }}</td>
                                                <td style="word-wrap: break-word; text-align: left;">
                                                    @if ($proyecto->director)
                                                        {{ strtoupper($proyecto->director->Apellidos) }}
                                                        {{ strtoupper($proyecto->director->Nombres) }}
                                                    @else
                                                        DIRECTOR NO ASIGNADO
                                                    @endif
                                                </td>

                                                <td style="word-wrap: break-word; text-align: justify; padding: 5px 8px;">
                                                    {{ strtoupper($proyecto->DescripcionProyecto) }}</td>

                                                <td>{{ strtoupper($proyecto->DepartamentoTutor) }}</td>
                                                <td>
                                                    @if (empty($proyecto->codigoProyecto))
                                                        {{ strtoupper('No requiere código de proyecto') }}
                                                    @else
                                                        {{ strtoupper($proyecto->codigoProyecto) }}
                                                    @endif
                                                </td>
                                                <td>{{ strtoupper($proyecto->Estado) }}</td>
                                                <td>
                                                        <div class="btn-group shadow-0">
                                                                <a href="{{ route('admin.editarProyecto', ['ProyectoID' => $proyecto->ProyectoID]) }}"
                                                                    type="button"
                                                                    class="button3 efects_button btn_editar3">
                                                                    <i class="bx bx-edit-alt"></i>
                                                                </a>
                                                            </div>
                                                    <form class="btn-group shadow-1" id="deleteProjectForm"
                                                          action="{{ route('admin.deleteProyecto', ['ProyectoID' => $proyecto->ProyectoID]) }}"
                                                          method="POST">
                                                        @csrf
                                                        @method('DELETE')

                                                        <button type="submit" class="button3 efects_button btn_eliminar3" onclick="confirmDeleteProject(event)"><i class='bx bx-trash'></i></button>
                                                    </form>
                                                        </dv>
                                                </td>
                                            </tr>
                                        @endforeach
                                </tbody>
                            </table>

                            @endif
                        </div>
                    </div>

                    <div class="paginator-container">
                        <nav aria-label="...">

                            <ul class="pagination">
                                <li class="page-item mx-3">


                                    <form method="GET" action="{{ route('admin.indexProyectos') }}#tablaProyectos">
                                        <select class="form-control page-item" class="input" name="perPage" id="perPage"
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
    </section>
    <br>
    <style>



    </style>
    <section>
        <div class="contenedor_registro_genero ">
            <h4><b>Listado de asignaciones</b></h4>
            <hr>

            <div class="mat-elevation-z8 contenedor_general">

                <div class="contenedor_acciones_tabla sidebar_active_content_acciones_tabla">
                    <!-- Fila de Botones -->
                    <div class="row">
                        <!-- Columna de Botones -->
                        <div class="col-md-12 d-flex align-items-center">

                            <!-- Botón de Matriz de Vinculación -->

                            <form id="reportForm" action="{{ route('reporte.matrizVinculacion') }}" method="POST"
                                onsubmit="submitForm(event)">
                                @csrf
                                <div class="tooltip-container mx-2">
                                    <span class="tooltip-text">Matriz de Vinculacion</span>
                                    <button type="submit" class="button3 efects_button btn_excel" id="submitButton">
                                        <span id="loadingIcon" style="display: none;">
                                            <img src="gif/load2.gif" alt="Loading" style="height: 20px;">
                                        </span>
                                        <i class="fa-solid fa-file-excel" id="excelIcon"></i>
                                    </button>
                                </div>
                            </form>



                            <!-- Formulario de Importación -->
                            <div class="tooltip-container">
                                <span class="tooltip-text">Importar archivo</span>
                                <button type="button" class="button3 efects_button btn_3" data-toggle="modal"
                                    data-target="#modalImportar">
                                    <i class="fa fa-upload"></i>
                                </button>
                            </div>

                            <div class="modal fade" id="modalImportar" tabindex="-1" role="dialog"
                                aria-labelledby="modalImportarLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <form id="idModalImportar" action="{{ route('import') }}" method="POST"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <div class="modal-header">
                                                <h5 class="modal-title">Importar archivo</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <div class="input input_file">
                                                        <span id="fileText" class="fileText">
                                                            <i class="fa fa-upload"></i> Haz clic aquí para subir el
                                                            documento
                                                        </span>
                                                        <input type="file" class="form-control-file input input_file"
                                                            id="file" name="file"
                                                            onchange="displayFileName(this)" required>
                                                        <span title="Eliminar archivo" onclick="removeFile(this)"
                                                            class="remove-icon">✖</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button id="cerrar_modal" type="button" class="button"
                                                    data-dismiss="modal">Cerrar</button>
                                                <button type="submit" class="button">Importar Archivo</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>


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
                                        <th>CODIGO DE PROYECTO</th>
                                        <th class="tamanio1">DIRECTOR</th>
                                        <th class="tamanio1">DOCENTES PARTICIPANTES</th>
                                        <th>FECHA ASIGNACION</th>
                                        <th class="tamanio">ESTUDIANTES</th>
                                        <th>PERIODO</th>
                                        <th>NRC</th>
                                        <th>FECHA INICIO</th>
                                        <th>FECHA FIN</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($asignacionesAgrupadas as $grupo)
                                        <tr>
                                            <td style="text-transform: uppercase; text-align: justify; padding: 5px 8px;">
                                                {{ $grupo->first()->proyecto->NombreProyecto ?? '' }}</td>
                                            <td>{{ $grupo->first()->proyecto->codigoProyecto ?? '' }}</td>

                                            <td style="text-transform: uppercase; text-align: left;">
                                                {{ $grupo->first()->proyecto->director->Apellidos ?? '' }}
                                                {{ $grupo->first()->proyecto->director->Nombres ?? '' }}</td>
                                            <td style="text-transform: uppercase; text-align: left;">

                                                {{ $grupo->first()->docenteParticipante->Apellidos ?? '' }}
                                                {{ $grupo->first()->docenteParticipante->Nombres ?? '' }}<br>

                                            </td>
                                            <td>{{ $grupo->first()->FechaAsignacion ?? '' }}</td>

                                            <td
                                                style=" text-transform: uppercase; text-align: left; white-space: nowrap; overflow: hidden;">

                                                @foreach ($grupo as $asignacion)
                                                    {{ $asignacion->estudiante->Apellidos ?? '' }}
                                                    {{ $asignacion->estudiante->Nombres ?? '' }}<br>
                                                @endforeach
                                            </td>
                                            <td>{{ $grupo->first()->periodo->numeroPeriodo ?? '' }}</td>
                                            <td>{{ $grupo->first()->nrcVinculacion->nrc ?? 'No requeria de NRC' }}</td>
                                            <td>{{ $grupo->first()->FechaInicio ?? '' }}</td>
                                            <td>{{ $grupo->first()->FechaFinalizacion ?? '' }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>
                    <div class="paginator-container">
                        <nav aria-label="...">
                            <ul class="pagination d-flex align-items-center">

                                <li class="page-item mx-3 d-flex align-items-center">
                                    <form id="filterForm" action="{{ route('admin.indexProyectos') }}" method="GET"
                                        class="form-inline" onsubmit="filterFormSubmit(event)">
                                        <div class="form-group mr-2">
                                            <label for="profesor" class="sr-only">Profesor</label>
                                            <select name="profesor" id="profesor" class="form-control"
                                                onchange="document.getElementById('filterForm').submit();">
                                                <option value="">Todos los docentes</option>
                                                @foreach ($profesores as $profesor)
                                                    <option value="{{ $profesor->id }}"
                                                        {{ request('profesor') == $profesor->id ? 'selected' : '' }}>
                                                        {{ $profesor->Apellidos }} {{ $profesor->Nombres }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group mr-2">
                                            <label for="periodos" class="sr-only">Períodos</label>
                                            <select name="periodos" id="periodos" class="form-control"
                                                onchange="document.getElementById('filterForm').submit();">
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
                                </li>

                                <li class="page-item mx-3 d-flex align-items-center">
                                    <form method="GET" action="{{ route('admin.indexProyectos') }}#tablaAsignaciones"
                                        class="form-inline">
                                        <div class="form-group">
                                            <label for="perPage2" class="sr-only">Items per page</label>
                                            <select class="form-control page-item" name="perPage2" id="perPage2"
                                                onchange="this.form.submit()">
                                                <option value="10" @if ($perPage2 == 10) selected @endif>
                                                    10</option>
                                                <option value="20" @if ($perPage2 == 20) selected @endif>
                                                    20</option>
                                                <option value="50" @if ($perPage2 == 50) selected @endif>
                                                    50</option>
                                                <option value="100" @if ($perPage2 == 100) selected @endif>
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
                                        <a class="page-link" href="{{ $paginator->previousPageUrl() }}#tablaAsignaciones"
                                            aria-label="Anterior">Anterior</a>
                                    </li>
                                @endif

                                @for ($i = 1; $i <= $paginator->lastPage(); $i++)
                                    <li class="page-item {{ $paginator->currentPage() == $i ? 'active' : '' }}">
                                        <a class="page-link"
                                            href="{{ $paginator->url($i) }}#tablaAsignaciones">{{ $i }}</a>
                                    </li>
                                @endfor

                                @if ($paginator->hasMorePages())
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $paginator->nextPageUrl() }}#tablaAsignaciones"
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

          <!-- Tu contenido aquí -->
    <center>
        <button type="button" class="button1_1 efects_button" onclick="$('#draggableCardAsignarEstudiante').show();">Asignar estudiante</button>
    </center>
    <!-- Tarjeta movible para Asignar Estudiante -->
    <div class="draggable-card1_1" id="draggableCardAsignarEstudiante" style="display: none;">
        <div class="card-header">
            <span class="card-title">Asignar Proyecto</span>
            <button type="button" class="close" onclick="$('#draggableCardAsignarEstudiante').hide()">&times;</button>
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
                                    <option value="{{ $proyecto->ProyectoID }}">
                                        @if ($proyecto->director)
                                            {{ $proyecto->director->Apellidos }} {{ $proyecto->director->Nombres }}
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
                                        Nombres: {{ $profesor->Apellidos }} {{ $profesor->Nombres }} - Departamento: {{
                                        $profesor->Departamento }} - Correo: {{ $profesor->Correo }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <br>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="label" for="estudiante_id"><strong>Estudiante Aprobado:</strong></label>
                            <select name="estudiante_id[]" id="estudiante_seleccion" class="form-control input input_select" multiple="multiple">
                                @foreach ($estudiantesAprobados as $estudiante)
                                    <option value="{{ $estudiante->EstudianteID }}">
                                        {{ $estudiante->Nombres }} {{ $estudiante->Apellidos }} - {{ $estudiante->Departamento }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="label" for="nrc">Vinculacion NRC:</label>
                            <select name="nrc" id="nrc" class="form-control input input_select" required>
                                <option value="">Seleccionar NRC</option>
                                @foreach ($nrcs as $nrc)
                                    <option value="{{ $nrc->id }}" data-periodo="{{ $nrc->periodo->numeroPeriodo }} {{ $nrc->periodo->Periodo }}">
                                        {{ $nrc->nrc }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="label" for="periodo"><strong>Periodo:</strong></label>
                            <input type="text" id="periodo" class="form-control input" readonly>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="label" for="FechaInicio">Fecha de Inicio de intervencion en el proyecto:</label>
                            <input type="date" name="FechaInicio" class="form-control input" required>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="label" for="FechaFinalizacion">Fecha de Fin de intervencion en el proyecto:</label>
                            <input type="date" name="FechaFinalizacion" class="form-control input" required>
                        </div>
                    </div>


                </div>

                <div class="card-footer">
                    <button type="button" class="button" onclick="$('#draggableCardAsignarEstudiante').hide()">Cerrar</button>
                    <button type="submit" class="button">Asignar Proyecto</button>
                </div>
            </form>
        </div>
    </div>

    <link rel="stylesheet" href="https://cdn.ckeditor.com/4.16.1/standard/ckeditor.css">
    <script src="https://cdn.ckeditor.com/4.16.1/standard/ckeditor.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="js\admin\acciones.js"></script>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
    </script>

    <script>
        $(document).ready(function() {
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
                    '<span><input type="checkbox" class="checkbox-item "  style="margin-right: 8px;" />' + state
                    .text + '</span>'
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

        function displayFileName(input) {
            const fileName = input.files[0].name;
            document.getElementById('fileText').textContent = fileName;
        }

        function removeFile(span) {
            const input = span.previousElementSibling;
            input.value = ""; // Clear the input
            document.getElementById('fileText').innerHTML =
                '<i class="fa-solid fa-arrow-up-from-bracket"></i> Haz clic aquí para subir el documento'; // Reset the text
        }

        $('#modalImportar').on('hidden.bs.modal', function() {
            console.log('Modal hidden');
            $('#idModalImportar')[0].reset();
            $('#idModalImportar').find('.form-group').removeClass('has-error');
            $('#idModalImportar').find('.help-block').text('');
            removeFile();
        });
    </script>




@endsection
