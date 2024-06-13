@extends('layouts.admin')

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
        <table id="credenciales" class="mat-mdc-table">
            <thead>
            <tr>
                <th>Hora de Inicio</th>
                <th>Hora de salida</th>
                <th>Dirección IP</th>
                <th>Agente de Usuario</th>
                <th>Ubicación</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($userSessions as $session)
            <tr>
                <td style="text-align: center;">{{ $session->start_time }}</td>
                <td style="text-align: center;">{{ $session->end_time }}</td>
                <td style="text-align: center;">{{ $session->ip_address }}</td>
                <td style="text-align: center;">{{ $session->browser }}</td>
                <td style="text-align: justify;">{{ $session->locality }}</td>
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <div class="paginator-container">
        <nav aria-label="Paginación">
            <ul class="pagination">
                <li class="page-item mx-3">
                    <form method="GET" action="{{ route('admin.cambio-credenciales') }}#credenciales">
                        <select class="form-control page-item" name="perPage" id="perPage" onchange="this.form.submit()">
                            <option value="10" @if ($perPage == 10) selected @endif>10</option>
                            <option value="20" @if ($perPage == 20) selected @endif>20</option>
                            <option value="50" @if ($perPage == 50) selected @endif>50</option>
                            <option value="100" @if ($perPage == 100) selected @endif>100</option>
                        </select>
                    </form>
                </li>

                @if ($userSessions->onFirstPage())
                <li class="page-item disabled">
                    <span class="page-link">Anterior</span>
                </li>
                @else
                <li class="page-item">
                    <a class="page-link" href="{{ $userSessions->previousPageUrl() }}#credenciales" aria-label="Anterior">Anterior</a>
                </li>
                @endif

                @foreach ($userSessions as $page => $session)
                <li class="page-item {{ $userSessions->currentPage() == $page + 1 ? 'active' : '' }}">
                    <a class="page-link" href="{{ $userSessions->url($page + 1) }}#credenciales">{{ $page + 1 }}</a>
                </li>
                @endforeach

                @if ($userSessions->hasMorePages())
                <li class="page-item">
                    <a class="page-link" href="{{ $userSessions->nextPageUrl() }}#credenciales" aria-label="Siguiente">Siguiente</a>
                </li>
                @else
                <li class="page-item disabled">
                    <span class="page-link">Siguiente</span>
                </li>
                @endif
            </ul>
        </nav>
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
