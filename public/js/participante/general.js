// Selecciona los campos de entrada
var tabla1 = document.getElementById('tabla1');
var tabla2 = document.getElementById('tabla2');
var tabla3 = document.getElementById('tabla3');
var tabla4 = document.getElementById('tabla4');
var puntajeTotal = document.getElementById('puntajeTotal');

// Función para actualizar el puntaje total
function actualizarPuntajeTotal() {
    var total = Number(tabla1.value) + Number(tabla2.value) + Number(tabla3.value) + Number(tabla4.value);
    puntajeTotal.value = total;
}

// Agrega un evento 'input' a cada campo de entrada para actualizar el puntaje total cuando cambien los valores
tabla1.addEventListener('input', actualizarPuntajeTotal);
tabla2.addEventListener('input', actualizarPuntajeTotal);
tabla3.addEventListener('input', actualizarPuntajeTotal);



document.addEventListener('DOMContentLoaded', function() {
    // Selecciona los campos de entrada y los elementos de error
    var tabla1 = document.getElementById('tabla1');
    var errorTabla1 = document.getElementById('errorTabla1');
    var tabla2 = document.getElementById('tabla2');
    var errorTabla2 = document.getElementById('errorTabla2');
    var tabla3 = document.getElementById('tabla3');
    var errorTabla3 = document.getElementById('errorTabla3');
    var tabla4 = document.getElementById('tabla4');
    var errorTabla4 = document.getElementById('errorTabla4');
    var puntajeTotal = document.getElementById('puntajeTotal');
    var form = document.getElementById('generarBaremoForm');

    // Función para validar el valor de los campos de entrada
     function validarValor(input, errorElement) {
        if (input.value > 10 || input.value % 1 !== 0) {
            errorElement.textContent = 'El valor debe ser un número entero no mayor que 10.';
            return false;
        } else {
            errorElement.textContent = '';
            return true;
        }
    }

    // Función para actualizar el puntaje total
    function actualizarPuntajeTotal() {
        var total = Number(tabla1.value) + Number(tabla2.value) + Number(tabla3.value) + Number(tabla4.value);
        puntajeTotal.value = total;
    }

    // Agrega un evento 'input' a cada campo de entrada para validar su valor y actualizar el puntaje total cuando cambie
    tabla1.addEventListener('input', function() {
        validarValor(tabla1, errorTabla1);
        actualizarPuntajeTotal();
    });
    tabla2.addEventListener('input', function() {
        validarValor(tabla2, errorTabla2);
        actualizarPuntajeTotal();
    });
    tabla3.addEventListener('input', function() {
        validarValor(tabla3, errorTabla3);
        actualizarPuntajeTotal();
    });
    tabla4.addEventListener('input', function() {
        validarValor(tabla4, errorTabla4);
        actualizarPuntajeTotal();
    });

    // Agrega un evento 'submit' al formulario para prevenir su envío si hay errores
    form.addEventListener('submit', function(event) {
        if (!validarValor(tabla1, errorTabla1) || !validarValor(tabla2, errorTabla2) || !validarValor(tabla3, errorTabla3) || !validarValor(tabla4, errorTabla4)) {
            event.preventDefault();
        }
    });
});


