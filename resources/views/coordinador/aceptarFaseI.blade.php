@extends('layouts.coordinador')

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
        <h6><b>Estudiantes a realizar Prácticas</b></h6>
        <hr>
        <section>
            <div class="mat-elevation-z8 contenedor_general">

          

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
                                    @foreach ($estudiantesConPracticaI as $practicaI)
                                    @if ($practicaI->estudiante)
                                        <tr>
                                            <td>{{ $practicaI->estudiante->Apellidos }} {{ $practicaI->estudiante->Nombres }}</td>
                                            <td>{{ $practicaI->Practicas }}</td>
                                            <td>{{ $practicaI->DocenteTutor }}</td>
                                            <td>{{ $practicaI->NombreTutorEmpresarial }}</td>
                                            <td>{{ $practicaI->Empresa }}</td>
                                            <td>{{ $practicaI->Nivel }}</td>
                                            <td>{{ $practicaI->FechaInicio }}</td>
                                            <td>{{ $practicaI->FechaFinalizacion }}</td>
                                            <td>{{ $practicaI->HorasPlanificadas }}</td>
                                            <td>{{ $practicaI->Estado }}</td>
                                            <td>
                                                <form
                                                    action="{{ route('coordinador.actualizarEstadoEstudiante', ['id' => $practicaI->estudiante->EstudianteID]) }}"
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
                                                    action="{{ route('coordinador.editarNombreEmpresa', ['id' => $practicaI->estudiante->EstudianteID]) }}"
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
                                            <td>{{ $practicaII->estudiante->Apellidos }} {{ $practicaII->estudiante->Nombres }}</td>
                                            <td>{{ $practicaII->Practicas }}</td>
                                            <td>{{ $practicaII->DocenteTutor }}</td>
                                            <td>{{ $practicaII->NombreTutorEmpresarial }}</td>
                                            <td>{{ $practicaII->Empresa }}</td>
                                            <td>{{ $practicaII->Nivel }}</td>
                                            <td>{{ $practicaII->FechaInicio }}</td>
                                            <td>{{ $practicaII->FechaFinalizacion }}</td>
                                            <td>{{ $practicaII->HorasPlanificadas }}</td>
                                            <td>{{ $practicaII->Estado }}</td>
                                            <td>
                                                <form
                                                    action="{{ route('coordinador.actualizarEstadoEstudiante2', ['id' => $practicaII->estudiante->EstudianteID]) }}"
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
                                                    action="{{ route('coordinador.editarNombreEmpresa', ['id' => $practicaII->estudiante->EstudianteID]) }}"
                                                    method="get">
                                                    @csrf
                                                    @method('PUT')
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
        <h6><b>Estudiantes Practica I</b></h6>
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
                    <th>Nivel</th>
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
                                            <td>{{ $practicaI->estudiante->Apellidos }} {{ $practicaI->estudiante->Nombres }}</td>
                                            <td>{{ $practicaI->Practicas }}</td>
                                            <td>{{ $practicaI->DocenteTutor }}</td>
                                            <td>{{ $practicaI->NombreTutorEmpresarial }}</td>
                                            <td>{{ $practicaI->Empresa }}</td>
                                            <td>{{ $practicaI->Nivel }}</td>
                                            <td>{{ $practicaI->FechaInicio }}</td>
                                            <td>{{ $practicaI->FechaFinalizacion }}</td>
                                            <td>{{ $practicaI->HorasPlanificadas }}</td>
                                            <td>{{ $practicaI->Estado }}</td>
                                            <td>
                                                <form
                                                    action="{{ route('coordinador.actualizarEstadoEstudiante', ['id' => $practicaI->estudiante->EstudianteID]) }}"
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
        <h6><b>Estudiantes Practica II<b></h6>
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
                                            <td>{{ $practicaI->estudiante->Apellidos }} {{ $practicaI->estudiante->Nombres }}</td>
                                            <td>{{ $practicaI->Practicas }}</td>
                                            <td>{{ $practicaI->DocenteTutor }}</td>
                                            <td>{{ $practicaI->NombreTutorEmpresarial }}</td>
                                            <td>{{ $practicaI->Empresa }}</td>
                                            <td>{{ $practicaI->Nivel }}</td>
                                            <td>{{ $practicaI->FechaInicio }}</td>
                                            <td>{{ $practicaI->FechaFinalizacion }}</td>
                                            <td>{{ $practicaI->HorasPlanificadas }}</td>
                                            <td>{{ $practicaI->Estado }}</td>
                                            <td>
                                                <form
                                                    action="{{ route('coordinador.actualizarEstadoEstudiante2', ['id' => $practicaI->estudiante->EstudianteID]) }}"
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