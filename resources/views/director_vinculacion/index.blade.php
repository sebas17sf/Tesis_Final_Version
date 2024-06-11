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


            <h4><b>Proyecto en Ejecución</b></h4>
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
                                        <th class="tamanio">NOMBRE DEL PROYECTO</th>
                                        <th class="tamanio1">DIRECTOR</th>
                                        <th class="tamanio">ACTIVIDADES A REALIZAR</th>
                                        <th>CORREO</th>
                                        <th>DEPARTAMENTO</th>
                                        <th>FECHA INICIO</th>
                                        <th>FECHA FIN</th>
                                        <th>PERIODO</th>
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
                                                <td style=" text-transform: uppercase; word-wrap: break-word; text-align: justify;">
                                                    {{ strtoupper($proyecto->nombreProyecto) }}</td>
                                                <td style=" text-transform: uppercase; word-wrap: break-word; text-align: left;">{{ strtoupper($proyecto->director->apellidos) }}
                                                    {{ strtoupper($proyecto->director->nombres) }}</td>
                                                <td style=" text-transform: uppercase; word-wrap: break-word; text-align: justify;">
                                                    {{ $proyecto->descripcionProyecto }}</td>

                                                <td >{{ $proyecto->director->correo }}</td>

                                                <td style=" text-transform: uppercase; word-wrap: break-word; text-align: left;">{{ $proyecto->departamentoTutor }}</td>
                                                <td>{{ optional($proyecto->asignaciones->first())->inicioFecha ?? 'Fecha no disponible' }}</td>
                                                <td>{{ optional($proyecto->asignaciones->first())->finalizacionFecha ?? 'Fecha no disponible' }}</td>
                                                @foreach ($proyecto->asignaciones as $asignacion)
                                                    <td>{{ $asignacion->periodo->numeroPeriodo }}</td>
                                                @endforeach
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


<br>

        <div class="mat-elevation-z8 contenedor_general">
            @if ($proyectosTerminados->isNotEmpty())
                <h4><b>Proyectos Terminados</b></h4>
                <hr>
                <div class="contenedor_tabla">
                    <div class="table-container mat-elevation-z8">

                        <div id="tablaDocentes">



                            <table class="mat-mdc-table">
                                <thead class="ng-star-inserted">
                                    <tr
                                        class="mat-mdc-header-row mdc-data-table__header-row cdk-header-row ng-star-inserted">
                                        <th class="tamanio">NOMBRE DEL PROYECTO</th>
                                        <th>DIRECTOR</th>
                                        <th class="tamanio">ACTIVIDADES A REALIZAR</th>
                                        <th>CORREO</th>
                                        <th>DEPARTAMENTO</th>
                                        <th>FECHA INICIO</th>
                                        <th>FECHA FIN</th>
                                        <th>CUPOS</th>
                                        <th>ESTADO DEL PROYECTO</th>
                                    </tr>
                                </thead>
                                <tbody class="mdc-data-table__content ng-star-inserted">
                                    @foreach ($proyectosTerminados as $proyecto)
                                        <tr >
                                            <td style=" text-transform: uppercase; word-wrap: break-word; text-align: justify; padding: 5px 8px;">{{ $proyecto->NombreProyecto }}</td>
                                            <td style=" text-transform: uppercase;">{{ strtoupper($proyecto->director->Apellidos) }}
                                                {{ strtoupper($proyecto->director->Nombres) }}</td>
                                            <td style=" text-transform: uppercase; word-wrap: break-word; text-align: justify; padding: 5px 8px;">{{ $proyecto->DescripcionProyecto }}</td>
                                            <td>{{ $proyecto->director->Correo }}</td>
                                            <td style=" text-transform: uppercase;">{{ $proyecto->DepartamentoTutor }}</td>
                                            <td>{{ $proyecto->FechaInicio }}</td>
                                            <td>{{ $proyecto->FechaFinalizacion }}</td>
                                            <td>{{ $proyecto->cupos }}</td>
                                            <td>{{ $proyecto->Estado }}</td>
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
                                {{ $proyectosTerminados->links('vendor.pagination.proyectosDirectorVinculacion') }}

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
