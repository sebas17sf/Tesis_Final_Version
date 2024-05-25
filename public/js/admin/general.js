$(document).ready(function () {
    // Verificar si hay un estado guardado para el formulario de maestros
    var maestrosVisible = localStorage.getItem('maestrosVisible');
    if (maestrosVisible === 'true') {
        $("#registrarMaestros").show();
        $("#toggleFormBtn").text("Ocultar Registro de Maestros");
    } else {
        $("#registrarMaestros").hide();
        $("#toggleFormBtn").text("Registrar Maestros");
    }

    // Verificar si hay un estado guardado para el formulario de periodos
    var periodosVisible = localStorage.getItem('periodosVisible');
    if (periodosVisible === 'true') {
        $("#registrarPeriodos").show();
        $("#toggleFormBtn2").text("Ocultar Registro");
    } else {
        $("#registrarPeriodos").hide();
        $("#toggleFormBtn2").text("Agregar Cohoerte/Periodo/NRC");
    }

    $("#toggleFormBtn").click(function (event) {
        event.preventDefault();
        $("#registrarMaestros").toggle();
        if ($("#registrarMaestros").is(":visible")) {
            $(this).text("Ocultar Registro de Maestros");
            localStorage.setItem('maestrosVisible', 'true');
        } else {
            $(this).text("Registrar Maestros");
            localStorage.setItem('maestrosVisible', 'false');
        }
    });


    $("#toggleFormBtn2").click(function (event) {
        event.preventDefault();
        $("#registrarPeriodos").toggle();
        if ($("#registrarPeriodos").is(":visible")) {
            $(this).text("Ocultar Registro");
            localStorage.setItem('periodosVisible', 'true');
        } else {
            $(this).text("Agregar Cohoerte/Periodo/NRC");
            localStorage.setItem('periodosVisible', 'false');
        }
    });


    function validarNumeroPeriodo() {
        var numeroPeriodo = this.value.trim();
        var errorElement = document.getElementById('numeroPeriodoError');
        var formulario = document.querySelector('.formulario');

        if (numeroPeriodo === '') {
            errorElement.textContent = '';
            return;
        }

        if (isNaN(numeroPeriodo)) {
            errorElement.textContent = 'Ingrese un número válido.';
            formulario.onsubmit = function () {
                return false; // Evita que se envíe el formulario
            }
        } else if (parseInt(numeroPeriodo) <= 0) {
            errorElement.textContent = 'El número no puede ser negativo.';
            formulario.onsubmit = function () {
                return false; // Evita que se envíe el formulario
            }
        } else if (numeroPeriodo.length > 6) {
            errorElement.textContent = 'El número no puede tener más de 6 dígitos.';
            formulario.onsubmit = function () {
                return false; // Evita que se envíe el formulario
            }
        } else {
            errorElement.textContent = '';
            formulario.onsubmit = function () {
                return true; // Permite que se envíe el formulario
            }
        }
    }

    document.getElementById('numeroPeriodo').addEventListener('input', validarNumeroPeriodo);

    function validarNRC() {
        var nrc = this.value.trim();
        var errorElement = document.getElementById('errorNRC');
        var formulario = document.querySelector('.FormularioNRC');
        var hayErrores = false; // Bandera para indicar si hay errores

        if (nrc === '') {
            errorElement.textContent = '';
            hayErrores = true; // Hay un error
        } else if (parseInt(nrc) <= 0) {
            errorElement.textContent = 'El NRC debe ser un número positivo y mayor que cero.';
            hayErrores = true; // Hay un error
        } else if (!/^\d{5}$/.test(nrc)) {
            errorElement.textContent = 'Debe ingresar exactamente 5 números.';
            hayErrores = true; // Hay un error
        } else {
            errorElement.textContent = '';
        }

        // Evitar que se envíe el formulario si hay errores
        formulario.addEventListener('submit', function (event) {
            if (hayErrores) {
                event.preventDefault(); // Evitar el envío del formulario
            }
        });
    }

    document.getElementById('nrc').addEventListener('input', validarNRC);



    var selectedValue = localStorage.getItem('selectedEstado');

    if (selectedValue) {
        document.getElementById('estado').value = selectedValue;
    }

    document.getElementById('estado').addEventListener('change', function () {
        var selectedOption = this.value;
        localStorage.setItem('selectedEstado', selectedOption);
        this.form.submit();
    });




});



$(document).ready(function () {
    // Verificar si se guardó un estado previo en el almacenamiento local
    var asignarEstudianteVisible = localStorage.getItem('asignarEstudianteVisible');

    // Mostrar u ocultar el formulario según el estado guardado
    if (asignarEstudianteVisible === 'true') {
        $("#asignarEstudiante").show();
        $("#toggleFormBtn3").text("Ocultar Asignar Estudiante");
    } else {
        $("#asignarEstudiante").hide();
        $("#toggleFormBtn3").text("Asignar estudiante");
    }

    // Manejar el evento de clic en el botón
    $("#toggleFormBtn3").click(function () {
        $("#asignarEstudiante").toggle();

        // Guardar el estado en el almacenamiento local
        var isVisible = $("#asignarEstudiante").is(":visible");
        localStorage.setItem('asignarEstudianteVisible', isVisible.toString());

        // Actualizar el texto del botón
        if (isVisible) {
            $(this).text("Ocultar Asignar Estudiante");
        } else {
            $(this).text("Asignar estudiante");
        }
    });
});




///////////////////validacion numeros negativos////////////////////////////////////
document.getElementById('numeroPeriodo').addEventListener('input', function () {
    var numeroPeriodo = this.value.trim();
    var errorElement = document.getElementById('errorNumeroPeriodo');

    if (numeroPeriodo === '') {
        errorElement.textContent = '';
        return;
    }

    if (isNaN(numeroPeriodo)) {
        errorElement.textContent = 'Ingrese un número válido.';
    } else if (parseInt(numeroPeriodo) < 0) {
        errorElement.textContent = 'El número no puede ser negativo.';
    } else if (numeroPeriodo.length > 6) {
        errorElement.textContent = 'El número no puede tener más de 6 dígitos.';
    } else {
        errorElement.textContent = '';
    }
});

document.getElementById('cohorte').addEventListener('input', function () {
    var cohorte = this.value.trim();
    var errorElement = document.getElementById('errorCohorte');

    if (cohorte === '') {
        errorElement.textContent = '';
        return;
    }

    if (isNaN(cohorte)) {
        errorElement.textContent = 'Ingrese un número válido.';
    } else if (parseInt(cohorte) < 0) {
        errorElement.textContent = 'El número no puede ser negativo.';
    } else if (cohorte.length !== 6) {
        errorElement.textContent = 'Debe ingresar exactamente 6 números.';
    } else {
        errorElement.textContent = '';
    }
});



document.addEventListener('DOMContentLoaded', function () {
    document.getElementById('nrc').addEventListener('input', function (event) {
        var input = event.target;
        var value = input.value.trim();

        if (isNaN(value)) {
            input.setCustomValidity('Ingrese un número válido');
            document.getElementById('errorNRC').textContent = 'Ingrese un número válido';
        } else if (parseInt(value) < 0) {
            input.setCustomValidity('Ingrese un número no negativo');
            document.getElementById('errorNRC').textContent = 'Ingrese un número no negativo';
        } else {
            input.setCustomValidity('');
            document.getElementById('errorNRC').textContent = '';
        }
    });
});

/////////////////////////Busqueda tiempo real/////////////////////////
$(document).ready(function () {
    $('#buscarEstudiantes').on('keyup', function () {
        var query = $(this).val(); // Obtener el valor del campo de búsqueda
        $.ajax({
            url: '{{ route("admin.estudiantes") }}',
            type: 'GET',
            data: { buscarEstudiantes: query },
            success: function (response) {
                // Actualizar solo la tabla de estudiantes de vinculación
                $('#tablaEstudiantes').html($(response).find('#tablaEstudiantes').html());
            }
        });
    });
});

////////////////////////////////////estudiantes mensaje

window.onload = function () {
    verificarEstado();
};

function mostrarSweetAlert() {
    Swal.fire({
        title: 'Ingrese el motivo de la negación',
        input: 'textarea',
        inputLabel: 'Motivo',
        inputPlaceholder: 'Ingrese el motivo aquí...',
        inputAttributes: {
            rows: 7,
            style: 'resize: vertical;'
        },
        showCancelButton: true,
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Confirmar',
        preConfirm: (motivo) => {
            if (!motivo) {
                Swal.showValidationMessage('Debe ingresar un motivo');
            }
        }
    }).then((result) => {
        if (result.isConfirmed) {
            // Asignar el motivo de negación al campo oculto
            document.getElementById('motivoNegacion').value = result.value;
            // Enviar el formulario
            enviarFormulario();
        }
    });
}

// Función para enviar el formulario al controlador
function enviarFormulario() {
    // Obtener el formulario
    var formulario = document.getElementById('formNegacion');
    // Enviar el formulario
    formulario.submit();
}

// Función para mostrar el Sweet Alert solo cuando se selecciona "Negado"
function verificarEstado() {
    var estado = document.getElementById('nuevoEstado').value;
    if (estado === 'Negado') {
        mostrarSweetAlert();
    } else {
        // Si el estado no es "Negado", no se muestra el Sweet Alert
    }
}


