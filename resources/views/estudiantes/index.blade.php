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
                            <div class=" justify-content-between align-items-center">
                                <div></div>
                                <div class="d-flex">
                                    <form action="{{ route('estudiantes.certificadoMatricula') }}" method="get"
                                        class="mr-2">
                                        <div class="tooltip-container">
                                            <span class="tooltip-text">Pdf</span>
                                            <button type="submit" class="button3_1_1  btn_pdf"
                                                tooltipPosition="top">
                                                <i class="fa-solid fa-file-pdf"></i>
                                            </button>
                                        </div>
                                    </form>
                                    <div class="tooltip-container">
                                        <span class="tooltip-text">Editar</span>
                                        <a  type="submit" href="{{ route('estudiantes.edit', ['estudiante' => $estudiante->EstudianteID]) }}"
                                            class="button3_1_1 btn_editar" tooltipPosition="top">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-body tamanio1">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label for="Nombres" class="col-sm-4 font-weight-bold">
                                        <div class="icon-sidebar-item">
                                            <i class="fas fa-user"></i>
                                            </div>
                                            <div class="icon-sidebar-item">
                                            Nombres:
                                        </div>
                                        </label>
                                        <div class="col-sm-8">
                                            <div class="input-group">
                                                <label class="form-control">{{ strtoupper($estudiante->Nombres) }}</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="Apellidos" class="col-sm-4 font-weight-bold">
                                        <div class="icon-sidebar-item">
                                            <i class="fas fa-user"></i>
                                            </div>
                                            <div class="icon-sidebar-item">
                                            Apellidos:
                                        </div>
                                        </label>
                                        <div class="col-sm-8">
                                            <div class="input-group">
                                                <label class="form-control">{{ strtoupper($estudiante->Apellidos) }}</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="espe_id" class="col-sm-4 font-weight-bold">
                                        <div class="icon-sidebar-item">
                                            <i class="fas fa-id-card"></i> 
                                        </div>
                                        <div class="icon-sidebar-item">    
                                            ESPE ID:
                                        </div>
                                        </label>
                                        <div class="col-sm-8">
                                            <div class="input-group">
                                                <label class="form-control">{{ strtoupper($estudiante->espe_id) }}</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="celular" class="col-sm-4 font-weight-bold">
                                        <div class="icon-sidebar-item">
                                        <i class="fas fa-mobile-alt"></i> 
                                        </div>
                                        <div class="icon-sidebar-item">
                                        Celular:
                                    </div>
                                    </label>
                                        <div class="col-sm-8">
                                            <div class="input-group">
                                                <label class="form-control">{{ strtoupper($estudiante->celular) }}</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label for="cedula" class="col-sm-4 font-weight-bold">
                                        <div class="icon-sidebar-item">    
                                        <i  class="fas fa-id-card"></i>
                                        </div>
                                        <div class="icon-sidebar-item">
                                        Cédula:
                                    </div>
                                    </label>
                                        <div class="col-sm-8">
                                            <div class="input-group">
                                                <label class="form-control">{{ strtoupper($estudiante->cedula) }}</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="Cohorte" class="col-sm-4 font-weight-bold">
                                        <div class="icon-sidebar-item">    
                                        <i class="fas fa-calendar-alt"></i> 
                                        </div>
                                        <div class="icon-sidebar-item">
                                        Cohorte:
                                    </div>
                                    </label>
                                        <div class="col-sm-8">
                                            <div class="input-group">
                                                <label
                                                    class="form-control">{{ strtoupper($periodo->numeroPeriodo) }}</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="Departamento" class="col-sm-4 font-weight-bold">
                                        <div class="icon-sidebar-item">
                                            <i class="fa-solid fa-envelope"></i>
                                            </div>
                                            <div class="icon-sidebar-item">
                                         Correo:
                                        </div> 
                                        </label>
                                        <div class="col-sm-8">
                                            <div class="input-group">
                                                <label
                                                    class="form-control label">{{ ($estudiante->Correo) }}</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="Departamento" class="col-sm-4 font-weight-bold">
                                        <div class="icon-sidebar-item">
                                        <i class="fas fa-building"></i>
                                        </div>
                                        <div class="icon-sidebar-item">
                                        Departamento:
                                    </div>
                                    </label>
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


                </div>
            </div>

        </div>
    </div>
    <section class="contenedor_agregar_periodo">
    <!-- Estado y botón de reenvío de información con ícono -->
    <div class="formulario agregar_">
    <div class="mt-4">
        <h4><b>
                <div class="icon-sidebar-item">Estado-Aprobación</div>
            </b></h4>
        <hr>
        <div class="contenedor_tabla">
                <div class="table-container mat-elevation-z8">

                    <div id="tablaProyectos">
                        <table class="mat-mdc-table">
                            <thead class="ng-star-inserted">
                                <tr class="mat-mdc-header-row mdc-data-table__header-row cdk-header-row ng-star-inserted">
                                             <th class="tamanio1 ">VERIFICACIÓN</th>
                                             <th class="tamanio1">ACCIÓN</th>
                                             </thead>
                                    <tbody class="mdc-data-table__content ng-star-inserted">
                                        <tr>
                    <td style="word-wrap: break-word; text-align: center;">
                        @if ($estudiante->Estado == 'Aprobado')
                            {{ strtoupper('Vinculacion') }}
                        @elseif ($estudiante->Estado == 'Aprobado-practicas')
                            {{ strtoupper('Practicas') }}
                        @else
                            {{ strtoupper($estudiante->Estado) }}
                        @endif
                    </td>
                    <td>
                    <form method="POST" action="{{ route('estudiantes.resend', ['estudiante' => $estudiante->EstudianteID]) }}">
            @csrf
            <div class="text-center">
                <button type="submit" class="button1 ">
                    <i class="fa-solid fa-paper-plane-top"></i> Reenviar Información
                </button>
            </div>
        </form>
        </td>
                </tr>
            </tbody>
        </table>
        </div>
    </div>
    </div>
      


    </div>
</div>
</section>
    <!-- Sección para mostrar la información del proyecto asignado -->
    <div class="mt-4">
        <h4><b>Proyecto Asignado</b></h4>
        <hr>
        @if ($asignacionProyecto)
        <div class="contenedor_tabla">
                <div class="table-container mat-elevation-z8">

                    <div id="tablaProyectos">
                        <table class="mat-mdc-table">
                            <thead class="ng-star-inserted">
                                <tr class="mat-mdc-header-row mdc-data-table__header-row cdk-header-row ng-star-inserted">
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
