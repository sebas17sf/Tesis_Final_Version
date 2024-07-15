document.getElementById('notaTutorEmpresarial').addEventListener('input', function() {
    const valor = this.value;
    const mensajeError = document.getElementById('errorMensaje');
    if (valor != 12) {
        mensajeError.textContent = 'Valor no válido';
        mensajeError.style.display = 'inline';
    } else {
        mensajeError.style.display = 'none';
    }
});

document.getElementById('notaTutorAcademico').addEventListener('input', function() {
    const valor = this.value;
    const mensajeError = document.getElementById('errorMensajeAcademico');
    if (valor != 8) {
        mensajeError.textContent = 'Valor no válido';
        mensajeError.style.display = 'inline';
    } else {
        mensajeError.style.display = 'none';
    }
});
