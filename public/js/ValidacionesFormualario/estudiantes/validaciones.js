document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('studentForm');

    const fields = [
        { id: 'Nombres', errorId: 'error-message-name', validation: value => value.trim() !== '' },
        { id: 'espe_id', errorId: 'espe_id_error', validation: value => value.trim() !== '' && value.length === 9 },
        { id: 'Apellidos', errorId: 'error-message-apellidos', validation: value => value.trim() !== '' },
        { id: 'correo', errorId: 'error-message-email', validation: value => /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(value) },
        { id: 'Carrera', errorId: 'error-message-carrera', validation: value => value.trim() !== '' },
        { id: 'departamento', errorId: 'error-message-departamento', validation: value => value.trim() !== '' },
        { id: 'Periodo', errorId: 'error-message-periodo', validation: value => value.trim() !== '' },
        { id: 'celular', errorId: 'error-message-cell', validation: value => value.trim() !== '' && value.length === 9 }
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
            case 'Nombres':
                return 'Debe ingresar sus nombres';
            case 'espe_id':
                return 'El ESPE ID debe tener 9 caracteres.';
            case 'Apellidos':
                return 'Debe ingresar sus apellidos';
            case 'correo':
                return 'Correo no válido';
            case 'Carrera':
                return 'Debe seleccionar una carrera';
            case 'departamento':
                return 'Debe seleccionar un departamento';
            case 'Periodo':
                return 'Debe seleccionar un periodo';
            case 'celular':
                return 'Número de celular no válido';
            default:
                return 'Este campo es requerido';
        }
    }
});
