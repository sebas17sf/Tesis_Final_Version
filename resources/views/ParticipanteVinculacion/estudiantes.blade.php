@extends('layouts.participante')

@section('title_component', 'Calificaciones de Estudiante')

@section('content')
    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Éxito',
                text: '{{ session('success') }}',
                confirmButtonText: 'Ok'
            });
        </script>
    @endif

    @if (session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: '{{ session('error') }}',
                confirmButtonText: 'Ok'
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

        <!-- Estudiantes Calificados -->
        @if (!$estudiantesConNotas->isEmpty())
            <h4>Estudiantes Calificados</h4>
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

                                        <td>
                                            <button class="btn btn-sm btn-secondary" data-toggle="modal"
                                                data-target="#modalEditarNota{{ $estudiante->estudianteId }}">Editar</button>

                                            <!-- Modal -->
                                            <div class="modal fade" id="modalEditarNota{{ $estudiante->estudianteId }}"
                                                tabindex="-1" role="dialog"
                                                aria-labelledby="modalEditarNota{{ $estudiante->EstudianteID }}Label"
                                                aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <form method="post"
                                                            action="{{ route('actualizar-notas', ['id' => $estudiante->estudianteId]) }}">
                                                            @csrf
                                                            @method('PUT')

                                                            <div class="modal-header">
                                                                <h5 class="modal-title"
                                                                    id="modalEditarNota{{ $estudiante->estudianteId }}Label">
                                                                    Editar Nota de {{ $estudiante->Apellidos }}
                                                                    {{ $estudiante->Nombres }}
                                                                </h5>
                                                                <button type="button" class="close"
                                                                    data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <input type="hidden" name="estudiante_id"
                                                                    value="{{ $estudiante->estudianteId }}">

                                                                <div class="form-group">
                                                                    <label for="tareas">Cumple con las tareas
                                                                        planificadas. Sobre
                                                                        10%</label>
                                                                    <input type="number" name="tareas"
                                                                        class="form-control"
                                                                        value="{{ optional($estudiante->notas->first())->tareas }}"
                                                                        min="1" max="10" step="0.01"
                                                                        required>
                                                                    <small class="form-text text-danger"
                                                                        style="display: none;">El
                                                                        valor debe estar entre 0 y 10.</small>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="resultados_alcanzados">Resultados
                                                                        Alcanzados. Sobre
                                                                        10%</label>
                                                                    <input type="number" name="resultados_alcanzados"
                                                                        class="form-control"
                                                                        value="{{ optional($estudiante->notas->first())->resultadosAlcanzados }}"
                                                                        min="1" max="10" step="0.01"
                                                                        required>
                                                                    <small class="form-text text-danger"
                                                                        style="display: none;">El
                                                                        valor debe estar entre 0 y 10.</small>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="conocimientos_area">Demuestra conocimientos
                                                                        en el área
                                                                        de práctica pre profesional. Sobre 10%</label>
                                                                    <input type="number" name="conocimientos_area"
                                                                        class="form-control"
                                                                        value="{{ optional($estudiante->notas->first())->conocimientos }}"
                                                                        min="1" max="10" step="0.01"
                                                                        required>
                                                                    <small class="form-text text-danger"
                                                                        style="display: none;">El
                                                                        valor debe estar entre 0 y 10.</small>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="adaptabilidad">Adaptabilidad e Integración
                                                                        al sistema
                                                                        de trabajo del proyecto. Sobre 10%</label>
                                                                    <input type="number" name="adaptabilidad"
                                                                        class="form-control"
                                                                        value="{{ optional($estudiante->notas->first())->adaptabilidad }}"
                                                                        min="1" max="10" step="0.01"
                                                                        required>
                                                                    <small class="form-text text-danger"
                                                                        style="display: none;">El
                                                                        valor debe estar entre 0 y 10.</small>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="Aplicacion">Aplicación y manejo de
                                                                        destrezas y
                                                                        habilidades acordes al perfil profesional</label>
                                                                    <input type="number" name="Aplicacion"
                                                                        class="form-control"
                                                                        value="{{ optional($estudiante->notas->first())->aplicacion }}"
                                                                        min="1" max="10" step="0.01"
                                                                        required>
                                                                    <small class="form-text text-danger"
                                                                        style="display: none;">El
                                                                        valor debe estar entre 0 y 10.</small>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="capacidad_liderazgo">Demuestra capacidad de
                                                                        liderazgo y
                                                                        de trabajo en equipo. Sobre 10%</label>
                                                                    <input type="number" name="capacidad_liderazgo"
                                                                        class="form-control"
                                                                        value="{{ optional($estudiante->notas->first())->CapacidadLiderazgo }}"
                                                                        min="1" max="10" step="0.01"
                                                                        required>
                                                                    <small class="form-text text-danger"
                                                                        style="display: none;">El
                                                                        valor debe estar entre 0 y 10.</small>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="asistencia_puntual">Asiste puntualmente.
                                                                        Sobre
                                                                        10%</label>
                                                                    <input type="number" name="asistencia_puntual"
                                                                        class="form-control"
                                                                        value="{{ optional($estudiante->notas->first())->asistencia }}"
                                                                        min="1" max="10" step="0.01"
                                                                        required>
                                                                    <small class="form-text text-danger"
                                                                        style="display: none;">El
                                                                        valor debe estar entre 0 y 10.</small>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="button"
                                                                    data-dismiss="modal">Cerrar</button>
                                                                <button type="submit" class="button3">Guardar
                                                                    Cambios</button>
                                                            </div>
                                                        </form>
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
                    <div class="card-header actividad-card" data-toggle="modal"
                        data-target="#modalActividad{{ $estudianteId }}">
                        <h5 class="mb-0">
                            <button class="button1" type="button">
                                {{ $estudiante->apellidos }} {{ $estudiante->nombres }}
                            </button>
                        </h5>
                    </div>
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
                                    <table class="table">
                                        <thead>
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

    <script src="{{ asset('js/ParticipanteDirectorVinculacion/notas.js') }}"></script>







@endsection


<style>
    table.table {
        width: 100%;
        border-collapse: collapse;
    }

    table.table,
    th,
    td {
        font-size: 14px;
        border: 1px solid #ddd;
    }

    .wide-cell {
        white-space: normal;
        /* Permitir que el texto se divida en varias líneas */
        overflow: hidden;
        text-overflow: ellipsis;
        word-wrap: break-word;
        /* Romper palabras largas para ajustar al ancho de la celda */
    }


    .body,
    table.table,
    tr,
    td,
    th {
        font-size: 12px;
        text-align: center;
        /* Centra el texto en las celdas de datos */
    }
</style>
