@extends('layouts.directorVinculacion')
@section('title', 'Panel Estudiantes')

@section('title_component', 'Panel Asignaciones')
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

    <div class="container">
        <br>

        <form action="{{ route('generar-actaEstudiante') }}" method="POST">
            @csrf
            <button type="submit" class="button1_1">Generar acta de designación Estudiante</button>
        </form>

        <div class="contenedor_tabla">
            <div class="table-container mat-elevation-z8">

                <div id="tablaProyectos">
                    <table class="mat-mdc-table">
                        <thead class="ng-star-inserted">
                            <tr class="mat-mdc-header-row mdc-data-table__header-row cdk-header-row ng-star-inserted">

                                <th class="tamanio1">Estudiante</th>
                                <th class="tamanio1">Docente asignado</th>
                                <th class="tamanio">Proyecto</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="mdc-data-table__content ng-star-inserted">

                            @foreach ($asignacionesEstudiantesDirector as $asignacion)
                                <tr>
                                    <td style=" text-transform: uppercase; word-wrap: break-word; text-align: justify; ">
                                        {{ $asignacion->estudiante->apellidos }} {{ $asignacion->estudiante->nombres }}</td>
                                    <td style=" text-transform: uppercase; word-wrap: break-word; text-align: justify; ">
                                        {{ $asignacion->docenteParticipante->nombres }}
                                        {{ $asignacion->docenteParticipante->apellidos }}
                                    </td>
                                    <td
                                        style=" text-transform: uppercase; word-wrap: break-word; text-align: justify; padding: 5px 8px;">
                                        {{ $asignacion->proyecto->nombreProyecto }}</td>
                                    <td>


                                        <form id="eliminarEstudianteForm_{{ $asignacion->estudianteId }}"
                                            action="{{ route('director_vinculacion.eliminarEstudiante', ['EstudianteID' => $asignacion->estudianteId]) }}"
                                            method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <input type="hidden" name="estudiante_id"
                                                value="{{ $asignacion->estudianteId }}">
                                            <center>
                                                <button class="button3 efects_button btn_eliminar3" type="button"
                                                    onclick="eliminarEstudiante('{{ $asignacion->estudianteId }}')">
                                                    <i class='bx bx-trash'></i>
                                                </button>
                                            </center>
                                            <input type="hidden" name="motivo_negacion"
                                                id="motivoNegacion_{{ $asignacion->estudianteId }}">
                                        </form>


                                        <!-- Botón para abrir el modal -->
                                        <button type="button" class="button3 efects_button btn_eliminar3"
                                            data-toggle="modal"
                                            data-target="#tablaActividad{{ $asignacion->estudianteId }}">
                                            <i class='bx bx-list-ul'></i>
                                        </button>

                                        <!-- Modal -->
                                        <div class="modal fade" id="tablaActividad{{ $asignacion->estudianteId }}"
                                            tabindex="-1" role="dialog"
                                            aria-labelledby="modalLabel{{ $asignacion->estudianteId }}" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title"
                                                            id="modalLabel{{ $asignacion->estudianteId }}">Actividades del
                                                            Estudiante</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <table class="table">
                                                            <thead>
                                                                <tr>
                                                                    <th>Fecha</th>
                                                                    <th>Actividades</th>
                                                                    <th>Hora</th>
                                                                    <th>Nombre de la actividad</th>
                                                                    <th>Evidencia</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($asignacion->estudiante->actividades as $actividad)
                                                                    <tr>
                                                                        <td
                                                                            style="text-transform: uppercase; word-wrap: break-word; text-align: justify;">
                                                                            {{ $actividad->fecha }}
                                                                        </td>
                                                                        <td
                                                                            style="text-transform: uppercase; word-wrap: break-word; text-align: justify; padding: 5px 8px;">
                                                                            {{ $actividad->actividades }}
                                                                        </td>
                                                                        <td
                                                                            style="text-transform: uppercase; word-wrap: break-word; text-align: justify;">
                                                                            {{ $actividad->numeroHoras }}
                                                                        </td>
                                                                        <td
                                                                            style="text-transform: uppercase; word-wrap: break-word; text-align: justify;">
                                                                            {{ $actividad->nombreActividad }}
                                                                        </td>

                                                                        <td>

                                                                            <img width="100px"
                                                                                src="data:image/jpeg;base64,{{ $actividad->evidencias }}"
                                                                                alt="Evidencia" />
                                                                        </td>
                                                                    </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">Cerrar</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>




                                    </td>
                                </tr>
                        </tbody>
                        @endforeach
                    </table>
                </div>


                <br>

                <form id="finalizarForm" action="{{ route('director_vinculacion.cerrarProcesoEstudiantes') }}"
                    method="POST">
                    @csrf
                    <button id="finalizarBtn" type="button" class="button1_1">Finalizar actividades de los
                        estudiantes</button>
                </form>






            </div>
        @endsection
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            function eliminarEstudiante(estudianteID) {
                Swal.fire({
                    title: 'Ingrese el motivo de la negación',
                    input: 'textarea',
                    inputLabel: 'Motivo',
                    inputPlaceholder: 'Ingrese el motivo aquí...',
                    inputAttributes: {
                        'aria-label': 'Ingrese el motivo aquí',
                        rows: 7,
                        style: 'resize: vertical;'
                    },
                    showCancelButton: true,
                    cancelButtonText: 'Cancelar',
                    confirmButtonText: 'Confirmar',
                    preConfirm: (motivo) => {
                        if (!motivo) {
                            Swal.showValidationMessage('Debe ingresar un motivo');
                            return false;
                        }
                        return motivo;
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        console.log('Motivo ingresado:', result.value); // Log for debugging
                        document.getElementById('motivoNegacion_' + estudianteID).value = result.value;
                        console.log('Submitting form:', 'eliminarEstudianteForm_' + estudianteID); // Log for debugging
                        document.getElementById('eliminarEstudianteForm_' + estudianteID).submit();
                    }
                });
            }
        </script>
        <script>
            $(document).ready(function() {
                $('.actividad-card').click(function() {
                    var actividadId = $(this).attr('id').replace('actividad', '');

                    var tablaActividad = $('#tablaActividad' + actividadId);

                    tablaActividad.slideToggle();
                });
            });

            window.onload = function() {
                const finalizarBtn = document.getElementById('finalizarBtn');
                if (finalizarBtn) {
                    finalizarBtn.addEventListener('click', function(e) {
                        Swal.fire({
                            title: '¿Está seguro de finalizar a los estudiantes?',
                            text: 'Debe verificar que todos los estudiantes hayan generado todos sus documentos antes de finalizar el proceso.',
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonText: 'Sí, finalizar',
                            cancelButtonText: 'No, cancelar'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                document.getElementById('finalizarForm').submit();
                            }
                        });
                    });
                }
            };
        </script>
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
            }
        </style>
