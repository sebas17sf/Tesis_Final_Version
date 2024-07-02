@extends('layouts.admin')
@section('title', 'Panel Practicas')
@section('title_component', 'Panel Practicas')
@section('content')
    @if (session('success'))
        <div class="contenedor_alerta success">
            <div class="icon_alert"><i class="fa-regular fa-check"></i></div>
            <div class="content_alert">
                <div class="title">Éxito!</div>
                <div class="body">{{ session('success') }}</div>
            </div>
            <div class="icon_remove">
                <button class="button4 btn_3_2"><i class="fa-regular fa-xmark"></i></button>
            </div>
        </div>

        <script>
            document.querySelector('.contenedor_alerta .icon_remove button').addEventListener('click', function() {
                this.closest('.contenedor_alerta').style.display = 'none';
            });
        </script>
    @endif


    @if (session('error'))
        <div class="contenedor_alerta error">
            <div class="icon_alert"><i class="fa-regular fa-xmark"></i></div>
            <div class="content_alert">
                <div class="title">Error!</div>
                <div class="body">{{ session('error') }}</div>
            </div>
            <div class="icon_remove">
                <button class="button4 btn_3_2"><i class="fa-regular fa-xmark"></i></button>
            </div>
        </div>

        <script>
            document.querySelector('.contenedor_alerta.error .icon_remove button').addEventListener('click', function() {
                this.closest('.contenedor_alerta').style.display = 'none';
            });
        </script>
    @endif

    <section class="contenedor_agregar_periodo">
        <h4><b>Estudiantes a realizar Prácticas</b></h4>
        <hr>
        <section>
            <div class="mat-elevation-z8 contenedor_general">

                <div class="contenedor_tabla">
                    <div class="table-container mat-elevation-z8">

                        <div id="tablaDocentes">
                            <table class="mat-mdc-table">
                                <thead class="ng-star-inserted">
                                    <tr
                                        class="mat-mdc-header-row mdc-data-table__header-row cdk-header-row ng-star-inserted">
                                        <th class="tamanio1">ESTUDIANTE</th>
                                        <th>PRÁCTICA</th>
                                        <th class="tamanio4">TUTOR ACADÉMICO</th>
                                        <th class="tamanio4">TUTOR EMPRESARIAL</th>
                                        <th class="tamanio1">EMPRESA</th>
                                        <th>NRC</th>
                                        <th>PERIODO</th>
                                        <th>FECHA INICIO</th>
                                        <th>FECHA FIN</th>
                                        <th>HORAS PLANIFICADAS</th>
                                        <th>ESTADO</th>
                                        <th class="tamanio1">ACCIÓN</th>
                                    </tr>
                                </thead>
                                <tbody class="mdc-data-table__content ng-star-inserted">
                                    @foreach ($estudiantesConPracticaI as $practicaI)
                                        @if ($practicaI->estudiante)
                                            <tr>
                                                <td style="text-transform: uppercase; text-align: left;">
                                                    {{ strtoupper($practicaI->estudiante->apellidos) }}
                                                    {{ strtoupper($practicaI->estudiante->nombres) }}</td>
                                                <td style="text-transform: uppercase; text-align: left;">
                                                    {{ strtoupper($practicaI->tipoPractica) }}</td>
                                                <td style="text-transform: uppercase; text-align: left;">
                                                    {{ strtoupper($practicaI->tutorAcademico->apellidos) }}
                                                    {{ strtoupper($practicaI->tutorAcademico->nombres) }}</td>
                                                <td style="text-transform: uppercase; text-align: left;">
                                                    {{ strtoupper($practicaI->NombreTutorEmpresarial) }}</td>
                                                <td style="text-transform: uppercase; text-align: left;">
                                                    {{ strtoupper($practicaI->Empresa->nombreEmpresa) }}</td>
                                                <td>{{ strtoupper($practicaI->nrc) }}</td>
                                                <td>{{ strtoupper($practicaI->nrc) }}</td>
                                                <td>{{ strtoupper($practicaI->FechaInicio) }}</td>
                                                <td>{{ strtoupper($practicaI->FechaFinalizacion) }}</td>
                                                <td>{{ strtoupper($practicaI->HorasPlanificadas) }}</td>
                                                <td>{{ $practicaI->Estado }}</td>
                                                <td>
                                                    <form
                                                        action="{{ route('admin.actualizarEstadoEstudiante', ['id' => $practicaI->estudiante->estudianteId]) }}"
                                                        method="POST"
                                                        style="display: flex; align-items: center; justify-content: center;">
                                                        @csrf
                                                        @method('PUT')
                                                        <input type="hidden" name="id"
                                                            value="{{ $practicaI->estudiante->estudianteId }}"
                                                            class="input">
                                                        <select name="nuevoEstado"
                                                            class="form-control input1 input input_select1"
                                                            style="margin-right: 10px;">
                                                            <option value="1">Seleccione</option>
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
                                                <td>{{ strtoupper($practicaII->nrc) }}</td>
                                                <td>{{ strtoupper($practicaII->nrc) }}</td>
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
                                                            value="{{ $practicaII->estudiante->estudianteId }}"
                                                            class="input">
                                                        <select name="nuevoEstado"
                                                            class="form-control input1 input input_select1"
                                                            style="margin-right: 10px;">
                                                            <option value="1">Seleccione</option>
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

            </div>
        </section>

        <br>
        <h4><b>Estudiantes Practica 1</b></h4>
        <hr>
        <section>
            <div class="mat-elevation-z8 contenedor_general">
                <div class="contenedor_acciones_tabla sidebar_active_content_acciones_tabla">
                    <!-- Botones -->
                    <div class="contenedor_botones">
                        <div class="tooltip-container">
                            <span class="tooltip-text">Excel</span>
                            <form id="reportForm" action="{{ route('coordinador.reportesPracticaI') }}" method="POST"
                                onsubmit="submitForm(event)">
                                @csrf
                                <button type="submit" class="button3 efects_button btn_excel" id="submitButton">
                                    <span id="loadingIcon" style="display: none;">
                                        <img src="gif/load2.gif" alt="Loading" style="height: 20px;">
                                    </span>
                                    <i class="fa-solid fa-file-excel" id="excelIcon"></i>
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
                                        <button type="submit" class="button">Importar Archivo</button>
                                    </div>
                                </form>
                            </div>
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
                                        <th class="tamanio1">ESTUDIANTE</th>
                                        <th>PRÁCTICA</th>
                                        <th class="tamanio4">TUTOR ACADÉMICO</th>
                                        <th class="tamanio4">TUTOR EMPRESARIAL</th>
                                        <th class="tamanio1">EMPRESA</th>
                                        <th>NRC</th>
                                        <th>PERIODO</th>
                                        <th>FECHA INICIO</th>
                                        <th>FECHA FIN</th>
                                        <th>HORAS PLANIFICADAS</th>
                                        <th>ESTADO</th>

                                    </tr>
                                </thead>
                                <tbody class="mdc-data-table__content ng-star-inserted">
                                    @foreach ($estudiantesPracticas as $practicaI)
                                        @if ($practicaI->estudiante)
                                            <tr>
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
                                                <td>{{ strtoupper($practicaI->nrc->nrc ?? 'No cuenta con NRC') }}
                                                </td>
                                                <td>{{ strtoupper($practicaI->nrc->periodo->numeroPeriodo ?? 'No cuenta con NRC') }}
                                                </td>
                                                <td>{{ strtoupper($practicaI->FechaInicio) }}</td>
                                                <td>{{ strtoupper($practicaI->FechaFinalizacion) }}</td>
                                                <td>{{ strtoupper($practicaI->HorasPlanificadas) }}</td>
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
                                            <option value="100" @if ($perPage1 == 100) selected @endif>100
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
        <h4><b>Estudiantes Practica 1.2 </b></h4>

        <hr>
        <section>

            <div class="mat-elevation-z8 contenedor_general">
                <div class="contenedor_acciones_tabla sidebar_active_content_acciones_tabla">
                    <!-- Botones -->
                    <div class="contenedor_botones">

                        <div class="tooltip-container">
                            <span class="tooltip-text">Excel</span>
                            <form id="reportForm" action="{{ route('coordinador.reportesPracticaII') }}" method="POST"
                                onsubmit="submitForm(event)">
                                @csrf
                                <button type="submit" class="button3 efects_button btn_excel" id="submitButton">
                                    <span id="loadingIcon" style="display: none;">
                                        <img src="gif/load2.gif" alt="Loading" style="height: 20px;">
                                    </span>
                                    <i class="fa-solid fa-file-excel" id="excelIcon"></i>
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
                                        <th class="tamanio1">ESTUDIANTE</th>
                                        <th>PRÁCTICA</th>
                                        <th class="tamanio4">TUTOR ACADÉMICO</th>
                                        <th class="tamanio4">TUTOR EMPRESARIAL</th>
                                        <th class="tamanio1">EMPRESA</th>
                                        <th>NRC</th>
                                        <th>PERIODO</th>
                                        <th>FECHA INICIO</th>
                                        <th>FECHA FIN</th>
                                        <th>HORAS PLANIFICADAS</th>
                                        <th>ESTADO</th>

                                    </tr>
                                </thead>
                                <tbody class="mdc-data-table__content ng-star-inserted">
                                    @foreach ($estudiantesPracticasII as $practicaI)
                                        @if ($practicaI->estudiante)
                                            <tr>
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
                                                <td>{{ strtoupper($practicaI->nrcPractica->nrc ?? 'No cuenta con NRC') }}
                                                </td>
                                                <td>{{ strtoupper($practicaI->nrcPractica->periodo->numeroPeriodo ?? 'No cuenta con NRC') }}
                                                </td>
                                                <td>{{ strtoupper($practicaI->FechaInicio) }}</td>
                                                <td>{{ strtoupper($practicaI->FechaFinalizacion) }}</td>
                                                <td>{{ strtoupper($practicaI->HorasPlanificadas) }}</td>
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
                                    <form method="GET" action="{{ route('admin.aceptarFaseI') }}#practicas2">
                                        <select class="form-control page-item" name="paginacion2" id="perPage"
                                            onchange="this.form.submit()">
                                            <option value="10" @if ($perPage2 == 10) selected @endif>10
                                            </option>
                                            <option value="20" @if ($perPage2 == 20) selected @endif>20
                                            </option>
                                            <option value="50" @if ($perPage2 == 50) selected @endif>50
                                            </option>
                                            <option value="100" @if ($perPage2 == 100) selected @endif>100
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
                                            href="{{ $estudiantesPracticasII->previousPageUrl() }}&paginacion2={{ $perPage2 }}#practicas2"
                                            aria-label="Anterior">Anterior</a>
                                    </li>
                                @endif

                                @if ($estudiantesPracticasII->lastPage() > 1)
                                    @if ($estudiantesPracticasII->currentPage() > 3)
                                        <li class="page-item"><a class="page-link"
                                                href="{{ $estudiantesPracticasII->url(1) }}&paginacion2={{ $perPage2 }}#practicas2">1</a>
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
                                                    href="{{ $estudiantesPracticasII->url($i) }}&paginacion2={{ $perPage2 }}#practicas2">{{ $i }}</a>
                                            </li>
                                        @endif
                                    @endforeach
                                    @if ($estudiantesPracticasII->currentPage() < $estudiantesPracticasII->lastPage() - 2)
                                        @if ($estudiantesPracticasII->currentPage() < $estudiantesPracticasII->lastPage() - 3)
                                            <li class="page-item disabled"><span class="page-link">...</span></li>
                                        @endif
                                        <li class="page-item"><a class="page-link"
                                                href="{{ $estudiantesPracticasII->url($estudiantesPracticasII->lastPage()) }}&paginacion2={{ $perPage2 }}#practicas2">{{ $estudiantesPracticasII->lastPage() }}</a>
                                        </li>
                                    @endif
                                @endif

                                @if ($estudiantesPracticasII->hasMorePages())
                                    <li class="page-item">
                                        <a class="page-link"
                                            href="{{ $estudiantesPracticasII->nextPageUrl() }}&paginacion2={{ $perPage2 }}#practicas2"
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
        <h4><b>Estudiantes Practica 1.3</b></h4>

        <hr>
        <section>
            <div class="mat-elevation-z8 contenedor_general">
                <div class="contenedor_acciones_tabla sidebar_active_content_acciones_tabla">
                    <!-- Botones -->
                    <div class="contenedor_botones">

                        <div class="tooltip-container">
                            <span class="tooltip-text">Excel</span>
                            <form id="reportForm" action="{{ route('coordinador.reportesPracticaIII') }}" method="POST"
                                onsubmit="submitForm(event)">
                                @csrf
                                <button type="submit" class="button3 efects_button btn_excel" id="submitButton">
                                    <span id="loadingIcon" style="display: none;">
                                        <img src="gif/load2.gif" alt="Loading" style="height: 20px;">
                                    </span>
                                    <i class="fa-solid fa-file-excel" id="excelIcon"></i>
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
                                <form id="idModalImportar2" action="{{ route('import-practicas3') }}" method="POST"
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
                                        <th class="tamanio1">ESTUDIANTE</th>
                                        <th>PRÁCTICA</th>
                                        <th class="tamanio4">TUTOR ACADÉMICO</th>
                                        <th class="tamanio4">TUTOR EMPRESARIAL</th>
                                        <th class="tamanio1">EMPRESA</th>
                                        <th>NRC</th>
                                        <th>PERIODO</th>
                                        <th>FECHA INICIO</th>
                                        <th>FECHA FIN</th>
                                        <th>HORAS PLANIFICADAS</th>
                                        <th>ESTADO</th>

                                    </tr>
                                </thead>
                                <tbody class="mdc-data-table__content ng-star-inserted">
                                    @foreach ($estudiantesPracticasIII as $practicaI)
                                        @if ($practicaI->estudiante)
                                            <tr>
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
                                                <td>{{ strtoupper($practicaI->nrcPractica->nrc ?? 'No cuenta con NRC') }}
                                                </td>
                                                <td>{{ strtoupper($practicaI->nrcPractica->periodo->numeroPeriodo ?? 'No cuenta con NRC') }}
                                                </td>
                                                <td>{{ strtoupper($practicaI->FechaInicio) }}</td>
                                                <td>{{ strtoupper($practicaI->FechaFinalizacion) }}</td>
                                                <td>{{ strtoupper($practicaI->HorasPlanificadas) }}</td>
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
                                    <form method="GET" action="{{ route('admin.aceptarFaseI') }}#practicas3">
                                        <select class="form-control page-item" name="paginacion3" id="perPage"
                                            onchange="this.form.submit()">
                                            <option value="10" @if ($perPage3 == 10) selected @endif>10
                                            </option>
                                            <option value="20" @if ($perPage3 == 20) selected @endif>20
                                            </option>
                                            <option value="50" @if ($perPage3 == 50) selected @endif>50
                                            </option>
                                            <option value="100" @if ($perPage3 == 100) selected @endif>100
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
                                            href="{{ $estudiantesPracticasIII->previousPageUrl() }}&paginacion3={{ $perPage3 }}#practicas3"
                                            aria-label="Anterior">Anterior</a>
                                    </li>
                                @endif

                                @foreach (range(1, $estudiantesPracticasIII->lastPage()) as $i)
                                    @if ($i == $estudiantesPracticasIII->currentPage())
                                        <li class="page-item active">
                                            <span class="page-link">{{ $i }}</span>
                                        </li>
                                    @else
                                        <li class="page-item">
                                            <a class="page-link"
                                                href="{{ $estudiantesPracticasIII->url($i) }}&paginacion3={{ $perPage3 }}#practicas3">{{ $i }}</a>
                                        </li>
                                    @endif
                                @endforeach

                                @if ($estudiantesPracticasIII->hasMorePages())
                                    <li class="page-item">
                                        <a class="page-link"
                                            href="{{ $estudiantesPracticasIII->nextPageUrl() }}&paginacion3={{ $perPage3 }}#practicas3"
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
        <h4><b>Estudiantes Practica 2</b></h4>

        <hr>
        <section>
            <div class="mat-elevation-z8 contenedor_general">
                <div class="contenedor_acciones_tabla sidebar_active_content_acciones_tabla">
                    <!-- Botones -->
                    <div class="contenedor_botones">
                        <div class="tooltip-container">
                            <span class="tooltip-text">Excel</span>
                            <form id="reportForm" action="{{ route('coordinador.reportesPracticaIV') }}" method="POST"
                                onsubmit="submitForm(event)">
                                @csrf
                                <button type="submit" class="button3 efects_button btn_excel" id="submitButton">
                                    <span id="loadingIcon" style="display: none;">
                                        <img src="gif/load2.gif" alt="Loading" style="height: 20px;">
                                    </span>
                                    <i class="fa-solid fa-file-excel" id="excelIcon"></i>
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
                                <form id="idModalImportar2" action="{{ route('import-practicas4') }}" method="POST"
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
                                        <th class="tamanio1">ESTUDIANTE</th>
                                        <th>PRÁCTICA</th>
                                        <th class="tamanio4">TUTOR ACADÉMICO</th>
                                        <th class="tamanio4">TUTOR EMPRESARIAL</th>
                                        <th class="tamanio1">EMPRESA</th>
                                        <th>NRC</th>
                                        <th>PERIODO</th>
                                        <th>FECHA INICIO</th>
                                        <th>FECHA FIN</th>
                                        <th>HORAS PLANIFICADAS</th>
                                        <th>ESTADO</th>

                                    </tr>
                                </thead>
                                <tbody class="mdc-data-table__content ng-star-inserted">
                                    @foreach ($estudiantesPracticasIV as $practicaI)
                                        @if ($practicaI->estudiante)
                                            <tr>
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
                                                <td>{{ strtoupper($practicaI->nrcPractica->nrc ?? 'No cuenta con NRC') }}
                                                </td>
                                                <td>{{ strtoupper($practicaI->nrcPractica->periodo->numeroPeriodo ?? 'No cuenta con NRC') }}
                                                </td>
                                                <td>{{ strtoupper($practicaI->FechaInicio) }}</td>
                                                <td>{{ strtoupper($practicaI->FechaFinalizacion) }}</td>
                                                <td>{{ strtoupper($practicaI->HorasPlanificadas) }}</td>
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
                                    <form method="GET" action="{{ route('admin.aceptarFaseI') }}#practicas4">
                                        <select class="form-control page-item" name="paginacion4" id="perPage"
                                            onchange="this.form.submit()">
                                            <option value="10" @if ($perPage4 == 10) selected @endif>10
                                            </option>
                                            <option value="20" @if ($perPage4 == 20) selected @endif>20
                                            </option>
                                            <option value="50" @if ($perPage4 == 50) selected @endif>50
                                            </option>
                                            <option value="100" @if ($perPage4 == 100) selected @endif>100
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
                                            href="{{ $estudiantesPracticasIV->previousPageUrl() }}&paginacion4={{ $perPage4 }}#practicas4"
                                            aria-label="Anterior">Anterior</a>
                                    </li>
                                @endif

                                @if ($estudiantesPracticasIV->lastPage() > 1)
                                    @if ($estudiantesPracticasIV->currentPage() > 3)
                                        <li class="page-item"><a class="page-link"
                                                href="{{ $estudiantesPracticasIV->url(1) }}&paginacion4={{ $perPage4 }}#practicas4">1</a>
                                        </li>
                                        @if ($estudiantesPracticasIV->currentPage() > 4)
                                            <li class="page-item disabled"><span class="page-link">...</span></li>
                                        @endif
                                    @endif
                                    @foreach (range(max(1, $estudiantesPracticasIV->currentPage() - 2), min($estudiantesPracticasIV->currentPage() + 2, $estudiantesPracticasIV->lastPage())) as $i)
                                        @if ($i == $estudiantesPracticasIV->currentPage())
                                            <li class="page-item active"><span
                                                    class="page-link">{{ $i }}</span></li>
                                        @else
                                            <li class="page-item"><a class="page-link"
                                                    href="{{ $estudiantesPracticasIV->url($i) }}&paginacion4={{ $perPage4 }}#practicas4">{{ $i }}</a>
                                            </li>
                                        @endif
                                    @endforeach
                                    @if ($estudiantesPracticasIV->currentPage() < $estudiantesPracticasIV->lastPage() - 2)
                                        @if ($estudiantesPracticasIV->currentPage() < $estudiantesPracticasIV->lastPage() - 3)
                                            <li class="page-item disabled"><span class="page-link">...</span></li>
                                        @endif
                                        <li class="page-item"><a class="page-link"
                                                href="{{ $estudiantesPracticasIV->url($estudiantesPracticasIV->lastPage()) }}&paginacion4={{ $perPage4 }}#practicas4">{{ $estudiantesPracticasIV->lastPage() }}</a>
                                        </li>
                                    @endif
                                @endif

                                @if ($estudiantesPracticasIV->hasMorePages())
                                    <li class="page-item">
                                        <a class="page-link"
                                            href="{{ $estudiantesPracticasIV->nextPageUrl() }}&paginacion4={{ $perPage4 }}#practicas4"
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
        <h4><b>Estudiantes Practica 2.1</b></h4>

        <hr>
        <section>
            <div class="mat-elevation-z8 contenedor_general">
                <div class="contenedor_acciones_tabla sidebar_active_content_acciones_tabla">
                    <!-- Botones -->
                    <div class="contenedor_botones">
                        <div class="tooltip-container">
                            <span class="tooltip-text">Excel</span>
                            <form id="reportForm" action="{{ route('coordinador.reportesPracticaV') }}" method="POST"
                                onsubmit="submitForm(event)">
                                @csrf
                                <button type="submit" class="button3 efects_button btn_excel" id="submitButton">
                                    <span id="loadingIcon" style="display: none;">
                                        <img src="gif/load2.gif" alt="Loading" style="height: 20px;">
                                    </span>
                                    <i class="fa-solid fa-file-excel" id="excelIcon"></i>
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
                                <form id="idModalImportar2" action="{{ route('import-practicas5') }}" method="POST"
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



                    </div>
                </div>

                <div class="contenedor_tabla">
                    <div class="table-container mat-elevation-z8">

                        <div id="tablaDocentes">
                            <table class="mat-mdc-table">
                                <thead class="ng-star-inserted">
                                    <tr
                                        class="mat-mdc-header-row mdc-data-table__header-row cdk-header-row ng-star-inserted">
                                        <th class="tamanio1">ESTUDIANTE</th>
                                        <th>PRÁCTICA</th>
                                        <th class="tamanio4">TUTOR ACADÉMICO</th>
                                        <th class="tamanio4">TUTOR EMPRESARIAL</th>
                                        <th class="tamanio1">EMPRESA</th>
                                        <th>NRC</th>
                                        <th>PERIODO</th>
                                        <th>FECHA INICIO</th>
                                        <th>FECHA FIN</th>
                                        <th>HORAS PLANIFICADAS</th>
                                        <th>ESTADO</th>

                                    </tr>
                                </thead>
                                <tbody class="mdc-data-table__content ng-star-inserted">
                                    @foreach ($estudiantesPracticasV as $practicaI)
                                        @if ($practicaI->estudiante)
                                            <tr>
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
                                                <td>{{ strtoupper($practicaI->nrcPractica->nrc ?? 'No cuenta con NRC') }}
                                                </td>
                                                <td>{{ strtoupper($practicaI->nrcPractica->periodo->numeroPeriodo ?? 'No cuenta con NRC') }}
                                                </td>
                                                <td>{{ strtoupper($practicaI->FechaInicio) }}</td>
                                                <td>{{ strtoupper($practicaI->FechaFinalizacion) }}</td>
                                                <td>{{ strtoupper($practicaI->HorasPlanificadas) }}</td>
                                                <td>{{ $practicaI->Estado }}</td>


                                            </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>

                        </div>
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


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


@endsection
