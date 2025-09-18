//Obtenemos elementos del formulario
const formulario = document.getElementById('form-registro-usuario');

//Uso del evento
formulario.addEventListener('submit', function (e) {
    //Controlamos envio del evento
    e.preventDefault();

    //Obtención de valores en cada input
    let cedula_usuario = document.getElementById('cedula').value.trim();
    let nombre_usuario = document.getElementById('nombre').value.trim();
    let apellido_usuario = document.getElementById('apellido').value.trim();

    // Bandera para controlar
    let validar = true;

    // Elementos para controlar errores por campo
    let error_cedula = document.getElementById('error-cedula');
    let error_nombre = document.getElementById('error-nombre');
    let error_apellido = document.getElementById('error-apellido');

    // Condicionales de validación
    if (!cedula_usuario) {
        validar = false;
        error_cedula.textContent = 'Error: la cédula se encuentra vacía';
    } else if (cedula_usuario.length < 8) {
        validar = false;
        error_cedula.textContent = 'Error: la cédula tiene menos de 8 caracteres';
    } else {
        error_cedula.textContent = '';
    }

    if (!nombre_usuario) {
        validar = false;
        error_nombre.textContent = 'Error: el nombre se encuentra vacía';
    } else if (nombre_usuario.length < 10) {
        validar = false;
        error_nombre.textContent = 'Error: el nombre tiene menos de 10 caracteres';
    } else {
        error_nombre.textContent = '';
    }

    if (!apellido_usuario) {
        validar = false;
        error_apellido.textContent = 'Error: el apellido se encuentra vacía';
    } else if (apellido_usuario.length < 10) {
        validar = false;
        error_apellido.textContent = 'Error: el apellido tiene menos de 10 caracteres';
    } else {
        error_apellido.textContent = '';
    }

    if (validar == true) {
        // Envío del formulario
        formulario.submit();
    }
});