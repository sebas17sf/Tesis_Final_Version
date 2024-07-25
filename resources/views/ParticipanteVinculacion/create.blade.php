@extends('layouts.registro')

@section('title', 'Ingresar Datos del Estudiante')

@section('content')

<div class="mat-elevation-z8 contenedor_general">
    <div class="container mt-3">
        <h3 class="text-center"><b>Registro de Docente</b></h3>
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

        <form action="{{ route('ParticipanteVinculacion.register') }}" method="post">
            @csrf
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="nombres"><strong>Ingrese Nombres:</strong></label>
                    <input type="text" id="nombres" name="nombres" class="form-control input"
                        placeholder="Ingrese los dos Nombres" value="{{ old('nombres', session('docente') ? session('docente')->nombres : '') }}" required>
                    <small id="error-nombre" class="form-text text-danger"></small>

                    @error('nombres')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group col-md-4">
                    <label for="apellidos"><strong>Ingrese Apellidos:</strong></label>
                    <input type="text" id="apellidos" name="apellidos" class="form-control input"
                        placeholder="Ingrese los dos Apellidos" value="{{ old('apellidos', session('docente') ? session('docente')->apellidos : '') }}" required>
                    <small id="error-apellidos" class="form-text text-danger"></small>
                    @error('apellidos')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group col-md-4">
                    <label for="correo"><strong>Ingrese Correo:</strong></label>
                    <input type="email" id="correo" name="correo" class="form-control input"
                        placeholder="Ingrese el Correo Electrónico" value="{{ old('correo', session('docente') ? session('docente')->correo : '') }}" required>
                    <small id="correoError" class="form-text text-danger" style="display: none;"></small>
                    @error('correo')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>

            </div>
            <div class="form-row">

                <div class="form-group col-md-4">
                    <label for="cedula"><strong>Ingrese la Cédula:</strong></label>
                    <input type="text" id="cedula" name="cedula" class="form-control input"
                        placeholder="Ingrese Cédula (10 dígitos)" pattern="\d{10}"
                        title="Debe ingresar exactamente 10 números" value="{{ old('cedula', session('docente') ? session('docente')->cedula : '') }}" required>
                    <small id="cedulaError" class="form-text text-danger" style="display: none;"></small>
                    @error('cedula')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group col-md-4">
                    <label for="espe_id"><strong>Ingrese el la ID de la ESPE:</strong></label>
                    <input type="text" id="espe_id" name="espe_id" class="form-control input"
                        placeholder="Ingrese la ID de la ESPE" value="{{ old('espe_id', session('docente') ? session('docente')->espeId : '') }}" required>
                    <small id="espeIdError" class="form-text text-danger" style="display: none;"></small>
                    @error('espe_id')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group col-md-4">
                    <label for="departamento"><strong>Seleccione el departamento al que pertenece:</strong></label>
                    <select id="departamento" name="departamento" class="form-control input_select input" required>
                        <option value="Ciencias de la Computación" {{ (session('docente') && session('docente')->departamento == 'Ciencias de la Computación') ? 'selected' : '' }}>Ciencias de la Computación</option>
                        <option value="Ciencias de la Vida y Agricultura" {{ (session('docente') && session('docente')->departamento == 'Ciencias de la Vida y Agricultura') ? 'selected' : '' }}>Ciencias de la Vida y Agricultura</option>
                        <option value="Ciencias Exactas" {{ (session('docente') && session('docente')->departamento == 'Ciencias Exactas') ? 'selected' : '' }}>Ciencias Exactas</option>
                    </select>
                </div>
            </div>
            <div class="button-container">
                <button type="submit" class="button1 efects_button">Guardar Datos</button>
            </div>
        </form>
    </div>
</div>


 <script src="{{ asset('js/validaciones/createDocentes.js') }}"></script>

@endsection
