$(document).ready(function () {
    $("#toggleFormBtn8").click(function () {
        $("#registrarMaestros").toggle();
        if ($("#registrarMaestros").is(":visible")) {
            $(this).text("Ocultar Registro de Maestros");
        } else {
            $(this).text("Registrar Maestros");
        }
    });


});
$(document).ready(function () {

    $("#desplegarEditarPeriodo").hide();

    $("#selectPeriodo").on("change", function () {

        $('#editarPeriodoForm').submit();
    });

    $('#editarPeriodoForm').submit(function (event) {
        event.preventDefault();
        $("#desplegarEditarPeriodo").show();
        var periodoId = $('#selectPeriodo').val();
        var inicio = $('#selectPeriodo option:selected').data('inicio');
        var fin = $('#selectPeriodo option:selected').data('fin');
        var numero = $('#selectPeriodo option:selected').data('numero');

        $('#editarPeriodoModal').find('form').attr('action', '/admin/actualizar-periodo/' +
            periodoId);
        $('#editarPeriodoModal').find('input[name="periodoInicio"]').val(inicio);
        $('#editarPeriodoModal').find('input[name="periodoFin"]').val(fin);
        $('#editarPeriodoModal').find('input[name="numeroPeriodo"]').val(numero);

    });
});


$(document).ready(function () {
    $('#modalAgregarMaestro').draggable({
        handle: '.modal-header'
    });
});


document.addEventListener('DOMContentLoaded', function () {
    const nombresInput = document.getElementById('nombres');
    const nombresError = document.getElementById('nombresError');

    nombresInput.addEventListener('input', function (event) {
        const regex = /[^a-zA-Z\s]/g;
        if (regex.test(event.target.value)) {
            event.target.value = event.target.value.replace(regex, '');
            nombresError.textContent = 'Solo debe ingresar caracteres';
            nombresError.style.display = 'block';
        } else {
            nombresError.style.display = 'none';
        }
    });
});

document.addEventListener('DOMContentLoaded', function () {
    const nombresInput = document.getElementById('apellidos');
    const nombresError = document.getElementById('apellidosError');

    nombresInput.addEventListener('input', function (event) {
        const regex = /[^a-zA-Z\s]/g;
        if (regex.test(event.target.value)) {
            event.target.value = event.target.value.replace(regex, '');
            nombresError.textContent = 'Solo debe ingresar caracteres';
            nombresError.style.display = 'block';
        } else {
            nombresError.style.display = 'none';
        }
    });
});

document.addEventListener('DOMContentLoaded', function () {
    const correoInput = document.getElementById('correo');
    const correoError = document.getElementById('correoError');

    correoInput.addEventListener('input', function (event) {
        const emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
        if (!emailPattern.test(event.target.value)) {
            correoError.textContent = 'Ingrese un correo electrónico válido.';
            correoError.style.display = 'block';
        } else {
            correoError.style.display = 'none';
        }
    });
});

document.addEventListener('DOMContentLoaded', function () {
    const cedulaInput = document.getElementById('cedula');
    const cedulaError = document.getElementById('cedulaError');

    cedulaInput.addEventListener('input', function (event) {
        const cedula = event.target.value.trim();
        if (validarCedulaEcuatoriana(cedula)) {
            cedulaError.style.display = 'none';
        } else {
            cedulaError.textContent = 'Ingrese una cédula ecuatoriana válida.';
            cedulaError.style.display = 'block';
        }
    });

    function validarCedulaEcuatoriana(cedula) {
        if (cedula.length !== 10) {
            return false;
        }

        const coeficientes = [2, 1, 2, 1, 2, 1, 2, 1, 2];
        const verificador = parseInt(cedula.charAt(9));
        let suma = 0;

        for (let i = 0; i < 9; i++) {
            let valor = parseInt(cedula.charAt(i)) * coeficientes[i];
            suma += (valor >= 10) ? valor - 9 : valor;
        }

        const resultado = (suma % 10 === 0) ? 0 : 10 - (suma % 10);
        return resultado === verificador;
    }
});

document.addEventListener('DOMContentLoaded', function () {
    const espeIdInput = document.getElementById('espe_id');
    const espeIdError = document.getElementById('espeIdError');

    espeIdInput.addEventListener('input', function (event) {
        const espeId = event.target.value.trim();
        if (espeId.length !== 9 || isNaN(espeId)) {
            espeIdError.style.display = 'block';
        } else {
            espeIdError.style.display = 'none';
        }
    });
});

document.addEventListener('DOMContentLoaded', function () {
    const espeIdInput = document.getElementById('espe_id');
    const espeIdError = document.getElementById('espeIdError');

    espeIdInput.addEventListener('input', function (event) {
        const espeId = event.target.value.trim();
        const alphanumericRegex = /^[a-zA-Z0-9]+$/;

        if (espeId.length !== 9 || !alphanumericRegex.test(espeId)) {
            espeIdError.textContent = 'La ID de la ESPE debe tener exactamente 9 caracteres alfanuméricos.';
            espeIdError.style.display = 'block';
        } else {
            espeIdError.style.display = 'none';
        }
    });
});



document.addEventListener('DOMContentLoaded', function () {
    var numeroPeriodoInput = document.getElementById('numeroPeriodo');
    var numeroPeriodoError = document.getElementById('numeroPeriodoError');

    numeroPeriodoInput.addEventListener('input', function () {
        var valor = this.value.trim();
        valor = valor.replace(/\D/g, '');

         if (valor.length > 6) {
            valor = valor.slice(0, 6);
        }

         this.value = valor;

         if (valor.length !== 6) {
            numeroPeriodoError.textContent = "Debe tener exactamente 6 dígitos.";
            numeroPeriodoError.style.display = 'block';
        } else {
            numeroPeriodoError.style.display = 'none';
        }
    });
});

document.addEventListener('DOMContentLoaded', function () {
    var nrcInput = document.getElementById('nrc');
    var nrcError = document.getElementById('nrcError');

    nrcInput.addEventListener('input', function () {
        var valor = this.value.trim();
        valor = valor.replace(/\D/g, '');

         if (valor.length > 5) {
            valor = valor.slice(0, 5);
        }

         this.value = valor;

         if (valor.length !== 5) {
            nrcError.textContent = "El NRC debe tener exactamente 5 dígitos.";
            nrcError.style.display = 'block';
        } else {
            nrcError.style.display = 'none';
        }
    });
});

$('#editarPeriodoModal').on('input', '#numeroPeriodo', function() {
    this.value = this.value.replace(/[^0-9]/g, '');
});




$(document).ready(function() {
    $(document).on('input', '#nombresEditarMaestro', function() {
        this.value = this.value.replace(/[^a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+/g, '');
    });
});

$(document).ready(function() {
    $(document).on('input', '#apellidosEditarMaestro', function() {
        this.value = this.value.replace(/[^a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+/g, '');
    });
});


$(document).ready(function() {
    $(document).on('input', '#correoEditarMaestro', function() {
        var email = $(this).val();
        var re = /^[\w-]+(\.[\w-]+)*@([\w-]+\.)+[a-zA-Z]{2,7}$/;
        if (!re.test(email)) {
            $('#emailHelp').text('Debe ingresar un correo válido.').show();
        } else {
            $('#emailHelp').hide();
        }
    });
});

$(document).ready(function() {
    $(document).on('input', '#espeEditarMaestro', function() {
        var espeId = $(this).val();
        if (espeId.length != 9) {
            $('#espeHelp').text('La ID de la ESPE debe tener exactamente 9 caracteres alfanuméricos.').show();
        } else {
            $('#espeHelp').hide();
        }
    });
});


$(document).ready(function() {
    $(document).on('input', '#cedulaEditarMaestro', function() {
        var cedula = $(this).val();
        if (!validarCedula(cedula)) {
            $('#cedulaHelp').text('Debe ingresar una cédula ecuatoriana válida.').show();
        } else {
            $('#cedulaHelp').hide();
        }
    });
});

function validarCedula(cedula) {
    if (cedula.length !== 10) {
        return false;
    }
    var digitos = cedula.split('').map(Number);
    var ultimoDigito = digitos.pop();
    var suma = digitos.reduce(function(acc, curr, i) {
        var valor = (2 - (i % 2)) * curr;
        return acc + (valor > 9 ? valor - 9 : valor);
    }, 0);
    var decenaSuperior = Math.ceil(suma / 10) * 10;
    return (decenaSuperior - suma) === ultimoDigito;
}
