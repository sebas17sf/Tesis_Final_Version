// Función para validar un campo de entrada de tipo número
function validateNumberInput(input) {
    const value = parseFloat(input.value);
    if (value < 1 || value > 10 || isNaN(value)) {
        input.style.borderColor = 'red';
        input.nextElementSibling.innerText = 'El valor debe estar entre 1 y 10.';
        input.nextElementSibling.style.display = 'block';
        return false; // Retorna false si hay errores
    } else {
        input.style.borderColor = '';
        input.nextElementSibling.innerText = '';
        input.nextElementSibling.style.display = 'none';
        return true; // Retorna true si no hay errores
    }
}

// Función para validar un campo de entrada de tipo texto
function validateTextInput(input) {
    const value = parseFloat(input.value);
    if (value < 1 || value > 30 || isNaN(value)) {
        input.style.borderColor = 'red';
        input.nextElementSibling.innerText = 'El valor debe estar entre 1 y 30.';
        input.nextElementSibling.style.display = 'block';
        return false; // Retorna false si hay errores
    } else {
        input.style.borderColor = '';
        input.nextElementSibling.innerText = '';
        input.nextElementSibling.style.display = 'none';
        return true; // Retorna true si no hay errores
    }
}

// Event listener para campos de tipo número
document.querySelectorAll('input[type="number"]').forEach(input => {
    input.addEventListener('blur', function() {
        validateNumberInput(this);
    });
});

// Event listener para campos de tipo texto
document.querySelectorAll('input[type="text"]').forEach(input => {
    input.addEventListener('blur', function() {
        validateTextInput(this);
    });
});

// Event listener para el formulario
document.querySelector('form').addEventListener('submit', function(event) {
    let hasErrors = false;

    // Validar campos de tipo número
    document.querySelectorAll('input[type="number"]').forEach(input => {
        if (!validateNumberInput(input)) {
            hasErrors = true;
        }
    });

    // Validar campos de tipo texto
    document.querySelectorAll('input[type="text"]').forEach(input => {
        if (!validateTextInput(input)) {
            hasErrors = true;
        }
    });

    // Prevenir el envío del formulario si hay errores
    if (hasErrors) {
        event.preventDefault();
    }
});
