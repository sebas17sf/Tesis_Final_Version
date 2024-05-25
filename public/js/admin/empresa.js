document.getElementById('rucEmpresa').addEventListener('input', function (e) {
    var ruc = e.target.value;
    if (!validateRuc(ruc)) {
        document.getElementById('error-message-ruc').style.display = 'block';
    } else {
        document.getElementById('error-message-ruc').style.display = 'none';
    }
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


document.getElementById('nombreEmpresa').addEventListener('input', function (e) {
    var nombre = e.target.value;
    if (!validateNombre(nombre)) {
        document.getElementById('error-message-nombre').style.display = 'block';
    } else {
        document.getElementById('error-message-nombre').style.display = 'none';
    }
});

function validateNombre(nombre) {
     var regex = /^[A-Za-zÁ-úñÑ\s]+$/;
    return regex.test(nombre);
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
    if (telefono.length !== 10) {
        return false;
    }

    var firstTwoDigits = telefono.substring(0, 2);
    if (firstTwoDigits !== '08' && firstTwoDigits !== '09') {
        return false;
    }

    return true;
}
