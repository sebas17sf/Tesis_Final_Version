@extends('layouts.participante')

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

        <h4>Proyecto en Ejecución</h4>

        @if ($proyectosEnEjecucion->isNotEmpty())
            <div class="contenedor_tabla">
                <div class="table-container mat-elevation-z8">

                    <table class="mat-mdc-table">
                        <thead class="ng-star-inserted">
                            <tr class="mat-mdc-header-row mdc-data-table__header-row cdk-header-row ng-star-inserted">
                                <th>Nombre del proyecto</th>
                                <th>Director</th>
                                <th>Actividades a realizar</th>
                                <th>Correo del tutor</th>
                                <th>Departamento</th>
                                <th>Fecha de inicio</th>
                                <th>Fecha fin</th>
                                <th>Cupos</th>
                                <th>Estado del proyecto</th>
                            </tr>
                        </thead>
                        <tbody class="mdc-data-table__content ng-star-inserted">
                            @foreach ($proyectosEnEjecucion as $proyecto)
                                <tr>
                                    <td>{{ $proyecto->NombreProyecto }}</td>
                                    <td>{{ strtoupper($proyecto->director->Apellidos) }}
                                        {{ strtoupper($proyecto->director->Nombres) }}</td>
                                    <td>{{ $proyecto->DescripcionProyecto }}</td>
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
                @else
                    <p>No hay proyectos en ejecución.</p>
        @endif
    </div>
    </div>

    <h4>Proyectos Terminados</h4>
    <form method="GET" action="{{ route('ParticipanteVinculacion.index') }}">
        <label for="elementosPorPagina2">Elementos por página:</label>
        <select name="elementosPorPagina2" onchange="this.form.submit()">
            <option value="10" {{ request('elementosPorPagina2') == 10 ? 'selected' : '' }}>10</option>
            <option value="20" {{ request('elementosPorPagina2') == 20 ? 'selected' : '' }}>20</option>
            <option value="50" {{ request('elementosPorPagina2') == 50 ? 'selected' : '' }}>50</option>
            <option value="100" {{ request('elementosPorPagina2') == 100 ? 'selected' : '' }}>100</option>
        </select>
    </form>



    @if ($proyectosTerminados->isNotEmpty())
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nombre del proyecto</th>
                    <th>Director</th>
                    <th>Actividades realizadas</th>
                    <th>Correo del tutor</th>
                    <th>Departamento</th>
                    <th>Fecha de inicio</th>
                    <th>Fecha fin</th>
                    <th>Estado del proyecto</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($proyectosTerminados as $proyecto)
                    <tr>
                        <td>{{ $proyecto->NombreProyecto }}</td>
                        <td>{{ strtoupper($proyecto->director->Apellidos) }}
                            {{ strtoupper($proyecto->director->Nombres) }}</td>
                        <td>{{ $proyecto->DescripcionProyecto }}</td>

                        <td>{{ $proyecto->docenteParticipante->Correo }}</td>
                        <td>{{ $proyecto->DepartamentoTutor }}</td>
                        <td>{{ $proyecto->FechaInicio }}</td>
                        <td>{{ $proyecto->FechaFinalizacion }}</td>
                        <td>{{ $proyecto->Estado }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $proyectosTerminados->links('vendor.pagination.proyectosTerminados') }}
    @else
        <p>No hay proyectos terminados.</p>
    @endif

    </div>




@endsection
