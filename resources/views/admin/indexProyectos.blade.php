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


    <div class="container" style="overflow-x: auto;">
        <h6><b>Listado de Proyectos</b></h6>
<hr>

        



        <br><br>
        <div class="mat-elevation-z8 contenedor_general">
                    <div class="contenedor_acciones_tabla sidebar_active_content_acciones_tabla">
                        <!-- Botones -->
                        <div class="contenedor_botones">
                        <div class="form-group">
                        <a href="{{ route('admin.agregarProyecto') }}" class="btn btn_nuevo3" id="button3">
        <i class="fa-solid fa-plus"></i> Proyecto
        </a>
        </div>
        
            
           
            <div class="form-group">
                        <form method="POST" action="{{ route('coordinador.reportesProyectos') }}">
        @csrf
        <div class="form-inline">
            <div class="form-group mr-2">
                <label for="estado" class="mr-2">Estado del Proyecto:</label>
                <select name="estado" id="estado" class="form-control input input-select">
                    <option value="">Todos</option>
                    <option value="Ejecucion">En Ejecución</option>
                    <option value="Terminado">Terminado</option>
                </select>
            </div>
            <button type="submit" class="button3 efects_button btn_excel" pTooltip="Excel"
                                    tooltipPosition="top">
                                    <i class="fa-solid fa-file-excel"></i>
                                </button>
        </div>
    </form>
    </div>
    </div>
    <div class="form-group">
     
    <div class="contenedor_buscador">
            <div>
                <form id="formBusquedaProyectos" class="d-flex">
                <input type="text" class="input" name="search" value="{{ $search }}"
                                        matInput placeholder="Buscar proyectos...">
                                    
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
                            <th>Nombre del director del proyecto</th>
                            <th>Nombres Docentes participantes</th>
                            <th>Nombre del proyecto</th>
                            <th>Descripción</th>
                            <th>Correo del director</th>
                            <th>Correos de Docentes participantes</th>
                            <th>Departamento del director</th>
                            <th>Código del Proyecto Social</th>
                            <th>NRC</th>
                            <th>Periodo</th>
                            <th>Fecha de inicio</th>
                            <th>Fecha de finalización</th>
                            <th>Cupos</th>
                            <th>Estado del proyecto</th>
                            <th>Acciones</th>
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
                                <td>{{ strtoupper($proyecto->director->Apellidos) }}
                                    {{ strtoupper($proyecto->director->Nombres) }}</td>
                                <td>
                                    {{ strtoupper($proyecto->docenteParticipante->Apellidos) }}
                                    {{ strtoupper($proyecto->docenteParticipante->Nombres) }}
                                    @foreach ($proyecto->participantesAdicionales as $participanteAdicional)
                                        <br>
                                        {{ strtoupper($participanteAdicional->Apellidos) }}
                                        {{ strtoupper($participanteAdicional->Nombres) }}
                                    @endforeach
                                </td>
                                <td style="word-wrap: break-word; text-align: justify;">
                                    {{ strtoupper($proyecto->NombreProyecto) }}</td>
                                <td>{{ strtoupper($proyecto->DescripcionProyecto) }}</td>
                                <td>{{ strtoupper($proyecto->director->Correo) }}</td>
                                <td>
                                    {{ strtoupper($proyecto->docenteParticipante->Correo) }}
                                    @foreach ($proyecto->participantesAdicionales as $participanteAdicional)
                                        <br>
                                        {{ strtoupper($participanteAdicional->Correo) }}
                                    @endforeach
                                </td>
                                <td>{{ strtoupper($proyecto->DepartamentoTutor) }}</td>
                                <td>
                                    @if (empty($proyecto->codigoProyecto))
                                        {{ strtoupper('No requiere código de proyecto') }}
                                    @else
                                        {{ strtoupper($proyecto->codigoProyecto) }}
                                    @endif
                                </td>
                                <td>{{ strtoupper($proyecto->nrcs->nrc) }}</td>
                                <td>{{ strtoupper($proyecto->nrcs->periodo->numeroPeriodo) }}</td>
                                <td>{{ strtoupper($proyecto->FechaInicio) }}</td>
                                <td>{{ strtoupper($proyecto->FechaFinalizacion) }}</td>
                                <td>{{ strtoupper($proyecto->cupos) }}</td>
                                <td>{{ strtoupper($proyecto->Estado) }}</td>
                                <td>
                                <div class="contenedor_botones">
                                                            <div class="btn-group  shadow-0">
                                                           
                                    <a href="{{ route('admin.editarProyecto', ['ProyectoID' => $proyecto->ProyectoID]) }}"
                                    type="button" class="button3 efects_button btn_editar3">
                                        <i class="bx bx-edit-alt"></i>
                                    </a>
                                    <form class="btn-group shadow-1"
                                        action="{{ route('admin.deleteProyecto', ['ProyectoID' => $proyecto->ProyectoID]) }}"
                                        method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="button3 efects_button btn_eliminar3"
                                            onclick="return confirm('¿Estás seguro de eliminar este proyecto?')">
                                            <i class="bx bx-trash"></i>
                                        </button>
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
            <select class="form-control page-item" class="input" name="perPage"
                                                id="perPage" onchange="this.form.submit()">
                        <option value="10" @if ($perPage == 10) selected @endif>10</option>
                        <option value="20" @if ($perPage == 20) selected @endif>20</option>
                        <option value="50" @if ($perPage == 50) selected @endif>50</option>
                        <option value="100" @if ($perPage == 100) selected @endif>100</option>
                    </select>
            </form>
            </li>
                @if ($proyectos->onFirstPage())
                    <li class="page-item disabled">
                        <span class="page-link">Anterior</span>
                    </li>
                @else
                    <li class="page-item">
                        <a class="page-link" href="{{ $proyectos->previousPageUrl() }}" aria-label="Anterior">Anterior</a>
                    </li>
                @endif

                @for ($i = 1; $i <= $proyectos->lastPage(); $i++)
                    <li class="page-item {{ $proyectos->currentPage() == $i ? 'active' : '' }}">
                        <a class="page-link" href="{{ $proyectos->url($i) }}">{{ $i }}</a>
                    </li>
                @endfor

                @if ($proyectos->hasMorePages())
                    <li class="page-item">
                        <a class="page-link" href="{{ $proyectos->nextPageUrl() }}" aria-label="Siguiente">Siguiente</a>
                    </li>
                @else
                    <li class="page-item disabled">
                        <span class="page-link">Siguiente</span>
                    </li>
                @endif
            </ul>
        </div>

    </div>

    
    </div>
</div>

    <hr>

    <div class="container">
        <button id="toggleFormBtn3" class="btn btn-outline-secondary btn-block">Asignar estudiante</button>
        <div id="asignarEstudiante" style="display: none;">

            <HR>
            <h6><b>Asignar Proyecto</b></h6>
            <hr>
            <form method="POST" action="{{ route('admin.guardarAsignacion') }}">
                @csrf

                <div class="form-group">
                    <label for="proyecto_id"><strong>Proyecto Disponible:</strong></label>
                    <select name="proyecto_id" id="proyecto_id" class="form-control input input-select">
                        <option value="">Seleccione un proyecto</option>
                        @foreach ($proyectosDisponibles as $proyecto)
                            @if ($proyecto->cupos > 0)
                                <option value="{{ $proyecto->ProyectoID }}">
                                    {{ $proyecto->director->Apellidos }} {{ $proyecto->director->Nombres }} -
                                    Cupos disponibles: {{ $proyecto->cupos }} -
                                    {{ $proyecto->DepartamentoTutor }}
                                </option>
                            @endif
                        @endforeach
                    </select>
                </div>




                <div class="form-group">
                    <label for="estudiante_id"><strong> Estudiante Aprobado:</strong></label>
                    <select name="estudiante_id" id="estudiante_id" class="form-control input input-select">
                        <option value="">Seleccione un estudiante</option>
                        @foreach ($estudiantesAprobados as $estudiante)
                            <option value="{{ $estudiante->EstudianteID }}">
                                {{ $estudiante->Nombres }} {{ $estudiante->Apellidos }} -
                                {{ $estudiante->Departamento }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="fecha_asignacion"><strong>Fecha de Asignación:</strong></label>
                    <input type="date" name="fecha_asignacion" id="fecha_asignacion" class="form-control input"
                        value="{{ now()->toDateString() }}">
                </div>

                <button type="submit" class="btn btn-secondary">Asignar Proyecto</button>
            </form>
        </div>

    </div>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdn.ckeditor.com/4.16.1/standard/ckeditor.css">
    <script src="https://cdn.ckeditor.com/4.16.1/standard/ckeditor.js"></script>

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



@endsection



<style>
    table {
        width: 100%;
        border-collapse: collapse;
    }

    table,
    th,
    td {
        font-size: 14px;
    }

    th,
    td {
        padding: 8px 12px;
        text-align: left;
        border: 1px solid #ddd;
        white-space: nowrap;
        /* Evita el salto de línea */
        overflow: hidden;
        text-overflow: ellipsis;
        /* Agrega puntos suspensivos si el contenido es demasiado largo */
    }

    th {
        background-color: #f2f2f2;
    }

    body,
    input,
    select,
    th,
    td,
    label,
    button,
    table {
        background-color: #F5F5F5;
        font-family: Arial, sans-serif;
        font-size: 14px;
        line-height: 1.5;

    }
</style>
