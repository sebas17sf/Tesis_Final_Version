document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('participantForm');

    const fields = [
        { id: 'nombres', errorId: 'error-nombre', validation: value => value.trim() !== '' },
        { id: 'apellidos', errorId: 'error-apellidos', validation: value => value.trim() !== '' },
        { id: 'correo', errorId: 'correoError', validation: value => /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(value) },
        { id: 'cedula', errorId: 'cedulaError', validation: value => value.trim() !== '' && value.length === 10 },
        { id: 'espe_id', errorId: 'espeIdError', validation: value => value.trim() !== '' },
        { id: 'departamento', errorId: 'departamentoError', validation: value => value.trim() !== '' }
    ];

    form.addEventListener('submit', function(event) {
        let valid = true;

        fields.forEach(({ id, errorId, validation }) => {
            const input = document.getElementById(id);
            const errorElement = document.getElementById(errorId);

            if (!validation(input.value)) {
                errorElement.textContent = getErrorMessage(id);
                errorElement.style.display = 'block';
                valid = false;
            } else {
                errorElement.style.display = 'none';
            }
        });

        if (!valid) {
            event.preventDefault();
        }
    });

    // Añadir eventos input/change para esconder los errores cuando el usuario corrige el campo
    fields.forEach(({ id, errorId, validation }) => {
        const input = document.getElementById(id);
        const errorElement = document.getElementById(errorId);

        input.addEventListener('input', function() {
            if (validation(input.value)) {
                errorElement.style.display = 'none';
            }
        });
    });

    function getErrorMessage(id) {
        switch(id) {
            case 'nombres':
                return 'Debe ingresar sus nombres';
            case 'apellidos':
                return 'Debe ingresar sus apellidos';
            case 'correo':
                return 'Correo no válido';
            case 'cedula':
                return 'Debe ingresar una cédula válida de 10 dígitos';
            case 'espe_id':
                return 'Debe ingresar un ID de ESPE válido';
            case 'departamento':
                return 'Debe seleccionar un departamento';
            default:
                return 'Este campo es requerido';
        }
    }
});
