@extends('layouts.admin')
@section('title', 'Editar Empresa')
@section('title_component', 'Panel Editar Empresa')
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

<br>
<div class="container">
        <section class="contenedor_agregar_periodo">
            <h4><b>Actualizar datos de la empresa</b></h4>
            <hr>
        <form action="{{ route('admin.actualizarEmpresa', ['id' => $empresa->id]) }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <form action="{{ route('admin.actualizarEmpresa', ['id' => $empresa->id]) }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="container">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nombreEmpresa">Nombre de la Empresa:</label>
                                <input type="text" class="form-control input" id="nombreEmpresa" name="nombreEmpresa"
                                    required value="{{ $empresa->nombreEmpresa }}">
                                <span id="error-message" style="color: red;"></span>

                            </div>
                            <!-- Inicio de la fila para RUC y Teléfono -->
    <div class="row">
        <!-- Columna para RUC de la Empresa -->
        <div class="col-md-6">
            <div class="form-group">
                <label for="rucEmpresa">RUC de la Empresa:</label>
                <input type="text" class="form-control input" id="rucEmpresa" name="rucEmpresa" required
                    value="{{ $empresa->rucEmpresa }}">
                <span id="error-message-rucEmpresa" style="color: red;"></span>
            </div>
        </div>
        <!-- Columna para Teléfono del contacto de la Empresa -->
        <div class="col-md-6">
            <div class="form-group">
                <label for="telefonoContacto">Teléfono del contacto de la Empresa:</label>
                <input type="text" class="form-control input" id="telefonoContacto"
                    name="telefonoContacto" required value="{{ $empresa->telefonoContacto }}">
                <span id="error-message-telefono" style="color: red; display: none;">Número de teléfono no
                    válido</span>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
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
</div>

        <div class="col-md-6">
                            <div class="form-group">
                                <label for="ciudad">Ciudad:</label>
                                <input type="text" class="form-control input" id="ciudad" name="ciudad" required
                                    value="{{ $empresa->ciudad }}">
                                <span id="error-message-ciudad" style="color: red;"></span>

                            </div>
</div>
</div>
                            <div class="form-group">
                                <label for="direccion">Dirección:</label>
                                <input type="text" class="form-control input" id="direccion" name="direccion" required
                                    value="{{ $empresa->direccion }}">
                                <span id="error-message-direccion" style="color: red;"></span>

                            </div>
                            <div class="row">
                                <div class="col-md-6">
                            <div class="form-group">
                                <label for="nombreContacto">Nombre del contacto de la Empresa:</label>
                                <input type="text" class="form-control input" id="nombreContacto" name="nombreContacto"
                                    required value="{{ $empresa->nombreContacto }}">
                                <span id="error-message-nombreContacto" style="color: red;"></span>

                            </div>
                            </div>
                            <div class="col-md-6">
                            <div class="form-group">
                                <label for="correo">Correo de contacto de la Empresa:</label>
                                <input type="email" class="form-control input" id="correo" name="correo" required
                                    value="{{ $empresa->correo }}">
                            </div>
                      
</div>
</div>

                        
                            
                            </div>
                            
                            <div class="col-md-6">
                            <div class="form-group">
                                <label for="actividadesMacro">Actividades Macro requeridas:</label>
                                <textarea class="form-control input textarea" id="actividadesMacro" name="actividadesMacro" rows="4" required>
                                    {{ $empresa->actividadesMacro }}
                                </textarea>
                                <span id="error-message-actividadesMacro" style="color: red;"></span>

                            </div>
<br>
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

        </form>
    </div>
    </div>
    <link rel="stylesheet" href="https://cdn.ckeditor.com/4.16.1/standard/ckeditor.css">
    <script src="https://cdn.ckeditor.com/4.16.1/standard/ckeditor.js"></script>
    <script src="{{ asset('js/plantilla/main.js') }}" type="module"></script>
    <script src="{{ asset('js/admin/acciones.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.13.0/jquery-ui.min.js"></script>
    <script src="{{ asset('js/admin/editarEmpresa.js') }}"></script>
@endsection
