@extends('layouts.app')
@section('title', 'Práctica 1')

@section('title_component', 'Panel Prácticas')

@section('content')
    @if (session('success'))
        <div class="contenedor_alerta success">
            <div class="icon_alert"><i class="fa-regular fa-circle-check fa-beat"></i></div>
            <div class="content_alert">
                <div class="title">Éxito!</div>
                <div class="body">{{ session('success') }}</div>
            </div>
        </div>
    @endif

    @if (session('error'))
        <div class="contenedor_alerta error">
            <div class="icon_alert"><i class="fa-regular fa-circle-x fa-beat"></i></div>
            <div class="content_alert">
                <div class="title">Error!</div>
                <div class="body">{{ session('error') }}</div>
            </div>
        </div>
    @endif

    @if (isset($practicaPendiente))
    <section class="content_recent_courses">
    <div class="row">
        <div class="col-md-6">
            
            <div class="table-responsive-sm">
                <table class="table2 table table-bordered mat-mdc-table">
                    <thead class="ng-star-inserted">
                        <tr class="mat-mdc-header-row mdc-data-table__header-row cdk-header-row ng-star-inserted">
                            <th class="table2th" colspan="2" style="min-width: 450px; font-size: 14px;">DETALLES DE LA PRÁCTICA</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th style=" text-transform: uppercase; font-size: 12px;">Estudiante:</th>
                            <td style=" text-transform: uppercase; font-size: 12px;">{{ strtoupper($practicaPendiente->estudiante->apellidos) }} {{ strtoupper($practicaPendiente->estudiante->nombres) }}</td>
                        </tr>
                        <tr>
                            <th style=" text-transform: uppercase; font-size: 12px;">Práctica:</th>
                            <td style=" text-transform: uppercase; font-size: 12px;">{{ $practicaPendiente->tipoPractica }}</td>
                        </tr>
                        <tr>
                            <th style=" text-transform: uppercase; font-size: 12px;">Docente Tutor:</th>
                            <td style=" text-transform: uppercase; font-size: 12px;">{{ strtoupper($practicaPendiente->tutorAcademico->apellidos) }} {{ strtoupper($practicaPendiente->tutorAcademico->nombres) }}</td>
                        </tr>
                        <tr>
                            <th style=" text-transform: uppercase; font-size: 12px;">Empresa:</th>
                            <td style=" text-transform: uppercase; font-size: 12px;">{{ strtoupper($practicaPendiente->Empresa->nombreEmpresa) }}</td>
                        </tr>
                        <tr>
                            <th style=" text-transform: uppercase; font-size: 12px;">Tutor Empresarial:</th>
                            <td style=" text-transform: uppercase; font-size: 12px;">{{ strtoupper($practicaPendiente->NombreTutorEmpresarial) }}</td>
                        </tr>
                        <tr>
                            <th style=" text-transform: uppercase; font-size: 12px;">Cédula Tutor Empresarial:</th>
                            <td style=" text-transform: uppercase; font-size: 12px;">{{ $practicaPendiente->CedulaTutorEmpresarial }}</td>
                        </tr>
                        <tr>
                            <th style=" text-transform: uppercase; font-size: 12px;">Función:</th>
                            <td style=" text-transform: uppercase; font-size: 12px;">{{ strtoupper($practicaPendiente->Funcion) }}</td>
                        </tr>
                        <tr>
                            <th style=" text-transform: uppercase; font-size: 12px;">Teléfono Tutor Empresarial:</th>
                            <td style=" text-transform: uppercase; font-size: 12px;">{{ $practicaPendiente->TelefonoTutorEmpresarial }}</td>
                        </tr>
                        <tr>
                            <th style=" text-transform: uppercase; font-size: 12px;">Estado de Fase I:</th>
                            <td style=" text-transform: uppercase; font-size: 12px;">{{ strtoupper($practicaPendiente->Estado) }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-md-5">
            <div class="container mt-4">
            <div>
                    <span class="title_icon_info">
                        <b>Generar documentación</b>
                        
                    </span>
                    <hr>
                </div>
            </div>
            <div class="card-buttons-container">
                <div class="card-body">
                    <form action="{{ route('generar.EncuestaEstudiante') }}" method="POST">
                        @csrf
                        <button type="submit" class="card-button">
                            <span><b>GENERAR ENCUESTA ESTUDIANTE</b></span>
                            <i class="fa-solid fa-square-poll-vertical"></i>
                        </button>
                    </form>
                </div>
                <div class="card-body">
                    <form action="{{ route('generar.EncuestaDocentes') }}" method="POST">
                        @csrf
                        <button type="submit" class="card-button">
                            <span><b>GENERAR ENCUESTA DOCENTE</b></span>
                            <i class="fa-solid fa-square-poll-vertical"></i>
                        </button>
                    </form>
                </div>
                <div class="card-body">
                    <form action="{{ route('generar.EvTutorEmpresarial') }}" method="POST">
                        @csrf
                        <button type="submit" class="card-button">
                            <span><b>GENERAR EVALUACIÓN TUTOR EMPRESARIAL</b></span>
                            <i class="fas fa-file-excel"></i>
                        </button>
                    </form>
                </div>
                <div class="card-body">
                    <form action="{{ route('generar.PlanificacionPPEstudiante') }}" method="POST">
                        @csrf
                        <button type="submit" class="card-button">
                            <span><b>GENERAR PLANIFICACIÓN DE ESTUDIANTE</b></span>
                            <i class="fas fa-file-excel"></i>
                        </button>
                    </form>
                </div>
                <div class="card-body">
                    <form action="{{ route('generar.ControlAvanceActividades') }}" method="POST">
                        @csrf
                        <button type="submit" class="card-button btn-block">
                            <span><b>GENERAR AVANCE DE ACTIVIDADES</b></span>
                            <i class="fas fa-file-excel"></i>
                        </button>
                    </form>
                </div>
                <div class="card-body">
                    <form action="{{ route('generar.EvTutorAcademico') }}" method="POST">
                        @csrf
                        <button type="submit" class="card-button btn-block">
                            <span><b>GENERAR EVALUACIÓN TUTOR ACADÉMICO</b></span>
                            <i class="fas fa-file-excel"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <br>
</section>

            <!-- Botón para abrir el card -->
            <button type="button" class="button1" onclick="openCard('draggableCardActividad')">
                Agregar actividad
            </button>
            <br>

            <!-- Card para agregar actividad -->
            <div class="draggable-card" id="draggableCardActividad" style="display: none;">
                <div class="card-header">
                    <span class="card-title">Agregar Actividad</span>
                    <button type="button" class="close" onclick="closeCard('draggableCardActividad')">&times;</button>
                </div>
                <div class="card-body">
                    <form id="actividadForm" action="{{ route('estudiantes.guardarActividadesPracticas1') }}"
                        method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" id="EstudianteID" name="EstudianteID"
                            value="{{ $practicaPendiente->estudiante->estudianteId }}">
                        <input type="hidden" id="PracticasI" name="PracticasI"
                            value="{{ $practicaPendiente->practicasi }}">
                        <div class="form-group">
                            <label class="label" for="Actividad"><strong>Actividad Realizada:</strong></label>
                            <textarea id="Actividad" name="Actividad" class="form-control input"></textarea>
                        </div>
                        <div class="form-group">
                            <label class="label" for="horas"><strong>Número de Horas:</strong></label>
                            <input type="text" id="horas" name="horas" class="form-control input">
                        </div>
                        <div class="form-group">
                            <label class="label" for="observaciones"><strong>Observación:</strong></label>
                            <input type="text" id="observaciones" name="observaciones" class="form-control input">
                        </div>
                        <div class="form-group">
                            <label class="label" for="fechaActividad"><strong>Fecha de la Actividad:</strong></label>
                            <input type="date" id="fechaActividad" name="fechaActividad" class="form-control input">
                        </div>
                        <div class="form-group">
                            <label class="label" for="departamento"><strong>Departamento:</strong></label>
                            <input type="text" id="departamento" name="departamento" class="form-control input">
                        </div>
                        <div class="form-group">
                            <label class="label" for="funcion"><strong>Función Asignada:</strong></label>
                            <input type="text" id="funcion" name="funcion" class="form-control input">
                        </div>
                        <div class="form-group">
                            <label for="evidencia">Evidencia:</label>
                            <input type="file" id="evidencia" name="evidencia" class="form-control-file input">
                        </div>
                        <div class="modal-footer card-footer1">
                            <button type="submit" class="button">Guardar Actividad</button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Script para abrir y cerrar el card -->
            <script>
                function openCard(cardId) {
                    document.getElementById(cardId).style.display = 'block';
                }

                function closeCard(cardId) {
                    document.getElementById(cardId).style.display = 'none';
                }
            </script>

            <br>

            <div class="contenedor_tabla">
                <div class="table-container mat-elevation-z8">

                    <div id="tablaActividades">
                        <table id="tablaAsignaciones" class="mat-mdc-table">

                            <thead class="ng-star-inserted">
                                <tr class="mat-mdc-header-row mdc-data-table__header-row cdk-header-row ng-star-inserted">
                                    <th>ACTIVIDAD REALIZADA</th>
                                    <th>HORAS</th>
                                    <th>OBSERVACIONES</th>
                                    <th>FECHA DE LA ACTIVIDAD</th>
                                    <th>DEPARTAMENTO</th>
                                    <th>FUNCIÓN ASIGNADA</th>
                                    <th>EVIDENCIA</th>
                                    <th>ACCIONES</th>
                                </tr>
                            </thead>
                            <tbody class="mdc-data-table__content ng-star-inserted">
                                @if ($actividades->isEmpty())
                                    <tr style="text-align:center">
                                        <td class="noExisteRegistro1" style="font-size: 16px !important;"colspan="10">No
                                            hay actividades agregadas.</td>
                                    </tr>
                                @else
                                    @foreach ($actividades as $actividad)
                                        <tr>
                                            <td style=" text-transform: uppercase;">{{ $actividad->actividad }}</td>
                                            <td style=" text-transform: uppercase; ">{{ $actividad->horas }}</td>
                                            <td style=" text-transform: uppercase;">{{ $actividad->observaciones }}</td>
                                            <td style=" text-transform: uppercase;">{{ $actividad->fechaActividad }}</td>
                                            <td style=" text-transform: uppercase;">{{ $actividad->departamento }}</td>
                                            <td style=" text-transform: uppercase;">{{ $actividad->funcion }}</td>
                                            <td  style="text-transform: uppercase; word-wrap: break-word; text-align: center;"><img src="data:image/png;base64,{{ $actividad->evidencia }}" width="100" height="100"
                                                    alt="Evidencia de la actividad" ></td>
                                            <td>
                                                <form
                                                    action="{{ route('estudiantes.eliminarActividadPracticas1', $actividad->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <div class="tooltip-container">
                                                        <span class="tooltip-text">Eliminar</span>
                                                        <button type="submit"
                                                            class="button3 efects_button btn_eliminar3"> <i
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
                                                <div class="draggable-card" id="modalEditarActividad{{ $actividad->id }}"
                                                    tabindex="-1" role="dialog"
                                                    aria-labelledby="modalEditarActividadLabel{{ $actividad->id }}"
                                                    aria-hidden="true">

                                                    <div class="card-header">
                                                        <span class="card-title1"
                                                            id="modalEditarActividadLabel{{ $actividad->id }}">
                                                            Editar
                                                            Actividad</span>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true"><i
                                                                    class="fa-thin fa-xmark"></i></span>
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
                                                                    value="{{ $actividad->horas }}" class="form-control">
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
    @endif
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

    </div>
<br>
    <button class="button1" onclick="toggleForm()">Generar Informe</button>

<hr>
    <form id="formulario" action="{{ route('generar.InformPractica') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-md-4">
        <div class="form-group">
            <label for="introduccion">Introducción:</label>
            <textarea id="introduccion" name="introduccion" class="form-control input textarea" placeholder="Ingrese la introducción" required></textarea>
        </div>
</div>
<div class="col-md-4">
        <div class="form-group">
            <label for="conclusion">Conclusiones:</label>
            <textarea id="conclusion" name="conclusion" class="form-control input textarea " placeholder="Ingrese las conclusiones" required></textarea>
        </div>
</div>
<div class="col-md-4">
        <div class="form-group">
            <label for="recomendaciones">Recomendaciones:</label>
            <textarea id="recomendaciones" name="recomendaciones" class="form-control input textarea" placeholder="Ingrese las recomendaciones" required></textarea>
        </div>
</div>
</div>
       <center> <button type="submit" class="button1">Descargar Informe</button> </center>
    </form>











    <!--------------------------------- De aqui para abajo es otra zona de trabajoooooooooooooooooooooo------------------>
@else
    <br>
    <h3><b>Fase 1 - Inicio del proceso de prácticas pre profesionales del estudiante</b></h3>
    <hr>
    <form action="{{ route('guardarPracticas') }}" method="POST">
        @csrf
        <div class="table-responsive-sm">
            <table class="table2 table table-bordered">
                <tr class="mat-mdc-header-row mdc-data-table__header-row cdk-header-row ng-star-inserted">
                    <th class="tamanio1 table2th" colspan="2">
                        <center>DATOS DEL ESTUDIANTE:</center>
                    </th>
                </tr>
                <tbody>
                    <tr>
                        <th style=" text-transform: uppercase; font-size: 13px; color: rgba(26, 26, 26, 0.753);"><b>ID de Estudiante:</b></th>
                        <td style=" text-transform: uppercase; font-size: 13px;">{{ strtoupper($estudiante->espeId) }}</td>
                    </tr>
                    <tr>
                        <th style=" text-transform: uppercase; font-size: 13px; color: rgba(26, 26, 26, 0.753);" ><b>Cédula:</b></th>
                        <td style=" text-transform: uppercase; font-size: 13px;">{{ strtoupper($estudiante->cedula) }}</td>
                    </tr>
                    <tr>
                        <th style=" text-transform: uppercase; font-size: 13px; color: rgba(26, 26, 26, 0.753);"><b>ESTUDIANTE:</b></th>
                        <td style=" text-transform: uppercase; font-size: 13px;">{{ strtoupper($estudiante->apellidos) }}
                            {{ strtoupper($estudiante->nombres) }}
                        </td>
                    </tr>
                    <tr>
                        <th style=" text-transform: uppercase; font-size: 13px; color: rgba(26, 26, 26, 0.753);"><b>Correo:</b></th>
                        <td style=" font-size: 13px;">{{ $correoEstudiante }}</td>
                    </tr>
                    <tr>
                        <th style=" text-transform: uppercase; font-size: 13px; color: rgba(26, 26, 26, 0.753);"><b>Nivel:</b></th>
                        <td style=" text-transform: uppercase; font-size: 13px;">
                            <select id="Nivel" name="Nivel" class="form-control input input_select3">
                                <option value="">Seleccione un nivel</option>
                                <option value="Pregrado">PREGRADO</option>
                                <option value="Posgrado">POSTGRADO</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th style=" text-transform: uppercase; font-size: 13px; color: rgba(26, 26, 26, 0.753);"><b>Campus:</b></th>
                        <td style=" text-transform: uppercase; font-size: 13px;">EXTENSIÓN SANTO DOMINGO</td>
                    </tr>
                    <tr>
                        <th style=" text-transform: uppercase; font-size: 13px ;   color: rgba(26, 26, 26, 0.753);"><b>Departamento:</b></th>
                        <td style=" text-transform: uppercase; font-size: 13px;">{{ strtoupper($estudiante->departamento) }}</td>
                    </tr>
                    <tr>
                        <th style=" text-transform: uppercase; font-size: 13px;   color: rgba(26, 26, 26, 0.753);"><b>Escoja Práctica:</b></th>
                        <td style=" text-transform: uppercase; font-size: 13px;">
                            <select id="Practicas" name="Practicas" class="form-control input input_select3">
                                <option value="">Seleccione una práctica</option>
                                <option value="SERVICIO A LA COMUNIDAD">SERVICIO A LA COMUNIDAD</option>
                                <option value="PASANTIAS">PASANTÍAS</option>
                                <option value="PRACTICAS PRE PROFESIONALES">PRÁCTICAS PRE PROFESIONALES
                                </option>
                                <option value="AYUDANDIA DE CATEDRA">AYUDANTÍA DE CATEDRA</option>
                                <option value="AYUDANTIA DE INVESTIGACION">AYUDANTÍA DE INVESTIGACION
                                </option>
                                <option value="RECONOCE EXPERIENCIA LABORAL">RECONOCE EXPERIENCIA LABORAL
                                </option>
                                <option value="P. INTEGRADOR SABERES">P. INTEGRADOR SABERES</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th style=" text-transform: uppercase; font-size: 13px; color: rgba(26, 26, 26, 0.753);"><b>Teléfono:</b></th>
                        <td style=" text-transform: uppercase; font-size: 13px; ">{{ strtoupper($estudiante->celular) }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <br>
        <hr>

        <div class="table-responsive-sm">

            <table class="table2 table table-bordered">
                <tr class="mat-mdc-header-row mdc-data-table__header-row cdk-header-row ng-star-inserted">
                    <th class="tamanio1 table2th" colspan="2">
                        <center>DATOS DE LA PRÁCTICA</center>
                    </th>
                </tr>
                <tbody>
                    <tr>
                        <th>Estado Académico Actual:</th>
                        <td>
                            <select id="EstadoAcademico" name="EstadoAcademico" class="form-control input input_select3">
                                <option value="1">Seleccione un estado académico</option>
                                <option value="FINALIZANDO ESTUDIOS">FINALIZANDO ESTUDIOS</option>
                                <option value="CURSANDO ESTUDIOS">CURSANDO ESTUDIOS</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th>Fecha de inicio de la práctica:</th>
                        <td>
                            <input type="date" id="FechaInicio" name="FechaInicio"
                                class="form-control input input_select3">
                        </td>
                    </tr>
                    <tr>
                        <th>Fecha de finalización de la práctica:</th>
                        <td>
                            <input type="date" id="FechaFinalizacion" name="FechaFinalizacion"
                                class="form-control input input_select3">
                        </td>
                    </tr>
                    <tr>
                        <th>Horas planificadas:</th>
                        <td>
                            <input type="number" id="HorasPlanificadas" name="HorasPlanificadas"
                                class="form-control input input_select3" min="80" max="144">
                            <small id="errorHorasPlanificadas" style="color: red;"></small>
                        </td>
                    </tr>
                    <tr>
                        <th>Horario de entrada:</th>
                        <td>
                            <input type="time" id="HoraEntrada" name="HoraEntrada"
                                class="form-control input input_select3">
                        </td>
                    </tr>
                    <tr>
                        <th>Horario de salida:</th>
                        <td>
                            <input type="time" id="HoraSalida" name="HoraSalida"
                                class="form-control input input_select3">
                        </td>
                    </tr>
                    <tr>
                        <th>Área de conocimiento:</th>
                        <td>
                            <input type="text" id="AreaConocimiento" name="AreaConocimiento"
                                class="form-control input input_select3">
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <br>

        <button type="button" id="verOpcionesBtn" class="button1 btn3"><i
                class="fa-regular fa-magnifying-glass-plus"></i> Ver opciones de
            prácticas</button>
        <br>
        <hr>
        <div class="table-responsive-sm">

            <table id="opcionesPracticas" class="table2 table table-bordered" style="display: none;">
                <tr class="mat-mdc-header-row mdc-data-table__header-row cdk-header-row ng-star-inserted">
                    <th class="tamanio1 table2th" colspan="2">
                        <center>PRÁCTICA PREPROFESIONAL NO REMUNERADA, PASANTÍA O AYUDA A LA COMUNIDAD </center>
                    </th>
                </tr>
                <tbody>
                    <tr>
                        <th>Sugiera un docente como tutor académico:</th>
                        <td>
                            <div class="form-group">
                                <label for="ID_tutorAcademico">
                                </label>
                                <select name="ID_tutorAcademico" class="form-control input input_select3" required>
                                    <option value="">Seleccione un tutor académico</option>
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
                                <select name="nrc" class="form-control input input_select3" required>
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
                            <select id="Empresa" name="Empresa" class="form-control input input_select4 ">
                                <option value="1">Seleccione una empresa</option>
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
                                class="form-control input input_select3">
                            <div id="errorCedula" style="color: red;"></div>
                        </td>

                    </tr>

                    <tr>
                        <th>Nombre del tutor empresarial:</th>
                        <td>
                            <input type="text" id="NombreTutorEmpresarial" name="NombreTutorEmpresarial"
                                class="form-control input input_select3">
                            <div id="errorNombre" style="color: red;"></div>
                        </td>

                    </tr>

                    <tr>
                        <th>Funcion:</th>
                        <td>
                            <input type="text" id="Funcion" name="Funcion"
                                class="form-control input input_select3">
                        </td>

                    </tr>

                    <tr>
                        <th>Telefono:</th>
                        <td>
                            <input type="text" id="TelefonoTutorEmpresarial" name="TelefonoTutorEmpresarial"
                                class="form-control input input_select3">
                            <div id="errorTelefono" style="color: red;"></div>
                        </td>

                    </tr>

                    <tr>
                        <th>Email:</th>
                        <td>
                            <input type="text" id="EmailTutorEmpresarial" name="EmailTutorEmpresarial"
                                class="form-control input input_select3">
                            <div id="errorEmail" style="color: red;"></div>
                        </td>
                    </tr>

                    <tr>
                        <th>Departamento dentro de la empresa:</th>
                        <td>
                            <input type="text" id="DepartamentoTutorEmpresarial" name="DepartamentoTutorEmpresarial"
                                class="form-control input input_select3">
                        </td>

                    </tr>



                </tbody>

            </table>
        </div>
        <br>
        <center><button type="submit" id="iniciarPracticasBtn" class="button1 btn_excel" style="display: none;">Iniciar
                prácticas</button></center>
    </form>
    @endif
    </div>


<link rel="stylesheet" href="https://cdn.ckeditor.com/4.16.1/standard/ckeditor.css">
<script src="https://cdn.ckeditor.com/4.16.1/standard/ckeditor.js"></script>
<script src="{{ asset('js/plantilla/main.js') }}" type="module"></script>
<script src="js\admin\acciones.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/ui/1.13.0/jquery-ui.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.js"></script>
<script src="{{ asset('js/estudiante/practicas.js') }}"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
    $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip({
            template: '<div class="tooltip custom-tooltip" role="tooltip"><div class="arrow"></div><div class="tooltip-inner"></div></div>'
        });

        $('.card-button').on('click', function(){
            $('.card-button').removeClass('active');
            $(this).addClass('active');
        });
    });
</script>
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
    $(document).ready(function() {
        // Hacer que el card sea draggable
        $('.draggable-card').draggable({
            handle: ".card-header",
            containment: "window"
        });
        // Hacer el card draggable
        document.addEventListener('DOMContentLoaded', function() {
            $("#draggableCardActividad").draggable({
                handle: ".card-header"
            });
        });
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', (event) => {
        // Selecciona el elemento de la alerta
        const alertElement = document.querySelector('.contenedor_alerta');
        // Establece un temporizador para ocultar la alerta después de 2 segundos
        setTimeout(() => {
            if (alertElement) {
                alertElement.style.display = 'none';
            }
        }, 1000); // 2000 milisegundos = 2 segundos
    });
</script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Asegura que el formulario esté oculto al cargar la página
        var form = document.getElementById("formulario");
        form.style.display = "none";
    });

    function toggleForm() {
        var form = document.getElementById("formulario");
        if (form.style.display === "none" || form.style.display === "") {
            form.style.display = "block";
        } else {
            form.style.display = "none";
        }
    }
</script>

<style>
    .contenedor_tabla .table-container table td {
        width: 200px;
        min-width: 150px;
        font-size: 11px !important;
        padding: .5rem !important;
    }

    .contenedor_tabla .table-container table th {
        position: sticky;
        font-size: .8em !important;
    }
    </style>

@endsection
