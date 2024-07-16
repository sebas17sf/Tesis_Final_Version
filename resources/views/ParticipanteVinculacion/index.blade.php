@extends('layouts.participante')
@section('title_component', 'Lista de Proyectos')

@section('title', 'Proyectos')
@section('content')
    @if (session('success'))
        <div class="contenedor_alerta success">
            <div class="icon_alert"><i class="fa-regular fa-circle-check fa-beat"></i></div>
            <div class="content_alert">
                <div class="title">Éxito!</div>
                <div class="body">{{ session('success') }}</div>
            </div>
        </div>
    @endif


    @if (session('error'))
        <div class="contenedor_alerta error">
            <div class="icon_alert"><i class="fa-regular fa-circle-x fa-beat"></i></div>
            <div class="content_alert">
                <div class="title">Error!</div>
                <div class="body">{{ session('error') }}</div>
            </div>
        </div>
    @endif

    <div class="container" style="overflow-x: auto;">
        <br>
        <h4><b>Proyecto en Ejecución</b></h4>
        <div class="mat-elevation-z8 contenedor_general">
            <div class="contenedor_acciones_tabla sidebar_active_content_acciones_tabla">
                <!-- Botones -->
                <div class="contenedor_botones">
                   <form method="POST" action="{{ route('reporte.director') }}"
                        class="form-inline d-flex align-items-center">
                        @csrf
                        <div class="tooltip-container">
                          
                            <button type="submit" class="button1 btn_excel efects_button">
                                <i class="fas fa-file-excel"></i>  Historial Director
                            </button>
                        </div>
                    </form>

                    <form method="POST" action="{{ route('reporte.historicoParticipante') }}"
                        class="form-inline d-flex align-items-center">
                        @csrf
                        <div class="tooltip-container">
                            
                            <button type="submit" class="button1 btn_excel efects_button">
                                <i class="fas fa-file-excel"></i> Historial participante
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <br>


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
                                <th class="tamanio2">DEPARTAMENTO</th>
                                <th>FECHA INICIO INTERVENCIÓN</th>
                                <th>FECHA FIN INTERVENCIÓN</th>
                                <th>ESTADO</th>
                            </tr>
                        </thead>
                        <tbody class="mdc-data-table__content ng-star-inserted">

                            @foreach ($proyectosEnEjecucion as $proyecto)
                                <tr>
                                    <td style=" text-transform: uppercase; word-wrap: break-word; text-align: justify;">
                                        {{ $proyecto->proyecto->nombreProyecto }}</td>
                                    <td style=" text-transform: uppercase; word-wrap: break-word; text-align: left;">
                                        {{ strtoupper($proyecto->proyecto->director->apellidos ?? 'No asignado') }}
                                        {{ strtoupper($proyecto->proyecto->director->nombres ?? 'No asignado') }}</td>
                                    <td style=" text-transform: uppercase; word-wrap: break-word; text-align: justify;">
                                        {{ $proyecto->proyecto->descripcionProyecto }}</td>
                                    <td>{{ $proyecto->proyecto->director->correo }}</td>
                                    <td style=" text-transform: uppercase; word-wrap: break-word; text-align: left;">
                                        {{ $proyecto->proyecto->departamentoTutor }}</td>
                                    <td style=" text-transform: uppercase; word-wrap: break-word; text-align: center;">
                                        {{ $proyecto->inicioFecha }}</td>
                                    <td style=" text-transform: uppercase; word-wrap: break-word; text-align: center;">
                                        {{ $proyecto->finalizacionFecha }}</td>
                                    <td style=" text-transform: uppercase; word-wrap: break-word; text-align: center;">
                                        {{ $proyecto->proyecto->estado }}</td>
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

    <script src="{{ asset('js/plantilla/main.js') }}" type="module"></script>
    <script src="js\admin\acciones.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.13.0/jquery-ui.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.js"></script>
    <style>
        .contenedor_tabla .table-container table td {
            width: 200px;
            min-width: 150px;
            font-size: 11px !important;
            padding: .5rem !important;
        }

        .contenedor_tabla .table-container table th {
            position: sticky;
            font-size: .8em !important;
    </style>

@endsection
