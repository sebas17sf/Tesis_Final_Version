@extends('layouts.registro')

@section('title', 'Ingresar Datos del Estudiante')


@section('content')

    <div class="mat-elevation-z8 contenedor_general">
        <div class="container mt-3">
            <h6 class="text-center"><b>Ingresar Datos del Estudiante</b></h6>
            <hr>

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
            <div class="container-fluid">

<<<<<<< HEAD

                <form method="POST" action="{{ route('estudiantes.store') }}" class="custom-form">
                    @csrf
                    <div class="row">
                        <div class="col-md-4">
                            <!-- Primera columna -->
                            <div class="form-group">
                                <label for="Nombres">Nombres:</label>
                                <input id="Nombres" type="text" class="form-control input" name="Nombres" required
                                    autofocus placeholder="Ingrese sus Nombres" pattern="[A-Za-zÁ-úñÑ\s]+"
                                    title="Ingrese solo letras (sin caracteres especiales)">
                                <span id="error-message-name" style="color: red; display: none;">Debe ingresar solo
                                    caracteres</span>
                            </div>


                            <div class="form-group">
                                <label for="espe_id"> ESPE ID:</label>
                                <input id="espe_id" type="text" class="form-control input" name="espe_id" required
                                    placeholder="Ingrese su ESPE ID">
                            </div>
                            <div class="form-group">
                                <label for="Cohorte"> Cohorte:</label>
                                <select class="form-control input input-select" id="Cohorte" name="Cohorte" required>
                                    <option value="">Seleccione su Cohorte</option>
                                    @foreach ($periodos as $periodo)
                                        <option value="{{ $periodo->numeroPeriodo }}">{{ $periodo->numeroPeriodo }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>


                        <div class="col-md-4">
                            <!-- Segunda columna -->
                            <div class="form-group">
                                <label for="Apellidos">Apellidos:</label>
                                <input id="Apellidos" type="text" class="form-control input" name="Apellidos" required
                                    placeholder="Ingrese sus Apellidos" pattern="[A-Za-zÁ-úñÑ\s]+"
                                    title="Ingrese solo letras (sin caracteres especiales)">
                                <span id="error-message-apellidos" style="color: red; display: none;">Debe ingresar solo
                                    caracteres</span>
                            </div>

                            <div class="form-group">
                                <label for="celular">Celular:</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text input">+593</span>
                                    </div>
                                    <input id="celular" type="text" class="form-control input" name="celular" required
                                        placeholder="Ingrese su número de celular">
                                </div>
                                <span id="error-message-cell" style="color: red; display: none;">Número de celular no
                                    válido</span>
                            </div>

                            <div class="form-group">
                                <label for="Carrera">Carrera:</label>
                                <select class="form-control input input-select" id="Carrera" name="Carrera" required>
                                    <option value="">Seleccione su Carrera</option>
                                    <option value="Ingeniería en Tecnologías de la información">Tecnologías de la
                                        información
                                    </option>
                                    <option value="Ingeniería en Agropecuaria">Agropecuaria</option>
                                    <option value="Ingeniería en Biotecnologia">Biotecnologia</option>
                                </select>
                            </div>

                        </div>




                        <div class="col-md-4">

                            <div class="form-group">
                                <label for="cedula">Cédula:</label>
                                <input id="cedula" type="text" class="form-control input" name="cedula" required
                                    pattern="[0-9]{10}" title="Ingrese un número de cédula válido (10 dígitos)"
                                    placeholder="Ingrese su número de cédula (10 dígitos)">
                                <span id="error-message" style="color: red; display: none;">Cédula no válida</span>
                            </div>

                            <div class="form-group">
                                <label for="Periodo">Periodo:</label>
                                <select class="form-control input input-select" id="Periodo" name="Periodo" required>
                                    <option value="">Seleccione su Periodo</option>
                                    @foreach ($periodos as $periodo)
                                        <option value="{{ $periodo->id }}">{{ $periodo->numeroPeriodo }}
                                            {{ $periodo->Periodo }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="Departamento"><i class="material-icons">location_city</i> Departamento:</label>
                                <select class="form-control input input-select" id="Departamento" name="Departamento"
                                    required>
                                    <option value="Ciencias de la Computación">DCCO - Departamento de Computación</option>
                                    <option value="Ciencias Exactas">DCEX - Ciencias Exactas</option>
                                    <option value="Ciencias de la Vida y Agricultura">DCVA - Departamento de Ciencias de la
                                        Vida y
                                        Agricultura</option>
                                </select>
                            </div>


                            <div class="form-group">
                                <label for="Provincia">Localidad:</label>
                                <select class="form-control input input-select" id="Provincia" name="Provincia" required>
                                    <option value="">Seleccione su Localidad</option>
                                    <option value="Santo Domingo">Santo Domingo</option>
                                    <option value="Luz de America">Luz de America</option>
                                </select>
                            </div>
                        </div>
=======
            <form method="POST" action="{{ route('estudiantes.store') }}" class="custom-form">
    @csrf
    <div class="row">
        <div class="col-md-4">
            <!-- Primera columna -->
            <div class="form-group">
                <label for="Nombres">Nombres:</label>
                <input id="Nombres" type="text" class="form-control input" name="Nombres" required autofocus placeholder="Ingrese sus Nombres" pattern="[A-Za-zÁ-úñÑ\s]+" title="Ingrese solo letras (sin caracteres especiales)">
                <span id="error-message-name" style="color: red; display: none;">Debe ingresar solo caracteres</span>
            </div>
            <div class="form-group">
                <label for="celular">Celular:</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text input">+593</span>
>>>>>>> d9f934ab6944c26788b6395b507de8039f1b6dcf
                    </div>
                    <input id="celular" type="text" class="form-control input" name="celular" required placeholder="Ingrese su número de celular">
                </div>
                <span id="error-message-cell" style="color: red; display: none;">Número de celular no válido</span>
            </div>
            <div class="form-group">
                <label for="Periodo">Periodo:</label>
                <select class="form-control input input-select" id="Periodo" name="Periodo" required>
                    <option value="">Seleccione su Periodo</option>
                    @foreach ($periodos as $periodo)
                        <option value="{{ $periodo->id }}">{{ $periodo->numeroPeriodo }} {{ $periodo->Periodo }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="col-md-4">
            <!-- Segunda columna -->
            <div class="form-group">
                <label for="Apellidos">Apellidos:</label>
                <input id="Apellidos" type="text" class="form-control input" name="Apellidos" required placeholder="Ingrese sus Apellidos" pattern="[A-Za-zÁ-úñÑ\s]+" title="Ingrese solo letras (sin caracteres especiales)">
                <span id="error-message-apellidos" style="color: red; display: none;">Debe ingresar solo caracteres</span>
            </div>
            <div class="form-group">
                <label for="Carrera">Carrera:</label>
                <select class="form-control input input-select" id="Carrera" name="Carrera" required>
                    <option value="">Seleccione su Carrera</option>
                    <option value="Ingeniería en Tecnologías de la información">Tecnologías de la información</option>
                    <option value="Ingeniería en Agropecuaria">Agropecuaria</option>
                    <option value="Ingeniería en Biotecnologia">Biotecnologia</option>
                </select>
            </div>
            <div class="form-group">
                <label for="Departamento">Departamento:</label>
                <select class="form-control input input-select" id="Departamento" name="Departamento" required>
                    <option value="">Seleccione su Departamento</option>
                    <option value="Ciencias de la Computación">DCCO - Ciencias de la Computación</option>
                    <option value="Ciencias Exactas">DCEX - Ciencias Exactas</option>
                    <option value="Ciencias de la Vida y Agricultura">DCVA - Ciencias de la Vida y Agricultura</option>
                </select>
            </div>
        </div>

        <div class="col-md-4">
            <!-- Tercera columna con dos sub-columnas -->
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="espe_id">ESPE ID:</label>
                        <input id="espe_id" type="text" class="form-control input" name="espe_id" required placeholder="Ingrese su ESPE ID">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="Cohorte">Cohorte:</label>
                        <select class="form-control input input-select" id="Cohorte" name="Cohorte" required>
                            <option value="">Seleccione su Cohorte</option>
                            @foreach ($periodos as $periodo)
                                <option value="{{ $periodo->numeroPeriodo }}">{{ $periodo->numeroPeriodo }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="cedula">Cédula:</label>
                <input id="cedula" type="text" class="form-control input" name="cedula" required pattern="[0-9]{10}" title="Ingrese un número de cédula válido (10 dígitos)" placeholder="Ingrese su número de cédula (10 dígitos)">
                <span id="error-message" style="color: red; display: none;">Cédula no válida</span>
            </div>

            <div class="form-group">
                <label for="Provincia">Localidad:</label>
                <select class="form-control input input-select" id="Provincia" name="Provincia" required>
                    <option value="">Seleccione su Localidad</option>
                    <option value="Santo Domingo">Santo Domingo</option>
                    <option value="Luz de America">Luz de America</option>
                </select>
            </div>
        </div>
    </div>

    <div class="button-container">
        <button type="submit" class="button1 efects_button">Guardar Datos</button>
    </div>
    <br>
</form>



            </div>
        </div>
    </div>
@endsection
