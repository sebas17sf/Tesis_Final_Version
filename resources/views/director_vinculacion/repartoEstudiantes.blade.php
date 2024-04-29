@extends('layouts.directorVinculacion')

@section('content')
    <div class="container">
        <h4>Asignacion de estudiantes</h4>

        <h4>Director de Proyecto</h4>
        <table>
            <tr>
                <td>{{ $directorProyecto->Apellidos }} {{ $directorProyecto->Nombres }}</td>
            </tr>
        </table>

        <h4>Docente Participante</h4>
        <table>
            <tr>
                <td>{{ $docenteParticipante->Apellidos }} {{ $docenteParticipante->Nombres }}</td>
                <td>
                    <form action="{{ route('director_vinculacion.asignarEstudiantes') }}" method="POST">
                        @csrf
                        <input type="hidden" name="docente_id" value="{{ $docenteParticipante->id }}">
                        @if ($estudiantesAsignados->isNotEmpty())
                            <select name="estudiante">
                                @foreach ($estudiantesAsignados as $asignacion)
                                    <option value="{{ $asignacion->estudiante->EstudianteID }}">
                                        {{ $asignacion->estudiante->Nombres }}</option>
                                @endforeach
                            </select>
                            <button class="button" type="submit">Asignar</button>

                        @else
                            <input class="input" type="text" value="No hay estudiantes disponibles" disabled>
                        @endif

                     </form>
                </td>
            </tr>
        </table>

        @if ($participantesAdicionales->isNotEmpty())
            <h4>Participantes Adicionales</h4>
            <table>
                @foreach ($participantesAdicionales as $participanteAdicional)
                    <tr>
                        <td>{{ $participanteAdicional->Apellidos }} {{ $participanteAdicional->Nombres }}</td>
                        <td>
                            <form action="{{ route('director_vinculacion.asignarEstudiantes') }}" method="POST">
                                @csrf
                                <input type="hidden" name="docente_id" value="{{ $participanteAdicional->id }}">
                                @if ($estudiantesAsignados->isNotEmpty())
                                    <select name="estudiante">
                                        @foreach ($estudiantesAsignados as $asignacion)
                                            <option value="{{ $asignacion->estudiante->EstudianteID }}">
                                                {{ $asignacion->estudiante->Nombres }}</option>
                                        @endforeach
                                    </select>
                                    <button class="button" type="submit">Asignar</button>

                                @else
                                    <input class="input" type="text" value="No hay estudiantes disponibles" disabled>
                                @endif

                             </form>
                        </td>
                    </tr>
                @endforeach
            </table>
        @endif



        <h4>Estudiantes Asignados a Docentes</h4>

        <table>
            <tr>
                <th>Estudiante</th>
                <th>Docente</th>
                <th>Proyecto</th>
                <th>Acciones</th>
            </tr>
            @foreach ($asignacionesEstudiantesDirector as $asignacion)
                <tr>
                    <td>{{ $asignacion->estudiante->Nombres }}</td>
                    <td>{{ $asignacion->participante->Apellidos }} {{ $asignacion->participante->Nombres }}</td>
                    <td>{{ $asignacion->proyecto->NombreProyecto }}</td>
                    <td>
                        <form
                            action="{{ route('director_vinculacion.desasignarEstudiantes', ['EstudianteID' => $asignacion->EstudianteID]) }}"
                            method="POST">
                            @csrf
                            @method('DELETE')
                            <input type="hidden" name="estudiante_id" value="{{ $asignacion->EstudianteID }}">
                            <button class="button" type="submit">Desasignar</button>
                        </form>

                        <form id="eliminarEstudianteForm_{{ $asignacion->EstudianteID }}"
                            action="{{ route('director_vinculacion.eliminarEstudiante', ['EstudianteID' => $asignacion->EstudianteID]) }}"
                            method="POST">
                            @csrf
                            @method('DELETE')
                            <input type="hidden" name="estudiante_id" value="{{ $asignacion->EstudianteID }}">
                            <button class="button" type="button"
                                onclick="mostrarSweetAlert('{{ $asignacion->EstudianteID }}')">Eliminar del
                                proyecto</button>
                            <input type="hidden" name="motivo_negacion"
                                id="motivoNegacion_{{ $asignacion->EstudianteID }}">

                        </form>

                    </td>
                </tr>
            @endforeach
        </table>


    </div>


@endsection

<script>
    function mostrarSweetAlert(estudianteID) {
        Swal.fire({
            title: 'Ingrese el motivo de la negación',
            input: 'textarea',
            inputLabel: 'Motivo',
            inputPlaceholder: 'Ingrese el motivo aquí...',
            inputAttributes: {
                rows: 7,
                style: 'resize: vertical;'
            },
            showCancelButton: true,
            cancelButtonText: 'Cancelar',
            confirmButtonText: 'Confirmar',
            preConfirm: (motivo) => {
                if (!motivo) {
                    Swal.showValidationMessage('Debe ingresar un motivo');
                }
            }
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('motivoNegacion_' + estudianteID).value = result.value;
                document.getElementById('eliminarEstudianteForm_' + estudianteID).submit();
            }
        });
    }
</script>


<style>
    table {
        width: 100%;
        border-collapse: collapse;
        padding: 4px 8px;
    }

    table,
    th,
    td {
        font-size: 14px;
        padding: 4px 8px;
        border: 1px solid #ddd;
    }

    th {
        border: 1px solid #70a1ff;
        background-color: #eaf5ff;
    }

    .wide-cell {
        max-width: 200px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .body,
    table,
    tr,
    td,
    th {
        font-size: 12px;
    }
</style>
