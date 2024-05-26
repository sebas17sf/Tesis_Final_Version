@extends('layouts.admin')

@section('title', 'Proyectos')

@section('title_component', 'Proyectos')

@section('content')

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


    <section >
        <div class="contenedor_registro_genero "> 
        <h3><b>Listado de Proyectos</b></h3>
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
                                    <option value="Terminado" {{ old('estado') == 'Terminado' ? 'selected' : '' }}>Terminado
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
                        </form>
                    </div>
                </div>
           
</div>


        <div class="contenedor_tabla">
                <div class="table-container mat-elevation-z8">

                    <div id="tablaProyectos">
                        <table class="mat-mdc-table">
                            <thead class="ng-star-inserted">
                                <tr class="mat-mdc-header-row mdc-data-table__header-row cdk-header-row ng-star-inserted">
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
                                            <td>
                                                @if ($proyecto->director)
                                                    {{ strtoupper($proyecto->director->Apellidos) }}
                                                    {{ strtoupper($proyecto->director->Nombres) }}
                                                @else
                                                    Director no asignado
                                                @endif
                                            </td>

                                            <td style="word-wrap: break-word; text-align: justify;">
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
                                                <div class="contenedor_botones">
                                                    <div class="btn-group  shadow-0">
                                                        <div class="tooltip-container">
                                                            <span class="tooltip-text">Editar</span>
                                                            <a href="{{ route('admin.editarProyecto', ['ProyectoID' => $proyecto->ProyectoID]) }}"
                                                                type="button" class="button3 efects_button btn_editar3">
                                                                <i class="bx bx-edit-alt"></i>
                                                            </a>
                                                        </div>
                                                        <form class="btn-group shadow-1"
                                                            action="{{ route('admin.deleteProyecto', ['ProyectoID' => $proyecto->ProyectoID]) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <div class="tooltip-container">
                                                                <span class="tooltip-text">Eliminar</span>
                                                                <button type="submit"
                                                                    class="button3 efects_button btn_eliminar3"
                                                                    onclick="return confirm('¿Estás seguro de eliminar este proyecto?')">
                                                                    <i class="bx bx-trash"></i>
                                                                </button>
                                                            </div>
                                                        </form>
                                                    </div>
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
                                <form method="GET" action="{{ route('admin.indexProyectos') }}">
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

   
        <hr>
        <h3><b>Listado de asignaciones</b></h3>
        <hr>

        <div class="row">
            <div class="tooltip-container">
                <span class="tooltip-text">Matriz de Vinculacion</span>
                <form id="reportForm" action="{{ route('reporte.matrizVinculacion') }}" method="POST"
                    onsubmit="submitForm(event)">
                    @csrf
                    <button type="submit" class="button3 efects_button btn_excel" id="submitButton">
                        <span id="loadingIcon" style="display: none;">
                            <img src="gif/load2.gif" alt="Loading" style="height: 20px;">
                        </span>
                        <i class="fa-solid fa-file-excel" id="excelIcon"></i>
                    </button>
                </form>
                <br>
            </div>

            <form action="{{ route('import') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="file" name="file" required>
                <button type="submit">Importar Archivo</button>
            </form>
        </div>




        <div class="contenedor_tabla">

            <div class="table-container mat-elevation-z8">

                <div id="tablaDocentes">
                    <table class="mat-mdc-table">
                        <thead class="ng-star-inserted" id="professorsTable">
                            <tr class="mat-mdc-header-row mdc-data-table__header-row cdk-header-row ng-star-inserted">
                                <th class="tamanio"> NOMBRE DE PROYECTO</th>
                                <th>CODIGO DE PROYECTO</th>
                                <th>DIRECTOR</th>
                                <th>DOCENTES PARTICIPANTES</th>
                                <th>FECHA ASIGNACION</th>
                                <th>ESTUDIANTES</th>
                                <th>PERIODO</th>
                                <th>NRC</th>
                                <th>FECHA INICIO</th>
                                <th>FECHA FIN</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($asignacionesAgrupadas as $grupo)
                                <tr>
                                    <td>{{ $grupo->first()->proyecto->NombreProyecto ?? '' }}</td>
                                    <td>{{ $grupo->first()->proyecto->codigoProyecto ?? '' }}</td>
                                    <td>{{ $grupo->first()->proyecto->director->Apellidos ?? '' }}</td>
                                    <td>
                                        @php
                                            $participantes = $grupo
                                                ->pluck('docenteParticipante')
                                                ->unique('id')
                                                ->pluck('Nombres')
                                                ->implode('<br>');
                                        @endphp
                                        {!! $participantes !!}
                                    </td>
                                    <td>{{ $grupo->first()->FechaAsignacion ?? '' }}</td>
                                    <td>
                                        @foreach ($grupo as $asignacion)
                                            {{ $asignacion->estudiante->Nombres ?? '' }}<br>
                                        @endforeach
                                    </td>
                                    <td>{{ $grupo->first()->periodo->numeroPeriodo ?? '' }}</td>
                                    <td>{{ $grupo->first()->nrcVinculacion->nrc ?? '' }}</td>
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

                    <ul class="pagination">
                        <li class="page-item mx-3">
                            <form method="GET" action="{{ route('admin.indexProyectos') }}">
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

    </section>
    <hr>
    <section>

        <div class="container">
           <center> <button id="toggleFormBtn3" class="button1_1 efects_button">Asignar estudiante</button></center>
            <div id="asignarEstudiante" style="display: none;">
                <hr>
                <h3><b>Asignar Proyecto</b></h3>
                <hr>
                <form method="POST" action="{{ route('admin.guardarAsignacion') }}">
                    @csrf

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="proyecto_id"><strong>Proyecto Disponible:</strong></label>
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
                                <label for="ProfesorParticipante">Docente Participante:</label>
                                <select name="ProfesorParticipante" class="form-control input input_select" required>
                                    <option value="">Seleccionar Docente Participante</option>
                                    @foreach ($profesores as $profesor)
                                        <option value="{{ $profesor->id }}">
                                            Nombres: {{ $profesor->Apellidos }} {{ $profesor->Nombres }} -
                                            Departamento: {{ $profesor->Departamento }} -
                                            Correo: {{ $profesor->Correo }}
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
                                <label for="estudiante_id"><strong>Estudiante Aprobado:</strong></label>
                                <select name="estudiante_id[]" id="estudiante_id" class="form-control input input_select"
                                    multiple="multiple">
                                    @foreach ($estudiantesAprobados as $estudiante)
                                        <option value="{{ $estudiante->EstudianteID }}">
                                            {{ $estudiante->Nombres }} {{ $estudiante->Apellidos }} -
                                            {{ $estudiante->Departamento }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>




                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nrc">Vinculacion NRC:</label>
                                <select name="nrc" id="nrc" class="form-control input input_select" required>
                                    <option value="">Seleccionar NRC</option>
                                    @foreach ($nrcs as $nrc)
                                        <option value="{{ $nrc->id }}"
                                            data-periodo="{{ $nrc->periodo->numeroPeriodo }} {{ $nrc->periodo->Periodo }}">
                                            {{ $nrc->nrc }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="periodo">Periodo:</label>
                                <input type="text" id="periodo" class="form-control input" readonly>
                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="FechaInicio">Fecha de Inicio de intervencio en el proyecto:</label>
                                <input type="date" name="FechaInicio" class="form-control input" required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="FechaFinalizacion">Fecha de Fin de intervencion en el proyecto:</label>
                                <input type="date" name="FechaFinalizacion" class="form-control input" required>
                            </div>
                        </div>
                    </div>





                    <button type="submit" class="button">Asignar Proyecto</button>
                </form>
            </div>
        </div>








    </section>
    <link rel="stylesheet" href="https://cdn.ckeditor.com/4.16.1/standard/ckeditor.css">
    <script src="https://cdn.ckeditor.com/4.16.1/standard/ckeditor.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>



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
        $(document).ready(function() {
            $('#estudiante_id').select2({
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
                    '<span><input type="checkbox" class="checkbox-item"  style="margin-right: 8px;" />' + state
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
    </script>






@endsection
