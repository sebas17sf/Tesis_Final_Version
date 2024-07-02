@extends('layouts.coordinador')

@section('title', 'Editar Proyecto')

@section('content')
    <div class="container">
        <h4>Editar Proyecto</h4>

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
        <div class="contenedor_alerta error" id="errorAlert">
            <div class="icon_alert"><i class="fa-regular fa-xmark"></i></div>
            <div class="content_alert">
                <div class="title">Error!</div>
                <div class="body">{{ session('error') }}</div>
            </div>
            <div class="icon_remove">
                <button class="button4 btn_3_2" onclick="closeAlert('errorAlert')"><i
                        class="fa-regular fa-xmark"></i></button>
            </div>
        </div>

        <script>
            document.querySelector('.contenedor_alerta.error .icon_remove button').addEventListener('click', function() {
                this.closest('.contenedor_alerta').style.display = 'none';
            });
        </script>
    @endif

        <form action="{{ route('coordinador.updateProyecto', ['ProyectoID' => $proyecto->ProyectoID]) }}" method="POST">
            @csrf
            @method('PUT')


            <div class="form-group">
                <label for="DirectorProyecto">Director del Proyecto:</label>
                <select name="DirectorProyecto" class="form-control input input select" required>
                    <option value="">Seleccionar Director</option>
                    @foreach ($profesores as $profesor)
                        <option value="{{ $profesor->id }}"
                            {{ $proyecto->DirectorProyecto === $profesor->id ? 'selected' : '' }}>
                            {{ $profesor->Apellidos }} {{ $profesor->Nombres }}
                            {{ $profesor->Departamento }} {{ $profesor->Correo }} </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="ProfesorParticipante">Profesor Participante:</label>
                <select name="ProfesorParticipante[]" class="form-control input input-select" required>
                    <option value="">Seleccionar Profesor Participante</option>
                    @foreach ($profesores as $profesor)
                        <option value="{{ $profesor->id }}"> {{ $profesor->Apellidos }} {{ $profesor->Nombres }}
                            {{ $profesor->Departamento }} {{ $profesor->Correo }} </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="NombreProyecto">Nombre del Proyecto:</label>
                <input type="text" class="form-control input" id="NombreProyecto" name="NombreProyecto"
                    value="{{ $proyecto->NombreProyecto }}" required>
            </div>

            <div class="form-group">
                <label for="nrc">Vinculacion NRC:</label>
                <select name="nrc" class="form-control input input-select" required>
                    <option value="">Seleccionar NRC</option>
                    @foreach ($nrcs as $nrc)
                        <option value="{{ $nrc->id }}">{{ $nrc->nrc }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="codigoProyecto">Ingrese código del proyecto:</label>
                <input type="text" value="{{ $proyecto->codigoProyecto }}" name="codigoProyecto"
                    class="form-control input" placeholder="Ingrese el código del proyecto. Si no, déjelo vacío">
            </div>

            <div class="form-group">
                <label for="DescripcionProyecto">Descripción del Proyecto:</label>
                <textarea class="form-control input" id="DescripcionProyecto" name="DescripcionProyecto" rows="4" required>{{ $proyecto->DescripcionProyecto }}</textarea>
            </div>

            <div class="form-group">
                <label for="DepartamentoTutor">Departamento:</label>
                <select class="form-control input" id="DepartamentoTutor" name="DepartamentoTutor" required>
                    <option value="Ciencias de la Computación"
                        {{ $proyecto->DepartamentoTutor === 'DCCO' ? 'selected' : '' }}>DCCO - Departamento de Computación
                    </option>
                    <option value="Ciencias Exactas" {{ $proyecto->DepartamentoTutor === 'DCEX' ? 'selected' : '' }}>DCEX -
                        Ciencias Exactas</option>
                    <option value="Ciencias de la Vida y Agricultura"
                        {{ $proyecto->DepartamentoTutor === 'DCVA' ? 'selected' : '' }}>DCVA - Departamento de Ciencias de
                        la Vida y Agricultura</option>
                </select>
            </div>

            <div class="form-group">
                <label for="cupos">Cupos:</label>
                <input type="number" class="form-control input" id="cupos" name="cupos"
                    value="{{ $proyecto->cupos }}" required>
            </div>

            <div class="form-group">
                <label for="FechaInicio">Fecha de Inicio:</label>
                <input type="date" class="form-control input" id="FechaInicio" name="FechaInicio"
                    value="{{ $proyecto->FechaInicio }}" required>
            </div>

            <div class="form-group">
                <label for="FechaFinalizacion">Fecha de Finalización:</label>
                <input type="date" class="form-control input" id="FechaFinalizacion" name="FechaFinalizacion"
                    value="{{ $proyecto->FechaFinalizacion }}" required>
            </div>

            <div class="form-group">
                <label for="Estado">Estado del Proyecto:</label>
                <select class="form-control input" id="Estado" name="Estado" required>
                    <option value="Ejecucion" {{ $proyecto->Estado === 'Ejecucion' ? 'selected' : '' }}>Ejecucion</option>
                    <option value="Terminado" {{ $proyecto->Estado === 'Terminado' ? 'selected' : '' }}>Terminado</option>
                </select>
            </div>

            <button type="submit" class="button">Guardar Cambios</button>
        </form>

    </div>
@endsection

