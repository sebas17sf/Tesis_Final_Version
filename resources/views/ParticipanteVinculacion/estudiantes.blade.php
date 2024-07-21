@extends('layouts.participante')

@section('title_component', 'Panel calificaciones vinculación')

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

    <div class="mat-elevation-z8 container_general"> 
        <br>
        <h4><b>Estudiantes por calificar</b></h4>
        <hr>

        <!-- Formulario de calificación -->
        <form method="post" action="{{ route('guardar-notas') }}">
            @csrf
            <div class="contenedor_tabla">
                <div class="table-container mat-elevation-z8">

                    <div id="tablaDocentes">
                        <table class="mat-mdc-table">
                            <thead class="ng-star-inserted">
                                <tr class="mat-mdc-header-row mdc-data-table__header-row cdk-header-row ng-star-inserted">
                                    <th>Estudiante</th>
                                    <th>ESPE ID</th>
                                    <th>Carrera</th>
                                    <th>Departamento</th>
                                    <th>Cumple con las tareas planificadas. Sobre 10% </th>
                                    <th>Resualtados alcanzados. Sobre 10%</th>
                                    <th>Demuestra conocimientos en el área de práctica preprofesional. SOBRE 10%</th>
                                    <th>ADAPTABILIDAD E INTEGRACIÓN AL SISTEMA DE TRABAJO DEL PROYECTO. SOBRE 10%</th>
                                    <th>APLICACIÓN Y MANEJO DE DESTREZAS Y HABILIDADES ACORDES AL PERFIL PROFESIONAL</th>
                                    <th>DEMUESTRA CAPACIDAD DE LIDERAZGO Y DE TRABAJO EN EQUIPO. SOBRE 10%</th>
                                    <th>Asiste puntualmente. Sobre 10%</th>
                                </tr>
                            </thead>
                            <tbody class="mdc-data-table__content ng-star-inserted">
                                @if ($estudiantes->isEmpty())
                                    <tr>
                                    <td class="noExisteRegistro1" style="font-size: 16px !important;"colspan="10">No hay estudiantes por calificar.</td>
                                    </tr>
                                    @else
                                @foreach ($estudiantes as $estudiante)
                                    <tr>
                                        <td class="wide-cell"
                                            style=" text-transform: uppercase; word-wrap: break-word; text-align: center;">
                                            {{ $estudiante->apellidos }} {{ $estudiante->nombres }}</td>
                                        <td style=" text-transform: uppercase; word-wrap: break-word; text-align: center;">
                                            {{ $estudiante->espeId }}</td>
                                        <td style=" text-transform: uppercase; word-wrap: break-word; text-align: left;">
                                            {{ $estudiante->carrera }}</td>
                                        <td style=" text-transform: uppercase; word-wrap: break-word; text-align: center;">
                                            {{ $estudiante->departamento }}</td>
                                        <td><input type="number" name="cumple_tareas[]" value="" min="1"
                                                max="10" step="0.01" required><small class="form-text text-danger"
                                                style="display: none;"></small></td>
                                        <td><input type="number" name="resultados_alcanzados[]" value=""
                                                min="1" max="10" step="0.01" required><small
                                                class="form-text text-danger" style="display: none;"></small></td>
                                        <td><input type="number" name="conocimientos_area[]" value="" min="1"
                                                max="10" step="0.01" required><small class="form-text text-danger"
                                                style="display: none;"></small></td>
                                        <td><input type="number" name="adaptabilidad[]" value="" min="1"
                                                max="10" step="0.01" required><small class="form-text text-danger"
                                                style="display: none;"></small></td>
                                        <td><input type="number" name="Aplicacion[]" value="" min="1"
                                                max="10" step="0.01" required><small class="form-text text-danger"
                                                style="display: none;"></small></td>
                                        <td><input type="number" name="capacidad_liderazgo[]" value="" min="1"
                                                max="10" step="0.01" required><small class="form-text text-danger"
                                                style="display: none;"></small></td>
                                        <td><input type="number" name="asistencia_puntual[]" value="" min="1"
                                                max="10" step="0.01" required><small class="form-text  text-danger"
                                                style="display: none;"></small></td>
                                        <td><input type="hidden" name="estudiante_id[]"
                                                value="{{ $estudiante->estudianteId }}"></td>
                                    </tr>
                                @endforeach
@endif



                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <br>
            <button type="submit" class="button1 btn_4">Guardar Calificaciones</button>
        </form>
        <hr>
        <h4><b>Estudiantes Calificados</b></h4>
<hr>
@if (!$estudiantesConNotas->isEmpty())
    <div class="contenedor_tabla">
        <div class="table-container mat-elevation-z8">
            <div id="tablaDocentes">
                <table class="mat-mdc-table">
                    <thead class="ng-star-inserted">
                        <tr class="mat-mdc-header-row mdc-data-table__header-row cdk-header-row ng-star-inserted">
                            <th class="tamanio4">Estudiante</th>
                            <th class="tamanio4">Espe ID</th>
                            <th class="tamanio4">Carrera</th>
                            <th class="tamanio4">Departamento</th>
                            <th>Cumple con las tareas planificadas. Sobre 10%</th>
                            <th>Resultados Alcanzados. Sobre 10%</th>
                            <th>Demuestra conocimientos en el área</th>
                            <th>Adaptabilidad</th>
                            <th>Aplicación de destrezas y habilidades</th>
                            <th>Capacidad de liderazgo</th>
                            <th>Asistencia puntual</th>
                            <th>Informe de Servicio Comunitario</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="mdc-data-table__content ng-star-inserted">
                        @foreach ($estudiantesConNotas as $estudiante)
                            <tr id="row{{ $estudiante->estudianteId }}">
                                <td class="wide-cell" style="text-transform: uppercase; word-wrap: break-word; text-align: center;">
                                    {{ $estudiante->apellidos }} {{ $estudiante->nombres }}
                                </td>
                                <td style="text-transform: uppercase; word-wrap: break-word; text-align: center;">
                                    {{ $estudiante->espeId }}
                                </td>
                                <td style="text-transform: uppercase; word-wrap: break-word; text-align: left;">
                                    {{ $estudiante->carrera }}
                                </td>
                                <td style="text-transform: uppercase; word-wrap: break-word; text-align: center;">
                                    {{ $estudiante->departamento }}
                                </td>
                                <td style="text-transform: uppercase; word-wrap: break-word; text-align: center;">
                                    <input type="number" name="tareas" value="{{ $estudiante->notas->first()->tareas }}" min="1" max="10" step="0.01" disabled>
                                </td>
                                <td style="text-transform: uppercase; word-wrap: break-word; text-align: center;">
                                    <input type="number" name="resultados_alcanzados" value="{{ $estudiante->notas->first()->resultadosAlcanzados }}" min="1" max="10" step="0.01" disabled>
                                </td>
                                <td style="text-transform: uppercase; word-wrap: break-word; text-align: center;">
                                    <input type="number" name="conocimientos_area" value="{{ $estudiante->notas->first()->conocimientos }}" min="1" max="10" step="0.01" disabled>
                                </td>
                                <td style="text-transform: uppercase; word-wrap: break-word; text-align: center;">
                                    <input type="number" name="adaptabilidad" value="{{ $estudiante->notas->first()->adaptabilidad }}" min="1" max="10" step="0.01" disabled>
                                </td>
                                <td style="text-transform: uppercase; word-wrap: break-word; text-align: center;">
                                    <input type="number" name="aplicacion" value="{{ $estudiante->notas->first()->aplicacion }}" min="1" max="10" step="0.01" disabled>
                                </td>
                                <td style="text-transform: uppercase; word-wrap: break-word; text-align: center;">
                                    <input type="number" name="capacidad_liderazgo" value="{{ $estudiante->notas->first()->CapacidadLiderazgo }}" min="1" max="10" step="0.01" disabled>
                                </td>
                                <td style="text-transform: uppercase; word-wrap: break-word; text-align: center;">
                                    <input type="number" name="asistencia_puntual" value="{{ $estudiante->notas->first()->asistencia }}" min="1" max="10" step="0.01" disabled>
                                </td>
                                <td style="text-transform: uppercase; word-wrap: break-word; text-align: center;">
                                    {{ $estudiante->notas->first()->informe }}
                                </td>
                                <td style="text-align: center;">
                                    <div class="btn-group shadow-0">
                                        <button class="button3 efects_button btn_editar3" onclick="editRow({{ $estudiante->estudianteId }})" style="margin-right: 5px;">
                                            <i class="bx bx-edit-alt"></i>
                                        </button>
                                        <button class="button3 efects_button btn_save" onclick="saveRow({{ $estudiante->estudianteId }})" style="display: none; margin-right: 5px;">
                                            <i class="fa-solid fa-save"></i>
                                        </button>
                                        <button class="button3 efects_button btn_eliminar3" onclick="openCard('tablaActividad{{ $estudiante->estudianteId }}');">
                                            <i class="fa-solid fa-eye"></i>
                                        </button>
                                    </div>
                                

                            <!-- Card para mostrar las actividades del estudiante -->
                            <div class="draggable-card1_1" style="display: none;" id="tablaActividad{{ $estudiante->estudianteId }}">
                                <div class="card-header">
                                    <span class="card-title">Actividades del Estudiante {{ $estudiante->apellidos }} {{ $estudiante->nombres }}</span>
                                    <button type="button" class="close" onclick="closeCard('tablaActividad{{ $estudiante->estudianteId }}')"><i class="fa-thin fa-xmark"></i></button>
                                </div>
                                <div class="contenedor_tabla">
                                    <div class="table-container mat-elevation-z8">
                                        <div id="tablaActivida">
                                            <table class="mat-mdc-table">
                                                <thead class="ng-star-inserted">
                                                    <tr class="mat-mdc-header-row mdc-data-table__header-row cdk-header-row ng-star-inserted">
                                                        <th>FECHA</th>
                                                        <th>ACTIVIDADES</th>
                                                        <th>HORA</th>
                                                        <th>NOMBRE DE LA ACTIVIDAD</th>
                                                        <th>EVIDENCIA</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($estudiante->actividades as $actividad)
                                                        <tr>
                                                            <td style="text-transform: uppercase; word-wrap: break-word; text-align: center;">
                                                                {{ $actividad->fecha }}
                                                            </td>
                                                            <td style="text-transform: uppercase; word-wrap: break-word; text-align: justify; padding: 5px 8px;">
                                                                {{ $actividad->actividades }}
                                                            </td>
                                                            <td style="text-transform: uppercase; word-wrap: break-word; text-align: center;">
                                                                {{ $actividad->numeroHoras }}
                                                            </td>
                                                            <td style="text-transform: uppercase; word-wrap: break-word; text-align: center;">
                                                                {{ $actividad->nombreActividad }}
                                                            </td>
                                                            <td style="text-transform: uppercase; word-wrap: break-word; text-align: center;">
                                                                <img width="100px" src="data:image/jpeg;base64,{{ $actividad->evidencias }}" alt="Evidencia" />
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endif







        <head>

            <link rel="stylesheet" href="https://cdn.ckeditor.com/4.16.1/standard/ckeditor.css">
            <script src="https://cdn.ckeditor.com/4.16.1/standard/ckeditor.js"></script>
            <script src="{{ asset('js/plantilla/main.js') }}" type="module"></script>
            <script src="js\admin\acciones.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
            <script src="https://code.jquery.com/ui/1.13.0/jquery-ui.min.js"></script>
            <script src="{{ asset('js/plantilla/main.js') }}" type="module"></script>
            <script src="js\admin\index.js"></script>
            <script src="{{ asset('js/ParticipanteDirectorVinculacion/notas.js') }}" type="module"></script>



            <script>
                function openCard(cardId) {
                    document.getElementById(cardId).style.display = 'block';
                }

                function closeCard(cardId) {
                    document.getElementById(cardId).style.display = 'none';
                }

                function displayFileName(input, fileTextId) {
                    const fileName = input.files[0].name;
                    document.getElementById(fileTextId).textContent = fileName;
                    input.nextElementSibling.style.display = 'inline'; // Mostrar la "X"
                }

                function removeFile(element) {
                    const input = element.previousElementSibling;
                    const fileTextId = input.id.replace('file', 'fileText');
                    input.value = ""; // Clear the input
                    document.getElementById(fileTextId).innerHTML =
                        '<i class="fa-solid fa-arrow-up-from-bracket"></i> Haz clic aquí para subir el documento'; // Reset the text
                    element.style.display = 'none'; // Ocultar la "X"
                }

                $(document).ready(function() {
                    // Hacer que los cards sean draggable
                    $('.draggable-card').draggable({
                        handle: ".card-header",
                        containment: "window"
                    });
                });

                $(document).ready(function() {
                    // Hacer que los cards sean draggable
                    $('.draggable-card1_1').draggable({
                        handle: ".card-header",
                        containment: "window"
                    });
                });

                function closeAlert(alertId) {
                    const alert = document.getElementById(alertId);
                    alert.style.display = 'none';
                }
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
    let data = {};
    for (let i = 0; i < inputs.length; i++) {
        data[inputs[i].name] = inputs[i].value;
        inputs[i].disabled = true;
    }

    // Aquí puedes hacer una solicitud AJAX para enviar los datos actualizados al servidor
    fetch('/ruta/para/actualizar', {
        method: 'PUT',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({
            estudiante_id: estudianteId,
            ...data
        })
    }).then(response => {
        if (response.ok) {
            return response.json();
        } else {
            throw new Error('Error al actualizar las notas');
        }
    }).then(data => {
        // Manejar la respuesta exitosa aquí
        console.log('Notas actualizadas:', data);
    }).catch(error => {
        console.error('Error:', error);
    });

    row.querySelector('.btn_editar3').style.display = 'inline';
    row.querySelector('.btn_save').style.display = 'none';
}

function openCard(cardId) {
    document.getElementById(cardId).style.display = 'block';
}

function closeCard(cardId) {
    document.getElementById(cardId).style.display = 'none';
}

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
                    
    padding: 0 10px 0 10px !important;
}
                
            </style>
        @endsection
