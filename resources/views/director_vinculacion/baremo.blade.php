@extends('layouts.directorVinculacion')
@section('title', 'Baremo')

@section('title_component', 'Panel Baremo')
@section('content')
<br>
<h5><b>Baremo 2: Para calcular la distribución de carga horaria de docente Director de proyectos de vinculación con la sociedad</b></h5>
<hr>
<div class="contenedor_tabla">
                        <div class="table-container mat-elevation-z8">

                            <div id="tablaProyectos">
                                <table class="mat-mdc-table">
                                    <thead class="ng-star-inserted">
                                        <tr
                                            class="mat-mdc-header-row mdc-data-table__header-row cdk-header-row ng-star-inserted">

                                            <th>Ítem</th>
            <th colspan="4">Número de provincias en las que participa el docente por periodo académico</th>
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
            <td style="text-align: left;" colspan="4"><input type="text" name="puntaje_proyecto1" class="puntaje_proyecto"/></td>
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
                                        <tr
                                            class="mat-mdc-header-row mdc-data-table__header-row cdk-header-row ng-star-inserted">

                                            <th>Ítem</th>
            <th colspan="4">Promedio de horas de viaje que realiza el docente hacia la comunidad o institución beneficiaria intervenida en el periodo académico</th>
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
        <td colspan="4"><input type="number" name="puntaje_proyecto2" class="puntaje_proyecto" /></td>
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
                                        <tr
                                            class="mat-mdc-header-row mdc-data-table__header-row cdk-header-row ng-star-inserted">

                                             <th>Ítem</th>
            <th colspan="4">Comunidades o Instituciones Beneficiarias que visita el docente por periodo académico con el fin de ser intervenidas</th>
        </tr>
        <tr>
            <th>Variable</th>
            <th >8 o más comunidades o Instituciones</th>
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
        <td colspan="4"><input type="number" name="puntaje_proyecto3" class="puntaje_proyecto" /></td>
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
                                        <tr
                                            class="mat-mdc-header-row mdc-data-table__header-row cdk-header-row ng-star-inserted">

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
        <td colspan="4"><input type="number" name="puntaje_proyecto4" class="puntaje_proyecto" /></td>
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
                                        <tr
                                            class="mat-mdc-header-row mdc-data-table__header-row cdk-header-row ng-star-inserted">

                                             <td style="text-align: center;"><b>TOTAL:</b></td>
            <td><input type="number" id="total_puntaje" readonly /></td>
        </tr>
    </tbody>
</table>
</div>
</div>
</div>
<hr>
<center><button type="submit" class="button1 btn_excel">
                            <i class="fas fa-file-excel"></i> Generar Baremo
                        </button><center>
<script>
    function updateTotal() {
        var total = 0;
        document.querySelectorAll('.puntaje_proyecto').forEach(function(element) {
            var value = parseInt(element.value) || 0;
            total += value;
        });
        document.getElementById('total_puntaje').value = total;
    }

    document.querySelectorAll('.puntaje_proyecto').forEach(function(element) {
        element.addEventListener('input', updateTotal);
    });
</script>

@endsection
