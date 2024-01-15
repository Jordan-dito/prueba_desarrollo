<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Gestión de Profesores</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap4.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.all.min.js"></script>

</head>

<body class="container mt-5">

<div class="container mt-5">
        <h2>Gestión de Materias</h2>
        
        <!-- Botón para abrir el modal de agregar materia -->
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#agregarMateriaModal">
            Agregar Materia
        </button>

        <!-- Tabla para mostrar las materias -->
        <table class="table mt-3">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Descripción</th>
                  
                </tr>
            </thead>
            <tbody id="materiasTableBody">
                <!-- Aquí se cargarán las filas de la tabla mediante JavaScript -->
            </tbody>
        </table>
    </div>

    <!-- Modal para agregar materias -->
    <div class="modal" id="agregarMateriaModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Agregar Materia</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Formulario para agregar materias -->
                    <form id="agregarMateriaForm">
                        <div class="form-group">
                            <label for="nombre">Nombre:</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" required>
                        </div>
                        <div class="form-group">
                            <label for="descripcion">Descripción:</label>
                            <textarea class="form-control" id="descripcion" name="descripcion" rows="3" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Agregar Materia</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

   

    


<!-- Script JavaScript para manejar AJAX y mostrar materias -->
<script>
    $(document).ready(function() {
        // Inicializar DataTables
        $('#materiasTable').DataTable();

        // Función para obtener la lista de materias mediante AJAX
        function obtenerMaterias() {
            $.ajax({
                url: '/prueba_trabajo/Controlador/materia_controller.php?action=obtenerMaterias',
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    // Limpiar el contenido anterior en #materiasTableBody tbody
                    $('#materiasTableBody').empty();

                    // Iterar sobre la lista de materias y agregar a la tabla
                    data.forEach(function(materia) {
                        // Agregar cada materia como una fila a la tabla DataTable
                        $('#materiasTable').DataTable().row.add([
                            materia.id,
                            materia.nombre,
                            materia.descripcion
                        ]).draw(false);
                    });
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error('Error de AJAX:', textStatus, errorThrown);
                    console.log(jqXHR.responseText);
                }
            });
        }

        // Llamar a la función para obtener materias al cargar la página
        obtenerMaterias();

        // Manejar la presentación y ocultamiento del modal
        $('#agregarMateriaModal').on('show.bs.modal', function(e) {
            // Limpiar el formulario al abrir el modal
            $('#agregarMateriaForm')[0].reset();
        });

        // Manejar el envío del formulario para agregar materias
        $('#agregarMateriaForm').submit(function(event) {
            event.preventDefault();

            // Obtener datos del formulario
            var nombre = $('#nombre').val();
            var descripcion = $('#descripcion').val();

            // Realizar la llamada AJAX para agregar materia
            $.ajax({
                url: '/prueba_trabajo/Controlador/materia_controller.php?action=agregarMateria',
                type: 'POST',
                dataType: 'json',
                data: {
                    nombre: nombre,
                    descripcion: descripcion
                },
                success: function(response) {
                    // Lógica para manejar la respuesta y mostrar SweetAlert
                    try {
                        if (response.error) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: response.error
                            });
                        } else {
                            Swal.fire({
                                icon: 'success',
                                title: 'Éxito',
                                text: response.mensaje
                            });

                            // Cerrar el modal después de agregar con éxito
                            $('#agregarMateriaModal').modal('hide');

                            // Volver a cargar la lista de materias
                            obtenerMaterias();
                        }
                    } catch (e) {
                        console.error('Error al analizar JSON:', e);
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error('Error de AJAX al agregar materia:', textStatus, errorThrown);
                    console.log(jqXHR.responseText);
                }
            });
        });
    });
</script>


    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>

</html>