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
    <div class="container">


        <h4>Estudiantes Asignados a Docentes</h4>

        <div class="contenedor_tabla">
                <div class="table-container mat-elevation-z8">

                    <div id="tablaProyectos">
                        <table class="mat-mdc-table">
                            <thead class="ng-star-inserted">
                                <tr class="mat-mdc-header-row mdc-data-table__header-row cdk-header-row ng-star-inserted">

                                        <th>Estudiante</th>
                <th>Docente asignado</th>
                <th>Proyecto</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody class="mdc-data-table__content ng-star-inserted">

            @foreach ($asignacionesEstudiantesDirector as $asignacion)
                <tr>
                    <td>{{ $asignacion->estudiante->Apellidos }} {{ $asignacion->estudiante->Nombres }}</td>
                    <td>{{ $asignacion->docenteParticipante->Nombres }} {{ $asignacion->docenteParticipante->Apellidos }}
                    </td>
                    <td>{{ $asignacion->proyecto->NombreProyecto }}</td>
                    <td>

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
        </tbody>
            @endforeach
        </table>
        </div>
        </div>
        </div>
        <br>

        <form id="finalizarForm" action="{{ route('director_vinculacion.cerrarProcesoEstudiantes') }}" method="POST">
            @csrf
            <button id="finalizarBtn" type="button" class="button1_1">Finalizar actividades de los estudiantes</button>
        </form>


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




    </div>
@endsection
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
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
            finalizarBtn.addEventListener('click', function (e) {
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


