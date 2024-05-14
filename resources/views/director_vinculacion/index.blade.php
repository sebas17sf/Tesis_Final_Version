@extends('layouts.directorVinculacion')

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


    <section class="contenedor_registro_genero">
        @if ($proyectosEjecucion->isNotEmpty())


            <h6><b>Proyecto en Ejecución</b></h6>
            <hr>

            <div class="mat-elevation-z8 contenedor_general">

                <div class="contenedor_tabla" style="
                min-height: 70px !important;">
                    <div class="table-container mat-elevation-z8">

                        <div id="tablaDocentes">
                            <table class="mat-mdc-table">
                                <thead class="ng-star-inserted">
                                    <tr
                                        class="mat-mdc-header-row mdc-data-table__header-row cdk-header-row ng-star-inserted">
                                        <th class="tamanio">Nombre del proyecto</th>
                                        <th>Director</th>
                                        <th class="tamanio">Actividades a realizar</th>
                                        <th>Nombre del profesor participante</th>
                                        <th>Correo del tutor</th>
                                        <th>Correo del profesor participante</th>
                                        <th>Departamento</th>
                                        <th>Fecha de inicio</th>
                                        <th>Fecha fin</th>
                                        <th>Cupos</th>
                                        <th>Estado del proyecto</th>
                                    </tr>
                                </thead>
                                <tbody class="mdc-data-table__content ng-star-inserted">
                                    @if ($proyectosEjecucion->isEmpty())
                                        <tr class="noExisteRegistro ng-star-inserted" style="text-align:center">

                                            <td colspan="6">No se encontraron resultados para la busqueda</td>
                                        </tr>
                                    @else
                                        @foreach ($proyectosEjecucion as $proyecto)
                                            <tr>
                                                <td style="word-wrap: break-word; text-align: justify;">
                                                    {{ $proyecto->NombreProyecto }}</td>
                                                <td>{{ strtoupper($proyecto->director->Apellidos) }}
                                                    {{ strtoupper($proyecto->director->Nombres) }}</td>
                                                <td style="word-wrap: break-word; text-align: justify;">
                                                    {{ $proyecto->DescripcionProyecto }}</td>
                                                <td>
                                                    {{ strtoupper($proyecto->docenteParticipante->Apellidos) }}
                                                    {{ strtoupper($proyecto->docenteParticipante->Nombres) }}
                                                    @foreach ($proyecto->participantesAdicionales as $participanteAdicional)
                                                        <br>
                                                        {{ strtoupper($participanteAdicional->Apellidos) }}
                                                        {{ strtoupper($participanteAdicional->Nombres) }}
                                                    @endforeach
                                                </td>
                                                <td>{{ $proyecto->director->Correo }}</td>
                                                <td>
                                                    {{ $proyecto->docenteParticipante->Correo }}
                                                    @foreach ($proyecto->participantesAdicionales as $participanteAdicional)
                                                        <br>
                                                        {{ $participanteAdicional->Correo }}
                                                    @endforeach
                                                </td>
                                                <td>{{ $proyecto->DepartamentoTutor }}</td>
                                                <td>{{ $proyecto->FechaInicio }}</td>
                                                <td>{{ $proyecto->FechaFinalizacion }}</td>
                                                <td>{{ $proyecto->cupos }}</td>
                                                <td>{{ $proyecto->Estado }}</td>
                                            </tr>
                                        @endforeach
                                        @endif
                                </tbody>
                            </table>

                        </div>
                    </div>
                    {{--   <div class="paginator-container">
                    <nav aria-label="...">

                        <ul class="pagination">
                            <li class="page-item mx-3">
                                <form method="GET" action="{{ route('director_vinculacion.index') }}">
                                    <select class="form-control page-item" class="input" name="elementosPorPaginaTerminados" id="elementosPorPaginaTerminados"
                                        onchange="this.form.submit()">
                                        <option value="10" {{ $elementosPorPaginaTerminados == 10 ? 'selected' : '' }}>10</option>
                                        <option value="20" {{ $elementosPorPaginaTerminados == 20 ? 'selected' : '' }}>20</option>
                                        <option value="50" {{ $elementosPorPaginaTerminados == 50 ? 'selected' : '' }}>50</option>
                                        <option value="100" {{ $elementosPorPaginaTerminados == 100 ? 'selected' : '' }}>100</option>
                                    </select>
                                </form>              
                            </li>
                         
                        </ul>
                    </nav>
                </div> --}}

                </div>
            </div>
        @else
            <p>No hay proyectos en ejecución.</p>
        @endif
       {{--  </div> --}}


        <div class="mat-elevation-z8 contenedor_general">
            @if ($proyectosTerminados->isNotEmpty())
                <h6><b>Proyectos Terminados</b></h6>
                <div class="contenedor_tabla">
                    <div class="table-container mat-elevation-z8">

                        <div id="tablaDocentes">



                            <table class="mat-mdc-table">
                                <thead class="ng-star-inserted">
                                    <tr
                                        class="mat-mdc-header-row mdc-data-table__header-row cdk-header-row ng-star-inserted">
                                        <th class="tamanio">Nombre del proyecto</th>
                                        <th>Director</th>
                                        <th class="tamanio">Actividades a realizar</th>
                                        <th>Nombre del profesor participante</th>
                                        <th>Correo del tutor</th>
                                        <th>Correo del profesor participante</th>
                                        <th>Departamento</th>
                                        <th>Fecha de inicio</th>
                                        <th>Fecha fin</th>
                                        <th>Cupos</th>
                                        <th>Estado del proyecto</th>
                                    </tr>
                                </thead>
                                <tbody class="mdc-data-table__content ng-star-inserted">
                                    @foreach ($proyectosTerminados as $proyecto)
                                        <tr>
                                            <td>{{ $proyecto->NombreProyecto }}</td>
                                            <td>{{ strtoupper($proyecto->director->Apellidos) }}
                                                {{ strtoupper($proyecto->director->Nombres) }}</td>
                                            <td>{{ $proyecto->DescripcionProyecto }}</td>
                                            <td>{{ strtoupper($proyecto->docenteParticipante->Apellidos) }}
                                                {{ strtoupper($proyecto->docenteParticipante->Nombres) }}</td>
                                            <td>{{ $proyecto->director->Correo }}</td>
                                            <td>{{ $proyecto->docenteParticipante->Correo }}</td>
                                            <td>{{ $proyecto->DepartamentoTutor }}</td>
                                            <td>{{ $proyecto->FechaInicio }}</td>
                                            <td>{{ $proyecto->FechaFinalizacion }}</td>
                                            <td>{{ $proyecto->cupos }}</td>
                                            <td>{{ $proyecto->Estado }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{ $proyectosTerminados->links('vendor.pagination.proyectosDirectorVinculacion') }}


                        </div>
                    </div>
                    <div class="paginator-container">
                        <nav aria-label="...">

                            <ul class="pagination">
                                <li class="page-item mx-3">
                                    <form method="GET" action="{{ route('director_vinculacion.index') }}">
                                        <select class="form-control page-item" class="input"
                                            name="elementosPorPaginaTerminados" id="elementosPorPaginaTerminados"
                                            onchange="this.form.submit()">
                                            <option value="10"
                                                {{ $elementosPorPaginaTerminados == 10 ? 'selected' : '' }}>
                                                10</option>
                                            <option value="20"
                                                {{ $elementosPorPaginaTerminados == 20 ? 'selected' : '' }}>
                                                20</option>
                                            <option value="50"
                                                {{ $elementosPorPaginaTerminados == 50 ? 'selected' : '' }}>
                                                50</option>
                                            <option value="100"
                                                {{ $elementosPorPaginaTerminados == 100 ? 'selected' : '' }}>100</option>
                                        </select>


                                    </form>



                                </li>

                            </ul>
                        </nav>
                    </div>

                </div>
            @else
                <p>No hay proyectos terminados.</p>
            @endif
        </div>


    </section>
@endsection
{{-- <style>
    table {
        width: 100%;
        border-collapse: collapse;
        padding: 4px 8px;

    }

    table,
    th,
    td {
        font-size: 14px;
        padding: 4px 8px;
        border: 1px solid #ddd;

    }

    th {
        border: 1px solid #70a1ff;
        background-color: #eaf5ff;
    }

    .wide-cell {
        max-width: 200px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .body,
    table,
    tr,
    td,
    th {
        font-size: 12px;

    }
</style> --}}
