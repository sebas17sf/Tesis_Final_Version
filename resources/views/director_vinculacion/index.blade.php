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

 
    <div class="container" style="overflow-x: auto;">
        @if ($proyectosEjecucion->isNotEmpty())
            <h4>Proyecto en Ejecución</h4>

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Nombre del proyecto</th>
                        <th>Director</th>
                        <th>Actividades a realizar</th>
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
                <tbody>
                    @foreach ($proyectosEjecucion as $proyecto)
                        <tr>
                            <td>{{ $proyecto->NombreProyecto }}</td>
                            <td>{{ strtoupper($proyecto->director->Apellidos) }}
                                {{ strtoupper($proyecto->director->Nombres) }}</td>
                            <td>{{ $proyecto->DescripcionProyecto }}</td>
                            <td>
                                {{ strtoupper($proyecto->docenteParticipante->Apellidos) }}
                                {{ strtoupper($proyecto->docenteParticipante->Nombres) }}
                                @foreach($proyecto->participantesAdicionales as $participanteAdicional)
                                    <br>
                                    {{ strtoupper($participanteAdicional->Apellidos) }}
                                    {{ strtoupper($participanteAdicional->Nombres) }}
                                @endforeach
                            </td>
                            <td>{{ $proyecto->director->Correo }}</td>
                            <td>
                                {{ $proyecto->docenteParticipante->Correo }}
                                @foreach($proyecto->participantesAdicionales as $participanteAdicional)
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
                </tbody>
            </table>
        @else
            <p>No hay proyectos en ejecución.</p>
        @endif

        @if ($proyectosTerminados->isNotEmpty())
            <h4>Proyectos Terminados</h4>
            <form method="GET" action="{{ route('director_vinculacion.index') }}">
                <label for="elementosPorPaginaTerminados">Elementos por página:</label>
                <select name="elementosPorPaginaTerminados" onchange="this.form.submit()">
                    <option value="10" {{ $elementosPorPaginaTerminados == 10 ? 'selected' : '' }}>10</option>
                    <option value="20" {{ $elementosPorPaginaTerminados == 20 ? 'selected' : '' }}>20</option>
                    <option value="50" {{ $elementosPorPaginaTerminados == 50 ? 'selected' : '' }}>50</option>
                    <option value="100" {{ $elementosPorPaginaTerminados == 100 ? 'selected' : '' }}>100</option>
                </select>
            </form>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Nombre del proyecto</th>
                        <th>Director</th>
                        <th>Actividades a realizar</th>
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
                <tbody>
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

        @else
            <p>No hay proyectos terminados.</p>
        @endif



    </div>
@endsection
<style>
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
</style>
