$("#toggleFormBtn2").click(function (event) {
    event.preventDefault();
    $("#registrarPeriodos").toggle();
    if ($("#registrarPeriodos").is(":visible")) {
        $(this).text("Ocultar Registro");
        localStorage.setItem('periodosVisible', 'true');
    } else {
        $(this).text("Cargar Actividades de la practica");
        localStorage.setItem('periodosVisible', 'false');
    }
});
 
 ////////////////del modalAgregarActividad no perder los datos cuandos se envie en el form

 