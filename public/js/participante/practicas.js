document.getElementById('notaTutorEmpresarial').addEventListener('input', function () {
    const valor = parseFloat(this.value); // Convierte el valor a un número flotante
    const mensajeError = document.getElementById('errorMensaje');
    // Verifica si el valor está en el rango permitido o es igual a 0
    if ((valor < 0 || valor > 12) && valor !== 0) {
        mensajeError.textContent = 'Valor no válido';
        mensajeError.style.display = 'inline';
    } else {
        mensajeError.style.display = 'none';
    }
});

 


document.getElementById('cerrarPracticaBtn').addEventListener('click', function (event) {
    event.preventDefault(); // Previene el envío del formulario
    Swal.fire({
        title: '¿Está seguro de finalizar a los estudiantes?',
        text: "Debe verificar que todos los estudiantes hayan generado todos sus documentos antes de finalizar el proceso.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Sí, cerrar práctica!',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('cerrarPracticaForm').submit();
        }
    });
});
