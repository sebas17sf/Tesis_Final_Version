@extends('layouts.app')

@section('content')
    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Éxito',
                text: '{{ session('success') }}',
                confirmButtonText: 'Ok'
            });
        </script>
    @endif

    @if (session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: '{{ session('error') }}',
                confirmButtonText: 'Ok'
            });
        </script>
    @endif

    <div class="container mt-5">
        <h4 class="text-center mb-4">Generar Documentos</h4>
        <div class="row">
            <div class="col-md-4">
                <div class="card mb-4">
                    <div class="card-body">
                        <h4 class="card-title">Generar Acta de Designación de Estudiantes</h4>
                        <form action="{{ route('generar-documento') }}" method="post">
                            @csrf
                            <button type="submit" class="btn btn-light btn-block">
                                <i class="fas fa-file-excel"></i> Generar
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card mb-4">
                    <div class="card-body">
                        <h4 class="card-title">Generar Carta de Compromiso de Estudiante</h4>
                        <form action="{{ route('generar-documento-cartaCompromiso') }}" method="post">
                            @csrf
                            <button type="submit" class="btn btn-light btn-block">
                                <i class="fas fa-file-excel"></i> Generar
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card mb-4">
                    <div class="card-body">
                        <h4 class="card-title">Generar Número de Horas de Estudiantes</h4>
                        <form action="{{ route('generar-documento-numeroHoras') }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-light btn-block">
                                <i class="fas fa-file-excel"></i> Generar
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <button id="toggleFormBtn" class="btn btn-light btn-block">Registrar actividad</button>

        <div id="registroActividades" style="display: none;">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">

                        <div class="card-body">
                            <h4 class="card-title">Registro de Actividades</h4>
                            <form action="{{ route('estudiantes.guardarActividad') }}" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="fecha"><strong>Fecha:</strong></label>
                                    <input type="date" id="fecha" name="fecha" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="actividades"><strong>Actividades a realizar:</strong></label>
                                    <textarea id="actividades" name="actividades" class="form-control" rows="4" required></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="horas"><strong>Número de horas:</strong></label>
                                    <input type="number" id="horas" name="horas" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="evidencias"><strong>Resultados de la actividad
                                            (evidencias):</strong></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="material-icons">cloud_upload</i>
                                            </span>
                                        </div>
                                        <input type="file" id="evidencias" name="evidencias"
                                            accept="image/jpeg, image/jpg, image/png" class="form-control-file" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="nombre_actividad"><strong>Asigne Nombre de la actividad:</strong></label>
                                    <input type="text" id="nombre_actividad" name="nombre_actividad" class="form-control"
                                        required>
                                </div>
                                <button type="submit" class="btn btn-light btn-block">Guardar Actividad</button>
                            </form>
                        </div>


                    </div>
                </div>
            </div>

            <div class="mt-4">
                <h4 class="text-center">Actividades Registradas</h4>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Fecha</th>
                            <th>Actividades</th>
                            <th>Número de Horas</th>
                            <th>Nombre de la Actividad</th>
                            <th>Evidencias</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($actividadesRegistradas as $actividad)
                            <tr>
                                <td>{{ $actividad->fecha }}</td>
                                <td>{{ $actividad->actividades }}</td>
                                <td>{{ $actividad->numero_horas }}</td>
                                <td>{{ $actividad->nombre_actividad }}</td>
                                <td><img src="data:image/png;base64,{{ $actividad->evidencias }}" alt="Evidencia"
                                        width="100" height="100"></td>
                                <td>
                                    <form action="{{ route('eliminarActividad', $actividad->ID_Actividades) }}"
                                        method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Eliminar</button>
                                    </form>

                                    <button type="button" class="btn btn-primary" data-toggle="modal"
                                        data-target="#editModal{{ $actividad->ID_Actividades }}">
                                        Editar
                                    </button>

                                    <!-- Modal para editar la actividad -->
                                    <div class="modal fade" id="editModal{{ $actividad->ID_Actividades }}" tabindex="-1"
                                        role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="editModalLabel">Editar Actividad</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form
                                                    action="{{ route('updateActividad', ['id' => $actividad->ID_Actividades]) }}"
                                                    enctype="multipart/form-data" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label for="fecha">Fecha</label>
                                                            <input type="date" class="form-control" id="fecha"
                                                                name="fecha" value="{{ $actividad->fecha }}">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="actividades">Actividades</label>
                                                            <textarea class="form-control" id="actividades" name="actividades">{{ $actividad->actividades }}</textarea>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="numero_horas">Número de Horas</label>
                                                            <input type="number" class="form-control" id="numero_horas"
                                                                name="numero_horas"
                                                                value="{{ $actividad->numero_horas }}">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="evidencias">Evidencias</label>
                                                            <input type="file" id="evidencias" name="evidencias"
                                                                accept="image/jpeg, image/jpg, image/png"
                                                                class="form-control-file" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="nombre_actividad">Nombre de la Actividad</label>
                                                            <input type="text" class="form-control"
                                                                id="nombre_actividad" name="nombre_actividad"
                                                                value="{{ $actividad->nombre_actividad }}">
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">Cerrar</button>
                                                        <button type="submit" class="btn btn-primary">Guardar
                                                            cambios</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Fin del modal -->


                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>


        <br>
        <button id="toggleFormBtn2" class="btn btn-light btn-block">Crear Informe</button>
        <div id="registroInforme" style="display: none;">
            <form action="{{ route('estudiantes.generarInforme') }}" method="post">
                @csrf
                <div class="form-group">
                    <label for="nombreComunidad"><strong>Nombre de la Comunidad o Comunidades
                            Beneficiarias:</strong></label>
                    <input type="text" id="nombreComunidad" name="nombreComunidad" class="form-control" required>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-3">
                        <label for="provincia"><strong>Provincia:</strong></label>
                        <input type="text" id="provincia" name="provincia" class="form-control" required>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="canton"><strong>Canton:</strong></label>
                        <input type="text" id="canton" name="canton" class="form-control" required>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="parroquia"><strong>Parroquia:</strong></label>
                        <input type="text" id="parroquia" name="parroquia" class="form-control" required>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="direccion"><strong>Dirección:</strong></label>
                        <input type="text" id="direccion" name="direccion" class="form-control" required>
                    </div>
                </div>

                <div id="campos">
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="especificos"><strong>Objetivos Específicos:</strong></label>
                            <textarea name="especificos[]" class="form-control" rows="4" required></textarea>
                        </div>

                        <div class="form-group col-md-4">
                            <label for="alcanzados"><strong>Resultados alcanzados:</strong></label>
                            <textarea name="alcanzados[]" class="form-control" rows="4" required></textarea>
                        </div>

                        <div class="form-group col-md-4">
                            <label for="porcentaje"><strong>Porcentaje alcanzado:</strong></label>
                            <textarea name="porcentaje[]" class="form-control" rows="4" required></textarea>
                        </div>
                    </div>

                </div>
                <button type="button" class="btn btn-outline-secondary btn-sm" onclick="agregarCampo()"><i
                        class="material-icons">add</i></button>
                <button type="button" class="btn btn-outline-secondary btn-sm" onclick="eliminarCampo()"><i
                        class="material-icons">delete</i></button>

                <table>
                    <tr>
                        <td>
                            <label for="razones"><strong>Explicar las razones que justifican las actividades
                                    realizadas:</strong></label>
                        </td>
                        <td>
                            <textarea id="razones" name="razones" rows="10" cols="100"></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="conclusiones"><strong>Conclusiones:</strong></label>
                        </td>
                        <td>
                            <textarea id="conclusiones" name="conclusiones" rows="10" cols="100"></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="recomendaciones"><strong>Recomendaciones:</strong></label>
                        </td>
                        <td>
                            <textarea id="recomendaciones" name="recomendaciones" rows="10" cols="100"></textarea>
                        </td>
                    </tr>
                </table>





                <button type="submit" class="btn btn-light btn-block">Crear Informe</button>
            </form>

        </div>



    </div>
    </div>




    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdn.ckeditor.com/4.16.1/standard/ckeditor.css">
    <script src="https://cdn.ckeditor.com/4.16.1/standard/ckeditor.js"></script>
    <script src="{{ asset('js/documentosEstudiantes.js') }}"></script>


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/fontawesome.min.css">
@endsection
