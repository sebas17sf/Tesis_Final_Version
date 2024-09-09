@extends('layouts.app')
@section('title', 'Práctica 2')

@section('title_component', 'Panel Prácticas II')

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
    <!-- Sección para FORMATOS PRÁCTICA II -->
    <div class="title_icon_info" style="text-align:left !important;">
        <b>Documentación</b>
    </div>
    <section class="content_recent_courses">
        <div class="container_cources_cards">
            <hr>
            <div class="container_cources scroll_element">
                <div class="cards">
                    <form action="{{ route('generar.EncuestaEstudiante2') }}" method="POST">
                        @csrf
                        <button type="submit" class="card-button">
                            <span><b>ENCUESTA ESTUDIANTE</b></span>
                            <i class="fas fa-file-excel"></i>
                        </button>
                    </form>
                </div>
                <div class="cards">
                    <form action="{{ route('generar.EncuestaDocentes2') }}" method="POST">
                        @csrf
                        <button type="submit" class="card-button">
                            <span><b>ENCUESTA DOCENTE</b></span>
                            <i class="fas fa-file-excel"></i>
                        </button>
                    </form>
                </div>
                <div class="cards">
                    <form action="{{ route('generar.EvTutorEmpresarial2') }}" method="POST">
                        @csrf
                        <button type="submit" class="card-button">
                            <span><b>EVALUACIÓN TUTOR EMPRESARIAL</b></span>
                            <i class="fas fa-file-excel"></i>
                        </button>
                    </form>
                </div>
                <div class="cards">
                    <form action="{{ route('generar.PlanificacionPPEstudiante2') }}" method="POST">
                        @csrf
                        <button type="submit" class="card-button">
                            <span><b>PLANIFICACIÓN DE ESTUDIANTE</b></span>
                            <i class="fas fa-file-excel"></i>
                        </button>
                    </form>
                </div>
                <div class="cards">
                    <form action="{{ route('generar.ControlAvanceActividades2') }}" method="POST">
                        @csrf
                        <button type="submit" class="card-button btn-block">
                            <span><b>AVANCE DE ACTIVIDADES</b></span>
                            <i class="fas fa-file-excel"></i>
                        </button>
                    </form>
                </div>
                <div class="cards">
                    <form action="{{ route('generar.EvTutorAcademico2') }}" method="POST">
                        @csrf
                        <button type="submit" class="card-button btn-block">
                            <span><b>EVALUACIÓN TUTOR ACADÉMICO</b></span>
                            <i class="fas fa-file-excel"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <div class="container">
      
            <div class="row">
                <div class="col-md-6">
                    <div class="table-responsive-sm table-container">
                        <table class="table2 table table-bordered mat-mdc-table">
                            <thead class="ng-star-inserted">
                                <tr class="mat-mdc-header-row mdc-data-table__header-row cdk-header-row ng-star-inserted">
                                    <th class="table2th" colspan="4" style="font-size: 14px;">DETALLES DE LA PRÁCTICA
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th class="small-th"
                                        style="text-transform: uppercase; font-size: .7em; background-color:white !important;">
                                        Estudiante:</th>
                                    <td class="large-td" style="text-transform: uppercase; font-size: .7em;">
                                        {{ strtoupper($practicaPendiente->estudiante->apellidos) }}
                                        {{ strtoupper($practicaPendiente->estudiante->nombres) }}</td>
                                    <th class="small-th"
                                        style="text-transform: uppercase; font-size: .7em; background-color:white !important;">
                                        Práctica:</th>
                                    <td class="large-td" style="text-transform: uppercase; font-size: .7em;">
                                        {{ strtoupper($practicaPendiente->tipoPractica) }}</td>
                                </tr>
                                <tr>
                                    <th class="small-th"
                                        style="text-transform: uppercase; font-size: .7em; background-color:white !important;">
                                        Docente Tutor:</th>
                                    <td class="large-td" style="text-transform: uppercase; font-size: .7em;">
                                        {{ strtoupper($practicaPendiente->tutorAcademico->apellidos) }}
                                        {{ strtoupper($practicaPendiente->tutorAcademico->nombres) }}</td>
                                    <th class="small-th"
                                        style="text-transform: uppercase; font-size: .7em; background-color:white !important;">
                                        Empresa:</th>
                                    <td class="large-td" style="text-transform: uppercase; font-size: .7em;">
                                        {{ strtoupper($practicaPendiente->Empresa->nombreEmpresa) }}</td>
                                </tr>
                                <tr>
                                    <th class="small-th"
                                        style="text-transform: uppercase; font-size: .7em; background-color:white !important;">
                                        Tutor Empresarial:</th>
                                    <td class="large-td" style="text-transform: uppercase; font-size: .7em;">
                                        {{ strtoupper($practicaPendiente->NombreTutorEmpresarial) }}</td>
                                    <th class="small-th"
                                        style="text-transform: uppercase; font-size: .7em; background-color:white !important;">
                                        Cédula Tutor Empresarial:</th>
                                    <td class="large-td" style="text-transform: uppercase; font-size: .7em;">
                                        {{ $practicaPendiente->CedulaTutorEmpresarial }}</td>
                                </tr>
                                <tr>
                                    <th class="small-th"
                                        style="text-transform: uppercase; font-size: .7em; background-color:white !important;">
                                        Función:</th>
                                    <td class="large-td" style="text-transform: uppercase; font-size: .7em;">
                                        {{ strtoupper($practicaPendiente->Funcion) }}</td>
                                    <th class="small-th"
                                        style="text-transform: uppercase; font-size: .7em; background-color:white !important;">
                                        Teléfono Tutor Empresarial:</th>
                                    <td class="large-td" style="text-transform: uppercase; font-size: .7em;">
                                        {{ $practicaPendiente->TelefonoTutorEmpresarial }}</td>
                                </tr>
                                <tr>
                                    <th class="small-th"
                                        style="text-transform: uppercase; font-size: .7em; background-color:white !important;">
                                        Estado de Fase I:</th>
                                    <td class="large-td" style="text-transform: uppercase; font-size: .7em;">
                                        {{ strtoupper($practicaPendiente->Estado) }}</td>
                                    <th class="small-th"
                                        style="text-transform: uppercase; font-size: .7em; background-color:white !important;">
                                        Fecha de Inicio:</th>
                                    <td class="large-td" style="text-transform: uppercase; font-size: .7em;">
                                        {{ $practicaPendiente->FechaInicio }}</td>
                                </tr>
                                <tr>
                                    <th class="small-th"
                                        style="text-transform: uppercase; font-size: .7em; background-color:white !important;">
                                        Fecha de Finalización:</th>
                                    <td class="large-td" style="text-transform: uppercase; font-size: .7em;">
                                        {{ $practicaPendiente->FechaFinalizacion }}</td>
                                    <th class="small-th"
                                        style="text-transform: uppercase; font-size: .7em; background-color:white !important;">
                                        Horas planificadas:</th>
                                    <td class="large-td" style="text-transform: uppercase; font-size: .7em;">
                                        {{ strtoupper($practicaPendiente->HorasPlanificadas) }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Formulario para agregar/editar actividad -->
                <div class="col-md-6 formulario_actividad">
                    <h4><b>Agregar Actividades</b></h4>
                    <hr>
                    <form id="actividadForm" action="{{ route('estudiantes.guardarActividadesPracticas2') }}"
                        method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" id="EstudianteID" name="EstudianteID"
                            value="{{ $practicaPendiente->estudiante->estudianteId }}">
                        <input type="hidden" id="PracticasII" name="PracticasII"
                            value="{{ $practicaPendiente->practicasII }}">
                        <input type="hidden" id="ActividadID" name="ActividadID" value="">
                        <div class="form-group">
                            <label class="label" for="Actividad"><strong>Actividad Realizada:</strong></label>
                            <textarea id="Actividad" name="Actividad" class="form-control input" placeholder="Ingrese la actividad realizada"></textarea>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="label" for="horas"><strong>Número de Horas:</strong></label>
                                    <input type="text" id="horas" name="horas" class="form-control input"
                                        placeholder="Ingrese el número de horas">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="label" for="fechaActividad"><strong>Fecha de la
                                            Actividad:</strong></label>
                                    <input type="date" id="fechaActividad" name="fechaActividad"
                                        class="form-control input" placeholder="Ingrese la fecha de la actividad">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="label" for="observaciones"><strong>Observación:</strong></label>
                                    <input type="text" id="observaciones" name="observaciones"
                                        class="form-control input" placeholder="Ingrese la observación de esta actividad">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="label" for="departamento"><strong>Departamento:</strong></label>
                                    <input type="text" id="departamento" name="departamento"
                                        class="form-control input" placeholder="Ingrese el departamento">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="label" for="funcion"><strong>Función Asignada:</strong></label>
                                    <input type="text" id="funcion" name="funcion" class="form-control input"
                                        placeholder="Ingrese la función asignada">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="label" for="evidencia"><strong>Evidencia:</strong></label>
                                    <div class="input_file input">
                                        <span id="fileText2" class="fileText">
                                            <i class="fa fa-upload"></i> Haz clic aquí para subir el documento
                                        </span>
                                        <input type="file" class="form-control-file input input_file" id="evidencia"
                                            name="evidencia" onchange="displayFileName(this, 'fileText2')" required>
                                        <span title="Eliminar archivo" onclick="removeFile(this)"
                                            class="remove-icon">✖</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <center><button type="submit" id="submitButton" class="button1">Guardar Actividad</button>
                            </center>
                        </div>
                    </form>
                </div>
            </div>

            <br>


            <br>

            <div class="contenedor_tabla">
                <div class="table-container mat-elevation-z8">
                    <div id="tablaActividades">
                        <table id="tablaAsignaciones" class="mat-mdc-table">
                            <thead class="ng-star-inserted">
                                <tr class="mat-mdc-header-row mdc-data-table__header-row cdk-header-row ng-star-inserted">
                                    <th>N°</th>
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
                                        <td class="noExisteRegistro1" style="font-size: 16px !important;" colspan="9">
                                            No hay actividades agregadas.</td>
                                    </tr>
                                @else
                                    @foreach ($actividades as $actividad)
                                        <tr>
                                            <td
                                                style="text-transform: uppercase; text-align:center; font-size: .7em; min-width: 30px !important;">
                                                {{ $loop->iteration }}</td>
                                            <td
                                                style="text-transform: uppercase; font-size: .7em; max-width: 130px !important;">
                                                {{ $actividad->actividad }}</td>
                                            <td
                                                style="text-transform: uppercase; text-align:center; font-size: .7em; min-width: 30px !important;">
                                                {{ $actividad->horas }}</td>
                                            <td style="text-transform: uppercase; font-size: .7em;">
                                                {{ $actividad->observaciones }}</td>
                                            <td style="text-transform: uppercase; text-align:center; font-size: .7em;">
                                                {{ $actividad->fechaActividad }}</td>
                                            <td style="text-transform: uppercase; font-size: .7em;">
                                                {{ $actividad->departamento }}</td>
                                            <td style="text-transform: uppercase; font-size: .7em;">
                                                {{ $actividad->funcion }}</td>
                                            <td
                                                style="text-transform: uppercase; word-wrap: break-word; text-align: center;">
                                                <img src="data:image/png;base64,{{ $actividad->evidencia }}"
                                                    width="100" height="100" alt="SIN EVIDENCIA">
                                            </td>
                                            <td
                                                style="text-transform: uppercase; word-wrap: break-word; text-align: center;">
                                                <form
                                                    action="{{ route('estudiantes.eliminarActividadPracticas2', $actividad->id) }}"
                                                    method="POST" style="display: inline-block;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <div class="tooltip-container">
                                                        <button type="submit"
                                                            class="button3 efects_button btn_eliminar3">
                                                            <i class="material-icons">delete</i>
                                                        </button>
                                                    </div>
                                                </form>
                                                <div class="tooltip-container">
                                                    <button type="button" class="button3 efects_button btn_editar3"
                                                        onclick="editActividad({{ $actividad }})">
                                                        <i class="material-icons">edit</i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="9" align="left"><strong>Total horas realizadas:</strong>
                                        {{ $totalHoras }} / {{ $practicaPendiente->HorasPlanificadas }}</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>


            <hr>

            <button class="button1_1" onclick="toggleForm2()">Mostar formulario para Informe de Servicio a la
                comunidad</button>
            <hr>
            <form id="formulario" action="{{ route('generar.InformPractica2') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="introduccion">Introducción:</label>
                            <textarea id="introduccion" name="introduccion" class="form-control input textarea"
                                placeholder="Ingrese la introducción" required></textarea>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="conclusion">Conclusiones:</label>
                            <textarea id="conclusion" name="conclusion" class="form-control input textarea"
                                placeholder="Ingrese las conclusiones" required></textarea>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="recomendaciones">Recomendaciones:</label>
                            <textarea id="recomendaciones" name="recomendaciones" class="form-control input textarea"
                                placeholder="Ingrese las recomendaciones" required></textarea>
                        </div>
                    </div>
                </div>
                <center><button type="submit" class="button1">Generar Informe</button></center>
            </form>








            <!--------------------------------- De aqui para abajo es otra zona de trabajoooooooooooooooooooooo------------------>
      <!--------------------------------- De aqui para abajo es otra zona de trabajoooooooooooooooooooooo------------------>
@else
    
    <h4><b>Practicas II - Inicio del proceso de prácticas pre profesionales del estudiante</b></h3>
    <hr>

    <form action="{{ route('guardarPracticas2') }}" method="POST">
        @csrf
        <div class="row">
        <div class="col-md-6">
        <div class="table-responsive-sm table-container">
            <table class="table2 table table-bordered">
                <tr class="mat-mdc-header-row mdc-data-table__header-row cdk-header-row ng-star-inserted">
                    <th class="tamanio1 table2th" colspan="2" style="text-transform: uppercase; font-size: .9em;">
                        <center>DATOS DEL ESTUDIANTE</center>
                    </th>
                </tr>
                <tbody>
                    <tr>
                        <th class="small-th" style="text-transform: uppercase; font-size: .7em;">ID de Estudiante:</th>
                        <td class="large-td" style="text-transform: uppercase; font-size: .7em;" >{{ strtoupper($estudiante->espeId) }}</td>
                    </tr>
                    <tr>
                        <th class="small-th" style="text-transform: uppercase; font-size: .7em;" >Cédula:</th>
                        <td class="large-td" style="text-transform: uppercase; font-size: .7em;" >{{ strtoupper($estudiante->cedula) }}</td>
                    </tr>
                    <tr>
                        <th class="small-th" style="text-transform: uppercase; font-size: .7em;" >Nombres Completos:</th>
                        <td class="large-td" style="text-transform: uppercase; font-size: .7em;">{{ strtoupper($estudiante->apellidos) }} {{ strtoupper($estudiante->nombres) }}
                        </td>
                    </tr>
                    <tr>
                        <th class="small-th" style="text-transform: uppercase; font-size: .7em;    ">Correo:</th>
                        <td class="large-td" style="font-size: .7em;">{{ $correoEstudiante }}</td>
                    </tr>
                    <tr>
                        <th class="small-th" style="text-transform: uppercase; font-size: .7em;" >Nivel:</th>
                        <td class="large-td" style="text-transform: uppercase; font-size: .7em;">
                            <select id="Nivel" name="Nivel" class="form-control input input_select3">
                                <option value="1">Seleccione un nivel</option>
                                <option value="Pregrado">PREGRADO</option>
                                <option value="Posgrado">POSGRADO</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th class="small-th" style="text-transform: uppercase; font-size: .7em;">Campus:</th>
                        <td class="large-td" style="text-transform: uppercase; font-size: .7em;">EXTENSION SANTO DOMINGO</td>
                    </tr>
                    <tr>
                        <th class="small-th" style="text-transform: uppercase; font-size: .7em;">Departamento:</th>
                        <td class="large-td" style="text-transform: uppercase; font-size: .7em;">{{ strtoupper($estudiante->departamento->departamento) }}</td>
                    </tr>
                    <tr>
                        <th class="small-th" style="text-transform: uppercase; font-size: .7em;">Escoja Práctica:</th>
                        <td class="large-td" style="text-transform: uppercase; font-size: .7em;">
                            <select id="Practicas" name="Practicas" class="form-control input input_select3 ">
                                <option value="1">Seleccione una práctica</option>
                                <option value="SERVICIO A LA COMUNIDAD">SERVICIO A LA COMUNIDAD</option>
                                <option value="PASANTIAS">PASANTIAS</option>
                                <option value="PRACTICAS PRE PROFESIONALES">PRÁCTICAS PRE PROFESIONALES
                                </option>
                                <option value="AYUDANDIA DE CATEDRA">AYUDANDIA DE CATEDRA</option>
                                <option value="AYUDANTIA DE INVESTIGACION">AYUDANTIA DE INVESTIGACION</option>
                                <option value="RECONOCE EXPERIENCIA LABORAL">RECONOCE EXPERIENCIA LABORAL
                                </option>
                                <option value="P. INTEGRADOR SABERES">P. INTEGRADOR SABERES</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th class="small-th" style="text-transform: uppercase; font-size: .7em;">Teléfono:</th>
                        <td class="large-td" style="text-transform: uppercase; font-size: .7em;">{{ strtoupper($estudiante->celular) }}</td>
                    </tr>
                </tbody>
            </table>
            </div>
        </div>

        <div class="col-md-6">
        <div class="table-responsive-sm table-container">
            <table class="table2 table table-bordered">
                <tr class="mat-mdc-header-row mdc-data-table__header-row cdk-header-row ng-star-inserted">
                    <th class="tamanio1 table2th" style="text-transform: uppercase; font-size: .9em;" colspan="2">
                        <center>DATOS DE LA PRÁCTICA</center>
                    </th>
                </tr>
                <tbody>
                    <tr>
                        <th class="small-th" style="text-transform: uppercase; font-size: .7em;">Estado Académico Actual:</th>
                        <td class="large-td" style="text-transform: uppercase; font-size: .7em;">
                            <select id="EstadoAcademico" name="EstadoAcademico" class="form-control input input_select4">
                                <option value="1">Seleccione un estado académico</option>
                                <option value="FINALIZANDO ESTUDIOS">FINALIZANDO ESTUDIOS</option>
                                <option value="CURSANDO ESTUDIOS">CURSANDO ESTUDIOS</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th class="small-th" style="text-transform: uppercase; font-size: .7em;">Fecha de inicio de la práctica:</th>
                        <td class="large-td" style="text-transform: uppercase; font-size: .7em;">
                            <input type="date" id="FechaInicio" name="FechaInicio"
                                class="form-control input input_select4">
                        </td>
                    </tr>
                    <tr>
                        <th th class="small-th" style="text-transform: uppercase; font-size: .7em;">Fecha de finalización de la práctica:</th>
                        <td class="large-td" style="text-transform: uppercase; font-size: .7em;">
                            <input type="date" id="FechaFinalizacion" name="FechaFinalizacion"
                                class="form-control input input_select4">
                        </td>
                    </tr>
                    <tr>
                        <th th class="small-th" style="text-transform: uppercase; font-size: .7em;">Horas de Practica I:</th>
                        <td class="large-td" style="text-transform: uppercase; font-size: .7em;">
                            <span id="horasPracticaI">{{ $horasPlanificadasI }}</span>
                        </td>
                    </tr>
                    <tr>
                        <th th class="small-th" style="text-transform: uppercase; font-size: .7em;">Horas planificadas:</th>
                        <td class="large-td" style="text-transform: uppercase; font-size: .7em;">
                            <input type="number" id="HorasPlanificadas" name="HorasPlanificadas"
                                class="form-control input input_select4" min="80" max="144">
                            <div id="errorHorasPlanificadas" style="color: red;"></div>

                        </td>
                    </tr>
                    <tr>
                        <th th class="small-th" style="text-transform: uppercase; font-size: .7em;">Horas totales:</th>
                        <td class="large-td" style="text-transform: uppercase; font-size: .7em;">
                            <span id="horasTotales">0</span>
                        </td>
                    </tr>

                    <tr>
                        <th th class="small-th" style="text-transform: uppercase; font-size: .7em;">Horario de entrada:</th>
                        <td>
                            <input type="time" id="HoraEntrada" name="HoraEntrada"
                                class="form-control input input_select4">
                        </td>
                    </tr>
                    <tr>
                        <th th class="small-th" style="text-transform: uppercase; font-size: .7em;">Horario de salida:</th>
                        <td>
                            <input type="time" id="HoraSalida" name="HoraSalida"
                                class="form-control input input_select4">
                        </td>
                    </tr>
                    <tr>
                        <th th class="small-th" style="text-transform: uppercase; font-size: .7em;">Área de conocimiento:</th>
                        <td>
                            <input type="text" id="AreaConocimiento" name="AreaConocimiento"
                                class="form-control input input_select4">
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
</div>
</div>

        <br>

        <button type="button" id="verOpcionesBtn" class="button1 btn3"><i
                class="fa-regular fa-magnifying-glass-plus"></i> Ver opciones de
            prácticas</button>
        <br><br>
        <div class="table-responsive-sm table-container">
        <table class="table2 table table-bordered mat-mdc-table">
                    <thead class="ng-star-inserted">
                        <tr class="mat-mdc-header-row mdc-data-table__header-row cdk-header-row ng-star-inserted">
                            <th class="table2th" colspan="4" style="font-size: 14px;">PRÁCTICA PREPROFESIONAL NO
                                REMUNERADA, PASANTÍA O AYUDA A LA COMUNIDAD</th>
                        </tr>
                    </thead>
                <tbody>

                    <tr>
                        <th class="small-th" style="text-transform: uppercase; font-size: .7em; background-color:white !important;">Sugiera un docente como tutor académico:</th>
                        <td class="large-td" style="text-transform: uppercase; font-size: .7em;">
                            <div class="form-group">
                                <label for="ID_tutorAcademico">
                                </label>
                                <select name="ID_tutorAcademico" class="form-control input input input_select3" required>
                                    <option value="">Seleccionar el Docente</option>
                                    @foreach ($profesores as $profesor)
                                        <option value="{{ $profesor->id }}"> {{ $profesor->apellidos }}
                                            {{ $profesor->nombres }} </option>
                                    @endforeach
                                </select>
                            </div>

                        </td>
                    </tr>

                    <tr>
                        <th class="small-th" style="text-transform: uppercase; font-size: .7em; background-color:white !important;">NRC Práctica</th>
                        <td class="large-td" style="text-transform: uppercase; font-size: .7em;">
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
                        <th class="small-th" style="text-transform: uppercase; font-size: .7em; background-color:white !important;">Empresa:</th>
                        <td class="large-td" style="text-transform: uppercase; font-size: .7em;">
                            <select id="Empresa" name="Empresa" class="form-control input input_select4">
                                @foreach ($empresas as $empresa)
                                    <option value="{{ $empresa->id }}">{{ $empresa->nombreEmpresa }} -
                                        Requiere: {{ $empresa->actividadesMacro }} </option>
                                @endforeach
                            </select>
                        </td>
                    </tr>

                    <tr>
                        <th class="small-th" style="text-transform: uppercase; font-size: .7em; background-color:white !important;">Cédula del tutor empresarial:</th>
                        <td class="large-td" style="text-transform: uppercase; font-size: .7em;">
                            <input type="text" id="CedulaTutorEmpresarial" name="CedulaTutorEmpresarial"
                                class="form-control input input_select3">
                            <div id="errorCedula" style="color: red;"></div>

                        </td>

                    </tr>

                    <tr>
                        <th class="small-th" style="text-transform: uppercase; font-size: .7em; background-color:white !important;">Nombre del tutor empresarial:</th>
                        <td class="large-td" style="text-transform: uppercase; font-size: .7em;">
                            <input type="text" id="NombreTutorEmpresarial" name="NombreTutorEmpresarial"
                                class="form-control input input_select3">
                            <div id="errorNombre" style="color: red;"></div>

                        </td>

                    </tr>

                    <tr>
                        <th class="small-th" style="text-transform: uppercase; font-size: .7em; background-color:white !important;">Funcion:</th>
                        <td class="large-td" style="text-transform: uppercase; font-size: .7em;">
                            <input type="text" id="Funcion" name="Funcion"
                                class="form-control input input_select3">
                        </td>

                    </tr>

                    <tr>
                        <th class="small-th" style="text-transform: uppercase; font-size: .7em; background-color:white !important;">Telefono:</th>
                        <td class="large-td" style="text-transform: uppercase; font-size: .7em;">
                            <input type="text" id="TelefonoTutorEmpresarial" name="TelefonoTutorEmpresarial"
                                class="form-control input input_select3">
                            <div id="errorTelefono" style="color: red;"></div>

                        </td>

                    </tr>

                    <tr>
                        <th class="small-th" style="text-transform: uppercase; font-size: .7em; background-color:white !important;">Email:</th>
                        <td class="large-td" style=" font-size: .7em;">
                            <input type="text" id="EmailTutorEmpresarial" name="EmailTutorEmpresarial"
                                class="form-control input input_select3">
                            <div id="errorEmail" style="color: red;"></div>

                        </td>
                    </tr>

                    <tr>
                        <th class="small-th" style="text-transform: uppercase; font-size: .7em; background-color:white !important;">Departamento dentro de la empresa:</th>
                        <td class="large-td" style="text-transform: uppercase; font-size: .7em;">
                            <input type="text" id="DepartamentoTutorEmpresarial" name="DepartamentoTutorEmpresarial"
                                class="form-control input input_select3">
                        </td>

                    </tr>



                </tbody>

            </table>
        </div>
</div>
        <br>
        <center> <button type="submit" id="iniciarPracticasBtn" class="button1 btn_excel"
              >Iniciar
                prácticas</button> </center>
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
    <script src="{{ asset('js/estudiante/practicas2.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>




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

            iniciarPracticasBtn.addEventListener('click', function() {});
        });

        function calcularHorasTotales() {
            const horasPlanificadasI = parseFloat(document.getElementById('horasPracticaI').textContent);
            const horasPlanificadasInput = document.getElementById('HorasPlanificadas');
            const horasPlanificadas = parseFloat(horasPlanificadasInput.value);

            if (!isNaN(horasPlanificadas)) {
                const horasTotales = horasPlanificadasI + horasPlanificadas;
                document.getElementById('horasTotales').textContent = horasTotales;
            } else {
                document.getElementById('horasTotales').textContent = '0';
            }
        }

        document.getElementById('HorasPlanificadas').addEventListener('input', calcularHorasTotales);

        calcularHorasTotales();
        // Make the card draggable
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

        function openCard(cardId) {
            document.getElementById(cardId).style.display = 'block';
        }

        function closeCard(cardId) {
            document.getElementById(cardId).style.display = 'none';
        }
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
            }, 5000); // 2000 milisegundos = 2 segundos
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

        function toggleForm() {
            var form = document.getElementById("formulario");
            if (form.style.display === "none" || form.style.display === "") {
                form.style.display = "block";
            } else {
                form.style.display = "none";
            }
        } <
        script >
            $(document).ready(function() {
                $('[data-toggle="tooltip"]').tooltip({
                    template: '<div class="tooltip custom-tooltip" role="tooltip"><div class="arrow"></div><div class="tooltip-inner"></div></div>'
                });

                $('.card-button').on('click', function() {
                    $('.card-button').removeClass('active');
                    $(this).addClass('active');
                });
            });
    </script>
    <script>
        function editActividad(actividad) {
            // Asigna los valores de la actividad al formulario
            $('#ActividadID').val(actividad.id);
            $('#Actividad').val(actividad.actividad);
            $('#horas').val(actividad.horas);
            $('#observaciones').val(actividad.observaciones);
            $('#fechaActividad').val(actividad.fechaActividad);
            $('#departamento').val(actividad.departamento);
            $('#funcion').val(actividad.funcion);

            // Mostrar el checkbox de eliminar evidencia solo si existe evidencia
            if (actividad.evidencia) {
                $('#eliminarEvidencia').closest('.form-check').show();
            } else {
                $('#eliminarEvidencia').closest('.form-check').hide();
            }

            // Cambia el método y la acción del formulario para la edición
            $('#actividadForm').attr('action', `/estudiantes/${actividad.id}/editar-actividad-practicas1`);
            $('#actividadForm').attr('method', 'POST');
            $('#actividadForm').append('<input type="hidden" name="_method" value="PUT">');

            // Cambia el texto del botón de guardar a actualizar
            $('#submitButton').text('Actualizar Actividad');
        }

        // Función para visualizar el nombre del archivo seleccionado
        function displayFileName(input, textElementId) {
            var fileName = input.files[0].name;
            document.getElementById(textElementId).innerText = fileName;
        }

        // Función para eliminar el archivo seleccionado
        function removeFile(element) {
            var input = element.previousElementSibling;
            input.value = '';
            document.getElementById('fileText2').innerText = 'Haz clic aquí para subir el documento';
        }

        // Asegúrate de ocultar el checkbox de eliminar evidencia al cargar la página
        $(document).ready(function() {
            $('#eliminarEvidencia').closest('.form-check').hide();
        });


    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Asegura que el formulario esté oculto al cargar la página
            var form = document.getElementById("formulario");
            form.style.display = "none";
        });

        function toggleForm2() {
            var form = document.getElementById("formulario");
            if (form.style.display === "none" || form.style.display === "") {
                form.style.display = "block";
            } else {
                form.style.display = "none";
            }
        }
    </script>


    <style>
        hr {
            margin-top: 0.5rem !important;
            margin-bottom: 0.8rem !important;
            border: 0;
            border-top: 1px solid rgba(0, 0, 0, .1);
        }

        .input_1 {
            height: none !important;
        }

        .table-container {

            border-radius: 5px !important;
            background-color: white !important;
        }

        td {
            background-color: white !important;
            padding: 10px;
        }

        .table-bordered td,
        .table-bordered th {
            border: 1px solid #dee2e6;
            border-radius: 7px 7px 0px 0px !important;
        }

        .small-th {
            width: 20%;
            /* Ajusta el ancho de las celdas de encabezado */
        }

        .large-td {
            width: 30%;
            /* Ajusta el ancho de las celdas de datos */
        }


        .mat-mdc-table th {
            font-weight: bold;
            text-align: left;
        }

        .mat-mdc-table {
            width: 100%;
            border-collapse: collapse;
        }

        .mat-mdc-table th,
        .mat-mdc-table td {

            padding: 8px;
        }


        .contenedor_tabla .table-container table td .tamanio11 {
            width: 200px;
            min-width: 0px !important;
            font-size: 10px;
            padding: .5rem !important;
        }

        .small-th {
            width: 20%;
        }

        .large-td {
            width: 30%;
        }

        .formulario_actividad {

            padding: 20px 20px 0px;
            border: 1px solid #ddd;
            border-radius: 5px;
            min-width: 300px;
        }

        .contenedor_principal {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap: 5px;
            /* Espacio entre el formulario y la tabla */
        }
    </style>
@endsection
