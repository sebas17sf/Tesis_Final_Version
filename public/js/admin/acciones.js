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
        a.download = 'report.xlsx'; // specify the file name
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

//VENTANAS EMERGENTES
$(document).ready(function(){
    console.log("Draggable script is running");
    $("#draggableCardNRC").draggable({
        handle: ".card-header",
        containment: "window"
    });
    $("#draggableCardPeriodo").draggable({
        handle: ".card-header",
        containment: "window"
    });
    $("#draggableCardEditarPeriodo").draggable({
        handle: ".card-header",
        containment: "window"
    });
});

function openCard(cardId) {
    $('#' + cardId).css({
        top: '100px', // Adjusted top position to avoid the top navigation bar
        left: '50px' // Adjust as necessary to avoid other elements
    }).show();
}