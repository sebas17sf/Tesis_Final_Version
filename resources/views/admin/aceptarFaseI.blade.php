@extends('layouts.admin')
@section('title_component', 'Fase I')
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

    <section class="contenedor_agregar_periodo">
        <h4><b>Estudiantes a realizar Prácticas</b></h4>
        <hr>
        <section>
            <div class="mat-elevation-z8 contenedor_general">

                {{-- <div class="contenedor_acciones_tabla">
                    <form action="{{ route('admin.estudiantes') }}" method="GET">
                        @csrf
                        <div class="form-group d-flex align-items-center">

                            <label for="buscarEstudiantesEnRevision" class="mr-2">Buscar Estudiantes en Proceso de
                                Revisión:</label>
                            <input type="text" class="form-control input" name="buscarEstudiantesEnRevision"
                                id="buscarEstudiantesEnRevision">
                            <div class="btn-group ml-2 shadow-0">
                                <button type="submit" class="button5">Buscar
                                    <i class="bx bx-search-alt"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div> --}}


                <div class="contenedor_tabla">
                    <div class="table-container mat-elevation-z8">

                        <div id="tablaDocentes">
                            <table class="mat-mdc-table">
                                <thead class="ng-star-inserted">
                                    <tr
                                        class="mat-mdc-header-row mdc-data-table__header-row cdk-header-row ng-star-inserted">
                                        <th>Estudiante</th>
                                        <th>Práctica</th>
                                        <th>Tutor Académico</th>
                                        <th>Tutor Empresarial</th>
                                        <th>Empresa</th>
                                        <th>NRC</th>
                                        <th>Periodo</th>
                                        <th>Fecha Inicio</th>
                                        <th>Fecha Fin</th>
                                        <th>Horas planificadas</th>
                                        <th>Estado</th>
                                        <th>Acción</th>
                                    </tr>
                                </thead>
                                <tbody class="mdc-data-table__content ng-star-inserted">
                                    @foreach ($estudiantesConPracticaI as $practicaI)
                                        @if ($practicaI->estudiante)
                                            <tr>
                                                <td>{{ strtoupper($practicaI->estudiante->Apellidos) }}
                                                    {{ strtoupper($practicaI->estudiante->Nombres) }}</td>
                                                <td>{{ strtoupper($practicaI->tipoPractica) }}</td>
                                                <td>{{ strtoupper($practicaI->tutorAcademico->Apellidos) }}
                                                    {{ strtoupper($practicaI->tutorAcademico->Nombres) }}</td>
                                                <td>{{ strtoupper($practicaI->NombreTutorEmpresarial) }}</td>
                                                <td>{{ strtoupper($practicaI->Empresa->nombreEmpresa) }}</td>
                                                <td>{{ strtoupper($practicaI->nrcPractica->nrc) }}</td>
                                                <td>{{ strtoupper($practicaI->nrcPractica->periodo->numeroPeriodo) }}</td>
                                                <td>{{ strtoupper($practicaI->FechaInicio) }}</td>
                                                <td>{{ strtoupper($practicaI->FechaFinalizacion) }}</td>
                                                <td>{{ strtoupper($practicaI->HorasPlanificadas) }}</td>
                                                <td>{{ $practicaI->Estado }}</td>
                                                <td>
                                                    <form
                                                        action="{{ route('admin.actualizarEstadoEstudiante', ['id' => $practicaI->estudiante->EstudianteID]) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <select name="nuevoEstado">
                                                            <option value="En ejecucion">Aprobado</option>
                                                            <option value="Negado">Negar</option>
                                                        </select>
                                                        <button type="submit">Enviar</button>
                                                    </form>

                                                    <form
                                                        action="{{ route('admin.editarNombreEmpresa', ['id' => $practicaI->estudiante->EstudianteID]) }}"
                                                        method="GET">
                                                        <button type="submit">Cambiar Empresa</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach

                                    @foreach ($estudiantesConPracticaII as $practicaII)
                                        @if ($practicaII->estudiante)
                                            <tr>
                                                <td>{{ strtoupper($practicaII->estudiante->Apellidos) }}
                                                    {{ strtoupper($practicaII->estudiante->Nombres) }}</td>
                                                <td>{{ strtoupper($practicaII->Practicas) }}</td>
                                                <td>{{ strtoupper($practicaII->DocenteTutor) }}</td>
                                                <td>{{ strtoupper($practicaII->NombreTutorEmpresarial) }}</td>
                                                <td>{{ strtoupper($practicaII->Empresa) }}</td>
                                                <td>{{ strtoupper($practicaII->Nivel) }}</td>
                                                <td>{{ strtoupper($practicaII->FechaInicio) }}</td>
                                                <td>{{ strtoupper($practicaII->FechaFinalizacion) }}</td>
                                                <td>{{ strtoupper($practicaII->HorasPlanificadas) }}</td>
                                                <td>{{ $practicaII->Estado }}</td>
                                                <td>
                                                    <form
                                                        action="{{ route('admin.actualizarEstadoEstudiante2', ['id' => $practicaII->estudiante->EstudianteID]) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <select name="nuevoEstado">
                                                            <option value="En ejecucion">Aprobado</option>
                                                            <option value="Negado">Negar</option>
                                                        </select>
                                                        <button type="submit">Enviar</button>
                                                    </form>

                                                    <form
                                                        action="{{ route('admin.editarNombreEmpresa', ['id' => $practicaII->estudiante->EstudianteID]) }}"
                                                        method="get">
                                                        <button type="submit">Cambiar</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>

            </div>
        </section>

        <br>
        <h4><b>Estudiantes Practica I</b></h4>
        <hr>
        <section>
            <div class="mat-elevation-z8 contenedor_general">

                <div class="contenedor_acciones_tabla">
                    <form method="POST" action="{{ route('coordinador.reportesPracticaI') }}">
                        @csrf
                        <button type="submit" class="btn btn-sm btn-secondary">
                            <i class="fas fa-file-excel"></i> Generar Reporte
                        </button>
                    </form>
                </div> 


                <div class="contenedor_tabla">
                    <div class="table-container mat-elevation-z8">

                        <div id="tablaDocentes">
                            <table class="mat-mdc-table">
                                <thead class="ng-star-inserted">
                                    <tr
                                        class="mat-mdc-header-row mdc-data-table__header-row cdk-header-row ng-star-inserted">
                                        <th>Estudiante</th>
                                        <th>Práctica</th>
                                        <th>Tutor Académico</th>
                                        <th>Tutor Empresarial</th>
                                        <th>Empresa</th>
                                        <th>NRC</th>
                                        <th>Periodo</th>
                                        <th>Fecha Inicio</th>
                                        <th>Fecha Fin</th>
                                        <th>Horas planificadas</th>
                                        <th>Estado</th>
                                        <th>Acción</th>
                                    </tr>
                                </thead>
                                <tbody class="mdc-data-table__content ng-star-inserted">
                                    @foreach ($estudiantesPracticas as $practicaI)
                                    @if ($practicaI->estudiante)
                                        <tr>
                                            <td>{{ strtoupper($practicaI->estudiante->Apellidos) }}
                                                {{ strtoupper($practicaI->estudiante->Nombres) }}</td>
                                            <td>{{ strtoupper($practicaI->tipoPractica) }}</td>
                                            <td>{{ strtoupper($practicaI->tutorAcademico->Apellidos) }}
                                                {{ strtoupper($practicaI->tutorAcademico->Nombres) }}</td>
                                            <td>{{ strtoupper($practicaI->NombreTutorEmpresarial) }}</td>
                                            <td>{{ strtoupper($practicaI->Empresa->nombreEmpresa) }}</td>
                                            <td>{{ strtoupper($practicaI->nrcPractica->nrc) }}</td>
                                            <td>{{ strtoupper($practicaI->nrcPractica->periodo->numeroPeriodo) }}</td>
                
                                            <td>{{ strtoupper($practicaI->FechaInicio) }}</td>
                                            <td>{{ strtoupper($practicaI->FechaFinalizacion) }}</td>
                                            <td>{{ strtoupper($practicaI->HorasPlanificadas) }}</td>
                                            <td>{{ $practicaI->Estado }}</td>
                                            <td>
                                                <form
                                                    action="{{ route('admin.actualizarEstadoEstudiante', ['id' => $practicaI->estudiante->EstudianteID]) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <select name="nuevoEstado">
                                                        <option value="Terminado">Terminado</option>
                                                        <option value="En ejecucion">Ejecucion</option>
                                                    </select>
                                                    <button type="submit">Actualizar</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>

            </div>
        </section>


        <br>
        <h4><b>Estudiantes Practica II<b></h4>
        <hr>
        <section>
            <div class="mat-elevation-z8 contenedor_general">

                <div class="contenedor_acciones_tabla">
                    <form method="POST" action="{{ route('coordinador.reportesPracticaII') }}">
                        @csrf
                        <button type="submit" class="btn btn-sm btn-secondary">
                            <i class="fas fa-file-excel"></i> Generar Reporte
                        </button>
                    </form>


                    
                </div> 


                <div class="contenedor_tabla">
                    <div class="table-container mat-elevation-z8">

                        <div id="tablaDocentes">
                            <table class="mat-mdc-table">
                                <thead class="ng-star-inserted">
                                    <tr
                                        class="mat-mdc-header-row mdc-data-table__header-row cdk-header-row ng-star-inserted">
                                        <th>Estudiante</th>
                    <th>Práctica</th>
                    <th>Tutor Académico</th>
                    <th>Tutor Empresarial</th>
                    <th>Empresa</th>
                    <th>Nivel</th>
                    <th>Fecha Inicio</th>
                    <th>Fecha Fin</th>
                    <th>Horas planificadas</th>
                    <th>Estado</th>
                    <th>Acción</th>
                                    </tr>
                                </thead>
                                <tbody class="mdc-data-table__content ng-star-inserted">
                                    @foreach ($estudiantesPracticasII as $practicaI)
                    @if ($practicaI->estudiante)
                        <tr>
                            <td>{{ strtoupper($practicaI->estudiante->Apellidos) }}
                                {{ strtoupper($practicaI->estudiante->Nombres) }}</td>
                            <td>{{ strtoupper($practicaI->Practicas) }}</td>
                            <td>{{ strtoupper($practicaI->DocenteTutor) }}</td>
                            <td>{{ strtoupper($practicaI->NombreTutorEmpresarial) }}</td>
                            <td>{{ strtoupper($practicaI->Empresa) }}</td>
                            <td>{{ strtoupper($practicaI->Nivel) }}</td>
                            <td>{{ strtoupper($practicaI->FechaInicio) }}</td>
                            <td>{{ strtoupper($practicaI->FechaFinalizacion) }}</td>
                            <td>{{ strtoupper($practicaI->HorasPlanificadas) }}</td>
                            <td>{{ $practicaI->Estado }}</td>
                            <td>
                                <form
                                    action="{{ route('admin.actualizarEstadoEstudiante2', ['id' => $practicaI->estudiante->EstudianteID]) }}"
                                    method="POST">
                                    @csrf
                                    @method('PUT')
                                    <select name="nuevoEstado">
                                        <option value="Terminado">Terminado</option>
                                        <option value="En ejecucion">Ejecucion</option>
                                    </select>
                                    <button type="submit">Actualizar</button>
                                </form>
                            </td>
                        </tr>
                    @endif
                @endforeach
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>

            </div>
        </section>

    </section>
    




 

@endsection

