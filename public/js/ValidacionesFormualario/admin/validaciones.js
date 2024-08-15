document.getElementById('formDocentesGuardar').addEventListener('submit', function(event) {
    let valid = true;

    // Obtener los campos
    const nombres = document.getElementById('nombres');
    const apellidos = document.getElementById('apellidos');
    const correo = document.getElementById('correo');
    const cedula = document.getElementById('cedula');
    const espe_id = document.getElementById('espe_id');
    const departamento = document.getElementById('departamento');

    // Validación de Nombres
    if (nombres.value.trim() === '') {
        valid = false;
        document.getElementById('nombresError').style.display = 'block';
    } else {
        document.getElementById('nombresError').style.display = 'none';
    }

    // Validación de Apellidos
    if (apellidos.value.trim() === '') {
        valid = false;
        document.getElementById('apellidosError').style.display = 'block';
    } else {
        document.getElementById('apellidosError').style.display = 'none';
    }

    // Validación de Correo
    if (correo.value.trim() === '' || !correo.checkValidity()) {
        valid = false;
        document.getElementById('correoError').style.display = 'block';
    } else {
        document.getElementById('correoError').style.display = 'none';
    }

    // Validación de Cédula
    if (cedula.value.trim() === '' || !cedula.checkValidity()) {
        valid = false;
        document.getElementById('cedulaError').style.display = 'block';
    } else {
        document.getElementById('cedulaError').style.display = 'none';
    }

    // Validación de ESPE ID
    if (espe_id.value.trim() === '') {
        valid = false;
        document.getElementById('espeIdError').style.display = 'block';
    } else {
        document.getElementById('espeIdError').style.display = 'none';
    }

    // Validación de Departamento
    if (departamento.value.trim() === '') {
        valid = false;
        document.getElementById('departamentoError').style.display = 'block';
    } else {
        document.getElementById('departamentoError').style.display = 'none';
    }

    // Si no es válido, se previene el envío del formulario
    if (!valid) {
        event.preventDefault();
    }
});

document.getElementById('formularioEditarMaestro').addEventListener('submit', function(event) {
    let valid = true;

    // Obtener los campos de Nombres y Apellidos
    const nombres = document.getElementById('nombresEditarMaestro');
    const apellidos = document.getElementById('apellidosEditarMaestro');

    const nombresError = document.getElementById('nombresError2');
    const apellidosError = document.getElementById('apellidosError2');

    // Validación del campo Nombres
    if (nombres.value.trim() === '') {
        valid = false;
        nombresError.style.display = 'block';
        nombresError.textContent = 'Este campo es obligatorio.';
    } else {
        nombresError.style.display = 'none';
    }

    // Validación del campo Apellidos
    if (apellidos.value.trim() === '') {
        valid = false;
        apellidosError.style.display = 'block';
        apellidosError.textContent = 'Este campo es obligatorio.';
    } else {
        apellidosError.style.display = 'none';
    }

    // Si no es válido, se previene el envío del formulario
    if (!valid) {
        event.preventDefault();
    }
});

document.getElementById('formAgregarProyectos').addEventListener('submit', function(event) {
    let valid = true;

    // Obtener los campos
    const nombreProyecto = document.getElementById('NombreProyecto');
    const directorProyecto = document.getElementById('DirectorProyecto');
    const descripcionProyecto = document.getElementById('DescripcionProyecto');
    const departamentoTutor = document.getElementById('DepartamentoTutor');
    const fechaInicio = document.getElementById('FechaInicio');
    const fechaFinalizacion = document.getElementById('FechaFinalizacion');
    const estado = document.getElementById('Estado');

    // Validar Nombre del Proyecto
    if (nombreProyecto.value.trim() === '') {
        valid = false;
        document.getElementById('NombreProyectoError').style.display = 'block';
    } else {
        document.getElementById('NombreProyectoError').style.display = 'none';
    }

    // Validar Director del Proyecto
    if (directorProyecto.value === '') {
        valid = false;
        document.getElementById('DirectorProyectoError').style.display = 'block';
    } else {
        document.getElementById('DirectorProyectoError').style.display = 'none';
    }

    // Validar Descripción del Proyecto
    if (descripcionProyecto.value.trim() === '') {
        valid = false;
        document.getElementById('DescripcionProyectoError').style.display = 'block';
    } else {
        document.getElementById('DescripcionProyectoError').style.display = 'none';
    }

    // Validar Departamento Tutor
    if (departamentoTutor.value === '') {
        valid = false;
        document.getElementById('DepartamentoTutorError').style.display = 'block';
    } else {
        document.getElementById('DepartamentoTutorError').style.display = 'none';
    }

    // Validar Fecha de Inicio
    if (fechaInicio.value === '') {
        valid = false;
        document.getElementById('FechaInicioError').style.display = 'block';
    } else {
        document.getElementById('FechaInicioError').style.display = 'none';
    }

    // Validar Fecha de Finalización
    if (fechaFinalizacion.value === '') {
        valid = false;
        document.getElementById('FechaFinalizacionError').style.display = 'block';
    } else {
        document.getElementById('FechaFinalizacionError').style.display = 'none';
    }

    // Validar Estado del Proyecto
    if (estado.value === '#') {
        valid = false;
        document.getElementById('EstadoError').style.display = 'block';
    } else {
        document.getElementById('EstadoError').style.display = 'none';
    }

    // Prevenir envío si no es válido
    if (!valid) {
        event.preventDefault();
    }
});
