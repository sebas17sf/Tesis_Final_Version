@extends('layouts.participante')
@section('title', 'Practicas')

@section('title_component', 'Panel Prácticas')
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


    <section>
        <div class="contenedor_registro_genero ">
            <h4><b>Estudiantes en Prácticas 1</b></h4>
            <hr>
            <div class="mat-elevation-z8 contenedor_general">
    <div class="contenedor_tabla">
                    <div class="table-container mat-elevation-z8">

                        <div id="tablaDocentes">
                            <table class="mat-mdc-table">
                                <thead class="ng-star-inserted">
                                    <tr
                                        class="mat-mdc-header-row mdc-data-table__header-row cdk-header-row ng-star-inserted">
                                        <th class="tamanio1">ESTUDIANTE</th>
                                    <th class="tamanio1">CARRERA</th>
                                    <th>CORREO</th>
                                    <th>TELÉFONO</th>
                                    <th>EMPRESA</th>
                                    <th>TUTOR EMPRESARIAL</th>
                                    <th>HORAS DE PRÁCTICAS</th>
                                    <th>FECHA INICIO </th>
                                    <th>FFECHA FIN </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($estudiantes as $practica)
                                    <tr>
                                        <td>{{ $practica->apellidos }} {{ $practica->nombres }}</td>
                                        <td>{{ $practica->carrera }}</td>
                                        <td>{{ $practica->correo }}</td>
                                        <td>{{ $practica->celular }}</td>
                                        <td>{{ $practica->practicasi->empresa->nombreEmpresa }}</td>
                                        <td>{{ $practica->practicasi->NombreTutorEmpresarial }}</td>
                                        <td>{{ $practica->practicasi->HorasPlanificadas }}</td>
                                        <td>{{ $practica->practicasi->FechaInicio }}</td>
                                        <td>{{ $practica->practicasi->FechaFinalizacion }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>

</div>
<br>

    <h4><b>Estudiantes a calificar</b></h4>
            <hr>
            <div class="mat-elevation-z8 contenedor_general">
    <div class="contenedor_tabla">
                    <div class="table-container mat-elevation-z8">

                        <div id="tablaDocentes">
                            <table class="mat-mdc-table">
                                <thead class="ng-star-inserted">
                                    <tr
                                        class="mat-mdc-header-row mdc-data-table__header-row cdk-header-row ng-star-inserted">
                                       <th class="tamanio1">ESTUDIANTE</th>
                                    <th>CORREO</th>
                                    <th>TELÉFONO</th>
                                    <th>NOTA TUTOR EMPRESARIAL 12%</th>
                                    <th>NOTA TUTOR ACADÉMICO 8%</th>
                                    <th>ACCIONES</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($estudiantesCalificar as $index => $practica)
                                    <form action="{{ route('ParticipanteVinculacion.guardarNotasPracticasi') }}"
                                        method="POST">
                                        @csrf
                                        <tr>
                                            <td>{{ $practica->apellidos }} {{ $practica->nombres }}</td>
                                            <td>{{ $practica->correo }}</td>
                                            <td>{{ $practica->celular }}</td>
                                            <input type="hidden" name="estudianteId"
                                                value="{{ $practica->estudianteId }}">
                                            <td>
                                                <input type="number" name="notaTutorEmpresarial" id="notaTutorEmpresarial">
                                                <span id="errorMensaje" style="color: red; display: none;"></span>
                                            </td>
                                            <td>
                                                <input type="number" name="notaTutorAcademico" id="notaTutorAcademico">
                                                <span id="errorMensajeAcademico" style="color: red; display: none;"></span>
                                            </td>
                                            <td><button type="submit">Guardar</button></td>
                                        </tr>
                                    </form>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
<br>
    <h4><b>Estudiantes Calificados</b></h4>

    <hr>
            <div class="mat-elevation-z8 contenedor_general">
    <div class="contenedor_tabla">
                    <div class="table-container mat-elevation-z8">

                        <div id="tablaDocentes">
                            <table class="mat-mdc-table">
                                <thead class="ng-star-inserted">
                                    <tr
                                        class="mat-mdc-header-row mdc-data-table__header-row cdk-header-row ng-star-inserted">
                                       <th class="tamanio1">ESTUDIANTE</th>
                                    <th>CORREO</th>
                                    <th>NOTA TUTOR EMPRESARIAL 12%</th>
                                    <th>NOTA TUTOR ACADÉMICO 8%</th>
                                    <th>NOTA FINAL</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($estudiantesCalificados as $index => $practica)
                                    <tr>
                                        <td>{{ $practica->apellidos }} {{ $practica->nombres }}</td>
                                        <td>{{ $practica->correo }}</td>
                                        <td>{{ $practica->celular }}</td>


                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>

    <script src="{{ asset('js/plantilla/main.js') }}" type="module"></script>
    <script src="js\admin\acciones.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.13.0/jquery-ui.min.js"></script>


    <script src="{{ asset('js/participante/practicas.js') }}"></script>
    <script src="js\admin\index.js"></script>
@endsection
