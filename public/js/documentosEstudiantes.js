$(document).ready(function() {
    // Manejar el clic en el botón para mostrar/ocultar el formulario
    $("#toggleFormBtn").click(function() {
        $("#registroActividades").toggle();
        // Cambiar el texto del botón según si el formulario está visible u oculto
        if ($("#registroActividades").is(":visible")) {
            $(this).text("Ocultar Registro de Actividades");
        } else {
            $(this).text("Registrar Actividad");
        }
    });
});
$(document).ready(function() {
    // Manejar el clic en el botón para mostrar/ocultar el formulario
    $("#toggleFormBtn2").click(function() {
        $("#registroInforme").toggle();
        // Cambiar el texto del botón según si el formulario está visible u oculto
        if ($("#registroInforme").is(":visible")) {
            $(this).text("Ocultar creacion de Informe");
        } else {
            $(this).text("Crear Informe de Servicio a la comunidad");
        }
    });
});

function agregarCampo() {
    var campos = document.getElementById('campos');
    var nuevoCampo = document.createElement('div');
    nuevoCampo.className = 'form-row';
    nuevoCampo.innerHTML = `
        <div class="form-group col-md-4">
            <label><strong>Nuevo Objetivo Específico:</strong></label>
            <textarea name="especificos[]" class="form-control input" rows="4" required></textarea>
        </div>
        <div class="form-group col-md-4">
            <label><strong>Nuevo Resultado Alcanzado:</strong></label>
            <textarea name="alcanzados[]" class="form-control input" rows="4" required></textarea>
        </div>
        <div class="form-group col-md-4">
            <label><strong>Nuevo Porcentaje Alcanzado:</strong></label>
            <textarea name="porcentaje[]" class="form-control input" rows="4" required></textarea>
        </div>
    `;
    campos.appendChild(nuevoCampo);
}

function eliminarCampo() {
    var campos = document.getElementById('campos');
    var camposAdicionales = campos.querySelectorAll('.form-row:not(:first-child)');
    if (camposAdicionales.length > 0) {
        campos.removeChild(camposAdicionales[camposAdicionales.length - 1]);
    }
}