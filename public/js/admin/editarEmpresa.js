document.getElementById('nombreEmpresa').addEventListener('input', function (e) {
    var start = this.selectionStart,
        end = this.selectionEnd;
    var originalValue = this.value;

    this.value = this.value.replace(/\d/g, '');

    if (this.value !== originalValue) {
        document.getElementById('error-message').textContent = 'Solo se permite ingresar caracteres';
    } else {
        document.getElementById('error-message').textContent = '';
    }

    this.setSelectionRange(start, end);
});

document.getElementById('ciudad').addEventListener('input', function (e) {
    var start = this.selectionStart,
        end = this.selectionEnd;
    var originalValue = this.value;

    this.value = this.value.replace(/\d/g, '');

    if (this.value !== originalValue) {
        document.getElementById('error-message-ciudad').textContent = 'Solo se permite ingresar caracteres';
    } else {
        document.getElementById('error-message-ciudad').textContent = '';
    }

    this.setSelectionRange(start, end);
});


document.getElementById('direccion').addEventListener('input', function (e) {
    var start = this.selectionStart,
        end = this.selectionEnd;
    var originalValue = this.value;

    this.value = this.value.replace(/\d/g, '');

    if (this.value !== originalValue) {
        document.getElementById('error-message-direccion').textContent = 'Solo se permite ingresar caracteres';
    } else {
        document.getElementById('error-message-direccion').textContent = '';
    }

    this.setSelectionRange(start, end);
});

document.getElementById('nombreContacto').addEventListener('input', function (e) {
    var start = this.selectionStart,
        end = this.selectionEnd;
    var originalValue = this.value;

    this.value = this.value.replace(/\d/g, '');

    if (this.value !== originalValue) {
        document.getElementById('error-message-nombreContacto').textContent = 'Solo se permite ingresar caracteres';
    } else {
        document.getElementById('error-message-nombreContacto').textContent = '';
    }

    this.setSelectionRange(start, end);
});

document.getElementById('actividadesMacro').addEventListener('input', function (e) {
    var start = this.selectionStart,
        end = this.selectionEnd;
    var originalValue = this.value;

    this.value = this.value.replace(/\d/g, '');

    if (this.value !== originalValue) {
        document.getElementById('error-message-actividadesMacro').textContent = 'Solo se permite ingresar caracteres';
    } else {
        document.getElementById('error-message-actividadesMacro').textContent = '';
    }

    this.setSelectionRange(start, end);
});

function validateRuc(ruc) {
    var errorMessage = '';

    if (!/^\d+$/.test(ruc)) {
        errorMessage = 'Debe ingresar solo números';
    } else if (ruc.length !== 13) {
        errorMessage = 'Debe ingresar 13 números';
    } else {
        var firstTwoDigits = parseInt(ruc.substring(0, 2), 10);
        if (firstTwoDigits < 1 || firstTwoDigits > 24) {
            errorMessage = 'El RUC no es válido';
        }

        var thirdDigit = parseInt(ruc.substring(2, 3), 10);
        if (thirdDigit !== 9) {
            errorMessage = 'El RUC no es válido';
        }

        var coefficients = [4, 3, 2, 7, 6, 5, 4, 3, 2];
        var sum = 0;
        for (var i = 0; i < coefficients.length; i++) {
            sum += coefficients[i] * parseInt(ruc[i], 10);
        }
        var remainder = sum % 11;
        var checkDigit = 11 - remainder;
        if (checkDigit === 11) {
            checkDigit = 0;
        }
        if (checkDigit !== parseInt(ruc[9], 10)) {
            errorMessage = 'El RUC no es válido';
        }
    }

    document.getElementById('error-message-rucEmpresa').textContent = errorMessage;


    return errorMessage === '';
}


document.getElementById('telefonoContacto').addEventListener('input', function (e) {
    var telefono = e.target.value;
    if (!validateTelefono(telefono)) {
        document.getElementById('error-message-telefono').style.display = 'block';
    } else {
        document.getElementById('error-message-telefono').style.display = 'none';
    }
});

function validateTelefono(telefono) {
    var errorMessage = '';

    if (!/^\d+$/.test(telefono)) {
        errorMessage = 'Debe ingresar solo números';
    } else if (telefono.length !== 10) {
        errorMessage = 'Debe ingresar un número de 10 dígitos';
    } else {
        var firstTwoDigits = telefono.substring(0, 2);
        if (firstTwoDigits !== '08' && firstTwoDigits !== '09') {
            errorMessage = 'El número debe comenzar con 08 o 09';
        }
    }

    if (errorMessage) {
        document.getElementById('error-message-telefono').textContent = errorMessage;
        document.getElementById('error-message-telefono').style.display = 'block';
        return false;
    } else {
        document.getElementById('error-message-telefono').style.display = 'none';
        return true;
    }
}
