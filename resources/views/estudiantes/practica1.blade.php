@extends('layouts.app')

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





    <div class="container">
        @if (isset($practicaPendiente))
            <h4>Detalles de la Práctica en Ejecución:</h4>
            <dl class="row">
                <dt class="col-sm-3 text-nowrap">Estudiante:</dt>
                <dd class="col-sm-9">{{ $practicaPendiente->estudiante->Apellidos }}
                    {{ $practicaPendiente->estudiante->Nombres }}</dd>

                <dt class="col-sm-3 text-nowrap">Práctica:</dt>
                <dd class="col-sm-9">{{ $practicaPendiente->tipoPractica }}</dd>

                <dt class="col-sm-3 text-nowrap">Docente Tutor:</dt>
                <dd class="col-sm-9">{{ $practicaPendiente->tutorAcademico->Apellidos }}
                    {{ $practicaPendiente->tutorAcademico->Nombres }}</dd>

                <dt class="col-sm-3 text-nowrap">Empresa:</dt>
                <dd class="col-sm-9">{{ $practicaPendiente->Empresa->nombreEmpresa }}</dd>

                <dt class="col-sm-3 text-nowrap">Nombre del Tutor Empresarial:</dt>
                <dd class="col-sm-9">{{ $practicaPendiente->NombreTutorEmpresarial }}</dd>

                <dt class="col-sm-3 text-nowrap">Cédula del Tutor Empresarial:</dt>
                <dd class="col-sm-9">{{ $practicaPendiente->CedulaTutorEmpresarial }}</dd>

                <dt class="col-sm-3 text-nowrap">Función:</dt>
                <dd class="col-sm-9">{{ $practicaPendiente->Funcion }}</dd>

                <dt class="col-sm-3 text-nowrap">Teléfono del Tutor Empresarial:</dt>
                <dd class="col-sm-9">{{ $practicaPendiente->TelefonoTutorEmpresarial }}</dd>

                <dt class="col-sm-3 text-nowrap">Estado de Fase I:</dt>
                <dd class="col-sm-9">{{ $practicaPendiente->Estado }}</dd>
            </dl>




            





    </div>
@else
    <br>
    <hr>

    <h3>Fase 1 - Inicio del proceso de prácticas pre profesionales del estudiante</h3>
    <form action="{{ route('guardarPracticas') }}" method="POST">
        @csrf
        <div class="table-responsive-sm">
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <th>ID de Estudiante:</th>
                        <td>{{ strtoupper($estudiante->espe_id) }}</td>
                    </tr>
                    <tr>
                        <th>Cédula:</th>
                        <td>{{ strtoupper($estudiante->cedula) }}</td>
                    </tr>
                    <tr>
                        <th>Nombres Completos:</th>
                        <td>{{ strtoupper($estudiante->Apellidos) }} {{ strtoupper($estudiante->Nombres) }}
                        </td>
                    </tr>
                    <tr>
                        <th>Correo:</th>
                        <td>{{ strtoupper($correoEstudiante) }}</td>
                    </tr>
                    <tr>
                        <th>Nivel:</th>
                        <td>
                            <select id="Nivel" name="Nivel" class="form-control">
                                <option value="Pregrado">Pregrado</option>
                                <option value="Posgrado">Posgrado</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th>Campus:</th>
                        <td>EXTENSION SANTO DOMINGO</td>
                    </tr>
                    <tr>
                        <th>Departamento:</th>
                        <td>{{ strtoupper($estudiante->Departamento) }}</td>
                    </tr>
                    <tr>
                        <th>Escoja Práctica:</th>
                        <td>
                            <select id="Practicas" name="Practicas" class="form-control">
                                <option value="SERVICIO A LA COMUNIDAD">SERVICIO A LA COMUNIDAD</option>
                                <option value="PASANTIAS">PASANTIAS</option>
                                <option value="PRACTICAS PRE PROFESIONALES">PRACTICAS PRE PROFESIONALES
                                </option>
                                <option value="AYUDANDIA DE CATEDRA">AYUDANDIA DE CATEDRA</option>
                                <option value="AYUDANTIA DE INVESTIGACION">AYUDANTIA DE INVESTIGACION</option>
                                <option value="RECONOCE EXPERIENCIA LABORAL">RECONOCE EXPERIENCIA LABORAL
                                </option>
                                <option value="P. INTEGRADOR SABERES">P. INTEGRADOR SABERES</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th>Teléfono:</th>
                        <td>{{ strtoupper($estudiante->celular) }}</td>
                    </tr>
                </tbody>
            </table>
        </div>


        <div class="table-responsive-sm">
            <h3>Datos de la Práctica</h3>
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <th>Estado Académico Actual:</th>
                        <td>
                            <select id="EstadoAcademico" name="EstadoAcademico" class="form-control">
                                <option value="FINALIZANDO ESTUDIOS">FINALIZANDO ESTUDIOS</option>
                                <option value="CURSANDO ESTUDIOS">CURSANDO ESTUDIOS</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th>Fecha de inicio de la práctica:</th>
                        <td>
                            <input type="date" id="FechaInicio" name="FechaInicio" class="form-control">
                        </td>
                    </tr>
                    <tr>
                        <th>Fecha de finalización de la práctica:</th>
                        <td>
                            <input type="date" id="FechaFinalizacion" name="FechaFinalizacion" class="form-control">
                        </td>
                    </tr>
                    <tr>
                        <th>Horas planificadas:</th>
                        <td>
                            <input type="number" id="HorasPlanificadas" name="HorasPlanificadas" class="form-control"
                                min="80" max="144">
                        </td>
                    </tr>
                    <tr>
                        <th>Horario de entrada:</th>
                        <td>
                            <input type="time" id="HoraEntrada" name="HoraEntrada" class="form-control">
                        </td>
                    </tr>
                    <tr>
                        <th>Horario de salida:</th>
                        <td>
                            <input type="time" id="HoraSalida" name="HoraSalida" class="form-control">
                        </td>
                    </tr>
                    <tr>
                        <th>Área de conocimiento:</th>
                        <td>
                            <input type="text" id="AreaConocimiento" name="AreaConocimiento" class="form-control">
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>




        <button type="button" id="verOpcionesBtn" class="btn btn-sm btn-secondary">Ver opciones de
            prácticas</button>
        <br><br>
        <table id="opcionesPracticas" class="table table-bordered" style="display: none;">
            <tbody>
                <tr>
                    <th>Sugiera un docente como tutor académico:</th>
                    <td>
                        <div class="form-group">
                            <label for="ID_tutorAcademico">
                            </label>
                            <select name="ID_tutorAcademico" class="form-control input input select" required>
                                <option value="">Seleccionar el Docente</option>
                                @foreach ($profesores as $profesor)
                                    <option value="{{ $profesor->id }}"> {{ $profesor->Apellidos }}
                                        {{ $profesor->Nombres }}
                                        {{ $profesor->Departamento }} {{ $profesor->Correo }} </option>
                                @endforeach
                            </select>
                        </div>

                    </td>
                </tr>
                <tr>
                    <th>Empresa:</th>
                    <td>
                        <select id="Empresa" name="Empresa" class="form-control">
                            @foreach ($empresas as $empresa)
                                <option value="{{ $empresa->id }}">{{ $empresa->nombreEmpresa }} -
                                    Requiere: {{ $empresa->actividadesMacro }} </option>
                            @endforeach
                        </select>
                    </td>
                </tr>

                <tr>
                    <th>Cédula del tutor empresarial:</th>
                    <td>
                        <input type="text" id="CedulaTutorEmpresarial" name="CedulaTutorEmpresarial"
                            class="form-control">
                    </td>

                </tr>

                <tr>
                    <th>Nombre del tutor empresarial:</th>
                    <td>
                        <input type="text" id="NombreTutorEmpresarial" name="NombreTutorEmpresarial"
                            class="form-control">
                    </td>

                </tr>

                <tr>
                    <th>Funcion:</th>
                    <td>
                        <input type="text" id="Funcion" name="Funcion" class="form-control">
                    </td>

                </tr>

                <tr>
                    <th>Telefono:</th>
                    <td>
                        <input type="text" id="TelefonoTutorEmpresarial" name="TelefonoTutorEmpresarial"
                            class="form-control">
                    </td>

                </tr>

                <tr>
                    <th>Email:</th>
                    <td>
                        <input type="text" id="EmailTutorEmpresarial" name="EmailTutorEmpresarial"
                            class="form-control">
                    </td>
                </tr>

                <tr>
                    <th>Departamento dentro de la empresa:</th>
                    <td>
                        <input type="text" id="DepartamentoTutorEmpresarial" name="DepartamentoTutorEmpresarial"
                            class="form-control">
                    </td>

                </tr>



            </tbody>

        </table>
        <button type="submit" id="iniciarPracticasBtn" class="btn btn-sm btn-secondary" style="display: none;">Iniciar
            prácticas</button>
    </form>
    @endif
    </div>



@endsection



<script>
    document.addEventListener('DOMContentLoaded', function() {
        var verOpcionesBtn = document.getElementById('verOpcionesBtn');
        var opcionesPracticas = document.getElementById('opcionesPracticas');
        var iniciarPracticasBtn = document.getElementById('iniciarPracticasBtn');

        var opcionesAbiertas = false; // Variable para rastrear el estado de las opciones

        verOpcionesBtn.addEventListener('click', function() {
            if (opcionesAbiertas) {
                opcionesPracticas.style.display = 'none'; // Cierra las opciones
                iniciarPracticasBtn.style.display = 'none'; // Oculta el botón de inicio
            } else {
                opcionesPracticas.style.display = 'table'; // Abre las opciones
                iniciarPracticasBtn.style.display = 'block'; // Muestra el botón de inicio
            }

            // Cambia el estado de las opciones
            opcionesAbiertas = !opcionesAbiertas;
        });

        iniciarPracticasBtn.addEventListener('click', function() {
            // Aquí puedes agregar la lógica para cuando se hace clic en "Iniciar prácticas"
        });
    });
</script>
