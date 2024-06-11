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
                                <th class="tamanio">NOMBRE DEL PROYECTO</th>
                                <th>DIRECTOR</th>
                                <th class="tamanio">ACTIVIDADES A REALIZAR</th>
                                <th>CORREO TUTOR</th>
                                <th>DEPARTAMENTO</th>
                                <th>FECHA INICIO</th>
                                <th>FECHA FIN</th>
                                <th>ESTADO</th>
                            </tr>
                        </thead>
                        <tbody class="mdc-data-table__content ng-star-inserted">
                            @foreach ($proyectosEnEjecucion as $proyecto)
                                <tr>
                                    <td style=" text-transform: uppercase; word-wrap: break-word; text-align: justify;">{{ $proyecto->proyecto->nombreProyecto }}</td>
                                    <td style=" text-transform: uppercase; word-wrap: break-word; text-align: left;">{{ strtoupper($proyecto->proyecto->director->apellidos ?? "No asignado") }}
                                        {{ strtoupper($proyecto->proyecto->director->nombres ?? "No asignado") }}</td>
                                    <td style=" text-transform: uppercase; word-wrap: break-word; text-align: justify;">{{ $proyecto->proyecto->descripcionProyecto }}</td>
                                    <td>{{ $proyecto->docenteParticipante->correo }}</td>
                                    <td style=" text-transform: uppercase; word-wrap: break-word; text-align: justify;">{{ $proyecto->proyecto->departamentoTutor }}</td>
                                    <td style=" text-transform: uppercase; word-wrap: break-word; text-align: center;">{{ $proyecto->inicioFecha }}</td>
                                    <td style=" text-transform: uppercase; word-wrap: break-word; text-align: center;">{{ $proyecto->finalizacionFecha }}</td>
                                     <td style=" text-transform: uppercase; word-wrap: break-word; text-align: center;">{{ $proyecto->proyecto->estado }}</td>
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
