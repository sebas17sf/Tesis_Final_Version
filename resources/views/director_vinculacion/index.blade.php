@extends('layouts.directorVinculacion')
@section('title', 'Panel Proyectos')

@section('title_component', 'Panel Proyectos')
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



    <section class="contenedor_registro_genero">
        <hr>
        <div class="mat-elevation-z8 contenedor_general">
            <div class="contenedor_acciones_tabla sidebar_active_content_acciones_tabla">
                <div class="contenedor_botones">
                    <form method="POST" action="{{ route('reporte.director') }}"
                        class="form-inline d-flex align-items-center">
                        @csrf
                        <div class="tooltip-container">

                            <button type="submit" class="button1 btn_excel efects_button">
                                <i class="fas fa-file-excel"></i> Historial Director
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
        <h4><b>Historial Proyectos como Director</b></h4>


        <div class="mat-elevation-z8 contenedor_general">

            <div class="contenedor_tabla">
                <div class="table-container mat-elevation-z8">

                    <div id="tablaDocentes">
                        <table class="mat-mdc-table">
                            <thead class="ng-star-inserted">
                                <tr class="mat-mdc-header-row mdc-data-table__header-row cdk-header-row ng-star-inserted">
                                    <th>N°</th>
                                    <th class="tamanio"> NOMBRE DE PROYECTO</th>
                                    <th class="tamanio3">CÓDIGO DE PROYECTO</th>
                                    <th class="tamanio4">DIRECTOR</th>
                                    <th class="tamanio2">DEPARTAMENTO DIRECTOR</th>
                                    <th class="tamanio4">DOCENTE PARTICIPANTE</th>
                                    <th class="tamanio2">DEPARTAMENTO PARTICIPANTE</th>
                                    <th class="tamanio2">ESTUDIANTE</th>
                                    <th class="tamanio2">PERIODO VINCULACION</th>
                                    <th class="tamanio2">CARRERA</th>
                                    <th class="tamanio2">NOTA</th>



                                    <th>FECHA INICIO</th>
                                    <th>FECHA FIN</th>
                                </tr>
                            </thead>
                            <tbody class="mdc-data-table__content ng-star-inserted">
                                @foreach ($asignacionesProyectos as $asignaciones)
                                    <tr class="mat-mdc-row mdc-data-table__row ng-star-inserted">
                                        <td>{{ $loop->iteration }}</td>
                                        <td class="tamanio">{{ $asignaciones->proyecto->nombreProyecto }}</td>
                                        <td class="tamanio3">{{ $asignaciones->proyecto->codigoProyecto }}</td>
                                        <td class="tamanio4">{{ $asignaciones->proyecto->director->nombres }}
                                            {{ $asignaciones->proyecto->director->apellidos }}</td>
                                        <td class="tamanio2">{{ $asignaciones->proyecto->departamentoTutor }}</td>
                                        <td class="tamanio4">{{ $asignaciones->docenteParticipante->nombres }}
                                            {{ $asignaciones->docenteParticipante->apellidos }}</td>
                                        <td class="tamanio2">{{ $asignaciones->docenteParticipante->departamento }}</td>
                                        <td class="tamanio2">{{ $asignaciones->estudiante->nombres }}
                                            {{ $asignaciones->estudiante->apellidos }}</td>
                                        <td>{{ $asignaciones->periodo->numeroPeriodo }}</td>
                                        <td>{{ $asignaciones->estudiante->carrera}}</td>
                                        <td>{{ $asignaciones->estudiante->notas->notaFinal ?? "AUN NO TIENE NOTA"}}</td>
                                        <td>{{ $asignaciones->inicioFecha }}</td>
                                        <td>{{ $asignaciones->finalizacionFecha }}</td>


                                    </tr>
                                @endforeach

                            </tbody>
                        </table>

                    </div>
                </div>


            </div>
        </div>


        <br>

        <div class="mat-elevation-z8 contenedor_general">

            <h4><b>Historial Proyectos como Participante</b></h4>
            <hr>
            <div class="contenedor_tabla">
                <div class="table-container mat-elevation-z8">

                    <div id="tablaDocentes">



                        <table class="mat-mdc-table">
                            <thead class="ng-star-inserted">
                                <tr class="mat-mdc-header-row mdc-data-table__header-row cdk-header-row ng-star-inserted">
                                    <th class="tamanio">NOMBRE DEL PROYECTO</th>
                                    <th>DIRECTOR</th>
                                    <th class="tamanio">ACTIVIDADES A REALIZAR</th>
                                    <th>CORREO</th>
                                    <th class="tamanio2">DEPARTAMENTO</th>
                                    <th>FECHA INICIO</th>
                                    <th>FECHA FIN</th>
                                    <th>CUPOS</th>
                                    <th>ESTADO DEL PROYECTO</th>
                                </tr>
                            </thead>
                            <tbody class="mdc-data-table__content ng-star-inserted">

                            </tbody>
                        </table>


                    </div>
                </div>



            </div>

        </div>


    </section>

    <link rel="stylesheet" href="https://cdn.ckeditor.com/4.16.1/standard/ckeditor.css">
    <script src="https://cdn.ckeditor.com/4.16.1/standard/ckeditor.js"></script>
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

        .contenedor_general .contenedor_tabla {
            min-height: 1px !important;
        }

        .table-container {
            height: 275px !important;
        }
    </style>
@endsection
