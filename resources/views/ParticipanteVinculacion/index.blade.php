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
                <span class="tooltip-text">Historial Director</span>
                <button type="submit" class="button3 efects_button btn_excel" id="submitButton">
                    <span id="loadingIcon" style="display: none !important; ">
                        <img src="gif/load2.gif" alt="Loading" style="height: 20px;">
                    </span>
                    <i class="fa-solid fa-file-excel" id="excelIcon"></i>
                </button>
            </div>
        </form>

        <form method="POST" action="{{ route('reporte.historicoParticipante') }}"
            class="form-inline d-flex align-items-center">
            @csrf
             <div class="tooltip-container">
                <span class="tooltip-text">Historial participante</span>
                <button type="submit" class="button3 efects_button btn_excel" id="submitButton">
                    <span id="loadingIcon" style="display: none !important; ">
                        <img src="gif/load2.gif" alt="Loading" style="height: 20px;">
                    </span>
                    <i class="fa-solid fa-file-excel" id="excelIcon"></i>
                </button>
            </div>
        </form>
</div>
</div>
</div>
<br>

       
        <div class="contenedor_tabla">
                    <div class="table-container mat-elevation-z8">

                        <div id="tablaproyectos">
                            <table class="mat-mdc-table">
                                <thead class="ng-star-inserted">
                                    <tr
                                        class="mat-mdc-header-row mdc-data-table__header-row cdk-header-row ng-star-inserted">
                                        <th class="tamanio">NOMBRE DEL PROYECTO</th>
                                        <th class="tamanio4">DIRECTOR</th>
                                <th class="tamanio">ACTIVIDADES A REALIZAR</th>
                                <th>CORREO TUTOR</th>
                                <th class="tamanio2">DEPARTAMENTO</th>
                                <th>FECHA INICIO</th>
                                <th>FECHA FIN</th>
                                <th>ESTADO</th>
                            </tr>
                        </thead>
                        <tbody class="mdc-data-table__content ng-star-inserted">
                        @if ($proyectosEnEjecucion && $proyectosEnEjecucion->isNotEmpty())
                        <tr style="text-align:center">
                                            <td class="noExisteRegistro1" style="font-size: 16px !important;"colspan="10">
                                                No hay estudiantes en proceso de revisión.</td>
                                        </tr>
                                    @else
                            @foreach ($proyectosEnEjecucion as $proyecto)
                                <tr>
                                    <td style=" text-transform: uppercase; word-wrap: break-word; text-align: justify;">
                                        {{ $proyecto->proyecto->nombreProyecto }}</td>
                                    <td style=" text-transform: uppercase; word-wrap: break-word; text-align: left;">
                                        {{ strtoupper($proyecto->proyecto->director->apellidos ?? 'No asignado') }}
                                        {{ strtoupper($proyecto->proyecto->director->nombres ?? 'No asignado') }}</td>
                                    <td style=" text-transform: uppercase; word-wrap: break-word; text-align: justify;">
                                        {{ $proyecto->proyecto->descripcionProyecto }}</td>
                                    <td>{{ $proyecto->docenteParticipante->correo }}</td>
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
                
        @endif
    </div>

    <br>


    </div>

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
