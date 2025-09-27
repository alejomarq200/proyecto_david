<!-- Modal -->
<style>
    .form-control:read-only {
        background-color: #919191f3;
    }
</style>

<head>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<div class="modal fade" id="modalEliminarUsuario" tabindex="-1" aria-labelledby="modalEliminarUsuarioLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEliminarUsuarioLabel">Eliminar Información del usuario</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="controlador/controlador_EliminarUsuarios.php"
                    id="formularioEliminarUsuario">
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Cédula</label>
                        <input type="text" class="form-control" id="cedula_eliminar" name="cedula_eliminar" readonly>
                        <label for="nombre_eliminar" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="nombre_eliminar" name="nombre_eliminar" readonly>
                        <label for="apellido_eliminar" class="form-label">Apellido</label>
                        <input type="text" class="form-control" id="apellido_eliminar" name="apellido_eliminar"
                            readonly>
                    </div>
                    <button type="submit" class="btn btn-success w-100">Eliminar</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    // Inicializar modal y formulario
    const modalElement = document.getElementById("modalEliminarUsuario");
    const formulario1 = document.getElementById('formularioEliminarUsuario');

    // Al abrir la modal: setear nombre/id y limpiar inputs
    modalElement.addEventListener("show.bs.modal", function (event) {
        const button = event.relatedTarget;
        const cedula = button.getAttribute("data-cedula");
        const nombre = button.getAttribute("data-nombre");
        const apellido = button.getAttribute("data-apellido");

        document.getElementById("cedula_eliminar").value = cedula;
        document.getElementById("nombre_eliminar").value = nombre;
        document.getElementById("apellido_eliminar").value = apellido;
    });

    // Capturamos el envío del formulario
    formulario1.addEventListener('submit', function (e) {
        e.preventDefault(); // Evita recargar la página


        Swal.fire({
            title: "¿Está seguro que desea eliminar su información?",
            text: "¡Esta acción no se puede revertir!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Sí, eliminar"
        }).then((result) => {
            if (result.isConfirmed) {
                // Enviar formulario
                formulario1.submit();
            } else {
                // Cerrar modal automáticamente
                const modalInstance = bootstrap.Modal.getInstance(modalElement);
                modalInstance.hide();
                // Resetear formulario
                e.target.reset();
            }
        });
    });
</script>