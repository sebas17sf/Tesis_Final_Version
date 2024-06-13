@extends('layouts.app')

@section('title', 'Información del Estudiante')

@section('title_component', 'Información del Estudiante')
@section('content')
@if (session('success'))
<div class="contenedor_alerta success">
    <div class="icon_alert"><i class="fa-regular fa-check"></i></div>
    <div class="content_alert">
        <div class="title">Éxito!</div>
        <div class="body">{{ session('success') }}</div>
    </div>
    <div class="icon_remove">
        <button class="button4 btn_3_2"><i class="fa-regular fa-xmark"></i></button>
    </div>
</div>

<script>
    document.querySelector('.contenedor_alerta .icon_remove button').addEventListener('click', function() {
        this.closest('.contenedor_alerta').style.display = 'none';
    });
</script>
@endif


@if (session('error'))
<div class="contenedor_alerta error">
    <div class="icon_alert"><i class="fa-regular fa-xmark"></i></div>
    <div class="content_alert">
        <div class="title">Error!</div>
        <div class="body">{{ session('error') }}</div>
    </div>
    <div class="icon_remove">
        <button class="button4 btn_3_2"><i class="fa-regular fa-xmark"></i></button>
    </div>
</div>

<script>
    document.querySelector('.contenedor_alerta.error .icon_remove button').addEventListener('click', function() {
        this.closest('.contenedor_alerta').style.display = 'none';
    });
</script>
@endif

    <section class="contenedor_agregar_periodo">


    <div class="contenedor_general mat-elevation-z8 ">

        <div class="table-container mat-elevation-z8">
            <div id="tablaDocentes">

                <div class="container mt-3">
                    <div class="card" style="max-width: 750px; margin: auto;">
                        <div class="card-header1">
                            <div class=" justify-content-between align-items-center">
                                <div></div>
                                <div class="d-flex">
                                    <form action="{{ route('estudiantes.certificadoMatricula') }}" method="get"
                                        class="mr-2">
                                        <div class="tooltip-container">
                                            <span class="tooltip-text">Pdf</span>
                                            <button type="submit" class="button3_1_1  btn_pdf"
                                                tooltipPosition="top">
                                                <i class="fa-solid fa-file-pdf"></i>
                                            </button>
                                        </div>
                                    </form>
                                    <div class="tooltip-container">
                                        <span class="tooltip-text">Editar</span>
                                        <a  type="submit" href="{{ route('estudiantes.edit', ['estudiante' => $estudiante->estudianteId]) }}"
                                            class="button3_1_1 btn_editar" tooltipPosition="top">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-body tamanio1">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label for="Nombres" class="col-sm-4 font-weight-bold">
                                        <div class="icon-sidebar-item">
                                            <i class="fas fa-user"></i>
                                            </div>
                                            <div class="icon-sidebar-item">
                                            Nombres:
                                        </div>
                                        </label>
                                        <div class="col-sm-8">
                                            <div class="input-group">
                                                <label class="form-control">{{ strtoupper($estudiante->nombres) }}</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="Apellidos" class="col-sm-4 font-weight-bold">
                                        <div class="icon-sidebar-item">
                                            <i class="fas fa-user"></i>
                                            </div>
                                            <div class="icon-sidebar-item">
                                            Apellidos:
                                        </div>
                                        </label>
                                        <div class="col-sm-8">
                                            <div class="input-group">
                                                <label class="form-control">{{ strtoupper($estudiante->apellidos) }}</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="espe_id" class="col-sm-4 font-weight-bold">
                                        <div class="icon-sidebar-item">
                                            <i class="fas fa-id-card"></i>
                                        </div>
                                        <div class="icon-sidebar-item">
                                            ESPE ID:
                                        </div>
                                        </label>
                                        <div class="col-sm-8">
                                            <div class="input-group">
                                                <label class="form-control">{{ strtoupper($estudiante->espeId) }}</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="celular" class="col-sm-4 font-weight-bold">
                                        <div class="icon-sidebar-item">
                                        <i class="fas fa-mobile-alt"></i>
                                        </div>
                                        <div class="icon-sidebar-item">
                                        Celular:
                                    </div>
                                    </label>
                                        <div class="col-sm-8">
                                            <div class="input-group">
                                                <label class="form-control">{{ strtoupper($estudiante->celular) }}</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label for="cedula" class="col-sm-4 font-weight-bold">
                                        <div class="icon-sidebar-item">
                                        <i  class="fas fa-id-card"></i>
                                        </div>
                                        <div class="icon-sidebar-item">
                                        Cédula:
                                    </div>
                                    </label>
                                        <div class="col-sm-8">
                                            <div class="input-group">
                                                <label class="form-control">{{ strtoupper($estudiante->cedula) }}</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="Cohorte" class="col-sm-4 font-weight-bold">
                                        <div class="icon-sidebar-item">
                                        <i class="fas fa-calendar-alt"></i>
                                        </div>
                                        <div class="icon-sidebar-item">
                                        Cohorte:
                                    </div>
                                    </label>
                                        <div class="col-sm-8">
                                            <div class="input-group">
                                                <label class="form-control">
                                                    @if(isset($periodo) && $periodo->numeroPeriodo)
                                                    {{ strtoupper($periodo->numeroPeriodo) }}
                                                    @else
                                                    No tiene periodo
                                                    @endif
                                                </label>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="form-group row">
                                        <label for="Departamento" class="col-sm-4 font-weight-bold">
                                        <div class="icon-sidebar-item">
                                            <i class="fa-solid fa-envelope"></i>
                                            </div>
                                            <div class="icon-sidebar-item">
                                         Correo:
                                        </div>
                                        </label>
                                        <div class="col-sm-8">
                                            <div class="input-group">
                                                <label
                                                    class="form-control label">{{ ($estudiante->correo) }}</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="Departamento" class="col-sm-4 font-weight-bold">
                                        <div class="icon-sidebar-item">
                                        <i class="fas fa-building"></i>
                                        </div>
                                        <div class="icon-sidebar-item">
                                        Departamento:
                                    </div>
                                    </label>
                                        <div class="col-sm-8">
                                            <div class="input-group">
                                                <label style="text-transform: uppercase; "
                                                    class="form-control label">{{ strtoupper($estudiante->departamento) }}</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
            </div>

        </div>
    </div>
    <!-- Estado y botón de reenvío de información con ícono -->
    <div >
    <div class="mt-4">
        <h4><b>
                <div class="icon-sidebar-item">Estado-Aprobación</div>
            </b></h4>
        <hr>
        <div class="contenedor_tabla">
                <div class="table-container mat-elevation-z8">

                    <div id="tablaProyectos">
                        <table class="mat-mdc-table">
                            <thead class="ng-star-inserted">
                                <tr class="mat-mdc-header-row mdc-data-table__header-row cdk-header-row ng-star-inserted">
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
                    <form method="POST" action="{{ route('estudiantes.resend', ['estudiante' => $estudiante->estudianteId]) }}">
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



    </div>
</div>
</section>
    <!-- Sección para mostrar la información del proyecto asignado -->
    <div class="mt-4">
        <h4><b>Proyecto Asignado</b></h4>
        <hr>
        @if ($asignacionProyecto)
        <div class="contenedor_tabla">
                    <div class="table-container mat-elevation-z8">

                        <div id="tablaDocentes">
                            <table class="mat-mdc-table">
                                <thead class="ng-star-inserted">
                                    <tr
                                        class="mat-mdc-header-row mdc-data-table__header-row cdk-header-row ng-star-inserted">
                                        <th class="tamanio">NOMBRE DEL PROYECTO</th>
                        <th>DOCENTE DIRECTOR</th>
                        <th class="tamanio">DESCRIPCIÓN</th>
                        <th>FECHA DE ASIGNACIÓN</th>
                        <th>PERIODO</th>
                     </tr>
                </thead>
                <tbody class="mdc-data-table__content ng-star-inserted">
                    <tr>
                        <td style=" text-transform: uppercase ; text-align:justify">{{ strtoupper($asignacionProyecto->proyecto->nombreProyecto) }}</td>
                        <td style=" text-transform: uppercase; text-align:left">{{ strtoupper($asignacionProyecto->proyecto->director->nombres . ' ' . $asignacionProyecto->proyecto->director->apellidos) }}

                        <td style=" text-transform: uppercase; text-align:justify">{{ strtoupper($asignacionProyecto->proyecto->descripcionProyecto) }}</td>
                        <td style=" text-transform: uppercase; text-align:center;">{{ $asignacionProyecto->asignacionFecha }}</td>
                        <td style=" text-transform: uppercase; text-align:center;">{{ strtoupper($asignacionProyecto->periodo->numeroPeriodo ?? '') }}</td>

                     </tr>

                </tbody>
            </table>
        @else
            <p>Aun no está asignado un Proyecto. Estar pendiente de su asignación.</p>
        @endif
    </div>

    </div>
</div>
</div>
    </div>
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
.contenedor_tabla .table-container table th {
    position: sticky;
    font-size: .8em !important;
        </style>
@endsection
