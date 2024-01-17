
<?php
include $_SERVER['DOCUMENT_ROOT'] . '/prueba_trabajo/bd/conexion.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/prueba_trabajo/Modelo/Materia.php';




if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['nombre'], $_POST['descripcion'])) {
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];

    // Crea una instancia del modelo Profesor
    $materia = new Materia($nombre, $descripcion);

    // Guarda el profesor en la base de datos
    $resultado = $materia->guardar($pdo);

    // Retorna una respuesta AJAX (puede ser un mensaje de éxito o cualquier otro dato)
    if ($resultado) {
        echo json_encode(['mensaje' => 'Materia agregado con éxito']);
    } else {
        echo json_encode(['error' => 'Error al agregar la Materia']);
    }
} else {
    echo json_encode(['error' => 'Solicitud no válida']);
}
?>
