document.getElementById('loginForm').addEventListener('submit', function(event) {
    const usuario = document.getElementById('CorreoElectronico');
    const contrasena = document.getElementById('Contrasena');
    let valid = true;

     document.getElementById('CorreoElectronicoError').textContent = '';
    document.getElementById('ContrasenaError').textContent = '';

    if (usuario.value.trim() === '') {
        valid = false;
        document.getElementById('CorreoElectronicoError').textContent = 'Por favor, ingrese su usuario.';
        usuario.focus();
    } else if (contrasena.value.trim() === '') {
        valid = false;
        document.getElementById('ContrasenaError').textContent = 'Por favor, ingrese su contraseña.';
        contrasena.focus();
    }

    if (!valid) {
        event.preventDefault();
    }
});
