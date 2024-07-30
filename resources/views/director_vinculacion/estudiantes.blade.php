@extends('layouts.directorVinculacion')

@section('title', 'Panel Estudiante')

@section('title_component', 'Panel Estudiantes')

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

    <div class="contenedor_registro_genero">
        <div class="mat-elevation-z8 contenedor_general">
            <h4><b>Estudiantes por calificar</b></h4>
            <h4>Actualizar Informe de Servicio Comunitario</h4>
            <form method="post" action="{{ route('director_vinculacion.actualizarInforme') }}">
                @csrf
                <div class="contenedor_tabla">
                    <div class="table-container mat-elevation-z8">
                        <div id="tablaProyectos">
                            <table class="mat-mdc-table">
                                <thead class="ng-star-inserted">
                                    <tr
                                        class="mat-mdc-header-row mdc-data-table__header-row cdk-header-row ng-star-inserted">
                                        <th class="tamanio1">ESTUDIANTE</th>
                                        <th>ESPE ID</th>
                                        <th>CARRERA</th>
                                        <th>DEPARTAMENTO</th>
                                        <th>INFORME DE SERVICIO COMUNITARIO 30%</th>
                                    </tr>
                                </thead>
                                <tbody class="mdc-data-table__content ng-star-inserted">
                                    @if ($estudiantesConNotasPendientes->isEmpty())
                                        <tr style="text-align:center">
                                            <td class="noExisteRegistro1" style="font-size: 16px !important;" colspan="5">
                                                El docente participante aún no ha calificado a los estudiantes.
                                            </td>
                                        </tr>
                                    @else
                                        @foreach ($estudiantesConNotasPendientes as $estudiante)
                                            <tr>
                                                <td class="wide-cell" style="text-transform: uppercase; word-wrap: break-word; text-align: left;">
                                                    {{ $estudiante->apellidos }} {{ $estudiante->nombres }}
                                                </td>
                                                <td style="text-transform: uppercase; word-wrap: break-word; text-align: center;">
                                                    {{ $estudiante->espeId }}
                                                </td>
                                                <td class="wide-cell" style="text-transform: uppercase; word-wrap: break-word; text-align: center;">
                                                    {{ $estudiante->carrera }}
                                                </td>
                                                <td style="text-transform: uppercase; word-wrap: break-word; text-align: center;">
                                                    {{ $estudiante->departamento }}
                                                </td>
                                                <td style="text-transform: uppercase; word-wrap: break-word; text-align: center;">
                                                    <input type="hidden" class="input input_select2" name="estudiante_id[]" value="{{ $estudiante->estudianteId }}">
                                                    <input type="text" class="input" name="informe_servicio[]" value="{{ $estudiante->notas->first()->informe === 'Pendiente' ? '' : $estudiante->notas->first()->informe }}" required>
                                                    <small class="form-text text-danger" style="display: none;"></small>
                                                </td>

                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <br>
                <button type="submit" class="button1">Guardar calificación</button>
                <br>
            </form>
        </div>
        <br>
        <div class="mat-elevation-z8 contenedor_general">
            <h4><b>Estudiantes Calificados</b></h4>
            <hr>
            <div class="contenedor_tabla">
                <div class="table-container mat-elevation-z8">
                    <div id="tablaProyectos">
                        <table class="mat-mdc-table">
                            <thead class="ng-star-inserted">
                                <tr class="mat-mdc-header-row mdc-data-table__header-row cdk-header-row ng-star-inserted">
                                    <th class="tamanio1">ESTUDIANTE</th>
                                    <th>ESPE ID</th>
                                    <th class="tamanio4">CARRERA</th>
                                    <th class="tamanio3">DEPARTAMENTO</th>
                                    <th>TAREAS</th>
                                    <th>RESULTADOS ALCANZADOS</th>
                                    <th>CONOCIMIENTOS EN EL ÁREA</th>
                                    <th>ADAPTABILIDAD</th>
                                    <th>APLICACION DE DESTREZAS Y HABILIDADES</th>
                                    <th>CAPACIDAD DE LIDERAZGO</th>
                                    <th>ASISTENCIA</th>
                                    <th>INFORME DE SERVICIO COMUNITARIO</th>
                                    <th>NOTA FINAL</th>
                                    <th>ESTADO</th>
                                    <th>EDITAR NOTAS</th>
                                </tr>
                            </thead>
                            <tbody class="mdc-data-table__content ng-star-inserted">
                                @if ($estudiantesCalificados->isEmpty())
                                    <tr style="text-align:center">
                                        <td class="noExisteRegistro1" style="font-size: 16px !important;" colspan="15">
                                            No hay estudiantes calificados en este momento.
                                        </td>
                                    </tr>
                                @else
                                    @foreach ($estudiantesCalificados as $estudiante)
                                        <tr id="row{{ $estudiante->estudianteId }}">
                                            <td class="wide-cell" style="text-transform: uppercase; word-wrap: break-word; text-align: left;">
                                                {{ $estudiante->apellidos }} {{ $estudiante->nombres }}
                                            </td>
                                            <td>{{ $estudiante->espeId }}</td>
                                            <td class="wide-cell" style="text-transform: uppercase; word-wrap: break-word; text-align: center;">
                                                {{ $estudiante->carrera }}
                                            </td>
                                            <td style="text-transform: uppercase; word-wrap: break-word; text-align: center;">
                                                {{ $estudiante->departamento }}
                                            </td>
                                            <td style="text-align: center;">
                                                @foreach ($estudiante->notas as $nota)
                                                    {{ $nota->tareas }}<br>
                                                @endforeach
                                            </td>
                                            <td style="text-align: center;">
                                                @foreach ($estudiante->notas as $nota)
                                                    {{ $nota->resultadosAlcanzados }}<br>
                                                @endforeach
                                            </td>
                                            <td style="text-align: center;">
                                                @foreach ($estudiante->notas as $nota)
                                                    {{ $nota->conocimientos }}<br>
                                                @endforeach
                                            </td>
                                            <td style="text-align: center;">
                                                @foreach ($estudiante->notas as $nota)
                                                    {{ $nota->adaptabilidad }}<br>
                                                @endforeach
                                            </td>
                                            <td style="text-align: center;">
                                                @foreach ($estudiante->notas as $nota)
                                                    {{ $nota->aplicacion }}<br>
                                                @endforeach
                                            </td>
                                            <td style="text-align: center;">
                                                @foreach ($estudiante->notas as $nota)
                                                    {{ $nota->CapacidadLiderazgo }}<br>
                                                @endforeach
                                            </td>
                                            <td style="text-align: center;">
                                                @foreach ($estudiante->notas as $nota)
                                                    {{ $nota->asistencia }}<br>
                                                @endforeach
                                            </td>
                                            <td style="text-align: center;">
                                                <input type="text" class="input" name="nota_servicio" value="{{ $estudiante->notas->first()->informe ?? '' }}" disabled>
                                            </td>
                                            <td style="text-align: center;">
                                                @php
                                                    $notaTotal = $estudiante->notas->sum(function ($nota) {
                                                        return floatval($nota->tareas) +
                                                            floatval($nota->resultadosAlcanzados) +
                                                            floatval($nota->conocimientos) +
                                                            floatval($nota->adaptabilidad) +
                                                            floatval($nota->aplicacion) +
                                                            floatval($nota->CapacidadLiderazgo) +
                                                            floatval($nota->asistencia) +
                                                            floatval($nota->informe ?? 0);
                                                    });
                                                    $notaFinal = ($notaTotal * 20) / 100;
                                                @endphp
                                                {{ $notaFinal }}
                                            </td>
                                            <td style="text-align: center;">
                                                @if ($notaFinal <= 16)
                                                    <span class="badge badge-danger">REPROBADO</span>
                                                @else
                                                    <span class="badge badge-success">APROBADO</span>
                                                @endif
                                            </td>
                                            <td style="text-align: center;">
                                                <button class="button3 efects_button btn_editar3" onclick="editRow({{ $estudiante->estudianteId }})">
                                                    <i class="bx bx-edit-alt"></i>
                                                </button>
                                                <button class="button3 efects_button btn_save" onclick="saveRow({{ $estudiante->estudianteId }})" style="display: none;">
                                                    <i class="fa-solid fa-save"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <form id="hidden-form" method="POST" action="">
        @csrf
        @method('PUT')
        <input type="hidden" name="estudiante_id" id="hidden-estudiante_id">
        <input type="hidden" name="nota_servicio" id="hidden-nota_servicio">
    </form>

    <script src="{{ asset('js/ParticipanteDirectorVinculacion/notas.js') }}"></script>
    <link rel="stylesheet" href="https://cdn.ckeditor.com/4.16.1/standard/ckeditor.css">
    <script src="https://cdn.ckeditor.com/4.16.1/standard/ckeditor.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('js/admin/acciones.js') }}"></script>

    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            const alertElement = document.querySelector('.contenedor_alerta');
            setTimeout(() => {
                if (alertElement) {
                    alertElement.style.display = 'none';
                }
            }, 2000);
        });

        function openCard(cardId) {
            document.getElementById(cardId).style.display = 'block';
        }

        function closeCard(cardId) {
            document.getElementById(cardId).style.display = 'none';
        }

        function editRow(estudianteId) {
            let row = document.getElementById('row' + estudianteId);
            let inputs = row.getElementsByTagName('input');
            for (let i = 0; i < inputs.length; i++) {
                inputs[i].disabled = false;
            }
            row.querySelector('.btn_editar3').style.display = 'none';
            row.querySelector('.btn_save').style.display = 'inline';
        }

        function saveRow(estudianteId) {
            let row = document.getElementById('row' + estudianteId);
            let inputs = row.getElementsByTagName('input');
            let hiddenForm = document.getElementById('hidden-form');

            hiddenForm.action = `/director-vinculacion/actualizar-nota/${estudianteId}`;

            document.getElementById('hidden-estudiante_id').value = estudianteId;
            document.getElementById('hidden-nota_servicio').value = row.querySelector('input[name="nota_servicio"]').value;

            hiddenForm.submit();

            row.querySelector('.btn_editar3').style.display = 'inline';
            row.querySelector('.btn_save').style.display = 'none';
        }
    </script>

    <style>
        .contenedor_tabla .table-container table td {
            width: 200px;
            min-width: 1px !important;
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
