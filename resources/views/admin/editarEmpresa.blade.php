@extends('layouts.admin')

@section('content')
    <div class="container">


        @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif


        <h3>Editar Empresa</h3>
        <form action="{{ route('admin.actualizarEmpresa', ['id' => $empresa->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            {{-- <div class="table-responsive-sm">
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <td><label for="nombreEmpresa">Nombre de la Empresa:</label></td>
                            <td>
                                <input type="text" class="form-control" id="nombreEmpresa" name="nombreEmpresa" required
                                    value="{{ $empresa->nombreEmpresa }}">
                            </td>
                        </tr>

                        <tr>
                            <td><label for="rucEmpresa">RUC de la Empresa:</label></td>
                            <td>
                                <input type="text"  class="form-control" id="rucEmpresa" name="rucEmpresa" required
                                    value="{{ $empresa->rucEmpresa }}">
                            </td>
                        </tr>

                        <tr>
                            <td><label for="provincia">Provincia:</label></td>
                            <td>
                                <select class="form-control" id="provincia" name="provincia" required>
                                    <option value="" disabled selected>Selecciona una provincia</option>
                                    <option value="Azuay" @if ($empresa->provincia == 'Azuay') selected @endif>Azuay</option>
                                    <option value="Bolívar" @if ($empresa->provincia == 'Bolívar') selected @endif>Bolívar</option>
                                    <!-- Otras opciones -->
                                </select>
                            </td>
                        </tr>

                        <tr>
                            <td><label for="ciudad">Ciudad:</label></td>
                            <td>
                                <input type="text" class="form-control" id="ciudad" name="ciudad" required
                                    value="{{ $empresa->ciudad }}">
                            </td>
                        </tr>

                        <tr>
                            <td><label for="direccion">Dirección:</label></td>
                            <td>
                                <input type="text" class="form-control" id="direccion" name="direccion" required
                                    value="{{ $empresa->direccion }}">
                            </td>
                        </tr>

                        <tr>
                            <td><label for="correo">Correo de contacto de la Empresa:</label></td>
                            <td>
                                <input type="email" class="form-control" id="correo" name="correo" required
                                    value="{{ $empresa->correo }}">
                            </td>
                        </tr>

                        <tr>
                            <td><label for="nombreContacto">Nombre del contacto de la Empresa:</label></td>
                            <td>
                                <input type="text" class="form-control" id="nombreContacto" name="nombreContacto" required
                                    value="{{ $empresa->nombreContacto }}">
                            </td>
                        </tr>

                        <tr>
                            <td><label for="telefonoContacto">Teléfono del contacto de la Empresa:</label></td>
                            <td>
                                <input type="text" class="form-control" id="telefonoContacto" name="telefonoContacto" required
                                    value="{{ $empresa->telefonoContacto }}">
                            </td>
                        </tr>

                        <tr>
                            <td><label for="actividadesMacro">Actividades Macro requeridas:</label></td>
                            <td>
                                <textarea class="form-control" id="actividadesMacro" name="actividadesMacro" rows="4" required>
                                    {{ $empresa->actividadesMacro }}
                                </textarea>
                            </td>
                        </tr>

                        <tr>
                            <td><label for="cuposDisponibles">Cupos Disponibles:</label></td>
                            <td>
                                <input type="text" class="form-control" id="cuposDisponibles" name="cuposDisponibles" required
                                    value="{{ $empresa->cuposDisponibles }}">
                            </td>
                        </tr>

                        <tr>
                            <td><label for="cartaCompromiso">Carta Compromiso (PDF):</label></td>
                            <td>
                                @if ($empresa->cartaCompromiso)
                                    <a href="{{ route('admin.descargar', ['tipo' => 'carta', 'id' => $empresa->id]) }}">
                                        <i class="material-icons">cloud_download</i> Descargar
                                    </a>
                                @else
                                    <span class="text-muted">No disponible</span>
                                @endif
                            


                                <div class="form-group">
                                    <label for="cartaCompromiso">Carta Compromiso (PDF):</label>
                                    <div class="input input_file">
                                        <span id="fileText" class="fileText"><i class="fa-solid fa-arrow-up-from-bracket"></i> Haz clic aquí para subir el documento</span>
                                        <input type="file" class="form-control-file input input_file"  id="cartaCompromiso"
                                            name="cartaCompromiso" onchange="displayFileName(this)">
                                        <span title="Eliminar archivo" onclick="removeFile(this)" class="remove-icon">✖</span>
                                    </div>
                                </div>


                            </td>
                        </tr>

                        <tr>
                            <td><label for="convenio">Convenio (PDF):</label></td>
                            <td>
                                @if ($empresa->convenio)
                                    <a href="{{ route('admin.descargar', ['tipo' => 'convenio', 'id' => $empresa->id]) }}">
                                        <i class="material-icons">cloud_download</i> Descargar
                                    </a>
                                @else
                                    <span class="text-muted">No disponible</span>
                                @endif
                           
                               <div class="form-group">
                                <label for="convenio">Convenio (PDF):</label>
                                <div class="input input_file">
                                    <span id="fileText" class="fileText"><i class="fa-solid fa-arrow-up-from-bracket"></i> Haz clic aquí
                                        para
                                        subirel documento</span>
                                    <input type="file" class="form-control-file input input_file" id="convenio"
                                        name="convenio" onchange="displayFileName(this)">
                                    <span title="Eliminar archivo" onclick="removeFile(this)" class="remove-icon">✖</span>
                                </div>
                            </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <button type="submit" class="btn btn-secondary">Actualizar Empresa</button> --}}

            <form action="{{ route('admin.actualizarEmpresa', ['id' => $empresa->id]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="container">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nombreEmpresa">Nombre de la Empresa:</label>
                                <input type="text" class="form-control input" id="nombreEmpresa" name="nombreEmpresa" required
                                    value="{{ $empresa->nombreEmpresa }}">
                            </div>
            
                            <div class="form-group">
                                <label for="rucEmpresa">RUC de la Empresa:</label>
                                <input type="text" class="form-control input" id="rucEmpresa" name="rucEmpresa" required
                                    value="{{ $empresa->rucEmpresa }}">
                            </div>
            
                            <div class="form-group">
                                <label for="provincia">Provincia:</label>
                                <select class="form-control input" id="provincia" name="provincia" required>
                                    <option value="" disabled selected>Selecciona una provincia</option>
                                    <option value="Azuay" @if ($empresa->provincia == 'Azuay') selected @endif>Azuay</option>
                                    <option value="Bolívar" @if ($empresa->provincia == 'Bolívar') selected @endif>Bolívar</option>
                                    <!-- Otras opciones -->
                                </select>
                            </div>
            
                            <div class="form-group">
                                <label for="ciudad">Ciudad:</label>
                                <input type="text" class="form-control input" id="ciudad" name="ciudad" required
                                    value="{{ $empresa->ciudad }}">
                            </div>
            
                            <div class="form-group">
                                <label for="direccion">Dirección:</label>
                                <input type="text" class="form-control input" id="direccion" name="direccion" required
                                    value="{{ $empresa->direccion }}">
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
                                <input type="text" class="form-control input" id="nombreContacto" name="nombreContacto" required
                                    value="{{ $empresa->nombreContacto }}">
                            </div>
            
                            <div class="form-group">
                                <label for="telefonoContacto">Teléfono del contacto de la Empresa:</label>
                                <input type="text" class="form-control input" id="telefonoContacto" name="telefonoContacto" required
                                    value="{{ $empresa->telefonoContacto }}">
                            </div>
            
                            <div class="form-group">
                                <label for="actividadesMacro">Actividades Macro requeridas:</label>
                                <textarea class="form-control input" id="actividadesMacro" name="actividadesMacro" rows="4" required>
                                    {{ $empresa->actividadesMacro }}
                                </textarea>
                            </div>
            
                            <div class="form-group">
                                <label for="cuposDisponibles">Cupos Disponibles:</label>
                                <input type="text" class="form-control input" id="cuposDisponibles" name="cuposDisponibles" required
                                    value="{{ $empresa->cuposDisponibles }}">
                            </div>
            
                            <div class="form-group">
                                <label for="cartaCompromiso">Carta Compromiso (PDF):</label>
                                <div class="input input_file">
                                    <span id="fileText" class="fileText"><i class="fa-solid fa-arrow-up-from-bracket"></i> Haz clic aquí para subir el documento</span>
                                    <input type="file" class="form-control-file input input_file"  id="cartaCompromiso"
                                        name="cartaCompromiso" onchange="displayFileName(this)">
                                    <span title="Eliminar archivo" onclick="removeFile(this)" class="remove-icon">✖</span>
                                </div>
                            </div>
            
                            <div class="form-group">
                                <label for="convenio">Convenio (PDF):</label>
                                <div class="input input_file">
                                    <span id="fileText" class="fileText"><i class="fa-solid fa-arrow-up-from-bracket"></i> Haz clic aquí para subir el documento</span>
                                    <input type="file" class="form-control-file input input_file" id="convenio"
                                        name="convenio" onchange="displayFileName(this)">
                                    <span title="Eliminar archivo" onclick="removeFile(this)" class="remove-icon">✖</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <button type="submit" class="button efects_button">Actualizar Empresa</button>
            </form>
            
        </form>
    </div>
</div>
@endsection

<style>
    /* Estilos CSS */
</style>
