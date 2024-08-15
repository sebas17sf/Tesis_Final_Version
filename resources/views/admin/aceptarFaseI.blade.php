@extends('layouts.admin')
@section('title', 'Panel Prácticas')
@section('title_component', 'Panel Prácticas')
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

    <section class="contenedor_agregar_periodo">
        <h4><b>Estudiantes a realizar Prácticas</b></h4>
        <hr>
        <section>


            <div class="contenedor_tabla">
                <div class="table-container mat-elevation-z8">

                    <div id="tablaDocentes">
                        <table class="mat-mdc-table">
                            <thead class="ng-star-inserted">
                                <tr class="mat-mdc-header-row mdc-data-table__header-row cdk-header-row ng-star-inserted">

                                    <th style="min-width: 100px !important; text-transform: uppercase;">ESTUDIANTE</th>
                                    <th style="min-width: 100px !important; text-transform: uppercase;">PRÁCTICA</th>
                                    <th style="min-width: 120px !important; text-transform: uppercase;">TUTOR ACADÉMICO</th>
                                    <th style="min-width: 120px !important; text-transform: uppercase;">TUTOR EMPRESARIAL
                                    </th>
                                    <th style="min-width: 130px !important; text-transform: uppercase;">EMPRESA</th>
                                    <th style="min-width: 90px !important; text-transform: uppercase;">NRC</th>
                                    <th style="min-width: 100px !important; text-transform: uppercase;">PERIODO</th>
                                    <th style="min-width: 120px !important; text-transform: uppercase;">FECHA INICIO</th>
                                    <th style="min-width: 120px !important; text-transform: uppercase;">FECHA FIN</th>
                                    <th style="min-width: 100px !important; text-transform: uppercase;">HORAS PLANIFICADAS
                                    </th>
                                    <th style="min-width: 100px !important; text-transform: uppercase;">ESTADO</th>
                                    <th style="min-width: 90px !important; text-transform: uppercase;">ACCIÓN</th>
                                </tr>
                            </thead>
                            <tbody class="mdc-data-table__content ng-star-inserted">
                                @if ($estudiantesConPracticaI->isEmpty() && $estudiantesConPracticaII->isEmpty())
                                    <tr style="text-align:center">
                                        <td class="noExisteRegistro1" style="font-size: 16px !important;"colspan="15">No hay
                                            estudiantes en proceso de revisión.</td>
                                    </tr>
                                @endif
                                @foreach ($estudiantesConPracticaI as $practicaI)
                                    @if ($practicaI->estudiante)
                                        <tr>

                                            <td
                                                style="text-transform: uppercase; min-width: 220px;  text-align: left; font-size: .7em;">
                                                {{ strtoupper($practicaI->estudiante->apellidos) }}
                                                {{ strtoupper($practicaI->estudiante->nombres) }}</td>
                                            <td
                                                style="text-transform: uppercase; min-width: 150px;  text-align: left; font-size: .7em;">
                                                {{ strtoupper($practicaI->tipoPractica) }}</td>
                                            <td
                                                style="text-transform: uppercase; min-width: 130px;  text-align: left; font-size: .7em;">
                                                {{ strtoupper($practicaI->tutorAcademico->apellidos) }}
                                                {{ strtoupper($practicaI->tutorAcademico->nombres) }}</td>
                                            <td
                                                style="text-transform: uppercase; text-align: left; min-width: 130px; font-size: .7em;">
                                                {{ strtoupper($practicaI->NombreTutorEmpresarial) }}</td>
                                            <td
                                                style="text-transform: uppercase; text-align: left; min-width: 220px; font-size: .7em;">
                                                {{ strtoupper($practicaI->Empresa->nombreEmpresa) }}</td>
                                            <td
                                                style="text-transform: uppercase; min-width: 100px;  text-align: center; font-size: .7em;">
                                                {{ strtoupper(optional($nrcs->firstWhere('id', $practicaI->nrc))->nrc ?? 'NO CUENTA CON NRC') }}
                                            </td>
                                            <td
                                                style="text-transform: uppercase; min-width: 100px; text-align: center; font-size: .7em;">
                                                {{ strtoupper($practicaI->periodoPractica ?? 'NO REQUIERE PERIODO') }}
                                            </td>
                                            <td
                                                style="text-transform: uppercase; min-width: 100px; text-align: center; font-size: .7em;">
                                                {{ strtoupper($practicaI->FechaInicio) }}</td>
                                            <td
                                                style="text-transform: uppercase; min-width: 100px; text-align: center; font-size: .7em;">
                                                {{ strtoupper($practicaI->FechaFinalizacion) }}</td>
                                            <td style="text-transform: uppercase; text-align: center; font-size: .7em;">
                                                {{ strtoupper($practicaI->HorasPlanificadas) }}</td>
                                            <td
                                                style="text-transform: uppercase; min-width: 100px; text-align: center; font-size: .7em;">
                                                {{ $practicaI->Estado }}</td>
                                            <td style="text-transform: uppercase; text-align: center; font-size: .7em;">
                                                <form
                                                    action="{{ route('admin.actualizarEstadoEstudiante', ['id' => $practicaI->estudiante->estudianteId]) }}"
                                                    method="POST"
                                                    style="display: flex; align-items: center; justify-content: center;">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="hidden" name="id"
                                                        value="{{ $practicaI->estudiante->estudianteId }}"
                                                        class="input input_select3">
                                                    <select name="nuevoEstado"
                                                        class="form-control input1 input input_select3"
                                                        style="margin-right: 10px;">
                                                        <option value="En ejecucion">Aprobado</option>
                                                        <option value="Negado">Negar</option>
                                                    </select>
                                                    <button type="submit" class="button3"><i
                                                            class="bx bx-check"></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach

                                @foreach ($estudiantesConPracticaII as $practicaII)
                                    @if ($practicaII->estudiante)
                                        <tr>
                                            <td style="text-transform: uppercase; text-align: left;">
                                                {{ strtoupper($practicaII->estudiante->apellidos) }}
                                                {{ strtoupper($practicaII->estudiante->nombres) }}</td>
                                            <td style="text-transform: uppercase; text-align: left;">
                                                {{ strtoupper($practicaII->tipoPractica) }}</td>
                                            <td style="text-transform: uppercase; text-align: left;">
                                                {{ strtoupper($practicaII->tutorAcademico->apellidos) }}
                                                {{ strtoupper($practicaII->tutorAcademico->nombres) }}</td>
                                            <td style="text-transform: uppercase; text-align: left;">
                                                {{ strtoupper($practicaII->NombreTutorEmpresarial) }}</td>
                                            <td style="text-transform: uppercase; text-align: left;">
                                                {{ strtoupper($practicaII->Empresa->nombreEmpresa) }}</td>
                                            <td> {{ strtoupper(optional($nrcs->firstWhere('id', $practicaII->nrc))->nrc ?? 'NO CUENTA CON NRC') }}
                                            </td>
                                            <td>{{ strtoupper($practicaII->periodoPractica ?? 'NO REQUIERE PERIODO') }}
                                            </td>
                                            <td>{{ strtoupper($practicaII->FechaInicio) }}</td>
                                            <td>{{ strtoupper($practicaII->FechaFinalizacion) }}</td>
                                            <td>{{ strtoupper($practicaII->HorasPlanificadas) }}</td>
                                            <td>{{ $practicaII->Estado }}</td>
                                            <td>
                                                <form
                                                    action="{{ route('admin.actualizarEstadoEstudiante2', ['id' => $practicaII->estudiante->estudianteId]) }}"
                                                    method="POST"
                                                    style="display: flex; align-items: center; justify-content: center;">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="hidden" name="id"
                                                        value="{{ $practicaII->estudiante->estudianteId }}" class="input">
                                                    <select name="nuevoEstado"
                                                        class="form-control input1 input input_select1"
                                                        style="margin-right: 10px;">
                                                        <option value="En ejecucion">Aprobado</option>
                                                        <option value="Negado">Negar</option>
                                                    </select>
                                                    <button type="submit" class="button3"><i
                                                            class="bx bx-check"></i></button>
                                                </form>
                                            </td>

                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>

            </div>


        </section>

        <!-- ----------------------------------------------------practicas----------------------------------------------------------------------------------- -->

        <div class="mat-elevation-z8 contenedor_general">
            <br>
            <h4><b>Estudiantes Práctica 1</b></h4>
            <hr>
            <section>
                <div class="mat-elevation-z8 contenedor_general">
                    <div class="contenedor_acciones_tabla sidebar_active_content_acciones_tabla">
                        <!-- Botones -->
                        <div class="contenedor_botones">
                            <div class="tooltip-container">
                                <span class="tooltip-text">Excel</span>
                                <form id="reportForm" action="{{ route('coordinador.reportesPracticaI') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="profesor" id="hiddenProfesor">
                                    <input type="hidden" name="empresa" id="hiddenEmpresa">
                                    <input type="hidden" name="periodos" id="hiddenPeriodos">
                                    <button type="submit" class="button3 efects_button btn_excel">
                                        <i class="fas fa-file-excel"></i>
                                    </button>
                                </form>
                            </div>
                            <!-- Botón de Importar archivo -->
                            <div class="tooltip-container">
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
                                    <button type="button" class="close" onclick="closeCard('cardImportarArchivo')"><i
                                            class="fa-thin fa-xmark"></i></button>
                                </div>
                                <div class="card-body">
                                    <form id="idModalImportar2" action="{{ route('import-practicas1') }}" method="POST"
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
                                                onclick="showPreviewImportPracticas1()">Importar Archivo</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="tooltip-container">
                                <span class="tooltip-text">Filtros</span>
                                <button class="button3 efects_button btn_filtro"
                                    onclick="openCard('filtersCardProfesores1');">
                                    <i class="fa-solid fa-filter-list"></i>
                                </button>
                            </div>

                            <!-- Card de Filtros para Profesores y Periodos -->
                            <div class="draggable-card1_2" id="filtersCardProfesores1" style="display: none;">
                                <div class="card-header">
                                    <span class="card-title">Filtros Profesores y Periodos</span>
                                    <button type="button" class="close"
                                        onclick="closeCard('filtersCardProfesores1')"><i
                                            class="fa-thin fa-xmark"></i></button>
                                </div>

                                <div class="card-body">
                                    <form id="filterFormProfesores" method="GET"
                                        action="{{ route('admin.aceptarFaseI') }}">
                                        <div class="form-group">
                                            <label for="profesor">Tutor academico</label>
                                            <select name="profesor" id="profesor"
                                                class="form-control input input_select">
                                                <option value="">Todos los docentes</option>
                                                @foreach ($todosLosDocentes as $docenetes)
                                                    <option value="{{ $docenetes->nombres }}">
                                                        {{ $docenetes->apellidos }} {{ $docenetes->nombres }}</option>
                                                @endforeach
                                                </option>
                                            </select>

                                        </div>
                                        <div class="form-group">
                                            <label for="empresa">Empresa</label>
                                            <select name="empresa" id="empresa"
                                                class="form-control input input_select">
                                                <option value="">Todas las empresas</option>
                                                @foreach ($todasLasEmpresas as $empresa)
                                                    <option value="{{ $empresa->nombreEmpresa }}">
                                                        {{ $empresa->nombreEmpresa }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="form-group ">
                                            <label for="fechaInicio">Periodos</label>
                                            <select name="periodos" id="periodos"
                                                class="form-control input input_select">
                                                <option value="">Todos los periodos</option>
                                                @foreach ($todosLosPeriodos as $periodo)
                                                    <option value="{{ $periodo->numeroPeriodo }}">
                                                        {{ $periodo->numeroPeriodo }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <!-- Botón de Eliminar Filtros Profesores y Periodos -->
                            <div class="tooltip-container ">
                                <span class="tooltip-text">Eliminar Filtros</span>
                                <button class="button3 efects_button btn_delete_filter"
                                    onclick="resetFiltersProfesores()">
                                    <i class="fa-sharp fa-solid fa-filter-circle-xmark"></i>
                                </button>
                            </div>
                        </div>





                        <div class="contenedor_buscador">
                            <div>
                                <form id="formbusquedaPractica1">
                                    <input type="text" class="input" name="search" value="{{ $search }}"
                                        matInput placeholder="Buscar en practicas 1...">
                                    <i class='bx bx-search-alt'></i>
                                </form>
                            </div>
                        </div>

                    </div>
                    <div class="contenedor_tabla">
                        <div class="table-container mat-elevation-z8">

                            <div id="practicas1">
                                <table id="practicas1" class="mat-mdc-table">
                                    <thead class="ng-star-inserted">
                                        <tr
                                            class="mat-mdc-header-row mdc-data-table__header-row cdk-header-row ng-star-inserted">
                                            <th>N°</th>
                                            <th class="tamanio1">ESTUDIANTE</th>
                                            <th>PRÁCTICA</th>
                                            <th class="tamanio4">TUTOR ACADÉMICO</th>
                                            <th class="tamanio4">TUTOR EMPRESARIAL</th>
                                            <th class="tamanio1">EMPRESA</th>
                                            <th class="tamanio3">NRC</th>
                                            <th>PERIODO</th>
                                            <th>FECHA INICIO</th>
                                            <th>FECHA FIN</th>
                                            <th>HORAS PLANIFICADAS</th>
                                            <th>NOTA</th>
                                            <th>ESTADO</th>

                                        </tr>
                                    </thead>
                                    <tbody class="mdc-data-table__content ng-star-inserted">
                                        @foreach ($estudiantesPracticas as $index => $practicaI)
                                            @if ($practicaI->estudiante)
                                                <tr>
                                                    <td>{{ $estudiantesPracticas->firstItem() + $index }}</td>

                                                    <td style="text-transform: uppercase; text-align: left;">
                                                        {{ strtoupper($practicaI->estudiante->apellidos) }}
                                                        {{ strtoupper($practicaI->estudiante->nombres) }}</td>
                                                    <td style="text-transform: uppercase;">
                                                        {{ strtoupper($practicaI->tipoPractica) }}</td>
                                                    <td style="text-transform: uppercase; text-align: left;">
                                                        {{ strtoupper($practicaI->tutorAcademico->apellidos ?? 'No por el momento') }}
                                                        {{ strtoupper($practicaI->tutorAcademico->nombres ?? 'No por el momento') }}
                                                    </td>
                                                    <td style="text-transform: uppercase; text-align: left;">
                                                        {{ strtoupper($practicaI->NombreTutorEmpresarial) }}</td>
                                                    <td style="text-transform: uppercase; text-align: left;">
                                                        {{ strtoupper($practicaI->Empresa->nombreEmpresa ?? 'No por el momento') }}
                                                    </td>
                                                    <td> {{ strtoupper(optional($nrcs->firstWhere('id', $practicaI->nrc))->nrc ?? 'NO CUENTA CON NRC') }}
                                                    </td>

                                                    <td>{{ strtoupper($practicaI->periodoPractica ?? 'NO CUENTA CON PERIODO') }}
                                                    </td>


                                                    <td>{{ strtoupper($practicaI->FechaInicio) }}</td>
                                                    <td>{{ strtoupper($practicaI->FechaFinalizacion) }}</td>
                                                    <td>{{ strtoupper($practicaI->HorasPlanificadas) }}</td>
                                                    <td>{{ strtoupper($practicaI->nota_final ?? 'AUN NO TIENE CALIFICACION') }}
                                                    </td>
                                                    <td>{{ strtoupper($practicaI->Estado) }}</td>
                                                </tr>
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>

                            </div>
                        </div>
                        <div class="paginator-container">
                            <nav aria-label="..."
                                style="display: flex; justify-content: space-between; align-items: baseline; color: gray;">
                                <div id="totalRows">Estudiantes: {{ $estudiantesPracticas->total() }}</div>
                                <ul class="pagination">
                                    <li class="page-item mx-3">
                                        <form method="GET" action="{{ route('admin.aceptarFaseI') }}#practicas1">
                                            <select class="form-control page-item" name="paginacion1" id="perPage"
                                                onchange="this.form.submit()">
                                                <option value="10" @if ($perPage1 == 10) selected @endif>10
                                                </option>
                                                <option value="20" @if ($perPage1 == 20) selected @endif>20
                                                </option>
                                                <option value="50" @if ($perPage1 == 50) selected @endif>50
                                                </option>
                                                <option value="100" @if ($perPage1 == 100) selected @endif>
                                                    100
                                                </option>
                                            </select>
                                        </form>
                                    </li>

                                    @if ($estudiantesPracticas->onFirstPage())
                                        <li class="page-item disabled">
                                            <span class="page-link">Anterior</span>
                                        </li>
                                    @else
                                        <li class="page-item">
                                            <a class="page-link"
                                                href="{{ $estudiantesPracticas->appends(['paginacion1' => $perPage1])->previousPageUrl() }}#practicas1"
                                                aria-label="Anterior">Anterior</a>
                                        </li>
                                    @endif

                                    @if ($estudiantesPracticas->lastPage() > 1)
                                        @if ($estudiantesPracticas->currentPage() > 3)
                                            <li class="page-item"><a class="page-link"
                                                    href="{{ $estudiantesPracticas->appends(['paginacion1' => $perPage1])->url(1) }}#practicas1">1</a>
                                            </li>
                                            @if ($estudiantesPracticas->currentPage() > 4)
                                                <li class="page-item disabled"><span class="page-link">...</span></li>
                                            @endif
                                        @endif
                                        @foreach (range(max(1, $estudiantesPracticas->currentPage() - 2), min($estudiantesPracticas->currentPage() + 2, $estudiantesPracticas->lastPage())) as $i)
                                            @if ($i == $estudiantesPracticas->currentPage())
                                                <li class="page-item active"><span
                                                        class="page-link">{{ $i }}</span></li>
                                            @else
                                                <li class="page-item"><a class="page-link"
                                                        href="{{ $estudiantesPracticas->appends(['paginacion1' => $perPage1])->url($i) }}#practicas1">{{ $i }}</a>
                                                </li>
                                            @endif
                                        @endforeach
                                        @if ($estudiantesPracticas->currentPage() < $estudiantesPracticas->lastPage() - 2)
                                            @if ($estudiantesPracticas->currentPage() < $estudiantesPracticas->lastPage() - 3)
                                                <li class="page-item disabled"><span class="page-link">...</span></li>
                                            @endif
                                            <li class="page-item"><a class="page-link"
                                                    href="{{ $estudiantesPracticas->appends(['paginacion1' => $perPage1])->url($estudiantesPracticas->lastPage()) }}#practicas1">{{ $estudiantesPracticas->lastPage() }}</a>
                                            </li>
                                        @endif
                                    @endif

                                    @if ($estudiantesPracticas->hasMorePages())
                                        <li class="page-item">
                                            <a class="page-link"
                                                href="{{ $estudiantesPracticas->appends(['paginacion1' => $perPage1])->nextPageUrl() }}#practicas1"
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
            <h4><b>Estudiantes Práctica 1.2 </b></h4>

            <hr>
            <section>

                <div class="mat-elevation-z8 contenedor_general">
                    <div class="contenedor_acciones_tabla sidebar_active_content_acciones_tabla">
                        <!-- Botones -->
                        <div class="contenedor_botones">

                            <div class="tooltip-container">
                                <span class="tooltip-text">Excel</span>
                                <form id="reportForm2" action="{{ route('coordinador.reportesPracticaIII') }}"
                                    method="POST">
                                    @csrf
                                    <input type="hidden" name="profesor3" id="hiddenProfesor3">
                                    <input type="hidden" name="empresa3" id="hiddenEmpresa3">
                                    <input type="hidden" name="periodos3" id="hiddenPeriodos3">

                                    <button type="submit" class="button3 efects_button btn_excel">
                                        <i class="fas fa-file-excel"></i>
                                    </button>
                                </form>
                            </div>

                            <!-- Botón de Importar archivo -->
                            <div class="tooltip-container">
                                <span class="tooltip-text">Importar archivo</span>
                                <button type="button" class="button3 efects_button btn_copy"
                                    onclick="openCard('cardImportarArchivo2');">
                                    <i class="fa fa-upload"></i>
                                </button>
                            </div>
                            <!-- Card de Importar archivo -->
                            <div class="draggable-card1_4" id="cardImportarArchivo2" style="display: none;">
                                <div class="card-header">
                                    <span class="card-title">Importar archivo</span>
                                    <button type="button" class="close" onclick="closeCard('cardImportarArchivo2')"><i
                                            class="fa-thin fa-xmark"></i></button>
                                </div>
                                <div class="card-body">
                                    <form id="idModalImportar2" action="{{ route('import-practicas2') }}" method="POST"
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
                            <div class="tooltip-container">
                                <span class="tooltip-text">Filtros</span>
                                <button class="button3 efects_button btn_filtro"
                                    onclick="openCard('filtersCardProfesores3');">
                                    <i class="fa-solid fa-filter-list"></i>
                                </button>
                            </div>

                            <!-- Card de Filtros para Profesores y Periodos -->
                            <div class="draggable-card1_2" id="filtersCardProfesores3" style="display: none;">
                                <div class="card-header">
                                    <span class="card-title">Filtros Profesores y Periodos</span>
                                    <button type="button" class="close"
                                        onclick="closeCard('filtersCardProfesores3')"><i
                                            class="fa-thin fa-xmark"></i></button>
                                </div>
                                <div class="card-body">
                                    <form id="filterFormProfesores3" method="GET"
                                        action="{{ route('admin.aceptarFaseI') }}">
                                        <div class="form-group">
                                            <label for="profesor3">Tutor academico</label>
                                            <select name="profesor3" id="profesor3"
                                                class="form-control input input_select">
                                                <option value="">Todos los docentes</option>
                                                @foreach ($todosLosDocentes as $docenetes)
                                                    <option value="{{ $docenetes->nombres }}">
                                                        {{ $docenetes->apellidos }} {{ $docenetes->nombres }}</option>
                                                @endforeach
                                                </option>
                                            </select>

                                        </div>
                                        <div class="form-group">
                                            <label for="empresa3">Empresa</label>
                                            <select name="empresa3" id="empresa3"
                                                class="form-control input input_select">
                                                <option value="">Todas las empresas</option>
                                                @foreach ($todasLasEmpresas as $empresa)
                                                    <option value="{{ $empresa->nombreEmpresa }}">
                                                        {{ $empresa->nombreEmpresa }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="form-group ">
                                            <label for="periodos3">Periodos</label>
                                            <select name="periodos3" id="periodos3"
                                                class="form-control input input_select">
                                                <option value="">Todos los periodos</option>
                                                @foreach ($todosLosPeriodos as $periodo)
                                                    <option value="{{ $periodo->numeroPeriodo }}">
                                                        {{ $periodo->numeroPeriodo }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </form>
                                </div>
                            </div>



                            <!-- Botón de Eliminar Filtros Profesores y Periodos -->
                            <div class="tooltip-container ">
                                <span class="tooltip-text">Eliminar Filtros</span>
                                <button class="button3 efects_button btn_delete_filter"
                                    onclick="resetFiltersProfesores()">
                                    <i class="fa-sharp fa-solid fa-filter-circle-xmark"></i>
                                </button>
                            </div>
                        </div>

                        <div class="contenedor_buscador">
                            <div>
                                <form id="formbusquedaPractica2">
                                    <input type="text" class="input" name="search2" value="{{ $search2 }}"
                                        matInput placeholder="Buscar en practicas 1.2...">
                                    <i class='bx bx-search-alt'></i>
                                </form>
                            </div>
                        </div>

                    </div>

                    <div class="contenedor_tabla">
                        <div class="table-container mat-elevation-z8">

                            <div id="practicas2">
                                <table id="practicas2" class="mat-mdc-table">
                                    <thead class="ng-star-inserted">
                                        <tr
                                            class="mat-mdc-header-row mdc-data-table__header-row cdk-header-row ng-star-inserted">
                                            <th>N°</th>
                                            <th class="tamanio1">ESTUDIANTE</th>
                                            <th>PRÁCTICA</th>
                                            <th class="tamanio4">TUTOR ACADÉMICO</th>
                                            <th class="tamanio4">TUTOR EMPRESARIAL</th>
                                            <th class="tamanio1">EMPRESA</th>
                                            <th class="tamanio3">NRC</th>
                                            <th>PERIODO</th>
                                            <th>FECHA INICIO</th>
                                            <th>FECHA FIN</th>
                                            <th>HORAS PLANIFICADAS</th>
                                            <th>NOTA FINAL</th>
                                            <th>ESTADO</th>

                                        </tr>
                                    </thead>
                                    <tbody class="mdc-data-table__content ng-star-inserted">
                                        @foreach ($estudiantesPracticasIII as $index => $practicaI)
                                            @if ($practicaI->estudiante)
                                                <tr>
                                                    <td>{{ $estudiantesPracticasIII->firstItem() + $index }}</td>

                                                    <td style="text-transform: uppercase; text-align: left;">
                                                        {{ strtoupper($practicaI->estudiante->apellidos) }}
                                                        {{ strtoupper($practicaI->estudiante->nombres) }}</td>
                                                    <td style="text-transform: uppercase;">
                                                        {{ strtoupper($practicaI->tipoPractica) }}</td>
                                                    <td style="text-transform: uppercase; text-align: left;">
                                                        {{ strtoupper($practicaI->tutorAcademico->apellidos ?? 'No por el momento') }}
                                                        {{ strtoupper($practicaI->tutorAcademico->nombres ?? 'No por el momento') }}
                                                    </td>
                                                    <td style="text-transform: uppercase; text-align: left;">
                                                        {{ strtoupper($practicaI->NombreTutorEmpresarial) }}</td>
                                                    <td style="text-transform: uppercase; text-align: left;">
                                                        {{ strtoupper($practicaI->Empresa->nombreEmpresa ?? 'No por el momento') }}
                                                    </td>
                                                    <td> {{ strtoupper(optional($nrcs->firstWhere('id', $practicaI->nrc))->nrc ?? 'NO CUENTA CON NRC') }}
                                                    </td>

                                                    <td>{{ strtoupper($practicaI->periodoPractica ?? 'NO CUENTA CON PERIODO') }}
                                                    </td>

                                                    <td>{{ strtoupper($practicaI->FechaInicio) }}</td>
                                                    <td>{{ strtoupper($practicaI->FechaFinalizacion) }}</td>
                                                    <td>{{ strtoupper($practicaI->HorasPlanificadas) }}</td>
                                                    <td>{{ strtoupper($practicaI->nota_final ?? 'AUN NO TIENE CALIFICACION') }}
                                                    </td>
                                                    <td>{{ $practicaI->Estado }}</td>
                                                </tr>
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>

                            </div>

                        </div>
                        <div class="paginator-container">
                            <nav aria-label="..."
                                style="display: flex; justify-content: space-between; align-items: baseline; color: gray;">
                                <div id="totalRows">Estudiantes: {{ $estudiantesPracticasIII->total() }}</div>
                                <ul class="pagination">
                                    <li class="page-item mx-3">
                                        <form method="GET" action="{{ route('admin.aceptarFaseI') }}#practicas2">
                                            <select class="form-control page-item" name="paginacion2" id="perPage"
                                                onchange="this.form.submit()">
                                                <option value="10" @if ($perPage2 == 10) selected @endif>
                                                    10
                                                </option>
                                                <option value="20" @if ($perPage2 == 20) selected @endif>
                                                    20
                                                </option>
                                                <option value="50" @if ($perPage2 == 50) selected @endif>
                                                    50
                                                </option>
                                                <option value="100" @if ($perPage2 == 100) selected @endif>
                                                    100
                                                </option>
                                            </select>
                                        </form>
                                    </li>

                                    @if ($estudiantesPracticasIII->onFirstPage())
                                        <li class="page-item disabled">
                                            <span class="page-link">Anterior</span>
                                        </li>
                                    @else
                                        <li class="page-item">
                                            <a class="page-link"
                                                href="{{ $estudiantesPracticasIII->previousPageUrl() }}&paginacion2={{ $perPage2 }}#practicas2"
                                                aria-label="Anterior">Anterior</a>
                                        </li>
                                    @endif

                                    @if ($estudiantesPracticasIII->lastPage() > 1)
                                        @if ($estudiantesPracticasIII->currentPage() > 3)
                                            <li class="page-item"><a class="page-link"
                                                    href="{{ $estudiantesPracticasIII->url(1) }}&paginacion2={{ $perPage2 }}#practicas2">1</a>
                                            </li>
                                            @if ($estudiantesPracticasIII->currentPage() > 4)
                                                <li class="page-item disabled"><span class="page-link">...</span></li>
                                            @endif
                                        @endif
                                        @foreach (range(max(1, $estudiantesPracticasIII->currentPage() - 2), min($estudiantesPracticasIII->currentPage() + 2, $estudiantesPracticasIII->lastPage())) as $i)
                                            @if ($i == $estudiantesPracticasIII->currentPage())
                                                <li class="page-item active"><span
                                                        class="page-link">{{ $i }}</span></li>
                                            @else
                                                <li class="page-item"><a class="page-link"
                                                        href="{{ $estudiantesPracticasIII->url($i) }}&paginacion2={{ $perPage2 }}#practicas2">{{ $i }}</a>
                                                </li>
                                            @endif
                                        @endforeach
                                        @if ($estudiantesPracticasIII->currentPage() < $estudiantesPracticasIII->lastPage() - 2)
                                            @if ($estudiantesPracticasIII->currentPage() < $estudiantesPracticasIII->lastPage() - 3)
                                                <li class="page-item disabled"><span class="page-link">...</span></li>
                                            @endif
                                            <li class="page-item"><a class="page-link"
                                                    href="{{ $estudiantesPracticasIII->url($estudiantesPracticasIII->lastPage()) }}&paginacion2={{ $perPage2 }}#practicas2">{{ $estudiantesPracticasIII->lastPage() }}</a>
                                            </li>
                                        @endif
                                    @endif

                                    @if ($estudiantesPracticasIII->hasMorePages())
                                        <li class="page-item">
                                            <a class="page-link"
                                                href="{{ $estudiantesPracticasIII->nextPageUrl() }}&paginacion2={{ $perPage2 }}#practicas2"
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
            <h4><b>Estudiantes Práctica 1.3</b></h4>

            <hr>
            <section>
                <div class="mat-elevation-z8 contenedor_general">
                    <div class="contenedor_acciones_tabla sidebar_active_content_acciones_tabla">
                        <!-- Botones -->
                        <div class="contenedor_botones">

                            <div class="tooltip-container">
                                <span class="tooltip-text">Excel</span>
                                <form id="reportForm4" action="{{ route('coordinador.reportesPracticaIV') }}"
                                    method="POST">
                                    @csrf
                                    <input type="hidden" name="profesor4" id="hiddenProfesor4">
                                    <input type="hidden" name="empresa4" id="hiddenEmpresa4">
                                    <input type="hidden" name="periodos4" id="hiddenPeriodos4">
                                    <button type="submit" class="button3 efects_button btn_excel">
                                        <i class="fas fa-file-excel"></i>
                                    </button>
                                </form>
                            </div>
                            <!-- Botón de Importar archivo -->
                            <div class="tooltip-container">
                                <span class="tooltip-text">Importar archivo</span>
                                <button type="button" class="button3 efects_button btn_copy"
                                    onclick="openCard('cardImportarArchivo3');">
                                    <i class="fa fa-upload"></i>
                                </button>
                            </div>
                            <!-- Card de Importar archivo -->
                            <div class="draggable-card1_4" id="cardImportarArchivo3" style="display: none;">
                                <div class="card-header">
                                    <span class="card-title">Importar archivo</span>
                                    <button type="button" class="close" onclick="closeCard('cardImportarArchivo3')"><i
                                            class="fa-thin fa-xmark"></i></button>
                                </div>
                                <div class="card-body">
                                    <form id="idModalImportar2" action="{{ route('import-practicas3') }}"
                                        method="POST" enctype="multipart/form-data">
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
                            <div class="tooltip-container">
                                <span class="tooltip-text">Filtros</span>
                                <button class="button3 efects_button btn_filtro"
                                    onclick="openCard('filtersCardProfesores4');">
                                    <i class="fa-solid fa-filter-list"></i>
                                </button>
                            </div>

                            <!-- Card de Filtros para Profesores y Periodos -->
                            <div class="draggable-card1_2" id="filtersCardProfesores4" style="display: none;">
                                <div class="card-header">
                                    <span class="card-title">Filtros Profesores y Periodos</span>
                                    <button type="button" class="close"
                                        onclick="closeCard('filtersCardProfesores4')"><i
                                            class="fa-thin fa-xmark"></i></button>
                                </div>
                                <div class="card-body">
                                    <form id="filterFormProfesores4" method="GET"
                                        action="{{ route('admin.aceptarFaseI') }}">
                                        <div class="form-group">
                                            <label for="profesor4">Tutor academico</label>
                                            <select name="profesor4" id="profesor4"
                                                class="form-control input input_select">
                                                <option value="">Todos los docentes</option>
                                                @foreach ($todosLosDocentes as $docenetes)
                                                    <option value="{{ $docenetes->nombres }}">
                                                        {{ $docenetes->apellidos }} {{ $docenetes->nombres }}</option>
                                                @endforeach
                                                </option>
                                            </select>

                                        </div>
                                        <div class="form-group">
                                            <label for="empresa4">Empresa</label>
                                            <select name="empresa4" id="empresa4"
                                                class="form-control input input_select">
                                                <option value="">Todas las empresas</option>
                                                @foreach ($todasLasEmpresas as $empresa)
                                                    <option value="{{ $empresa->nombreEmpresa }}">
                                                        {{ $empresa->nombreEmpresa }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="form-group ">
                                            <label for="periodos4">Periodos</label>
                                            <select name="periodos4" id="periodos4"
                                                class="form-control input input_select">
                                                <option value="">Todos los periodos</option>
                                                @foreach ($todosLosPeriodos as $periodo)
                                                    <option value="{{ $periodo->numeroPeriodo }}">
                                                        {{ $periodo->numeroPeriodo }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <!-- Botón de Eliminar Filtros Profesores y Periodos -->
                            <div class="tooltip-container ">
                                <span class="tooltip-text">Eliminar Filtros</span>
                                <button class="button3 efects_button btn_delete_filter"
                                    onclick="resetFiltersProfesores()">
                                    <i class="fa-sharp fa-solid fa-filter-circle-xmark"></i>
                                </button>
                            </div>
                        </div>
                        <div class="contenedor_buscador">
                            <div>
                                <form id="formbusquedaPractica3">
                                    <input type="text" class="input" name="search3" value="{{ $search3 }}"
                                        matInput placeholder="Buscar en practicas 1.3..">
                                    <i class='bx bx-search-alt'></i>
                                </form>
                            </div>
                        </div>

                    </div>
                    <div class="contenedor_tabla">
                        <div class="table-container mat-elevation-z8">

                            <div id="practicas3">
                                <table id="practicas3" class="mat-mdc-table">
                                    <thead class="ng-star-inserted">
                                        <tr
                                            class="mat-mdc-header-row mdc-data-table__header-row cdk-header-row ng-star-inserted">
                                            <th>N°</th>
                                            <th class="tamanio1">ESTUDIANTE</th>
                                            <th>PRÁCTICA</th>
                                            <th class="tamanio4">TUTOR ACADÉMICO</th>
                                            <th class="tamanio4">TUTOR EMPRESARIAL</th>
                                            <th class="tamanio1">EMPRESA</th>
                                            <th class="tamanio3">NRC</th>
                                            <th>PERIODO</th>
                                            <th>FECHA INICIO</th>
                                            <th>FECHA FIN</th>
                                            <th>HORAS PLANIFICADAS</th>
                                            <th>NOTA FINAL</th>
                                            <th>ESTADO</th>

                                        </tr>
                                    </thead>
                                    <tbody class="mdc-data-table__content ng-star-inserted">
                                        @foreach ($estudiantesPracticasIV as $index => $practicaI)
                                            @if ($practicaI->estudiante)
                                                <tr>
                                                    <td>{{ $estudiantesPracticasIV->firstItem() + $index }}</td>
                                                    <td style="text-transform: uppercase; text-align: left;">
                                                        {{ strtoupper($practicaI->estudiante->apellidos) }}
                                                        {{ strtoupper($practicaI->estudiante->nombres) }}</td>
                                                    <td style="text-transform: uppercase;">
                                                        {{ strtoupper($practicaI->tipoPractica) }}</td>
                                                    <td style="text-transform: uppercase; text-align: left;">
                                                        {{ strtoupper($practicaI->tutorAcademico->apellidos ?? 'No por el momento') }}
                                                        {{ strtoupper($practicaI->tutorAcademico->nombres ?? 'No por el momento') }}
                                                    </td>
                                                    <td style="text-transform: uppercase; text-align: left;">
                                                        {{ strtoupper($practicaI->NombreTutorEmpresarial) }}</td>
                                                    <td style="text-transform: uppercase; text-align: left;">
                                                        {{ strtoupper($practicaI->Empresa->nombreEmpresa ?? 'No por el momento') }}
                                                    </td>
                                                    <td> {{ strtoupper(optional($nrcs->firstWhere('id', $practicaI->nrc))->nrc ?? 'NO CUENTA CON NRC') }}

                                                    </td>
                                                    <td>{{ strtoupper($practicaI->periodoPractica ?? 'NO CUENTA CON PERIODO') }}
                                                    </td>
                                                    <td>{{ strtoupper($practicaI->FechaInicio) }}</td>
                                                    <td>{{ strtoupper($practicaI->FechaFinalizacion) }}</td>
                                                    <td>{{ strtoupper($practicaI->HorasPlanificadas) }}</td>
                                                    <td>{{ strtoupper($practicaI->nota_final ?? 'AUN NO TIENE CALIFICACION') }}
                                                    </td>
                                                    <td>{{ $practicaI->Estado }}</td>


                                                </tr>
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>

                            </div>
                        </div>
                        <div class="paginator-container">
                            <nav aria-label="..."
                                style="display: flex; justify-content: space-between; align-items: baseline; color: gray;">
                                <div id="totalRows">Estudiantes: {{ $estudiantesPracticasIV->total() }}</div>
                                <ul class="pagination">
                                    <li class="page-item mx-3">
                                        <form method="GET" action="{{ route('admin.aceptarFaseI') }}#practicas3">
                                            <select class="form-control page-item" name="paginacion3" id="perPage"
                                                onchange="this.form.submit()">
                                                <option value="10" @if ($perPage3 == 10) selected @endif>
                                                    10
                                                </option>
                                                <option value="20" @if ($perPage3 == 20) selected @endif>
                                                    20
                                                </option>
                                                <option value="50" @if ($perPage3 == 50) selected @endif>
                                                    50
                                                </option>
                                                <option value="100" @if ($perPage3 == 100) selected @endif>
                                                    100
                                                </option>
                                            </select>
                                        </form>
                                    </li>

                                    @if ($estudiantesPracticasIV->onFirstPage())
                                        <li class="page-item disabled">
                                            <span class="page-link">Anterior</span>
                                        </li>
                                    @else
                                        <li class="page-item">
                                            <a class="page-link"
                                                href="{{ $estudiantesPracticasIV->previousPageUrl() }}&paginacion3={{ $perPage3 }}#practicas3"
                                                aria-label="Anterior">Anterior</a>
                                        </li>
                                    @endif

                                    @foreach (range(1, $estudiantesPracticasIV->lastPage()) as $i)
                                        @if ($i == $estudiantesPracticasIV->currentPage())
                                            <li class="page-item active">
                                                <span class="page-link">{{ $i }}</span>
                                            </li>
                                        @else
                                            <li class="page-item">
                                                <a class="page-link"
                                                    href="{{ $estudiantesPracticasIV->url($i) }}&paginacion3={{ $perPage3 }}#practicas3">{{ $i }}</a>
                                            </li>
                                        @endif
                                    @endforeach

                                    @if ($estudiantesPracticasIV->hasMorePages())
                                        <li class="page-item">
                                            <a class="page-link"
                                                href="{{ $estudiantesPracticasIV->nextPageUrl() }}&paginacion3={{ $perPage3 }}#practicas3"
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
            <h4><b>Estudiantes Práctica 2</b></h4>

            <hr>
            <section>
                <div class="mat-elevation-z8 contenedor_general">
                    <div class="contenedor_acciones_tabla sidebar_active_content_acciones_tabla">
                        <!-- Botones -->
                        <div class="contenedor_botones">
                            <div class="tooltip-container">
                                <span class="tooltip-text">Excel</span>
                                <form id="reportForm3" action="{{ route('coordinador.reportesPracticaII') }}"
                                    method="POST">
                                    @csrf
                                    <input type="hidden" name="profesor2" id="hiddenProfesor2">
                                    <input type="hidden" name="empresa2" id="hiddenEmpresa2">
                                    <input type="hidden" name="periodos2" id="hiddenPeriodos2">

                                    <button type="submit" class="button3 efects_button btn_excel">
                                        <i class="fas fa-file-excel"></i>
                                    </button>
                                </form>
                            </div>
                            <!-- Botón de Importar archivo -->
                            <div class="tooltip-container">
                                <span class="tooltip-text">Importar archivo</span>
                                <button type="button" class="button3 efects_button btn_copy"
                                    onclick="openCard('cardImportarArchivo4');">
                                    <i class="fa fa-upload"></i>
                                </button>
                            </div>
                            <!-- Card de Importar archivo -->
                            <div class="draggable-card1_4" id="cardImportarArchivo4" style="display: none;">
                                <div class="card-header">
                                    <span class="card-title">Importar archivo</span>
                                    <button type="button" class="close" onclick="closeCard('cardImportarArchivo4')"><i
                                            class="fa-thin fa-xmark"></i></button>
                                </div>
                                <div class="card-body">
                                    <form id="idModalImportar2" action="{{ route('import-practicas4') }}"
                                        method="POST" enctype="multipart/form-data">
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
                            <div class="tooltip-container">
                                <span class="tooltip-text">Filtros</span>
                                <button class="button3 efects_button btn_filtro"
                                    onclick="openCard('filtersCardProfesores2');">
                                    <i class="fa-solid fa-filter-list"></i>
                                </button>
                            </div>

                            <!-- Card de Filtros para Profesores y Periodos -->
                            <div class="draggable-card1_2" id="filtersCardProfesores2" style="display: none;">
                                <div class="card-header">
                                    <span class="card-title">Filtros Profesores y Periodos</span>
                                    <button type="button" class="close"
                                        onclick="closeCard('filtersCardProfesores2')"><i
                                            class="fa-thin fa-xmark"></i></button>
                                </div>

                                <div class="card-body">
                                    <form id="filterFormProfesores2" method="GET"
                                        action="{{ route('admin.aceptarFaseI') }}">
                                        <div class="form-group">
                                            <label for="profesor2">Tutor academico</label>
                                            <select name="profesor2" id="profesor2"
                                                class="form-control input input_select">
                                                <option value="">Todos los docentes</option>
                                                @foreach ($todosLosDocentes as $docenetes)
                                                    <option value="{{ $docenetes->nombres }}">
                                                        {{ $docenetes->apellidos }} {{ $docenetes->nombres }}</option>
                                                @endforeach
                                                </option>
                                            </select>

                                        </div>
                                        <div class="form-group">
                                            <label for="empresa2">Empresa</label>
                                            <select name="empresa2" id="empresa2"
                                                class="form-control input input_select">
                                                <option value="">Todas las empresas</option>
                                                @foreach ($todasLasEmpresas as $empresa)
                                                    <option value="{{ $empresa->nombreEmpresa }}">
                                                        {{ $empresa->nombreEmpresa }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="form-group ">
                                            <label for="periodos2">Periodos</label>
                                            <select name="periodos2" id="periodos2"
                                                class="form-control input input_select">
                                                <option value="">Todos los periodos</option>
                                                @foreach ($todosLosPeriodos as $periodo)
                                                    <option value="{{ $periodo->numeroPeriodo }}">
                                                        {{ $periodo->numeroPeriodo }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <!-- Botón de Eliminar Filtros Profesores y Periodos -->
                            <div class="tooltip-container ">
                                <span class="tooltip-text">Eliminar Filtros</span>
                                <button class="button3 efects_button btn_delete_filter"
                                    onclick="resetFiltersProfesores()">
                                    <i class="fa-sharp fa-solid fa-filter-circle-xmark"></i>
                                </button>
                            </div>
                        </div>
                        <div class="contenedor_buscador">
                            <div>
                                <form id="formbusquedaPractica1">
                                    <input type="text" class="input" name="search4" value="{{ $search4 }}"
                                        matInput placeholder="Buscar en practicas 2...">
                                    <i class='bx bx-search-alt'></i>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="contenedor_tabla">
                        <div class="table-container mat-elevation-z8">

                            <div id="practicas4">
                                <table id="practicas4" class="mat-mdc-table">
                                    <thead class="ng-star-inserted">
                                        <tr
                                            class="mat-mdc-header-row mdc-data-table__header-row cdk-header-row ng-star-inserted">
                                            <th>N°</th>
                                            <th class="tamanio1">ESTUDIANTE</th>
                                            <th>PRÁCTICA</th>
                                            <th class="tamanio4">TUTOR ACADÉMICO</th>
                                            <th class="tamanio4">TUTOR EMPRESARIAL</th>
                                            <th class="tamanio1">EMPRESA</th>
                                            <th class="tamanio3">NRC</th>
                                            <th>PERIODO</th>
                                            <th>FECHA INICIO</th>
                                            <th>FECHA FIN</th>
                                            <th>HORAS PLANIFICADAS</th>
                                            <th>NOTA FINAL</th>
                                            <th>ESTADO</th>

                                        </tr>
                                    </thead>
                                    <tbody class="mdc-data-table__content ng-star-inserted">
                                        @foreach ($estudiantesPracticasII as $index => $practicaI)
                                            @if ($practicaI->estudiante)
                                                <tr>
                                                    <td>{{ $estudiantesPracticasII->firstItem() + $index }}</td>
                                                    <td style="text-transform: uppercase; text-align: left;">
                                                        {{ strtoupper($practicaI->estudiante->apellidos) }}
                                                        {{ strtoupper($practicaI->estudiante->nombres) }}</td>
                                                    <td style="text-transform: uppercase;">
                                                        {{ strtoupper($practicaI->tipoPractica) }}</td>
                                                    <td style="text-transform: uppercase; text-align: left;">
                                                        {{ strtoupper($practicaI->tutorAcademico->apellidos ?? 'No por el momento') }}
                                                        {{ strtoupper($practicaI->tutorAcademico->nombres ?? 'No por el momento') }}
                                                    </td>
                                                    <td style="text-transform: uppercase; text-align: left;">
                                                        {{ strtoupper($practicaI->NombreTutorEmpresarial) }}</td>
                                                    <td style="text-transform: uppercase; text-align: left;">
                                                        {{ strtoupper($practicaI->Empresa->nombreEmpresa ?? 'No por el momento') }}
                                                    </td>
                                                    <td> {{ strtoupper(optional($nrcs->firstWhere('id', $practicaI->nrc))->nrc ?? 'NO CUENTA CON NRC') }}
                                                    </td>
                                                    <td>{{ strtoupper($practicaI->periodoPractica ?? 'NO CUENTA CON PERIODO') }}
                                                    </td>
                                                    <td>{{ strtoupper($practicaI->FechaInicio) }}</td>
                                                    <td>{{ strtoupper($practicaI->FechaFinalizacion) }}</td>
                                                    <td>{{ strtoupper($practicaI->HorasPlanificadas) }}</td>
                                                    <td>{{ strtoupper($practicaI->nota_final ?? 'AUN NO TIENE CALIFICACION') }}
                                                    </td>
                                                    <td>{{ $practicaI->Estado }}</td>


                                                </tr>
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>

                            </div>
                        </div>
                        <div class="paginator-container">
                            <nav aria-label="..."
                                style="display: flex; justify-content: space-between; align-items: baseline; color: gray;">
                                <div id="totalRows">Estudiantes: {{ $estudiantesPracticasII->total() }}</div>
                                <ul class="pagination">
                                    <li class="page-item mx-3">
                                        <form method="GET" action="{{ route('admin.aceptarFaseI') }}#practicas4">
                                            <select class="form-control page-item" name="paginacion4" id="perPage"
                                                onchange="this.form.submit()">
                                                <option value="10" @if ($perPage4 == 10) selected @endif>
                                                    10
                                                </option>
                                                <option value="20" @if ($perPage4 == 20) selected @endif>
                                                    20
                                                </option>
                                                <option value="50" @if ($perPage4 == 50) selected @endif>
                                                    50
                                                </option>
                                                <option value="100" @if ($perPage4 == 100) selected @endif>
                                                    100
                                                </option>
                                            </select>
                                        </form>
                                    </li>

                                    @if ($estudiantesPracticasII->onFirstPage())
                                        <li class="page-item disabled">
                                            <span class="page-link">Anterior</span>
                                        </li>
                                    @else
                                        <li class="page-item">
                                            <a class="page-link"
                                                href="{{ $estudiantesPracticasII->previousPageUrl() }}&paginacion4={{ $perPage4 }}#practicas4"
                                                aria-label="Anterior">Anterior</a>
                                        </li>
                                    @endif

                                    @if ($estudiantesPracticasII->lastPage() > 1)
                                        @if ($estudiantesPracticasII->currentPage() > 3)
                                            <li class="page-item"><a class="page-link"
                                                    href="{{ $estudiantesPracticasII->url(1) }}&paginacion4={{ $perPage4 }}#practicas4">1</a>
                                            </li>
                                            @if ($estudiantesPracticasII->currentPage() > 4)
                                                <li class="page-item disabled"><span class="page-link">...</span></li>
                                            @endif
                                        @endif
                                        @foreach (range(max(1, $estudiantesPracticasII->currentPage() - 2), min($estudiantesPracticasII->currentPage() + 2, $estudiantesPracticasII->lastPage())) as $i)
                                            @if ($i == $estudiantesPracticasII->currentPage())
                                                <li class="page-item active"><span
                                                        class="page-link">{{ $i }}</span></li>
                                            @else
                                                <li class="page-item"><a class="page-link"
                                                        href="{{ $estudiantesPracticasII->url($i) }}&paginacion4={{ $perPage4 }}#practicas4">{{ $i }}</a>
                                                </li>
                                            @endif
                                        @endforeach
                                        @if ($estudiantesPracticasII->currentPage() < $estudiantesPracticasII->lastPage() - 2)
                                            @if ($estudiantesPracticasII->currentPage() < $estudiantesPracticasII->lastPage() - 3)
                                                <li class="page-item disabled"><span class="page-link">...</span></li>
                                            @endif
                                            <li class="page-item"><a class="page-link"
                                                    href="{{ $estudiantesPracticasII->url($estudiantesPracticasII->lastPage()) }}&paginacion4={{ $perPage4 }}#practicas4">{{ $estudiantesPracticasII->lastPage() }}</a>
                                            </li>
                                        @endif
                                    @endif

                                    @if ($estudiantesPracticasII->hasMorePages())
                                        <li class="page-item">
                                            <a class="page-link"
                                                href="{{ $estudiantesPracticasII->nextPageUrl() }}&paginacion4={{ $perPage4 }}#practicas4"
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
            <h4><b>Estudiantes Práctica 2.2</b></h4>

            <hr>
            <section>
                <div class="mat-elevation-z8 contenedor_general">
                    <div class="contenedor_acciones_tabla sidebar_active_content_acciones_tabla">
                        <!-- Botones -->
                        <div class="contenedor_botones">
                            <div class="tooltip-container">
                                <span class="tooltip-text">Excel</span>
                                <form action="{{ route('coordinador.reportesPracticaV') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="button3 efects_button btn_excel">
                                        <i class="fas fa-file-excel"></i>
                                    </button>
                                </form>
                            </div>
                            <!-- Botón de Importar archivo -->
                            <div class="tooltip-container">
                                <span class="tooltip-text">Importar archivo</span>
                                <button type="button" class="button3 efects_button btn_copy"
                                    onclick="openCard('cardImportarArchivo5');">
                                    <i class="fa fa-upload"></i>
                                </button>
                            </div>
                            <!-- Card de Importar archivo -->
                            <div class="draggable-card1_4" id="cardImportarArchivo5" style="display: none;">
                                <div class="card-header">
                                    <span class="card-title">Importar archivo</span>
                                    <button type="button" class="close" onclick="closeCard('cardImportarArchivo5')"><i
                                            class="fa-thin fa-xmark"></i></button>
                                </div>
                                <div class="card-body">
                                    <form id="idModalImportar2" action="{{ route('import-practicas5') }}"
                                        method="POST" enctype="multipart/form-data">
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
                            <div class="tooltip-container">
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
                                    <button type="button" class="close" onclick="closeCard('filtersCardProfesores')"><i
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

                                                <option value="#">

                                                </option>

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
                                            <input type="date" class="input" name="fechaInicio" id="fechaInicio">
                                        </div>

                                        <div class="form-group">
                                            <label for="fechaFin">Fecha Fin</label>
                                            <input type="date" class="input" name="fechaFin" id="fechaFin">
                                        </div>

                                    </form>
                                </div>
                            </div>

                            <!-- Botón de Eliminar Filtros Profesores y Periodos -->
                            <div class="tooltip-container ">
                                <span class="tooltip-text">Eliminar Filtros</span>
                                <button class="button3 efects_button btn_delete_filter"
                                    onclick="resetFiltersProfesores()">
                                    <i class="fa-sharp fa-solid fa-filter-circle-xmark"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="contenedor_tabla">
                        <div class="table-container mat-elevation-z8">

                            <div id="tablaDocentes">
                                <table class="mat-mdc-table">
                                    <thead class="ng-star-inserted">
                                        <tr
                                            class="mat-mdc-header-row mdc-data-table__header-row cdk-header-row ng-star-inserted">
                                            <th>N°</th>
                                            <th class="tamanio1">ESTUDIANTE</th>
                                            <th>PRÁCTICA</th>
                                            <th class="tamanio4">TUTOR ACADÉMICO</th>
                                            <th class="tamanio4">TUTOR EMPRESARIAL</th>
                                            <th class="tamanio1">EMPRESA</th>
                                            <th class="tamanio3">NRC</th>
                                            <th>PERIODO</th>
                                            <th>FECHA INICIO</th>
                                            <th>FECHA FIN</th>
                                            <th>HORAS PLANIFICADAS</th>
                                            <th>NOTA FINAL</th>
                                            <th>ESTADO</th>

                                        </tr>
                                    </thead>
                                    <tbody class="mdc-data-table__content ng-star-inserted">
                                        @foreach ($estudiantesPracticasV as $practicaI)
                                            @if ($practicaI->estudiante)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td style="text-transform: uppercase; text-align: left;">
                                                        {{ strtoupper($practicaI->estudiante->apellidos) }}
                                                        {{ strtoupper($practicaI->estudiante->nombres) }}</td>
                                                    <td style="text-transform: uppercase;">
                                                        {{ strtoupper($practicaI->tipoPractica) }}</td>
                                                    <td style="text-transform: uppercase; text-align: left;">
                                                        {{ strtoupper($practicaI->tutorAcademico->apellidos ?? 'No por el momento') }}
                                                        {{ strtoupper($practicaI->tutorAcademico->nombres ?? 'No por el momento') }}
                                                    </td>
                                                    <td style="text-transform: uppercase; text-align: left;">
                                                        {{ strtoupper($practicaI->NombreTutorEmpresarial) }}</td>
                                                    <td style="text-transform: uppercase; text-align: left;">
                                                        {{ strtoupper($practicaI->Empresa->nombreEmpresa ?? 'No por el momento') }}
                                                    </td>
                                                    <td> {{ strtoupper(optional($nrcs->firstWhere('id', $practicaI->nrc))->nrc ?? 'NO CUENTA CON NRC') }}
                                                    </td>
                                                    <td>{{ strtoupper($practicaI->periodoPractica ?? 'NO CUENTA CON PERIODO') }}
                                                    </td>
                                                    <td>{{ strtoupper($practicaI->FechaInicio) }}</td>
                                                    <td>{{ strtoupper($practicaI->FechaFinalizacion) }}</td>
                                                    <td>{{ strtoupper($practicaI->HorasPlanificadas) }}</td>
                                                    <td>{{ strtoupper($practicaI->nota_final ?? 'AUN NO TIENE CALIFICACION') }}
                                                    </td>
                                                    <td>{{ $practicaI->Estado }}</td>


                                                </tr>
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>

                            </div>
                        </div>
                        <div class="paginator-container">
                            <nav aria-label="..."
                                style="display: flex; justify-content: space-between; align-items: baseline; color: gray; ">


                                <ul class="pagination" style=" padding: 10px 30px; !important">
                                    <div id="totalRows">Estudiantes: {{ $estudiantesPracticasIII->total() }}</div>
                                </ul>
                            </nav>
                        </div>
                        </nav>
                    </div>
                </div>

        </div>
    </section>

    </section>


    </style>
    <link rel="stylesheet" href="https://cdn.ckeditor.com/4.16.1/standard/ckeditor.css">
    <script src="https://cdn.ckeditor.com/4.16.1/standard/ckeditor.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('js/admin/acciones.js') }}"></script>


    <script>
        var delayTimer;
        $('#formbusquedaPractica1 input[name="search"]').on('keyup', function() {
            clearTimeout(delayTimer);
            var query = $(this).val();
            delayTimer = setTimeout(function() {
                $.ajax({
                    url: '{{ route('admin.aceptarFaseI') }}',
                    type: 'GET',
                    data: {
                        search: query
                    },
                    success: function(response) {
                        $('#practicas1').html($(response).find('#practicas1').html());
                    }
                });
            }, 500);
        });
    </script>

    <script>
        var delayTimer;
        $('#formbusquedaPractica2 input[name="search2"]').on('keyup', function() {
            clearTimeout(delayTimer);
            var query = $(this).val();
            delayTimer = setTimeout(function() {
                $.ajax({
                    url: '{{ route('admin.aceptarFaseI') }}',
                    type: 'GET',
                    data: {
                        search2: query
                    },
                    success: function(response) {
                        $('#practicas2').html($(response).find('#practicas2').html());
                    }
                });
            }, 500);
        });
    </script>
    <script>
        var delayTimer;
        $('#formbusquedaPractica4 input[name="search4"]').on('keyup', function() {
            clearTimeout(delayTimer);
            var query = $(this).val();
            delayTimer = setTimeout(function() {
                $.ajax({
                    url: '{{ route('admin.aceptarFaseI') }}',
                    type: 'GET',
                    data: {
                        search4: query
                    },
                    success: function(response) {
                        $('#practicas4').html($(response).find('#practicas4').html());
                    }
                });
            }, 500);
        });
    </script>
    <script>
        var delayTimer;
        $('#formbusquedaPractica3 input[name="search3"]').on('keyup', function() {
            clearTimeout(delayTimer);
            var query = $(this).val();
            delayTimer = setTimeout(function() {
                $.ajax({
                    url: '{{ route('admin.aceptarFaseI') }}',
                    type: 'GET',
                    data: {
                        search3: query
                    },
                    success: function(response) {
                        $('#practicas3').html($(response).find('#practicas3').html());
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
    </script>

    <script>
        $(document).ready(function() {
            $('#profesor, #empresa, #periodos').change(function() {
                var profesorParticipante = $('#profesor').val();
                var periodoParticipante = $('#periodos').val();
                var empresaParticipante = $('#empresa').val();

                $.ajax({
                    url: "{{ route('admin.aceptarFaseI') }}",
                    method: 'GET',
                    data: {
                        profesor: profesorParticipante,
                        periodos: periodoParticipante,
                        empresa: empresaParticipante
                    },
                    success: function(response) {
                        $('#practicas1').html($(response).find('#practicas1')
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
        $(document).ready(function() {
            $('#profesor2, #empresa2, #periodos2').change(function() {
                var profesorParticipante2 = $('#profesor2').val();
                var periodoParticipante2 = $('#periodos2').val();
                var empresaParticipante2 = $('#empresa2').val();

                $.ajax({
                    url: "{{ route('admin.aceptarFaseI') }}",
                    method: 'GET',
                    data: {
                        profesor2: profesorParticipante2,
                        periodos2: periodoParticipante2,
                        empresa2: empresaParticipante2
                    },
                    success: function(response) {
                        $('#practicas4').html($(response).find('#practicas4').html());
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
            $('#profesor3, #empresa3, #periodos3').change(function() {
                var profesorParticipante3 = $('#profesor3').val();
                var empresaParticipante3 = $('#empresa3').val();
                var periodoParticipante3 = $('#periodos3').val();

                $.ajax({
                    url: "{{ route('admin.aceptarFaseI') }}",
                    method: 'GET',
                    data: {
                        profesor3: profesorParticipante3,
                        empresa3: empresaParticipante3,
                        periodos3: periodoParticipante3
                    },
                    success: function(response) {
                        $('#practicas2').html($(response).find('#practicas2').html());
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
            $('#profesor4, #empresa4, #periodos4').change(function() {
                var profesorParticipante4 = $('#profesor4').val();
                var empresaParticipante4 = $('#empresa4').val();
                var periodoParticipante4 = $('#periodos4').val();

                $.ajax({
                    url: "{{ route('admin.aceptarFaseI') }}",
                    method: 'GET',
                    data: {
                        profesor4: profesorParticipante4,
                        empresa4: empresaParticipante4,
                        periodos4: periodoParticipante4
                    },
                    success: function(response) {
                        $('#practicas3').html($(response).find('#practicas3').html());
                    },
                    error: function(xhr) {
                        console.error(xhr.responseText);
                    }
                });
            });
        });
    </script>

    <script>
        function resetFiltersProfesores() {
            $('#profesor').val('');
            $('#empresa').val('');
            $('#periodos').val('');
            $('#profesor2').val('');
            $('#empresa2').val('');
            $('#periodos2').val('');
            $('#profesor3').val('');
            $('#empresa3').val('');
            $('#periodos3').val('');
            $('#profesor4').val('');
            $('#empresa4').val('');
            $('#periodos4').val('');
            $.ajax({
                url: "{{ route('admin.aceptarFaseI') }}",
                method: 'GET',
                success: function(response) {
                    $('#practicas1').html($(response).find('#practicas1').html());
                    $('#practicas2').html($(response).find('#practicas2').html());
                    $('#practicas3').html($(response).find('#practicas3').html());
                    $('#practicas4').html($(response).find('#practicas4').html());
                },
                error: function(xhr) {
                    console.error(xhr.responseText);
                }
            });
        }
    </script>

    <script>
        document.getElementById('reportForm').addEventListener('submit', function() {
            document.getElementById('hiddenProfesor').value = document.getElementById('profesor').value;
            document.getElementById('hiddenEmpresa').value = document.getElementById('empresa').value;
            document.getElementById('hiddenPeriodos').value = document.getElementById('periodos').value;
        });
    </script>

    <script>
        document.getElementById('reportForm2').addEventListener('submit', function() {
            document.getElementById('hiddenProfesor3').value = document.getElementById('profesor3').value;
            document.getElementById('hiddenEmpresa3').value = document.getElementById('empresa3').value;
            document.getElementById('hiddenPeriodos3').value = document.getElementById('periodos3').value;
        });
    </script>

    <script>
        document.getElementById('reportForm4').addEventListener('submit', function() {
            document.getElementById('hiddenProfesor4').value = document.getElementById('profesor4').value;
            document.getElementById('hiddenEmpresa4').value = document.getElementById('empresa4').value;
            document.getElementById('hiddenPeriodos4').value = document.getElementById('periodos4').value;
        });
    </script>

    <script>
        document.getElementById('reportForm3').addEventListener('submit', function() {
            document.getElementById('hiddenProfesor2').value = document.getElementById('profesor2').value;
            document.getElementById('hiddenEmpresa2').value = document.getElementById('empresa2').value;
            document.getElementById('hiddenPeriodos2').value = document.getElementById('periodos2').value;


        });
    </script>


<script>
    //////practicas 1
    function displayFileName(input, fileTextId) {
        const fileName = input.files[0].name;
        document.getElementById(fileTextId).textContent = fileName;
    }

    function removeFile(span) {
        const fileInput = document.getElementById('file2');
        fileInput.value = ''; // Limpiar el input file
        document.getElementById('fileText2').textContent = 'Haz clic aquí para subir el documento'; // Resetear el texto
    }

    function showPreviewImportPracticas1() {
        const fileInput = document.getElementById('file2');

        if (!fileInput.files.length) {
            Swal.fire('Error', 'Por favor, seleccione un archivo primero.', 'error');
            return;
        }

        const formData = new FormData();
        formData.append('file', fileInput.files[0]);

        Swal.fire({
            title: 'Cargando...',
            text: 'Espere mientras se previsualizan los datos.',
            allowOutsideClick: false,
            showConfirmButton: false,
            willOpen: () => {
                Swal.showLoading();
            }
        });

        // Realizar la solicitud AJAX para previsualizar la importación
        fetch('{{ route("import.previewImportarPracticas1") }}', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                console.log('Respuesta del servidor:', data);  
                Swal.close();

                // Asegúrate de que data tenga los valores insertCount y updateCount correctamente
                if (typeof data.insertCount === 'number' && typeof data.updateCount === 'number') {
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
                } else {
                    Swal.fire('Error', 'Ocurrió un error al obtener los datos de previsualización.', 'error');
                }
            })
            .catch(error => {
                Swal.fire('Error', 'Ocurrió un error al previsualizar la importación.', 'error');
                console.error('Error:', error);
            });
    }
</script>



@endsection
