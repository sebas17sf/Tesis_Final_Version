 document.getElementById('nombres').addEventListener('keypress', function (event) {
    var charCode = (event.which) ? event.which : event.keyCode;
    if (charCode >= 48 && charCode <= 57) {
        event.preventDefault();
        document.getElementById('error-nombre').textContent = "Los números no están permitidos.";
        return false;
    }
    document.getElementById('error-nombre').textContent = "";
    return true;
});

document.getElementById('apellidos').addEventListener('keypress', function (event) {
    var charCode = (event.which) ? event.which : event.keyCode;
    if (charCode >= 48 && charCode <= 57) {
        event.preventDefault();
        document.getElementById('error-apellidos').textContent = "Los números no están permitidos.";
        return false;
    }
    document.getElementById('error-apellidos').textContent = "";
    return true;
});

document.getElementById('correo').addEventListener('blur', function () {
    var correo = this.value;
    var regex = /^[\w-]+(\.[\w-]+)*@([\w-]+\.)+[a-zA-Z]{2,7}$/;
    if (!regex.test(correo)) {
        document.getElementById('correoError').textContent = "Por favor, ingrese un correo válido.";
        document.getElementById('correoError').style.display = "block";
    } else {
        document.getElementById('correoError').textContent = "";
        document.getElementById('correoError').style.display = "none";
    }
});

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
        document.getElementById('cedulaError').textContent = "Por favor, ingrese una cédula válida.";
        document.getElementById('cedulaError').style.display = "block";
    } else {
        document.getElementById('cedulaError').textContent = "";
        document.getElementById('cedulaError').style.display = "none";
    }
});

document.getElementById('espe_id').addEventListener('input', function () {
    var espeId = this.value;
    if (espeId.length !== 9) {
        document.getElementById('espeIdError').textContent = "Por favor, ingrese un ID de la ESPE válido con exactamente 9 caracteres.";
        document.getElementById('espeIdError').style.display = "block";
    } else {
        document.getElementById('espeIdError').textContent = "";
        document.getElementById('espeIdError').style.display = "none";
    }
});

document.querySelector('form').addEventListener('submit', function (event) {
    var errores = document.querySelectorAll('.form-text.text-danger');
    for (var i = 0; i < errores.length; i++) {
        if (errores[i].textContent !== "" && errores[i].style.display !== "none") {
            event.preventDefault();
            return false;
        }
    }
    return true;
});




