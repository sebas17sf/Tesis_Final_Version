@extends('layouts.app')

@section('title', 'Configuracion de Usuario')

@section('title_component', 'Configuracion de Usuario')

@section('content')

@if (session('success'))
<div class="contenedor_alerta success">
    <div class="icon_alert"><i class="fa-regular fa-check"></i></div>
    <div class="content_alert">
        <div class="title">Éxito!</div>
        <div class="body">{{ session('success') }}</div>
    </div>
    <div class="icon_remove">
        <button class="button4 btn_3_2"><i class="fa-regular fa-xmark"></i></button>
    </div>
</div>

<script>
    document.querySelector('.contenedor_alerta .icon_remove button').addEventListener('click', function() {
        this.closest('.contenedor_alerta').style.display = 'none';
    });
</script>
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


    <form action="{{ route('admin.updateCredenciales') }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="nombre">Usuario</label>
            <input type="text" class="form-control input" id="nombre" name="nombre" value="{{ $usuario->nombreUsuario }}"
                required>
        </div>
        <div class="form-group">
            <label for="email">Correo Electrónico</label>
            <input type="email" class="form-control input" id="email" name="email"
                value="{{ $usuario->correoElectronico }}" required>
        </div>
        <div class="form-group">
            <label for="password">Nueva Contraseña</label>
            <div class="input-group">
                <input type="password" class="form-control input" id="password" name="password" required>
                <div class="input-group-append">
                    <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                        <i class="fa fa-eye" aria-hidden="true"></i>
                    </button>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label for="password_confirmation">Confirmar Nueva Contraseña</label>
            <div class="input-group">
                <input type="password" class="form-control input" id="password_confirmation" name="password_confirmation"
                    required>
                <div class="input-group-append">
                    <button class="btn btn-outline-secondary" type="button" id="toggleConfirmPassword">
                        <i class="fa fa-eye" aria-hidden="true"></i>
                    </button>
                </div>
            </div>
        </div>
        <button type="submit" class="button">Guardar Cambios</button>
    </form>

    <hr>
    <span><b>Sessiones iniciadas del usuario</b></span>
    <br>

    <div class="contenedor_tabla">
        <div class="table-container mat-elevation-z8">

            <table class="mat-mdc-table">
                <thead class="ng-star-inserted">
                    <tr class="mat-mdc-header-row mdc-data-table__header-row cdk-header-row ng-star-inserted">

                        <th>Hora de Inicio</th>
                        <th>Dirección IP</th>
                        <th>Agente de Usuario</th>
                        <th>Ubicacion</th>
                    </tr>
                </thead>
                <tbody class="mdc-data-table__content ng-star-inserted">
                    @foreach ($userSessions as $session)
                        <tr>
                            <td>{{ $session->start_time }}</td>
                            <td>{{ $session->ip_address }}</td>
                            <td>{{ $session->browser }}</td>
                            <td>{{ $session->locality }}</td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>



    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#togglePassword').click(function() {
                var passwordField = $('#password');
                passwordField.attr('type', passwordField.attr('type') === 'password' ? 'text' : 'password');
            });

            $('#toggleConfirmPassword').click(function() {
                var confirmPasswordField = $('#password_confirmation');
                confirmPasswordField.attr('type', confirmPasswordField.attr('type') === 'password' ?
                    'text' : 'password');
            });
        });
    </script>








@endsection
