@extends('layouts.participante')
@section('title', 'Documentos')

@section('title_component', 'Panel de documentación')
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


    <div class="container mt-5">


        <div class="contenedor_tabla">
            <div class="table-container mat-elevation-z8">

                <div id="tablaDocentes">
                    <table class="mat-mdc-table">
                        <thead class="ng-star-inserted">
                            <tr class="mat-mdc-header-row mdc-data-table__header-row cdk-header-row ng-star-inserted">
                                <th class="tamanio1">NOMBRE DEL REPORTE</th>
                                <th class="tamanio1">ACCIÓN</th>
                            </tr>
                        </thead>
                        <tbody class="mdc-data-table__content ng-star-inserted">
                            <tr>
                                <td style=" font-size: 11px !important;">GENERAR EVALUACIÓN DE DOCENTE</td>
                                <td>
                                    <form action="{{ route('ParticipanteVinculacion.generarEvaluacionEstudiante') }}"
                                        method="post">
                                        @csrf
                                        <center><button type="submit"
                                                class="button1 btn_excel efects_button input_select1">
                                                <i class="fas fa-file-excel"></i> Generar
                                            </button></center>
                                    </form>
                                </td>
                            </tr>
                            <tr>
                                <td style=" font-size: 11px !important;">GENERAR NUMERO DE HORAS DE DOCENTE</td>
                                <td>
                                    <form action="{{ route('ParticipanteVinculacion.generarHorasDocente') }}"
                                        method="post">
                                        @csrf
                                        <center><button type="submit"
                                                class="button1 btn_excel efects_button input_select1">
                                                <i class="fas fa-file-excel"></i> Generar
                                            </button></center>
                                    </form>
                                </td>
                            </tr>
                            <tr>
                                <td style=" font-size: 11px !important;">REGISTRO DE ESTUDIANTES</td>
                                <td>
                                    <form action="{{ route('ParticipanteVinculacion.generarAsistencia') }}" method="post">
                                        @csrf
                                        <div class="form-group">
                                            <label for="fecha" class="label"><b>Fecha de asistencia:</b></label>
                                            <input type="date" id="fecha" name="fecha"
                                                class="form-control input input_select1">
                                        </div>
                                        <div class="form-group">
                                            <label for="lugar" class="label"><b>Lugar de la actividad:</b></label>
                                            <input type="text" id="lugar" name="lugar"
                                                class="form-control input input_select1">
                                        </div>
                                        <div class="form-group">
                                            <label for="actividades" class="label"><b>Actividades a realizar:</b></label>
                                            <textarea id="actividades" name="actividades" class="form-control input input_select1"></textarea>
                                        </div>
                                        <center> <button type="submit" class="button1 input_select1">
                                                <i class="fas fa-save"></i> Generar
                                            </button></center>
                                    </form>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <hr>
        <h4><b>Informe Docente - Vinculación a la Sociedad</b></h4>
        <hr>
        <form action="{{ route('director_vinculacion.generarInformeDirector') }}" method="POST">
            @csrf

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="Objetivos"><strong>Ingrese el Objetivo del Proyecto:</strong></label>
                    <textarea placeholder="Ingrese el objetivo" class="form-control input" id="Objetivos" rows="2" name="Objetivos"></textarea>
                </div>

                <div class="form-group col-md-6">
                    <label for="intervencion"><strong>Lugar de intervención del Proyecto:</strong></label>
                    <input placeholder="Ingrese el lugar donde se realizo el proyecto" type="text"
                        class="form-control input" id="intervencion" name="intervencion">
                </div>
            </div>

            <hr>
            <h4><b>Actividades Planificadas y Resultados Alcanzados</b></h4>
            <hr>


            <div id="campos">
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="planificadas"><strong>Actividades planificadas:</strong></label>
                        <textarea placeholder="Ingrese las actividades planificadas" name="planificadas[]" class="form-control input"
                            rows="2" required></textarea>
                    </div>

                    <div class="form-group col-md-4">
                        <label for="alcanzados"><strong>Resultados alcanzados:</strong></label>
                        <textarea placeholder="Ingrese los resultados alcanzados" name="alcanzados[]" class="form-control input" rows="2"
                            required></textarea>
                    </div>

                    <div class="form-group col-md-4">
                        <label for="porcentaje"><strong>Porcentaje alcanzado:</strong></label>
                        <textarea placeholder="Ingrese los resultados alcanzados" name="porcentaje[]" class="form-control input"
                            rows="2" required></textarea>
                    </div>
                </div>
            </div>

            <div class="d-flex">
                <button type="button" class="button3 efects_button btn_primary mr-2" onclick="agregarCampo()"><i
                        class="fa-solid fa-plus"></i></button></button>
                <button type="button" class="button3 efects_button btn_eliminar1 1mr-2" onclick="eliminarCampo()"><i
                        class='bx bx-trash'></i></button>
            </div>
            <hr>
            <h4><b>Beneficiarios atendidos</b></h4>
            <hr>

            <div class="form-row">
                <div class="form-group col-md-3">
                    <label for="Hombres"><strong>Cantidad de Hombres beneficiarios-atendidos:</strong></label>
                    <input placeholder="Ingrese los Hombres beneficiados" type="number" class="form-control input"
                        id="Hombres" name="Hombres" min="1">
                </div>

                <div class="form-group col-md-3">
                    <label for="Mujeres"><strong>Cantidad de Mujeres beneficiarios-atendidos:</strong></label>
                    <input placeholder="Ingrese las Mujeres beneficiadas" type="number" class="form-control input"
                        id="Mujeres" name="Mujeres" min="1">
                </div>

                <div class="form-group col-md-3">
                    <label for="Niños"><strong>Cantidad de Niños beneficiarios-atendidos:</strong></label>
                    <input placeholder="Ingrese los Niños beneficiados" type="number" class="form-control input"
                        id="Niños" name="Niños" min="1">
                </div>

                <div class="form-group col-md-3">
                    <label for="capacidad"><strong>Cantidad de Personas con capacidad
                            beneficiarios-atendidos:</strong></label>
                    <input placeholder="Ingrese los Personas beneficiadas" type="number" class="form-control input"
                        id="capacidad" name="capacidad" min="1">
                </div>
            </div>






            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="Observaciones1"><strong>Observaciones en Hombres:</strong></label>
                    <textarea placeholder="Ingrese las Observaciones" class="form-control input" id="Observaciones1" rows="3"
                        name="Observaciones1"></textarea>
                </div>

                <div class="form-group col-md-6">
                    <label for="Observaciones2"><strong>Observaciones en Mujeres:</strong></label>
                    <textarea placeholder="Ingrese las Observaciones" class="form-control input" id="Observaciones2" rows="3"
                        name="Observaciones2"></textarea>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="Observaciones3"><strong>Observaciones en Niños:</strong></label>
                    <textarea placeholder="Ingrese las Observaciones" class="form-control input" id="Observaciones3" rows="3"
                        name="Observaciones3"></textarea>
                </div>

                <div class="form-group col-md-6">
                    <label for="Observaciones4"><strong>Observaciones en Personas con capacidad:</strong></label>
                    <textarea placeholder="Ingrese las Observaciones" class="form-control input" id="Observaciones4" rows="3"
                        name="Observaciones4"></textarea>
                </div>
            </div>

            <hr>
            <h4><b>Conclusiones y Recomendaciones</b></h4>
            <hr>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="Conclusiones"><strong>Conclusiones:</strong></label>
                    <textarea placeholder="Ingrese la conclusion" class="form-control input" id="Conclusiones" rows="3"
                        name="Conclusiones"></textarea>
                </div>

                <div class="form-group col-md-6">
                    <label for="Recomendaciones"><strong>Recomendaciones:</strong></label>
                    <textarea placeholder="Ingrese la recomendacion" class="form-control input" id="Recomendaciones" rows="3"
                        name="Recomendaciones"></textarea>
                </div>
            </div>


            <center><button type="submit" class="button1">
                    <i class="fas fa-cogs"></i> Generar
                </button>
                <center>
        </form>





    </div>

    <hr>
    <h4><b>Acta de reuniones</b></h4>
    <hr>

    <form action="{{ route('ParticipanteVinculacion.generarActaReunion') }}" method="post">
        @csrf

        <div class="row">
            <div class="col-md-6 form-group">
                <label for="lugar"><strong>Lugar de la reunión:</strong></label>
                <input type="text" id="lugar" name="lugar" class="form-control input">
            </div>

            <div class="col-md-6 form-group">
                <label for="tema"><strong>Tema de la reunión:</strong></label>
                <input type="text" id="tema" name="tema" class="form-control input">
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 form-group">
                <label for="fecha"><strong>Fecha de la reunión:</strong></label>
                <input type="date" id="fecha" name="fecha" class="form-control input">
            </div>

            <div class="col-md-4 form-group">
                <label for="hora"><strong>Hora de la reunión:</strong></label>
                <input type="time" id="horaInicial" name="horaInicial" class="form-control input">
            </div>

            <div class="col-md-4 form-group">
                <label for="hora"><strong>Hora de finalización de la reunión:</strong></label>
                <input type="time" id="horaFinal" name="horaFinal" class="form-control input">
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 form-group">
                <label for="objetivo"><strong>objetivo:</strong></label>
                <textarea id="objetivo" name="objetivo" class="form-control input"></textarea>
            </div>

            <div class="col-md-6 form-group">
                <label for="antecedentes"><strong>antecedentes:</strong></label>
                <textarea id="antecedentes" name="antecedentes" class="form-control input"></textarea>
            </div>
        </div>
        <div id="campos2">
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="acciones"><strong>Acciones a realizar:</strong></label>
                    <textarea name="acciones[]" class="form-control input" rows="2" required></textarea>
                </div>

                <div class="form-group col-md-4">
                    <label for="responsable"><strong>Responsable:</strong></label>
                    <textarea name="responsable[]" class="form-control input" rows="2" required></textarea>
                </div>

                <div class="form-group col-md-4">
                    <label for="fechaAcciones"><strong>Fecha termino:</strong></label>
                    <input type="date" name="fechaAcciones[]" class="form-control input" rows="2"
                        required></input>
                </div>
            </div>
        </div>

        <div class="d-flex">
            <button type="button" class="button3 efects_button btn_primary mr-2" onclick="agregarCampo2()"><i
                    class="fa-solid fa-plus"></i></button></button>
            <button type="button" class="button3 efects_button btn_eliminar1 1mr-2" onclick="eliminarCampo2()"><i
                    class='bx bx-trash'></i></button>
        </div <hr>

    </form>

    <center>
        <div class="d-flex justify-content-center">
            <button type="submit" class="button1 mr-2">
                <i class="fas fa-cogs"></i> Generar
            </button>

        </div>
    </center>

    <script src="{{ asset('js/plantilla/main.js') }}" type="module"></script>
    <script src="js\admin\acciones.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.13.0/jquery-ui.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.js"></script>


    <script>
        function agregarCampo() {
            var campos = document.getElementById('campos');
            var nuevoCampo = document.createElement('div');
            nuevoCampo.className = 'form-row';
            nuevoCampo.innerHTML = `
            <div class="form-group col-md-4">
                <label><strong>Nueva Actividad Planificada:</strong></label>
                <textarea name="planificadas[]" class="form-control input" rows="2" required></textarea>
            </div>
            <div class="form-group col-md-4">
                <label><strong>Nuevo Resultado Alcanzado:</strong></label>
                <textarea name="alcanzados[]" class="form-control input" rows="2" required></textarea>
            </div>
            <div class="form-group col-md-4">
                <label><strong>Nuevo Porcentaje Alcanzado:</strong></label>
                <textarea name="porcentaje[]" class="form-control input" rows="2" required></textarea>
            </div>
        `;
            campos.appendChild(nuevoCampo);
        }

        function eliminarCampo() {
            var campos = document.getElementById('campos');
            var camposAdicionales = campos.querySelectorAll('.form-row:not(:first-child)');
            if (camposAdicionales.length > 0) {
                campos.removeChild(camposAdicionales[camposAdicionales.length - 1]);
            }
        }
    </script>

    <script>
        function agregarCampo2() {
            var campos = document.getElementById('campos2');
            var nuevoCampo = document.createElement('div');
            nuevoCampo.className = 'form-row';
            nuevoCampo.innerHTML = `
            <div class="form-group col-md-4">
                <label><strong>Nueva Actividad Planificada:</strong></label>
                <textarea name="acciones[]" class="form-control input" rows="2" required></textarea>
            </div>
            <div class="form-group col-md-4">
                <label><strong>Nuevo Resultado Alcanzado:</strong></label>
                <textarea name="responsable[]" class="form-control input" rows="2" required></textarea>
            </div>
            <div class="form-group col-md-4">
                <label><strong>Nuevo Porcentaje Alcanzado:</strong></label>
                <input type="date" name="fechaAcciones[]" class="form-control input" required></input>
            </div>     `;
            campos.appendChild(nuevoCampo);
        }

        function eliminarCampo2() {
            var campos = document.getElementById('campos2');
            var camposAdicionales = campos.querySelectorAll('.form-row:not(:first-child)');
            if (camposAdicionales.length > 0) {
                campos.removeChild(camposAdicionales[camposAdicionales.length - 1]);
            }
        }
    </script>



@endsection
