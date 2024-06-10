@extends('layouts.admin')

@section('title', 'Aceptación de Estudiantes')

@section('title_component', 'Aceptación de Estudiantes')

@section('content')


    <section class="contenedor_agregar_periodo">
        <h4><b>Estudiantes en Proceso de Revisión</b></h4>
        <hr>
        <section>
            <div class="mat-elevation-z8 contenedor_general">

                <div class="contenedor_acciones_tabla">
                    <form action="{{ route('admin.estudiantes') }}" method="GET">
                        @csrf
                        <div class="form-group d-flex align-items-center">

                            <label for="buscarEstudiantesEnRevision" class="mr-2">Buscar Estudiantes en Proceso de
                                Revisión:</label>
                            <input type="text" class="form-control input" name="buscarEstudiantesEnRevision"
                                id="buscarEstudiantesEnRevision">
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
                                        <th class="tamanio1">NOMBRE</th>
                                        <th>ID ESPE</th>
                                         <th class="tamanio2">CÉDULA</th>
                                        <th>Cohorte</th>
                                        <th class="tamanio1">DEPARTAMENTO</th>
                                        <th class="tamanio1">ESTADO ACTUAL</th>
                                        <th>OBSERVACIÓN</th>
                                        <th>ESTADO</th>
                                        <th>ACTUALIZAR</th>
                                    </tr>
                                </thead>
                                <tbody class="mdc-data-table__content ng-star-inserted">
                                    @if ($estudiantesEnRevision->isEmpty())
                                        <tr style="text-align:center">
                                            <td colspan="10">No hay estudiantes en proceso de revisión.</td>
                                        </tr>
                                    @else
                                        @foreach ($estudiantesEnRevision as $estudiante)
                                            <tr>

                                                <td style="text-transform: uppercase; text-align: left;">{{ strtoupper($estudiante->Apellidos) }} {{ strtoupper($estudiante->Nombres) }}</td>
                                                <td>{{ $estudiante->espe_id }}</td>
                                                 <td>{{ $estudiante->cedula }}</td>
                                                <td>{{ $estudiante->periodos->numeroPeriodo }}</td>
                                                <td style="text-transform: uppercase;">{{ strtoupper($estudiante->Departamento) }}</td>
                                                <td style="text-transform: uppercase;">{{ strtoupper($estudiante->Estado) }}</td>
                                                @if ($estudiante->comentario !== 'Sin comentarios')
                                                    <td>{{ strtoupper($estudiante->comentario) }}</td>
                                                @else
                                                    <td></td>
                                                @endif

                                                <td>
                                                    <form id="updateEstudianteForm" action="{{ route('admin.updateEstudiante', ['id' => $estudiante->EstudianteID]) }}" method="POST" onsubmit="enviarCorreo(event)">
                                                        @csrf
                                                        @method('PUT')
                                                        <input type="hidden" id="motivoNegacion" name="motivoNegacion">
                                                        <select name="nuevoEstado" id="nuevoEstado" onchange="verificarEstado()" class="form-control input1 input_select">
                                                            <option value="Aprobado">Aprobado</option>
                                                            <option value="Negado">Negado</option>
                                                        </select>
                                                        
                                                    </form>
                                                </td>
                                                <td>
                                                    <center><button type="submit" form="updateEstudianteForm" class="button3">
                                                        <i class="bx bx-check"></i>
                                                    </button></center>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>

            </div>
        </section>
        <br>
        <h4><b>Seguimiento Estudiantes</b></h4>
        <hr>
        <section>
            <div class="mat-elevation-z8 contenedor_general">

                <div class="contenedor_acciones_tabla">

                    <div class="contenedor_buscador">
                        <div>
                            <form id="formBusquedaEstudiantes">
                                <input type="text" class="input" name="search2" value="{{ $search2 }}"
                                       matInput placeholder="Buscar estudiantes...">
                                <i class='bx bx-search-alt'></i>
                            </form>

                        </div>
                    </div>
                </div>


                <div class="contenedor_tabla">
                    <div class="table-container mat-elevation-z8">

                        <div id="tablaEstudiantes">
                            <table class="mat-mdc-table">
                                <thead class="ng-star-inserted">
                                    <tr
                                        class="mat-mdc-header-row mdc-data-table__header-row cdk-header-row ng-star-inserted">

                                        <th class="tamanio1">NOMBRES</th>
                                        <th>ID ESPE</th>
                                        <th class="tamanio1">CARRERA</th>
                                         <th>CÉDULA</th>
                                        <th>COHORTE</th>
                                        <th>PERIODO</th>
                                        <th class="tamanio1">DEPARTAMENTO</th>
                                        <th>ESTADO</th>

                                    </tr>
                                </thead>
                                <tbody class="mdc-data-table__content ng-star-inserted">
                                    @if ($estudiantesAprobados->isEmpty())
                                        <tr style="text-align:center">
                                            <td colspan="9">No hay estudiantes en proceso de revisión.</td>
                                        </tr>
                                    @else
                                        @foreach ($estudiantesAprobados as $estudiante)
                                            <tr>
                                                <td style="text-transform: uppercase; text-align: left;">{{ strtoupper($estudiante->Apellidos . ' ' . $estudiante->Nombres) }}
                                                </td>
                                                <td>{{ $estudiante->espe_id }}</td>
                                                <td style="text-transform: uppercase; text-align: left;">{{ strtoupper($estudiante->Carrera) }}</td>
                                                 <td>{{ $estudiante->cedula }}</td>
                                                <td>{{ $estudiante->periodos->numeroPeriodo }}</td>
                                                <td>{{ $estudiante->periodos->Periodo }}</td>
                                                <td style="text-transform: uppercase;">{{ strtoupper($estudiante->Departamento) }}</td>
                                                <td style="text-transform: uppercase; ">
                                                    @if ($estudiante->Estado == 'Aprobado')
                                                        {{ strtoupper('Vinculación') }}
                                                    @elseif ($estudiante->Estado == 'Aprobado-prácticas')
                                                        {{ strtoupper('Prácticas') }}
                                                    @else
                                                        {{ strtoupper($estudiante->Estado) }}
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>

                        </div>
                    </div>


                    <div class="paginator-container">
                        <nav aria-label="...">

                            <ul class="pagination">
                                <li class="page-item mx-3">
                                    <form method="GET" action="{{ route('admin.estudiantes') }}#tablaEstudiantes">
                                        <select class="form-control page-item" name="elementosPorPaginaAprobados" id="elementosPorPaginaAprobados" onchange="this.form.submit()">
                                            <option value="10" @if ($elementosPorPaginaAprobados == 10) selected @endif>10</option>
                                            <option value="20" @if ($elementosPorPaginaAprobados == 20) selected @endif>20</option>
                                            <option value="50" @if ($elementosPorPaginaAprobados == 50) selected @endif>50</option>
                                            <option value="100" @if ($elementosPorPaginaAprobados == 100) selected @endif>100</option>
                                        </select>
                                    </form>
                                </li>

                                @if ($estudiantesAprobados->onFirstPage())
                                <li class="page-item disabled">
                                    <span class="page-link">Anterior</span>
                                </li>
                                @else
                                <li class="page-item">
                                    <a class="page-link" href="{{ $estudiantesAprobados->appends(['elementosPorPaginaAprobados' => $elementosPorPaginaAprobados])->previousPageUrl() }}#tablaEstudiantes" aria-label="Anterior">Anterior</a>
                                </li>
                                @endif

                                @foreach ($estudiantesAprobados->getUrlRange(1, $estudiantesAprobados->lastPage()) as $page => $url)
                                @if ($page == $estudiantesAprobados->currentPage())
                                <li class="page-item active">
                                    <span class="page-link">{{ $page }}</span>
                                </li>
                                @else
                                <li class="page-item">
                                    <a class="page-link" href="{{ $estudiantesAprobados->appends(['elementosPorPaginaAprobados' => $elementosPorPaginaAprobados])->url($page) }}#tablaEstudiantes">{{ $page }}</a>
                                </li>
                                @endif
                                @endforeach

                                @if ($estudiantesAprobados->hasMorePages())
                                <li class="page-item">
                                    <a class="page-link" href="{{ $estudiantesAprobados->appends(['elementosPorPaginaAprobados' => $elementosPorPaginaAprobados])->nextPageUrl() }}#tablaEstudiantes" aria-label="Siguiente">Siguiente</a>
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

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://code.jquery.com/ui/1.13.0/jquery-ui.min.js"></script>
        <script>
            var delayTimer;
            $('#formBusquedaEstudiantes input[name="search2"]').on('keyup', function() {
                clearTimeout(delayTimer);
                var query = $(this).val();
                delayTimer = setTimeout(function() {
                    $.ajax({
                        url: '{{ route('admin.estudiantes') }}',
                        type: 'GET',
                        data: {
                            search2: query
                        },
                        success: function(response) {
                            $('#tablaEstudiantes').html($(response).find('#tablaEstudiantes').html());
                        }
                    });
                }, 500);
            });
        </script>

@endsection




