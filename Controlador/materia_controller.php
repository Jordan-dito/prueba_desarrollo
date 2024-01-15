<?php
// Controlador para Materias

include $_SERVER['DOCUMENT_ROOT'] . '/prueba_trabajo/bd/conexion.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/prueba_trabajo/Modelo/Materia.php';

if ($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET['action'])) {
    $action = $_GET['action'];

    switch ($action) {
        case 'obtenerMaterias':
            // Obtiene todas las materias desde la base de datos
            $materia = new Materia();
            $materias = $materia->obtenerMaterias($pdo);

            // Retorna una respuesta AJAX (puede ser un mensaje de éxito o cualquier otro dato)
            if ($materias) {
                echo json_encode($materias);
            } else {
                echo json_encode(['error' => 'Error al obtener las materias']);
            }
            break;

        default:
            echo json_encode(['error' => 'Acción no válida']);
            break;
    }
} elseif ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['nombre'], $_POST['descripcion'])) {
    // Agrega una nueva materia a la base de datos
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];

    $materia = new Materia($nombre, $descripcion);
    $resultado = $materia->guardar($pdo);

    // Retorna una respuesta AJAX (puede ser un mensaje de éxito o cualquier otro dato)
    if ($resultado) {
        echo json_encode(['mensaje' => 'Materia agregada con éxito']);
    } else {
        echo json_encode(['error' => 'Error al agregar la materia']);
    }
} else {
    echo json_encode(['error' => 'Solicitud no válida']);
}
?>
