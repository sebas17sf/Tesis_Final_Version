@extends('layouts.participante')

@section('title_component', 'Calificaciones de Estudiante')

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

    <div class="container" style="overflow-x: auto;">
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
                                    <th>Nombres</th>
                                    <th>Espe ID</th>
                                    <th>Carrera</th>
                                    <th>Departamento</th>
                                    <th>Cumple con las tareas planificadas. Sobre 10%</th>
                                    <th>Resultados Alcanzados. Sobre 10%</th>
                                    <th>Demuestra conocimientos en el área de práctica pre profesional. Sobre 10%</th>
                                    <th>Adaptabilidad e Integración al sistema de trabajo del proyecto. Sobre 10%</th>
                                    <th>Aplicación y manejo de destrezas y habilidades acordes al perfil profesional</th>
                                    <th>Demuestra capacidad de liderazgo y de trabajo en equipo. Sobre 10%</th>
                                    <th>Asiste puntualmente. Sobre 10%</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($estudiantes as $estudiante)
                                    <tr>
                                        <td class="wide-cell"
                                            style=" text-transform: uppercase; word-wrap: break-word; text-align: center;">
                                            {{ $estudiante->qpellidos }} {{ $estudiante->nombres }}</td>
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
                                                max="10" step="0.01" required><small class="form-text text-danger"
                                                style="display: none;"></small></td>
                                        <td><input type="hidden" name="estudiante_id[]"
                                                value="{{ $estudiante->estudianteId }}"></td>
                                    </tr>
                                @endforeach




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
        <!-- Estudiantes Calificados -->
        @if (!$estudiantesConNotas->isEmpty())
            
            <div class="contenedor_tabla">
                <div class="table-container mat-elevation-z8">

                    <div id="tablaDocentes">
                        <table class="mat-mdc-table">
                            <thead class="ng-star-inserted">
                                <tr class="mat-mdc-header-row mdc-data-table__header-row cdk-header-row ng-star-inserted">
                                    <th>Nombres</th>
                                    <th>Espe ID</th>
                                    <th>Carrera</th>
                                    <th>Departamento</th>
                                    <th>Cumple con las tareas planificadas. Sobre 10%</th>
                                    <th>Resultados Alcanzados. Sobre 10%</th>
                                    <th>Demuestra conocimientos en el área</th>
                                    <th>Adaptabilidad</th>
                                    <th>Aplicación de destrezas y habilidades</th>
                                    <th>Capacidad de liderazgo</th>
                                    <th>Asistencia puntual</th>
                                    <th>Informe de Servicio Comunitario</th>
                                    <th>Editar nota</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($estudiantesConNotas as $estudiante)
                                    <tr>
                                        <td class="wide-cell"
                                            style=" text-transform: uppercase; word-wrap: break-word; text-align: center;">
                                            {{ $estudiante->qpellidos }} {{ $estudiante->nombres }}</td>
                                        <td style=" text-transform: uppercase; word-wrap: break-word; text-align: center;">
                                            {{ $estudiante->espeId }}</td>
                                        <td style=" text-transform: uppercase; word-wrap: break-word; text-align: left;">
                                            {{ $estudiante->carrera }}</td>
                                        <td style=" text-transform: uppercase; word-wrap: break-word; text-align: center;">
                                            {{ $estudiante->departamento }}</td>
                                        <td>
                                            @foreach ($estudiante->notas as $nota)
                                                {{ $nota->tareas }}<br>
                                            @endforeach
                                        </td>
                                        <td>
                                            @foreach ($estudiante->notas as $nota)
                                                {{ $nota->resultadosAlcanzados }}<br>
                                            @endforeach
                                        </td>
                                        <td>
                                            @foreach ($estudiante->notas as $nota)
                                                {{ $nota->conocimientos }}<br>
                                            @endforeach
                                        </td>
                                        <td>
                                            @foreach ($estudiante->notas as $nota)
                                                {{ $nota->adaptabilidad }}<br>
                                            @endforeach
                                        </td>
                                        <td>
                                            @foreach ($estudiante->notas as $nota)
                                                {{ $nota->aplicacion }}<br>
                                            @endforeach
                                        </td>
                                        <td>
                                            @foreach ($estudiante->notas as $nota)
                                                {{ $nota->CapacidadLiderazgo }}<br>
                                            @endforeach
                                        </td>
                                        <td>
                                            @foreach ($estudiante->notas as $nota)
                                                {{ $nota->asistencia }}<br>
                                            @endforeach
                                        </td>
                                        <td>
                                            @foreach ($estudiante->notas as $nota)
                                                {{ $nota->informe }}<br>
                                            @endforeach
                                        </td>

                                        <td style="text-align: center;">
    <div class="btn-group shadow-0">
        <button class="button3 efects_button btn_editar3" onclick="openCard('cardEditNota{{ $estudiante->estudianteId }}');"> 
            <i class="bx bx-edit-alt"></i>
        </button>
    </div>


<!-- Card para editar la nota -->
<div class="draggable-card" id="cardEditNota{{ $estudiante->estudianteId }}" style="display: none;">
    <div class="card-header">
        <span class="card-title input_select1">Editar Nota de {{ $estudiante->apellidos }} {{ $estudiante->nombres }}</span>
        <button type="button" class="close" onclick="closeCard('cardEditNota{{ $estudiante->estudianteId }}')">&times;</button>
    </div>
    <div class="card-body">
        <form method="post" action="{{ route('actualizar-notas', ['id' => $estudiante->estudianteId]) }}">
            @csrf
            @method('PUT')

            <input type="hidden" name="estudiante_id" value="{{ $estudiante->estudianteId }}">

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="label" for="tareas">Cumple con las tareas planificadas. Sobre 10%</label>
                        <input type="number" name="tareas" class="form-control input input_select1" value="{{ optional($estudiante->notas->first())->tareas }}" min="1" max="10" step="0.01" required>
                        <small class="form-text text-danger" style="display: none;">El valor debe estar entre 0 y 10.</small>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="label" for="resultados_alcanzados">Resultados Alcanzados. Sobre 10%</label>
                        <input type="number" name="resultados_alcanzados" class="form-control input input_select1" value="{{ optional($estudiante->notas->first())->resultadosAlcanzados }}" min="1" max="10" step="0.01" required>
                        <small class="form-text text-danger" style="display: none;">El valor debe estar entre 0 y 10.</small>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label class="label" for="conocimientos_area">Demuestra conocimientos en el área de práctica pre profesional. Sobre 10%</label>
                <input type="number" name="conocimientos_area" class="form-control input input_select1" value="{{ optional($estudiante->notas->first())->conocimientos }}" min="1" max="10" step="0.01" required>
                <small class="form-text text-danger" style="display: none;">El valor debe estar entre 0 y 10.</small>
            </div>

            <div class="form-group">
                <label class="label" for="adaptabilidad">Adaptabilidad e Integración al sistema de trabajo del proyecto. Sobre 10%</label>
                <input type="number" name="adaptabilidad" class="form-control input input_select1" value="{{ optional($estudiante->notas->first())->adaptabilidad }}" min="1" max="10" step="0.01" required>
                <small class="form-text text-danger" style="display: none;">El valor debe estar entre 0 y 10.</small>
            </div>

            <div class="form-group">
                <label class="label" for="Aplicacion">Aplicación y manejo de destrezas y habilidades acordes al perfil profesional</label>
                <input type="number" name="Aplicacion" class="form-control input input_select1" value="{{ optional($estudiante->notas->first())->aplicacion }}" min="1" max="10" step="0.01" required>
                <small class="form-text text-danger" style="display: none;">El valor debe estar entre 0 y 10.</small>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="label" for="capacidad_liderazgo">Demuestra capacidad de liderazgo y de trabajo en equipo. Sobre 10%</label>
                        <input type="number" name="capacidad_liderazgo" class="form-control input input_select1" value="{{ optional($estudiante->notas->first())->CapacidadLiderazgo }}" min="1" max="10" step="0.01" required>
                        <small class="form-text text-danger" style="display: none;">El valor debe estar entre 0 y 10.</small>
                    </div>
                </div>
                <br>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="label" for="asistencia_puntual">Asiste puntualmente. Sobre 10%</label>
                        <input type="number" name="asistencia_puntual" class="form-control input input_select1" value="{{ optional($estudiante->notas->first())->asistencia }}" min="1" max="10" step="0.01" required>
                        <small class="form-text text-danger" style="display: none;">El valor debe estar entre 0 y 10.</small>
                    </div>
                </div>
            </div>
            <div class="card-footer d-flex justify-content-center align-items-center">
                <button type="submit" class="button input_select1">Guardar cambios</button>
            </div>
        </form>
    </div>
</div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
        @endif
    </div>


    </div>
    </div>
    <hr>

    <h4><b>Control de actividades de los estudiantes</b></h4>

    <div class="container mt-5">
        <div class="d-flex flex-wrap">
            @foreach ($actividadesEstudiantes->groupBy('EstudianteID') as $estudianteId => $actividades)
                @php
                    $estudiante = $actividades->first()->estudiante;
                @endphp
                <div class="card mr-3 mb-3">
                    <button class="button1" type="button" data-toggle="modal" data-target="#modalActividad{{ $estudianteId }}">
                        {{ $estudiante->apellidos }} {{ $estudiante->nombres }}
                    </button>
                    <!-- Modal -->
                    <div class="modal fade" id="modalActividad{{ $estudianteId }}" tabindex="-1" role="dialog"
                        aria-labelledby="modalActividad{{ $estudianteId }}Label" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalActividad{{ $estudianteId }}Label">
                                        {{ $estudiante->apellidos }} {{ $estudiante->nombres }}</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <h4><b>Actividades registradas del estudiante</b></h4>
                                    
                                    <div class="contenedor_tabla">
                    <div class="table-container mat-elevation-z8">

                        <div id="tablaDocentes">
                            <table class="mat-mdc-table">
                                <thead class="ng-star-inserted">
                                    <tr
                                        class="mat-mdc-header-row mdc-data-table__header-row cdk-header-row ng-star-inserted">
                                         <th>Fecha</th>
                                                <th>Actividades</th>
                                                <th>Numero de Horas</th>
                                                <th>Nombre de la Actividad</th>
                                                <th>Evidencias</th>
                                                <th>Hora de subida</th>
                                                <th>Ultima edicion</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($actividades as $actividad)
                                                <tr>
                                                    <td>{{ $actividad->fecha }}</td>
                                                    <td>{{ $actividad->actividades }}</td>
                                                    <td>{{ $actividad->numeroHoras }}</td>
                                                    <td>{{ $actividad->nombreActividad }}</td>
                                                    <td>
                                                        <img src="data:image/png;base64,{{ $actividad->evidencias }}"
                                                            alt="Evidencia" width="100" height="100">
                                                    </td>
                                                    <td>{{ $actividad->created_at }}</td>
                                                    <td>{{ $actividad->updated_at }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <head>

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
        document.getElementById(fileTextId).innerHTML = '<i class="fa-solid fa-arrow-up-from-bracket"></i> Haz clic aquí para subir el documento'; // Reset the text
        element.style.display = 'none'; // Ocultar la "X"
    }
    
    $(document).ready(function() {
        // Hacer que los cards sean draggable
        $('.draggable-card').draggable({
            handle: ".card-header",
            containment: "window"
        });
    });
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
        </style>
@endsection