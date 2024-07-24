 function validarCedula(cedula) {
    if (cedula.length !== 10) {
        return false;
    }
    var tercerDigito = parseInt(cedula.substring(2, 3));
    if (tercerDigito < 0 || tercerDigito > 6) {
        return false;
    }
    var coefValCedula = [2, 1, 2, 1, 2, 1, 2, 1, 2];
    var verificador = parseInt(cedula.substring(9, 10));
    var suma = 0;
    var digito = 0;
    for (var i = 0; i < (cedula.length - 1); i++) {
        digito = parseInt(cedula.substring(i, i + 1)) * coefValCedula[i];
        suma += ((parseInt((digito % 10)) + (parseInt((digito / 10)))));
    }
    suma = suma % 10 ? 10 - suma % 10 : 0;
    if (suma === verificador) {
        return true;
    } else {
        return false;
    }
}

document.getElementById('cedula').addEventListener('blur', function () {
    var cedula = this.value;
    if (!validarCedula(cedula)) {
        document.getElementById('cedulaError').textContent = 'Por favor, ingrese una cédula válida.';
    } else {
        document.getElementById('cedulaError').textContent = '';
    }
});

document.getElementById('cedula_confirmation').addEventListener('blur', function () {
    var cedula = document.getElementById('cedula').value;
    var cedulaConfirmation = this.value;
    if (cedula !== cedulaConfirmation) {
        document.getElementById('cedulaConfirmationError').textContent = 'Las cédulas no coinciden.';
    } else {
        document.getElementById('cedulaConfirmationError').textContent = '';
    }
});

document.querySelector('form').addEventListener('submit', function (event) {
    var errores = document.querySelectorAll('.form-text.text-danger');
    for (var i = 0; i < errores.length; i++) {
        if (errores[i].textContent !== "") {
            event.preventDefault();
            return false;
        }
    }
    return true;
});


document.getElementById('cedula_docente').addEventListener('blur', function () {
    var cedula = this.value;
    if (!validarCedula(cedula)) {
        document.getElementById('cedulaDocenteError').textContent = 'Por favor, ingrese una cédula válida.';
    } else {
        document.getElementById('cedulaDocenteError').textContent = '';
    }
});

document.getElementById('cedula_docente_confirmation').addEventListener('blur', function () {
    var cedula = document.getElementById('cedula_docente').value;
    var cedulaConfirmation = this.value;
    if (cedula !== cedulaConfirmation) {
        document.getElementById('cedulaDocenteConfirmationError').textContent = 'Las cédulas no coinciden.';
    } else {
        document.getElementById('cedulaDocenteConfirmationError').textContent = '';
    }
});

document.getElementById('form-docente').addEventListener('submit', function (event) {
    var errores = document.querySelectorAll('.form-text.text-danger');
    for (var i = 0; i < errores.length; i++) {
        if (errores[i].textContent !== "") {
            event.preventDefault();
            return false;
        }
    }
    return true;
});
