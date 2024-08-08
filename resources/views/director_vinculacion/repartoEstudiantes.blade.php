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
    <section class="contenedor_agregar_periodo">

        <br>

        <form action="{{ route('generar-actaEstudiante') }}" method="POST" class="form-inline custom-form">
            @csrf
            <div class="form-group mr-4">
                <label for="estudiante" class="mr-4">Selecciona un estudiante:</label>
                <select name="estudiante" id="estudiante" class="form-control input input_select2 custom-select">
                    <option value="">Todos los estudiantes</option>
                    @foreach ($asignacionesEstudiantesDirector as $asignacion)
                        @if ($asignacion->estudiante)
                            <option value="{{ $asignacion->estudiante->estudianteId }}">
                                {{ $asignacion->estudiante->apellidos }} {{ $asignacion->estudiante->apellidos }}
                            </option>
                        @endif
                    @endforeach
                </select>
            </div>
            <button type="submit" class="button1_1">Generar acta de designación Estudiante</button>
        </form>
        <br>

        <div class="contenedor_tabla">
            <div class="table-container mat-elevation-z8">

                <div id="tablaProyectos">
                    <table class="mat-mdc-table">
                        <thead class="ng-star-inserted">
                            <tr class="mat-mdc-header-row mdc-data-table__header-row cdk-header-row ng-star-inserted">
                                <th style="min-width: 10px !important;">N°</th>

                                <th class="tamanio1">ESTUDIANTE</th>
                                <th class="tamanio1">DOCENTE ASIGNADO</th>
                                <th class="tamanio">PROYECTO</th>
                                <th>ACCIONES</th>
                            </tr>
                        </thead>
                        <tbody class="mdc-data-table__content ng-star-inserted">
                            @if ($asignacionesEstudiantesDirector->isEmpty())
                                <tr>
                                    <td class="noExisteRegistro1" colspan="5"
                                        style="text-align: center; font-size: 16px !important;"">No hay asignaciones de
                                        estudiantes</td>
                                </tr>
                            @endif

                            @foreach ($asignacionesEstudiantesDirector as $asignacion)
                                <tr>
                                    <td style="text-align: center; width: 10px !important;">{{ $loop->iteration }}</td>
                                    <td style=" text-transform: uppercase; word-wrap: break-word; text-align: left; ">
                                        {{ $asignacion->estudiante->apellidos }} {{ $asignacion->estudiante->nombres }}</td>
                                    <td style=" text-transform: uppercase; word-wrap: break-word; text-align: left; ">
                                        {{ $asignacion->docenteParticipante->nombres }}
                                        {{ $asignacion->docenteParticipante->apellidos }}
                                    </td>
                                    <td
                                        style=" text-transform: uppercase; word-wrap: break-word; text-align: justify; padding: 5px 8px;">
                                        {{ $asignacion->proyecto->nombreProyecto }}</td>
                                    <td style="text-align: center;">
                                        <div class="btn-group shadow-0">
                                            <form id="eliminarEstudianteForm_{{ $asignacion->estudianteId }}"
                                                action="{{ route('director_vinculacion.eliminarEstudiante', ['EstudianteID' => $asignacion->estudianteId]) }}"
                                                method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <input type="hidden" name="estudiante_id"
                                                    value="{{ $asignacion->estudianteId }}">
                                                <center><button class="button3 efects_button btn_eliminar3" type="button"
                                                        onclick="mostrarSweetAlert('{{ $asignacion->estudianteId }}')"
                                                        style="margin-right: 5px;"><i class='bx bx-trash'></i> </button>
                                                </center>
                                                <input type="hidden" name="motivo_negacion"
                                                    id="motivoNegacion_{{ $asignacion->estudianteId }}">
                                            </form>

                                            <!-- Botón para abrir el modal -->
                                            <button type="button" class="button3 efects_button btn_editar3"
                                                data-toggle="modal" style="margin-right: 5px;"
                                                onclick="openCard('tablaActividad{{ $asignacion->estudianteId }}');">

                                                <i class="fa-solid fa-eye"></i>
                                            </button>

                                            <form id="cerrarEstudianteForm_{{ $asignacion->estudianteId }}"
                                                action="{{ route('director.cerrarEstudianteIndividual', ['estudianteId' => $asignacion->estudianteId]) }}"
                                                method="POST">
                                                @csrf
                                                <button type="button" class="button3 efects_button btn_check3"
                                                    style="margin-right: 5px;"
                                                    onclick="confirmSubmit('{{ $asignacion->estudianteId }}')">
                                                    <i class="fa fa-check"></i>
                                                </button>
                                            </form>
                                            <!-- Modal -->
                                            <div class="draggable-card1_3"
                                                id="tablaActividad{{ $asignacion->estudianteId }}">

                                                <div class="card-header">
                                                    <span class="card-title1"
                                                        id="modalLabel{{ $asignacion->estudianteId }}">Actividades del
                                                        Estudiante </span>
                                                    <button type="button" class="close"
                                                        onclick="closeCard('tablaActividad{{ $asignacion->estudianteId }}')"><i
                                                            class="fa-thin fa-xmark"></i></button>
                                                </div>
                                                <div class="contenedor_tabla">
                                                    <div class="table-container mat-elevation-z8">

                                                        <div id="tablaActivida">
                                                            <table class="mat-mdc-table">
                                                                <thead class="ng-star-inserted">
                                                                    <tr
                                                                        class="mat-mdc-header-row mdc-data-table__header-row cdk-header-row ng-star-inserted">
                                                                        <th>FECHA</th>
                                                                        <th>ACTIVIDADES</th>
                                                                        <th>HORA</th>
                                                                        <th>NOMBRE DE LA ACTIVIDAD</th>
                                                                        <th>EVIDENCIA</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @foreach ($asignacion->estudiante->actividades as $actividad)
                                                                        <tr>
                                                                            <td
                                                                                style="text-transform: uppercase; word-wrap: break-word; text-align: center;">
                                                                                {{ $actividad->fecha }}
                                                                            </td>
                                                                            <td
                                                                                style="text-transform: uppercase; word-wrap: break-word; text-align: justify; padding: 5px 8px;">
                                                                                {{ $actividad->actividades }}
                                                                            </td>
                                                                            <td
                                                                                style="text-transform: uppercase; word-wrap: break-word; text-align: center;">
                                                                                {{ $actividad->numeroHoras }}
                                                                            </td>
                                                                            <td
                                                                                style="text-transform: uppercase; word-wrap: break-word; text-align: center;">
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

                                                    </div>
                                                </div>
                                            </div>




                                    </td>
                                </tr>
                        </tbody>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>


        <br>

        <center>
            <form id="finalizarForm" action="{{ route('director_vinculacion.cerrarProcesoEstudiantes') }}" method="POST">
                @csrf
                <button id="finalizarBtn" type="button" class="button1_1">Finalizar actividades de los
                    estudiantes</button>
            </form>
        </center>

        <br>

        <h4><b>Informacion del Proyecto</b></h4>

        <div class="mat-elevation-z8 contenedor_general">

            <div class="contenedor_tabla">
                <div class="table-container mat-elevation-z8">

                    <div id="tablaDirector">
                        <table class="mat-mdc-table">
                            <thead class="ng-star-inserted">
                                <tr class="mat-mdc-header-row mdc-data-table__header-row cdk-header-row ng-star-inserted">
                                    <th>N°</th>
                                    <th class="tamanio">NOMBRE DE PROYECTO</th>
                                    <th class="tamanio3">CÓDIGO DE PROYECTO</th>
                                    <th class="tamanio4">DIRECTOR</th>
                                    <th class="tamanio2">DEPARTAMENTO DIRECTOR</th>
                                    <th>FECHA INICIO</th>
                                    <th>FECHA FIN</th>
                                    <th>ESTADO</th>
                                    <th>INFORMACION</th>
                                </tr>
                            </thead>
                            <tbody class="mdc-data-table__content ng-star-inserted">
                                @foreach ($proyectos as $index => $asignaciones)
                                    <tr class="mat-mdc-row mdc-data-table__row ng-star-inserted">
                                        <td style="text-align: center;">
                                        </td>
                                        <td style="text-align:justify; text-transform: uppercase; word-wrap: break-word;">
                                            {{ $asignaciones->nombreProyecto }}</td>
                                        <td style="text-align:center; text-transform: uppercase; word-wrap: break-word;">
                                            {{ $asignaciones->codigoProyecto }}</td>
                                        <td style="text-align:left; text-transform: uppercase; word-wrap: break-word;">
                                            {{ $asignaciones->director->nombres }}
                                            {{ $asignaciones->director->apellidos }}</td>
                                        <td style="text-align:center; text-transform: uppercase; word-wrap: break-word;">
                                            {{ $asignaciones->departamentoTutor }}</td>



                                        <td style="text-align:center; text-transform: uppercase; word-wrap: break-word;">
                                            {{ $asignaciones->inicioFecha }}</td>
                                        <td style="text-align:center; text-transform: uppercase; word-wrap: break-word;">
                                            {{ $asignaciones->finFecha }}</td>

                                        <td style="text-align:center; text-transform: uppercase; word-wrap: break-word;">
                                            {{ $asignaciones->estado }}</td>

                                        <td class="center_size">
                                            <div class="btn-group shadow-1">
                                                <button type="button" class="button3 efects_button btn_editar3"
                                                    style="margin-right: 5px;"
                                                    onclick="openCard('draggableCardEditaProyecto{{ $asignaciones->proyectoId }}');">
                                                    <i class="bx bx-edit-alt"></i>
                                                </button>

                                                <div class="draggable-card1_1"
                                                    id="draggableCardEditaProyecto{{ $asignaciones->proyectoId }}">
                                                    <div class="card-header">
                                                        <span class="card-title1">Informacion Proyecto</span>
                                                        <button type="button" class="close"
                                                            onclick="$('#draggableCardEditaProyecto{{ $asignaciones->proyectoId }}').hide()"><i
                                                                class="fa-thin fa-xmark"></i></button>
                                                    </div>
                                                    <div class="card-body">
                                                        <form
                                                            action="{{ route('proyecto.update', $asignaciones->proyectoId) }}"
                                                            method="POST" id="formularioEditarMaestro">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="form-row">
                                                                <div class="form-group col-md-4">
                                                                    <label class="label" for="comunidad"><strong>Nombre
                                                                            de la comunidad:</strong></label>
                                                                    <input type="text" id="comunidad" name="comunidad"
                                                                        class="form-control input input_select1 form-text"
                                                                        value="{{ $asignaciones->comunidad ?? '' }}">
                                                                </div>
                                                                <div class="form-group col-md-4">
                                                                    <label class="label"
                                                                        for="provincia"><strong>Provincia:</strong></label>
                                                                    <input type="text" id="provincia" name="provincia"
                                                                        class="form-control input input_select1"
                                                                        value="{{ $asignaciones->provincia ?? '' }}">
                                                                </div>
                                                                <div class="form-group col-md-4">
                                                                    <label class="label"
                                                                        for="canton"><strong>Cantón:</strong></label>
                                                                    <input type="text" id="canton" name="canton"
                                                                        class="form-control input input_select1"
                                                                        value="{{ $asignaciones->canton ?? '' }}">
                                                                </div>
                                                                <div class="form-group col-md-4">
                                                                    <label class="label"
                                                                        for="parroquia"><strong>Parroquia:</strong></label>
                                                                    <input type="text" id="parroquia" name="parroquia"
                                                                        class="form-control input input_select1"
                                                                        value="{{ $asignaciones->parroquia ?? '' }}">
                                                                </div>
                                                                <div class="form-group col-md-4">
                                                                    <label class="label"
                                                                        for="direccion"><strong>Dirección:</strong></label>
                                                                    <input type="text" id="direccion" name="direccion"
                                                                        class="form-control input input_select1"
                                                                        value="{{ $asignaciones->direccion ?? '' }}">
                                                                </div>
                                                            </div>
                                                            <div
                                                                class="card-footer1 d-flex justify-content-center align-items-center">
                                                                <button type="submit"
                                                                    class="button input_select1">Guardar Cambios</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>


                                        </td>
                    </div>
                    </tr>
                    @endforeach
                    </tbody>
                    </table>
                </div>
            </div>


        </div>
        </div>


        <script src="{{ asset('js/ParticipanteDirectorVinculacion/notas.js') }}"></script>
        <link rel="stylesheet" href="https://cdn.ckeditor.com/4.16.1/standard/ckeditor.css">
        <script src="https://cdn.ckeditor.com/4.16.1/standard/ckeditor.js"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="{{ asset('js/admin/acciones.js') }}"></script>

        <script>
            function eliminarEstudiante(estudianteID) {
                Swal.fire({
                    title: 'Ingrese el motivo de la negación',
                    input: 'textarea',
                    inputLabel: 'Escriba el motivo',
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
                            text: 'Debe verificar que el estudiante este calificado o subiera sus actividades.',
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
            $(document).ready(function() {
                // Hacer que los cards sean draggable
                $('.draggable-card1_3').draggable({
                    handle: ".card-header",
                    containment: "window"
                });
            });
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
        <script>
            function confirmSubmit(estudianteId) {
                Swal.fire({
                    title: '¿Está seguro de realizar este proceso?',
                    text: 'Debe verificar que el estudiante este calificado o subiera sus actividades.',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Sí, estoy seguro',
                    cancelButtonText: 'No, cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('cerrarEstudianteForm_' + estudianteId).submit();
                    }
                });
            }
        </script>
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

            div:where(.swal2-container) .swal2-textarea {
                height: 3.75em;
                width: 25em !important;
                /* padding: .75em; */
            }

            .swal2-input-label {
                font-size: 14px;
            }

            .swal2-styled.swal2-confirm {

                background-color: #5d508a;

            }



            .modal {
                background-color: none !important;
                z-index: none !important;
            }

            /* Estilos personalizados para SweetAlert2 */
            .swal2-popup-custom {
                background-color: #f0f0f0;
                /* Fondo personalizado */
                border-radius: 10px;
                /* Bordes redondeados */
                padding: 20px;
                /* Espaciado interno */
            }

            .swal2-title-custom {
                color: #333;
                /* Color del título */
                font-size: 24px;
                /* Tamaño de fuente del título */
                font-weight: bold;
                /* Negrita */
            }

            .swal2-confirm-button-custom {
                background-color: #3085d6;
                /* Color de fondo del botón de confirmación */
                color: #fff;
                /* Color del texto del botón de confirmación */
                border: none;
                /* Sin borde */
                border-radius: 5px;
                /* Bordes redondeados */
                padding: 10px 20px;
                /* Espaciado interno */
            }

            .swal2-cancel-button-custom {
                background-color: #d33;
                /* Color de fondo del botón de cancelación */
                color: #fff;
                /* Color del texto del botón de cancelación */
                border: none;
                /* Sin borde */
                border-radius: 5px;
                /* Bordes redondeados */
                padding: 10px 20px;
                /* Espaciado interno */
            }
        </style>
    @endsection
