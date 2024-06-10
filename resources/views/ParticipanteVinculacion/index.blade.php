@extends('layouts.participante')
@section('title_component', 'Lista de Proyectos')

@section('title', 'Proyectos')

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
<br>
        <h4><b>Proyecto en Ejecución</b></h4>
        <hr>

        @if ($proyectosEnEjecucion && $proyectosEnEjecucion->isNotEmpty())
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
                                <th>Estado</th>
                            </tr>
                        </thead>
                        <tbody class="mdc-data-table__content ng-star-inserted">
                            @foreach ($proyectosEnEjecucion as $proyecto)
                                <tr>
                                    <td>{{ $proyecto->proyecto->nombreProyecto }}</td>
                                    <td>{{ strtoupper($proyecto->proyecto->director->apellidos ?? "No asignado") }}
                                        {{ strtoupper($proyecto->proyecto->director->nombres ?? "No asignado") }}</td>
                                    <td>{{ $proyecto->proyecto->descripcionProyecto }}</td>
                                    <td>{{ $proyecto->docenteParticipante->correo }}</td>
                                    <td>{{ $proyecto->proyecto->departamentoTutor }}</td>
                                    <td>{{ $proyecto->inicioFecha }}</td>
                                    <td>{{ $proyecto->finalizacionFecha }}</td>
                                     <td>{{ $proyecto->proyecto->estado }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p>No hay proyectos en ejecución.</p>
        @endif
    </div>

<br>


    </div>




@endsection
