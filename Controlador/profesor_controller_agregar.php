<?php
include $_SERVER['DOCUMENT_ROOT'] . '/prueba_trabajo/bd/conexion.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/prueba_trabajo/Modelo/Profesor.php';

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['nombre'], $_POST['email'])) {
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];

    // Crea una instancia del modelo Profesor
    $profesor = new Profesor($nombre, $email);

    // Guarda el profesor en la base de datos
    $resultado = $profesor->guardar($pdo);

    // Retorna una respuesta AJAX (puede ser un mensaje de éxito o cualquier otro dato)
    if ($resultado) {
        echo json_encode(['mensaje' => 'Profesor agregado con éxito']);
    } else {
        echo json_encode(['error' => 'Error al agregar el profesor']);
    }
} else {
    echo json_encode(['error' => 'Solicitud no válida']);
}
?>
