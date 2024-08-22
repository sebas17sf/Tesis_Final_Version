document.addEventListener("DOMContentLoaded", function () {
    let time;
    let timerInterval;
    const inactivityLimit = 5 * 60 * 1000; // 5 minutos de inactividad en milisegundos
    const countdownStart = 5 * 60; // 5 minutos en segundos para el temporizador

    // Función para crear la estructura HTML de la alerta
    function createAlert() {
        // Crear el overlay
        const overlay = document.createElement('div');
        overlay.className = 'custom-overlay-time';
        overlay.id = 'overlay';
        overlay.style.display = 'none';

        // Crear la alerta principal
        const alertBox = document.createElement('div');
        alertBox.className = 'content_alert_session';
        alertBox.id = 'alert';
        alertBox.style.display = 'none';

        // Crear el contenedor del icono
        const iconContainer = document.createElement('div');
        iconContainer.className = 'content_icono';

        const iconImg = document.createElement('img');
        iconImg.src = '/img/default/iconTiempo.png'; // Cambiado a PNG para soporte de transparencia
        iconImg.alt = 'Icono';
        iconImg.style.width = '70px'; // Ajusta el tamaño según sea necesario
        iconImg.style.height = '70px'; // Ajusta el tamaño según sea necesario
        iconContainer.appendChild(iconImg);

        // Crear el contenedor del tiempo
        const timeContainer = document.createElement('div');
        timeContainer.className = 'contenedor_time';

        const timer = document.createElement('div');
        timer.className = 'timer';
        timer.textContent = formatTime(countdownStart);
        timeContainer.appendChild(timer);

        // Crear el contenedor del texto
        const textContainer = document.createElement('div');
        textContainer.className = 'content_text';

        const text1 = document.createElement('div');
        text1.className = 'text1';
        text1.textContent = 'Tu sesión está a punto de terminar';

        const text2 = document.createElement('div');
        text2.className = 'text2';
        text2.textContent = '¿Deseas mantener tu sesión activa?';

        textContainer.appendChild(text1);
        textContainer.appendChild(text2);

        // Crear el contenedor de los botones
        const buttonContainer = document.createElement('div');
        buttonContainer.className = 'content_button';

        const continueButton = document.createElement('div');
        continueButton.textContent = 'Mantener sesión';
        continueButton.style.cursor = 'pointer';

        const logoutButton = document.createElement('div');
        logoutButton.textContent = 'Salir';
        logoutButton.style.cursor = 'pointer';

        buttonContainer.appendChild(continueButton);
        buttonContainer.appendChild(logoutButton);

        // Añadir todos los elementos al alertBox
        alertBox.appendChild(iconContainer); // Añadir el icono primero
        alertBox.appendChild(timeContainer); // Luego el tiempo
        alertBox.appendChild(textContainer); // Luego los textos
        alertBox.appendChild(buttonContainer); // Finalmente los botones

        // Añadir el overlay y el alertBox al body
        document.body.appendChild(overlay);
        document.body.appendChild(alertBox);

        // Asignar eventos a los botones
        continueButton.onclick = function () {
            hideAlert();
            resetTimer(); // Reinicia el temporizador al hacer clic en "Mantener sesión"
        };

        logoutButton.onclick = function () {
            window.location.href = '/logout'; // Redirigir a la ruta de logout
        };
    }

    // Formatear el tiempo en minutos y segundos
    function formatTime(seconds) {
        const minutes = Math.floor(seconds / 60);
        const remainingSeconds = seconds % 60;
        return `0${minutes}:${remainingSeconds < 10 ? '0' : ''}${remainingSeconds}`;
    }

    // Muestra la alerta
    function showAlert() {
        document.getElementById("overlay").style.display = "block";
        document.getElementById("alert").style.display = "grid";
        startTimer();
    }

    // Oculta la alerta
    function hideAlert() {
        document.getElementById("overlay").style.display = "none";
        document.getElementById("alert").style.display = "none";
        clearInterval(timerInterval);
    }

    // Temporizador para la alerta
    function startTimer() {
        let countdown = countdownStart;
        const timerElement = document.querySelector(".timer");

        timerInterval = setInterval(() => {
            countdown--;
            timerElement.textContent = formatTime(countdown);
            if (countdown === 0) {
                clearInterval(timerInterval);
                window.location.href = '/logout'; // Redirigir automáticamente cuando llegue a 0
            }
        }, 1000);
    }

    // Restablece el temporizador de inactividad
    function resetTimer() {
        clearTimeout(time);
        time = setTimeout(showAlert, inactivityLimit);  // Mostrar la alerta después de 5 minutos de inactividad
    }

    // Crear la alerta al cargar la página
    createAlert();

    // Eventos que reinician el temporizador de inactividad
    window.onload = resetTimer;
    document.onmousemove = resetTimer;
    document.onkeypress = resetTimer;
    document.ontouchstart = resetTimer; // Para dispositivos táctiles
});
