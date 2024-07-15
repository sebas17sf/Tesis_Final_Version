@extends('layouts.participante')
@section('title', 'Practicas')

@section('title_component', 'Estudiantes en Prácticas')
@section('content')


    <h4>Estudiantes en Prácticas 1</h4>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">

                    <div class="table-responsive">
                        <table class="table table-bordered table-striped" id="table">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Carrera</th>
                                    <th>Correo</th>
                                    <th>Telefono</th>
                                    <th>Empresa</th>
                                    <th>Tutor Empresarial</th>
                                    <th>Horas de practicas</th>
                                    <th>Fecha Inicio</th>
                                    <th>Fecha Fin</th>
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

    </div>

    <h4>Estudiantes a calificar</h4>

    <br>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">

                    <div class="table-responsive">
                        <table class="table table-bordered table-striped" id="table">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Correo</th>
                                    <th>Telefono</th>
                                    <th>Nota tutor empresarial 12%</th>
                                    <th>Nota tutor academico 8%</th>
                                    <th>Acciones</th>

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

    <h4>Estudiants Calificados</h4>

    <br>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">

                    <div class="table-responsive">
                        <table class="table table-bordered table-striped" id="table">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Correo</th>
                                    <th>Nota tutor empresarial 12%</th>
                                    <th>Nota tutor academico 8%</th>
                                    <th>Nota final</th>

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

    <script src="{{ asset('js/participante/practicas.js') }}"></script>

@endsection
