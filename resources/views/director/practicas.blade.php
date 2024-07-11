@extends('layouts.director')
@section('title', 'Panel Practicas')
@section('title_component', 'Panel Practicas')
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

        <h4><b>Estudiantes Práctica 1</b></h4>
        <hr>
        <section>
            <div class="mat-elevation-z8 contenedor_general">
                <div class="contenedor_acciones_tabla sidebar_active_content_acciones_tabla">
                    <!-- Botones -->
                    <div class="contenedor_botones">
                        <div class="tooltip-container">
                            <span class="tooltip-text">Excel</span>
                            <form action="{{ route('coordinador.reportesPracticaI') }}" method="POST">
                                @csrf
                                <button type="submit" class="button3 efects_button btn_excel">
                                    <i class="fas fa-file-excel"></i>
                                </button>
                            </form>
                        </div>


                    </div>



                    <div class="contenedor_buscador">
                        <div>
                            <form id="formbusquedaPractica1">
                                <input type="text" class="input" name="search" value="{{ $search }}" matInput
                                    placeholder="Buscar en practicas 1...">
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
                                        <th>NRC</th>
                                        <th>PERIODO</th>
                                        <th>FECHA INICIO</th>
                                        <th>FECHA FIN</th>
                                        <th>HORAS PLANIFICADAS</th>
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
                                            <li class="page-item active"><span class="page-link">{{ $i }}</span>
                                            </li>
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
                            <form action="{{ route('coordinador.reportesPracticaIII') }}" method="POST">
                                @csrf
                                <button type="submit" class="button3 efects_button btn_excel">
                                    <i class="fas fa-file-excel"></i>
                                </button>
                            </form>
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
                                        <th>NRC</th>
                                        <th>PERIODO</th>
                                        <th>FECHA INICIO</th>
                                        <th>FECHA FIN</th>
                                        <th>HORAS PLANIFICADAS</th>
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
                            <form action="{{ route('coordinador.reportesPracticaIV') }}" method="POST">
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
                                onclick="openCard('cardImportarArchivo3');">
                                <i class="fa fa-upload"></i>
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
                                        <th>NRC</th>
                                        <th>PERIODO</th>
                                        <th>FECHA INICIO</th>
                                        <th>FECHA FIN</th>
                                        <th>HORAS PLANIFICADAS</th>
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
                            <form action="{{ route('coordinador.reportesPracticaII') }}" method="POST">
                                @csrf
                                <button type="submit" class="button3 efects_button btn_excel">
                                    <i class="fas fa-file-excel"></i>
                                </button>
                            </form>
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
                                        <th>NRC</th>
                                        <th>PERIODO</th>
                                        <th>FECHA INICIO</th>
                                        <th>FECHA FIN</th>
                                        <th>HORAS PLANIFICADAS</th>
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
                    url: '{{ route('director.practicas') }}',
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
                    url: '{{ route('director.practicas') }}',
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
                    url: '{{ route('director.practicas') }}',
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
                    url: '{{ route('director.practicas') }}',
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
