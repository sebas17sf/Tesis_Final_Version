// Función para validar un campo de entrada de tipo número
 // Function to validate individual inputs in the "Estudiantes por calificar" table
function validateNumberInputCalificar(input) {
    const value = parseFloat(input.value);
    if (value < 0 || value > 10 || isNaN(value)) {
        input.style.borderColor = 'red';
        input.nextElementSibling.innerText = 'El valor debe estar entre 0 y 10.';
        input.nextElementSibling.style.display = 'block';
        return false;
    } else {
        input.style.borderColor = '';
        input.nextElementSibling.innerText = '';
        input.nextElementSibling.style.display = 'none';
        return true;
    }
}

// Add event listeners for real-time validation on the "Estudiantes por calificar" inputs
document.querySelectorAll('.number-input-calificar').forEach(input => {
    input.addEventListener('input', function() {
        validateNumberInputCalificar(input);
    });
});

// Form submission validation for "Estudiantes por calificar"
document.getElementById('formNotasVinculacion').addEventListener('submit', function(event) {
    const inputs = this.querySelectorAll('.number-input-calificar');
    let isValid = true;

    inputs.forEach(input => {
        if (!validateNumberInputCalificar(input)) {
            isValid = false;
        }
    });

    if (!isValid) {
        event.preventDefault();
    }
});

// Function to validate individual inputs in the "Estudiantes Calificados" table
function validateFormCalificados() {
    let inputs = document.querySelectorAll('.validated-input-calificados');
    let valid = true;

    inputs.forEach(input => {
        let value = parseFloat(input.value);
        let errorMessage = input.nextElementSibling;

        if (value < 0 || value > 10 || isNaN(value)) {
            valid = false;
            input.style.borderColor = 'red';
            errorMessage.innerText = 'El valor debe estar entre 0 y 10.';
            errorMessage.style.display = 'block';
        } else {
            input.style.borderColor = '';
            errorMessage.innerText = '';
            errorMessage.style.display = 'none';
        }
    });

    return valid;
}



// Función para validar un campo de entrada de tipo texto
function validateTextInput(input) {
    const value = parseFloat(input.value);
    if (value < 0 || value > 30 || isNaN(value)) {
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

});
