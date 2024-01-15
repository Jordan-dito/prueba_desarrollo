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

    <h1 class="mb-4">Profesores</h1>

    <button class="btn btn-primary mb-3" data-toggle="modal" data-target="#agregarProfesorModal">Agregar Profesor</button>

    <table id="profesoresTable" class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Email</th>
            </tr>
        </thead>
        <tbody>
            <!-- Aquí se mostrará la lista de profesores -->
        </tbody>
    </table>

    <!-- Modal para agregar profesores -->
    <div class="modal" id="agregarProfesorModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Agregar Profesor</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Contenido del formulario para agregar profesores -->
                    <form id="agregarProfesorForm">
                        <div class="form-group">
                            <label for="nombre">Nombre:</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Agregar Profesor</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            // Inicializar DataTables con la opción de búsqueda
            $('#profesoresTable').DataTable({
                searching: true
            });

            // Función para obtener la lista de profesores mediante AJAX
            function obtenerProfesores() {
                $.ajax({
                    url: '/prueba_trabajo/Controlador/profesor_controller_mostrar.php?action=obtenerProfesores',
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        // Limpiar el contenido anterior en #profesoresTable tbody
                        $('#profesoresTable tbody').empty();

                        // Iterar sobre la lista de profesores y agregar a la tabla
                        data.forEach(function(profesor) {
                            // Agregar cada profesor como una fila a la tabla DataTable
                            $('#profesoresTable').DataTable().row.add([
                                profesor.id,
                                profesor.nombre,
                                profesor.email
                            ]).draw(false);
                        });
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.error('Error de AJAX:', textStatus, errorThrown);
                        console.log(jqXHR.responseText);
                    }
                });
            }

            // Resto de tu código...



            // Llamar a la función para obtener profesores al cargar la página
            obtenerProfesores();

            // Manejar la presentación y ocultamiento del modal
            $('#agregarProfesorModal').on('show.bs.modal', function(e) {
                // Limpiar el formulario al abrir el modal
                $('#agregarProfesorForm')[0].reset();
            });

            // Manejar el envío del formulario para agregar profesores
            // Manejar el envío del formulario para agregar profesores
            $('#agregarProfesorForm').submit(function(event) {
                event.preventDefault();

                // Obtener datos del formulario
                var nombre = $('#nombre').val();
                var email = $('#email').val();

                // Realizar la llamada AJAX al nuevo controlador para agregar profesor
                $.ajax({
                    url: '/prueba_trabajo/Controlador/profesor_controller_agregar.php',
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        nombre: nombre,
                        email: email
                    },
                    success: function(response) {
                        // Lógica para manejar la respuesta del nuevo controlador
                        try {
                            var data = JSON.parse(response);
                            // Mostrar SweetAlert en lugar de solo imprimir en la consola
                            Swal.fire({
                                title: 'Éxito',
                                text: data.mensaje,
                                icon: 'success'
                            });

                            // Actualizar la tabla de profesores
                            obtenerProfesores();



                            // Opción 2: Recargar la página
                            location.reload();
                        } catch (e) {
                            console.error('Error al analizar JSON:', e);
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.error('Error de AJAX al agregar profesor:', textStatus, errorThrown);
                        console.log(jqXHR.responseText);
                    }
                });
            });

        });
    </script>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>

</html>