@extends('layouts.directorVinculacion')

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

        @if (count($estudiantesConNotasPendientes) === 0)
            <p>El docente participante aun no a calificado a los estudiantes.</p>
        @else
            <h4>Actualizar Informe de Servicio Comunitario</h4>
            <form method="post" action="{{ route('director_vinculacion.actualizarInforme') }}">
                @csrf
                <table>
                    <thead>
                        <tr>
                            <th>Nombres</th>
                            <th>Espe ID</th>
                            <th>Carrera</th>
                            <th>Departamento</th>
                            <th>Informe de Servicio Comunitario 30%</th>

                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($estudiantesConNotasPendientes as $estudiante)
                            <tr>
                                <td class="wide-cell">{{ $estudiante->Apellidos }} {{ $estudiante->Nombres }}</td>
                                <td>{{ $estudiante->espe_id }}</td>
                                <td class="wide-cell">{{ $estudiante->Carrera }}</td>
                                <td>{{ $estudiante->Departamento }}</td>
                                <td>
                                    <input type="hidden" name="estudiante_id[]" value="{{ $estudiante->EstudianteID }}">
                                    <input type="text" name="informe_servicio[]" value="{{ $estudiante->notas->first()->Informe !== 'Pendiente' ? $estudiante->notas->first()->Informe : '' }}" required>
                                    <small class="form-text text-danger" style="display: none;"></small>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <br>
                <button type="submit" class="btn btn-primary">Guardar Informe</button>
            </form>
        @endif

        <h4>Estudiantes Calificados</h4>
        @if (count($estudiantesCalificados) === 0)
            <p>No hay estudiantes calificados en este momento.</p>
        @else
        <div class="contenedor_tabla">
                <div class="table-container mat-elevation-z8">

                    <div id="tablaProyectos">
                        <table class="mat-mdc-table">
                            <thead class="ng-star-inserted">
                                <tr class="mat-mdc-header-row mdc-data-table__header-row cdk-header-row ng-star-inserted">
                              
                                        <th>NOMBRES</th>
                        <th>ESPE ID</th>
                        <th>CARRERA</th>
                        <th>DEPARTAMENTO</th>
                        <th>TAREAS</th>
                        <th>RESULTADOS ALCANZADOS</th>
                        <th>CONOCIMIENTOS EN EL ÁREA</th>
                        <th>ADAPTABILIDAD</th>
                        <th>APLICACION DE DESTREZAS Y HABILIDADES</th>
                        <th>CAPACIDAD DE LIDERAZGO</th>
                        <th>ASISTENCIA</th>
                        <th>INFORME DE SERVICIO COMINITARIO</th>
                        <th>NOTA FINAL</th>
                        <th>EDITAR NOTAS</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($estudiantesCalificados as $estudiante)
                        <tr>
                            <td class="wide-cell">{{ $estudiante->Apellidos }} {{ $estudiante->Nombres }}</td>
                            <td>{{ $estudiante->espe_id }}</td>
                            <td class="wide-cell">{{ $estudiante->Carrera }}</td>
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
                            <td>
                                @php
                                    $notaTotal = $estudiante->notas->sum(function ($nota) {
                                        return $nota->Tareas +
                                            $nota->Resultados_Alcanzados +
                                            $nota->Conocimientos +
                                            $nota->Adaptabilidad +
                                            $nota->Aplicacion +
                                            $nota->Capacidad_liderazgo +
                                            $nota->Asistencia +
                                            $nota->Informe;
                                    });
                                    $notaFinal = ($notaTotal * 20) / 100;
                                @endphp
                                {{ $notaFinal }}
                            </td>

                            <td>
                                <button class="btn btn-sm btn-secondary" data-toggle="modal"
                                data-target="#modalEditarInforme{{ $estudiante->EstudianteID }}">Editar</button>

                                <div class="modal fade" id="modalEditarInforme{{ $estudiante->EstudianteID }}" tabindex="-1" role="dialog" aria-labelledby="modalEditarInforme{{ $estudiante->EstudianteID }}Label" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <form method="post" action="{{ route('director_vinculacion.actualizarNota', ['id' => $estudiante->EstudianteID]) }}">
                                                @csrf
                                                @method('PUT')

                                                <div class="modal-header">
                                                    <h5 class="modal-title"
                                                        id="modalEditarNota{{ $estudiante->EstudianteID }}Label">
                                                        Nota de Informe {{ $estudiante->Apellidos }}
                                                        {{ $estudiante->Nombres }}</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>

                                                <div class="modal-body">
                                                    <input type="hidden" name="estudiante_id" value="{{ $estudiante->EstudianteID }}">
                                                    <div class="form-group">
                                                        <label for="nota_servicio">Informe de Servicio Comunitario</label>
                                                        <input type="text" class="input" name="nota_servicio" value="{{ $estudiante->notas->first()->Informe }}" required>
                                                        <small class="form-text text-danger" style="display: none;"></small>
                                                    </div>
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="button" class="button" data-dismiss="modal">Cerrar</button>
                                                    <button type="submit" class="button">Guardar</button>
                                                </div>
                                            </form>
                                        </div>
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

    <script src="{{ asset('js/ParticipanteDirectorVinculacion/notas.js') }}"></script>

@endsection

