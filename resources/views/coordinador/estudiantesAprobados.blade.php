@extends('layouts.coordinador')

@section('title', 'Estudiantes Aprobados')

@section('title_component', 'Estudiantes Aprobados')

@section('content')

    <section>
        <div class="contenedor_registro_genero ">
            <h4><b>Departamento DCCO</b></h4>
            <hr>
            <div class="mat-elevation-z8 contenedor_general">

                <div class="contenedor_acciones_tabla">

                    <form method="GET" action="{{ route('coordinador.estudiantesAprobados') }}">
                        @csrf
                        <div class="form-group d-flex align-items-center">

                            <input class="form-control input" type="text" name="buscarEstudiantesGeneral"
                                id="buscarEstudiantesGeneral" placeholder="Buscar estudiantes">
                            <div class="btn-group ml-2 shadow-0">
                                <button type="submit" class="button5">Buscar
                                    <i class="bx bx-search-alt"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>


                <div class="contenedor_tabla">
                    <div class="table-container mat-elevation-z8">

                        <div id="tablaDocentes">
                            <table class="mat-mdc-table">
                                <thead class="ng-star-inserted">
                                    <tr
                                        class="mat-mdc-header-row mdc-data-table__header-row cdk-header-row ng-star-inserted">

                                        <th>Estudiante</th>
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
                                    @foreach ($estudiantesDCCO as $estudiante)
                                        <tr>
                                            <td>{{ strtoupper($estudiante->Apellidos) }}
                                                {{ strtoupper($estudiante->Nombres) }}</td>
                                            <td>{{ strtoupper($estudiante->espe_id) }}</td>
                                            <td>{{ strtoupper($estudiante->Carrera) }}</td>
                                            <td>{{ strtoupper($estudiante->celular) }}</td>
                                            <td>{{ strtoupper($estudiante->cedula) }}</td>
                                            <td>{{ strtoupper($estudiante->periodos->numeroPeriodo) }}</td>
                                            <td>{{ strtoupper($estudiante->periodos->Periodo) }}</td>
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
                        </div>
                    </div>

                    <div class="paginator-container">
                        <nav aria-label="...">

                            <ul class="pagination mx-2">
                                <li class="page-item">
                                    <form method="GET" action="{{ route('coordinador.estudiantesAprobados') }}">

                                        <select class="form-control page-item" class="input"
                                            name="elementosPorPaginaDepartamento" onchange="this.form.submit">
                                            <option value="10"
                                                {{ request('elementosPorPaginaDepartamento') == 10 ? 'selected' : '' }}>10
                                            </option>
                                            <option value="20"
                                                {{ request('elementosPorPaginaDepartamento') == 20 ? 'selected' : '' }}>20
                                            </option>
                                            <option value="50"
                                                {{ request('elementosPorPaginaDepartamento') == 50 ? 'selected' : '' }}>50
                                            </option>
                                            <option value="100"
                                                {{ request('elementosPorPaginaDepartamento') == 100 ? 'selected' : '' }}>
                                                100</option>
                                        </select>

                                    </form>
                                </li>



                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
    </section>

    <br>
    <section>
        <div class="contenedor_registro_genero ">
            <h4><b>Departamento DCEX</b></h4>
            <hr>
            <div class="mat-elevation-z8 contenedor_general">



                <div class="contenedor_tabla">
                    <div class="table-container mat-elevation-z8">

                        <div id="tablaDocentes">
                            <table class="mat-mdc-table">
                                <thead class="ng-star-inserted">
                                    <tr
                                        class="mat-mdc-header-row mdc-data-table__header-row cdk-header-row ng-star-inserted">


                                        <th>Estudiante</th>
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
                                    @foreach ($estudiantesDCEX as $estudiante)
                                        <tr>
                                            <td>{{ strtoupper($estudiante->Apellidos) }}
                                                {{ strtoupper($estudiante->Nombres) }}</td>
                                            <td>{{ strtoupper($estudiante->espe_id) }}</td>
                                            <td>{{ strtoupper($estudiante->Carrera) }}</td>
                                            <td>{{ strtoupper($estudiante->celular) }}</td>
                                            <td>{{ strtoupper($estudiante->cedula) }}</td>
                                            <td>{{ strtoupper($estudiante->cohortes->Cohorte) }}</td>
                                            <td>{{ strtoupper($estudiante->periodos->Periodo) }}</td>
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
                        </div>
                    </div>


                </div>
            </div>

    </section>


    <br>
    <section>
        <div class="contenedor_registro_genero ">
            <h4><b>Departamento DCVA</b></h4>
            <hr>
            <div class="mat-elevation-z8 contenedor_general">

                <div class="contenedor_acciones_tabla sidebar_active_content_acciones_tabla">
                    <!-- Botones -->
                    <div class="row">
                        <div class="col-md-12 d-flex align-items-center">


                            <form method="POST" action="{{ route('coordinador.reportesEstudiantes') }}">
                                @csrf
                                <div class="tooltip-container">
                                    <span class="tooltip-text">Excel</span>
                                    <button type="submit" class="btn btn-sm btn-secondary">
                                        <i class="fas fa-file-excel"></i> Generar Reporte
                                    </button>
                                </div>
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
                                        <th>Estudiante</th>
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
                                    @foreach ($estudiantesDCVA as $estudiante)
                                        <tr>
                                            <td>{{ strtoupper($estudiante->Apellidos) }}
                                                {{ strtoupper($estudiante->Nombres) }}
                                            </td>
                                            <td>{{ strtoupper($estudiante->espe_id) }}</td>
                                            <td>{{ strtoupper($estudiante->Carrera) }}</td>
                                            <td>{{ strtoupper($estudiante->celular) }}</td>
                                            <td>{{ strtoupper($estudiante->cedula) }}</td>
                                            <td>{{ strtoupper($estudiante->cohortes->Cohorte) }}</td>
                                            <td>{{ strtoupper($estudiante->periodos->Periodo) }}</td>
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
                        </div>
                    </div>


                </div>
            </div>

    </section>

    <br>
    <section>

        {{--     <div id="verEstudiantes" style="display: none;">
            <h4>Estudiantes culminados Vinculacion a la sociedad</h4>
            <div class="d-flex">
                <form method="GET" action="{{ route('coordinador.estudiantesAprobados') }}" class="mr-3">
                    <label for="elementosPorPagina">Estudiantes a visualizar:</label>
                    <select name="elementosPorPagina" id="elementosPorPagina2" onchange="this.form.submit()">
                        <option value="10" @if (request('elementosPorPagina', $elementosPorPagina) == 10) selected @endif>10</option>
                        <option value="20" @if (request('elementosPorPagina', $elementosPorPagina) == 20) selected @endif>20</option>
                        <option value="50" @if (request('elementosPorPagina', $elementosPorPagina) == 50) selected @endif>50</option>
                        <option value="100" @if (request('elementosPorPagina', $elementosPorPagina) == 100) selected @endif>100</option>
                    </select>
                </form>

                <form method="GET" action="{{ route('coordinador.estudiantesAprobados') }}">
                    <input type="text" name="buscarEstudiantes" placeholder="Buscar estudiantes">
                    <button type="submit">Buscar</button>
                </form>



            </div>
            <div style="overflow-x: auto;">
                <table class="table">
                    <thead>
                        <tr>
                            <th>N~</th>
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

                <form action="{{ route('coordinador.reportesVinculacion') }}" method="post">
                    @csrf
                    <button type="submit" class="btn btn-sm btn-secondary">
                        <i class="fas fa-file-excel"></i> Generar Reporte
                    </button>
                </form>







            </div>
        </div>
 --}}
    </section>


    <section>
        <button id="toggleFormBtn" class="btn btn-outline-secondary btn-block">Estudiantes culminados Vinculacion a la
            Sociedad</button>
        <br>

        <div class="contenedor_registro_genero ">
            <div id="verEstudiantes" style="display: none;">
                <h4><b>Estudiantes culminados Vinculacion a la sociedad</b></h4>
                <hr>
                <div class="mat-elevation-z8 contenedor_general">

                    <div class="contenedor_acciones_tabla">

                        <form method="POST" action="{{ route('coordinador.reportesEstudiantes') }}">
                            @csrf
                            <div class="tooltip-container">
                                <span class="tooltip-text">Excel</span>
                                <button type="submit" class="btn btn-sm btn-secondary">
                                    <i class="fas fa-file-excel"></i> Generar Reporte
                                </button>
                            </div>
                        </form>

                        <form method="GET" action="{{ route('coordinador.estudiantesAprobados') }}">
                            @csrf
                            <div class="form-group d-flex align-items-center">

                                <input class="form-control input" type="text" name="buscarEstudiantes"
                                    id="buscarEstudiantes" placeholder="Buscar estudiantes">
                                <div class="btn-group ml-2 shadow-0">
                                    <button type="submit" class="button5">Buscar
                                        <i class="bx bx-search-alt"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>


                    <div class="contenedor_tabla">
                        <div class="table-container mat-elevation-z8">

                            <div id="tablaDocentes">
                                <table class="mat-mdc-table">
                                    <thead class="ng-star-inserted">
                                        <tr
                                            class="mat-mdc-header-row mdc-data-table__header-row cdk-header-row ng-star-inserted">

                                            <th>N~</th>
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
                                            $contador =
                                                ($estudiantesVinculacion->currentPage() - 1) * $elementosPorPagina + 1;
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
                        </div>

                        <div class="paginator-container">
                            <nav aria-label="...">

                                <ul class="pagination mx-2">
                                    <li class="page-item">
                                        <form method="GET" action="{{ route('coordinador.estudiantesAprobados') }}"
                                            class="mx-2">
                                            <select name="elementosPorPagina" id="elementosPorPagina2"
                                                class="form-control page-item" class="input"
                                                onchange="this.form.submit">
                                                <option value="10" @if (request('elementosPorPagina', $elementosPorPagina) == 10) selected @endif>10
                                                </option>
                                                <option value="20" @if (request('elementosPorPagina', $elementosPorPagina) == 20) selected @endif>20
                                                </option>
                                                <option value="50" @if (request('elementosPorPagina', $elementosPorPagina) == 50) selected @endif>50
                                                </option>
                                                <option value="100" @if (request('elementosPorPagina', $elementosPorPagina) == 100) selected @endif>
                                                    100</option>
                                            </select>
                                        </form>
                                    </li>


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


                                </ul><br><br>
                            </nav>
                        </div>


                    </div>
                </div>
            </div>
            <br>
    </section>



@endsection
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
{{--    <link rel="stylesheet" href="https://cdn.ckeditor.com/4.16.1/standard/ckeditor.css">
    <script src="https://cdn.ckeditor.com/4.16.1/standard/ckeditor.js"></script> --}}
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Obtener el estado del formulario desde localStorage (si existe)
        var formularioVisible = localStorage.getItem("formularioVisible");

        // Mostrar u ocultar el formulario según el estado almacenado
        if (formularioVisible === "true") {
            document.getElementById("verEstudiantes").style.display = "block";
            document.getElementById("toggleFormBtn").textContent =
                "Cerrar Estudiantes culminados Vinculacion a la Sociedad";
        }

        // Manejar el clic en el botón para mostrar/ocultar el formulario
        document.getElementById("toggleFormBtn").addEventListener("click", function() {
            var formulario = document.getElementById("verEstudiantes");

            if (formulario.style.display === "none") {
                formulario.style.display = "block";
                localStorage.setItem("formularioVisible", "true");
                this.textContent = "Cerrar Estudiantes culminados Vinculacion a la Sociedad";
            } else {
                formulario.style.display = "none";
                localStorage.setItem("formularioVisible", "false");
                this.textContent = "Estudiantes culminados Vinculacion a la Sociedad";
            }
        });
    });
</script>
