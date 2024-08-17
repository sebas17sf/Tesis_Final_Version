@extends('layouts.participante')
@section('title', 'Documentos')

@section('title_component', 'Panel de documentación')
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
    <div class="title_icon_info" style="text-align:left !important;">
        <b>Generar documentación</b>
    </div>
    <section class="content_recent_courses">
        <div class="container_cources_cards">
            <hr>
            <div class="container_cources scroll_element">
                <div class="cards">
                    <form action="{{ route('ParticipanteVinculacion.generarEvaluacionEstudiante') }}" method="post">
                        @csrf
                        <button type="submit" class="card-button">
                            <span><b> EVALUACIÓN DE DOCENTE</b></span>
                            <i class="fas fa-file-excel"></i>
                        </button>
                    </form>
                </div>
                <div class="cards">
                    <form action="{{ route('ParticipanteVinculacion.generarHorasDocente') }}" method="post">
                        @csrf
                        <button type="submit" class="card-button">
                            <span><b>NÚMERO DE HORAS DE DOCENTE</b></span>
                            <i class="fas fa-file-excel"></i>
                        </button>
                    </form>
                </div>
                <!-- Botón para abrir el modal -->
                <div class="cards">
                    <button type="button" class="card-button" onclick="$('#draggableCardRegistroHoras').show()">
                        <span><b>REGISTRAR DE ESTUDIANTES</b></span>
                        <i class="fas fa-save"></i>
                    </button>
                </div>
                <!-- Tarjeta movible para Registro de Horas -->
                <div class="draggable-card" id="draggableCardRegistroHoras">
                    <div class="card-header">
                        <span class="card-title">Registro de estudiantes</span>
                        <button type="button" class="close" onclick="$('#draggableCardRegistroHoras').hide()"><i
                                class="fa-thin fa-xmark"></i></button>
                    </div>
                    <div class="card-body">
                        <form class="FormularioRegistroHoras"
                            action="{{ route('ParticipanteVinculacion.generarAsistencia') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label class="label" for="fecha"><strong>Fecha de asistencia:</strong></label>
                                <input type="date" id="fecha" name="fecha" class="form-control input" required>
                                <small id="fechaError" class="form-text text-danger" style="display: none;"></small>
                                @error('fecha')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="label" for="lugar"><strong>Lugar de la actividad:</strong></label>
                                <input type="text" id="lugar" name="lugar" class="form-control input"
                                    placeholder=" Escribir el lugar de la actividad" required>
                                <small id="lugarError" class="form-text text-danger" style="display: none;"></small>
                                @error('lugar')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="label" for="actividades"><strong>Actividades a realizar:</strong></label>
                                <textarea id="actividades" name="actividades" class="form-control input" placeholder=" Escribir la actividad" required></textarea>
                                <small id="actividadesError" class="form-text text-danger" style="display: none;"></small>
                                @error('actividades')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="card-footer1 d-flex justify-content-center align-items-center">
                                <button type="submit" class="button1 input_select1">
                                    <span>GENERAR</span>
                                    <i class="fas fa-save"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </section>


    <hr>
    <h4><b>Informe Docente - Vinculación a la Sociedad</b></h4>

        <div class="mat-elevation-z8 contenedor_general">
            <div class="contenedor_acciones_tabla sidebar_active_content_acciones_tabla">
                <div class="contenedor_botones">
                    <div class="tooltip-container">
                    <span class="tooltip-text">Guardar Datos</span>
        <a href="{{ route('participante.guardarDatos') }}" class="button3 efects_button btn_primary colorr"
                onclick="guardarDatos(event)"><i class="fa-regular fa-floppy-disk"></i></a>
        </div>
        <div class="tooltip-container">
            <span class="tooltip-text">Recuperar Datos</span>
            <a href="{{ route('participante.recuperarDatos') }}" class="button3 efects_button btn_filtro colorr"> <i class="fa-solid fa-window-restore"></i></a>
            </div>
        </div>
    </div>

   <hr>

   <form id="informeForm" action="{{ route('director_vinculacion.generarInformeDirector') }}" method="POST">
    @csrf

    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="Objetivos"><strong>Ingrese el Objetivo del Proyecto:</strong></label>
            <textarea placeholder="Ingrese el objetivo" class="form-control input" id="Objetivos" rows="2" name="Objetivos">{{ old('Objetivos', session('Objetivos')) }}</textarea>
            <small id="ObjetivosError" class="error-message" style="color: red;"></small>
        </div>

        <div class="form-group col-md-6">
            <label for="intervencion"><strong>Lugar de intervención del Proyecto:</strong></label>
            <input placeholder="Ingrese el lugar donde se realizó el proyecto" type="text" class="form-control input"
                id="intervencion" name="intervencion" value="{{ old('intervencion', session('intervencion')) }}">
            <small id="intervencionError" class="error-message" style="color: red;"></small>
        </div>
    </div>

    <hr>
    <h4><b>Actividades Planificadas y Resultados Alcanzados</b></h4>
    <hr>

    <div id="campos">
        @if (old('planificadas', session('planificadas')))
            @foreach (old('planificadas', session('planificadas')) as $index => $planificada)
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="planificadas"><strong>Actividades planificadas:</strong></label>
                        <textarea placeholder="Ingrese las actividades planificadas" name="planificadas[]" class="form-control input"
                            rows="2">{{ $planificada }}</textarea>
                        <small id="planificadasError" class="error-message" style="color: red;"></small>
                    </div>

                    <div class="form-group col-md-4">
                        <label for="alcanzados"><strong>Resultados alcanzados:</strong></label>
                        <textarea placeholder="Ingrese los resultados alcanzados" name="alcanzados[]" class="form-control input"
                            rows="2">{{ old('alcanzados')[$index] ?? session('alcanzados')[$index] }}</textarea>
                        <small id="alcanzadosError" class="error-message" style="color: red;"></small>
                    </div>

                    <div class="form-group col-md-4">
                        <label for="porcentaje"><strong>Porcentaje alcanzado:</strong></label>
                        <textarea placeholder="Ingrese el porcentaje alcanzado" name="porcentaje[]" class="form-control input"
                            rows="2">{{ old('porcentaje')[$index] ?? session('porcentaje')[$index] }}</textarea>
                        <small id="porcentajeError" class="error-message" style="color: red;"></small>
                    </div>
                </div>
            @endforeach
        @else
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="planificadas"><strong>Actividades planificadas:</strong></label>
                    <textarea placeholder="Ingrese las actividades planificadas" name="planificadas[]" class="form-control input"
                        rows="2"></textarea>
                    <small id="planificadasError" class="error-message" style="color: red;"></small>
                </div>

                <div class="form-group col-md-4">
                    <label for="alcanzados"><strong>Resultados alcanzados:</strong></label>
                    <textarea placeholder="Ingrese los resultados alcanzados" name="alcanzados[]" class="form-control input"
                        rows="2"></textarea>
                    <small id="alcanzadosError" class="error-message" style="color: red;"></small>
                </div>

                <div class="form-group col-md-4">
                    <label for="porcentaje"><strong>Porcentaje alcanzado:</strong></label>
                    <textarea placeholder="Ingrese el porcentaje alcanzado" name="porcentaje[]" class="form-control input"
                        rows="2"></textarea>
                    <small id="porcentajeError" class="error-message" style="color: red;"></small>
                </div>
            </div>
        @endif
    </div>

    <div class="d-flex">
        <button type="button" class="button3 efects_button btn_nuevo3 mr-2" onclick="agregarCampo()"><i
                class="fa-solid fa-plus"></i></button>
        <button type="button" class="button3 efects_button btn_eliminar3 mr-2" onclick="eliminarCampo()"><i
                class='bx bx-trash'></i></button>
    </div>

    <hr>
    <h4><b>Beneficiarios atendidos</b></h4>
    <hr>
    <div class="form-row">
        <div class="form-group col-md-3">
            <label for="Hombres"><strong>Cantidad de Hombres beneficiarios-atendidos:</strong></label>
            <input placeholder="Ingrese los Hombres beneficiados" type="number" class="form-control input"
                id="Hombres" name="Hombres" value="{{ old('Hombres', session('Hombres')) }}" min="1">
            <small id="HombresError" class="error-message" style="color: red;"></small>
        </div>
        <div class="form-group col-md-3">
            <label for="Observaciones1"><strong>Observaciones en Hombres:</strong></label>
            <textarea placeholder="Ingrese las Observaciones" class="form-control input" id="Observaciones1" rows="3"
                name="Observaciones1">{{ old('Observaciones1', session('Observaciones1')) }}</textarea>
            <small id="Observaciones1Error" class="error-message" style="color: red;"></small>
        </div>
        <div class="form-group col-md-3">
            <label for="Mujeres"><strong>Cantidad de Mujeres beneficiarios-atendidos:</strong></label>
            <input placeholder="Ingrese las Mujeres beneficiadas" type="number" class="form-control input"
                id="Mujeres" name="Mujeres" value="{{ old('Mujeres', session('Mujeres')) }}" min="1">
            <small id="MujeresError" class="error-message" style="color: red;"></small>
        </div>
        <div class="form-group col-md-3">
            <label for="Observaciones2"><strong>Observaciones en Mujeres:</strong></label>
            <textarea placeholder="Ingrese las Observaciones" class="form-control input" id="Observaciones2" rows="3"
                name="Observaciones2">{{ old('Observaciones2', session('Observaciones2')) }}</textarea>
            <small id="Observaciones2Error" class="error-message" style="color: red;"></small>
        </div>
    </div>

    <div class="form-row">
        <div class="form-group col-md-3">
            <label for="Niños"><strong>Cantidad de Niños beneficiarios-atendidos:</strong></label>
            <input placeholder="Ingrese los Niños beneficiados" type="number" class="form-control input"
                id="Niños" name="Niños" value="{{ old('Niños', session('Niños')) }}" min="1">
            <small id="NiñosError" class="error-message" style="color: red;"></small>
        </div>
        <div class="form-group col-md-3">
            <label for="Observaciones3"><strong>Observaciones en Niños:</strong></label>
            <textarea placeholder="Ingrese las Observaciones" class="form-control input" id="Observaciones3" rows="3"
                name="Observaciones3">{{ old('Observaciones3', session('Observaciones3')) }}</textarea>
            <small id="Observaciones3Error" class="error-message" style="color: red;"></small>
        </div>
        <div class="form-group col-md-3">
            <label for="capacidad"><strong>Cantidad de Personas con capacidad beneficiarios-atendidos:</strong></label>
            <input placeholder="Ingrese las Personas beneficiadas" type="number" class="form-control input"
                id="capacidad" name="capacidad" value="{{ old('capacidad', session('capacidad')) }}"
                min="1">
            <small id="capacidadError" class="error-message" style="color: red;"></small>
        </div>
        <div class="form-group col-md-3">
            <label for="Observaciones4"><strong>Observaciones en Personas con discapacidad:</strong></label>
            <textarea placeholder="Ingrese las Observaciones" class="form-control input" id="Observaciones4" rows="3"
                name="Observaciones4">{{ old('Observaciones4', session('Observaciones4')) }}</textarea>
            <small id="Observaciones4Error" class="error-message" style="color: red;"></small>
        </div>
    </div>

    <hr>
    <h4><b>Conclusiones y Recomendaciones</b></h4>
    <hr>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="Conclusiones"><strong>Conclusiones:</strong></label>
            <textarea placeholder="Ingrese la conclusion" class="form-control input" id="Conclusiones" rows="3"
                name="Conclusiones">{{ old('Conclusiones', session('Conclusiones')) }}</textarea>
            <small id="ConclusionesError" class="error-message" style="color: red;"></small>
        </div>

        <div class="form-group col-md-6">
            <label for="Recomendaciones"><strong>Recomendaciones:</strong></label>
            <textarea placeholder="Ingrese la recomendacion" class="form-control input" id="Recomendaciones" rows="3"
                name="Recomendaciones">{{ old('Recomendaciones', session('Recomendaciones')) }}</textarea>
            <small id="RecomendacionesError" class="error-message" style="color: red;"></small>
        </div>
    </div>

    <center>
        <button type="submit" class="button1"><i class="fas fa-cogs"></i> Generar Informe</button>
    </center>
</form>


    <hr>
    <h4><b>Acta de reuniones</b></h4>
    <hr>

    <form action="{{ route('ParticipanteVinculacion.generarActaReunion') }}" method="post">
        @csrf

        <div class="row">
            <div class="col-md-6 form-group">
                <label for="lugar"><strong>Lugar de la reunión:</strong></label>
                <input type="text" id="lugar" placeholder="Ingrese el lugar de reunion" name="lugar"
                    class="form-control input">
            </div>

            <div class="col-md-6 form-group">
                <label for="tema"><strong>Tema de la reunión:</strong></label>
                <input type="text" id="tema" name="tema" placeholder="Ingrese el tema de reunion"
                    class="form-control input">
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 form-group">
                <label for="fecha"><strong>Fecha de la reunión:</strong></label>
                <input type="date" id="fecha" name="fecha" placeholder="Ingrese la fecha de reunion"
                    class="form-control input">
            </div>

            <div class="col-md-4 form-group">
                <label for="hora"><strong>Hora de la reunión:</strong></label>
                <input type="time" id="horaInicial" name="horaInicial" class="form-control input">
            </div>

            <div class="col-md-4 form-group">
                <label for="hora"><strong>Hora de finalización de la reunión:</strong></label>
                <input type="time" id="horaFinal" name="horaFinal" class="form-control input">
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 form-group">
                <label for="objetivo"><strong>Objetivo:</strong></label>
                <textarea id="objetivo" name="objetivo" placeholder="Ingrese el objetivo" class="form-control input"></textarea>
            </div>

            <div class="col-md-6 form-group">
                <label for="antecedentes"><strong>Antecedentes:</strong></label>
                <textarea id="antecedentes" name="antecedentes" placeholder="Ingrese los antecedentes" class="form-control input"></textarea>
            </div>
        </div>
        <div id="campos2">
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="acciones"><strong>Acciones a realizar:</strong></label>
                    <textarea name="acciones[]" class="form-control input" placeholder="Ingrese las acciones a realizar" rows="2"
                        required></textarea>
                </div>

                <div class="form-group col-md-4">
                    <label for="responsable"><strong>Responsable:</strong></label>
                    <textarea name="responsable[]" class="form-control input" placeholder="Ingrese el nombre del responable"
                        rows="2" required></textarea>
                </div>

                <div class="form-group col-md-4">
                    <label for="fechaAcciones"><strong>Fecha termino:</strong></label>
                    <input type="date" name="fechaAcciones[]" class="form-control input"
                        placeholder="Ingrese la fecha" rows="2" required></input>
                </div>
            </div>
        </div>

        <div class="d-flex">
            <button type="button" class="button3 efects_button btn_nuevo3 mr-2" onclick="agregarCampo2()"><i
                    class="fa-solid fa-plus"></i></button></button>
            <button type="button" class="button3 efects_button btn_eliminar3 1mr-2" onclick="eliminarCampo2()"><i
                    class='bx bx-trash'></i></button>
        </div>

        <center>
            <div class="d-flex justify-content-center">
                <button type="submit" class="button1 mr-2">
                    <i class="fas fa-cogs"></i> Generar Acta de Reunión
                </button>

            </div>
        </center>

    </form>


    <link rel="stylesheet" href="https://cdn.ckeditor.com/4.16.1/standard/ckeditor.css">
    <script src="https://cdn.ckeditor.com/4.16.1/standard/ckeditor.js"></script>
    <script src="{{ asset('js/plantilla/main.js') }}" type="module"></script>
    <script src="js\admin\acciones.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.13.0/jquery-ui.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script src="js\admin\index.js"></script>


    <script>
        function agregarCampo() {
            var campos = document.getElementById('campos');
            var nuevoCampo = document.createElement('div');
            nuevoCampo.className = 'form-row';
            nuevoCampo.innerHTML = `
            <div class="form-group col-md-4">
                <label><strong>Nueva Actividad Planificada:</strong></label>
                <textarea name="planificadas[]" class="form-control input" rows="2" required></textarea>
            </div>
            <div class="form-group col-md-4">
                <label><strong>Nuevo Resultado Alcanzado:</strong></label>
                <textarea name="alcanzados[]" class="form-control input" rows="2" required></textarea>
            </div>
            <div class="form-group col-md-4">
                <label><strong>Nuevo Porcentaje Alcanzado:</strong></label>
                <textarea name="porcentaje[]" class="form-control input" rows="2" required></textarea>
            </div>
        `;
            campos.appendChild(nuevoCampo);
        }

        function eliminarCampo() {
            var campos = document.getElementById('campos');
            var camposAdicionales = campos.querySelectorAll('.form-row:not(:first-child)');
            if (camposAdicionales.length > 0) {
                campos.removeChild(camposAdicionales[camposAdicionales.length - 1]);
            }
        }
    </script>

    <script>
        $(document).ready(function() {
            // Hacer que los cards sean draggable
            $('.draggable-card').draggable({
                handle: ".card-header",
                containment: "window"
            });
        });

        function agregarCampo2() {
            var campos = document.getElementById('campos2');
            var nuevoCampo = document.createElement('div');
            nuevoCampo.className = 'form-row';
            nuevoCampo.innerHTML = `
            <div class="form-group col-md-4">
                <label><strong>Nueva Actividad Planificada:</strong></label>
                <textarea name="acciones[]" class="form-control input" rows="2" required></textarea>
            </div>
            <div class="form-group col-md-4">
                <label><strong>Nuevo Resultado Alcanzado:</strong></label>
                <textarea name="responsable[]" class="form-control input" rows="2" required></textarea>
            </div>
            <div class="form-group col-md-4">
                <label><strong>Nuevo Porcentaje Alcanzado:</strong></label>
                <input type="date" name="fechaAcciones[]" class="form-control input" required></input>
            </div>     `;
            campos.appendChild(nuevoCampo);
        }

        function eliminarCampo2() {
            var campos = document.getElementById('campos2');
            var camposAdicionales = campos.querySelectorAll('.form-row:not(:first-child)');
            if (camposAdicionales.length > 0) {
                campos.removeChild(camposAdicionales[camposAdicionales.length - 1]);
            }
        }
    </script>

    <script>
        function agregarCampo() {
            var container = document.getElementById('campos');
            var newField = container.children[0].cloneNode(true);
            newField.querySelectorAll('textarea').forEach(textarea => textarea.value = '');
            container.appendChild(newField);
        }

        function eliminarCampo() {
            var container = document.getElementById('campos');
            var fields = container.querySelectorAll('.form-row');
            if (fields.length > 1) {
                container.removeChild(fields[fields.length - 1]);
            }
        }

        function guardarDatos(event) {
            event.preventDefault();
            var form = document.getElementById('informeForm');
            form.action = "{{ route('participante.guardarDatos') }}";
            form.submit();
        }

        document.addEventListener("DOMContentLoaded", function() {
            const urlParams = new URLSearchParams(window.location.search);
            const scrollElementId = urlParams.get('scroll');
            if (scrollElementId) {
                const element = document.getElementById(scrollElementId);
                if (element) {
                    window.scrollTo({
                        top: element.offsetTop,
                        behavior: 'smooth'
                    });
                    document.getElementById('registroInforme').style.display = 'block';
                }
            }
        });
    </script>

    <script>
        document.getElementById('informeForm').addEventListener('submit', function(event) {
    // Limpiar mensajes de error previos
    document.querySelectorAll('.error-message').forEach(function(error) {
        error.textContent = '';
    });

    let formIsValid = true;

    // Validar 'Objetivos'
    const objetivos = document.getElementById('Objetivos').value.trim();
    if (objetivos === "") {
        document.getElementById('ObjetivosError').textContent = 'El objetivo del proyecto es requerido.';
        formIsValid = false;
    }

    // Validar 'intervencion'
    const intervencion = document.getElementById('intervencion').value.trim();
    if (intervencion === "") {
        document.getElementById('intervencionError').textContent = 'El lugar de intervención es requerido.';
        formIsValid = false;
    }

    // Validar 'planificadas', 'alcanzados', 'porcentaje'
    const planificadas = document.querySelectorAll('textarea[name="planificadas[]"]');
    const alcanzados = document.querySelectorAll('textarea[name="alcanzados[]"]');
    const porcentajes = document.querySelectorAll('textarea[name="porcentaje[]"]');

    planificadas.forEach(function(element, index) {
        if (element.value.trim() === "") {
            document.getElementById('planificadasError').textContent = 'Las actividades planificadas son requeridas.';
            formIsValid = false;
        }
    });

    alcanzados.forEach(function(element, index) {
        if (element.value.trim() === "") {
            document.getElementById('alcanzadosError').textContent = 'Los resultados alcanzados son requeridos.';
            formIsValid = false;
        }
    });

    porcentajes.forEach(function(element, index) {
        if (element.value.trim() === "") {
            document.getElementById('porcentajeError').textContent = 'El porcentaje alcanzado es requerido.';
            formIsValid = false;
        }
    });

    // Validar 'Hombres'
    const hombres = document.getElementById('Hombres').value.trim();
    if (hombres === "" || hombres < 1) {
        document.getElementById('HombresError').textContent = 'La cantidad de hombres beneficiados es requerida.';
        formIsValid = false;
    }

    // Validar 'Mujeres'
    const mujeres = document.getElementById('Mujeres').value.trim();
    if (mujeres === "" || mujeres < 1) {
        document.getElementById('MujeresError').textContent = 'La cantidad de mujeres beneficiadas es requerida.';
        formIsValid = false;
    }

    // Validar 'Niños'
    const niños = document.getElementById('Niños').value.trim();
    if (niños === "" || niños < 1) {
        document.getElementById('NiñosError').textContent = 'La cantidad de niños beneficiados es requerida.';
        formIsValid = false;
    }

    // Validar 'capacidad'
    const capacidad = document.getElementById('capacidad').value.trim();
    if (capacidad === "" || capacidad < 1) {
        document.getElementById('capacidadError').textContent = 'La cantidad de personas con capacidad es requerida.';
        formIsValid = false;
    }

    // Validar 'Conclusiones'
    const conclusiones = document.getElementById('Conclusiones').value.trim();
    if (conclusiones === "") {
        document.getElementById('ConclusionesError').textContent = 'Las conclusiones son requeridas.';
        formIsValid = false;
    }

    // Validar 'Recomendaciones'
    const recomendaciones = document.getElementById('Recomendaciones').value.trim();
    if (recomendaciones === "") {
        document.getElementById('RecomendacionesError').textContent = 'Las recomendaciones son requeridas.';
        formIsValid = false;
    }

    // Si el formulario no es válido, evitar el envío
    if (!formIsValid) {
        event.preventDefault();
    }
});

// Eliminar mensaje de error al escribir
document.querySelectorAll('textarea, input').forEach(function(element) {
    element.addEventListener('input', function() {
        const errorElement = document.getElementById(element.id + 'Error');
        if (errorElement) {
            errorElement.textContent = '';
        }
    });
});

    </script>



@endsection
