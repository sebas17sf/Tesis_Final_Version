// Variable para almacenar el temporizador
let timer;

// Función para mantener viva la sesión con AJAX
function keepSessionAlive() {
    $.ajax({
        url: window.routes.keepAlive,  // Ruta a tu método keepAlive en el controlador SessionController
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')  // Necesario para protección CSRF en Laravel
        },
        success: function(response) {
            if (response.success) {
                console.log('Tiempo de sesión extendido.');
                updateLastActivityTime(); // Actualizar el tiempo de última actividad después de extender la sesión
                checkSessionStatus(); // Verificar el estado de la sesión después de extenderla
            } else {
                console.error('Error al mantener viva la sesión:', response.message || 'Unknown error');
            }
        },
        error: function(xhr, status, error) {
            console.error('Error en la solicitud AJAX:', error);
        }
    });
}

// Función para verificar el estado de la sesión y mostrar alerta si es necesario
function checkSessionStatus() {
    $.ajax({
        url: '/check-session-status',  // Ruta a tu método checkSessionStatus en el controlador SessionController
        method: 'GET',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')  // Necesario para protección CSRF en Laravel
        },
        success: function(response) {
            if (response.success) {
                let timeRemaining = response.timeRemaining;
                let halfTimeRemaining = response.halfTimeRemaining;

                if (timeRemaining !== undefined && halfTimeRemaining !== undefined && timeRemaining <= halfTimeRemaining) {
                    showSessionAlert(timeRemaining); // Llamar a showSessionAlert con el tiempo restante
                } else {
                    // Actualizar el contador de tiempo restante a la mitad
                    updateHalfTimeRemaining(halfTimeRemaining);
                }
            } else {
                console.error('Error al verificar el estado de la sesión:', response.message || 'Unknown error');
            }
        },
        error: function(xhr, status, error) {
            console.error('Error en la solicitud AJAX:', error);
        }
    });
}

// Función para mostrar la alerta de sesión
function showSessionAlert(timeRemaining) {
    Swal.fire({
        title: 'Tu sesión está a punto de expirar',
        html: `<div>Tu sesión se cerrará automáticamente en:</div><br><div id='countdown'></div>`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#7066e0',
        cancelButtonColor: '#808080',
        confirmButtonText: 'Mantener sesión',
        cancelButtonText: 'Salir',
        allowOutsideClick: false,
        timer: timeRemaining * 60 * 1000, // Tiempo en milisegundos
        timerProgressBar: true,
        didOpen: () => {
            const content = Swal.getHtmlContainer();
            if (content) {
                const countdownElement = content.querySelector('#countdown');
                if (countdownElement) {
                    const endTime = Date.now() + (timeRemaining * 60 * 1000);
                    updateCountdown(countdownElement, endTime); // Iniciar el contador hacia atrás
                }
            }
        },
        willClose: () => {
            clearInterval(timer);
        }
    }).then((result) => {
        if (result.isConfirmed) {
            fetch(window.routes.keepAlive, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Content-Type': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    Swal.fire({
                        title: 'Sesión extendida',
                        text: 'Tu sesión se ha extendido exitosamente.',
                        icon: 'success',
                        allowOutsideClick: false
                    });
                    resetTimer(); // Reiniciar el temporizador después de extender la sesión
                } else {
                    Swal.fire({
                        title: 'Error',
                        text: 'No se pudo extender la sesión.',
                        icon: 'error',
                        allowOutsideClick: false
                    });
                }
            });
        } else {
            window.location.href = window.routes.logout;
        }
    });
}

// Función para actualizar dinámicamente el contador hacia atrás
function updateCountdown(element, endTime) {
    const timerInterval = setInterval(() => {
        const remainingTime = Math.floor((endTime - Date.now()) / 1000);

        if (remainingTime <= 0) {
            clearInterval(timerInterval);
            window.location.href = window.routes.logout; // Redirigir a logout cuando el tiempo se agote
        } else {
            const minutes = Math.floor(remainingTime / 60);
            const seconds = remainingTime % 60;
            element.textContent = `${minutes} minutos y ${seconds} segundos`;
        }
    }, 1000);
}

// Función para actualizar dinámicamente el tiempo restante a la mitad
function updateHalfTimeRemaining(halfTimeRemaining) {
    const halfTimeElement = document.getElementById('halfTimeRemaining');
    if (halfTimeElement) {
        halfTimeElement.textContent = `${halfTimeRemaining} minutos`;
    }
}

// Variable para almacenar el tiempo de la última actividad
let lastActivityTime = Date.now();

// Umbral de tiempo de inactividad en milisegundos (por ejemplo, 1 minuto)
const INACTIVITY_THRESHOLD = 60000;

// Variable para controlar si ya se envió la solicitud de actualización
let updateRequested = false;

// Función para actualizar el tiempo de última actividad
function updateLastActivityTime() {
    lastActivityTime = Date.now();
}

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
                if (response.success) {
                    updateRequested = true; // Marcar que la solicitud se ha enviado
                    setTimeout(() => {
                        updateRequested = false; // Permitir nuevas solicitudes después de un tiempo
                    }, INACTIVITY_THRESHOLD); // Puedes ajustar el tiempo según tus necesidades
                }
            },
            error: function(xhr, status, error) {
                console.error('Error en la solicitud AJAX:', error);
            }
        });
    }
}

// Llamar checkInactiveTime al cargar la página para inicializar la sesión
$(document).ready(function() {
    checkInactiveTime();

    // Consultar el estado de la sesión periódicamente
    setInterval(checkSessionStatus, INACTIVITY_THRESHOLD); // Ajusta el intervalo según tus necesidades

    // Detectar actividad del usuario
    $(document).on('mousemove keydown scroll', function() {
        lastActivityTime = Date.now(); // Actualizar el tiempo de última actividad
        clearTimeout(timer);  // Reiniciar el temporizador en cada actividad
        timer = setTimeout(checkInactiveTime, INACTIVITY_THRESHOLD);  // Llamar checkInactiveTime después del tiempo de inactividad

        // Llamar a la función para actualizar token_expires_at a null si se asignó un tiempo previamente
        updateTokenExpiration();
    });
});
