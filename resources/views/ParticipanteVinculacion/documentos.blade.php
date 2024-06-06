@extends('layouts.participante')
@section('title', 'Documentos')

@section('title_component', 'Desarrollo de documentación')
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



    <div class="container mt-5">


    <div class="contenedor_tabla">
                    <div class="table-container mat-elevation-z8">

                        <div id="tablaDocentes">
                            <table class="mat-mdc-table">
                                <thead class="ng-star-inserted">
                                    <tr
                                        class="mat-mdc-header-row mdc-data-table__header-row cdk-header-row ng-star-inserted">
                                        <th class="tamanio1">Nombre del Reporte</th>
                                            <th class="tamanio1">Acción</th>
                                        </tr>
                                    </thead>
                                    <tbody class="mdc-data-table__content ng-star-inserted">
                                        <tr>
                                            <td>Generar Evaluación de Estudiantes</td>
                                            <td>
                                                <form
                                                    action="{{ route('ParticipanteVinculacion.generarEvaluacionEstudiante') }}"
                                                    method="post">
                                                    @csrf
                                                    <center><button type="submit" class="button1 btn_excel efects_button">
                                                            <i class="fas fa-file-excel"></i> Generar
                                                        </button></center>
                                                </form>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Generar Número de Horas de Docentes</td>
                                            <td>
                                                <form action="{{ route('ParticipanteVinculacion.generarHorasDocente') }}"
                                                    method="post">
                                                    @csrf
                                                    <center><button type="submit" class="button1 btn_excel efects_button">
                                                            <i class="fas fa-file-excel"></i> Generar
                                                        </button></center>
                                                </form>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Registro de Estudiantes</td>
                                            <td>
                                                <form action="{{ route('ParticipanteVinculacion.generarAsistencia') }}"
                                                    method="post">
                                                    @csrf
                                                    <div class="form-group">
                                                        <label for="fecha"class="label">Fecha de asistencia:</label>
                                                        <input type="date" id="fecha" name="fecha"
                                                            class="form-control input">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="lugar">Lugar de la actividad:</label>
                                                        <input type="text" id="lugar" name="lugar"
                                                            class="form-control input">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="actividades">Actividades a realizar:</label>
                                                        <textarea id="actividades" name="actividades" class="form-control input"></textarea>
                                                    </div>
                                                    <center> <button type="submit" class="button1">
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
                            <textarea placeholder="Ingrese los resultados alcanzados" name="porcentaje[]" class="form-control input" rows="2"
                                required></textarea>
                        </div>
                    </div>
                </div>

                <div class="d-flex">
                    <button type="button" class="button3 efects_button btn_primary mr-2" onclick="agregarCampo()"><i
                            class="fa-solid fa-plus"></i></button></button>
                    <button type="button" class="button3 efects_button btn_eliminar1 1mr-2" onclick="eliminarCampo()"><i
                            class='bx bx-trash'></i></button>
        </div >
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
                        <textarea   name="acciones[]" class="form-control input"
                                  rows="2" required></textarea>
                    </div>

                    <div class="form-group col-md-4">
                        <label for="responsable"><strong>Responsable:</strong></label>
                        <textarea   name="responsable[]" class="form-control input" rows="2"
                                  required></textarea>
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
                <button type="button" class="button1 btn_excel efects_button" data-toggle="modal" data-target="#myModal">
                    <i class="fas fa-file-excel"></i>
                    Generar Baremo
                </button>
            </div>
        </center>

        <!-- Modal -->
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Generar Baremo</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="generarBaremoForm" action="{{ route('ParticipanteVinculacion.generarBaremo') }}" method="post">
                            @csrf
                            <img src="{{ asset('img/puntajeBaremo.jpeg') }}" alt="puntajeBaremo" class="img-fluid">
                            <br>
                            <div class="form-group">
                                <label for="tabla1"><strong>Ingrese el puntaje de la primera tabla:</strong></label>
                                <input type="number"  id="tabla1" name="tabla1" class="form-control input">
                                <small id="errorTabla1" class="text-danger"></small>
                            </div>

                            <div class="form-group">
                                <label for="tabla2"><strong>Ingrese el puntaje de la segunda tabla:</strong></label>
                                <input type="number" id="tabla2" name="tabla2" class="form-control input">
                                <small id="errorTabla2" class="text-danger"></small>
                            </div>

                            <div class="form-group">
                                <label for="tabla3"><strong>Ingrese el puntaje de la tercera tabla:</strong></label>
                                <input type="number" id="tabla3" name="tabla3" class="form-control input">
                                <small id="errorTabla3" class="text-danger"></small>
                            </div>

                            <div class="form-group">
                                <label for="tabla4"><strong>Ingrese el puntaje de la cuarta tabla:</strong></label>
                                <input type="number" id="tabla4" name="tabla4" class="form-control input">
                                <small id="errorTabla4" class="text-danger"></small>
                            </div>

                            <div class="form-group">
                                <label for="puntajeTotal"><strong>Puntaje Total:</strong></label>
                                <input type="number" id="puntajeTotal" name="puntajeTotal" class="form-control input" readonly>
                            </div>

                            <button type="submit" class="button">
                                <i class="fas fa-file-excel"></i> Generar Baremo
                            </button>
                        </form>

                    </div>
                </div>
            </div>
        </div>

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>


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
