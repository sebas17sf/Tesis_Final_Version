@extends('layouts.participante')
@section('title', 'Baremo')

@section('title_component', 'Panel Baremo')
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
            <div class="icon_alert"><i class="fa-regular fa-xmark"></i></div>
            <div class="content_alert">
                <div class="title">Error!</div>
                <div class="body">{{ session('error') }}</div>
            </div>
            <div class="icon_remove">
                <button class="button4 btn_3_2"><i class="fa-regular fa-xmark"></i></button>
            </div>
        </div>

        <script>
            document.querySelector('.contenedor_alerta.error .icon_remove button').addEventListener('click', function() {
                this.closest('.contenedor_alerta').style.display = 'none';
            });
        </script>
    @endif


    <br>
    <h5>
        <center><b>Baremo 2: Para calcular la distribución de carga horaria de docente colaborador de proyectos de
                vinculación con
                la sociedad</b></center>
    </h5>
    <hr>
    <div class="contenedor_tabla">
        <div class="table-container mat-elevation-z8">
            <form id="generarBaremoForm" method="POST" action="{{ route('ParticipanteVinculacion.generarBaremo') }}">
                @csrf
                <div id="tablaProyectos">
                    <table class="mat-mdc-table">
                        <thead class="ng-star-inserted">
                            <tr class="mat-mdc-header-row mdc-data-table__header-row cdk-header-row ng-star-inserted">
                                <th>Ítem</th>
                                <th colspan="4">Número de provincias en las que participa el docente por periodo
                                    académico
                                </th>
                            </tr>
                            <tr>
                                <th>Variable</th>
                                <th>4 o más provincias</th>
                                <th>3 provincias</th>
                                <th>2 Provincias</th>
                                <th>1 Provincia</th>
                            </tr>
                        </thead>
                        <tbody class="mdc-data-table__content ng-star-inserted">
                            <tr>
                                <td>Puntaje:</td>
                                <td style="text-align: center;">10</td>
                                <td style="text-align: center;">8</td>
                                <td style="text-align: center;">6</td>
                                <td style="text-align: center;">4</td>
                            </tr>
                            <tr>
                                <td><b>Puntaje del Proyecto:</b></td>
                                <td>
                                    <div style="text-align: center;">
                                        <input type="number" name="puntaje_proyecto1"
                                            class="puntaje_proyecto input input_select2 text-center" id="tabla1" />
                                        <br>
                                        <span id="errorTabla1" class="error-message"
                                            style="color: red; display: block;"></span>
                                    </div>
                                </td>

                                <td>
                                    <center><b>Comentarios:</b></center>
                                </td>
                                <td colspan="2">
                                    <textarea name="comentarios_proyecto1" class="comentarios input input_select1" id="comentarios1"
                                        placeholder="Ejemplo: 1. Carta de compromiso u otro documento"></textarea>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
        </div>

    </div>
    <br>
    <div class="contenedor_tabla">
        <div class="table-container mat-elevation-z8">
            <div id="tablaProyectos">
                <table class="mat-mdc-table">
                    <thead class="ng-star-inserted">
                        <tr class="mat-mdc-header-row mdc-data-table__header-row cdk-header-row ng-star-inserted">
                            <th>Ítem</th>
                            <th colspan="4">Promedio de horas de viaje que realiza el docente hacia la comunidad o
                                institución beneficiaria intervenida en el periodo académico</th>
                        </tr>
                        <tr>
                            <th>Variable</th>
                            <th>7 o más horas</th>
                            <th>4 a 6 horas</th>
                            <th>2 a 3 horas</th>
                            <th>1 hora o menos</th>
                        </tr>
                    </thead>
                    <tbody class="mdc-data-table__content ng-star-inserted">
                        <tr>
                            <td>Puntaje:</td>
                            <td style="text-align: center;">10</td>
                            <td style="text-align: center;">8</td>
                            <td style="text-align: center;">6</td>
                            <td style="text-align: center;">4</td>
                        </tr>
                        <tr>
                            <td><b>Puntaje del Proyecto:</b></td>
                            <td>
                                <div style="text-align: center;">
                                    <input type="number" name="puntaje_proyecto2"
                                        class="puntaje_proyecto input input_select2 text-center" id="tabla2" />
                                    <span id="errorTabla2" class="error-message" style="color: red; display: block;"></span>
                                </div>
                            </td>

                            <td>
                                <center><b>Comentarios:</b></center>
                            </td>
                            <td colspan="2">
                                <textarea name="comentarios_proyecto2" class="comentarios input input_select1 " id="comentarios2"
                                    placeholder="Ejemplo: 1. Carta de compromiso u otro documento"></textarea>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
    <br>
    <div class="contenedor_tabla">
        <div class="table-container mat-elevation-z8">
            <div id="tablaProyectos">
                <table class="mat-mdc-table">
                    <thead class="ng-star-inserted">
                        <tr class="mat-mdc-header-row mdc-data-table__header-row cdk-header-row ng-star-inserted">
                            <th>Ítem</th>
                            <th colspan="4">Comunidades o Instituciones Beneficiarias que visita el docente por
                                periodo académico con el fin de ser intervenidas</th>
                        </tr>
                        <tr>
                            <th>Variable</th>
                            <th>8 o más comunidades o Instituciones</th>
                            <th>5 a 7 comunidades o instituciones</th>
                            <th>2 a 4 comunidades o instituciones</th>
                            <th>Una Comunidad o institución</th>
                        </tr>
                    </thead>
                    <tbody class="mdc-data-table__content ng-star-inserted">
                        <tr>
                            <td>Puntaje:</td>
                            <td style="text-align: center;">10</td>
                            <td style="text-align: center;">8</td>
                            <td style="text-align: center;">6</td>
                            <td style="text-align: center;">4</td>
                        </tr>
                        <tr>
                            <td><b>Puntaje del Proyecto:</b></td>
                            <td>
                                <div style="text-align: center;">
                                    <input type="number" name="puntaje_proyecto3"
                                        class="puntaje_proyecto text-center input input_select2" id="tabla3" />
                                    <br>
                                    <span id="errorTabla3" class="error-message" style="display: block; color: red;"></span>
                                </div>
                            </td>

                            <td>
                                <center><b>Comentarios:</b>
                                    <center>
                            </td>
                            <td colspan="2">
                                <textarea name="comentarios_proyecto3" class="comentarios input input_select1 " id="comentarios3"
                                    placeholder="Ejemplo: 1. Carta de compromiso u otro documento"></textarea>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
    <br>
    <div class="contenedor_tabla">
        <div class="table-container mat-elevation-z8">
            <div id="tablaProyectos">
                <table class="mat-mdc-table">
                    <thead class="ng-star-inserted">
                        <tr class="mat-mdc-header-row mdc-data-table__header-row cdk-header-row ng-star-inserted">
                            <th>Ítem</th>
                            <th colspan="4">Número de estudiantes tutorados por periodo académico</th>
                        </tr>
                        <tr>
                            <th>Variable</th>
                            <th>26 o más estudiantes</th>
                            <th>16 a 25 estudiantes</th>
                            <th>6 a 15 estudiantes</th>
                            <th>1 a 5 estudiantes</th>
                        </tr>
                    </thead>
                    <tbody class="mdc-data-table__content ng-star-inserted">
                        <tr>
                            <td>Puntaje:</td>
                            <td style="text-align: center;">10</td>
                            <td style="text-align: center;">8</td>
                            <td style="text-align: center;">6</td>
                            <td style="text-align: center;">4</td>
                        </tr>
                        <tr>
                            <td><b>Puntaje del Proyecto:</b></td>
                            <td>
                                <div style="text-align: center;">
                                    <input type="number" name="puntaje_proyecto4"
                                        class="puntaje_proyecto input input_select2 text-center" id="tabla4" />
                                    <br>
                                    <span id="errorTabla4" class="error-message"
                                        style="display: block; color: red;"></span>
                                </div>
                            </td>

                            <td>
                                <center><b>Comentarios:</b></center>
                            </td>
                            <td colspan="2">
                                <center>
                                    <textarea name="comentarios_proyecto4" class="comentarios input input_select1" id="comentarios4"
                                        placeholder="Ejemplo: 1. Carta de compromiso u otro documento"></textarea>
                                </center>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
    <br>
    <div class="contenedor_tabla">
        <div class="table-container1 mat-elevation-z8">
            <div id="tablaProyectos">
                <table class="mat-mdc-table1">
                    <thead class="ng-star-inserted">
                        <tr class="mat-mdc-header-row mdc-data-table__header-row cdk-header-row ng-star-inserted">
                            <td style="text-align: center;"><b>TOTAL:</b>
                                <input class="input from-group1 input_select2 text-center" style="font-weight: bold;"
                                    type="number" id="total_puntaje" readonly />
                            <td style="text-align: center;"><b>HORAS TOTALES:</b>
                                <input type="number" class="input from-group1 input_select2 text-center"
                                    style="font-weight: bold;" id="horas_totales" readonly />
                            </td>
                            <td style="text-align: center;"><b>HORAS TOTALES ENTRE FECHAS:</b>
                                <input type="number" class="input from-group1 input_select2 text-center"
                                    style="font-weight: bold;" id="horas_entre_fechas" readonly />
                            </td>
                        </tr>
                    </thead>
                    <tbody>
                </table>
            </div>

            <hr>
            <center>
                <button type="submit" class="button1 btn_excel">
                    <i class="fas fa-file-excel"></i> Generar Baremo
                </button>
            </center>
            <br>
            </form>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var tabla1 = document.getElementById('tabla1');
            var errorTabla1 = document.getElementById('errorTabla1');
            var tabla2 = document.getElementById('tabla2');
            var errorTabla2 = document.getElementById('errorTabla2');
            var tabla3 = document.getElementById('tabla3');
            var errorTabla3 = document.getElementById('errorTabla3');
            var tabla4 = document.getElementById('tabla4');
            var errorTabla4 = document.getElementById('errorTabla4');
            var totalPuntaje = document.getElementById('total_puntaje');
            var horasTotales = document.getElementById('horas_totales');
            var horasEntreFechas = document.getElementById('horas_entre_fechas');
            var inputs = document.querySelectorAll('.puntaje_proyecto');

            function updateTotal() {
                var total = 0;
                var errorMessages = [errorTabla1, errorTabla2, errorTabla3, errorTabla4];
                var valid = true;

                inputs.forEach(function(input, index) {
                    var value = parseInt(input.value) || 0;
                    var error = '';
                    if (![10, 8, 6, 4, 0].includes(value)) {
                        error = 'El valor no es valido.';
                        valid = false;
                    }
                    total += value;
                    errorMessages[index].textContent = error;
                });

                if (valid) {
                    totalPuntaje.value = total;
                    calculateHours(total);
                } else {
                    totalPuntaje.value = '';
                    horasTotales.value = '';
                }
            }

            function calculateHours(total) {
                var hours = 0;
                if (total >= 32) {
                    hours = 6;
                } else if (total >= 25) {
                    hours = 4;
                } else if (total <= 24) {
                    hours = 2;
                } else {
                    hours = 0;
                }
                horasTotales.value = hours;
                calculateHoursBetweenDates(hours);
            }


            function calculateHoursBetweenDates(hours) {
                var startDate = new Date('{{ $inicioFecha }}');
                var endDate = new Date('{{ $finalizacionFecha }}');
                var diffTime = Math.abs(endDate - startDate);
                var diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
                var totalHoursBetweenDates = diffDays * hours;
                horasEntreFechas.value = totalHoursBetweenDates;
            }

            inputs.forEach(function(input) {
                input.addEventListener('input', updateTotal);
            });
        });
    </script>
@endsection
