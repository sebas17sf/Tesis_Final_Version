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

    <div>
                <div class="table-container ">

                    <div id="tablaProyectos">
                        <table class="mat-mdc-table">
                            <thead class="ng-star-inserted">
                                <tr class="mat-mdc-header-row mdc-data-table__header-row cdk-header-row ng-star-inserted">
                              
                                        <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Nombre del Reporte</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Generar Evaluación de Estudiantes</td>
                        <td>
                            <form action="{{ route('ParticipanteVinculacion.generarEvaluacionEstudiante') }}" method="post">
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
                            <form action="{{ route('ParticipanteVinculacion.generarHorasDocente') }}" method="post">
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
                            <form action="{{ route('ParticipanteVinculacion.generarAsistencia') }}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="fecha"class="label">Fecha de asistencia:</label>
                                    <input type="date" id="fecha" name="fecha" class="form-control input">
                                </div>
                                <div class="form-group">
                                    <label for="lugar">Lugar de la actividad:</label>
                                    <input type="text" id="lugar" name="lugar" class="form-control input">
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
<hr>
        <h4><b>Informe Docente - Vinculación a la Sociedad</b></h4>

        <form action="{{ route('director_vinculacion.generarInformeDirector') }}" method="POST">
            @csrf

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="Objetivos"><strong>Ingrese el Objetivo del Proyecto:</strong></label>
                    <textarea placeholder="Ingrese el objetivo" class="form-control input" id="Objetivos" rows="2" name="Objetivos"></textarea>
                </div>

                <div class="form-group col-md-6">
                    <label for="intervencion"><strong>Lugar de intervención del Proyecto:</strong></label>
                    <input placeholder="Ingrese el lugar donde se realizo el proyecto" type="text" class="form-control input"
                        id="intervencion" name="intervencion">
                </div>
            </div>

            <hr>
            <h4><b>Actividades Planificadas y Resultados Alcanzados</b></h4>
            <hr>


            <div id="campos">
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="planificadas"><strong>Actividades planificadas:</strong></label>
                        <textarea placeholder="Ingrese las actividades planificadas" name="planificadas[]" class="form-control input" rows="2"
                            required></textarea>
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
            <button type="button" class="button3 efects_button btn_primary mr-2" onclick="agregarCampo()"><i class="fa-solid fa-plus"></i></button></button>
            <button type="button" class="button3 efects_button btn_eliminar1 1mr-2" onclick="eliminarCampo()"><i
                                class='bx bx-trash'></i></button>
</div
            <hr>
            <h4><b>Beneficiarios-atendidos</b></h4>
            <hr>

            <div class="form-row">
                <div class="form-group col-md-3">
                    <label for="Hombres"><strong>Cantidad de Hombres beneficiarios-atendidos:</strong></label>
                    <input placeholder="Ingrese los Hombres beneficiados" type="number" class="form-control input" id="Hombres"
                        name="Hombres" min="1">
                </div>

                <div class="form-group col-md-3">
                    <label for="Mujeres"><strong>Cantidad de Mujeres beneficiarios-atendidos:</strong></label>
                    <input placeholder="Ingrese las Mujeres beneficiadas" type="number" class="form-control input" id="Mujeres"
                        name="Mujeres" min="1">
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
            </button><center>
        </form>

    </div>

    <style>
        /* Estilos CSS personalizados */
        .table {
            background-color: #ffffff;
            /* Color de fondo de la tabla */
        }

        .table thead th {
            background-color: #f8f9fa;
            /* Color de fondo de las celdas de encabezado */
        }

        .table-striped tbody tr:nth-of-type(odd) {
            background-color: #f8f9fa;
            /* Color de fondo de las filas impares */
        }

        .btn-light {
            background-color: #e9ecef;
            /* Color de fondo de los botones */
        }

        .btn-light:hover {
            background-color: #d9d9d9;
            /* Color de fondo al pasar el mouse sobre los botones */
        }
    </style>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    function agregarCampo() {
        var campos = document.getElementById('campos');
        var nuevoCampo = document.createElement('div');
        nuevoCampo.className = 'form-row';
        nuevoCampo.innerHTML = `
            <div class="form-group col-md-4">
                <label><strong>Nueva Actividad Planificada:</strong></label>
                <textarea name="planificadas[]" class="form-control" rows="2" required></textarea>
            </div>
            <div class="form-group col-md-4">
                <label><strong>Nuevo Resultado Alcanzado:</strong></label>
                <textarea name="alcanzados[]" class="form-control" rows="2" required></textarea>
            </div>
            <div class="form-group col-md-4">
                <label><strong>Nuevo Porcentaje Alcanzado:</strong></label>
                <textarea name="porcentaje[]" class="form-control" rows="2" required></textarea>
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

@endsection
