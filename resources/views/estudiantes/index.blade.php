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

        <div class="table-container mat-elevation-z8">
            <div id="tablaDocentes">

                <div class="container mt-3">
                    <div class="card" style="max-width: 750px; margin: auto;">
                        <div class="card-header">
                            <div class="d-flex justify-content-between align-items-center">
                                <div></div>
                                <div class="d-flex">
                                    <form action="{{ route('estudiantes.certificadoMatricula') }}" method="get"
                                        class="mr-2">
                                        <div class="tooltip-container">
                                            <span class="tooltip-text">Pdf</span>
                                            <button type="submit" class="button3 efects_button btn_pdf"
                                                tooltipPosition="top">
                                                <i class="fa-solid fa-file-pdf"></i>
                                            </button>
                                        </div>
                                    </form>
                                    <div class="tooltip-container">
                                        <span class="tooltip-text">Editar</span>
                                        <a href="{{ route('estudiantes.edit', ['estudiante' => $estudiante->EstudianteID]) }}"
                                            class="button3 efects_button btn_filtro" tooltipPosition="top">
                                            <i class="material-icons">edit</i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label for="Nombres" class="col-sm-4 font-weight-bold"><i class="fas fa-user"></i>
                                            Nombres:</label>
                                        <div class="col-sm-8">
                                            <div class="input-group">
                                                <label class="form-control">{{ strtoupper($estudiante->Nombres) }}</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="Apellidos" class="col-sm-4 font-weight-bold"><i class="fas fa-user"></i>
                                            Apellidos:</label>
                                        <div class="col-sm-8">
                                            <div class="input-group">
                                                <label class="form-control">{{ strtoupper($estudiante->Apellidos) }}</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="espe_id" class="col-sm-4 font-weight-bold"><i
                                                class="fas fa-id-card"></i> ESPE ID:</label>
                                        <div class="col-sm-8">
                                            <div class="input-group">
                                                <label class="form-control">{{ strtoupper($estudiante->espe_id) }}</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="celular" class="col-sm-4 font-weight-bold"><i
                                                class="fas fa-mobile-alt"></i> Celular:</label>
                                        <div class="col-sm-8">
                                            <div class="input-group">
                                                <label class="form-control">{{ strtoupper($estudiante->celular) }}</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label for="cedula" class="col-sm-4 font-weight-bold"><i
                                                class="fas fa-id-card"></i> Cédula:</label>
                                        <div class="col-sm-8">
                                            <div class="input-group">
                                                <label class="form-control">{{ strtoupper($estudiante->cedula) }}</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="Cohorte" class="col-sm-4 font-weight-bold"><i
                                                class="fas fa-calendar-alt"></i> Cohorte:</label>
                                        <div class="col-sm-8">
                                            <div class="input-group">
                                                <label
                                                    class="form-control">{{ strtoupper($periodo->numeroPeriodo) }}</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="Departamento" class="col-sm-4 font-weight-bold"><i
                                                class="fas fa-building"></i> Departamento:</label>
                                        <div class="col-sm-8">
                                            <div class="input-group">
                                                <label
                                                    class="form-control label">{{ strtoupper($estudiante->Departamento) }}</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <style>
                        .form-group {
                            margin-bottom: 0.2rem;
                        }
                    </style>


                </div>
            </div>

            <!-- Styles -->
            <style>
                .input-group-text {
                    width: 40px;
                    /* Set a fixed width for all icon boxes */
                    height: 38px;
                    /* Set a fixed height for all icon boxes */
                    display: flex;
                    justify-content: center;
                    align-items: center;
                }

                @media (max-width: 576px) {
                    .table-responsive-sm {
                        overflow-x: auto;
                    }

                    .font-weight-bold {
                        white-space: nowrap;
                    }

                    .form-control {
                        min-width: 120px;
                        /* Adjust this as necessary */
                    }
                }

                .contenedor_botones {
                    display: flex;
                    gap: 10px;
                    /* Adjust the gap between buttons as needed */
                }

                .contenedor_botones form,
                .contenedor_botones a {
                    display: flex;
                    align-items: center;
                }
            </style>



        </div>
    </div>

    <!-- Estado y botón de reenvío de información con ícono -->
    <div class="mt-4">
        <h6><b>
                <div class="icon-sidebar-item">Estado-Aprobación</div>
            </b></h6>
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
                <button type="submit" class="button1 ">
                    <i class="fa-solid fa-paper-plane-top"></i> Reenviar Información
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
                        <th>Descripción del Proyecto</th>
                        <th>Fecha de Asignación</th>
                        <th>Periodo</th>
                     </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ strtoupper($asignacionProyecto->proyecto->NombreProyecto) }}</td>
                        <td>{{ strtoupper($asignacionProyecto->proyecto->director->Nombres . ' ' . $asignacionProyecto->proyecto->director->Apellidos) }}

                        <td>{{ strtoupper($asignacionProyecto->proyecto->DescripcionProyecto) }}</td>
                        <td>{{ $asignacionProyecto->FechaAsignacion }}</td>
                        <td>{{ strtoupper($asignacionProyecto->periodo->numeroPeriodo) }}</td>

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
