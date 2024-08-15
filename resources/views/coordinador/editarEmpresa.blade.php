@extends('layouts.coordinador')
@section('title', 'Panel Empresa')
@section('title_component', 'Panel Editar Empresa')
@section('content')
<section class="contenedor_agregar_periodo">


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



        <div class="container">
        <form action="{{ route('coordinador.actualizarEmpresa', ['id' => $empresa->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="container">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nombreEmpresa">Nombre de la Empresa:</label>
                                <input type="text" class="form-control input" id="nombreEmpresa" name="nombreEmpresa"
                                    required value="{{ $empresa->nombreEmpresa }}">
                                <small id="error-message" style="color: red;"></small>

                            </div>
                            <!-- Inicio de la fila para RUC y Teléfono -->
    <div class="row">
        <!-- Columna para RUC de la Empresa -->
        <div class="col-md-6">
            <div class="form-group">
                <label for="rucEmpresa">RUC de la Empresa:</label>
                <input type="text" class="form-control input" id="rucEmpresa" name="rucEmpresa" required
                    value="{{ $empresa->rucEmpresa }}">
                <small id="error-message-rucEmpresa" style="color: red;"></small>
            </div>
        </div>
        <!-- Columna para Teléfono del contacto de la Empresa -->
        <div class="col-md-6">
            <div class="form-group">
                <label for="telefonoContacto">Teléfono del contacto de la Empresa:</label>
                <input type="text" class="form-control input" id="telefonoContacto"
                    name="telefonoContacto" required value="{{ $empresa->telefonoContacto }}">
                <small id="error-message-telefono" style="color: red; display: none;">Número de teléfono no
                    válido</small>
            </div>
        </div>
    </div>
                            <div class="form-group">
                                <label for="provincia">Provincia:</label>
                                <select class="form-control input" id="provincia" name="provincia" required>
                                    <option value="" disabled>Selecciona una provincia</option>
                                    <option value="Azuay" {{ $empresa->provincia == 'Azuay' ? 'selected' : '' }}>Azuay</option>
                                    <option value="Bolívar" {{ $empresa->provincia == 'Bolívar' ? 'selected' : '' }}>Bolívar</option>
                                    <option value="Cañar" {{ $empresa->provincia == 'Cañar' ? 'selected' : '' }}>Cañar</option>
                                    <option value="Carchi" {{ $empresa->provincia == 'Carchi' ? 'selected' : '' }}>Carchi</option>
                                    <option value="Chimborazo" {{ $empresa->provincia == 'Chimborazo' ? 'selected' : '' }}>Chimborazo</option>
                                    <option value="Cotopaxi" {{ $empresa->provincia == 'Cotopaxi' ? 'selected' : '' }}>Cotopaxi</option>
                                    <option value="El Oro" {{ $empresa->provincia == 'El Oro' ? 'selected' : '' }}>El Oro</option>
                                    <option value="Esmeraldas" {{ $empresa->provincia == 'Esmeraldas' ? 'selected' : '' }}>Esmeraldas</option>
                                    <option value="Galápagos" {{ $empresa->provincia == 'Galápagos' ? 'selected' : '' }}>Galápagos</option>
                                    <option value="Guayas" {{ $empresa->provincia == 'Guayas' ? 'selected' : '' }}>Guayas</option>
                                    <option value="Imbabura" {{ $empresa->provincia == 'Imbabura' ? 'selected' : '' }}>Imbabura</option>
                                    <option value="Loja" {{ $empresa->provincia == 'Loja' ? 'selected' : '' }}>Loja</option>
                                    <option value="Los Ríos" {{ $empresa->provincia == 'Los Ríos' ? 'selected' : '' }}>Los Ríos</option>
                                    <option value="Manabí" {{ $empresa->provincia == 'Manabí' ? 'selected' : '' }}>Manabí</option>
                                    <option value="Morona Santiago" {{ $empresa->provincia == 'Morona Santiago' ? 'selected' : '' }}>Morona Santiago</option>
                                    <option value="Napo" {{ $empresa->provincia == 'Napo' ? 'selected' : '' }}>Napo</option>
                                    <option value="Orellana" {{ $empresa->provincia == 'Orellana' ? 'selected' : '' }}>Orellana</option>
                                    <option value="Pastaza" {{ $empresa->provincia == 'Pastaza' ? 'selected' : '' }}>Pastaza</option>
                                    <option value="Pichincha" {{ $empresa->provincia == 'Pichincha' ? 'selected' : '' }}>Pichincha</option>
                                    <option value="Santa Elena" {{ $empresa->provincia == 'Santa Elena' ? 'selected' : '' }}>Santa Elena</option>
                                    <option value="Santo Domingo de los Tsáchilas" {{ $empresa->provincia == 'Santo Domingo de los Tsáchilas' ? 'selected' : '' }}>Santo Domingo de los Tsáchilas</option>
                                    <option value="Sucumbíos" {{ $empresa->provincia == 'Sucumbíos' ? 'selected' : '' }}>Sucumbíos</option>
                                    <option value="Tungurahua" {{ $empresa->provincia == 'Tungurahua' ? 'selected' : '' }}>Tungurahua</option>
                                    <option value="Zamora Chinchipe" {{ $empresa->provincia == 'Zamora Chinchipe' ? 'selected' : '' }}>Zamora Chinchipe</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="ciudad">Ciudad:</label>
                                <input type="text" class="form-control input" id="ciudad" name="ciudad" required
                                    value="{{ $empresa->ciudad }}">
                                <small id="error-message-ciudad" style="color: red;"></small>

                            </div>

                            <div class="form-group">
                                <label for="direccion">Dirección:</label>
                                <input type="text" class="form-control input" id="direccion" name="direccion" required
                                    value="{{ $empresa->direccion }}">
                                <small id="error-message-direccion" style="color: red;"></small>

                            </div>

                            <div class="form-group">
                                <label for="correo">Correo de contacto de la Empresa:</label>
                                <input type="email" class="form-control input" id="correo" name="correo" required
                                    value="{{ $empresa->correo }}">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nombreContacto">Nombre del contacto de la Empresa:</label>
                                <input type="text" class="form-control input" id="nombreContacto" name="nombreContacto"
                                    required value="{{ $empresa->nombreContacto }}">
                                <small id="error-message-nombreContacto" style="color: red;"></small>

                            </div>

                            

                            <div class="form-group">
                                <label for="actividadesMacro">Actividades Macro requeridas:</label>
                                <textarea class="form-control input" id="actividadesMacro" name="actividadesMacro" rows="4" required>
                                    {{ $empresa->actividadesMacro }}
                                </textarea>
                                <small id="error-message-actividadesMacro" style="color: red;"></small>

                            </div>

                            <div class="form-group">
                                <label for="cuposDisponibles">Cupos Disponibles:</label>
                                <input type="text" class="form-control input" id="cuposDisponibles"
                                    name="cuposDisponibles" required value="{{ $empresa->cuposDisponibles }}">
                            </div>

                            <div class="form-group">
                                <label for="cartaCompromiso">Carta Compromiso (PDF):</label>
                                <div class="input input_file">
                                    <span id="fileText" class="fileText"><i
                                            class="fa-solid fa-arrow-up-from-bracket"></i>
                                        Haz clic aquí para subir el documento</span>
                                    <input type="file" class="form-control-file input input_file" id="cartaCompromiso"
                                        name="cartaCompromiso" onchange="displayFileName(this)">
                                    <span title="Eliminar archivo" onclick="removeFile(this)"
                                        class="remove-icon">✖</span>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="convenio">Convenio (PDF):</label>
                                <div class="input input_file">
                                    <span id="fileText" class="fileText"><i
                                            class="fa-solid fa-arrow-up-from-bracket"></i> Haz clic aquí para subir el
                                        documento</span>
                                    <input type="file" class="form-control-file input input_file" id="convenio"
                                        name="convenio" onchange="displayFileName(this)">
                                    <span title="Eliminar archivo" onclick="removeFile(this)"
                                        class="remove-icon">✖</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
             <center>  <button type="submit" class="button1 efects_button">Actualizar Empresa</button> </center>
            </form>
    </div>
</div>
<script src="{{ asset('js/admin/editarEmpresa.js') }}"></script>


@endsection

