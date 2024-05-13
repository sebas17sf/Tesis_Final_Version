@extends('layouts.participante')


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
        <h4>Estudiantes por calificar</h4>

        <!-- Formulario de calificación -->
        <form method="post" action="{{ route('guardar-notas') }}">
            @csrf
            <table class="table">
                <thead>
                    <tr>
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
                            <td class="wide-cell">{{ $estudiante->Apellidos }} {{ $estudiante->Nombres }}</td>
                            <td>{{ $estudiante->espe_id }}</td>
                            <td>{{ $estudiante->Carrera }}</td>
                            <td>{{ $estudiante->Departamento }}</td>
                            <td><input type="number" name="cumple_tareas[]" value="" min="1" max="10"
                                    step="0.01" required></td>
                            <td><input type="number" name="resultados_alcanzados[]" value="" min="1"
                                    max="10" step="0.01" required></td>
                            <td><input type="number" name="conocimientos_area[]" value="" min="1"
                                    max="10" step="0.01" required></td>
                            <td><input type="number" name="adaptabilidad[]" value="" min="1" max="10"
                                    step="0.01" required></td>
                            <td><input type="number" name="Aplicacion[]" value="" min="1" max="10"
                                    step="0.01" required></td>
                            <td><input type="number" name="capacidad_liderazgo[]" value="" min="1"
                                    max="10" step="0.01" required></td>
                            <td><input type="number" name="asistencia_puntual[]" value="" min="1"
                                    max="10" step="0.01" required></td>
                            <td><input type="hidden" name="estudiante_id[]" value="{{ $estudiante->EstudianteID }}"></td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
            <br>
            <button type="submit" class="btn btn-sm btn-secondary">Guardar Calificaciones</button>
        </form>

        <!-- Estudiantes Calificados -->
        @if (!$estudiantesConNotas->isEmpty())
            <h4>Estudiantes Calificados</h4>
            <table class="table">
                <thead>
                    <tr>
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
                    </tr>
                </thead>
                <tbody>
                    @foreach ($estudiantesConNotas as $estudiante)
                        <tr>
                            <td class="wide-cell">{{ $estudiante->Apellidos }} {{ $estudiante->Nombres }}</td>
                            <td>{{ $estudiante->espe_id }}</td>
                            <td>{{ $estudiante->Carrera }}</td>
                            <td>{{ $estudiante->Departamento }}</td>
                            <td>
                                @foreach ($estudiante->notas as $nota)
                                    {{ $nota->Tareas }}<br>
                                @endforeach
                            </td>
                            <td>
                                @foreach ($estudiante->notas as $nota)
                                    {{ $nota->Resultados_Alcanzados }}<br>
                                @endforeach
                            </td>
                            <td>
                                @foreach ($estudiante->notas as $nota)
                                    {{ $nota->Conocimientos }}<br>
                                @endforeach
                            </td>
                            <td>
                                @foreach ($estudiante->notas as $nota)
                                    {{ $nota->Adaptabilidad }}<br>
                                @endforeach
                            </td>
                            <td>
                                @foreach ($estudiante->notas as $nota)
                                    {{ $nota->Aplicacion }}<br>
                                @endforeach
                            </td>
                            <td>
                                @foreach ($estudiante->notas as $nota)
                                    {{ $nota->Capacidad_liderazgo }}<br>
                                @endforeach
                            </td>
                            <td>
                                @foreach ($estudiante->notas as $nota)
                                    {{ $nota->Asistencia }}<br>
                                @endforeach
                            </td>
                            <td>
                                @foreach ($estudiante->notas as $nota)
                                    {{ $nota->Informe }}<br>
                                @endforeach
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>

    <hr>

    <h4>Control de actividades de los estudiantes</h4>

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
                            <button class="btn btn-link" type="button">
                                {{ $estudiante->Apellidos }} {{ $estudiante->Nombres }}
                            </button>
                        </h5>
                    </div>
                    <!-- Modal -->
                    <div class="modal fade" id="modalActividad{{ $estudianteId }}" tabindex="-1" role="dialog"
                        aria-labelledby="modalActividad{{ $estudianteId }}Label" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="modalActividad{{ $estudianteId }}Label">
                                        {{ $estudiante->Apellidos }} {{ $estudiante->Nombres }}</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <h5>Actividades registradas del estudiante</h5>
                                    <table class="table">
                                        <thead>
                                            <tr>
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
                                                    <td>{{ $actividad->numero_horas }}</td>
                                                    <td>{{ $actividad->nombre_actividad }}</td>
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

    th {
        border: 1px solid #70a1ff;
        background-color: #eaf5ff;
        text-align: center;
        /* Centra el texto en las celdas del encabezado */
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
