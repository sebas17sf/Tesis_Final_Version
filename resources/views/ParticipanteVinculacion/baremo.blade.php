@extends('layouts.participante')
@section('title', 'Baremo')

@section('title_component', 'Panel Baremo')
@section('content')
    <br>
    <h5><b>Baremo 2: Para calcular la distribución de carga horaria de docente colaborador de proyectos de vinculación con
            la sociedad</b></h5>
    <hr>
    <form id="generarBaremoForm" method="POST" action="{{ route('ParticipanteVinculacion.generarBaremo') }}">
        @csrf
        <div class="contenedor_tabla">
            <div class="table-container mat-elevation-z8">
                <div id="tablaProyectos">
                    <table class="mat-mdc-table">
                        <thead class="ng-star-inserted">
                            <tr class="mat-mdc-header-row mdc-data-table__header-row cdk-header-row ng-star-inserted">
                                <th>Ítem</th>
                                <th colspan="4">Número de provincias en las que participa el docente por periodo académico
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
                                <td colspan="4"><input type="number" name="puntaje_proyecto1" class="puntaje_proyecto"
                                        id="tabla1" /></td>
                                <td><span id="errorTabla1" class="error-message"></span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <textarea name="comentarios_proyecto1" class="comentarios" id="comentarios1" rows="4"
                placeholder="Ejemplo: 1. Carta de compromiso u otro documento"></textarea>
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
                                <td colspan="4"><input type="number" name="puntaje_proyecto2" class="puntaje_proyecto"
                                        id="tabla2" /></td>
                                <td><span id="errorTabla2" class="error-message"></span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <textarea name="comentarios_proyecto2" class="comentarios" id="comentarios2" rows="4"
            placeholder="Ejemplo: 1. Carta de compromiso u otro documento"></textarea>
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
                                <td colspan="4"><input type="number" name="puntaje_proyecto3" class="puntaje_proyecto"
                                        id="tabla3" /></td>
                                <td><span id="errorTabla3" class="error-message"></span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <textarea name="comentarios_proyecto3" class="comentarios" id="comentarios3" rows="4"
            placeholder="Ejemplo: 1. Carta de compromiso u otro documento"></textarea>
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
                                <td colspan="4"><input type="number" name="puntaje_proyecto4" class="puntaje_proyecto"
                                        id="tabla4" /></td>
                                <td><span id="errorTabla4" class="error-message"></span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <textarea name="comentarios_proyecto4" class="comentarios" id="comentarios4" rows="4"
            placeholder="Ejemplo: 1. Carta de compromiso u otro documento"></textarea>
        </div>
        <br>
        <div class="contenedor_tabla">
            <div class="table-container mat-elevation-z8">
                <div id="tablaProyectos">
                    <table class="mat-mdc-table">
                        <thead class="ng-star-inserted">
                            <tr class="mat-mdc-header-row mdc-data-table__header-row cdk-header-row ng-star-inserted">
                                <td style="text-align: center;"><b>TOTAL:</b></td>
                                <td><input type="number" id="total_puntaje" readonly /></td>
                                <td style="text-align: center;"><b>Horas Totales:</b></td>
                                <td><input type="number" id="horas_totales" readonly /></td>
                                <td style="text-align: center;"><b>Horas Totales Entre Fechas:</b></td>
                                <td><input type="number" id="horas_entre_fechas" readonly /></td>
                            </tr>
                        </thead>
                        <tbody>
                    </table>
                </div>
            </div>
        </div>
        <hr>
        <center>
            <button type="submit" class="button1 btn_excel">
                <i class="fas fa-file-excel"></i> Generar Baremo
            </button>
        </center>
    </form>

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
                    if (value < 0 || value > 10) {
                        error = 'El valor debe estar entre 0 y 10';
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
                if (total >= 26) {
                    hours = 10;
                } else if (total >= 16) {
                    hours = 8;
                } else if (total >= 6) {
                    hours = 6;
                } else {
                    hours = 4;
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
