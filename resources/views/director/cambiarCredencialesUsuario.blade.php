@extends('layouts.director')

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

  <style>


    .icon_block {
      color: #40456c; /* Color del icono */
      font-size: 15px; /* Tamaño del icono */
      display: flex; /* Alineación del icono */
      align-items: center; /* Centrado vertical del icono */
      left: 45% !important;
    }



    center {
      display: flex; /* Alineación de elementos en fila */
      justify-content: center; /* Centrado horizontal */
      width: 100%; /* Ancho completo */
    }
  </style>

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
            <label></label>
            <span></span>
          </div>
          <div style="text-align: center;">
            <label for="nombre">Usuario</label>
            <span id="nombre" name="nombre" required>{{ $usuario->nombreUsuario }}</span>
          </div>

          <div style="text-align: center;">
            <label for="correo">Correo</label>
            <span id="nombre" name="correo" required>{{ $usuario->correoElectronico }}</span>
          </div>
          <div>
            <label></label>
            <span></span>
          </div>
          <div>
            <label></label>
            <span></span>
          </div>
         
          <div style="text-align: center;">
            <label for="nombre"></label>
            <span></span>
          </div>
        
          <div>
            <label></label>
            <span></span>
        </div>
        <div>
          <label></label>
          <span></span>
          </div>
      </div>
  </div>

   


  </div>
   <!-- Cambiar contraseña -->
   <div class="content_change_pass">
      <div>
        <span class="title_edit_profile"><b>Cambiar contraseña</b>

         
        </span>
        <hr>
      </div>

      <form class="form_change_passwd">

        <div>
          <label for="firstname_student">Nueva contraseña <span class="requerido">*</span></label>
          <input type="text" id="firstname_student" class="input" placeholder="Ingrese la contraseña">
        </div>

        <div>
          <label for="firstname_student">Confirmar contraseña <span class="requerido">*</span></label>
          <input type="text" id="firstname_student" class="input" placeholder="Ingrese de nuevo la contraseña">
        </div>

        <div class="content_button">
          <button class="button1 efects_button">Actualizar</button>
        </div>
      </form>
    </div>
  
<br>
  <div>
  </section>
  
  <div class="sesion_history">
            <div>
        <span class="title_edit_profile"><b>Control de sesiones</b>
        </span>
                <hr>
            </div>
<!-- Historial de sesiones -->
<div class="contenedor_tabla">
            <div class="table-container mat-elevation-z8">
                <div id="tablaProyectos">
                    <table class="mat-mdc-table">
                        <thead class="ng-star-inserted">
                            <tr class="mat-mdc-header-row mdc-data-table__header-row cdk-header-row ng-star-inserted">
                                <th>DISPOSITIVO</th>
            <th>IP</th>
            <th>HORA DE INGRESO</th>
            <th>HORA DE SALIDA</th>
            <th>UBICACIÓN</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($userSessions as $session)
        <tr>
        <td style="text-transform: uppercase ; text-align:center" >{{ $session->user_agent }}</td>
                <td style="text-transform: uppercase ; text-align:center" >{{ $session->ip_address }}</td>
                <td style="text-transform: uppercase ; text-align:center" >{{ $session->start_time }}</td>
                <td style="text-transform: uppercase ; text-align:center" >{{ $session->end_time }}</td>
                <td>{{ $session->locality }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
</div>
</div>
</div>
</div>

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
