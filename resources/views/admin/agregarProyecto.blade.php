@extends('layouts.admin')

@section('title', 'Agregar Proyecto')

@section('title_component', 'Agregar Proyecto')

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

@section('content')
    <div class="mat-elevation-z8 contenedor_general">
        <form method="POST" action="{{ route('admin.crearProyecto') }}">
            @csrf

            <div class="form-group">
                <label for="DirectorProyecto">Director del Proyecto:</label>
                <select name="DirectorProyecto" class="form-control input input select" required>
                    <option value="">Seleccionar Director</option>
                    @foreach ($profesores as $profesor)
                        <option value="{{ $profesor->id }}">Nombres: {{ $profesor->Apellidos }} {{ $profesor->Nombres }} -
                            Departamento: {{ $profesor->Departamento }} - Correo: {{ $profesor->Correo }} </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="ProfesorParticipante">Profesor Participante:</label>
                <select name="ProfesorParticipante[]" class="form-control input input-select" required>
                    <option value="">Seleccionar Profesor Participante</option>
                    @foreach ($profesores as $profesor)
                        <option value="{{ $profesor->id }}">Nombres: {{ $profesor->Apellidos }} {{ $profesor->Nombres }} -
                            Departamento: {{ $profesor->Departamento }} - Correo: {{ $profesor->Correo }} </option>
                    @endforeach
                </select>
            </div>

            <div id="profesores-participantes"></div>

            <button type="button" class="button2" onclick="agregarProfesor()">Agregar más docentes participantes</button>


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
                <input type="text" name="codigoProyecto" class="form-control input"
                    placeholder="Ingrese el código del proyecto. Si no, déjelo vacío">
            </div>







            <div class="form-group">
                <label for="NombreProyecto">Nombre del Proyecto:</label>
                <input type="text" name="NombreProyecto" class="form-control input"
                    placeholder="Ingrese el Nombre del Proyecto" required>
            </div>
            <div class="form-group">
                <label for="DescripcionProyecto">Descripción del Proyecto:</label>
                <textarea name="DescripcionProyecto" class="form-control input" placeholder="Describa el Proyecto" required></textarea>
            </div>

            <div class="form-group">
                <label for="DepartamentoTutor">Departamento:</label>
                <select name="DepartamentoTutor" class="form-control input input-select" required>
                    <option value="Ciencias de la Computación">DCCO - Departamento de Computación</option>
                    <option value="Ciencias Exactas">DCEX - Ciencias Exactas</option>
                    <option value="Ciencias de la Vida y Agricultura">DCVA - Departamento de Ciencias de la Vida y
                        Agricultura</option>
                </select>
            </div>
            <div class="form-group">
                <label for="FechaInicio">Fecha de Inicio:</label>
                <input type="date" name="FechaInicio" class="form-control input" required>
            </div>
            <div class="form-group">
                <label for="FechaFinalizacion">Fecha de Finalización:</label>
                <input type="date" name="FechaFinalizacion" class="form-control input" required>
            </div>

            <div class="form-group">
                <label for="cupos">Cupos:</label>
                <input type="number" name="cupos" class="form-control input"
                    placeholder="Ingrese los Cupos para este proyecto" required min="1" max="10">
            </div>


            <div class="form-group">
                <label for="Estado">Estado:</label>
                <select name="Estado" class="form-control input-select input" required>
                    <option value="Ejecucion">En Ejecución</option>
                    <option value="Terminado">Terminado</option>
                </select>
            </div>
            <button type="submit" class="button">Agregar Proyecto</button>
        </form>
    </div>


    <script>
        let contador = 1; // Contador para generar IDs únicos

        function agregarProfesor() {
            contador++;

            const divProfesor = document.createElement('div');
            divProfesor.innerHTML = `
                <div class="form-group">
                    <label for="ProfesorParticipante">Profesor Participante:</label>
                    <select name="ProfesorParticipante[]" class="form-control input input-select" required>
                        <option value="">Seleccionar Profesor Participante</option>
                        @foreach ($profesores as $profesor)
                            <option value="{{ $profesor->id }}">Nombres: {{ $profesor->Apellidos }} {{ $profesor->Nombres }} -
                                Departamento: {{ $profesor->Departamento }} - Correo: {{ $profesor->Correo }} </option>
                        @endforeach
                    </select>
                </div>
                <button type="button" class="button2" onclick="eliminarProfesor(this)">Eliminar este participante</button>
            `;

            document.getElementById('profesores-participantes').appendChild(divProfesor);
        }

        function eliminarProfesor(element) {
            const divProfesor = element.parentNode;
            divProfesor.parentNode.removeChild(divProfesor);
        }
    </script>

@endsection
