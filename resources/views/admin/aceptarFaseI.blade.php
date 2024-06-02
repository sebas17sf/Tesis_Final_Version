@extends('layouts.admin')
@section('title_component', 'Practicas')
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
        <h4><b>Estudiantes Practica 1</b></h4>
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



                <div class="tooltip-container">
                    <span class="tooltip-text">Importar archivo</span>
                    <button type="button" class="button3 efects_button btn_3" data-toggle="modal"
                        data-target="#modalImportar">
                        <i class="fa fa-upload"></i>
                    </button>
                </div>

                <div class="modal fade" id="modalImportar" tabindex="-1" role="dialog"
                    aria-labelledby="modalImportarLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <form id="idModalImportar" action="{{ route('import-practicas1') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="modal-header">
                                    <h5 class="modal-title">Importar archivo</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <div class="input input_file">
                                            <span id="fileText" class="fileText">
                                                <i class="fa fa-upload"></i> Haz clic aquí para subir el
                                                documento
                                            </span>
                                            <input type="file" class="form-control-file input input_file" id="file"
                                                name="file" onchange="displayFileName(this)" required>
                                            <span title="Eliminar archivo" onclick="removeFile(this)"
                                                class="remove-icon">✖</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button id="cerrar_modal" type="button" class="button"
                                        data-dismiss="modal">Cerrar</button>
                                    <button type="submit" class="button">Importar Archivo</button>
                                </div>
                            </form>
                        </div>
                    </div>
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

                                    </tr>
                                </thead>
                                <tbody class="mdc-data-table__content ng-star-inserted">
                                    @foreach ($estudiantesPracticas as $practicaI)
                                        @if ($practicaI->estudiante)
                                            <tr>
                                                <td>{{ strtoupper($practicaI->estudiante->Apellidos) }}
                                                    {{ strtoupper($practicaI->estudiante->Nombres) }}</td>
                                                <td>{{ strtoupper($practicaI->tipoPractica) }}</td>
                                                <td>{{ strtoupper($practicaI->tutorAcademico->Apellidos ?? 'No por el momento') }}
                                                    {{ strtoupper($practicaI->tutorAcademico->Nombres ?? 'No por el momento') }}
                                                </td>
                                                <td>{{ strtoupper($practicaI->NombreTutorEmpresarial) }}</td>
                                                <td>{{ strtoupper($practicaI->Empresa->nombreEmpresa ?? 'No por el momento') }}
                                                </td>
                                                <td>{{ strtoupper($practicaI->nrcPractica->nrc ?? 'No cuenta con NRC') }}
                                                </td>
                                                <td>{{ strtoupper($practicaI->nrcPractica->periodo->numeroPeriodo ?? 'No cuenta con NRC') }}
                                                </td>
                                                <td>{{ strtoupper($practicaI->FechaInicio) }}</td>
                                                <td>{{ strtoupper($practicaI->FechaFinalizacion) }}</td>
                                                <td>{{ strtoupper($practicaI->HorasPlanificadas) }}</td>
                                                <td>{{ $practicaI->Estado }}</td>





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
        <h4><b>Estudiantes Practica 1.2 <b></h4>

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

                <div class="tooltip-container">
                    <span class="tooltip-text">Importar archivo</span>
                    <button type="button" class="button3 efects_button btn_3" data-toggle="modal"
                        data-target="#modalImportar2">
                        <i class="fa fa-upload"></i>
                    </button>
                </div>

                <div class="modal fade" id="modalImportar2" tabindex="-1" role="dialog"
                    aria-labelledby="modalImportarLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <form id="idModalImportar" action="{{ route('import-practicas2') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="modal-header">
                                    <h5 class="modal-title">Importar archivo</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <div class="input input_file">
                                            <span id="fileText" class="fileText">
                                                <i class="fa fa-upload"></i> Haz clic aquí para subir el
                                                documento
                                            </span>
                                            <input type="file" class="form-control-file input input_file"
                                                id="file" name="file" onchange="displayFileName(this)" required>
                                            <span title="Eliminar archivo" onclick="removeFile(this)"
                                                class="remove-icon">✖</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button id="cerrar_modal" type="button" class="button"
                                        data-dismiss="modal">Cerrar</button>
                                    <button type="submit" class="button">Importar Archivo</button>
                                </div>
                            </form>
                        </div>
                    </div>
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

                                    </tr>
                                </thead>
                                <tbody class="mdc-data-table__content ng-star-inserted">
                                    @foreach ($estudiantesPracticasII as $practicaI)
                                        @if ($practicaI->estudiante)
                                            <tr>
                                                <td>{{ strtoupper($practicaI->estudiante->Apellidos) }}
                                                    {{ strtoupper($practicaI->estudiante->Nombres) }}</td>
                                                <td>{{ strtoupper($practicaI->tipoPractica) }}</td>
                                                <td>{{ strtoupper($practicaI->tutorAcademico->Apellidos ?? 'No por el momento') }}
                                                    {{ strtoupper($practicaI->tutorAcademico->Nombres ?? 'No por el momento') }}
                                                </td>
                                                <td>{{ strtoupper($practicaI->NombreTutorEmpresarial) }}</td>
                                                <td>{{ strtoupper($practicaI->Empresa->nombreEmpresa ?? 'No por el momento') }}
                                                </td>
                                                <td>{{ strtoupper($practicaI->nrcPractica->nrc ?? 'No cuenta con NRC') }}
                                                </td>
                                                <td>{{ strtoupper($practicaI->nrcPractica->periodo->numeroPeriodo ?? 'No cuenta con NRC') }}
                                                </td>
                                                <td>{{ strtoupper($practicaI->FechaInicio) }}</td>
                                                <td>{{ strtoupper($practicaI->FechaFinalizacion) }}</td>
                                                <td>{{ strtoupper($practicaI->HorasPlanificadas) }}</td>
                                                <td>{{ $practicaI->Estado }}</td>


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
        <h4><b>Estudiantes Practica 1.3<b></h4>

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

                <div class="tooltip-container">
                    <span class="tooltip-text">Importar archivo</span>
                    <button type="button" class="button3 efects_button btn_3" data-toggle="modal"
                        data-target="#modalImportar3">
                        <i class="fa fa-upload"></i>
                    </button>
                </div>

                <div class="modal fade" id="modalImportar3" tabindex="-1" role="dialog"
                    aria-labelledby="modalImportarLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <form id="idModalImportar" action="{{ route('import-practicas3') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="modal-header">
                                    <h5 class="modal-title">Importar archivo</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <div class="input input_file">
                                            <span id="fileText" class="fileText">
                                                <i class="fa fa-upload"></i> Haz clic aquí para subir el
                                                documento
                                            </span>
                                            <input type="file" class="form-control-file input input_file"
                                                id="file" name="file" onchange="displayFileName(this)" required>
                                            <span title="Eliminar archivo" onclick="removeFile(this)"
                                                class="remove-icon">✖</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button id="cerrar_modal" type="button" class="button"
                                        data-dismiss="modal">Cerrar</button>
                                    <button type="submit" class="button">Importar Archivo</button>
                                </div>
                            </form>
                        </div>
                    </div>
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

                                    </tr>
                                </thead>
                                <tbody class="mdc-data-table__content ng-star-inserted">
                                    @foreach ($estudiantesPracticasIII as $practicaI)
                                        @if ($practicaI->estudiante)
                                            <tr>
                                                <td>{{ strtoupper($practicaI->estudiante->Apellidos) }}
                                                    {{ strtoupper($practicaI->estudiante->Nombres) }}</td>
                                                <td>{{ strtoupper($practicaI->tipoPractica) }}</td>
                                                <td>{{ strtoupper($practicaI->tutorAcademico->Apellidos ?? 'No por el momento') }}
                                                    {{ strtoupper($practicaI->tutorAcademico->Nombres ?? 'No por el momento') }}
                                                </td>
                                                <td>{{ strtoupper($practicaI->NombreTutorEmpresarial) }}</td>
                                                <td>{{ strtoupper($practicaI->Empresa->nombreEmpresa ?? 'No por el momento') }}
                                                </td>
                                                <td>{{ strtoupper($practicaI->nrcPractica->nrc ?? 'No cuenta con NRC') }}
                                                </td>
                                                <td>{{ strtoupper($practicaI->nrcPractica->periodo->numeroPeriodo ?? 'No cuenta con NRC') }}
                                                </td>
                                                <td>{{ strtoupper($practicaI->FechaInicio) }}</td>
                                                <td>{{ strtoupper($practicaI->FechaFinalizacion) }}</td>
                                                <td>{{ strtoupper($practicaI->HorasPlanificadas) }}</td>
                                                <td>{{ $practicaI->Estado }}</td>


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
        <h4><b>Estudiantes Practica 2<b></h4>

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

                <div class="tooltip-container">
                    <span class="tooltip-text">Importar archivo</span>
                    <button type="button" class="button3 efects_button btn_3" data-toggle="modal"
                        data-target="#modalImportar4">
                        <i class="fa fa-upload"></i>
                    </button>
                </div>

                <div class="modal fade" id="modalImportar4" tabindex="-1" role="dialog"
                    aria-labelledby="modalImportarLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <form id="idModalImportar" action="{{ route('import-practicas4') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="modal-header">
                                    <h5 class="modal-title">Importar archivo</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <div class="input input_file">
                                            <span id="fileText" class="fileText">
                                                <i class="fa fa-upload"></i> Haz clic aquí para subir el
                                                documento
                                            </span>
                                            <input type="file" class="form-control-file input input_file"
                                                id="file" name="file" onchange="displayFileName(this)" required>
                                            <span title="Eliminar archivo" onclick="removeFile(this)"
                                                class="remove-icon">✖</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button id="cerrar_modal" type="button" class="button"
                                        data-dismiss="modal">Cerrar</button>
                                    <button type="submit" class="button">Importar Archivo</button>
                                </div>
                            </form>
                        </div>
                    </div>
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

                                    </tr>
                                </thead>
                                <tbody class="mdc-data-table__content ng-star-inserted">
                                    @foreach ($estudiantesPracticasIV as $practicaI)
                                        @if ($practicaI->estudiante)
                                            <tr>
                                                <td>{{ strtoupper($practicaI->estudiante->Apellidos) }}
                                                    {{ strtoupper($practicaI->estudiante->Nombres) }}</td>
                                                <td>{{ strtoupper($practicaI->tipoPractica) }}</td>
                                                <td>{{ strtoupper($practicaI->tutorAcademico->Apellidos ?? 'No por el momento') }}
                                                    {{ strtoupper($practicaI->tutorAcademico->Nombres ?? 'No por el momento') }}
                                                </td>
                                                <td>{{ strtoupper($practicaI->NombreTutorEmpresarial) }}</td>
                                                <td>{{ strtoupper($practicaI->Empresa->nombreEmpresa ?? 'No por el momento') }}
                                                </td>
                                                <td>{{ strtoupper($practicaI->nrcPractica->nrc ?? 'No cuenta con NRC') }}
                                                </td>
                                                <td>{{ strtoupper($practicaI->nrcPractica->periodo->numeroPeriodo ?? 'No cuenta con NRC') }}
                                                </td>
                                                <td>{{ strtoupper($practicaI->FechaInicio) }}</td>
                                                <td>{{ strtoupper($practicaI->FechaFinalizacion) }}</td>
                                                <td>{{ strtoupper($practicaI->HorasPlanificadas) }}</td>
                                                <td>{{ $practicaI->Estado }}</td>


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
        <h4><b>Estudiantes Practica 2.1<b></h4>

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

                <div class="tooltip-container">
                    <span class="tooltip-text">Importar archivo</span>
                    <button type="button" class="button3 efects_button btn_3" data-toggle="modal"
                        data-target="#modalImportar5">
                        <i class="fa fa-upload"></i>
                    </button>
                </div>

                <div class="modal fade" id="modalImportar5" tabindex="-1" role="dialog"
                    aria-labelledby="modalImportarLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <form id="idModalImportar" action="{{ route('import-practicas5') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="modal-header">
                                    <h5 class="modal-title">Importar archivo</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <div class="input input_file">
                                            <span id="fileText" class="fileText">
                                                <i class="fa fa-upload"></i> Haz clic aquí para subir el
                                                documento
                                            </span>
                                            <input type="file" class="form-control-file input input_file"
                                                id="file" name="file" onchange="displayFileName(this)" required>
                                            <span title="Eliminar archivo" onclick="removeFile(this)"
                                                class="remove-icon">✖</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button id="cerrar_modal" type="button" class="button"
                                        data-dismiss="modal">Cerrar</button>
                                    <button type="submit" class="button">Importar Archivo</button>
                                </div>
                            </form>
                        </div>
                    </div>
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

                                    </tr>
                                </thead>
                                <tbody class="mdc-data-table__content ng-star-inserted">
                                    @foreach ($estudiantesPracticasV as $practicaI)
                                        @if ($practicaI->estudiante)
                                            <tr>
                                                <td>{{ strtoupper($practicaI->estudiante->Apellidos) }}
                                                    {{ strtoupper($practicaI->estudiante->Nombres) }}</td>
                                                <td>{{ strtoupper($practicaI->tipoPractica) }}</td>
                                                <td>{{ strtoupper($practicaI->tutorAcademico->Apellidos ?? 'No por el momento') }}
                                                    {{ strtoupper($practicaI->tutorAcademico->Nombres ?? 'No por el momento') }}
                                                </td>
                                                <td>{{ strtoupper($practicaI->NombreTutorEmpresarial) }}</td>
                                                <td>{{ strtoupper($practicaI->Empresa->nombreEmpresa ?? 'No por el momento') }}
                                                </td>
                                                <td>{{ strtoupper($practicaI->nrcPractica->nrc ?? 'No cuenta con NRC') }}
                                                </td>
                                                <td>{{ strtoupper($practicaI->nrcPractica->periodo->numeroPeriodo ?? 'No cuenta con NRC') }}
                                                </td>
                                                <td>{{ strtoupper($practicaI->FechaInicio) }}</td>
                                                <td>{{ strtoupper($practicaI->FechaFinalizacion) }}</td>
                                                <td>{{ strtoupper($practicaI->HorasPlanificadas) }}</td>
                                                <td>{{ $practicaI->Estado }}</td>


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





    <style>
        table tr td {
            font-weight: normal;
        }
    </style>


@endsection
