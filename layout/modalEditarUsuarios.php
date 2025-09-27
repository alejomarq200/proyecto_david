<!-- Modal -->
<style>
    .form-control:read-only{
        background-color: #919191f3;
    }
</style>

<div class="modal fade" id="formModal" tabindex="-1" aria-labelledby="formModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="formModalLabel">Editar Información del usuario</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="controlador/controlador_EditarUsuarios.php" id="formularioEditarUsuario">
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Cédula</label>
                        <input type="text" class="form-control" id="cedula" name="cedula" readonly>
                        <label for="nombre" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" required>
                        <label for="nombre" class="form-label">Apellido</label>
                        <input type="text" class="form-control" id="apellido" name="apellido" required>
                    </div>
                    <button type="submit" class="btn btn-success w-100">Enviar</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    // Inicializar modal y formulario
    const modal = document.getElementById("formModal");
    const formulario = document.getElementById('formularioEditarUsuario');

    // Al abrir la modal: setear nombre/id y limpiar inputs
    modal.addEventListener("show.bs.modal", function (event) {
        // Se iguala evento a un botón
        const button = event.relatedTarget;
        const cedula = button.getAttribute("data-cedula");
        const nombre = button.getAttribute("data-nombre");
        const apellido = button.getAttribute("data-apellido");

        document.getElementById("cedula").value = cedula;
        document.getElementById("nombre").value = nombre;
        document.getElementById("apellido").value = apellido;
    });



    // Capturamos el envío del formulario
    formulario.addEventListener('submit', function (e) {
        e.preventDefault(); // Evita recargar la página
        
        alert('Formulario enviado correctamente');
        // Cerrar modal automáticamente
        const modal = bootstrap.Modal.getInstance(document.getElementById('formModal'));
        modal.hide();
        // Enviar formulario
            formulario.submit();   
        // Resetear formulario
        e.target.reset();
    });
</script>