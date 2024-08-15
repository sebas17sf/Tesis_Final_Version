function showLoading() {
    document.getElementById('excelIcon').style.display = 'none';
    document.getElementById('loadingIcon').style.display = 'inline-block';
}
function hideLoading() {
    document.getElementById('loadingIcon').style.display = 'none';
    document.getElementById('excelIcon').style.display = 'inline-block';
}
function submitForm(event) {
    event.preventDefault();
    showLoading();
    var form = document.getElementById('reportForm');
    var formData = new FormData(form);
    fetch(form.action, {
        method: 'POST',
        body: formData
    }).then(response => {
        if (response.ok) {
            return response.blob();
        } else {
            throw new Error('Failed to download file');
        }
    }).then(blob => {
        var url = window.URL.createObjectURL(blob);
        var a = document.createElement('a');
        a.href = url;
        a.download = 'Reporte-Docentes.xlsx'; // specify the file name
        document.body.appendChild(a);
        a.click();
        a.remove();
        window.URL.revokeObjectURL(url);
        hideLoading();
        alert('Exportación exitosa: El archivo Excel ha sido creado y descargado con éxito.');
    }).catch(error => {
        console.error('Error:', error);
        hideLoading();
        alert('Error de Exportación: Hubo un problema al crear el archivo Excel. Por favor, inténtelo de nuevo.');
    });
}



document.addEventListener('DOMContentLoaded', (event) => {
    // Selecciona el elemento de la alerta
    const alertElement = document.querySelector('.contenedor_alerta');
    // Establece un temporizador para ocultar la alerta después de 2 segundos
    setTimeout(() => {
        if (alertElement) {
            alertElement.style.display = 'none';
        }
    }, 2000); // 2000 milisegundos = 2 segundos
});




function copyDataToClipboard(event) {
    const button = event.currentTarget;
    const icon = button.querySelector('#icon');
    const dataForClipboard = formatDataForClipboard();

    navigator.clipboard.writeText(dataForClipboard).then(() => {
        // Cambia el ícono al de verificación
        toggleIcon(icon, true);
        // Vuelve al ícono original después de 1 segundo
        setTimeout(() => toggleIcon(icon, false), 1000);
        console.log('Los datos han sido copiados en el portapapeles.');
    }).catch((err) => {
        console.error('Error al copiar!', err);
        alert('Hubo un error al copiar los datos en el portapapeles.');
    });
}

function toggleIcon(icon, isCheck) {
    if (isCheck) {
        icon.classList.remove('fa-regular', 'fa-copy');
        icon.classList.add('fa-solid', 'fa-circle-check');
    } else {
        icon.classList.remove('fa-solid', 'fa-circle-check');
        icon.classList.add('fa-regular', 'fa-copy');
    }
}

// Formatea los datos para el portapapeles
function formatDataForClipboard() {
    const table = document.getElementById('professorsTable');
    const headers = Array.from(table.querySelectorAll('thead th'))
        .slice(0, -1) // Excluye el último encabezado ("Acciones")
        .map(th => th.innerText.trim())
        .join('\t');
    const rows = table.querySelectorAll('tbody tr');
    let data = headers + '\n';

    rows.forEach(row => {
        const cells = row.querySelectorAll('td');
        if (cells.length > 0) {  // Asegúrate de que hay celdas para procesar
            const rowData = Array.from(cells)
                .slice(0, -1) // Excluye la última celda (acciones)
                .map(cell => cell.innerText.trim())
                .join('\t');
            data += rowData + '\n';
        }
    });

    return data.trim(); // Elimina cualquier carácter de nueva línea al final
}
function submitForm(event) {
    event.preventDefault();
    showLoading();

    var form = document.getElementById('reportForm1');
    var formData = new FormData(form);

    fetch(form.action, {
        method: 'POST',
        body: formData
    }).then(response => {
        if (response.ok) {
            return response.blob();
        } else {
            throw new Error('Failed to download file');
        }
    }).then(blob => {
        var url = window.URL.createObjectURL(blob);
        var a = document.createElement('a');
        a.href = url;
        a.download = 'AsignacionReporte.xlsx'; // specify the file name
        document.body.appendChild(a);
        a.click();
        a.remove();
        window.URL.revokeObjectURL(url);
        hideLoading();
        showAlert('successAlert');
    }).catch(error => {
        console.error('Error:', error);
        hideLoading();
        showAlert('errorAlert');
    });
}

function showAlert(alertId, message, type = 'success') {
    const alert = document.getElementById(alertId);
    alert.querySelector('.body').textContent = message;
    alert.style.display = 'flex';
    
    let timeoutDuration = 5000; // Duración por defecto: 5 segundos
    
    if (type === 'error') {
        timeoutDuration = 10000; // Duración extendida para errores: 10 segundos
    }
    
    setTimeout(() => {
        closeAlert(alertId);
    }, timeoutDuration);
}

function closeAlert(alertId) {
    const alert = document.getElementById(alertId);
    alert.style.display = 'none';
}


function closeAlert(alertId) {
    const alert = document.getElementById(alertId);
    alert.style.display = 'none';
}
// Asegurarse de que el evento de clic esté registrado
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.icon_remove button').forEach(button => {
        button.addEventListener('click', function () {
            const alertId = this.closest('.contenedor_alerta').id;
            closeAlert(alertId);
        });
    });
});

function copyDataToClipboard(event) {
    const button = event.currentTarget;
    const icon = button.querySelector('#icon');
    const dataForClipboard = formatDataForClipboard();

    navigator.clipboard.writeText(dataForClipboard).then(() => {
        // Cambia el ícono al de verificación
        toggleIcon(icon, true);
        // Vuelve al ícono original después de 1 segundo
        setTimeout(() => toggleIcon(icon, false), 1000);
        console.log('Los datos han sido copiados en el portapapeles.');
    }).catch((err) => {
        console.error('Error al copiar!', err);
        alert('Hubo un error al copiar los datos en el portapapeles.');
    });
}

function toggleIcon(icon, isCheck) {
    if (isCheck) {
        icon.classList.remove('fa-regular', 'fa-copy');
        icon.classList.add('fa-solid', 'fa-circle-check');
    } else {
        icon.classList.remove('fa-solid', 'fa-circle-check');
        icon.classList.add('fa-regular', 'fa-copy');
    }
}

// Formatea los datos para el portapapeles
function formatDataForClipboard() {
    const table = document.getElementById('professorsTable');
    const headers = Array.from(table.querySelectorAll('thead th'))
        .slice(0, -1) // Excluye el último encabezado ("Acciones")
        .map(th => th.innerText.trim())
        .join('\t');
    const rows = table.querySelectorAll('tbody tr');
    let data = headers + '\n';

    rows.forEach(row => {
        const cells = row.querySelectorAll('td');
        if (cells.length > 0) {  // Asegúrate de que hay celdas para procesar
            const rowData = Array.from(cells)
                .slice(0, -1) // Excluye la última celda (acciones)
                .map(cell => cell.innerText.trim())
                .join('\t');
            data += rowData + '\n';
        }
    });

    return data.trim(); // Elimina cualquier carácter de nueva línea al final
}

function openCard(cardId) {
    var card = document.getElementById(cardId);
    card.style.display = 'block';
}

function closeCard(cardId) {
    var card = document.getElementById(cardId);
    card.style.display = 'none';
}

function displayFileName(input) {
    const fileName = input.files[0].name;
    document.getElementById('fileText').innerHTML = '<i class="fa fa-upload"></i> ' + fileName;
    document.querySelector('.remove-icon').style.display = 'block';
}

function removeFile() {
    const input = document.getElementById('evidencias');
    input.value = ""; // Clear the input
    document.getElementById('fileText').innerHTML = '<i class="fa fa-upload"></i> Haz clic aquí para subir el documento'; // Reset the text
    document.querySelector('.remove-icon').style.display = 'none';
}

$(document).ready(function () {
    $(".draggable-card").draggable({
        handle: ".card-header",
        containment: "window"
    });
});
$(document).ready(function () {
    $(".draggable-card1_1").draggable({
        handle: ".card-header",
        containment: "window"
    });
});
$(document).ready(function () {
    // Hacer que los cards sean draggable
    $('.draggable-card1_4').draggable({
        handle: ".card-header",
        containment: "window"
    });
});

$(document).ready(function () {
    // Hacer que los cards sean draggable
    $('.draggable-card1_2').draggable({
        handle: ".card-header",
        containment: "window"
    });
});

$(document).ready(function () {
    $(".draggable-card1").draggable({
        handle: ".card-header",
        containment: "window"
    });
});
function makeElementDraggable(element) {
    let pos1 = 0, pos2 = 0, pos3 = 0, pos4 = 0;

    if (element.querySelector('.card-header')) {
        element.querySelector('.card-header').onmousedown = dragMouseDown;
    } else {
        element.onmousedown = dragMouseDown;
    }

    function dragMouseDown(e) {
        e = e || window.event;
        e.preventDefault();
        pos3 = e.clientX;
        pos4 = e.clientY;
        document.onmouseup = closeDragElement;
        document.onmousemove = elementDrag;
    }

    function elementDrag(e) {
        e = e || window.event;
        e.preventDefault();
        pos1 = pos3 - e.clientX;
        pos2 = pos4 - e.clientY;
        pos3 = e.clientX;
        pos4 = e.clientY;
        element.style.top = (element.offsetTop - pos2) + "px";
        element.style.left = (element.offsetLeft - pos1) + "px";
    }

    function closeDragElement() {
        document.onmouseup = null;
        document.onmousemove = null;
    }
}

$(document).ready(function () {
    $('.draggable-card').each(function () {
        makeElementDraggable(this);
    });
});

$(document).ready(function() {
    $('#practicasMenu').click(function() {
        $('#practicasSubmenu').slideToggle('fast');
        // Alternar el ícono
        var icon = $(this).find('.icon-sidebar-item-list i');
        icon.toggleClass('fa-angle-down fa-angle-up');
    });
});