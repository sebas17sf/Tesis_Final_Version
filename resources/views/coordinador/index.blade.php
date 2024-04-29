@extends('layouts.coordinador')

@section('title', 'Proyectos')

@section('title_component', 'Listado de proyectos')

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


        <a href="{{ route('coordinador.agregarProyecto') }}" class="btn btn-outline-secondary btn-sm">
            <i class="material-icons">add</i> Proyecto
        </a>

        <br><br>

        <div class="d-flex">
            

            <div  class="contenedor_acciones_tabla" <div class="contenedor_botones">
            <form method="POST" action="{{ route('coordinador.reportesProyectos') }}">
            @csrf
            <button type="submit" class="btn btn-sm btn-secondary">
                <i class="fas fa-file-excel"></i> Generar Reporte
            </button>
        </form>
                <form action="{{ route('coordinador.index') }}" method="GET" class="d-flex">
                    <input type="text" name="search" value="{{ $search }}" class="input"
                        placeholder="Buscar proyectos...">
                    <button type="submit" class="button">Buscar</button>
                </form>
            </div>
        </div>


        <div id="tablaProyectos">
            @if ($proyectos->isEmpty())
                <p>No se encontraron resultados para la busqueda</p>
            @else
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Nombre del docente director de proyecto</th>
                            <th>Nombre del docente participante de proyecto</th>
                            <th>Nombre del proyecto</th>
                            <th>Descripción</th>
                            <th>Correo del tutor</th>
                            <th>Correo del profesor participante</th>
                            <th>Departamento</th>
                            <th>Código del Proyecto Social</th>
                            <th>NRC</th>
                            <th>Periodo</th>
                            <th>Fecha de inicio</th>
                            <th>Fecha fin</th>
                            <th>Cupos</th>
                            <th>Estado del proyecto</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($proyectos as $proyecto)
                            <tr>
                                <td>{{ strtoupper($proyecto->director->Apellidos) }}
                                    {{ strtoupper($proyecto->director->Nombres) }}
                                </td>
                                <td>{{ strtoupper($proyecto->docenteParticipante->Apellidos) }}
                                    {{ strtoupper($proyecto->docenteParticipante->Nombres) }}</td>
                                <td>{{ strtoupper($proyecto->NombreProyecto) }}</td>
                                <td>{{ strtoupper($proyecto->DescripcionProyecto) }}</td>
                                <td>{{ strtoupper($proyecto->director->Correo) }}</td>
                                <td>{{ strtoupper($proyecto->docenteParticipante->Correo) }}</td>
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
                                    <a href="{{ route('coordinador.editarProyecto', ['ProyectoID' => $proyecto->ProyectoID]) }}"
                                        class="btn btn-outline-secondary btn-block">
                                        <i class="material-icons">edit</i>
                                    </a>
                                    <form
                                        action="{{ route('coordinador.deleteProyecto', ['ProyectoID' => $proyecto->ProyectoID]) }}"
                                        method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-secondary btn-block"
                                            onclick="return confirm('¿Estás seguro de eliminar este proyecto?')">
                                            <i class="material-icons">delete</i>
                                        </button>
                                    </form>
                                    <a href="{{ route('coordinador.descargarEvidencias', ['ProyectoID' => $proyecto->ProyectoID]) }}"
                                        class="btn btn-outline-secondary btn-block">
                                        <i class="material-icons">download</i>
                                    </a>
                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>


        <div class="d-flex justify-content-center paginator-container">
            <ul class="pagination">
            <form method="GET" action="{{ route('coordinador.index') }}">
                <select class="input paginator-container" name="perPage" id="perPage" onchange="this.form.submit()">
                    <option value="10" @if ($perPage == 10) selected @endif>10</option>
                    <option value="20" @if ($perPage == 20) selected @endif>20</option>
                    <option value="50" @if ($perPage == 50) selected @endif>50</option>
                    <option value="100" @if ($perPage == 100) selected @endif>100</option>
                </select>
            </form>
            <br>
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

    <hr>

    <div class="container">
        <button id="toggleFormBtn" class="btn btn-outline-secondary btn-block">Asignar estudiante</button>
        <div id="asignarEstudiante" style="display: none;">

            <hr>
            <h4>Asignar Proyecto</h4>
            <form method="POST" action="{{ route('coordinador.guardarAsignacion') }}">
                @csrf

                <div class="form-group">
                    <label for="proyecto_id">Proyecto Disponible:</label>
                    <select name="proyecto_id" id="proyecto_id" class="form-control">
                        @foreach ($proyectosDisponibles as $proyecto)
                            @if ($proyecto->cupos > 0)
                                <option value="{{ $proyecto->ProyectoID }}">
                                    <div>{{ $proyecto->director->Apellidos }} {{ $proyecto->director->Nombres }} -
                                        {{ $proyecto->NombreProyecto }} - Cupos disponibles: {{ $proyecto->cupos }} -
                                        {{ $proyecto->DepartamentoTutor }}</div>
                                </option>
                            @endif
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="estudiante_id">Estudiante Aprobado:</label>
                    <select name="estudiante_id" id="estudiante_id" class="form-control">
                        @foreach ($estudiantesAprobados as $estudiante)
                            <option value="{{ $estudiante->EstudianteID }}">
                                {{ $estudiante->Nombres }} {{ $estudiante->Apellidos }} -
                                {{ $estudiante->Departamento }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="fecha_asignacion">Fecha de Asignación:</label>
                    <input type="date" name="fecha_asignacion" id="fecha_asignacion" class="form-control"
                        value="{{ now()->toDateString() }}">
                </div>

                <button type="submit" class="btn btn-secondary">Asignar Proyecto</button>
            </form>
        </div>

    </div>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdn.ckeditor.com/4.16.1/standard/ckeditor.css">
    <script src="https://cdn.ckeditor.com/4.16.1/standard/ckeditor.js"></script>
    <script>
        $(document).ready(function() {
            // Manejar el clic en el botón para mostrar/ocultar el formulario
            $("#toggleFormBtn").click(function() {
                $("#asignarEstudiante").toggle();
                // Cambiar el texto del botón según si el formulario está visible u oculto
                if ($("#asignarEstudiante").is(":visible")) {
                    $(this).text("Ocultar Asignar Estudiante");
                } else {
                    $(this).text("Asignar estudiante");
                }
            });
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
