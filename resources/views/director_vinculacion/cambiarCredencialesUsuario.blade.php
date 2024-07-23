@extends('layouts.directorVinculacion')

@section('title', 'Configuracion de Usuario')

@section('title_component', 'Credenciales de Usuario')

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
<section class="content_profile">

    <div class="section1">
        <!-- Informacion estatica -->
        <div class="content_static">

            <div>
        <span class="title_edit_profile"><b>Información personal</b>
        </span>
                <hr>
            </div>

            <div class="elements_static">

                <div class="icon_block">
                    <i class="fa-brands fa-expeditedssl"></i>
                </div>

                <div>
                    <label>ID Espe</label>
                    <span>{{ $usuario->profesorUniversidad->espeId }}</span>
                </div>

                <div >
                    <label for= "nombre">Usuario</label>
                    <span>{{ $usuario->nombreUsuario }}</span>

                </div>

                <div>
                    <label>Cédula</label>
                    <span>{{ $usuario->profesorUniversidad->cedula }}</span>
                </div>

                <div>
                    <label>Teléfono</label>
                    <span>{{ $usuario->profesorUniversidad->celular }}</span>
                </div>

                <div class="last-element">
                    <label>Correo institucional</label>
                    <span>{{ $usuario->profesorUniversidad->correo }}</span>
                </div>

            </div>
        </div>

        <!-- Cambiar contraseña -->
        <div class="content_change_pass">
            <div>
        <span class="title_edit_profile"><b>Cambiar contraseña</b>

            <!-- Informacion sobre los datos -->
          <div class="info-icon">
            <i class="fa-regular fa-circle-info"></i>
          </div>
        </span>
                <hr>
            </div>

            <form class="form_change_passwd">

                <div>
                    <label for="firstname_student">Nueva contraseña <span class="requerido">*</span></label>
                    <input type="text" id="firstname_student" class="input" placeholder="Ingrese sus nombres">
                </div>

                <div>
                    <label for="firstname_student">Confirmar contraseña <span class="requerido">*</span></label>
                    <input type="text" id="firstname_student" class="input" placeholder="Ingrese sus nombres">
                </div>

                <div class="content_button">
                    <button class="button1 efects_button">Actualizar</button>
                </div>
            </form>
        </div>


    </div>


    <div>
        <!-- Informacion de perfil -->
        <div class="content_info">
            <div>
        <span class="title_edit_profile"><b>Actualizar datos personales</b>

            <!-- Informacion sobre los datos -->
          <div class="info-icon">
            <i class="fa-regular fa-circle-info"></i>
          </div>
        </span>
                <hr>
            </div>

            <form class="form_profile">
                <div>
                    <label for="firstname_student">Nombres <span class="requerido">*</span></label>
                    <input type="text" id="firstname_student" class="input" placeholder="Ingrese sus nombres">
                </div>

                <div>
                    <label for="lastname_student">Apellidos <span class="requerido">*</span></label>
                    <input type="text" id="lastname_student" class="input" placeholder="Ingrese sus apellidos">
                </div>

                <div>
                    <label for="cohorte_student">Cohorte <span class="requerido">*</span></label>
                    <input type="text" id="cohorte_student" class="input" placeholder="Ingrese su cohorte">
                </div>

                <div>
                    <label for="period_student">Período <span class="requerido">*</span></label>
                    <select name="period_student" id="period_student" class="input input_select">
                        <option value="0">Seleccione su período</option>
                    </select>
                </div>

                <div>
                    <label for="race_student">Carrera <span class="requerido">*</span></label>
                    <select name="race_student" id="race_student" class="input input_select">
                        <option value="0">Seleccione su carrera</option>
                    </select>
                </div>

                <div>
                    <label for="departament_student">Departamento <span class="requerido">*</span></label>
                    <select name="departament_student" id="departament_student" class="input input_select">
                        <option value="0">Seleccione su departamento</option>
                    </select>
                </div>

                <div>
                    <label for="locality_student">Localidad <span class="requerido">*</span></label>
                    <select name="locality_student" id="locality_student" class="input input_select">
                        <option value="0">Seleccione su localidad</option>
                    </select>
                </div>

                <div class="content_button">
                    <button class="button1 efects_button">Actualizar</button>
                </div>

            </form>
        </div>
    </div>

    <!-- Historial de sesiones -->
    <table>
        <thead>
            <tr>
                <th>Dispositivo</th>
                <th>IP</th>
                <th>Hora ingreso</th>
                <th>Hora salida</th>
                <th>Ubicación</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($userSessions as $session)
            <tr>
                <td>{{ $session->user_agent }}</td>
                <td>{{ $session->ip_address }}</td>
                <td>{{ $session->start_time }}</td>
                <td>{{ $session->end_time }}</td>
                <td>{{ $session->locality }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

</section>
<!--
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

-->
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
