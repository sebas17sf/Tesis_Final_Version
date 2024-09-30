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
            <div class="icon_alert"><i class="fa-regular fa-circle-x fa-beat"></i></div>
            <div class="content_alert">
                <div class="title">Error!</div>
                <div class="body">{{ session('error') }}</div>
            </div>
        </div>
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
                                    académico</th>
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
                                            class="puntaje_proyecto input input_select2 text-center" id="tabla1"
                                            required />
                                        <br>
                                        <span id="errorTabla1" class="error-message" style="color: red; display: none;">Este
                                            campo es obligatorio.</span>
                                    </div>
                                </td>

                                <td>
                                    <center><b>Comentarios:</b></center>
                                </td>
                                <td colspan="2">
                                    <textarea name="comentarios_proyecto1" class="comentarios input input_select1" id="comentarios1"
                                        placeholder="Ejemplo: 1. Carta de compromiso u otro documento" required></textarea>
                                    <span id="errorComentarios1" class="error-message"
                                        style="color: red; display: none;">Este campo es obligatorio.</span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </form>
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
                                        class="puntaje_proyecto input input_select2 text-center" id="tabla2"  />
                                    <span id="errorTabla2" class="error-message" style="color: red; display: none;">Este
                                        campo es obligatorio.</span>
                                </div>
                            </td>

                            <td>
                                <center><b>Comentarios:</b></center>
                            </td>
                            <td colspan="2">
                                <textarea name="comentarios_proyecto2" class="comentarios input input_select1 " id="comentarios2"
                                    placeholder="Ejemplo: 1. Carta de compromiso u otro documento" ></textarea>
                                <span id="errorComentarios2" class="error-message" style="color: red; display: none;">Este
                                    campo es obligatorio.</span>
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
                            <th colspan="4">Comunidades o Instituciones Beneficiarias que visita el docente por periodo
                                académico con el fin de ser intervenidas</th>
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
                                        class="puntaje_proyecto text-center input input_select2" id="tabla3"  />
                                    <br>
                                    <span id="errorTabla3" class="error-message" style="display: none; color: red;">Este
                                        campo es obligatorio.</span>
                                </div>
                            </td>

                            <td>
                                <center><b>Comentarios:</b></center>
                            </td>
                            <td colspan="2">
                                <textarea name="comentarios_proyecto3" class="comentarios input input_select1 " id="comentarios3"
                                    placeholder="Ejemplo: 1. Carta de compromiso u otro documento" ></textarea>
                                <span id="errorComentarios3" class="error-message" style="color: red; display: none;">Este
                                    campo es obligatorio.</span>
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
                                        class="puntaje_proyecto input input_select2 text-center" id="tabla4"
                                         />
                                    <br>
                                    <span id="errorTabla4" class="error-message" style="display: none; color: red;">Este
                                        campo es obligatorio.</span>
                                </div>
                            </td>

                            <td>
                                <center><b>Comentarios:</b></center>
                            </td>
                            <td colspan="2">
                                <center>
                                    <textarea name="comentarios_proyecto4" class="comentarios input input_select1" id="comentarios4"
                                        placeholder="Ejemplo: 1. Carta de compromiso u otro documento" ></textarea>
                                    <span id="errorComentarios4" class="error-message"
                                        style="color: red; display: none;">Este campo es obligatorio.</span>
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
                            </td>
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
            <div style="display: flex; justify-content: center; gap: 20px;">
                <button type="submit" class="button1 btn_excel">
                    <i class="fas fa-file-excel"></i> Generar Baremo
                </button>
            </div>
            </form>
        </div>

        <div class="table-container1 mat-elevation-z8">
            <form id="horasDocenteForm" action="{{ route('ParticipanteVinculacion.generarHorasDocente') }}"
                method="post">
                @csrf
                <!-- Campo oculto para enviar horas_entre_fechas -->
                <input type="hidden" name="horas_entre_fechas" id="hidden_horas_entre_fechas">

                <div style="display: flex; justify-content: center;">
                    <button type="submit" class="button1 btn_excel">
                        <i class="fas fa-file-excel"></i> NÚMERO DE HORAS DE DOCENTE
                    </button>
                </div>
            </form>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var totalPuntaje = document.getElementById('total_puntaje');
                var horasTotales = document.getElementById('horas_totales');
                var horasEntreFechas = document.getElementById('horas_entre_fechas');
                var hiddenHorasEntreFechas = document.getElementById('hidden_horas_entre_fechas');
                var inputs = document.querySelectorAll('.puntaje_proyecto');

                // Inicializamos las fechas obtenidas desde PHP con el formato adecuado
                var startDateStr = '{{ $inicioFecha }}';
                var endDateStr = '{{ $finalizacionFecha }}';

                function updateTotal() {
                    var total = 0;
                    var valid = true;

                    inputs.forEach(function(input) {
                        var value = parseInt(input.value) || 0;
                        if (![10, 8, 6, 4, 0].includes(value)) {
                            valid = false;
                        }
                        total += value;
                    });

                    if (valid) {
                        totalPuntaje.value = total;
                        calculateHours(total);
                    } else {
                        totalPuntaje.value = '';
                        horasTotales.value = '';
                        hiddenHorasEntreFechas.value = '';
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
                    }
                    horasTotales.value = hours;
                    calculateHoursBetweenDates(hours);
                }

                function calculateHoursBetweenDates(hours) {
                    // Crear objetos de fecha con los valores formateados
                    var startDate = new Date(Date.parse(startDateStr));
                    var endDate = new Date(Date.parse(endDateStr));

                    // Validar que las fechas sean válidas
                    if (isNaN(startDate) || isNaN(endDate)) {
                        console.error('Las fechas no son válidas:', { startDateStr, endDateStr });
                        horasEntreFechas.value = '0';
                        hiddenHorasEntreFechas.value = '0';
                        return;
                    }

                    // Calcular la cantidad de semanas entre las fechas
                    var timeDiff = endDate.getTime() - startDate.getTime();

                    if (timeDiff <= 0) {
                        console.error('La fecha de inicio es posterior a la fecha de finalización o son iguales');
                        horasEntreFechas.value = '0';
                        hiddenHorasEntreFechas.value = '0';
                        return;
                    }

                    // Calcular el número de semanas completas (tomando en cuenta 7 días por semana)
                    var weeks = Math.ceil(timeDiff / (7 * 24 * 60 * 60 * 1000));
                    var hoursBetweenDates = weeks * hours;

                    // Actualizar los valores de los campos
                    horasEntreFechas.value = hoursBetweenDates;
                    hiddenHorasEntreFechas.value = hoursBetweenDates;

                    console.log('Fechas:', { startDate, endDate, weeks, hoursBetweenDates });
                }

                inputs.forEach(function(input) {
                    input.addEventListener('input', updateTotal);
                });

                // Agregar evento al formulario para enviar el valor oculto correctamente
                document.getElementById('horasDocenteForm').addEventListener('submit', function(event) {
                    hiddenHorasEntreFechas.value = horasEntreFechas.value;

                    console.log('Horas entre fechas antes de enviar:', hiddenHorasEntreFechas.value);

                    if (!hiddenHorasEntreFechas.value || hiddenHorasEntreFechas.value === '0') {
                        alert('El valor de horas entre fechas no es válido. Por favor, verifique los datos ingresados.');
                        event.preventDefault();
                    }
                });

            });
        </script>


        <script>
            document.addEventListener('DOMContentLoaded', function() {

                 var inputs = document.querySelectorAll('.puntaje_proyecto');



                var textareas = document.querySelectorAll('.comentarios');

                var form1 = document.getElementById('generarBaremoForm');
                var form2 = document.getElementById('horasDocenteForm');

                function validateForm(event) {
                    var valid = true;

                    inputs.forEach(function(input) {
                        var error = input.nextElementSibling;
                        if (!input.value) {
                            error.style.display = 'block';
                            valid = false;
                        } else {
                            error.style.display = 'none';
                        }
                    });

                    textareas.forEach(function(textarea) {
                        var error = textarea.nextElementSibling;
                        if (!textarea.value.trim()) {
                            error.style.display = 'block';
                            valid = false;
                        } else {
                            error.style.display = 'none';
                        }
                    });

                    if (!valid) {
                        event.preventDefault();
                    }
                }

                form1.addEventListener('submit', validateForm);
                form2.addEventListener('submit', validateForm);

                inputs.forEach(function(input) {
                    input.addEventListener('input', function() {
                        var error = input.nextElementSibling;
                        if (input.value) {
                            error.style.display = 'none';
                        }
                    });
                });

                textareas.forEach(function(textarea) {
                    textarea.addEventListener('input', function() {
                        var error = textarea.nextElementSibling;
                        if (textarea.value.trim()) {
                            error.style.display = 'none';
                        }
                    });
                });
            });




        </script>

    @endsection
