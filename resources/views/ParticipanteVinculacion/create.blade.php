@extends('layouts.registro')

@section('title', 'Ingresar Datos del Estudiante')

@section('content')

    <div class="mat-elevation-z8 contenedor_general">
        <div class="container mt-3">
            <h3 class="text-center"><b>Registro/Actualización de datos del docente</b></h3>
            <hr>

            @if (session('success'))
                <div class="contenedor_alerta success">
                    <div class="icon_alert"><i class="fa-regular fa-circle-check fa-beat"></i></div>
                    <div class="content_alert">
                        <div class="title">Éxito!</div>
                        <div class="body">{{ session('success') }}</div>
                    </div>
                </div>
            @endif

            @if ($errors->any())
                <div class="contenedor_alerta error">
                    <div class="icon_alert"><i class="fa-regular fa-circle-x fa-beat"></i></div>
                    <div class="content_alert">
                        <div class="title">Error!</div>
                        <div class="body">{{ $errors->first() }}</div>
                    </div>
                </div>
            @endif

            <form action="{{ route('ParticipanteVinculacion.register') }}" method="post" id="participantForm">
                @csrf
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="nombres"><strong>Ingrese Nombres:</strong></label>
                        <input type="text" id="nombres" name="nombres" class="form-control input"
                               placeholder="Ingrese los dos Nombres"
                               value="{{ old('nombres', session('docente') ? session('docente')->nombres : '') }}"  >
                        <small id="error-nombre" ></small>

                        @error('nombres')
                        <span style="color: red; font-size: 10px; display: block; margin-top: 5px;">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group col-md-4">
                        <label for="apellidos"><strong>Ingrese Apellidos:</strong></label>
                        <input type="text" id="apellidos" name="apellidos" class="form-control input"
                               placeholder="Ingrese los dos Apellidos"
                               value="{{ old('apellidos', session('docente') ? session('docente')->apellidos : '') }}"  >
                        <span id="error-apellidos" style="color: red; font-size: 10px; display: block; margin-top: 5px;"></span>
                        @error('apellidos')
                        <span style="color: red; font-size: 10px; display: block; margin-top: 5px;">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group col-md-4">
                        <label for="correo"><strong>Ingrese Correo:</strong></label>
                        <input type="email" id="correo" name="correo" class="form-control input"
                               placeholder="Ingrese el Correo Electrónico"
                               value="{{ old('correo', session('docente') ? session('docente')->correo : '') }}"  >
                        <span id="correoError" style="color: red; font-size: 10px; display: block; margin-top: 5px;"></span>
                        @error('correo')
                        <span style="color: red; font-size: 10px; display: block; margin-top: 5px;">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-row">

                    <div class="form-group col-md-4">
                        <label for="cedula"><strong>Ingrese la Cédula:</strong></label>
                        <input type="text" id="cedula" name="cedula" class="form-control input"
                               placeholder="Ingrese Cédula (10 dígitos)" pattern="\d{10}"
                               title="Debe ingresar exactamente 10 números"
                               value="{{ old('cedula', session('docente') ? session('docente')->cedula : '') }}"  >
                        <span id="cedulaError" style="color: red; font-size: 10px; display: block; margin-top: 5px;"></span>
                        @error('cedula')
                        <span style="color: red; font-size: 10px; display: block; margin-top: 5px;">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group col-md-4">
                        <label for="espe_id"><strong>Ingrese la ID de la ESPE:</strong></label>
                        <input type="text" id="espe_id" name="espe_id" class="form-control input"
                               placeholder="Ingrese la ID de la ESPE"
                               value="{{ old('espe_id', session('docente') ? session('docente')->espeId : '') }}"  >
                        <span id="espeIdError" style="color: red; font-size: 10px; display: block; margin-top: 5px;"></span>
                        @error('espe_id')
                        <span style="color: red; font-size: 10px; display: block; margin-top: 5px;">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group col-md-4">
                        <label for="departamento"><strong>Seleccione el departamento al que pertenece:</strong></label>
                        <select id="departamento" name="departamento" class="form-control input_select input"  >
                            <option value="">Seleccione un departamento</option>
                            @foreach ($departamentos as $departamento)
                                <option value="{{ $departamento->departamento }}"
                                        data-nombre="{{ $departamento->departamento }}">
                                    {{ $departamento->departamento }}
                                </option>
                            @endforeach
                        </select>
                        <smal id="departamentoError" style="color: red; font-size: 10px; display: block; margin-top: 5px;"></small>
                    </div>
                </div>
                <div class="button-container">
                    <button type="submit" class="button1 efects_button">Guardar Datos</button>
                </div>
            </form>


        </div>
    </div>


    <script src="{{ asset('js/validaciones/createDocentes.js') }}"></script>
    <script src="{{ asset('js/ValidacionesFormualario/docentes/validaciones.js') }}"></script>
    <script src="js/admin/index.js"></script>


@endsection
