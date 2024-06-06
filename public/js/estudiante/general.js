document.getElementById('cedula').addEventListener('input', function (e) {
    var cedula = e.target.value;
    if (!validateCedula(cedula)) {
        document.getElementById('error-message').style.display = 'block';
    } else {
        document.getElementById('error-message').style.display = 'none';
    }
});

function validateCedula(cedula) {
    if (cedula.length !== 10) {
        return false;
    }

    var provinceCode = parseInt(cedula.substring(0, 2));
    if (provinceCode < 1 || provinceCode > 24) {
        return false;
    }

    var thirdDigit = parseInt(cedula.substring(2, 3));
    if (thirdDigit >= 6) {
        return false;
    }

    var digits = cedula.split('').map(Number);
    var total = 0;
    for (var i = 0; i < 9; i++) {
        var value = i % 2 === 0 ? digits[i] * 2 : digits[i];
        total += value > 9 ? value - 9 : value;
    }
    var verificationDigit = total % 10 === 0 ? 0 : 10 - (total % 10);

    return digits[9] === verificationDigit;
}

document.getElementById('celular').addEventListener('input', function (e) {
    var celular = e.target.value;
    if (!validateCelular(celular)) {
        document.getElementById('error-message-cell').style.display = 'block';
    } else {
        document.getElementById('error-message-cell').style.display = 'none';
    }
});

function validateCelular(celular) {
    if (celular.length !== 10) {
        return false;
    }

    var firstTwoDigits = celular.substring(0, 2);
    if (firstTwoDigits !== '08' && firstTwoDigits !== '09') {
        return false;
    }

    return true;
}

document.getElementById('Nombres').addEventListener('input', function (e) {
    var nombres = e.target.value;
    if (!validateNombres(nombres)) {
        document.getElementById('error-message-name').style.display = 'block';
    } else {
        document.getElementById('error-message-name').style.display = 'none';
    }
});

function validateNombres(nombres) {
    var regex = /^[A-Za-zÁ-úñÑ\s]+$/;
    return regex.test(nombres);
}

document.getElementById('Apellidos').addEventListener('input', function (e) {
    var apellidos = e.target.value;
    if (!validateApellidos(apellidos)) {
        document.getElementById('error-message-apellidos').style.display = 'block';
    } else {
        document.getElementById('error-message-apellidos').style.display = 'none';
    }
});

function validateApellidos(apellidos) {
     var regex = /^[A-Za-zÁ-úñÑ\s]+$/;
    return regex.test(apellidos);
}

document.getElementById('espe_id').addEventListener('input', function (e) {
    const regex = /^[a-zA-Z0-9]{1,9}$/;
    const errorMessage = document.getElementById('espe_id_error');
    if (!regex.test(this.value)) {
        errorMessage.style.display = 'block';
    } else {
        errorMessage.style.display = 'none';
    }
});
