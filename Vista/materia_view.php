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
   

        <!-- Tabla para mostrar las materias -->
        <table class="table mt-3" id="materiasTable">
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



   

    


<!-- Script JavaScript para manejar AJAX y mostrar materias -->
<script>

$(document).ready(function() {
    // Inicializar DataTables
    var materiasTable = $('#materiasTable').DataTable({
        columns: [
            { title: 'ID' },
            { title: 'Nombre' },
            { title: 'Descripción' }
        ]
    });

    // Función para obtener la lista de materias mediante AJAX
    function obtenerMaterias() {
        $.ajax({
            url: '/prueba_trabajo/Controlador/materia_controller.php?action=obtenerMaterias',
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                // Limpiar el contenido anterior en #materiasTableBody tbody y dibujar
                materiasTable.clear().draw();

                // Iterar sobre la lista de materias y agregar a la tabla
                data.forEach(function(materia) {
                    // Agregar cada materia como una fila a la tabla DataTable
                    materiasTable.row.add([
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
});




</script>


    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>

</html>
