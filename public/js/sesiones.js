// sessions.js

// Variable para almacenar el temporizador
let timer;

// Función para mantener viva la sesión con AJAX
function keepSessionAlive() {
    console.log('Llamando a keepSessionAlive');
    $.ajax({
        url: '/keep-alive',  // Ruta a tu método keepAlive en el controlador SessionController
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')  // Necesario para protección CSRF en Laravel
        },
        success: function(response) {
            console.log('Respuesta de keep-alive:', response);
            if (response.success) {
                // Mostrar mensaje en la consola si se asigna tiempo debido a inactividad
                console.log('Tiempo de sesión asignado debido a la inactividad del sistema.');

                // Si se debe mostrar la alerta al usuario, puedes hacerlo aquí
                if (response.showAlert) {
                    // Mostrar alerta o realizar alguna acción
                    console.log('Mostrar alerta de sesión próxima a expirar');
                }
            } else {
                console.error('Error al mantener viva la sesión:', response.error);
            }
        },
        error: function(xhr, status, error) {
            console.error('Error en la solicitud AJAX:', error);
        }
    });
}

// Variable para almacenar el tiempo de la última actividad
let lastActivityTime = Date.now();

// Umbral de tiempo de inactividad en milisegundos (por ejemplo, 1 minuto)
const INACTIVITY_THRESHOLD = 60000;

// Variable para controlar si ya se envió la solicitud de actualización
let updateRequested = false;

// Función para verificar si ha pasado un tiempo de inactividad y llamar a keepSessionAlive()
function checkInactiveTime() {
    let currentTime = Date.now();
    if (currentTime - lastActivityTime >= INACTIVITY_THRESHOLD) {
        keepSessionAlive(); // Llamar a keepSessionAlive solo si ha pasado el tiempo de inactividad
    } else {
        // Reiniciar el temporizador para verificar nuevamente después del tiempo restante
        clearTimeout(timer);
        timer = setTimeout(checkInactiveTime, INACTIVITY_THRESHOLD - (currentTime - lastActivityTime));

    }
}

// Función para enviar solicitud al servidor y establecer token_expires_at a null si hay actividad
function updateTokenExpiration() {
    if (!updateRequested) { // Verificar si la solicitud ya se ha enviado
        $.ajax({
            url: '/update-token-expiration',  // Ruta a tu método en el controlador para actualizar token_expires_at
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')  // Necesario para protección CSRF en Laravel
            },
            success: function(response) {

                updateRequested = true; // Marcar que la solicitud se ha enviado
            },
            error: function(xhr, status, error) {
             
            }
        });
    }
}

// Llamar checkInactiveTime al cargar la página para inicializar la sesión
$(document).ready(function() {
    console.log('Sistema inicializado correctamente.');

    checkInactiveTime();

    // Detectar actividad del usuario
    $(document).on('mousemove keydown scroll', function() {
        lastActivityTime = Date.now(); // Actualizar el tiempo de última actividad
        console.log('Actividad detectada. Nuevo tiempo de última actividad:', lastActivityTime);
        clearTimeout(timer);  // Reiniciar el temporizador en cada actividad
        timer = setTimeout(checkInactiveTime, INACTIVITY_THRESHOLD);  // Llamar checkInactiveTime después del tiempo de inactividad

        // Llamar a la función para actualizar token_expires_at a null si se asignó un tiempo previamente
        updateTokenExpiration();
    });
});
