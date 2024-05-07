@extends('layouts.app')

@section('title', 'Información del Estudiante')

@section('title_component', 'Información del Estudiante')

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
    <div class="contenedor_general mat-elevation-z8 ">
    <div class="contenedor_acciones_tabla sidebar_active_content_acciones_tabla">
    <div class="contenedor_botones">
    
        <form action="{{ route('estudiantes.certificadoMatricula') }}" method="get">
            <button type="submit" class="button3 efects_button btn_copy" tooltipPosition="top">
                <i class="material-icons">cloud_download</i> 
            </button>
        </form>
<!-- Botón de edición con ícono -->

            <a href="{{ route('estudiantes.edit', ['estudiante' => $estudiante->EstudianteID]) }}"
                class="button3 efects_button btn_filtro" tooltipPosition="top">
                <i class="material-icons">edit</i> 
            </a>

        </div>
        </div>
        <div class="table-container mat-elevation-z8">
        <div id="tablaDocentes">
            <table class="table mat-mdc-row">
                <tbody class="ng-star-inserted"">
                    <tr>
                        <th>Nombres:</th>
                        <td>{{ strtoupper($estudiante->Nombres) }}</td>
                    </tr>
                    <tr>
                        <th>Apellidos:</th>
                        <td>{{ strtoupper($estudiante->Apellidos) }}</td>
                    </tr>
                    <tr>
                        <th>ESPE ID:</th>
                        <td>{{ strtoupper($estudiante->espe_id) }}</td>
                    </tr>
                    <tr>
                        <th>Celular:</th>
                        <td>{{ strtoupper($estudiante->celular) }}</td>
                    </tr>
                    <tr>
                        <th>Cédula:</th>
                        <td>{{ strtoupper($estudiante->cedula) }}</td>
                    </tr>
                    <tr>
                        <th>Cohorte:</th>
                        <td>{{ strtoupper($periodo->numeroPeriodo) }}</td>
                    </tr>
                    <tr>
                        <th>Departamento:</th>
                        <td>{{ strtoupper($estudiante->Departamento) }}</td>
                    </tr>
                    <!-- Agrega aquí más campos con íconos si es necesario -->
                </tbody>
            </table>
        </div>
        </div>
        


        <!-- Estado y botón de reenvío de información con ícono -->
        <div class="mt-4">
            <h6><b><div class="icon-sidebar-item">Estado-Aprobación</div></b></h6>
            <hr>
            <table class="table custom-table">
                <tbody>
                    <tr>
                        <th>Verificación</th>
                        <td>
                            @if ($estudiante->Estado == 'Aprobado')
                                {{ strtoupper('Vinculacion') }}
                            @elseif ($estudiante->Estado == 'Aprobado-practicas')
                                {{ strtoupper('Practicas') }}
                            @else
                                {{ strtoupper($estudiante->Estado) }}
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>

            <form method="POST" action="{{ route('estudiantes.resend', ['estudiante' => $estudiante->EstudianteID]) }}">
                @csrf
                <div class="text-center">
                    <button type="submit" class="btn btn-sm btn-secondary">
                        <i class="material-icons">send</i> Reenviar Información
                    </button>
                </div>
            </form>


        </div>

        <!-- Sección para mostrar la información del proyecto asignado -->
        <div class="mt-4">
            <h6><b>Proyecto Asignado</b></h6>
            <hr>
            @if ($asignacionProyecto)
                <table class="table custom-table">
                    <thead>
                        <tr>
                            <th>Nombre del Proyecto</th>
                            <th>Docente Director</th>
                            <th>Docente Participante</th>
                            <th>Descripción del Proyecto</th>
                            <th>Fecha de Asignación</th>
                            <th>Fecha de Inicio</th>
                            <th>Estado actual del Proyecto</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ strtoupper($asignacionProyecto->proyecto->NombreProyecto) }}</td>
                            <td>{{ strtoupper($asignacionProyecto->proyecto->director->Nombres . ' ' . $asignacionProyecto->proyecto->director->Apellidos) }}
                            </td>
                            <td>{{ strtoupper($asignacionProyecto->proyecto->docenteParticipante->Nombres . ' ' . $asignacionProyecto->proyecto->docenteParticipante->Apellidos) }}
                            </td>
                            <td>{{ strtoupper($asignacionProyecto->proyecto->DescripcionProyecto) }}</td>
                            <td>{{ $asignacionProyecto->FechaAsignacion }}</td>
                            <td>{{ $asignacionProyecto->proyecto->FechaInicio }}</td>
                            <td>{{ $asignacionProyecto->proyecto->Estado }}</td>
                        </tr>

                    </tbody>
                </table>
            @else
                <p>Aun no está asignado un Proyecto. Estar pendiente de su asignación.</p>
            @endif
        </div>





    </div>

</div>

@endsection

