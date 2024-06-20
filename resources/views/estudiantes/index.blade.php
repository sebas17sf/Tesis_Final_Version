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


    <div class="mt-4">
        <h4><b>
                <div class="icon-sidebar-item">Estado-Aprobación</div>
            </b></h4>
        <div class="mat-elevation-z8 contenedor_general1">
                <div class="contenedor_acciones_tabla sidebar_active_content_acciones_tabla">
                    <!-- Botones -->
                    <div class="contenedor_botones">
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
                </div>
                </div>
<br>
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
