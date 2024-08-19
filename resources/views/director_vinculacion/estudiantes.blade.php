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

        <h4><b>Estudiantes por calificar informe</b></h4>
        <hr>
        <form id="formInformeServicio" method="post" action="{{ route('director_vinculacion.actualizarInforme') }}">
            @csrf
            <div class="contenedor_tabla">
                <div class="table-container mat-elevation-z8">
                    <div id="tablaProyectos">
                        <table class="mat-mdc-table">
                            <thead class="ng-star-inserted">
                                <tr class="mat-mdc-header-row mdc-data-table__header-row cdk-header-row ng-star-inserted">
                                    <th style="width: 30px !important;">N°</th>
                                    <th style="min-width: 90px !important; text-transform: uppercase; font-size:.8em;">
                                        ESTUDIANTE</th>
                                    <th style="min-width: 90px !important; text-transform: uppercase; font-size:.8em;">ESPE
                                        ID</th>
                                    <th style="min-width: 90px !important; text-transform: uppercase; font-size:.8em;">
                                        CARRERA</th>
                                    <th style="min-width: 90px !important; text-transform: uppercase; font-size:.8em;">
                                        DEPARTAMENTO</th>
                                    <th style="min-width: 90px !important; text-transform: uppercase; font-size:.8em;">
                                        INFORME DE SERVICIO COMUNITARIO 30%</th>
                                </tr>
                            </thead>
                            <tbody class="mdc-data-table__content ng-star-inserted">
                                @if ($estudiantesConNotasPendientes->isEmpty())
                                    <tr style="text-align:center">
                                        <td class="noExisteRegistro1" style="font-size: 16px !important;" colspan="6">
                                            El docente participante aún no ha calificado a los estudiantes.
                                        </td>
                                    </tr>
                                @else
                                    @foreach ($estudiantesConNotasPendientes as $estudiante)
                                        <tr>
                                            <td
                                                style="text-transform: uppercase; width: 10px !important; word-wrap: break-word; text-align: center;">
                                                {{ $loop->iteration }}
                                            </td>
                                            <td class="wide-cell"
                                                style="text-transform: uppercase; font-size: .7em; word-wrap: break-word; text-align: left;">
                                                {{ $estudiante->apellidos }} {{ $estudiante->nombres }}
                                            </td>
                                            <td
                                                style="text-transform: uppercase; word-wrap: break-word; font-size: .7em; text-align: center;">
                                                {{ $estudiante->espeId }}
                                            </td>
                                            <td
                                                style="text-transform: uppercase; font-size: .7em; word-wrap: break-word; text-align: center;">
                                                {{ $estudiante->carrera }}
                                            </td>
                                            <td
                                                style="text-transform: uppercase; font-size: .7em; word-wrap: break-word; text-align: center;">
                                                {{ $estudiante->departamento }}
                                            </td>
                                            <td
                                                style="text-transform: uppercase; font-size: .6em; word-wrap: break-word; text-align: center;">
                                                <input type="hidden" class="form-control input input_select3"
                                                    name="estudiante_id[]" value="{{ $estudiante->estudianteId }}">
                                                <center>
                                                    <input style="text-align: center;" type="number"
                                                        class="form-control input input_select_3 informe-input"
                                                        name="informe_servicio[]"
                                                        value="{{ $estudiante->notas->first()->informe === 'Pendiente' ? '' : $estudiante->notas->first()->informe }}"
                                                        required>
                                                    <small class="form-text text-danger error-message"
                                                        style="display: none;">El valor debe estar entre 0 y 30</small>
                                                </center>
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

    <h4><b>Estudiantes Calificados</b></h4>
<hr>
<div class="contenedor_tabla">
    <div class="table-container mat-elevation-z8">
        <div id="tablaProyectos">
            <table class="mat-mdc-table">
                <thead class="ng-star-inserted">
                    <tr class="mat-mdc-header-row mdc-data-table__header-row cdk-header-row ng-star-inserted">
                        <th style="min-width: 30px !important; text-transform: uppercase; font-size:.8em;">N°</th>
                        <th style="min-width: 100px !important; text-transform: uppercase; font-size:.8em;">ESTUDIANTE</th>
                        <th style="min-width: 100px !important; text-transform: uppercase; font-size:.8em;">ESPE ID</th>
                        <th style="min-width: 100px !important; text-transform: uppercase; font-size:.8em;">CARRERA</th>
                        <th style="min-width: 100px !important; text-transform: uppercase; font-size:.8em;">DEPARTAMENTO</th>
                        <th style="min-width: 90px !important; text-transform: uppercase; font-size:.8em;">TAREAS</th>
                        <th style="min-width: 120px !important; text-transform: uppercase; font-size:.8em;">RESULTADOS ALCANZADOS</th>
                        <th style="min-width: 120px !important; text-transform: uppercase; font-size:.8em;">CONOCIMIENTOS EN EL ÁREA</th>
                        <th style="min-width: 140px !important; text-transform: uppercase; font-size:.8em;">ADAPTABILIDAD</th>
                        <th style="min-width: 130px !important; text-transform: uppercase; font-size:.8em;">APLICACIÓN DE DESTREZAS Y HABILIDADES</th>
                        <th style="min-width: 100px !important; text-transform: uppercase; font-size:.8em;">CAPACIDAD DE LIDERAZGO</th>
                        <th style="min-width: 100px !important; text-transform: uppercase; font-size:.8em;">ASISTENCIA</th>
                        <th style="min-width: 100px !important; text-transform: uppercase; font-size:.8em;">INFORME DE SERVICIO COMUNITARIO</th>
                        <th style="min-width: 100px !important; text-transform: uppercase; font-size:.8em;">NOTA FINAL</th>
                        <th style="min-width: 100px !important; text-transform: uppercase; font-size:.8em;">ESTADO</th>
                        <th style="min-width: 100px !important; text-transform: uppercase; font-size:.8em;">EDITAR NOTAS</th>
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
                                <td style="text-transform: uppercase; font-size: .7em; min-width: 30px !important; word-wrap: break-word; text-align: center;">
                                    {{ $loop->iteration }}
                                </td>
                                <td class="wide-cell" style="text-transform: uppercase; font-size: .7em; word-wrap: break-word; text-align: left;">
                                    {{ $estudiante->apellidos }} {{ $estudiante->nombres }}
                                </td>
                                <td style="text-transform: uppercase; word-wrap: break-word; font-size: .7em; text-align: center;">
                                    {{ $estudiante->espeId }}
                                </td>
                                <td class="wide-cell" style="text-transform: uppercase; font-size: .7em; word-wrap: break-word; text-align: center;">
                                    {{ $estudiante->carrera }}
                                </td>
                                <td style="text-transform: uppercase; word-wrap: break-word; font-size: .7em; text-align: center;">
                                    {{ $estudiante->departamento->departamento }}
                                </td>
                                <td style="text-align: center; font-size: .7em;">
                                    @foreach ($estudiante->notas as $nota)
                                        {{ $nota->tareas }}<br>
                                    @endforeach
                                </td>
                                <td style="text-align: center; font-size: .7em;">
                                    @foreach ($estudiante->notas as $nota)
                                        {{ $nota->resultadosAlcanzados }}<br>
                                    @endforeach
                                </td>
                                <td style="text-align: center; font-size: .7em;">
                                    @foreach ($estudiante->notas as $nota)
                                        {{ $nota->conocimientos }}<br>
                                    @endforeach
                                </td>
                                <td style="text-align: center; font-size: .7em;">
                                    @foreach ($estudiante->notas as $nota)
                                        {{ $nota->adaptabilidad }}<br>
                                    @endforeach
                                </td>
                                <td style="text-align: center; font-size: .7em;">
                                    @foreach ($estudiante->notas as $nota)
                                        {{ $nota->aplicacion }}<br>
                                    @endforeach
                                </td>
                                <td style="text-align: center; font-size: .7em;">
                                    @foreach ($estudiante->notas as $nota)
                                        {{ $nota->CapacidadLiderazgo }}<br>
                                    @endforeach
                                </td>
                                <td style="text-align: center; font-size: .7em;">
                                    @foreach ($estudiante->notas as $nota)
                                        {{ $nota->asistencia }}<br>
                                    @endforeach
                                </td>
                                <td style="text-align: center; font-size: .7em;">
                                    <input style="text-align: center; font-size: .7em;" type="number" class="form-control input input_select3 informe-input-calificados" name="nota_servicio" value="{{ $estudiante->notas->first()->informe ?? '' }}" required>
                                    <small class="form-text text-danger error-message" style="display: none;">El valor debe estar entre 0 y 30</small>
                                </td>
                                <td style="text-align: center; font-size: .7em; min-width: 60px !important;">
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
                                <td style="text-align: center; font-size: .7em; min-width: 50px !important;">
                                    @if ($notaFinal <= 16)
                                        <span class="badge badge-danger">REPROBADO</span>
                                    @else
                                        <span class="badge badge-success">APROBADO</span>
                                    @endif
                                </td>
                                <td style="text-align: center; center; font-size: .7em; min-width: 70px !important;">
                                    <center>
                                        <button class="button3 efects_button btn_editar3" onclick="editRow({{ $estudiante->estudianteId }})">
                                            <i class="bx bx-edit-alt"></i>
                                        </button>
                                    </center>
                                    <center>
                                        <button class="button3 efects_button btn_save" onclick="saveRow({{ $estudiante->estudianteId }})" style="display: none;">
                                            <i class="fa-solid fa-save"></i>
                                        </button>
                                    </center>
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

    <form id="hidden-form" method="POST" action="">
        @csrf
        @method('PUT')
        <input type="hidden" name="estudiante_id" id="hidden-estudiante_id">
        <input type="hidden" name="nota_servicio" id="hidden-nota_servicio">
    </form>


    <link rel="stylesheet" href="https://cdn.ckeditor.com/4.16.1/standard/ckeditor.css">
    <script src="https://cdn.ckeditor.com/4.16.1/standard/ckeditor.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('js/admin/acciones.js') }}"></script>
    <script src="{{ asset('js/ParticipanteDirectorVinculacion/notas.js') }}"></script>


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
    </script>

    <script>
        // Function to validate individual inputs for the informe
        function validateInformeInput(input) {
            const value = parseFloat(input.value);
            const errorMessage = input.nextElementSibling;
            if (value < 0 || value > 30 || isNaN(value)) {
                input.style.borderColor = 'red';
                errorMessage.innerText = 'El valor debe estar entre 0 y 30.';
                errorMessage.style.display = 'block';
                return false;
            } else {
                input.style.borderColor = '';
                errorMessage.innerText = '';
                errorMessage.style.display = 'none';
                return true;
            }
        }

        // Add event listeners for real-time validation on the informe inputs
        document.querySelectorAll('.informe-input').forEach(input => {
            input.addEventListener('input', function() {
                validateInformeInput(input);
            });
        });

        // Form submission validation
        document.getElementById('formInformeServicio').addEventListener('submit', function(event) {
            const inputs = this.querySelectorAll('.informe-input');
            let isValid = true;

            inputs.forEach(input => {
                if (!validateInformeInput(input)) {
                    isValid = false;
                }
            });

            if (!isValid) {
                event.preventDefault(); // Prevent form submission if there are errors
            }
        });
    </script>

    <script>
        // Function to validate individual inputs for the informe
        function validateCalificadosInput(input) {
            const value = parseFloat(input.value);
            const errorMessage = input.nextElementSibling;
            if (value < 0 || value > 30 || isNaN(value)) {
                input.style.borderColor = 'red';
                errorMessage.innerText = 'El valor debe estar entre 0 y 30.';
                errorMessage.style.display = 'block';
                return false;
            } else {
                input.style.borderColor = '';
                errorMessage.innerText = '';
                errorMessage.style.display = 'none';
                return true;
            }
        }

        // Add event listeners for real-time validation on the "Estudiantes Calificados" inputs
        document.querySelectorAll('.informe-input-calificados').forEach(input => {
            input.addEventListener('input', function() {
                validateCalificadosInput(input);
            });
        });

        function saveRow(estudianteId) {
            let row = document.getElementById('row' + estudianteId);
            let input = row.querySelector('input[name="nota_servicio"]');
            let hiddenForm = document.getElementById('hidden-form');

            // Validate the input
            if (!validateCalificadosInput(input)) {
                return; // Do not submit if validation fails
            }

            hiddenForm.action = `/director-vinculacion/actualizar-nota/${estudianteId}`;

            document.getElementById('hidden-estudiante_id').value = estudianteId;
            document.getElementById('hidden-nota_servicio').value = input.value;

            hiddenForm.submit();

            row.querySelector('.btn_editar3').style.display = 'inline';
            row.querySelector('.btn_save').style.display = 'none';
        }
    </script>

    <style>
        hr {
            margin-top: 0.5rem !important;
            margin-bottom: 0.8rem !important;
            border: 0;
            border-top: 1px solid rgba(0, 0, 0, .1);
        }
    
@endsection
