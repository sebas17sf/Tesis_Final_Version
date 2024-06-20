@extends('layouts.app')

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





    @if (isset($practicaPendiente))
        <div class="container">
            <h4>Detalles de la Práctica en Ejecución:</h4>
            <div class="row">
                <div class="col-md-6">

                    <dl class="row">
                        <dt class="col-sm-5 text-nowrap">Estudiante:</dt>
                        <dd class="col-sm-7">{{ $practicaPendiente->estudiante->apellidos }}
                            {{ $practicaPendiente->estudiante->nombres }}</dd>
                        <dt class="col-sm-5 text-nowrap">Práctica:</dt>
                        <dd class="col-sm-7">{{ $practicaPendiente->tipoPractica }}</dd>
                        <dt class="col-sm-5 text-nowrap">Docente Tutor:</dt>
                        <dd class="col-sm-7">{{ $practicaPendiente->tutorAcademico->Apellidos }}
                            {{ $practicaPendiente->tutorAcademico->Nombres }}</dd>
                        <dt class="col-sm-5 text-nowrap">Empresa:</dt>
                        <dd class="col-sm-7">{{ $practicaPendiente->Empresa->nombreEmpresa }}</dd>
                        <dt class="col-sm-5 text-nowrap">Tutor Empresarial:</dt>
                        <dd class="col-sm-7">{{ $practicaPendiente->NombreTutorEmpresarial }}</dd>
                        <dt class="col-sm-5 text-nowrap">Cédula Tutor Empresarial:</dt>
                        <dd class="col-sm-7">{{ $practicaPendiente->CedulaTutorEmpresarial }}</dd>
                        <dt class="col-sm-5 text-nowrap">Función:</dt>
                        <dd class="col-sm-7">{{ $practicaPendiente->Funcion }}</dd>
                        <dt class="col-sm-5 text-nowrap">Teléfono Tutor Empresarial:</dt>
                        <dd class="col-sm-7">{{ $practicaPendiente->TelefonoTutorEmpresarial }}</dd>
                        <dt class="col-sm-5 text-nowrap">Estado de Fase I:</dt>
                        <dd class="col-sm-7">{{ $practicaPendiente->Estado }}</dd>
                    </dl>
                </div>
                <div class="col-md-6">
                    <div class="card-body">
                        <form action="{{ route('generar.EncuestaEstudiante') }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-light btn-block">
                                <i class="fas fa-file-excel"></i> Generar Encuesta Estudiantes
                            </button>
                        </form>
                    </div>


                    <div class="card-body">
                        <form action="{{ route('generar.EncuestaDocentes') }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-light btn-block">
                                <i class="fas fa-file-excel"></i> Generar Encuesta Docente
                            </button>
                        </form>
                    </div>

                    <div class="card-body">
                        <form action="{{ route('generar.EvTutorEmpresarial') }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-light btn-block">
                                <i class="fas fa-file-excel"></i> Generar Evaluacion Tutor Empresarial
                            </button>
                        </form>
                    </div>

                    <div class="card-body">
                        <form action="{{ route('generar.PlanificacionPPEstudiante') }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-light btn-block">
                                <i class="fas fa-file-excel"></i> Generar Planificacion Estudiante
                            </button>
                        </form>
                    </div>
                </div>




                    <br>
                    <button type="button" class="button" data-toggle="modal" data-target="#modalAgregarActividad">
                        Agregar actividad
                    </button>
                    <br>


                    <div class="modal fade" id="modalAgregarActividad" tabindex="-1" role="dialog"
                        aria-labelledby="modalAgregarActividadLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalAgregarActividadLabel">Agregar Actividad</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form id="actividadForm"
                                        action="{{ route('estudiantes.guardarActividadesPracticas1') }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" id="EstudianteID" name="EstudianteID"
                                            value="{{ $practicaPendiente->estudiante->estudianteId }}">
                                        <input type="hidden" id="PracticasI" name="PracticasI"
                                            value="{{ $practicaPendiente->practicasi }}">
                                        <div class="form-group">
                                            <label for="Actividad">Actividad Realizada:</label>
                                            <textarea id="Actividad" name="Actividad" class="form-control input"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="horas">Número de Horas:</label>
                                            <input type="text" id="horas" name="horas" class="form-control input">
                                        </div>
                                        <div class="form-group">
                                            <label for="observaciones">Observación:</label>
                                            <input type="text" id="observaciones" name="observaciones"
                                                class="form-control input">
                                        </div>
                                        <div class="form-group">
                                            <label for="fechaActividad">Fecha de la Actividad:</label>
                                            <input type="date" id="fechaActividad" name="fechaActividad"
                                                class="form-control input">
                                        </div>
                                        <div class="form-group">
                                            <label for="departamento">Departamento:</label>
                                            <input type="text" id="departamento" name="departamento"
                                                class="form-control input">
                                        </div>
                                        <div class="form-group">
                                            <label for="funcion">Función Asignada:</label>
                                            <input type="text" id="funcion" name="funcion"
                                                class="form-control input">
                                        </div>
                                        <div class="form-group">
                                            <label for="evidencia">Evidencia:</label>
                                            <input type="file" id="evidencia" name="evidencia"
                                                class="form-control-file input">
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="button" data-dismiss="modal">Cerrar</button>
                                            <button type="submit" class="button">Guardar Actividad</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>

                    <div class="table-responsive-sm">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Actividad Realizada</th>
                                    <th>Horas</th>
                                    <th>Observaciones</th>
                                    <th>Fecha de la Actividad</th>
                                    <th>Departamento</th>
                                    <th>Función Asignada</th>
                                    <th>Evidencia</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($actividades as $actividad)
                                    <tr>
                                        <td>{{ $actividad->actividad }}</td>
                                        <td>{{ $actividad->horas }}</td>
                                        <td>{{ $actividad->observaciones }}</td>
                                        <td>{{ $actividad->fechaActividad }}</td>
                                        <td>{{ $actividad->departamento }}</td>
                                        <td>{{ $actividad->funcion }}</td>
                                        <td><img src="data:image/png;base64,{{ $actividad->evidencia }}"
                                                alt="Evidencia de la actividad" width="100px"></td>
                                        <td>
                                            <form
                                                action="{{ route('estudiantes.eliminarActividadPracticas1', $actividad->id) }}"
                                                method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <div class="tooltip-container">
                                                    <span class="tooltip-text">Eliminar</span>
                                                    <button type="submit" class="button3 efects_button btn_eliminar3"> <i
                                                            class="material-icons">delete</i></button>
                                                </div>
                                            </form>
                                            <div class="tooltip-container">
                                                <span class="tooltip-text">Editar</span>
                                                <button type="button" class="button3 efects_button btn_editar3"
                                                    data-toggle="modal"
                                                    data-target="#modalEditarActividad{{ $actividad->id }}">
                                                    <i class="material-icons">edit</i>
                                                </button>
                                            </div>

                                            <!-- Modal para editar actividad -->
                                            <div class="modal fade" id="modalEditarActividad{{ $actividad->id }}"
                                                tabindex="-1" role="dialog"
                                                aria-labelledby="modalEditarActividadLabel{{ $actividad->id }}"
                                                aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title"
                                                                id="modalEditarActividadLabel{{ $actividad->id }}">Editar
                                                                Actividad</h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form
                                                                action="{{ route('estudiantes.actualizarActividadPracticas1', $actividad->id) }}"
                                                                method="POST" enctype="multipart/form-data">
                                                                @csrf
                                                                @method('PUT')
                                                                <div class="form-group">
                                                                    <label for="Actividad">Actividad Realizada:</label>
                                                                    <input type="text" id="Actividad" name="Actividad"
                                                                        value="{{ $actividad->actividad }}"
                                                                        class="form-control">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="horas">Horas:</label>
                                                                    <input type="text" id="horas" name="horas"
                                                                        value="{{ $actividad->horas }}"
                                                                        class="form-control">
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="observaciones">Observaciones:</label>
                                                                    <input type="text" id="observaciones"
                                                                        name="observaciones"
                                                                        value="{{ $actividad->observaciones }}"
                                                                        class="form-control">
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="fechaActividad">Fecha de la
                                                                        Actividad:</label>
                                                                    <input type="date" id="fechaActividad"
                                                                        name="fechaActividad"
                                                                        value="{{ $actividad->fechaActividad }}"
                                                                        class="form-control">
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="departamento">Departamento:</label>
                                                                    <input type="text" id="departamento"
                                                                        name="departamento"
                                                                        value="{{ $actividad->departamento }}"
                                                                        class="form-control">
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="funcion">Función Asignada:</label>
                                                                    <input type="text" id="funcion" name="funcion"
                                                                        value="{{ $actividad->funcion }}"
                                                                        class="form-control">
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="evidencia">Evidencia:</label>
                                                                    <input type="file" id="evidencia" name="evidencia"
                                                                        class="form-control-file">
                                                                </div>

                                                                <div class="modal-footer">
                                                                    <button type="button" class="button"
                                                                        data-dismiss="modal">Cerrar</button>
                                                                    <button type="submit" class="button">Guardar
                                                                        Cambios</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                        </td>



                                    </tr>
                                @endforeach
                            </tbody>

                            <tfoot>
                                <tr>
                                    <td colspan="7" align="left"><strong>Total horas realizadas:</strong>
                                        {{ $totalHoras }} / {{ $practicaPendiente->HorasPlanificadas }}
                                    </td>
                                </tr>
                            </tfoot>
                        </table>


                    </div>



                </div>










                <!--------------------------------- De aqui para abajo es otra zona de trabajoooooooooooooooooooooo------------------>
            @else
                <br>
                <hr>

                <h3>Fase 1 - Inicio del proceso de prácticas pre profesionales del estudiante</h3>
                <form action="{{ route('guardarPracticas') }}" method="POST">
                    @csrf
                    <div class="table-responsive-sm">
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <th>ID de Estudiante:</th>
                                    <td>{{ strtoupper($estudiante->espeId) }}</td>
                                </tr>
                                <tr>
                                    <th>Cédula:</th>
                                    <td>{{ strtoupper($estudiante->cedula) }}</td>
                                </tr>
                                <tr>
                                    <th>Nombres Completos:</th>
                                    <td>{{ strtoupper($estudiante->apellidos) }}
                                        {{ strtoupper($estudiante->nombres) }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>Correo:</th>
                                    <td>{{ strtoupper($correoEstudiante) }}</td>
                                </tr>
                                <tr>
                                    <th>Nivel:</th>
                                    <td>
                                        <select id="Nivel" name="Nivel" class="form-control">
                                            <option value="Pregrado">Pregrado</option>
                                            <option value="Posgrado">Posgrado</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Campus:</th>
                                    <td>EXTENSION SANTO DOMINGO</td>
                                </tr>
                                <tr>
                                    <th>Departamento:</th>
                                    <td>{{ strtoupper($estudiante->departamento) }}</td>
                                </tr>
                                <tr>
                                    <th>Escoja Práctica:</th>
                                    <td>
                                        <select id="Practicas" name="Practicas" class="form-control">
                                            <option value="SERVICIO A LA COMUNIDAD">SERVICIO A LA COMUNIDAD</option>
                                            <option value="PASANTIAS">PASANTIAS</option>
                                            <option value="PRACTICAS PRE PROFESIONALES">PRACTICAS PRE PROFESIONALES
                                            </option>
                                            <option value="AYUDANDIA DE CATEDRA">AYUDANDIA DE CATEDRA</option>
                                            <option value="AYUDANTIA DE INVESTIGACION">AYUDANTIA DE INVESTIGACION
                                            </option>
                                            <option value="RECONOCE EXPERIENCIA LABORAL">RECONOCE EXPERIENCIA LABORAL
                                            </option>
                                            <option value="P. INTEGRADOR SABERES">P. INTEGRADOR SABERES</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Teléfono:</th>
                                    <td>{{ strtoupper($estudiante->celular) }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>


                    <div class="table-responsive-sm">
                        <h3>Datos de la Práctica</h3>
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <th>Estado Académico Actual:</th>
                                    <td>
                                        <select id="EstadoAcademico" name="EstadoAcademico" class="form-control">
                                            <option value="FINALIZANDO ESTUDIOS">FINALIZANDO ESTUDIOS</option>
                                            <option value="CURSANDO ESTUDIOS">CURSANDO ESTUDIOS</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Fecha de inicio de la práctica:</th>
                                    <td>
                                        <input type="date" id="FechaInicio" name="FechaInicio" class="form-control">
                                    </td>
                                </tr>
                                <tr>
                                    <th>Fecha de finalización de la práctica:</th>
                                    <td>
                                        <input type="date" id="FechaFinalizacion" name="FechaFinalizacion"
                                            class="form-control">
                                    </td>
                                </tr>
                                <tr>
                                    <th>Horas planificadas:</th>
                                    <td>
                                        <input type="number" id="HorasPlanificadas" name="HorasPlanificadas"
                                            class="form-control" min="80" max="144">
                                    </td>
                                </tr>
                                <tr>
                                    <th>Horario de entrada:</th>
                                    <td>
                                        <input type="time" id="HoraEntrada" name="HoraEntrada" class="form-control">
                                    </td>
                                </tr>
                                <tr>
                                    <th>Horario de salida:</th>
                                    <td>
                                        <input type="time" id="HoraSalida" name="HoraSalida" class="form-control">
                                    </td>
                                </tr>
                                <tr>
                                    <th>Área de conocimiento:</th>
                                    <td>
                                        <input type="text" id="AreaConocimiento" name="AreaConocimiento"
                                            class="form-control">
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>




                    <button type="button" id="verOpcionesBtn" class="btn btn-sm btn-secondary">Ver opciones de
                        prácticas</button>
                    <br><br>
                    <table id="opcionesPracticas" class="table table-bordered" style="display: none;">
                        <tbody>
                            <tr>
                                <th>Sugiera un docente como tutor académico:</th>
                                <td>
                                    <div class="form-group">
                                        <label for="ID_tutorAcademico">
                                        </label>
                                        <select name="ID_tutorAcademico" class="form-control input input select" required>
                                            <option value="">Seleccionar el Docente</option>
                                            @foreach ($profesores as $profesor)
                                                <option value="{{ $profesor->id }}"> {{ $profesor->apellidos }}
                                                    {{ $profesor->nombres }}
                                                    {{ $profesor->Departamento }} {{ $profesor->Correo }} </option>
                                            @endforeach
                                        </select>
                                    </div>

                                </td>
                            </tr>

                            <tr>
                                <th>NRC Practica</th>
                                <td>
                                    <div class="form-group">
                                        <select name="nrc" class="form-control input input-select" required>
                                            <option value="">Seleccionar NRC</option>
                                            @foreach ($nrcpracticas1 as $nrc)
                                                <option value="{{ $nrc->id }}">{{ $nrc->nrc }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <th>Empresa:</th>
                                <td>
                                    <select id="Empresa" name="Empresa" class="form-control">
                                        @foreach ($empresas as $empresa)
                                            <option value="{{ $empresa->id }}">{{ $empresa->nombreEmpresa }} -
                                                Requiere: {{ $empresa->actividadesMacro }} </option>
                                        @endforeach
                                    </select>
                                </td>
                            </tr>

                            <tr>
                                <th>Cédula del tutor empresarial:</th>
                                <td>
                                    <input type="text" id="CedulaTutorEmpresarial" name="CedulaTutorEmpresarial"
                                        class="form-control">
                                </td>

                            </tr>

                            <tr>
                                <th>Nombre del tutor empresarial:</th>
                                <td>
                                    <input type="text" id="NombreTutorEmpresarial" name="NombreTutorEmpresarial"
                                        class="form-control">
                                </td>

                            </tr>

                            <tr>
                                <th>Funcion:</th>
                                <td>
                                    <input type="text" id="Funcion" name="Funcion" class="form-control">
                                </td>

                            </tr>

                            <tr>
                                <th>Telefono:</th>
                                <td>
                                    <input type="text" id="TelefonoTutorEmpresarial" name="TelefonoTutorEmpresarial"
                                        class="form-control">
                                </td>

                            </tr>

                            <tr>
                                <th>Email:</th>
                                <td>
                                    <input type="text" id="EmailTutorEmpresarial" name="EmailTutorEmpresarial"
                                        class="form-control">
                                </td>
                            </tr>

                            <tr>
                                <th>Departamento dentro de la empresa:</th>
                                <td>
                                    <input type="text" id="DepartamentoTutorEmpresarial"
                                        name="DepartamentoTutorEmpresarial" class="form-control">
                                </td>

                            </tr>



                        </tbody>

                    </table>
                    <button type="submit" id="iniciarPracticasBtn" class="btn btn-sm btn-secondary"
                        style="display: none;">Iniciar
                        prácticas</button>
                </form>
    @endif
    </div>





@endsection



<script>
    document.addEventListener('DOMContentLoaded', function() {
        var verOpcionesBtn = document.getElementById('verOpcionesBtn');
        var opcionesPracticas = document.getElementById('opcionesPracticas');
        var iniciarPracticasBtn = document.getElementById('iniciarPracticasBtn');

        var opcionesAbiertas = false; // Variable para rastrear el estado de las opciones

        verOpcionesBtn.addEventListener('click', function() {
            if (opcionesAbiertas) {
                opcionesPracticas.style.display = 'none'; // Cierra las opciones
                iniciarPracticasBtn.style.display = 'none'; // Oculta el botón de inicio
            } else {
                opcionesPracticas.style.display = 'table'; // Abre las opciones
                iniciarPracticasBtn.style.display = 'block'; // Muestra el botón de inicio
            }

            // Cambia el estado de las opciones
            opcionesAbiertas = !opcionesAbiertas;
        });

        iniciarPracticasBtn.addEventListener('click', function() {
            // Aquí puedes agregar la lógica para cuando se hace clic en "Iniciar prácticas"
        });
    });
</script>
