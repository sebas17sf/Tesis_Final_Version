@extends('layouts.app')

@section('title', 'Información del Estudiante')

@section('title_component', 'Información del Estudiante')
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
    <section class="contenedor_agregar_periodo">


        <div class="mt-4">
            <h4><b>
                    <div class="icon-sidebar-item">Estado-Aprobación</div>
                </b></h4>
            <div class="mat-elevation-z8 contenedor_general1">
                <div class="contenedor_acciones_tabla sidebar_active_content_acciones_tabla">
                    <!-- Botones -->
                    <div class="contenedor_botones">
                        <form action="{{ route('estudiantes.certificadoMatricula') }}" method="get" class="mr-2">
                            <div class="tooltip-container">
                                <span class="tooltip-text">Pdf</span>
                                <button type="submit" class="button3_1_1  btn_pdf" tooltipPosition="top">
                                    <i class="fa-solid fa-file-pdf"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                <br>
                <div class="contenedor_tabla">
                    <div class="table-container mat-elevation-z8">

                        <div id="tablaProyectos">
                            <table class="mat-mdc-table">
                                <thead class="ng-star-inserted">
                                    <tr
                                        class="mat-mdc-header-row mdc-data-table__header-row cdk-header-row ng-star-inserted">
                                        <th class="tamanio1 ">VERIFICACIÓN</th>
                                        <th class="tamanio2">REENVIAR</th>
                                </thead>
                                <tbody class="mdc-data-table__content ng-star-inserted">
                                    <tr>
                                        <td style=" text-transform: uppercase; word-wrap: break-word; text-align: center;">
                                            @if ($estudiante->estado == 'Aprobado')
                                                {{ strtoupper('Vinculacion') }}
                                            @elseif ($estudiante->estado == 'Aprobado-practicas')
                                                {{ strtoupper('Practicas') }}
                                            @else
                                                {{ strtoupper($estudiante->estado) }}
                                            @endif
                                        </td>
                                        <td>
                                            <form method="POST"
                                                action="{{ route('estudiantes.resend', ['estudiante' => $estudiante->estudianteId]) }}">
                                                @csrf
                                                <div class="text-center">
                                                    <center> <button type="submit" class="button3  ">
                                                            <i class="fa-solid fa-paper-plane-top"></i>
                                                        </button> </center>
                                                </div>
                                            </form>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>


   
    <div class="mt-4">
        <h4><b>Informacion Vinculacion asignada</b></h4>
        <hr>
        @if ($asignacionProyecto)
            <div class="contenedor_tabla">
            <div class="mat-elevation-z8 contenedor_general">
                <div class="table-container mat-elevation-z8">

                    <div id="tablaDocentes">
                        <table class="mat-mdc-table">
                            <thead class="ng-star-inserted">
                                <tr class="mat-mdc-header-row mdc-data-table__header-row cdk-header-row ng-star-inserted">
                                    <th class="tamanio">NOMBRE DEL PROYECTO</th>
                                    <th>DOCENTE DIRECTOR</th>
                                    <th class="tamanio">DESCRIPCIÓN</th>
                                    <th>FECHA DE ASIGNACIÓN</th>
                                    <th>PERIODO</th>
                                </tr>
                            </thead>
                            <tbody class="mdc-data-table__content ng-star-inserted">
                                <tr>
                                    <td style=" text-transform: uppercase ; text-align:justify">
                                        {{ strtoupper($asignacionProyecto->proyecto->nombreProyecto) }}</td>
                                    <td style=" text-transform: uppercase; text-align:left">
                                        {{ strtoupper($asignacionProyecto->proyecto->director->nombres . ' ' . $asignacionProyecto->proyecto->director->apellidos) }}

                                    <td style=" text-transform: uppercase; text-align:justify">
                                        {{ strtoupper($asignacionProyecto->proyecto->descripcionProyecto) }}</td>
                                    <td style=" text-transform: uppercase; text-align:center;">
                                        {{ $asignacionProyecto->asignacionFecha }}</td>
                                    <td style=" text-transform: uppercase; text-align:center;">
                                        {{ strtoupper($asignacionProyecto->periodo->numeroPeriodo ?? '') }}</td>

                                </tr>

                            </tbody>
                        </table>
                    @else
                        <p>Aun no está asignado un Proyecto. Estar pendiente de su asignación.</p>
        @endif
        <br>
</div>
</div>
</div>

<br>

        <h4><b>Información de Practicas 1</b></h4>
        <hr>

        @if ($practica1)
        <div class="contenedor_tabla">
                <div class="table-container mat-elevation-z8">

                    <div id="tablaDocentes">
                        <table class="mat-mdc-table">
                            <thead class="ng-star-inserted">
                                <tr class="mat-mdc-header-row mdc-data-table__header-row cdk-header-row ng-star-inserted">
                                   <th class="tamanio">EMPRESA</th>
                                    <th>TUTOR EMPRESARIAL</th>
                                    <th>TUTOR ACADEMICO</th>
                                    <th>TIPO DE PRACTICA</th>
                                    <th>HORA ENTRADA</th>
                                    <th>HORA SALIDA</th>
                                    <th>FECHA INICIO</th>
                                    <th>FECHA FIN</th>
                                </tr>
                            </thead>
                            <tbody class="mdc-data-table__content ng-star-inserted">
                                <tr>
                                    <td style=" text-transform: uppercase ; text-align:justify">
                                        {{ strtoupper($practica1->empresa->nombreEmpresa) }}</td>
                                    <td style=" text-transform: uppercase; text-align:left">
                                        {{ strtoupper($practica1->NombreTutorEmpresarial) }}

                                    <td style=" text-transform: uppercase; text-align:justify">
                                        {{ strtoupper($practica1->tutorAcademico->apellidos) }}
                                        {{ strtoupper($practica1->tutorAcademico->nombres) }}</td>
                                    </td>
                                    <td style=" text-transform: uppercase; text-align:center;">
                                        {{ $practica1->tipoPractica }}</td>
                                    <td style=" text-transform: uppercase; text-align:center;">
                                        {{ strtoupper($practica1->HoraEntrada) }}</td>
                                    <td style=" text-transform: uppercase; text-align:center;">
                                        {{ strtoupper($practica1->HoraSalida) }}</td>
                                    <td style=" text-transform: uppercase; text-align:center;">
                                        {{ strtoupper($practica1->FechaInicio) }}</td>
                                    <td style=" text-transform: uppercase; text-align:center;">
                                        {{ $practica1->FechaFinalizacion }}</td>



                                </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @else
            <p>No tiene asignada una Practica 1.</p>
        @endif
<br>
        <h4><b>Información de Practicas 2</b></h4>
        <hr>
        @if ($practica2)
        <div class="contenedor_tabla">
                <div class="table-container mat-elevation-z8">

                    <div id="tablaDocentes">
                        <table class="mat-mdc-table">
                            <thead class="ng-star-inserted">
                                <tr class="mat-mdc-header-row mdc-data-table__header-row cdk-header-row ng-star-inserted">
                                   <th class="tamanio">EMPRESA</th>
                                    <th>TUTOR EMPRESARIAL</th>
                                    <th class="tamanio">TUTOR ACADEMICO</th>
                                    <th>TIPO DE PRACTICA</th>
                                    <th>HORA ENTRADA</th>
                                    <th>HORA SALIDA</th>
                                    <th>FECHA INICIO</th>
                                    <th>FECHA FIN</th>
                                </tr>
                            </thead>
                            <tbody class="mdc-data-table__content ng-star-inserted">
                                <tr>
                                    <td style=" text-transform: uppercase ; text-align:justify">
                                        {{ strtoupper($practica2->empresa->nombreEmpresa) }}</td>
                                    <td style=" text-transform: uppercase; text-align:left">
                                        {{ strtoupper($practica2->NombreTutorEmpresarial) }}

                                    <td style=" text-transform: uppercase; text-align:justify">
                                        {{ strtoupper($practica2->tutorAcademico->apellidos) }}
                                        {{ strtoupper($practica2->tutorAcademico->nombres) }}</td>
                                    </td>
                                    <td style=" text-transform: uppercase; text-align:center;">
                                        {{ $practica2->tipoPractica }}</td>
                                    <td style=" text-transform: uppercase; text-align:center;">
                                        {{ strtoupper($practica2->HoraEntrada) }}</td>
                                    <td style=" text-transform: uppercase; text-align:center;">
                                        {{ strtoupper($practica2->HoraSalida) }}</td>
                                    <td style=" text-transform: uppercase; text-align:center;">
                                        {{ strtoupper($practica2->FechaInicio) }}</td>
                                    <td style=" text-transform: uppercase; text-align:center;">
                                        {{ $practica2->FechaFinalizacion }}</td>

                                </tr>

                            </tbody>
                        </table>

                    </div>

                </div>

            </div>
        @else
            <p>No tiene asignada una Practica 2.</p>
        @endif
<br>
        <h4><b>Información de Practicas 1.2</b></h4>
        <hr>
        @if ($practica3)
        <div class="contenedor_tabla">
                <div class="table-container mat-elevation-z8">

                    <div id="tablaDocentes">
                        <table class="mat-mdc-table">
                            <thead class="ng-star-inserted">
                                <tr class="mat-mdc-header-row mdc-data-table__header-row cdk-header-row ng-star-inserted">
                                   <th class="tamanio">EMPRESA</th>
                                    <th>TUTOR EMPRESARIAL</th>
                                    <th class="tamanio">TUTOR ACADEMICO</th>
                                    <th>TIPO DE PRACTICA</th>
                                    <th>HORA ENTRADA</th>
                                    <th>HORA SALIDA</th>
                                    <th>FECHA INICIO</th>
                                    <th>FECHA FIN</th>
                                </tr>
                            </thead>
                            <tbody class="mdc-data-table__content ng-star-inserted">
                                <tr>
                                    <td style=" text-transform: uppercase ; text-align:justify">
                                        {{ strtoupper($practica3->empresa->nombreEmpresa) }}</td>
                                    <td style=" text-transform: uppercase; text-align:left">
                                        {{ strtoupper($practica3->NombreTutorEmpresarial) }}

                                    <td style=" text-transform: uppercase; text-align:justify">
                                        {{ strtoupper($practica3->tutorAcademico->apellidos) }}
                                        {{ strtoupper($practica3->tutorAcademico->nombres) }}</td>
                                    </td>
                                    <td style=" text-transform: uppercase; text-align:center;">
                                        {{ $practica3->tipoPractica }}</td>
                                    <td style=" text-transform: uppercase; text-align:center;">
                                        {{ strtoupper($practica3->HoraEntrada) }}</td>
                                    <td style=" text-transform: uppercase; text-align:center;">
                                        {{ strtoupper($practica3->HoraSalida) }}</td>
                                    <td style=" text-transform: uppercase; text-align:center;">
                                        {{ strtoupper($practica3->FechaInicio) }}</td>
                                    <td style=" text-transform: uppercase; text-align:center;">
                                        {{ $practica3->FechaFinalizacion }}</td>

                                </tr>

                            </tbody>
                        </table>

                    </div>

                </div>
            </div>
        @else
            <p>No tiene asignada una Practica 1.2.</p>
        @endif

<br>
        <h4><b>Información de Practicas 1.3</b></h4>
        <hr>
        @if ($practica4)
        <div class="contenedor_tabla">
                <div class="table-container mat-elevation-z8">

                    <div id="tablaDocentes">
                        <table class="mat-mdc-table">
                            <thead class="ng-star-inserted">
                                <tr class="mat-mdc-header-row mdc-data-table__header-row cdk-header-row ng-star-inserted">
                                   <th class="tamanio">EMPRESA</th>
                                    <th>TUTOR EMPRESARIAL</th>
                                    <th class="tamanio">TUTOR ACADEMICO</th>
                                    <th>TIPO DE PRACTICA</th>
                                    <th>HORA ENTRADA</th>
                                    <th>HORA SALIDA</th>
                                    <th>FECHA INICIO</th>
                                    <th>FECHA FIN</th>
                                </tr>
                            </thead>
                            <tbody class="mdc-data-table__content ng-star-inserted">
                                <tr>
                                    <td style=" text-transform: uppercase ; text-align:justify">
                                        {{ strtoupper($practica4->empresa->nombreEmpresa) }}</td>
                                    <td style=" text-transform: uppercase; text-align:left">
                                        {{ strtoupper($practica4->NombreTutorEmpresarial) }}

                                    <td style=" text-transform: uppercase; text-align:justify">
                                        {{ strtoupper($practica4->tutorAcademico->apellidos) }}
                                        {{ strtoupper($practica4->tutorAcademico->nombres) }}</td>
                                    </td>
                                    <td style=" text-transform: uppercase; text-align:center;">
                                        {{ $practica4->tipoPractica }}</td>
                                    <td style=" text-transform: uppercase; text-align:center;">
                                        {{ strtoupper($practica4->HoraEntrada) }}</td>
                                    <td style=" text-transform: uppercase; text-align:center;">
                                        {{ strtoupper($practica4->HoraSalida) }}</td>
                                    <td style=" text-transform: uppercase; text-align:center;">
                                        {{ strtoupper($practica4->FechaInicio) }}</td>
                                    <td style=" text-transform: uppercase; text-align:center;">
                                        {{ $practica4->FechaFinalizacion }}</td>

                                </tr>

                            </tbody>
                        </table>

                    </div>

                </div>

            </div>
        @else
            <p>No tiene asignada una Practica 1.3.</p>
        @endif
<br>
        <h4><b>Información de Practicas 2.2</b></h4>
        <hr>
        @if ($practica5)
        <div class="contenedor_tabla">
                <div class="table-container mat-elevation-z8">

                    <div id="tablaDocentes">
                        <table class="mat-mdc-table">
                            <thead class="ng-star-inserted">
                                <tr class="mat-mdc-header-row mdc-data-table__header-row cdk-header-row ng-star-inserted">
                                   <th class="tamanio">EMPRESA</th>
                                    <th>TUTOR EMPRESARIAL</th>
                                    <th class="tamanio">TUTOR ACADEMICO</th>
                                    <th>TIPO DE PRACTICA</th>
                                    <th>HORA ENTRADA</th>
                                    <th>HORA SALIDA</th>
                                    <th>FECHA INICIO</th>
                                    <th>FECHA FIN</th>
                                </tr>
                            </thead>
                            <tbody class="mdc-data-table__content ng-star-inserted">
                                <tr>
                                    <td style=" text-transform: uppercase ; text-align:justify">
                                        {{ strtoupper($practica5->empresa->nombreEmpresa) }}</td>
                                    <td style=" text-transform: uppercase; text-align:left">
                                        {{ strtoupper($practica5->NombreTutorEmpresarial) }}

                                    <td style=" text-transform: uppercase; text-align:justify">
                                        {{ strtoupper($practica5->tutorAcademico->apellidos) }}
                                        {{ strtoupper($practica5->tutorAcademico->nombres) }}</td>
                                    </td>
                                    <td style=" text-transform: uppercase; text-align:center;">
                                        {{ $practica5->tipoPractica }}</td>
                                    <td style=" text-transform: uppercase; text-align:center;">
                                        {{ strtoupper($practica5->HoraEntrada) }}</td>
                                    <td style=" text-transform: uppercase; text-align:center;">
                                        {{ strtoupper($practica5->HoraSalida) }}</td>
                                    <td style=" text-transform: uppercase; text-align:center;">
                                        {{ strtoupper($practica5->FechaInicio) }}</td>
                                    <td style=" text-transform: uppercase; text-align:center;">
                                        {{ $practica5->FechaFinalizacion }}</td>

                                </tr>

                            </tbody>
                        </table>

                    </div>

                </div>

            </div>
        @else
            <p>No tiene asignada una Practica 2.2.</p>
        @endif


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

    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
                    // Selecciona el elemento de la alerta
                    const alertElement = document.querySelector('.contenedor_alerta');
                    // Establece un temporizador para ocultar la alerta después de 2 segundos
                    setTimeout(() => {
                        if (alertElement) {
                            alertElement.style.display = 'none';
                        }
                    }, 1000); // 2000 milisegundos = 2 segundos
                });
                </script>
               
               <style>
        .contenedor_tabla .table-container table td {
            width: 200px;
            min-width: 150px;
            font-size: 11px !important;
            padding: .5rem !important;
        }

    </style>
@endsection
