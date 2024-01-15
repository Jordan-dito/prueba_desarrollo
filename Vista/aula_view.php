<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Gestión de Aulas</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap4.min.js"></script>
    <!-- SweetAlert CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</head>

<body class="container mt-5">

    <h1 class="mb-4">Aulas</h1>

    <button class="btn btn-primary mb-3" data-toggle="modal" data-target="#agregarAulaModal">Agregar Aula</button>

    <table id="aulasTable" class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Fecha</th>
                <th>Hora</th>
                <th>Tema</th>
                <th>Profesor</th>
                <th> Materia</th>
            </tr>
        </thead>
        <tbody>
            <!-- Aquí se mostrará la lista de aulas -->
        </tbody>
    </table>


    <!-- Modal para agregar aulas -->
    <div class="modal" id="agregarAulaModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Agregar Aula</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Contenido del formulario para agregar aulas -->
                    <form id="agregarAulaForm">
                        <div class="form-group">
                            <label for="fecha">Fecha:</label>
                            <input type="date" class="form-control" id="fecha" name="fecha" required>
                        </div>
                        <div class="form-group">
                            <label for="hora">Hora:</label>
                            <input type="time" class="form-control" id="hora" name="hora" required>
                        </div>
                        <div class="form-group">
                            <label for="tema">Tema:</label>
                            <input type="text" class="form-control" id="tema" name="tema" required>
                        </div>
                        <div class="form-group">
                            <label for="profesorId"> Profesor:</label>
                            <input type="number" class="form-control" id="profesorId" name="profesorId" required>
                        </div>
                        <div class="form-group">
                            <label for="materiaId"> Materia:</label>
                            <input type="number" class="form-control" id="materiaId" name="materiaId" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Agregar Aula</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            // Inicializar DataTables
            $('#aulasTable').DataTable();

            // Función para obtener la lista de aulas mediante AJAX
            function obtenerAulas() {
                $.ajax({
                    url: '/prueba_trabajo/Controlador/aula_controller.php?action=obtenerAulas',
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        // Limpiar el contenido anterior en #aulasTable tbody
                        $('#aulasTable tbody').empty();

                        // Iterar sobre la lista de aulas y agregar a la tabla
                        data.forEach(function(aula) {
    // Agregar cada aula como una fila a la tabla DataTable
    $('#aulasTable').DataTable().row.add([
        aula.id,
        aula.fecha,
        aula.hora,
        aula.tema,
        aula.nombre_profesor, // Mostrar el nombre del profesor en lugar del ID
        aula.nombre_materia  // Mostrar el nombre de la materia en lugar del ID
    ]).draw(false);
});



                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.error('Error de AJAX:', textStatus, errorThrown);
                        console.log(jqXHR.responseText);
                    }
                });
            }

            // Llamar a la función para obtener aulas al cargar la página
            obtenerAulas();

            // Manejar la presentación y ocultamiento del modal
            $('#agregarAulaModal').on('show.bs.modal', function(e) {
                // Limpiar el formulario al abrir el modal
                $('#agregarAulaForm')[0].reset();
            });

            // Manejar el envío del formulario para agregar aulas
            $('#agregarAulaForm').submit(function(event) {
                event.preventDefault();

                // Obtener datos del formulario
                var fecha = $('#fecha').val();
                var hora = $('#hora').val();
                var tema = $('#tema').val();
                var profesorId = $('#profesorId').val();
                var materiaId = $('#materiaId').val();

                // Realizar la llamada AJAX para agregar aula
                $.ajax({
                    url: '/prueba_trabajo/Controlador/aula_controller.php?action=agregarAula',
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        fecha: fecha,
                        hora: hora,
                        tema: tema,
                        profesorId: profesorId,
                        materiaId: materiaId
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
                                $('#agregarAulaModal').modal('hide');

                                // Volver a cargar la lista de aulas
                                obtenerAulas();
                            }
                        } catch (e) {
                            console.error('Error al analizar JSON:', e);
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.error('Error de AJAX al agregar aula:', textStatus, errorThrown);
                        console.log(jqXHR.responseText);
                    }
                });
            });
        });
    </script>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>

</html>