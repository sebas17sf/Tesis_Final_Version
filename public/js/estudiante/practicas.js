document.addEventListener('DOMContentLoaded', function () {
    const inputCedula = document.getElementById('CedulaTutorEmpresarial');
    const errorCedula = document.getElementById('errorCedula');

    inputCedula.addEventListener('input', function () { // Cambiado de 'change' a 'input'
        const cedula = inputCedula.value;
        if (cedula.length === 0 || validarCedulaEcuatoriana(cedula)) {
            errorCedula.textContent = ''; // No muestra mensaje si está vacío o es válido
        } else {
            errorCedula.textContent = 'Cédula no válida'; // Muestra mensaje solo si es inválido
        }
    });
});

function validarCedulaEcuatoriana(cedula) {
    if (cedula.length !== 10) {
        return false;
    }

    const digitos = cedula.split('').map(Number);
    const codigoProvincia = digitos[0] * 10 + digitos[1];

    if (codigoProvincia < 1 || codigoProvincia > 24) {
        return false;
    }

    const tercerDigito = digitos[2];
    if (tercerDigito < 0 || tercerDigito > 5) {
        return false;
    }

    const coeficientes = [2, 1, 2, 1, 2, 1, 2, 1, 2];
    let suma = 0;

    coeficientes.forEach((coeficiente, i) => {
        let valor = coeficiente * digitos[i];
        suma += valor > 9 ? valor - 9 : valor;
    });

    const decimoDigito = digitos[9];
    const digitoVerificador = suma % 10 === 0 ? 0 : 10 - (suma % 10);

    return digitoVerificador === decimoDigito;
}


document.addEventListener('DOMContentLoaded', function () {
    const inputNombre = document.getElementById('NombreTutorEmpresarial');
    const errorNombre = document.getElementById('errorNombre');

    inputNombre.addEventListener('input', function () {
        const nombre = inputNombre.value;
        // Verifica si el nombre contiene números
        if (/[0-9]/.test(nombre)) {
            errorNombre.textContent = 'El nombre no debe contener números.';
            // Opcional: Puedes limpiar el input o eliminar los números ingresados
            // inputNombre.value = nombre.replace(/[0-9]/g, '');
        } else {
            errorNombre.textContent = ''; // Limpia el mensaje de error si el nombre es válido
        }
    });
});

document.addEventListener('DOMContentLoaded', function () {
    const inputTelefono = document.getElementById('TelefonoTutorEmpresarial');
    const errorTelefono = document.getElementById('errorTelefono');

    inputTelefono.addEventListener('input', function () {
        const telefono = inputTelefono.value;
        // Esta expresión regular verifica si el número es un móvil (09XXXXXXXX) o un fijo de las principales ciudades
        const regexTelefonoEcuador = /^(09\d{8}|02\d{7}|04\d{7}|03\d{7}|05\d{7}|07\d{7})$/;

        if (!regexTelefonoEcuador.test(telefono)) {
            errorTelefono.textContent = 'Ingrese un número de teléfono ecuatoriano válido.';
        } else {
            errorTelefono.textContent = ''; // Limpia el mensaje de error si el teléfono es válido
        }
    });
});
document.addEventListener('DOMContentLoaded', function () {
    const inputEmail = document.getElementById('EmailTutorEmpresarial');
    const errorEmail = document.getElementById('errorEmail');

    inputEmail.addEventListener('input', function () {
        const email = inputEmail.value;
        // Esta expresión regular es una forma básica de validar un correo electrónico
        const regexEmail = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

        if (!regexEmail.test(email)) {
            errorEmail.textContent = 'Ingrese un correo electrónico válido.';
        } else {
            errorEmail.textContent = ''; // Limpia el mensaje de error si el correo es válido
        }
    });
});


document.addEventListener('DOMContentLoaded', function () {
    const inputHorasPlanificadas = document.getElementById('HorasPlanificadas');
    const errorHorasPlanificadas = document.getElementById('errorHorasPlanificadas');

    inputHorasPlanificadas.addEventListener('input', function () {
        const horas = parseInt(inputHorasPlanificadas.value, 10);

        if (horas !== 144) {
            errorHorasPlanificadas.textContent = 'Debe ingresar exactamente 144 horas.';
        } else {
            errorHorasPlanificadas.textContent = ''; // Limpia el mensaje de error si el valor es 144
        }
    });
});


document.addEventListener('DOMContentLoaded', function () {
    const inputHorasPlanificadas = document.getElementById('HorasPlanificadas');
    const errorHorasPlanificadas = document.getElementById('errorHorasPlanificadas');

    inputHorasPlanificadas.addEventListener('input', function () {
        const horas = parseInt(inputHorasPlanificadas.value, 10);

        if (horas > 144 || horas < 40) {
            errorHorasPlanificadas.textContent = 'Debe ingresar un valor entre 40 y 144 horas.';
            errorHorasPlanificadas.style.color = 'red';
        } else {
            errorHorasPlanificadas.textContent = '';
        }
    });
});


//////si hay errores en practicasForm no se debe enviar el formulario
document.addEventListener('DOMContentLoaded', function () {
    const practicasForm = document.getElementById('practicasForm');

    practicasForm.addEventListener('submit', function (event) {
        const errorCedula = document.getElementById('errorCedula').textContent;
        const errorNombre = document.getElementById('errorNombre').textContent;
        const errorTelefono = document.getElementById('errorTelefono').textContent;
        const errorEmail = document.getElementById('errorEmail').textContent;
        const errorHorasPlanificadas = document.getElementById('errorHorasPlanificadas').textContent;

        if (errorCedula || errorNombre || errorTelefono || errorEmail || errorHorasPlanificadas) {
            event.preventDefault();
        }
    });
});
