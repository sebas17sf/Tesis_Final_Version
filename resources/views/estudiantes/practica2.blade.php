@extends('layouts.app')


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





    <div class="container">
        @if (isset($practicaPendiente))
            <br>
            <div class="row">
                <div class="col-md-7">
                    <div class="table-responsive-sm">
                        <table class="table2 table table-bordered">
                            <thead>
                                <tr class="mat-mdc-header-row mdc-data-table__header-row cdk-header-row ng-star-inserted">
                                    <th class="tamanio1 table2th" colspan="2">DETALLES DE LA PRÁCTICA</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th>Estudiante:</th>
                                    <td>{{ $practicaPendiente->estudiante->apellidos }}
                                        {{ $practicaPendiente->estudiante->nombres }}</td>
                                </tr>
                                <tr>
                                    <th>Práctica:</th>
                                    <td>{{ $practicaPendiente->tipoPractica }}</td>
                                </tr>
                                <tr>
                                    <th>Docente Tutor:</th>
                                    <td>{{ $practicaPendiente->tutorAcademico->apellidos }}
                                        {{ $practicaPendiente->tutorAcademico->nombres }}</td>
                                </tr>
                                <tr>
                                    <th>Empresa:</th>
                                    <td>{{ $practicaPendiente->Empresa->nombreEmpresa }}</td>
                                </tr>
                                <tr>
                                    <th>Tutor Empresarial:</th>
                                    <td>{{ $practicaPendiente->NombreTutorEmpresarial }}</td>
                                </tr>
                                <tr>
                                    <th>Cédula Tutor Empresarial:</th>
                                    <td>{{ $practicaPendiente->CedulaTutorEmpresarial }}</td>
                                </tr>
                                <tr>
                                    <th>Función:</th>
                                    <td>{{ $practicaPendiente->Funcion }}</td>
                                </tr>
                                <tr>
                                    <th>Teléfono Tutor Empresarial:</th>
                                    <td>{{ $practicaPendiente->TelefonoTutorEmpresarial }}</td>
                                </tr>
                                <tr>
                                    <th>Estado de Fase I:</th>
                                    <td>{{ $practicaPendiente->Estado }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <br>
                <br>
                <div class="col-md-4">
                    <br>
                    <center>
                        <h3><b>FORMATOS PRACTICA II</b></h3>
                    </center>
                    <hr>
                    <div class="card-body">
                        <form action="{{ route('generar.EncuestaEstudiante2') }}" method="POST">
                            @csrf
                            <button type="submit" class="button1_1 btn-block">
                                <i class="fas fa-file-excel"></i> Generar Encuesta Estudiantes
                            </button>
                        </form>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('generar.EncuestaDocentes2') }}" method="POST">
                            @csrf
                            <button type="submit" class="button1_1 btn-block">
                                <i class="fas fa-file-excel"></i> Generar Encuesta Docente
                            </button>
                        </form>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('generar.EvTutorEmpresarial2') }}" method="POST">
                            @csrf
                            <button type="submit" class="button1_1 btn-block">
                                <i class="fas fa-file-excel"></i> Generar Evaluacion Tutor Empresarial
                            </button>
                        </form>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('generar.PlanificacionPPEstudiante2') }}" method="POST">
                            @csrf
                            <button type="submit" class="button1_1 btn-block">
                                <i class="fas fa-file-excel"></i> Generar Planificacion Estudiante
                            </button>
                        </form>
                    </div>

                    <div class="card-body">
                        <form action="{{ route('generar.ControlAvanceActividades2') }}" method="POST">
                            @csrf
                            <button type="submit" class="button1_1 btn-block">
                                <i class="fas fa-file-excel"></i> Generar Avance de Actividades
                            </button>
                        </form>
                    </div>

                    <div class="card-body">
                        <form action="{{ route('generar.EvTutorAcademico2') }}" method="POST">
                            @csrf
                            <button type="submit" class="button1_1 btn-block">
                                <i class="fas fa-file-excel"></i> Generar Evaluacion Tutor Academico
                            </button>
                        </form>
                    </div>
                </div>
            </div>




            <br>
            <button type="button" class="button1" onclick="openCard('draggableCardActividad');">
                Agregar actividad
            </button>
            <br>

            <div class="draggable-card" id="draggableCardActividad" style="display: none;">
                <div class="card-header">
                    <span class="card-title">Agregar Actividad</span>
                    <button type="button" class="close" onclick="closeCard('draggableCardActividad')">&times;</button>
                </div>
                <div class="card-body">
                    <form id="actividadForm" action="{{ route('estudiantes.guardarActividadesPracticas2') }}"
                        method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" id="EstudianteID" name="EstudianteID"
                            value="{{ $practicaPendiente->estudiante->estudianteId }}">
                        <input type="hidden" id="PracticasII" name="PracticasII"
                            value="{{ $practicaPendiente->practicasII }}">
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
                            <input type="text" id="observaciones" name="observaciones" class="form-control input">
                        </div>
                        <div class="form-group">
                            <label for="fechaActividad">Fecha de la Actividad:</label>
                            <input type="date" id="fechaActividad" name="fechaActividad" class="form-control input">
                        </div>
                        <div class="form-group">
                            <label for="departamento">Departamento:</label>
                            <input type="text" id="departamento" name="departamento" class="form-control input">
                        </div>
                        <div class="form-group">
                            <label for="funcion">Función Asignada:</label>
                            <input type="text" id="funcion" name="funcion" class="form-control input">
                        </div>
                        <div class="form-group">
                            <label class="label" for="evidencia"><strong>Evidencia:</strong></label>
                            <div class="input_file input">
                                <span id="fileText2" class="fileText">
                                    <i class="fa fa-upload"></i> Haz clic aquí para subir el documento
                                </span>
                                <input type="file" class="form-control-file input input_file" id="evidencia"
                                    name="evidencia" onchange="displayFileName(this, 'fileText2')" required>
                                <span title="Eliminar archivo" onclick="removeFile(this)" class="remove-icon">✖</span>
                            </div>
                        </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="button">Guardar Actividad</button>
                </div>
                </form>
            </div>
    </div>

    <br>

    <div class="contenedor_tabla">
        <div class="table-container mat-elevation-z8">

            <div id="tablaActividades">
                <table id="tablaAsignaciones" class="mat-mdc-table">

                    <thead class="ng-star-inserted">
                        <tr class="mat-mdc-header-row mdc-data-table__header-row cdk-header-row ng-star-inserted">
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
                    <tbody class="mdc-data-table__content ng-star-inserted">
                        @if ($actividades->isEmpty())
                            <tr style="text-align:center">
                                <td class="noExisteRegistro1" style="font-size: 16px !important;"colspan="10">No hay
                                    actividades agregadas.</td>
                            </tr>
                        @else
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
                                            action="{{ route('estudiantes.eliminarActividadPracticas2', $actividad->id) }}"
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
                                                            id="modalEditarActividadLabel{{ $actividad->id }}">
                                                            Editar
                                                            Actividad</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true"><i
                                                            class="fa-thin fa-xmark"></i></span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form
                                                            action="{{ route('estudiantes.actualizarActividadPracticas2', $actividad->id) }}"
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

        <hr>

        <button class="button" onclick="toggleForm()">Generar Informe</button>


        <form id="formulario" action="{{ route('generar.InformPractica2') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="introduccion">Introducción:</label>
                <textarea id="introduccion" name="introduccion" class="form-control input"></textarea>
            </div>

            <div class="form-group">
                <label for="conclusion">Conclusiones:</label>
                <textarea id="conclusion" name="conclusion" class="form-control input"></textarea>
            </div>

            <div class="form-group">
                <label for="recomendaciones">Recomendaciones:</label>
                <textarea id="recomendaciones" name="recomendaciones" class="form-control input"></textarea>
            </div>

             <button type="submit" class="button">Generar Informe</button>
        </form>



    </div>










    <!--------------------------------- De aqui para abajo es otra zona de trabajoooooooooooooooooooooo------------------>
@else
    <br>
    <h3><b>Practicas II - Inicio del proceso de prácticas pre profesionales del estudiante</b></h3>
    <hr>


    <form action="{{ route('guardarPracticas2') }}" method="POST">
        @csrf
        <div class="table-responsive-sm">
            <table class="table2 table table-bordered">
                <tr class="mat-mdc-header-row mdc-data-table__header-row cdk-header-row ng-star-inserted">
                    <th class="tamanio1 table2th" colspan="2">
                        <center>DATOS DEL ESTUDIANTE</center>
                    </th>
                </tr>
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
                        <td>{{ strtoupper($estudiante->apellidos) }} {{ strtoupper($estudiante->nombres) }}
                        </td>
                    </tr>
                    <tr>
                        <th>Correo:</th>
                        <td>{{ strtoupper($correoEstudiante) }}</td>
                    </tr>
                    <tr>
                        <th>Nivel:</th>
                        <td>
                            <select id="Nivel" name="Nivel" class="form-control input input_select3">
                                <option value="1">Seleccione un nivel</option>
                                <option value="Pregrado">PREGRADO</option>
                                <option value="Posgrado">POSGRADO</option>
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
                            <select id="Practicas" name="Practicas" class="form-control input input_select3 ">
                                <option value="1">Seleccione una práctica</option>
                                <option value="SERVICIO A LA COMUNIDAD">SERVICIO A LA COMUNIDAD</option>
                                <option value="PASANTIAS">PASANTIAS</option>
                                <option value="PRACTICAS PRE PROFESIONALES">PRACTICAS PRE PROFESIONALES
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
                        <th>Teléfono:</th>
                        <td>{{ strtoupper($estudiante->celular) }}</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <br>
        <div class="table-responsive-sm">
            <table class="table2 table table-bordered">
                <tr class="mat-mdc-header-row mdc-data-table__header-row cdk-header-row ng-star-inserted">
                    <th class="tamanio1 table2th" colspan="2">
                        <center>DATOS DEL ESTUDIANTE</center>
                    </th>
                </tr>
                <tbody>
                    <tr>
                        <th>Estado Académico Actual:</th>
                        <td>
                            <select id="EstadoAcademico" name="EstadoAcademico" class="form-control input input_select4">
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
                                class="form-control input input_select4">
                        </td>
                    </tr>
                    <tr>
                        <th>Fecha de finalización de la práctica:</th>
                        <td>
                            <input type="date" id="FechaFinalizacion" name="FechaFinalizacion"
                                class="form-control input input_select4">
                        </td>
                    </tr>
                    <tr>
                        <th>Horas de PracticaI:</th>
                        <td>
                            <span id="horasPracticaI">{{ $horasPlanificadasI }}</span>
                        </td>
                    </tr>
                    <tr>
                        <th>Horas planificadas:</th>
                        <td>
                            <input type="number" id="HorasPlanificadas" name="HorasPlanificadas"
                                class="form-control input input_select4" min="80" max="144">
                            <div id="errorHorasPlanificadas" style="color: red;"></div>

                        </td>
                    </tr>
                    <tr>
                        <th>Horas totales:</th>
                        <td>
                            <span id="horasTotales">0</span>
                        </td>
                    </tr>

                    <tr>
                        <th>Horario de entrada:</th>
                        <td>
                            <input type="time" id="HoraEntrada" name="HoraEntrada"
                                class="form-control input input_select4">
                        </td>
                    </tr>
                    <tr>
                        <th>Horario de salida:</th>
                        <td>
                            <input type="time" id="HoraSalida" name="HoraSalida"
                                class="form-control input input_select4">
                        </td>
                    </tr>
                    <tr>
                        <th>Área de conocimiento:</th>
                        <td>
                            <input type="text" id="AreaConocimiento" name="AreaConocimiento"
                                class="form-control input input_select4">
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>


        <br>

        <button type="button" id="verOpcionesBtn" class="button1 btn3"><i
                class="fa-regular fa-magnifying-glass-plus"></i> Ver opciones de
            prácticas</button>
        <br><br>
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
                                <select name="ID_tutorAcademico" class="form-control input input input_select3" required>
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
                            <select id="Empresa" name="Empresa" class="form-control input input_select4">
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
        <center> <button type="submit" id="iniciarPracticasBtn" class="button1 btn_excel"
                style="display: none;">Iniciar
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
